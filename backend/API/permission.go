package API

import (
	"database/sql"
	"net/http"

	"github.com/gin-gonic/gin"
)

// permission group ---------------------------
func ListSpgTable(c *gin.Context) {
	var objPermissionGroupArray []PermissionGroupTable
	objListPermissiong, err := db.Query("SELECT spg.*, su.su_firstname, su.su_lastname, su.su_sign_path, su.su_sign_file FROM `sys_permission_group` AS spg LEFT JOIN sys_users AS su ON spg.spg_updated_by = su.su_username ORDER BY spg.spg_id")
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListPermissiong.Close()
	for objListPermissiong.Next() {
		var objPermissionGroup PermissionGroupTable
		var strUserFname sql.NullString
		var strUserLname sql.NullString
		var strUserImgPath sql.NullString
		var strUserImgName sql.NullString
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString
		err := objListPermissiong.Scan(&objPermissionGroup.Spg_id, &objPermissionGroup.Spg_name, &objPermissionGroup.Spg_status, &strCreateDate, &strCreateBy, &strUpdateDate, &strUpdateBy, &strUserFname, &strUserLname, &strUserImgPath, &strUserImgName)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		if strUserFname.Valid {
			objPermissionGroup.Su_fname = strUserFname.String
		}
		if strUserLname.Valid {
			objPermissionGroup.Su_lname = strUserLname.String
		}
		if strUserImgPath.Valid {
			objPermissionGroup.Su_img_path = strUserImgPath.String
		}
		if strUserImgName.Valid {
			objPermissionGroup.Su_img_name = strUserImgName.String
		}
		if strCreateDate.Valid {
			objPermissionGroup.Create_date = strCreateDate.String
		}
		if strUpdateDate.Valid {
			objPermissionGroup.Update_date = strUpdateDate.String
		}
		if strCreateBy.Valid {
			objPermissionGroup.Create_by = strCreateBy.String
		}
		if strUpdateBy.Valid {
			objPermissionGroup.Update_by = strUpdateBy.String
		}
		objPermissionGroupArray = append(objPermissionGroupArray, objPermissionGroup)
	}
	err = objListPermissiong.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}

	var objData PermissionGroupData
	objData.Data = objPermissionGroupArray
	c.IndentedJSON(http.StatusOK, objData)
}
func InsertSpg(c *gin.Context) {
	var objPermissionGroupData PermissionGroup
	if err := c.BindJSON(&objPermissionGroupData); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	TextTrim(&objPermissionGroupData.Spg_name, " ")
	objResult, err := db.Exec("INSERT INTO sys_permission_group(spg_name,spg_created_date,spg_created_by,spg_updated_date,spg_updated_by) VALUES(?,?,?,?,?)", objPermissionGroupData.Spg_name, objPermissionGroupData.Create_date, objPermissionGroupData.Create_by, objPermissionGroupData.Create_date, objPermissionGroupData.Create_by)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}
	iLastID, err := objResult.LastInsertId()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}
	c.IndentedJSON(http.StatusOK, iLastID)
}
func UpdateSpg(c *gin.Context) {
	var objPermissionGroupData PermissionGroup
	if err := c.BindJSON(&objPermissionGroupData); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	TextTrim(&objPermissionGroupData.Spg_name, " ")
	objResult, err := db.Exec("Update sys_permission_group SET spg_name = ?, spg_updated_date = ?, spg_updated_by = ? WHERE spg_id = ?", objPermissionGroupData.Spg_name, objPermissionGroupData.Update_date, objPermissionGroupData.Update_by, objPermissionGroupData.Spg_id)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})
}
func SpgIsUnique(c *gin.Context) {
	var objPermissionGroupData PermissionGroup
	if err := c.BindJSON(&objPermissionGroupData); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	err := db.QueryRow("SELECT * FROM sys_permission_group WHERE spg_name= ? and spg_id != ?", objPermissionGroupData.Spg_name, objPermissionGroupData.Spg_id).Scan(&objPermissionGroupData.Spg_id, &objPermissionGroupData.Spg_name, &objPermissionGroupData.Spg_status, &objPermissionGroupData.Create_date, &objPermissionGroupData.Update_date, &objPermissionGroupData.Create_by, &objPermissionGroupData.Update_by)
	if err == sql.ErrNoRows {
		c.IndentedJSON(http.StatusOK, false)
		return
	}
	c.IndentedJSON(http.StatusOK, true)
}
func ChangeSpgStatus(c *gin.Context) {
	var objPermissionGroupData PermissionGroup
	if err := c.BindJSON(&objPermissionGroupData); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	objResult, err := db.Exec("Update sys_permission_group SET spg_status = ?, spg_updated_date = ?, spg_updated_by = ? WHERE spg_id = ?", objPermissionGroupData.Spg_status, objPermissionGroupData.Update_date, objPermissionGroupData.Update_by, objPermissionGroupData.Spg_id)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})
}

// permission detail ---------------------------
func ListSpdTable(c *gin.Context) {
	var objPermissionDetailArray []PermissionDetailTable
	iId := c.Param("id")
	objListPermissionDetail, err := db.Query("SELECT spd.spd_id, spd.spg_id, spd.spd_status, spd.spd_updated_date, spd.spd_updated_by, smd.smd_name,smd.smd_id, smg.smg_name,smg.smg_id,su.su_firstname, su.su_lastname, su.su_sign_path, su.su_sign_file"+
		" FROM `sys_permission_detail` AS spd"+
		" LEFT JOIN sys_permission_group AS spg ON spd.spg_id = spg.spg_id"+
		" LEFT JOIN sys_menu_detail AS smd ON spd.smd_id = smd.smd_id"+
		" LEFT JOIN sys_menu_group AS smg ON smd.smg_id = smg.smg_id"+
		" LEFT JOIN sys_users AS su ON spd.spd_updated_by = su.su_username"+
		" WHERE spd.spg_id = ? ORDER BY smg.smg_order_no, spd.spd_order_no", iId)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListPermissionDetail.Close()
	for objListPermissionDetail.Next() {
		var objPerDetail PermissionDetailTable
		var strUserFname sql.NullString
		var strUserLname sql.NullString
		var strUserImgPath sql.NullString
		var strUserImgName sql.NullString
		var strUpdateDate sql.NullString
		var strUpdateBy sql.NullString
		err := objListPermissionDetail.Scan(&objPerDetail.Spd_id, &objPerDetail.Spg_id, &objPerDetail.Spd_status, &strUpdateDate, &strUpdateBy, &objPerDetail.Smd_name, &objPerDetail.Smd_id, &objPerDetail.Smg_name, &objPerDetail.Smg_id, &strUserFname, &strUserLname, &strUserImgPath, &strUserImgName)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		if strUserFname.Valid {
			objPerDetail.Su_fname = strUserFname.String
		}
		if strUserLname.Valid {
			objPerDetail.Su_lname = strUserLname.String
		}
		if strUserImgPath.Valid {
			objPerDetail.Su_img_path = strUserImgPath.String
		}
		if strUserImgName.Valid {
			objPerDetail.Su_img_name = strUserImgName.String
		}
		if strUpdateDate.Valid {
			objPerDetail.Update_date = strUpdateDate.String
		}
		if strUpdateBy.Valid {
			objPerDetail.Update_by = strUpdateBy.String
		}
		objPermissionDetailArray = append(objPermissionDetailArray, objPerDetail)
	}
	err = objListPermissionDetail.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}

	var objData PermissionDetailData
	objData.Data = objPermissionDetailArray
	c.IndentedJSON(http.StatusOK, objData)
}
func SpdIsUnique(c *gin.Context) {
	var strPerDetail PermissionDetail
	if err := c.BindJSON(&strPerDetail); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	err := db.QueryRow("SELECT spd.*, smd.smd_name, smd.smd_id FROM `sys_permission_detail` AS spd"+
		" LEFT JOIN sys_menu_detail AS smd ON spd.smd_id = smd.smd_id"+
		" WHERE spd.spg_id = ? AND spd.smd_id = ? AND spd.spd_id !=?", strPerDetail.Spg_id, strPerDetail.Smd_id, strPerDetail.Spd_id).Scan(&strPerDetail.Spd_id, &strPerDetail.Spg_id, &strPerDetail.Spd_status, &strPerDetail.Create_date, &strPerDetail.Update_date, &strPerDetail.Create_by, &strPerDetail.Update_by, &strPerDetail.Smd_name, &strPerDetail.Smd_id, &strPerDetail.Order_no)
	if err == sql.ErrNoRows {
		c.IndentedJSON(http.StatusOK, false)
		return
	}
	c.IndentedJSON(http.StatusOK, true)
}
func InsertSpd(c *gin.Context) {
	var strPerDetail PermissionDetail
	var nextOrder int

	if err := c.BindJSON(&strPerDetail); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}

	query := `SELECT COUNT(smg.smg_id) + 1 AS next_order FROM sys_permission_detail AS spd LEFT JOIN sys_menu_detail AS smd ON spd.smd_id = smd.smd_id LEFT JOIN sys_menu_group AS smg ON smd.smg_id = smg.smg_id WHERE spd.spg_id = ? AND smd_status = 1 AND spd_status = 1 AND smg.smg_id = (SELECT smg_id FROM sys_menu_detail WHERE smd_id = ?)`

	err := db.QueryRow(query, strPerDetail.Spg_id, strPerDetail.Smd_id).Scan(&nextOrder)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}
	objResult, err := db.Exec("INSERT INTO sys_permission_detail(spg_id, smd_id, spd_order_no,spd_created_date, spd_created_by, spd_updated_date, spd_updated_by) VALUES(?,?,?,?,?,?,?)", strPerDetail.Spg_id, strPerDetail.Smd_id, nextOrder, strPerDetail.Create_date, strPerDetail.Create_by, strPerDetail.Create_date, strPerDetail.Create_by)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}
	iLastID, err := objResult.LastInsertId()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}
	c.IndentedJSON(http.StatusOK, iLastID)
}
func UpdateSpd(c *gin.Context) {
	var strPerDetail PermissionDetail
	if err := c.BindJSON(&strPerDetail); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	objResult, err := db.Exec("Update sys_permission_detail SET smd_id = ?, spd_updated_date = ?, spd_updated_by = ? WHERE spd_id = ?", strPerDetail.Smd_id, strPerDetail.Update_date, strPerDetail.Update_by, strPerDetail.Spd_id)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})
}
func ChangeSpdStatus(c *gin.Context) {
	var strPerDetail PermissionDetail
	if err := c.BindJSON(&strPerDetail); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	objResult, err := db.Exec("Update sys_permission_detail SET spd_status = ?, spd_updated_date = ?, spd_updated_by = ? WHERE spd_id = ?", strPerDetail.Spd_status, strPerDetail.Update_date, strPerDetail.Update_by, strPerDetail.Spd_id)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})
}
