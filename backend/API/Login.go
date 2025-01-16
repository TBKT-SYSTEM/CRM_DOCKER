package API

import (
	"crypto/md5"
	"database/sql"
	"encoding/base64"
	"encoding/hex"
	"encoding/json"
	"fmt"
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
	var objUserCheck Users
	var objUser Users

	var strDept sql.NullInt64
	var strUserImgPath sql.NullString
	var strUserImgName sql.NullString
	var strCreateDate sql.NullString
	var strUpdateDate sql.NullString
	var strCreateBy sql.NullString
	var strUpdateBy sql.NullString

	if err := c.BindJSON(&objUserCheck); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}

	Login1 := db.QueryRow("SELECT * FROM sys_users WHERE su_username = ?", objUserCheck.Su_username).Scan(&objUser.Su_id, &objUser.Spg_id, &objUser.Su_username, &objUser.Su_password, &objUser.Su_firstname, &objUser.Su_lastname, &objUser.Su_email, &objUser.Sd_id, &objUser.Su_sign_path, &objUser.Su_sign_file, &objUser.Su_status, &strCreateDate, &strCreateBy, &strUpdateDate, &strUpdateBy, &objUser.Su_last_accress)

	if Login1 == sql.ErrNoRows {
		chkExp, err1 := http.Get("http://192.168.161.102/api_system/getAccountEx?username=" + objUserCheck.Su_username)
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

		chkLoginExp := db.QueryRow("SELECT * FROM sys_users WHERE su_username = ?", accountsExp[0].USER_CD).Scan(&objUser.Su_id, &objUser.Spg_id, &objUser.Su_username, &objUser.Su_password, &objUser.Su_firstname, &objUser.Su_lastname, &objUser.Su_email, &objUser.Sd_id, &objUser.Su_sign_path, &objUser.Su_sign_file, &objUser.Su_status, &strCreateDate, &strCreateBy, &strUpdateDate, &strUpdateBy, &objUser.Su_last_accress)

		if chkLoginExp == sql.ErrNoRows {

			var userName = accountsExp[0].USER_NAME
			var userPlantStr = accountsExp[0].PLANT_CD

			// id_code := accountsExp[0].USER_CD
			// trimmed_id_code := id_code[2:]

			// strUserImgPath := "http://192.168.161.207/tbkk_shopfloor_sys/asset/img_emp/" + trimmed_id_code + ".jpg"
			// strUserImgName := trimmed_id_code + ".jpg"
			// strTel := "0000000000"
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

			if accountsExp[0].SEC_CD == "" {
				strDept.Valid = false
			} else {
				var sdId int
				err := db.QueryRow("SELECT sd_id FROM sys_department WHERE sd_dept_cd = ?", accountsExp[0].SEC_CD).Scan(&sdId)

				if err == sql.ErrNoRows {
					c.IndentedJSON(http.StatusOK, "This dept isn't exist")
					return
				} else if err != nil {
					c.IndentedJSON(http.StatusInternalServerError, gin.H{
						"Error": err.Error(),
					})
					return
				}

				strDept.Int64 = int64(sdId)
				strDept.Valid = true
			}

			_, err := db.Exec("INSERT INTO sys_users (spg_id, su_username, su_password, su_firstname, su_lastname, su_email, sd_id, su_status, su_created_date, su_created_by, su_updated_date, su_updated_by, su_last_access) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)", 2, accountsExp[0].USER_CD, accountsExp[0].PASSWORD, userFName, userLName, accountsExp[0].ADDRESS, strDept, 1, strCreateDate, strCreateBy, strCreateDate, strCreateBy, strCreateDate)
			if err != nil {
				c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
				return
			}
		}

		errLogin := db.QueryRow("SELECT * FROM sys_users WHERE su_username = ?", objUserCheck.Su_username).Scan(&objUser.Su_id, &objUser.Spg_id, &objUser.Su_username, &objUser.Su_password, &objUser.Su_firstname, &objUser.Su_lastname, &objUser.Su_email, &objUser.Sd_id, &objUser.Su_sign_path, &objUser.Su_sign_file, &objUser.Su_status, &strCreateDate, &strCreateBy, &strUpdateDate, &strUpdateBy, &objUser.Su_last_accress)

		if errLogin == sql.ErrNoRows {
			c.IndentedJSON(http.StatusOK, "This user isn't exist")
			return

		} else {
			err := db.QueryRow("SELECT * FROM sys_users WHERE su_username = ? AND su_status = 1", objUserCheck.Su_username).Scan(&objUser.Su_id, &objUser.Spg_id, &objUser.Su_username, &objUser.Su_password, &objUser.Su_firstname, &objUser.Su_lastname, &objUser.Su_email, &objUser.Sd_id, &objUser.Su_sign_path, &objUser.Su_sign_file, &objUser.Su_status, &strCreateDate, &strCreateBy, &strUpdateDate, &strUpdateBy, &objUser.Su_last_accress)
			if err == sql.ErrNoRows {
				c.IndentedJSON(http.StatusOK, "This user is banned")
				return
			} else {
				var objUserSession UsersSession
				hash := md5.New()
				hash.Write([]byte(objUserCheck.Su_password))
				strEncodePassword := hex.EncodeToString(hash.Sum(nil))
				err := db.QueryRow("SELECT su.*,sd.sd_dept_name,spg.spg_name FROM `sys_users` AS su LEFT JOIN sys_department AS sd ON su.sd_id = sd.sd_id "+
					"LEFT JOIN sys_permission_group AS spg ON su.spg_id = spg.spg_id WHERE su_username = ? AND su_password = ?", objUserCheck.Su_username, strEncodePassword).
					Scan(&objUserSession.Su_id, &objUserSession.Spg_id, &objUserSession.Su_username, &objUserSession.Su_password, &objUserSession.Su_firstname, &objUserSession.Su_lastname, &objUserSession.Su_email, &objUserSession.Sd_id, &objUserSession.Su_sign_path, &objUserSession.Su_sign_file, &objUserSession.Su_status, &strCreateDate, &strCreateBy, &strUpdateDate, &strUpdateBy, &objUserSession.Su_last_accress, &objUserSession.Sd_dept_name, &objUserSession.Spg_name)
				if err == sql.ErrNoRows {
					c.IndentedJSON(http.StatusOK, "Password incorrect")
					return
				} else {
					StringReplace(&objUserSession.Sd_dept_name, "\u0026", "&", 1)
					if strUserImgPath.Valid {
						objUserSession.Su_sign_path = strUserImgPath.String
					}
					if strUserImgName.Valid {
						objUserSession.Su_sign_file = strUserImgName.String
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
						log.Println("Error marshaling JSON:", err)
						c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": "Failed to marshal JSON"})
						return
					}

					accressTime := time.Now()
					strAccressDate := accressTime.Format("2006-01-02 15:04:05")

					_, err = db.Exec("UPDATE sys_users SET su_last_access = ? WHERE su_id = ?", strAccressDate, objUserSession.Su_id)
					if err != nil {
						c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
						return
					}

					log.Println("User session:", string(jsonObj))

					c.IndentedJSON(http.StatusOK, objUserSession)
					return
				}
			}
		}

	} else {
		err := db.QueryRow("SELECT * FROM sys_users WHERE su_username = ? AND su_status = 1", objUserCheck.Su_username).Scan(&objUser.Su_id, &objUser.Spg_id, &objUser.Su_username, &objUser.Su_password, &objUser.Su_firstname, &objUser.Su_lastname, &objUser.Su_email, &objUser.Sd_id, &objUser.Su_sign_path, &objUser.Su_sign_file, &objUser.Su_status, &strCreateDate, &strCreateBy, &strUpdateDate, &strUpdateBy, &objUser.Su_last_accress)
		if err == sql.ErrNoRows {
			c.IndentedJSON(http.StatusOK, "This user is banned")
			return
		} else {
			var objUserSession UsersSession
			hash := md5.New()
			hash.Write([]byte(objUserCheck.Su_password))
			strEncodePassword := hex.EncodeToString(hash.Sum(nil))
			err := db.QueryRow("SELECT su.*,sd.sd_dept_name,spg.spg_name FROM `sys_users` AS su LEFT JOIN sys_department AS sd ON su.sd_id = sd.sd_id "+
				"LEFT JOIN sys_permission_group AS spg ON su.spg_id = spg.spg_id WHERE su_username = ? AND su_password = ?", objUserCheck.Su_username, strEncodePassword).
				Scan(&objUserSession.Su_id, &objUserSession.Spg_id, &objUserSession.Su_username, &objUserSession.Su_password, &objUserSession.Su_firstname, &objUserSession.Su_lastname, &objUserSession.Su_email, &objUserSession.Sd_id, &objUserSession.Su_sign_path, &objUserSession.Su_sign_file, &objUserSession.Su_status, &strCreateDate, &strCreateBy, &strUpdateDate, &strUpdateBy, &objUserSession.Su_last_accress, &objUserSession.Sd_dept_name, &objUserSession.Spg_name)
			if err == sql.ErrNoRows {
				c.IndentedJSON(http.StatusOK, "Password incorrect")
				return
			} else {
				StringReplace(&objUserSession.Sd_dept_name, "\u0026", "&", 1)
				if strUserImgPath.Valid {
					objUserSession.Su_sign_path = strUserImgPath.String
				}
				if strUserImgName.Valid {
					objUserSession.Su_sign_file = strUserImgName.String
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
					log.Println("Error marshaling JSON:", err)
					c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": "Failed to marshal JSON"})
					return
				}

				accressTime := time.Now()
				strAccressDate := accressTime.Format("2006-01-02 15:04:05")

				_, err = db.Exec("UPDATE sys_users SET su_last_access = ? WHERE su_id = ?", strAccressDate, objUserSession.Su_id)
				if err != nil {
					c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
					return
				}

				log.Println("User session:", string(jsonObj))

				c.IndentedJSON(http.StatusOK, objUserSession)
				return
			}
		}
	}

}
func ApproveByEmail(c *gin.Context) {
	var objUserCheck Users
	var objUser Users
	run_no := c.Param("document")
	log.Println(run_no)
	run_no_bytes, err := base64.StdEncoding.DecodeString(run_no)
	if err != nil {
		fmt.Println("Error decoding Base64:", err)
		return
	}
	log.Println(string(run_no_bytes))

	// var strDept sql.NullInt64
	// var strUserImgPath sql.NullString
	// var strUserImgName sql.NullString
	var strCreateDate sql.NullString
	var strUpdateDate sql.NullString
	var strCreateBy sql.NullString
	var strUpdateBy sql.NullString

	if err := c.BindJSON(&objUserCheck); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	hash := md5.New()
	hash.Write([]byte(objUserCheck.Su_password))
	strEncodePassword := hex.EncodeToString(hash.Sum(nil))
	// log.Println(objUserCheck.Su_password)
	// log.Println(strEncodePassword)

	Login1 := db.QueryRow("SELECT * FROM sys_users WHERE su_username = ? AND su_password = ?", objUserCheck.Su_username, strEncodePassword).Scan(&objUser.Su_id, &objUser.Spg_id, &objUser.Su_username, &objUser.Su_password, &objUser.Su_firstname, &objUser.Su_lastname, &objUser.Su_email, &objUser.Sd_id, &objUser.Su_sign_path, &objUser.Su_sign_file, &objUser.Su_status, &strCreateDate, &strCreateBy, &strUpdateDate, &strUpdateBy, &objUser.Su_last_accress)

	if Login1 == sql.ErrNoRows {
		c.IndentedJSON(http.StatusOK, "Username or Password incorrect")
		return
	}
	c.IndentedJSON(http.StatusOK, objUser)
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
