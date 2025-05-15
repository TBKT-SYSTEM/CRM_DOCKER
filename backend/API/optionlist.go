package API

import (
	"database/sql"
	"fmt"
	"net/http"
	"strconv"
	"strings"
	"time"

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
	objListRfqNo, err := db.Query("SELECT idc_id, idc_running_no FROM `info_document_control` WHERE mdt_id = 3 ORDER BY idc_id")
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

func ListDoc(c *gin.Context) {
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
func InsertReferDoc(c *gin.Context, docId int) error {
	type TempReferDocument struct {
		TrdID int
		IdcID int
		MdtID int
	}
	strCreateDate := time.Now().Format("2006-01-02 15:04:05")
	var strUpdatedByEmp string
	getUser := db.QueryRow("SELECT idc_created_by FROM info_document_control WHERE idc_id = ?", docId).Scan(&strUpdatedByEmp)
	if getUser != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error1": getUser.Error()})
		return getUser
	}

	var doc_no string
	err := db.QueryRow("SELECT idc_running_no FROM info_document_control WHERE idc_id = ?", docId).Scan(&doc_no)
	if err != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error1.1": err.Error()})
		return err
	}
	substring := doc_no[:3]

	if substring == "RFQ" {
		var objReferRfq GetRfqNew
		var objDocNo GetDocNo
		var ortherDocArray []TempReferDocument

		var runNo string

		var strReferDoc sql.NullInt64
		var strSubjectNote sql.NullString
		var strEnclosuresNote sql.NullString
		var strIssueDate sql.NullString
		var strReplyDate sql.NullString
		var strNote1 sql.NullString
		var strNote2 sql.NullString
		var strFilePath sql.NullString
		var strPhysicalPath sql.NullString
		var strCancelReason sql.NullString

		rowReferDoc, err := db.Query("SELECT trd_id, idc_id, mdt_id FROM temp_refer_document WHERE idc_id = ? AND trd_status = 0", docId)
		if err != nil {
			c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error1": err.Error()})
			return err
		}
		defer rowReferDoc.Close()
		for rowReferDoc.Next() {
			var ortherDoc TempReferDocument
			if err := rowReferDoc.Scan(&ortherDoc.TrdID, &ortherDoc.IdcID, &ortherDoc.MdtID); err != nil {
				c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error2": err.Error()})
				return err
			}
			ortherDocArray = append(ortherDocArray, ortherDoc)
		}

		if err := rowReferDoc.Err(); err != nil {
			c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error3": err.Error()})
			return err
		}

		if len(ortherDocArray) == 0 {
			return nil
		} else {
			queryGetRefer := "SELECT * FROM info_document_control WHERE idc_id = ?"
			err := db.QueryRow(queryGetRefer, docId).Scan(&objReferRfq.Idc_id, &objReferRfq.Mdt_id, &strReferDoc, &objReferRfq.Idc_running_no, &objReferRfq.Idc_issue_year, &objReferRfq.Idc_issue_month, &objReferRfq.Idc_issue_seq_no, &objReferRfq.Idc_customer_type, &objReferRfq.Idc_customer_name, &objReferRfq.Idc_plant_cd, &objReferRfq.Mds_id, &strSubjectNote, &objReferRfq.Mde_id, &strEnclosuresNote, &objReferRfq.Idc_project_life, &objReferRfq.Idc_project_start, &strIssueDate, &objReferRfq.Idc_closing_date, &strReplyDate, &objReferRfq.Idc_result_confirm, &objReferRfq.Idc_status, &strNote1, &strNote2, &strFilePath, &strPhysicalPath, &strCancelReason, &objReferRfq.Idc_created_date, &objReferRfq.Idc_created_by, &objReferRfq.Idc_updated_date, &objReferRfq.Idc_updated_by)
			if err == sql.ErrNoRows {
				c.IndentedJSON(http.StatusOK, gin.H{"Error4": err.Error()})
				return err
			}
			if strReferDoc.Valid {
				objReferRfq.Idc_refer_doc = int(strReferDoc.Int64)
			}
			if strSubjectNote.Valid {
				objReferRfq.Idc_subject_note = strSubjectNote.String
			}
			if strEnclosuresNote.Valid {
				objReferRfq.Idc_enclosures_note = strEnclosuresNote.String
			}
			if strIssueDate.Valid {
				objReferRfq.Idc_issue_date = strIssueDate.String
			}
			if strReplyDate.Valid {
				objReferRfq.Idc_reply_date = strReplyDate.String
			}
			if strNote1.Valid {
				objReferRfq.Idc_note1 = strNote1.String
			}
			if strNote2.Valid {
				objReferRfq.Idc_note2 = strNote2.String
			}
			if strFilePath.Valid {
				objReferRfq.Idc_file_path = strFilePath.String
			}
			if strPhysicalPath.Valid {
				objReferRfq.Idc_physical_path = strPhysicalPath.String
			}
			if strCancelReason.Valid {
				objReferRfq.Idc_cancel_reason = strCancelReason.String
			}

			//////////////  GET Attn  ///////////////////////
			rowsAttn, err := db.Query("SELECT mda_id FROM `info_document_attn` WHERE idc_id = ? AND idat_status = 1 ORDER BY idat_id", docId)
			if err != nil {
				c.IndentedJSON(http.StatusOK, gin.H{"Error10": err.Error()})
				return err
			}
			defer rowsAttn.Close()
			for rowsAttn.Next() {
				var mdaID int
				if err := rowsAttn.Scan(&mdaID); err != nil {
					c.IndentedJSON(http.StatusOK, gin.H{"Error11": err.Error()})
					return err
				}
				objReferRfq.Idat_item = append(objReferRfq.Idat_item, fmt.Sprintf("%d", mdaID))
			}

			if err := rowsAttn.Err(); err != nil {
				c.IndentedJSON(http.StatusOK, gin.H{"Error12": err.Error()})
				return err
			}

			/////////////////////  GET ITEM  ///////////////////////
			rowsItem, err := db.Query("SELECT idi_id, idi_item_no, idi_item_name, idi_model, idi_remark FROM `info_document_item` WHERE idc_id = ? AND idi_status = 1 ORDER BY idi_id", docId)
			if err != nil {
				c.IndentedJSON(http.StatusOK, gin.H{"Error5": err.Error()})
				return err
			}
			defer rowsItem.Close()
			for rowsItem.Next() {
				var groupPart RfqGroupPart
				var strModel sql.NullString
				var strRemark sql.NullString
				if err := rowsItem.Scan(
					&groupPart.Idi_id,
					&groupPart.Idi_item_no,
					&groupPart.Idi_item_name,
					&strModel,
					&strRemark,
				); err != nil {
					c.IndentedJSON(http.StatusOK, gin.H{"Error6": err.Error()})
					return err
				}
				if strModel.Valid {
					groupPart.Idi_model = strModel.String
				}
				if strRemark.Valid {
					groupPart.Idi_remark = strRemark.String
				}

				rowsVolume, err := db.Query("SELECT idi_id, idv_id, idv_year, idv_qty FROM `info_document_volume` WHERE idi_id = ? AND idv_status = 1 ORDER BY idv_id", groupPart.Idi_id)
				if err != nil {
					c.IndentedJSON(http.StatusOK, gin.H{"Error7": err.Error()})
					return err
				}
				defer rowsVolume.Close()
				for rowsVolume.Next() {
					var groupVolume RfqGroupVolumeDetail
					if err := rowsVolume.Scan(
						&groupVolume.Idi_id,
						&groupVolume.Idv_id,
						&groupVolume.Idv_year,
						&groupVolume.Idv_qty,
					); err != nil {
						c.IndentedJSON(http.StatusOK, gin.H{"Error8": err.Error()})
						return err
					}
					groupPart.IrGroupVolume = append(groupPart.IrGroupVolume, groupVolume)
				}

				if err := rowsVolume.Err(); err != nil {
					c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
					return err
				}

				objReferRfq.IrGroupPart = append(objReferRfq.IrGroupPart, groupPart)
			}

			if err := rowsItem.Err(); err != nil {
				c.IndentedJSON(http.StatusOK, gin.H{"Error7": err.Error()})
				return err
			} else {
				/////////////////////  Insert Refer Doc  ///////////////////////
				var strNote2Null sql.NullString
				for _, objRefer := range ortherDocArray {
					query := "SELECT mdt.mdt_id, CONCAT(mdt.mdt_position1, '-', mdt.mdt_position2) AS doc_mst, mdcn.mdcn_position1 AS doc_cur_no_p1, mdcn.mdcn_position2 AS doc_cur_no_p2, CONCAT( CONCAT(mdt.mdt_position1, '-', mdt.mdt_position2), '-', CONCAT(mdcn.mdcn_position1) ) AS doc_run_no FROM mst_document_type mdt LEFT JOIN mst_document_control_no mdcn ON mdcn.mdt_id = mdt.mdt_id WHERE mdt.mdt_id = ? AND mdt.mdt_status = 1"
					err = db.QueryRow(query, objRefer.MdtID).Scan(&objDocNo.Mdt_id, &objDocNo.Doc_mst, &objDocNo.Doc_cur_no_po1, &objDocNo.Doc_cur_no_po2, &objDocNo.Doc_run_no)

					if err == sql.ErrNoRows {
						c.IndentedJSON(http.StatusOK, gin.H{"Error19": err.Error()})
						return err
					}

					runNo = objDocNo.Doc_run_no
					objDocNo.Doc_cur_no_po2++
					if objDocNo.Doc_cur_no_po2 < 10 {
						if objDocNo.Doc_cur_no_po2 == 0 {
							runNo += "-001"
						} else {
							runNo += fmt.Sprintf("-00%d", objDocNo.Doc_cur_no_po2)
						}
					} else if objDocNo.Doc_cur_no_po2 < 100 {
						runNo += fmt.Sprintf("-0%d", objDocNo.Doc_cur_no_po2)
					} else {
						runNo += fmt.Sprintf("-%d", objDocNo.Doc_cur_no_po2)
					}

					docCrurent, err := db.Exec("INSERT INTO info_document_control (mdt_id, idc_refer_doc, idc_running_no, idc_issue_year, idc_issue_month, idc_issue_seq_no, idc_customer_type, idc_customer_name, idc_plant_cd, mds_id, idc_subject_note, mde_id, idc_enclosures_note, idc_project_life, idc_project_start, idc_issue_date, idc_closing_date, idc_reply_date, idc_result_confirm, idc_status, idc_note1, idc_note2, idc_file_path, idc_physical_path, idc_cancel_reason, idc_created_date, idc_created_by, idc_updated_date, idc_updated_by) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", objDocNo.Mdt_id, docId, runNo, objReferRfq.Idc_issue_year, objReferRfq.Idc_issue_month, objDocNo.Doc_cur_no_po2, objReferRfq.Idc_customer_type, objReferRfq.Idc_customer_name, objReferRfq.Idc_plant_cd, objReferRfq.Mds_id, objReferRfq.Idc_subject_note, objReferRfq.Mde_id, objReferRfq.Idc_enclosures_note, objReferRfq.Idc_project_life, objReferRfq.Idc_project_start, strIssueDate, objReferRfq.Idc_closing_date, objReferRfq.Idc_reply_date, objReferRfq.Idc_result_confirm, 1, strNote1, strNote2Null, strFilePath, strPhysicalPath, strCancelReason, strCreateDate, objReferRfq.Idc_created_by, strCreateDate, objReferRfq.Idc_created_by)
					if err != nil {
						c.IndentedJSON(http.StatusOK, gin.H{"Error20": err.Error()})
						return err
					}

					iLastID, err := docCrurent.LastInsertId()
					if err != nil {
						c.IndentedJSON(http.StatusOK, gin.H{"Error21": err.Error()})
						return err
					}

					if objRefer.MdtID == 1 {
						var mcipID []int
						rows, err := db.Query("SELECT mcip_id FROM mst_consideration_item_pic WHERE mcip_status = 1")
						if err != nil {
							c.JSON(http.StatusInternalServerError, gin.H{"error": "Database error"})
							return err
						}
						defer rows.Close()

						for rows.Next() {
							var mcip_id int
							if err := rows.Scan(&mcip_id); err != nil {
								c.JSON(http.StatusInternalServerError, gin.H{"error": "Database error"})
								return err
							}
							mcipID = append(mcipID, mcip_id)
						}

						if err := rows.Err(); err != nil {
							c.JSON(http.StatusInternalServerError, gin.H{"error": "Database error"})
							return err
						}

						var sql string = "INSERT INTO info_feasibility_score (idc_id, mcip_id, ifs_created_date, ifs_created_by, ifs_updated_date, ifs_updated_by) VALUES "
						values := []string{}

						for _, id := range mcipID {

							value := fmt.Sprintf("(%d, %d, '%s', '%s', '%s', '%s')",
								iLastID,
								id,
								strCreateDate,
								objReferRfq.Idc_created_by,
								strCreateDate,
								objReferRfq.Idc_created_by)
							values = append(values, value)
						}

						if len(values) == 0 {
							c.IndentedJSON(http.StatusBadRequest, gin.H{"error": "ไม่มีข้อมูลที่สามารถบันทึกได้"})
							return err
						}

						sql += strings.Join(values, ",")
						_, errPartItem := db.Exec(sql)

						if errPartItem != nil {
							c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": errPartItem.Error()})
							return err
						}

						for index, partCurrent := range objReferRfq.IrGroupPart {
							partNo := partCurrent.Idi_item_no
							partName := partCurrent.Idi_item_name
							model := partCurrent.Idi_model
							remark := partCurrent.Idi_remark
							orderNo := index + 1

							if remark == "" {
								remark = ""
							} else {
								remark = fmt.Sprintf("'%s'", remark)
							}

							query := "INSERT INTO info_document_item (idc_id, idi_item_no, idi_item_name, idi_model, idi_order_no, idi_status, idi_remark, idi_created_date, idi_created_by, idi_updated_date, idi_updated_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"

							_, err := db.Exec(query, iLastID, partNo, partName, model, orderNo, 1, remark, strCreateDate, objReferRfq.Idc_created_by, strCreateDate, objReferRfq.Idc_created_by)
							if err != nil {
								c.IndentedJSON(http.StatusOK, gin.H{"False": err.Error()})
								return err
							}
						}
					} else {
						/////////////////////  Insert Refer Item  ///////////////////////
						for index, partCurrent := range objReferRfq.IrGroupPart {
							valuesVolume := []string{}
							partNo := partCurrent.Idi_item_no
							partName := partCurrent.Idi_item_name
							model := partCurrent.Idi_model
							remark := partCurrent.Idi_remark
							orderNo := index + 1

							if remark == "" {
								remark = ""
							} else {
								remark = fmt.Sprintf("'%s'", remark)
							}

							query := "INSERT INTO info_document_item (idc_id, idi_item_no, idi_item_name, idi_model, idi_order_no, idi_status, idi_remark, idi_created_date, idi_created_by, idi_updated_date, idi_updated_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"

							itemInsert, err := db.Exec(query, iLastID, partNo, partName, model, orderNo, 1, remark, strCreateDate, objReferRfq.Idc_created_by, strCreateDate, objReferRfq.Idc_created_by)
							if err != nil {
								c.IndentedJSON(http.StatusOK, gin.H{"False": err.Error()})
								return err
							}

							itemLastId, err := itemInsert.LastInsertId()
							if err != nil {
								c.IndentedJSON(http.StatusOK, gin.H{"False": "ไม่สามารถดึง Last Insert ID ได้"})
								return err
							}

							var sql string = "INSERT INTO info_document_volume (idi_id, idv_year, idv_qty, idv_status, idv_created_date, idv_created_by, idv_updated_date, idv_updated_by) VALUES "
							for _, volume := range partCurrent.IrGroupVolume {
								value := fmt.Sprintf("(%d, %s, %s, %d, '%s', '%s', '%s', '%s')",
									itemLastId,
									volume.Idv_year,
									volume.Idv_qty,
									1,
									strCreateDate,
									objReferRfq.Idc_created_by,
									strCreateDate,
									objReferRfq.Idc_created_by)
								valuesVolume = append(valuesVolume, value)
							}

							if len(valuesVolume) == 0 {
								c.IndentedJSON(http.StatusOK, gin.H{"False": "ไม่มีข้อมูลที่สามารถบันทึกได้"})
								return err
							}

							sql += strings.Join(valuesVolume, ",")
							_, errPartItem := db.Exec(sql)

							if errPartItem != nil {
								c.IndentedJSON(http.StatusOK, gin.H{"False": errPartItem.Error()})
								return err
							}
						}
					}

					/////////////////////  Insert Refer Attn  ///////////////////////
					var sqlAttn string = "INSERT INTO info_document_attn (idc_id, mda_id, idat_status, idat_created_date, idat_created_by, idat_updated_date, idat_updated_by) VALUES "
					objListAttn := []string{}

					for _, attnCurrent := range objReferRfq.Idat_item {

						attnID, err := strconv.Atoi(attnCurrent)
						if err != nil {
							fmt.Println("Error converting attnCurrent to int:", err)
							continue
						}

						objAttn := fmt.Sprintf("(%d, %d, %d, '%s', '%s', '%s', '%s')",
							iLastID,
							attnID,
							1,
							strCreateDate,
							objReferRfq.Idc_created_by,
							strCreateDate,
							objReferRfq.Idc_created_by)

						objListAttn = append(objListAttn, objAttn)
					}

					if len(objListAttn) == 0 {
						c.IndentedJSON(http.StatusBadRequest, gin.H{"error": "ไม่มีข้อมูลที่สามารถบันทึกได้"})
						return err
					}

					sqlAttn += strings.Join(objListAttn, ",")

					_, errAttn := db.Exec(sqlAttn)
					if errAttn != nil {
						c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error25": errAttn.Error()})
						return err
					}

					_, errUpdateSeq := db.Exec("UPDATE mst_document_control_no SET mdcn_position2 = ? WHERE mdt_id = ?", objDocNo.Doc_cur_no_po2, objDocNo.Mdt_id)
					if errUpdateSeq != nil {
						c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error28": errUpdateSeq.Error()})
						return err
					}

					_, err = db.Exec("UPDATE temp_refer_document SET trd_status = 1 WHERE trd_id = ?", objRefer.TrdID)
					if err != nil {
						c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
						return err
					}
				}
			}
		}
	}

	if substring == "NBC" {
		_, err = db.Exec("UPDATE info_document_control SET idc_result_confirm = 9 WHERE idc_Id = ?", docId)
		if err != nil {
			c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
			return err
		}
	}
	return nil
}

func GetDocType(c *gin.Context) {
	Idc_id := c.Param("docId")
	var DocType string
	err := db.QueryRow("SELECT mdt.mdt_position1 FROM info_document_control idc LEFT JOIN mst_document_type mdt ON mdt.mdt_id = idc.mdt_id WHERE idc.idc_id = ?", Idc_id).Scan(&DocType)
	if err == sql.ErrNoRows {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}

	c.IndentedJSON(http.StatusOK, DocType)
}
