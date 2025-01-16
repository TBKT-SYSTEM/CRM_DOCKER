package API

import (
	"database/sql"
	"net/http"

	"github.com/gin-gonic/gin"
)

func ListPlant(c *gin.Context) {
	var objPlantList []Plant
	objListPlant, err := db.Query("SELECT * FROM `sys_plant_code` WHERE spc_status=1")
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListPlant.Close()
	for objListPlant.Next() {
		var objPlant Plant
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString
		err := objListPlant.Scan(&objPlant.Spc_id, &objPlant.Spc_code, &objPlant.Spc_name, &objPlant.Spc_status, &strCreateDate, &strUpdateDate, &strCreateBy, &strUpdateBy)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		if strCreateDate.Valid {
			objPlant.Create_date = strCreateDate.String
		}
		if strUpdateDate.Valid {
			objPlant.Update_date = strUpdateDate.String
		}
		if strCreateBy.Valid {
			objPlant.Create_by = strCreateBy.String
		}
		if strUpdateBy.Valid {
			objPlant.Update_by = strUpdateBy.String
		}
		objPlantList = append(objPlantList, objPlant)
	}
	err = objListPlant.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, objPlantList)
}
func ListPermissionGroup(c *gin.Context) {
	var objPermissionGroup []PermissionGroup
	objListPermissionGroup, err := db.Query("SELECT * FROM `sys_permission_group` WHERE spg_status=1")
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListPermissionGroup.Close()
	for objListPermissionGroup.Next() {
		var objPerGroup PermissionGroup
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString
		err := objListPermissionGroup.Scan(&objPerGroup.Spg_id, &objPerGroup.Spg_name, &objPerGroup.Spg_status, &strCreateDate, &strUpdateDate, &strCreateBy, &strUpdateBy)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		if strCreateDate.Valid {
			objPerGroup.Create_date = strCreateDate.String
		}
		if strUpdateDate.Valid {
			objPerGroup.Update_date = strUpdateDate.String
		}
		if strCreateBy.Valid {
			objPerGroup.Create_by = strCreateBy.String
		}
		if strUpdateBy.Valid {
			objPerGroup.Update_by = strUpdateBy.String
		}
		objPermissionGroup = append(objPermissionGroup, objPerGroup)
	}
	err = objListPermissionGroup.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, objPermissionGroup)
}
func ListMenuGroup(c *gin.Context) {
	var objMenuGroupList []MenuGroup
	objListMenug, err := db.Query("SELECT * FROM `sys_menu_group` WHERE smg_status=1")
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListMenug.Close()
	for objListMenug.Next() {
		var objMenug MenuGroup
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString
		err := objListMenug.Scan(&objMenug.Smg_id, &objMenug.Smg_name, &objMenug.Smg_icon, &objMenug.Smg_order, &objMenug.Smg_status, &strCreateDate, &strUpdateDate, &strCreateBy, &strUpdateBy)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		if strCreateDate.Valid {
			objMenug.Create_date = strCreateDate.String
		}
		if strUpdateDate.Valid {
			objMenug.Update_date = strUpdateDate.String
		}
		if strCreateBy.Valid {
			objMenug.Create_by = strCreateBy.String
		}
		if strUpdateBy.Valid {
			objMenug.Update_by = strUpdateBy.String
		}
		objMenuGroupList = append(objMenuGroupList, objMenug)
	}
	err = objListMenug.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, objMenuGroupList)
}
func ListMenuDetail(c *gin.Context) {
	var objMenuDetailList []MenuDetail
	objListMenud, err := db.Query("SELECT * FROM `sys_menu_detail` WHERE smd_status=1")
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListMenud.Close()
	for objListMenud.Next() {
		var objMenud MenuDetail
		var strOrderNo sql.NullInt64
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString
		err := objListMenud.Scan(&objMenud.Smd_id, &objMenud.Smg_id, &objMenud.Smd_name, &objMenud.Smd_link, &strOrderNo, &objMenud.Smd_status, &strCreateDate, &strCreateBy, &strUpdateDate, &strUpdateBy)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		if strCreateDate.Valid {
			objMenud.Create_date = strCreateDate.String
		}
		if strUpdateDate.Valid {
			objMenud.Update_date = strUpdateDate.String
		}
		if strCreateBy.Valid {
			objMenud.Create_by = strCreateBy.String
		}
		if strUpdateBy.Valid {
			objMenud.Update_by = strUpdateBy.String
		}
		if strOrderNo.Valid {
			objMenud.Smd_order_no = int(strOrderNo.Int64)
		}
		objMenuDetailList = append(objMenuDetailList, objMenud)
	}
	err = objListMenud.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, objMenuDetailList)
}
func ListMenuDetailById(c *gin.Context) {
	var objMenuDetailList []MenuDetail
	objListMenud, err := db.Query("SELECT * FROM `sys_menu_detail` WHERE smd_status=1 AND smg_id=?", c.Param("id"))
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListMenud.Close()
	for objListMenud.Next() {
		var objMenud MenuDetail
		var strOrderNo sql.NullInt64
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString

		err := objListMenud.Scan(&objMenud.Smd_id, &objMenud.Smg_id, &objMenud.Smd_name, &objMenud.Smd_link, &strOrderNo, &objMenud.Smd_status, &strCreateDate, &strUpdateDate, &strCreateBy, &strUpdateBy)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		if strCreateDate.Valid {
			objMenud.Create_date = strCreateDate.String
		}
		if strUpdateDate.Valid {
			objMenud.Update_date = strUpdateDate.String
		}
		if strCreateBy.Valid {
			objMenud.Create_by = strCreateBy.String
		}
		if strUpdateBy.Valid {
			objMenud.Update_by = strUpdateBy.String
		}
		if strOrderNo.Valid {
			objMenud.Smd_order_no = int(strOrderNo.Int64)
		}
		objMenuDetailList = append(objMenuDetailList, objMenud)
	}
	err = objListMenud.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, objMenuDetailList)
}
func ListWorkflowGroup(c *gin.Context) {
	var objWorkflowGroupList []WorkflowGroup
	objListWorkflowg, err := db.Query("SELECT swg.*, sd.sd_dept_name FROM `sys_workflow_group` AS swg LEFT JOIN sys_department AS sd ON swg.sd_id = sd.sd_id  WHERE swg.swg_status = 1")
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListWorkflowg.Close()
	for objListWorkflowg.Next() {
		var workflowg WorkflowGroup
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString
		err := objListWorkflowg.Scan(&workflowg.Swg_id, &workflowg.Sd_id, &workflowg.Swg_max_lv, &workflowg.Swg_status, &strCreateDate, &strUpdateDate, &strCreateBy, &strUpdateBy, &workflowg.Sd_dept_name)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		if strCreateDate.Valid {
			workflowg.Create_date = strCreateDate.String
		}
		if strUpdateDate.Valid {
			workflowg.Update_date = strUpdateDate.String
		}
		if strCreateBy.Valid {
			workflowg.Create_by = strCreateBy.String
		}
		if strUpdateBy.Valid {
			workflowg.Update_by = strUpdateBy.String
		}
		objWorkflowGroupList = append(objWorkflowGroupList, workflowg)
	}
	err = objListWorkflowg.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, objWorkflowGroupList)
}
func ListRequirementType(c *gin.Context) {
	var objRequirmentList []RequirementType
	objListRequirement, err := db.Query("SELECT * FROM `mst_requirement_type` WHERE mrt_status=1")
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListRequirement.Close()
	for objListRequirement.Next() {
		var objRequire RequirementType
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString
		err := objListRequirement.Scan(&objRequire.Mrt_id, &objRequire.Mrt_name, &objRequire.Mrt_status, &strCreateDate, &strUpdateDate, &strCreateBy, &strUpdateBy)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		if strCreateDate.Valid {
			objRequire.Create_date = strCreateDate.String
		}
		if strUpdateDate.Valid {
			objRequire.Update_date = strUpdateDate.String
		}
		if strCreateBy.Valid {
			objRequire.Create_by = strCreateBy.String
		}
		if strUpdateBy.Valid {
			objRequire.Update_by = strUpdateBy.String
		}
		objRequirmentList = append(objRequirmentList, objRequire)
	}
	err = objListRequirement.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, objRequirmentList)
}
func ListSubject(c *gin.Context) {
	var objDocSubjectList []DocSubject
	objListDocSubject, err := db.Query("SELECT * FROM `mst_document_subject` WHERE mds_status = 1 ORDER BY mds_id")
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListDocSubject.Close()
	for objListDocSubject.Next() {
		var objRequire DocSubject
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString
		err := objListDocSubject.Scan(&objRequire.Mds_id, &objRequire.Mds_name, &objRequire.Mds_required, &objRequire.Mds_status, &strCreateDate, &strCreateBy, &strUpdateDate, &strUpdateBy)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		if strCreateDate.Valid {
			objRequire.Create_date = strCreateDate.String
		}
		if strUpdateDate.Valid {
			objRequire.Update_date = strUpdateDate.String
		}
		if strCreateBy.Valid {
			objRequire.Create_by = strCreateBy.String
		}
		if strUpdateBy.Valid {
			objRequire.Update_by = strUpdateBy.String
		}
		objDocSubjectList = append(objDocSubjectList, objRequire)
	}
	err = objListDocSubject.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, objDocSubjectList)
}
func ListEnclosures(c *gin.Context) {
	var objDocSubjectList []DocEnclosures
	objListDocSubject, err := db.Query("SELECT * FROM `mst_document_enclosures` WHERE mde_status = 1 ORDER BY mde_id")
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListDocSubject.Close()
	for objListDocSubject.Next() {
		var objRequire DocEnclosures
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString
		err := objListDocSubject.Scan(&objRequire.Mde_id, &objRequire.Mde_name, &objRequire.Mde_required, &objRequire.Mde_status, &strCreateDate, &strCreateBy, &strUpdateDate, &strUpdateBy)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		if strCreateDate.Valid {
			objRequire.Create_date = strCreateDate.String
		}
		if strUpdateDate.Valid {
			objRequire.Update_date = strUpdateDate.String
		}
		if strCreateBy.Valid {
			objRequire.Create_by = strCreateBy.String
		}
		if strUpdateBy.Valid {
			objRequire.Update_by = strUpdateBy.String
		}
		objDocSubjectList = append(objDocSubjectList, objRequire)
	}
	err = objListDocSubject.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, objDocSubjectList)
}
func ListImportFrom(c *gin.Context) {
	var objImportFromList []ImportFrom
	objListImportFrom, err := db.Query("SELECT * FROM `mst_import_from` WHERE mif_status = 1")
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListImportFrom.Close()
	for objListImportFrom.Next() {
		var objRequire ImportFrom
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString
		err := objListImportFrom.Scan(&objRequire.Mif_id, &objRequire.Mif_name, &objRequire.Mif_status, &strCreateDate, &strUpdateDate, &strCreateBy, &strUpdateBy)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		if strCreateDate.Valid {
			objRequire.Create_date = strCreateDate.String
		}
		if strUpdateDate.Valid {
			objRequire.Update_date = strUpdateDate.String
		}
		if strCreateBy.Valid {
			objRequire.Create_by = strCreateBy.String
		}
		if strUpdateBy.Valid {
			objRequire.Update_by = strUpdateBy.String
		}
		objImportFromList = append(objImportFromList, objRequire)
	}
	err = objListImportFrom.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, objImportFromList)
}
func ListRequirementCus(c *gin.Context) {
	var objRequirmentList []RequirementCus
	objListRequirement, err := db.Query("SELECT * FROM `mst_customer` WHERE mct_status=1")
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListRequirement.Close()
	for objListRequirement.Next() {
		var objRequire RequirementCus
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString
		err := objListRequirement.Scan(&objRequire.Mct_id, &objRequire.Mct_name, &objRequire.Mct_status, &strCreateDate, &strUpdateDate, &strCreateBy, &strUpdateBy)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		if strCreateDate.Valid {
			objRequire.Create_date = strCreateDate.String
		}
		if strUpdateDate.Valid {
			objRequire.Update_date = strUpdateDate.String
		}
		if strCreateBy.Valid {
			objRequire.Create_by = strCreateBy.String
		}
		if strUpdateBy.Valid {
			objRequire.Update_by = strUpdateBy.String
		}
		objRequirmentList = append(objRequirmentList, objRequire)
	}
	err = objListRequirement.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, objRequirmentList)
}
func ListUsers(c *gin.Context) {
	var objUserSessionList []UserSession
	objListUser, err := db.Query("SELECT su.*,sd.sd_dept_name,spg.spg_name FROM `sys_users` AS su LEFT JOIN sys_department AS sd ON su.sd_id = sd.sd_id LEFT JOIN sys_permission_group AS spg ON su.spg_id = spg.spg_id WHERE su.su_status=1")
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListUser.Close()
	for objListUser.Next() {
		var objUsers UserSession

		var strDept sql.NullInt64
		var strDeptName sql.NullString
		var strUserSingPath sql.NullString
		var strUserSingFile sql.NullString
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString

		err := objListUser.Scan(&objUsers.Su_id, &objUsers.Spg_id, &objUsers.Su_username, &objUsers.Su_password, &objUsers.Su_firstname, &objUsers.Su_lastname, &objUsers.Su_email, &strDept, &strUserSingPath, &strUserSingFile, &objUsers.Su_status, &strCreateDate, &strCreateBy, &strUpdateDate, &strUpdateBy, &objUsers.Su_last_accress, &strDeptName, &objUsers.Spg_name)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		StringReplace(&objUsers.Sd_dept_name, "\u0026", "&", 1)
		if strDeptName.Valid {
			objUsers.Sd_dept_name = strDeptName.String
		}
		if strUserSingPath.Valid {
			objUsers.Su_sign_path = strUserSingPath.String
		}
		if strUserSingFile.Valid {
			objUsers.Su_sign_file = strUserSingFile.String
		}
		if strCreateDate.Valid {
			objUsers.Create_date = strCreateDate.String
		}
		if strUpdateDate.Valid {
			objUsers.Update_date = strUpdateDate.String
		}
		if strCreateBy.Valid {
			objUsers.Create_by = strCreateBy.String
		}
		if strUpdateBy.Valid {
			objUsers.Update_by = strUpdateBy.String
		}
		if strDept.Valid {
			objUsers.Sd_id = int(strDept.Int64)
		}
		objUserSessionList = append(objUserSessionList, objUsers)
	}
	err = objListUser.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}

	c.IndentedJSON(http.StatusOK, objUserSessionList)
}
func ListUsersByDept(c *gin.Context) {
	var objUserSessionList []UserSession
	objListUser, err := db.Query("SELECT su.*, sd.sd_dept_name, spg.spg_name FROM `sys_users` AS su LEFT JOIN sys_department AS sd ON su.sd_id = sd.sd_id LEFT JOIN sys_permission_group AS spg ON su.spg_id = spg.spg_id WHERE su.su_status = 1 AND su.sd_id = ? AND su.sd_id <> '' ", c.Param("id"))

	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListUser.Close()
	for objListUser.Next() {
		var objUsers UserSession

		var strDept sql.NullInt64
		var strDeptName sql.NullString
		var strUserSingPath sql.NullString
		var strUserSingFile sql.NullString
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString

		err := objListUser.Scan(&objUsers.Su_id, &objUsers.Spg_id, &objUsers.Su_username, &objUsers.Su_password, &objUsers.Su_firstname, &objUsers.Su_lastname, &objUsers.Su_email, &strDept, &strUserSingPath, &strUserSingFile, &objUsers.Su_status, &strCreateDate, &strCreateBy, &strUpdateDate, &strUpdateBy, &objUsers.Su_last_accress, &strDeptName, &objUsers.Spg_name)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		StringReplace(&objUsers.Sd_dept_name, "\u0026", "&", 1)
		if strDeptName.Valid {
			objUsers.Sd_dept_name = strDeptName.String
		}
		if strUserSingPath.Valid {
			objUsers.Su_sign_path = strUserSingPath.String
		}
		if strUserSingFile.Valid {
			objUsers.Su_sign_file = strUserSingFile.String
		}
		if strCreateDate.Valid {
			objUsers.Create_date = strCreateDate.String
		}
		if strUpdateDate.Valid {
			objUsers.Update_date = strUpdateDate.String
		}
		if strCreateBy.Valid {
			objUsers.Create_by = strCreateBy.String
		}
		if strUpdateBy.Valid {
			objUsers.Update_by = strUpdateBy.String
		}
		if strDept.Valid {
			objUsers.Sd_id = int(strDept.Int64)
		}
		objUserSessionList = append(objUserSessionList, objUsers)
	}
	err = objListUser.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}

	c.IndentedJSON(http.StatusOK, objUserSessionList)
}
func ListApproveType(c *gin.Context) {
	var objApproveTypeList []ApproveType
	objListApproveType, err := db.Query("SELECT * FROM `sys_approve_type` WHERE sat_status=1")
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListApproveType.Close()
	for objListApproveType.Next() {
		var objAppType ApproveType
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString
		err := objListApproveType.Scan(&objAppType.Sat_id, &objAppType.Sat_name, &objAppType.Sat_status, &strCreateDate, &strUpdateDate, &strCreateBy, &strUpdateBy)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		if strCreateDate.Valid {
			objAppType.Create_date = strCreateDate.String
		}
		if strUpdateDate.Valid {
			objAppType.Update_date = strUpdateDate.String
		}
		if strCreateBy.Valid {
			objAppType.Create_by = strCreateBy.String
		}
		if strUpdateBy.Valid {
			objAppType.Update_by = strUpdateBy.String
		}
		objApproveTypeList = append(objApproveTypeList, objAppType)
	}
	err = objListApproveType.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, objApproveTypeList)
}
func ListDepartment(c *gin.Context) {
	var objDepartmentList []Department
	objListDepartment, err := db.Query("SELECT * FROM `sys_department` WHERE sd_status = 1")
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListDepartment.Close()
	for objListDepartment.Next() {
		var objDepartment Department
		var strAName sql.NullString
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString
		err := objListDepartment.Scan(&objDepartment.Sd_id, &objDepartment.Sd_plant_cd, &objDepartment.Sd_name_cd, &objDepartment.Sd_name, &strAName, &objDepartment.Sd_status, &strCreateDate, &strUpdateDate, &strCreateBy, &strUpdateBy)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		if strAName.Valid {
			objDepartment.Sd_Aname = strAName.String
		}
		if strCreateDate.Valid {
			objDepartment.Create_date = strCreateDate.String
		}
		if strUpdateDate.Valid {
			objDepartment.Update_date = strUpdateDate.String
		}
		if strCreateBy.Valid {
			objDepartment.Create_by = strCreateBy.String
		}
		if strUpdateBy.Valid {
			objDepartment.Update_by = strUpdateBy.String
		}
		objDepartmentList = append(objDepartmentList, objDepartment)
	}
	err = objListDepartment.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, objDepartmentList)
}
func ListConsiderationScore(c *gin.Context) {
	var objFeasibilityScoreList []ViewFeasibilityScore
	id := c.Param("id")
	objListScore, err := db.Query("SELECT mc.*, ifcp.ifcp_score, ifcp.ifcp_comment, ifcp.ifcp_file_name, ifcp.ifcp_file_path,ifcp.ifcp_submit FROM `mst_consideration` AS mc LEFT JOIN (SELECT * FROM info_feasibility_consern_point WHERE if_id = ?) AS ifcp ON mc.mc_id = ifcp.mc_id WHERE mc.mc_status =1 ORDER BY mc.mc_id", id)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListScore.Close()
	for objListScore.Next() {
		var objConsider ViewFeasibilityScore
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString
		var fScore sql.NullFloat64
		var strComment sql.NullString
		var strFileName sql.NullString
		var strFilePath sql.NullString
		var iSubmit sql.NullInt64
		err := objListScore.Scan(&objConsider.Mc_id, &objConsider.Mc_title, &objConsider.Mc_weight, &objConsider.Mc_status, &strCreateDate, &strUpdateDate, &strCreateBy, &strUpdateBy, &fScore, &strComment, &strFileName, &strFilePath, &iSubmit)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		if strCreateDate.Valid {
			objConsider.Create_date = strCreateDate.String
		}
		if strUpdateDate.Valid {
			objConsider.Update_date = strUpdateDate.String
		}
		if strCreateBy.Valid {
			objConsider.Create_by = strCreateBy.String
		}
		if strUpdateBy.Valid {
			objConsider.Update_by = strUpdateBy.String
		}
		if fScore.Valid {
			objConsider.Ifcp_score = fScore.Float64
		}
		if strComment.Valid {
			objConsider.Ifcp_comment = strComment.String
		}
		if strFileName.Valid {
			objConsider.Ifcp_file_name = strFileName.String
		}
		if strFilePath.Valid {
			objConsider.Ifcp_file_path = strFilePath.String
		}
		if iSubmit.Valid {
			objConsider.Ifcp_submit = int(iSubmit.Int64)
		}
		objFeasibilityScoreList = append(objFeasibilityScoreList, objConsider)
	}
	err = objListScore.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, objFeasibilityScoreList)
}
func ListDocType(c *gin.Context) {
	var objMenuGroupList []DocumentType
	objListDocType, err := db.Query("SELECT * FROM `mst_document_type` WHERE mdt_status = 1")
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListDocType.Close()
	for objListDocType.Next() {
		var objDocType DocumentType
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString
		err := objListDocType.Scan(&objDocType.Mdt_id, &objDocType.Mdt_name, &objDocType.Mdt_position1, &objDocType.Mdt_position2, &objDocType.Map_id, &objDocType.Mdt_status, &strCreateDate, &strUpdateDate, &strCreateBy, &strUpdateBy)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		if strCreateDate.Valid {
			objDocType.Create_date = strCreateDate.String
		}
		if strUpdateDate.Valid {
			objDocType.Update_date = strUpdateDate.String
		}
		if strCreateBy.Valid {
			objDocType.Create_by = strCreateBy.String
		}
		if strUpdateBy.Valid {
			objDocType.Update_by = strUpdateBy.String
		}

		objMenuGroupList = append(objMenuGroupList, objDocType)
	}
	err = objListDocType.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, objMenuGroupList)
}
func ListApprovePattern(c *gin.Context) {
	var objAppPatternGroupList []ApprovePattern
	objListAppPattern, err := db.Query("SELECT * FROM `mst_approve_pattern` WHERE map_status = 1")
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListAppPattern.Close()
	for objListAppPattern.Next() {
		var objDocType ApprovePattern
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString
		err := objListAppPattern.Scan(&objDocType.Map_id, &objDocType.Map_name, &objDocType.Map_detail, &objDocType.Map_status, &strCreateDate, &strUpdateDate, &strCreateBy, &strUpdateBy)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		if strCreateDate.Valid {
			objDocType.Create_date = strCreateDate.String
		}
		if strUpdateDate.Valid {
			objDocType.Update_date = strUpdateDate.String
		}
		if strCreateBy.Valid {
			objDocType.Create_by = strCreateBy.String
		}
		if strUpdateBy.Valid {
			objDocType.Update_by = strUpdateBy.String
		}
		objAppPatternGroupList = append(objAppPatternGroupList, objDocType)
	}
	err = objListAppPattern.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, objAppPatternGroupList)
}
func ListAttn(c *gin.Context) {
	var objAttnGroupList []Attn
	objListAttn, err := db.Query("SELECT * FROM `mst_document_attn` WHERE mda_status = 1")
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListAttn.Close()
	for objListAttn.Next() {
		var objAttn Attn
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString
		err := objListAttn.Scan(&objAttn.Mda_id, &objAttn.Mda_name, &objAttn.Sd_id, &objAttn.Mda_status, &strCreateDate, &strCreateBy, &strUpdateDate, &strUpdateBy)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		if strCreateDate.Valid {
			objAttn.Create_date = strCreateDate.String
		}
		if strUpdateDate.Valid {
			objAttn.Update_date = strUpdateDate.String
		}
		if strCreateBy.Valid {
			objAttn.Create_by = strCreateBy.String
		}
		if strUpdateBy.Valid {
			objAttn.Update_by = strUpdateBy.String
		}
		objAttnGroupList = append(objAttnGroupList, objAttn)
	}
	err = objListAttn.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, objAttnGroupList)
}
func ListPurchase(c *gin.Context) {
	var objPurchaseGroupList []Purchase
	objListPurchase, err := db.Query("SELECT * FROM `mst_document_purchase` WHERE mdpu_status = 1 ORDER BY mdpu_id")
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListPurchase.Close()
	for objListPurchase.Next() {
		var objAttn Purchase
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString
		err := objListPurchase.Scan(&objAttn.Mdpu_id, &objAttn.Mdpu_name, &objAttn.Mdpu_required, &objAttn.Mdpu_status, &strCreateDate, &strCreateBy, &strUpdateDate, &strUpdateBy)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		if strCreateDate.Valid {
			objAttn.Create_date = strCreateDate.String
		}
		if strUpdateDate.Valid {
			objAttn.Update_date = strUpdateDate.String
		}
		if strCreateBy.Valid {
			objAttn.Create_by = strCreateBy.String
		}
		if strUpdateBy.Valid {
			objAttn.Update_by = strUpdateBy.String
		}
		objPurchaseGroupList = append(objPurchaseGroupList, objAttn)
	}
	err = objListPurchase.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, objPurchaseGroupList)
}
func ListPacking(c *gin.Context) {
	var objPackingGroupList []Packing
	objListPacking, err := db.Query("SELECT * FROM `mst_document_process` WHERE mdpc_status = 1 ORDER BY mdpc_id")
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListPacking.Close()
	for objListPacking.Next() {
		var objAttn Packing
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString
		err := objListPacking.Scan(&objAttn.Mdpc_id, &objAttn.Mdpc_name, &objAttn.Mdpc_required, &objAttn.Mdpc_status, &strCreateDate, &strCreateBy, &strUpdateDate, &strUpdateBy)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		if strCreateDate.Valid {
			objAttn.Create_date = strCreateDate.String
		}
		if strUpdateDate.Valid {
			objAttn.Update_date = strUpdateDate.String
		}
		if strCreateBy.Valid {
			objAttn.Create_by = strCreateBy.String
		}
		if strUpdateBy.Valid {
			objAttn.Update_by = strUpdateBy.String
		}
		objPackingGroupList = append(objPackingGroupList, objAttn)
	}
	err = objListPacking.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, objPackingGroupList)
}

func LastSequence(c *gin.Context) {
	var objLastId GetLastID
	err := db.QueryRow("SELECT COUNT(idc_id) AS last_id FROM info_document_control").Scan(&objLastId.Last_id)
	if err == sql.ErrNoRows {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, objLastId)
}
func ListDocRfq(c *gin.Context) {
	type RfqNo struct {
		Idc_id         int    `json:"idc_id"`
		Idc_running_no string `json:"idc_running_no"`
	}
	var objRfqNoGroupList []RfqNo
	objListRfqNo, err := db.Query("SELECT idc_id, idc_running_no FROM `info_document_control` ORDER BY idc_id")
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListRfqNo.Close()

	for objListRfqNo.Next() {
		var objRfqNo RfqNo
		err := objListRfqNo.Scan(&objRfqNo.Idc_id, &objRfqNo.Idc_running_no)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}

		objRfqNoGroupList = append(objRfqNoGroupList, objRfqNo)
	}
	err = objListRfqNo.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, objRfqNoGroupList)
}
