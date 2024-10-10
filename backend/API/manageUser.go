package API

import (
	"crypto/md5"
	"database/sql"
	"encoding/hex"
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
	suId := c.Param("id")
	var objUserArray []UserTable
	objListUser, err := db.Query("SELECT su.*,spg.spg_name FROM `sys_users` AS su LEFT JOIN sys_permission_group AS spg ON su.spg_id = spg.spg_id WHERE su.su_id != ?", suId)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListUser.Close()
	for objListUser.Next() {
		var objUser UserTable
		var strDept sql.NullInt64
		var strUserSignPath sql.NullString
		var strUserSignName sql.NullString
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString
		err := objListUser.Scan(&objUser.Su_id, &objUser.Spg_id, &objUser.Su_username, &objUser.Su_password, &objUser.Su_firstname, &objUser.Su_lastname, &objUser.Su_email, &strDept, &strUserSignPath, &strUserSignName, &objUser.Su_status, &strCreateDate, &strUpdateDate, &strCreateBy, &strUpdateBy, &objUser.Su_last_accress, &objUser.Spg_name)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		if strUserSignPath.Valid {
			objUser.Su_sign_path = strUserSignPath.String
		}
		if strUserSignName.Valid {
			objUser.Su_sign_file = strUserSignName.String
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
		if strDept.Valid {
			objUser.Sd_id = int(strDept.Int64)
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

func ListUserById(c *gin.Context) {
	var objUser Users
	iId := c.Param("id")
	var stDeptId sql.NullInt64
	var strUserImgPath sql.NullString
	var strUserImgName sql.NullString
	var strCreateDate sql.NullString
	var strUpdateDate sql.NullString
	var strCreateBy sql.NullString
	var strUpdateBy sql.NullString
	err := db.QueryRow("SELECT * FROM `sys_users` WHERE su_id = ?", iId).Scan(&objUser.Su_id, &objUser.Spg_id, &objUser.Su_username, &objUser.Su_password, &objUser.Su_firstname, &objUser.Su_lastname, &objUser.Su_email, &stDeptId, &strUserImgPath, &strUserImgName, &objUser.Su_status, &strCreateDate, &strUpdateDate, &strCreateBy, &strUpdateBy, &objUser.Su_last_accress)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	if strUserImgPath.Valid {
		objUser.Su_sign_path = strUserImgPath.String
	}
	if strUserImgName.Valid {
		objUser.Su_sign_file = strUserImgName.String
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
	if stDeptId.Valid {
		objUser.Sd_id = int(stDeptId.Int64)
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
	err := db.QueryRow("SELECT * FROM sys_users WHERE su_username = ? and su_id != ?", objUser.Su_emp_code, objUser.Su_id).Scan(&objUser.Su_id, &objUser.Su_fname, &objUser.Su_lname, &objUser.Su_email, &objUser.Su_emp_code, &objUser.Su_password, &objUser.Su_tel, &strUserImgPath, &strUserImgName, &objUser.Spg_id, &objUser.Sd_id, &objUser.Spc_id, &objUser.Su_status, &strCreateDate, &strUpdateDate, &strCreateBy, &strUpdateBy)
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
	var objUser Users
	if err := c.BindJSON(&objUser); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	TextTrim(&objUser.Su_username, " ")
	// strEncodePassword := base64.StdEncoding.EncodeToString([]byte(objUser.Su_emp_code)) // bases 64 encode
	hash := md5.New()
	hash.Write([]byte(objUser.Su_username))
	strEncodePassword := hex.EncodeToString(hash.Sum(nil))
	TextTrim(&objUser.Su_firstname, " ")
	TextTrim(&objUser.Su_lastname, " ")
	objResult, err := db.Exec("INSERT INTO sys_users(su_firstname, su_lastname, su_email, su_username, su_password, spg_id, sd_id, su_status,su_created_date, su_created_by, su_updated_date, su_updated_by, su_last_access) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)", objUser.Su_firstname, objUser.Su_lastname, objUser.Su_email, objUser.Su_username, strEncodePassword, objUser.Spg_id, objUser.Sd_id, 1, objUser.Create_date, objUser.Create_by, objUser.Create_date, objUser.Create_by, objUser.Create_date)
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
	var objUser Users
	if err := c.BindJSON(&objUser); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	TextTrim(&objUser.Su_username, " ")
	TextTrim(&objUser.Su_firstname, " ")
	TextTrim(&objUser.Su_lastname, " ")
	objResult, err := db.Exec("Update sys_users SET su_firstname = ?,su_lastname = ?,su_email = ?,su_username = ?, spg_id = ?,sd_id = ?, su_updated_date = ?, su_updated_by = ? WHERE su_id = ?", objUser.Su_firstname, objUser.Su_lastname, objUser.Su_email, objUser.Su_username, objUser.Spg_id, objUser.Sd_id, objUser.Update_date, objUser.Update_by, objUser.Su_id)
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
	var objUser Users
	if err := c.BindJSON(&objUser); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	TextTrim(&objUser.Su_firstname, " ")
	TextTrim(&objUser.Su_lastname, " ")
	objResult, err := db.Exec("Update sys_users SET su_firstname = ?,su_lastname = ?,su_email = ?, su_updated_date = ?, su_updated_by = ? WHERE su_id = ?", objUser.Su_firstname, objUser.Su_lastname, objUser.Su_email, objUser.Update_date, objUser.Update_by, objUser.Su_id)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})
}
func UpdateSignature(c *gin.Context) {
	var objusers Users
	if err := c.BindJSON(&objusers); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}

	objResult, err := db.Exec("UPDATE sys_users SET su_sign_path = ?, su_sign_file = ?, su_updated_date = ?, su_updated_by = ? WHERE su_id = ?", objusers.Su_sign_path, objusers.Su_sign_file, objusers.Update_date, objusers.Update_by, objusers.Su_id)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}
	c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})

}

func SettingPassword(c *gin.Context) {
	var objUser Users
	if err := c.BindJSON(&objUser); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	// strEncodePassword := base64.StdEncoding.EncodeToString([]byte(objUser.Su_password))
	hash := md5.New()
	hash.Write([]byte(objUser.Su_password))
	strEncodePassword := hex.EncodeToString(hash.Sum(nil))
	objResult, err := db.Exec("Update sys_users SET su_password = ?, su_updated_date = ?, su_updated_by = ? WHERE su_id = ?", strEncodePassword, objUser.Update_date, objUser.Update_by, objUser.Su_id)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})
}
