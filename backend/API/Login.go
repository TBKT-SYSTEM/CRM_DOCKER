package API

import (
	"database/sql"
	"encoding/json"
	"io"
	"log"
	"net/http"
	"strconv"
	"strings"
	"time"

	"github.com/gin-gonic/gin"
)

// login ---------------------------
func Login(c *gin.Context) {
	var objUser User
	if err := c.BindJSON(&objUser); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}

	chkExp, err1 := http.Get("http://192.168.161.102/api_system/getAccountEx?username=" + objUser.Su_emp_code)
	if err1 != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"error": "Failed to fetch data from external API"})
		return
	}
	defer chkExp.Body.Close()

	if chkExp.StatusCode != http.StatusOK {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"error": "External API returned non-OK status"})
		return
	}

	body, err1 := io.ReadAll(chkExp.Body)
	if err1 != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"error": "Failed to read response body"})
		return
	}

	// พิมพ์ response body เพื่อตรวจสอบ
	// log.Println("Response Body:", string(body))

	var accountsExp []UserExp
	if err := json.Unmarshal(body, &accountsExp); err != nil {
		c.IndentedJSON(http.StatusOK, "Not found data")
		return
	}

	if len(accountsExp) == 0 {
		c.IndentedJSON(http.StatusNotFound, gin.H{"error": "Data not found in external API"})
		return
	}

	// c.IndentedJSON(http.StatusOK, gin.H{"account": accountsExp[0].USER_CD})

	// strEncodePassword := base64.StdEncoding.EncodeToString([]byte(objUser.Su_password)) // bases 64 encode **old
	// hash := md5.New()
	// hash.Write([]byte(objUser.Su_password))
	// strEncodePassword := hex.EncodeToString(hash.Sum(nil))

	var strTel sql.NullString
	var strUserImgPath sql.NullString
	var strUserImgName sql.NullString
	var strCreateDate sql.NullString
	var strUpdateDate sql.NullString
	var strCreateBy sql.NullString
	var strUpdateBy sql.NullString

	chkLoginExp := db.QueryRow("SELECT * FROM sys_user WHERE su_emp_code= ?", accountsExp[0].USER_CD).Scan(&objUser.Su_id, &objUser.Su_fname, &objUser.Su_lname, &objUser.Su_email,
		&objUser.Su_emp_code, &objUser.Su_password, &objUser.Su_tel, &strUserImgPath, &strUserImgName, &objUser.Spg_id, &objUser.Sd_id, &objUser.Spc_id, &objUser.Su_status, &strCreateDate,
		&strUpdateDate, &strCreateBy, &strUpdateBy)
	if chkLoginExp == sql.ErrNoRows {

		var userName = accountsExp[0].USER_NAME
		var userPlantStr = accountsExp[0].PLANT_CD
		var strDept string

		id_code := accountsExp[0].USER_CD
		trimmed_id_code := id_code[2:]

		strUserImgPath := "http://192.168.161.207/tbkk_shopfloor_sys/asset/img_emp/" + trimmed_id_code + ".jpg"
		strUserImgName := trimmed_id_code + ".jpg"
		strTel := "0000000000"
		strCreateBy := accountsExp[0].USER_CD

		currentTime := time.Now()
		strCreateDate := currentTime.Format("2006-01-02 15:04:05")

		userPlant, err1 := strconv.Atoi(userPlantStr)
		if err1 != nil {
			c.IndentedJSON(http.StatusOK, gin.H{"Error": err1.Error()})
		}

		nameParts := strings.Split(userName, " ")

		var userFName, userLName string
		if len(nameParts) >= 2 {
			userFName = nameParts[0]
			userLName = strings.Join(nameParts[1:], " ")
		} else if len(nameParts) == 1 {
			userFName = nameParts[0]
			userLName = ""
		}

		if userPlant == 51 {
			userPlant = 1
		} else {
			userPlant = 2
		}

		// if accountsExp[0].SEC_CD == "" {
		// 	strDept = "12"
		// } else {
		// 	strDept = accountsExp[0].SEC_CD
		// }

		strDept = "12"

		deptID, errDept := strconv.Atoi(strDept)
		if errDept != nil {
			c.IndentedJSON(http.StatusOK, gin.H{"Error": errDept.Error()})
		}

		_, err := db.Exec("INSERT INTO sys_user(su_fname, su_lname, su_email, su_emp_code, su_password, su_tel, su_img_path, su_img_name, spg_id, sd_id, spc_id, su_status, create_date, create_by) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)", userFName, userLName, accountsExp[0].ADDRESS, accountsExp[0].USER_CD, accountsExp[0].PASSWORD, strTel, strUserImgPath, strUserImgName, 2, deptID, userPlant, 1, strCreateDate, strCreateBy)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
			return
		}
	}

	errLogin := db.QueryRow("SELECT * FROM sys_user WHERE su_emp_code= ?", accountsExp[0].USER_CD).Scan(&objUser.Su_id, &objUser.Su_fname, &objUser.Su_lname, &objUser.Su_email,
		&objUser.Su_emp_code, &objUser.Su_password, &objUser.Su_tel, &strUserImgPath, &strUserImgName, &objUser.Spg_id, &objUser.Sd_id, &objUser.Spc_id, &objUser.Su_status, &strCreateDate,
		&strUpdateDate, &strCreateBy, &strUpdateBy)

	if errLogin == sql.ErrNoRows {
		c.IndentedJSON(http.StatusOK, "This user isn't exist")
		return

	} else {
		err := db.QueryRow("SELECT * FROM sys_user WHERE su_emp_code= ? AND su_status=1", objUser.Su_emp_code).Scan(&objUser.Su_id, &objUser.Su_fname, &objUser.Su_lname, &objUser.Su_email,
			&objUser.Su_emp_code, &objUser.Su_password, &objUser.Su_tel, &strUserImgPath, &strUserImgName, &objUser.Spg_id, &objUser.Sd_id, &objUser.Spc_id, &objUser.Su_status, &strCreateDate,
			&strUpdateDate, &strCreateBy, &strUpdateBy)
		if err == sql.ErrNoRows {
			c.IndentedJSON(http.StatusOK, "This user is banned")
			return
		} else {
			var objUserSession UserSession
			err := db.QueryRow("SELECT su.*,sd.sd_name,spg.spg_name FROM `sys_user` AS su LEFT JOIN sys_department AS sd ON su.sd_id = sd.sd_id "+
				"LEFT JOIN sys_permission_group AS spg ON su.spg_id = spg.spg_id WHERE su_emp_code= ? AND su_password= ?", objUser.Su_emp_code, objUser.Su_password).
				Scan(&objUserSession.Su_id, &objUserSession.Su_fname, &objUserSession.Su_lname, &objUserSession.Su_email,
					&objUserSession.Su_emp_code, &objUserSession.Su_password, &strTel, &strUserImgPath, &strUserImgName, &objUserSession.Spg_id, &objUserSession.Sd_id, &objUserSession.Spc_id, &objUserSession.Su_status, &strCreateDate,
					&strUpdateDate, &strCreateBy, &strUpdateBy, &objUserSession.Sd_name, &objUserSession.Spg_name)
			if err == sql.ErrNoRows {
				c.IndentedJSON(http.StatusOK, "Password incorrect")
				return
			} else {
				StringReplace(&objUserSession.Sd_name, "\u0026", "&", 1)
				if strTel.Valid {
					objUserSession.Su_tel = strTel.String
				}
				if strUserImgPath.Valid {
					objUserSession.Su_img_path = strUserImgPath.String
				}
				if strUserImgName.Valid {
					objUserSession.Su_img_name = strUserImgName.String
				}
				if strCreateDate.Valid {
					objUserSession.Create_date = strCreateDate.String
				}
				if strUpdateDate.Valid {
					objUserSession.Update_date = strUpdateDate.String
				}
				if strCreateBy.Valid {
					objUserSession.Create_by = strCreateBy.String
				}
				if strUpdateBy.Valid {
					objUserSession.Update_by = strUpdateBy.String
				}

				jsonObj, err := json.Marshal(objUserSession)
				if err != nil {
					log.Println("Error marshaling JSON!!!!!!!!!!!!!!:", err)
				} else {
					log.Println(string(jsonObj))
				}

				c.IndentedJSON(http.StatusOK, objUserSession)
				return
			}
		}
	}
}
func LogLogin(c *gin.Context) {
	var objLog Log
	if err := c.BindJSON(&objLog); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	objResult, err := db.Exec("INSERT INTO log_activity(su_id,la_login_date) VALUES(?,?)", objLog.Su_id, objLog.La_login_date)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})
}
func LogLogout(c *gin.Context) {
	var objLog Log
	if err := c.BindJSON(&objLog); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	objResult, err := db.Exec("INSERT INTO log_activity(su_id,la_logout_date) VALUES(?,?)", objLog.Su_id, objLog.La_logout_date)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})
}
