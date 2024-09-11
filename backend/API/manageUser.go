package API

import (
	"crypto/md5"
	"database/sql"
	"encoding/hex"
	"fmt"
	"net/http"

	"github.com/gin-gonic/gin"
)

// manage user ---------------------------
func UsernameIsUnique(c *gin.Context) {
	var objUser User
	if err := c.BindJSON(&objUser); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	err := db.QueryRow("SELECT * FROM sys_user WHERE su_emp_code= ?", objUser.Su_emp_code).Scan(&objUser.Su_id, &objUser.Su_fname, &objUser.Su_lname, &objUser.Su_email,
		&objUser.Su_emp_code, &objUser.Su_password, &objUser.Su_tel, &objUser.Su_img_path, &objUser.Su_img_name, &objUser.Spg_id, &objUser.Sd_id, &objUser.Spc_id, &objUser.Su_status, &objUser.Create_date,
		&objUser.Update_date, &objUser.Create_by, &objUser.Update_by)
	if err == sql.ErrNoRows {
		c.IndentedJSON(http.StatusOK, false)
		return
	}
	c.IndentedJSON(http.StatusOK, true)
}
func ListUserTable(c *gin.Context) {
	var objUserArray []UserTable
	objListUser, err := db.Query("SELECT su.*,spg.spg_name FROM `sys_user` AS su LEFT JOIN sys_permission_group AS spg ON su.spg_id=spg.spg_id")
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListUser.Close()
	for objListUser.Next() {
		var objUser UserTable
		var strUserImgPath sql.NullString
		var strUserImgName sql.NullString
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString
		err := objListUser.Scan(&objUser.Su_id, &objUser.Su_fname, &objUser.Su_lname, &objUser.Su_email, &objUser.Su_emp_code, &objUser.Su_password, &objUser.Su_tel, &strUserImgPath, &strUserImgName, &objUser.Spg_id, &objUser.Sd_id, &objUser.Spc_id, &objUser.Su_status, &strCreateDate, &strUpdateDate, &strCreateBy, &strUpdateBy, &objUser.Spg_name)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		if strUserImgPath.Valid {
			objUser.Su_img_path = strUserImgPath.String
		}
		if strUserImgName.Valid {
			objUser.Su_img_name = strUserImgName.String
		}
		if strCreateDate.Valid {
			objUser.Create_date = strCreateDate.String
		}
		if strUpdateDate.Valid {
			objUser.Update_date = strUpdateDate.String
		}
		if strCreateBy.Valid {
			objUser.Create_by = strCreateBy.String
		}
		if strUpdateBy.Valid {
			objUser.Update_by = strUpdateBy.String
		}
		objUserArray = append(objUserArray, objUser)
	}
	err = objListUser.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}

	var objData UserData
	objData.Data = objUserArray
	c.IndentedJSON(http.StatusOK, objData)
}

func ListUserTable2(c *gin.Context) {
	fmt.Println("1235331231")
}
func ListUserById(c *gin.Context) {
	var objUser User
	iId := c.Param("id")
	var strUserImgPath sql.NullString
	var strUserImgName sql.NullString
	var strCreateDate sql.NullString
	var strUpdateDate sql.NullString
	var strCreateBy sql.NullString
	var strUpdateBy sql.NullString
	err := db.QueryRow("SELECT * FROM `sys_user` WHERE su_id= ?", iId).Scan(&objUser.Su_id, &objUser.Su_fname, &objUser.Su_lname, &objUser.Su_email, &objUser.Su_emp_code, &objUser.Su_password, &objUser.Su_tel, &strUserImgPath, &strUserImgName, &objUser.Spg_id, &objUser.Sd_id, &objUser.Spc_id, &objUser.Su_status, &strCreateDate, &strUpdateDate, &strCreateBy, &strUpdateBy)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	if strUserImgPath.Valid {
		objUser.Su_img_path = strUserImgPath.String
	}
	if strUserImgName.Valid {
		objUser.Su_img_name = strUserImgName.String
	}
	if strCreateDate.Valid {
		objUser.Create_date = strCreateDate.String
	}
	if strUpdateDate.Valid {
		objUser.Update_date = strUpdateDate.String
	}
	if strCreateBy.Valid {
		objUser.Create_by = strCreateBy.String
	}
	if strUpdateBy.Valid {
		objUser.Update_by = strUpdateBy.String
	}
	c.IndentedJSON(http.StatusOK, objUser)
}
func UserIsUnique(c *gin.Context) {
	var objUser User
	if err := c.BindJSON(&objUser); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	var strUserImgPath sql.NullString
	var strUserImgName sql.NullString
	var strCreateDate sql.NullString
	var strUpdateDate sql.NullString
	var strCreateBy sql.NullString
	var strUpdateBy sql.NullString
	err := db.QueryRow("SELECT * FROM sys_user WHERE su_emp_code= ? and su_id != ?", objUser.Su_emp_code, objUser.Su_id).Scan(&objUser.Su_id, &objUser.Su_fname, &objUser.Su_lname, &objUser.Su_email, &objUser.Su_emp_code, &objUser.Su_password, &objUser.Su_tel, &strUserImgPath, &strUserImgName, &objUser.Spg_id, &objUser.Sd_id, &objUser.Spc_id, &objUser.Su_status, &strCreateDate, &strUpdateDate, &strCreateBy, &strUpdateBy)
	if err == sql.ErrNoRows {
		c.IndentedJSON(http.StatusOK, false)
		return
	}
	if strUserImgPath.Valid {
		objUser.Su_img_path = strUserImgPath.String
	}
	if strUserImgName.Valid {
		objUser.Su_img_name = strUserImgName.String
	}
	if strCreateDate.Valid {
		objUser.Create_date = strCreateDate.String
	}
	if strUpdateDate.Valid {
		objUser.Update_date = strUpdateDate.String
	}
	if strCreateBy.Valid {
		objUser.Create_by = strCreateBy.String
	}
	if strUpdateBy.Valid {
		objUser.Update_by = strUpdateBy.String
	}
	c.IndentedJSON(http.StatusOK, true)
}
func InsertUser(c *gin.Context) {
	var objUser User
	if err := c.BindJSON(&objUser); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	TextTrim(&objUser.Su_emp_code, " ")
	// strEncodePassword := base64.StdEncoding.EncodeToString([]byte(objUser.Su_emp_code)) // bases 64 encode
	hash := md5.New()
	hash.Write([]byte(objUser.Su_emp_code))
	strEncodePassword := hex.EncodeToString(hash.Sum(nil))
	TextTrim(&objUser.Su_fname, " ")
	TextTrim(&objUser.Su_lname, " ")
	objResult, err := db.Exec("INSERT INTO sys_user(su_fname,su_lname,su_email,su_emp_code,su_password,su_tel,su_img_path,su_img_name,spg_id,sd_id,spc_id,create_date,create_by) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)", objUser.Su_fname, objUser.Su_lname, objUser.Su_email, objUser.Su_emp_code, strEncodePassword, objUser.Su_tel, objUser.Su_img_path, objUser.Su_img_name, objUser.Spg_id, objUser.Sd_id, objUser.Spc_id, objUser.Create_date, objUser.Create_by)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}
	lastID, err := objResult.LastInsertId()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}
	c.IndentedJSON(http.StatusOK, lastID)
}
func UpdateUser(c *gin.Context) {
	var objUser User
	if err := c.BindJSON(&objUser); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	TextTrim(&objUser.Su_emp_code, " ")
	TextTrim(&objUser.Su_fname, " ")
	TextTrim(&objUser.Su_lname, " ")
	objResult, err := db.Exec("Update sys_user SET su_fname = ?,su_lname = ?,su_email = ?,su_emp_code = ? ,su_tel = ?,su_img_path = ?, su_img_name = ?,spg_id = ?,sd_id = ?,spc_id = ?, update_date = ?, update_by = ? WHERE su_id = ?", objUser.Su_fname, objUser.Su_lname, objUser.Su_email, objUser.Su_emp_code, objUser.Su_tel, objUser.Su_img_path, objUser.Su_img_name, objUser.Spg_id, objUser.Sd_id, objUser.Spc_id, objUser.Update_date, objUser.Update_by, objUser.Su_id)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})
}
func ChangeUserStatus(c *gin.Context) {
	var objUser User
	if err := c.BindJSON(&objUser); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	objResult, err := db.Exec("Update sys_user SET su_status = ? WHERE su_id = ?", objUser.Su_status, objUser.Su_id)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})
}
func SettingUser(c *gin.Context) {
	var objUser User
	if err := c.BindJSON(&objUser); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	TextTrim(&objUser.Su_fname, " ")
	TextTrim(&objUser.Su_lname, " ")
	objResult, err := db.Exec("Update sys_user SET su_fname = ?,su_lname = ?,su_email = ?,su_tel = ?,sd_id = ?,spc_id = ?, update_date = ?, update_by = ? WHERE su_id = ?", objUser.Su_fname, objUser.Su_lname, objUser.Su_email, objUser.Su_tel, objUser.Sd_id, objUser.Spc_id, objUser.Update_date, objUser.Update_by, objUser.Su_id)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})
}
func UpdateSignature(c *gin.Context) {
	var objSignature Signature
	if err := c.BindJSON(&objSignature); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}

	var existingID int
	err := db.QueryRow("SELECT su_id FROM sys_signature WHERE su_id = ?", objSignature.Su_id).Scan(&existingID)

	if err != nil {
		if err == sql.ErrNoRows {
			objResult, err := db.Exec("INSERT INTO sys_signature (su_id, snt_file_name, snt_file_path, snt_status, create_date, update_date, create_by, update_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?)", objSignature.Su_id, objSignature.Snt_file_name, objSignature.Snt_file_path, objSignature.Snt_status, objSignature.Create_date, objSignature.Update_date, objSignature.Create_by, objSignature.Update_by)
			if err != nil {
				c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
				return
			}
			c.IndentedJSON(http.StatusOK, gin.H{"Insert": objResult})
		} else {
			c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		}
	} else {
		objResult, err := db.Exec("UPDATE sys_signature SET snt_file_name = ?, snt_file_path = ?, update_date = ?, update_by = ? WHERE su_id = ?", objSignature.Snt_file_name, objSignature.Snt_file_path, objSignature.Update_date, objSignature.Update_by, objSignature.Su_id)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
			return
		}
		c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})
	}
}

func SettingPassword(c *gin.Context) {
	var objUser User
	if err := c.BindJSON(&objUser); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	// strEncodePassword := base64.StdEncoding.EncodeToString([]byte(objUser.Su_password))
	hash := md5.New()
	hash.Write([]byte(objUser.Su_password))
	strEncodePassword := hex.EncodeToString(hash.Sum(nil))
	objResult, err := db.Exec("Update sys_user SET su_password = ?, update_date = ?, update_by = ? WHERE su_id = ?", strEncodePassword, objUser.Update_date, objUser.Update_by, objUser.Su_id)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})
}
