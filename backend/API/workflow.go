package API

import (
	"database/sql"
	"net/http"

	"github.com/gin-gonic/gin"
)

// WorkflowGroup ---------------------------
func ListWorkflowGroupTable(c *gin.Context) {
	var objWorkflowGroupList []WorkflowGroupTable
	objListWorkflowg, err := db.Query("SELECT swg.*, su.su_fname, su.su_lname, su.su_img_path, su.su_img_name FROM `sys_workflow_group` AS swg LEFT JOIN sys_user AS su ON swg.update_by = su.su_emp_code ORDER BY swg.swg_id")
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListWorkflowg.Close()
	for objListWorkflowg.Next() {
		var objWorkflowg WorkflowGroupTable
		var strUserFname sql.NullString
		var strUserLname sql.NullString
		var strUserImgPath sql.NullString
		var strUserImgName sql.NullString
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString
		err := objListWorkflowg.Scan(&objWorkflowg.Swg_id, &objWorkflowg.Swg_name, &objWorkflowg.Swg_max_lv, &objWorkflowg.Swg_status, &strCreateDate, &strUpdateDate, &strCreateBy, &strUpdateBy, &strUserFname, &strUserLname, &strUserImgPath, &strUserImgName)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		if strUserFname.Valid {
			objWorkflowg.Su_fname = strUserFname.String
		}
		if strUserLname.Valid {
			objWorkflowg.Su_lname = strUserLname.String
		}
		if strUserImgPath.Valid {
			objWorkflowg.Su_img_path = strUserImgPath.String
		}
		if strUserImgName.Valid {
			objWorkflowg.Su_img_name = strUserImgName.String
		}
		if strCreateDate.Valid {
			objWorkflowg.Create_date = strCreateDate.String
		}
		if strUpdateDate.Valid {
			objWorkflowg.Update_date = strUpdateDate.String
		}
		if strCreateBy.Valid {
			objWorkflowg.Create_by = strCreateBy.String
		}
		if strUpdateBy.Valid {
			objWorkflowg.Update_by = strUpdateBy.String
		}
		objWorkflowGroupList = append(objWorkflowGroupList, objWorkflowg)
	}
	err = objListWorkflowg.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}

	var objData WorkflowGroupData
	objData.Data = objWorkflowGroupList
	c.IndentedJSON(http.StatusOK, objData)
}
func ListWorkflowGroupById(c *gin.Context) {
	var objWorkflowGroupData WorkflowGroup
	iId := c.Param("id")
	var strCreateDate sql.NullString
	var strUpdateDate sql.NullString
	var strCreateBy sql.NullString
	var strUpdateBy sql.NullString
	err := db.QueryRow("SELECT * FROM `sys_workflow_group` WHERE swg_id= ?", iId).Scan(&objWorkflowGroupData.Swg_id, &objWorkflowGroupData.Swg_name, &objWorkflowGroupData.Swg_max_lv, &objWorkflowGroupData.Swg_status, &strCreateDate, &strUpdateDate, &strCreateBy, &strUpdateBy)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	if strCreateDate.Valid {
		objWorkflowGroupData.Create_date = strCreateDate.String
	}
	if strUpdateDate.Valid {
		objWorkflowGroupData.Update_date = strUpdateDate.String
	}
	if strCreateBy.Valid {
		objWorkflowGroupData.Create_by = strCreateBy.String
	}
	if strUpdateBy.Valid {
		objWorkflowGroupData.Update_by = strUpdateBy.String
	}
	c.IndentedJSON(http.StatusOK, objWorkflowGroupData)
}
func SwgIsUnique(c *gin.Context) {
	var objWorkflowGroupData WorkflowGroup
	if err := c.BindJSON(&objWorkflowGroupData); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	err := db.QueryRow("SELECT * FROM sys_workflow_group WHERE swg_name= ? and swg_id != ?", objWorkflowGroupData.Swg_name, objWorkflowGroupData.Swg_id).Scan(&objWorkflowGroupData.Swg_id, &objWorkflowGroupData.Swg_name, &objWorkflowGroupData.Swg_max_lv, &objWorkflowGroupData.Swg_status, &objWorkflowGroupData.Create_date, &objWorkflowGroupData.Update_date, &objWorkflowGroupData.Create_by, &objWorkflowGroupData.Update_by)
	if err == sql.ErrNoRows {
		c.IndentedJSON(http.StatusOK, false)
		return
	}
	c.IndentedJSON(http.StatusOK, true)
}
func InsertSwg(c *gin.Context) {
	var objWorkflowGroupData WorkflowGroup
	if err := c.BindJSON(&objWorkflowGroupData); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	objResult, err := db.Exec("INSERT INTO sys_workflow_group(swg_name,swg_max_lv,create_date,create_by) VALUES(?,?,?,?)", objWorkflowGroupData.Swg_name, objWorkflowGroupData.Swg_max_lv, objWorkflowGroupData.Create_date, objWorkflowGroupData.Create_by)
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
func UpdateSwg(c *gin.Context) {
	var objWorkflowGroupData WorkflowGroup
	if err := c.BindJSON(&objWorkflowGroupData); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	objResult, err := db.Exec("Update sys_workflow_group SET swg_name = ?, swg_max_lv = ?,update_date = ?, update_by = ? WHERE swg_id = ?", objWorkflowGroupData.Swg_name, objWorkflowGroupData.Swg_max_lv, objWorkflowGroupData.Update_date, objWorkflowGroupData.Update_by, objWorkflowGroupData.Swg_id)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})
}
func ChangeSwgStatus(c *gin.Context) {
	var objWorkflowGroupData WorkflowGroup
	if err := c.BindJSON(&objWorkflowGroupData); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	objResult, err := db.Exec("Update sys_workflow_group SET swg_status = ? WHERE swg_id = ?", objWorkflowGroupData.Swg_status, objWorkflowGroupData.Swg_id)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})
}

// WorkflowDetail ---------------------------
func ListWorkflowDetailTable(c *gin.Context) {
	var objWorkflowDetailList []WorkflowDetailTable
	iId := c.Param("id")
	objListWorkflowd, err := db.Query("SELECT swd.*,CONCAT(suall.su_fname,' ',suall.su_lname) AS fullname, swg.swg_name, sat.sat_name, su.su_fname, su.su_lname, su.su_img_path, su.su_img_name FROM `sys_workflow_detail` AS swd LEFT JOIN sys_workflow_group AS swg ON swd.swg_id = swg.swg_id LEFT JOIN sys_approve_type AS sat ON swd.sat_id = sat.sat_id LEFT JOIN sys_user AS su ON swd.update_by = su.su_emp_code LEFT JOIN sys_user AS suall ON swd.su_id = suall.su_id WHERE swd.swg_id = ? ORDER BY swd.swd_id", iId)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListWorkflowd.Close()
	for objListWorkflowd.Next() {
		var objWorkflowd WorkflowDetailTable
		var strUserFname sql.NullString
		var strUserLname sql.NullString
		var strUserImgPath sql.NullString
		var strUserImgName sql.NullString
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString
		err := objListWorkflowd.Scan(&objWorkflowd.Swd_id, &objWorkflowd.Swd_app_lv, &objWorkflowd.Su_id, &objWorkflowd.Swg_id, &objWorkflowd.Sat_id, &objWorkflowd.Swd_status, &strCreateDate, &strUpdateDate, &strCreateBy, &strUpdateBy, &objWorkflowd.Fullname, &objWorkflowd.Swg_name, &objWorkflowd.Sat_name, &strUserFname, &strUserLname, &strUserImgPath, &strUserImgName)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		if strUserFname.Valid {
			objWorkflowd.Su_fname = strUserFname.String
		}
		if strUserLname.Valid {
			objWorkflowd.Su_lname = strUserLname.String
		}
		if strUserImgPath.Valid {
			objWorkflowd.Su_img_path = strUserImgPath.String
		}
		if strUserImgName.Valid {
			objWorkflowd.Su_img_name = strUserImgName.String
		}
		if strCreateDate.Valid {
			objWorkflowd.Create_date = strCreateDate.String
		}
		if strUpdateDate.Valid {
			objWorkflowd.Update_date = strUpdateDate.String
		}
		if strCreateBy.Valid {
			objWorkflowd.Create_by = strCreateBy.String
		}
		if strUpdateBy.Valid {
			objWorkflowd.Update_by = strUpdateBy.String
		}
		objWorkflowDetailList = append(objWorkflowDetailList, objWorkflowd)
	}
	err = objListWorkflowd.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}

	var objData WorkflowDetailData
	objData.Data = objWorkflowDetailList
	c.IndentedJSON(http.StatusOK, objData)
}
func SwdIsUnique(c *gin.Context) {
	var objWorkflowDetail WorkflowDetail
	if err := c.BindJSON(&objWorkflowDetail); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	err := db.QueryRow("SELECT * FROM sys_workflow_detail WHERE swd_app_lv= ? and swg_id= ? and swd_id != ?", objWorkflowDetail.Swd_app_lv, objWorkflowDetail.Swg_id, objWorkflowDetail.Swd_id).Scan(&objWorkflowDetail.Swd_id, &objWorkflowDetail.Swd_app_lv, &objWorkflowDetail.Su_id, &objWorkflowDetail.Swg_id, &objWorkflowDetail.Sat_id, &objWorkflowDetail.Swd_status, &objWorkflowDetail.Create_date, &objWorkflowDetail.Update_date, &objWorkflowDetail.Create_by, &objWorkflowDetail.Update_by)
	if err == sql.ErrNoRows {
		c.IndentedJSON(http.StatusOK, false)
		return
	}
	c.IndentedJSON(http.StatusOK, true)
}
func InsertSwd(c *gin.Context) {
	var objWorkflowDetail WorkflowDetail
	if err := c.BindJSON(&objWorkflowDetail); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	objResult, err := db.Exec("INSERT INTO sys_workflow_detail(swd_app_lv,su_id,swg_id,sat_id,create_date,create_by) VALUES(?,?,?,?,?,?)", objWorkflowDetail.Swd_app_lv, objWorkflowDetail.Su_id, objWorkflowDetail.Swg_id, objWorkflowDetail.Sat_id, objWorkflowDetail.Create_date, objWorkflowDetail.Create_by)
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
func UpdateSwd(c *gin.Context) {
	var objWorkflowDetail WorkflowDetail
	if err := c.BindJSON(&objWorkflowDetail); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	objResult, err := db.Exec("Update sys_workflow_detail SET su_id = ?, sat_id = ?,update_date = ?, update_by = ? WHERE swd_id = ?", objWorkflowDetail.Su_id, objWorkflowDetail.Sat_id, objWorkflowDetail.Update_date, objWorkflowDetail.Update_by, objWorkflowDetail.Swd_id)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})
}
func ChangeSwdStatus(c *gin.Context) {
	var objWorkflowDetail WorkflowDetail
	if err := c.BindJSON(&objWorkflowDetail); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	objResult, err := db.Exec("Update sys_workflow_detail SET swd_status = ? WHERE swd_id = ?", objWorkflowDetail.Swd_status, objWorkflowDetail.Swd_id)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})
}
