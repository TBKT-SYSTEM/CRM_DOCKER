package API

import (
	"database/sql"
	"encoding/json"
	"log"
	"net/http"
	"regexp"
	"strings"

	// "encoding/json"
	// "github.com/go-resty/resty/v2"

	"github.com/gin-gonic/gin"
	"github.com/go-resty/resty/v2"
	_ "github.com/go-sql-driver/mysql"
)

func TextTrim(str *string, strTrimmer string) {
	*str = strings.Trim(*str, strTrimmer)
	strSpace := regexp.MustCompile(`\s+`)
	*str = strSpace.ReplaceAllString(*str, strTrimmer)
}
func StringReplace(strFullString *string, strOrigin string, strResult string, iNum int) {
	*strFullString = strings.Replace(*strFullString, strOrigin, strResult, iNum)
}

func SideMenuGroup(c *gin.Context) {
	iId := c.Param("id")
	log.Println("stts", iId)
	var objMenu []SideMenu
	objListMenu, err := db.Query("SELECT smg.smg_id, spg_id, smg.smg_name, smg.smg_icon,smd.smd_id,smd.smd_name,smd.smd_link FROM" +
		" sys_permission_detail AS spd" +
		" LEFT JOIN sys_menu_detail AS smd ON spd.smd_id = smd.smd_id" +
		" LEFT JOIN sys_menu_group AS smg ON smd.smg_id = smg.smg_id" +
		" WHERE spd.spg_id = " + iId + " AND smg_status=1 AND spd_status=1" +
		" GROUP BY smg_id" +
		" ORDER BY smg.smg_order")
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListMenu.Close()
	for objListMenu.Next() {
		var strMenu SideMenu
		var strSmgIcon sql.NullString
		err := objListMenu.Scan(&strMenu.Smg_id, &strMenu.Spg_id, &strMenu.Smg_name, &strSmgIcon, &strMenu.Smd_id, &strMenu.Smd_name, &strMenu.Smd_link)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		if strSmgIcon.Valid {
			strMenu.Smg_icon = strSmgIcon.String
		}
		objMenu = append(objMenu, strMenu)
	}
	err = objListMenu.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, objMenu)
}
func SideMenuDetail(c *gin.Context) {
	iId := c.Param("id")
	var objMenu []SideMenu
	objListMenu, err := db.Query("SELECT smg.smg_id, spg_id, smg.smg_name, smg.smg_icon,smd.smd_id,smd.smd_name,smd.smd_link FROM" +
		" sys_permission_detail AS spd" +
		" LEFT JOIN sys_menu_detail AS smd ON spd.smd_id = smd.smd_id" +
		" LEFT JOIN sys_menu_group AS smg ON smd.smg_id = smg.smg_id" +
		" WHERE spd.spg_id = " + iId + " AND smd_status=1 AND spd_status=1" +
		" ORDER BY smg.smg_order, spd.order_no")
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListMenu.Close()
	for objListMenu.Next() {
		var strMenu SideMenu
		var strSmgIcon sql.NullString
		err := objListMenu.Scan(&strMenu.Smg_id, &strMenu.Spg_id, &strMenu.Smg_name, &strSmgIcon, &strMenu.Smd_id, &strMenu.Smd_name, &strMenu.Smd_link)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		if strSmgIcon.Valid {
			strMenu.Smg_icon = strSmgIcon.String
		}
		objMenu = append(objMenu, strMenu)
	}
	err = objListMenu.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, objMenu)
}

// MenuGroup ---------------------------sdasda
func ListMenuGroupTable(c *gin.Context) {
	var objMenuGroupList []MenuGroupTable
	objListMenug, err := db.Query("SELECT smg.*, su.su_fname, su.su_lname, su.su_img_path, su.su_img_name FROM `sys_menu_group` AS smg LEFT JOIN sys_user AS su ON smg.update_by = su.su_emp_code ORDER BY smg.smg_id")
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListMenug.Close()
	for objListMenug.Next() {
		var objMenug MenuGroupTable
		var strUserFname sql.NullString
		var strUserLname sql.NullString
		var strUserImgPath sql.NullString
		var strUserImgName sql.NullString
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString
		err := objListMenug.Scan(&objMenug.Smg_id, &objMenug.Smg_name, &objMenug.Smg_icon, &objMenug.Smg_order, &objMenug.Smg_status, &strCreateDate, &strUpdateDate, &strCreateBy, &strUpdateBy, &strUserFname, &strUserLname, &strUserImgPath, &strUserImgName)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		if strUserFname.Valid {
			objMenug.Su_fname = strUserFname.String
		}
		if strUserLname.Valid {
			objMenug.Su_lname = strUserLname.String
		}
		if strUserImgPath.Valid {
			objMenug.Su_img_path = strUserImgPath.String
		}
		if strUserImgName.Valid {
			objMenug.Su_img_name = strUserImgName.String
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

	var objData MenuGroupData
	objData.Data = objMenuGroupList
	c.IndentedJSON(http.StatusOK, objData)
}
func SmgIsUnique(c *gin.Context) {
	var objMenuGroup MenuGroup
	if err := c.BindJSON(&objMenuGroup); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	err := db.QueryRow("SELECT * FROM sys_menu_group WHERE smg_name= ? and smg_id != ?", objMenuGroup.Smg_name, objMenuGroup.Smg_id).Scan(&objMenuGroup.Smg_id, &objMenuGroup.Smg_name, &objMenuGroup.Smg_icon, &objMenuGroup.Smg_order, &objMenuGroup.Smg_status, &objMenuGroup.Create_date, &objMenuGroup.Update_date, &objMenuGroup.Create_by, &objMenuGroup.Update_by)
	if err == sql.ErrNoRows {
		c.IndentedJSON(http.StatusOK, false)
		return
	}
	c.IndentedJSON(http.StatusOK, true)
}
func InsertSmg(c *gin.Context) {
	var objMenuGroup MenuGroup
	if err := c.BindJSON(&objMenuGroup); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	objResult, err := db.Exec("INSERT INTO sys_menu_group(smg_name,smg_icon,create_date,create_by) VALUES(?,?,?,?)", objMenuGroup.Smg_name, objMenuGroup.Smg_icon, objMenuGroup.Create_date, objMenuGroup.Create_by)
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
func UpdateSmg(c *gin.Context) {
	var objMenuGroup MenuGroup
	if err := c.BindJSON(&objMenuGroup); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	objResult, err := db.Exec("Update sys_menu_group SET smg_name = ?, smg_icon = ?,update_date = ?, update_by = ? WHERE smg_id = ?", objMenuGroup.Smg_name, objMenuGroup.Smg_icon, objMenuGroup.Update_date, objMenuGroup.Update_by, objMenuGroup.Smg_id)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})
}
func ChangeSmgStatus(c *gin.Context) {
	var objMenuGroup MenuGroup
	if err := c.BindJSON(&objMenuGroup); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	objResult, err := db.Exec("Update sys_menu_group SET smg_status = ? WHERE smg_id = ?", objMenuGroup.Smg_status, objMenuGroup.Smg_id)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})
}

// MenuDetail ---------------------------
func ListMenuDetailTable(c *gin.Context) {
	var objMenuDetailList []MenuDetailTable
	iId := c.Param("id")
	objListMenud, err := db.Query("SELECT smd.*, su.su_fname, su.su_lname, su.su_img_path, su.su_img_name FROM `sys_menu_detail` AS smd LEFT JOIN sys_user AS su ON smd.update_by = su.su_emp_code WHERE smd.smg_id = ? ORDER BY smd.smd_id", iId)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListMenud.Close()
	for objListMenud.Next() {
		var objMenuDetail MenuDetailTable
		var strUserFname sql.NullString
		var strUserLname sql.NullString
		var strUserImgPath sql.NullString
		var strUserImgName sql.NullString
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString
		err := objListMenud.Scan(&objMenuDetail.Smd_id, &objMenuDetail.Smd_name, &objMenuDetail.Smd_link, &objMenuDetail.Smg_id, &objMenuDetail.Smd_status, &strCreateDate, &strUpdateDate, &strCreateBy, &strUpdateBy, &strUserFname, &strUserLname, &strUserImgPath, &strUserImgName)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		if strUserFname.Valid {
			objMenuDetail.Su_fname = strUserFname.String
		}
		if strUserLname.Valid {
			objMenuDetail.Su_lname = strUserLname.String
		}
		if strUserImgPath.Valid {
			objMenuDetail.Su_img_path = strUserImgPath.String
		}
		if strUserImgName.Valid {
			objMenuDetail.Su_img_name = strUserImgName.String
		}
		if strCreateDate.Valid {
			objMenuDetail.Create_date = strCreateDate.String
		}
		if strUpdateDate.Valid {
			objMenuDetail.Update_date = strUpdateDate.String
		}
		if strCreateBy.Valid {
			objMenuDetail.Create_by = strCreateBy.String
		}
		if strUpdateBy.Valid {
			objMenuDetail.Update_by = strUpdateBy.String
		}
		objMenuDetailList = append(objMenuDetailList, objMenuDetail)
	}
	err = objListMenud.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}

	var objData MenuDetailData
	objData.Data = objMenuDetailList
	c.IndentedJSON(http.StatusOK, objData)
}
func SmdIsUnique(c *gin.Context) {
	var objMenuDetail MenuDetail
	if err := c.BindJSON(&objMenuDetail); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	err := db.QueryRow("SELECT * FROM sys_menu_detail WHERE smd_name= ? and smd_id != ?", objMenuDetail.Smd_name, objMenuDetail.Smd_id).Scan(&objMenuDetail.Smd_id, &objMenuDetail.Smd_name, &objMenuDetail.Smd_link, &objMenuDetail.Smd_status, &objMenuDetail.Create_date, &objMenuDetail.Update_date, &objMenuDetail.Create_by, &objMenuDetail.Update_by)
	if err == sql.ErrNoRows {
		c.IndentedJSON(http.StatusOK, false)
		return
	}
	c.IndentedJSON(http.StatusOK, true)
}
func InsertSmd(c *gin.Context) {
	var objMenuDetail MenuDetail
	if err := c.BindJSON(&objMenuDetail); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	objResult, err := db.Exec("INSERT INTO sys_menu_detail(smd_name,smd_link,smg_id,create_date,create_by) VALUES(?,?,?,?,?)", objMenuDetail.Smd_name, objMenuDetail.Smd_link, objMenuDetail.Smg_id, objMenuDetail.Create_date, objMenuDetail.Create_by)
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
func UpdateSmd(c *gin.Context) {
	var objMenuDetail MenuDetail
	if err := c.BindJSON(&objMenuDetail); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	objResult, err := db.Exec("Update sys_menu_detail SET smd_name = ?, smd_link = ?,update_date = ?, update_by = ? WHERE smd_id = ?", objMenuDetail.Smd_name, objMenuDetail.Smd_link, objMenuDetail.Update_date, objMenuDetail.Update_by, objMenuDetail.Smd_id)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})
}
func ChangeSmdStatus(c *gin.Context) {
	var objMenuDetail MenuDetail
	if err := c.BindJSON(&objMenuDetail); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	objResult, err := db.Exec("Update sys_menu_detail SET smd_status = ? WHERE smd_id = ?", objMenuDetail.Smd_status, objMenuDetail.Smd_id)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})
}

// Department ---------------------------
func ListDepartmentTable(c *gin.Context) {
	var objDepartmentList []DepartmentTable
	objListDept, err := db.Query("SELECT sd.*, su.su_fname, su.su_lname, su.su_img_path, su.su_img_name FROM `sys_department` AS sd LEFT JOIN sys_user AS su ON sd.update_by = su.su_emp_code ORDER BY sd.sd_id")
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListDept.Close()
	for objListDept.Next() {
		var objDepartment DepartmentTable
		var strUserFname sql.NullString
		var strUserLname sql.NullString
		var strUserImgPath sql.NullString
		var strUserImgName sql.NullString
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString
		err := objListDept.Scan(&objDepartment.Sd_id, &objDepartment.Sd_name, &objDepartment.Sd_status, &strCreateDate, &strUpdateDate, &strCreateBy, &strUpdateBy, &strUserFname, &strUserLname, &strUserImgPath, &strUserImgName)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		if strUserFname.Valid {
			objDepartment.Su_fname = strUserFname.String
		}
		if strUserLname.Valid {
			objDepartment.Su_lname = strUserLname.String
		}
		if strUserImgPath.Valid {
			objDepartment.Su_img_path = strUserImgPath.String
		}
		if strUserImgName.Valid {
			objDepartment.Su_img_name = strUserImgName.String
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
	err = objListDept.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}

	var objData DepartmentData
	objData.Data = objDepartmentList
	c.IndentedJSON(http.StatusOK, objData)
}
func SdIsUnique(c *gin.Context) {
	var objDepartmentData Department
	if err := c.BindJSON(&objDepartmentData); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	err := db.QueryRow("SELECT * FROM sys_department WHERE sd_name= ? and sd_id != ?", objDepartmentData.Sd_name, objDepartmentData.Sd_id).Scan(&objDepartmentData.Sd_id, &objDepartmentData.Sd_name, &objDepartmentData.Sd_status, &objDepartmentData.Create_date, &objDepartmentData.Update_date, &objDepartmentData.Create_by, &objDepartmentData.Update_by)
	if err == sql.ErrNoRows {
		c.IndentedJSON(http.StatusOK, false)
		return
	}
	c.IndentedJSON(http.StatusOK, true)
}
func InsertSd(c *gin.Context) {
	var objDepartmentData Department
	if err := c.BindJSON(&objDepartmentData); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	objResult, err := db.Exec("INSERT INTO sys_department(sd_name,create_date,create_by) VALUES(?,?,?)", objDepartmentData.Sd_name, objDepartmentData.Create_date, objDepartmentData.Create_by)
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
func UpdateSd(c *gin.Context) {
	var objDepartmentData Department
	if err := c.BindJSON(&objDepartmentData); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	objResult, err := db.Exec("Update sys_department SET sd_name = ?, update_date = ?, update_by = ? WHERE sd_id = ?", objDepartmentData.Sd_name, objDepartmentData.Update_date, objDepartmentData.Update_by, objDepartmentData.Sd_id)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})
}
func ChangeSdStatus(c *gin.Context) {
	var objDepartmentData Department
	if err := c.BindJSON(&objDepartmentData); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	objResult, err := db.Exec("Update sys_department SET sd_status = ? WHERE sd_id = ?", objDepartmentData.Sd_status, objDepartmentData.Sd_id)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})
}

// Consideration ---------------------------
func ListConsiderationTable(c *gin.Context) {
	var objConsiderationList []ConsiderationTable
	objListConsider, err := db.Query("SELECT mc.*, su.su_fname, su.su_lname, su.su_img_path, su.su_img_name FROM `mst_consideration` AS mc LEFT JOIN sys_user AS su ON mc.update_by = su.su_emp_code ORDER BY mc.mc_id")
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListConsider.Close()
	for objListConsider.Next() {
		var objConsider ConsiderationTable
		var strUserFname sql.NullString
		var strUserLname sql.NullString
		var strUserImgPath sql.NullString
		var strUserImgName sql.NullString
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString
		err := objListConsider.Scan(&objConsider.Mc_id, &objConsider.Mc_title, &objConsider.Mc_weight, &objConsider.Mc_status, &strCreateDate, &strUpdateDate, &strCreateBy, &strUpdateBy, &strUserFname, &strUserLname, &strUserImgPath, &strUserImgName)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		if strUserFname.Valid {
			objConsider.Su_fname = strUserFname.String
		}
		if strUserLname.Valid {
			objConsider.Su_lname = strUserLname.String
		}
		if strUserImgPath.Valid {
			objConsider.Su_img_path = strUserImgPath.String
		}
		if strUserImgName.Valid {
			objConsider.Su_img_name = strUserImgName.String
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
		objConsiderationList = append(objConsiderationList, objConsider)
	}
	err = objListConsider.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}

	var objData ConsiderationData
	objData.Data = objConsiderationList
	c.IndentedJSON(http.StatusOK, objData)
}
func InsertConsideration(c *gin.Context) {
	var objConsideration Consideration
	if err := c.BindJSON(&objConsideration); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	objResult, err := db.Exec("INSERT INTO mst_consideration(mc_title,mc_weight,create_date,create_by) VALUES(?,?,?,?)", objConsideration.Mc_title, objConsideration.Mc_weight, objConsideration.Create_date, objConsideration.Create_by)
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
func UpdateConsideration(c *gin.Context) {
	var objConsideration Consideration
	if err := c.BindJSON(&objConsideration); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	objResult, err := db.Exec("Update mst_consideration SET mc_title = ?, mc_weight = ?, update_date = ?, update_by = ? WHERE mc_id = ?", objConsideration.Mc_title, objConsideration.Mc_weight, objConsideration.Update_date, objConsideration.Update_by, objConsideration.Mc_id)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})
}
func ChangeConsiderationStatus(c *gin.Context) {
	var objConsideration Consideration
	if err := c.BindJSON(&objConsideration); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	objResult, err := db.Exec("Update mst_consideration SET mc_status = ? WHERE mc_id = ?", objConsideration.Mc_status, objConsideration.Mc_id)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})
}

// Consider Incharge ------------------------
func ListInchargeTable(c *gin.Context) {
	var objConsiderInchargeList []ConsiderInchargeTable
	objListIncharge, err := db.Query("SELECT mci.*,mc.mc_title,sd.sd_name, su.su_fname, su.su_lname, su.su_img_path, su.su_img_name FROM `mst_consideration_incharge` AS mci LEFT JOIN sys_user AS su ON mci.update_by = su.su_emp_code LEFT JOIN mst_consideration AS mc ON mci.mc_id = mc.mc_id LEFT JOIN sys_department AS sd ON mci.sd_id = sd.sd_id ORDER BY mci.mci_id")
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListIncharge.Close()
	for objListIncharge.Next() {
		var objIncharge ConsiderInchargeTable
		var strUserFname sql.NullString
		var strUserLname sql.NullString
		var strUserImgPath sql.NullString
		var strUserImgName sql.NullString
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString
		err := objListIncharge.Scan(&objIncharge.Mci_id, &objIncharge.Mc_id, &objIncharge.Sd_id, &objIncharge.Mci_status, &strCreateDate, &strUpdateDate, &strCreateBy, &strUpdateBy, &objIncharge.Mc_title, &objIncharge.Sd_name, &strUserFname, &strUserLname, &strUserImgPath, &strUserImgName)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		if strUserFname.Valid {
			objIncharge.Su_fname = strUserFname.String
		}
		if strUserLname.Valid {
			objIncharge.Su_lname = strUserLname.String
		}
		if strUserImgPath.Valid {
			objIncharge.Su_img_path = strUserImgPath.String
		}
		if strUserImgName.Valid {
			objIncharge.Su_img_name = strUserImgName.String
		}
		if strCreateDate.Valid {
			objIncharge.Create_date = strCreateDate.String
		}
		if strUpdateDate.Valid {
			objIncharge.Update_date = strUpdateDate.String
		}
		if strCreateBy.Valid {
			objIncharge.Create_by = strCreateBy.String
		}
		if strUpdateBy.Valid {
			objIncharge.Update_by = strUpdateBy.String
		}
		objConsiderInchargeList = append(objConsiderInchargeList, objIncharge)
	}
	err = objListIncharge.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}

	var objData ConsiderInchargeData
	objData.Data = objConsiderInchargeList
	c.IndentedJSON(http.StatusOK, objData)
}

func ListPartNoById(c *gin.Context) {
	// log.Println("List Part No By Id : ", c.Param("id"))
	var objPartNoList []GetPartNoById
	objListPartNo, err := db.Query("SELECT ifpn_id, ifpn_part_no, ifpn_part_name FROM `info_feasibility_part_no` WHERE if_id = ? AND ifpn_status = 1", c.Param("id"))
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListPartNo.Close()
	for objListPartNo.Next() {
		var objPartNo GetPartNoById
		var strPartNo sql.NullString
		var strPartName sql.NullString
		err := objListPartNo.Scan(&objPartNo.Ifpn_id, &objPartNo.PartNo, &objPartNo.PartName)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		if strPartNo.Valid {
			objPartNo.PartNo = strPartNo.String
		}
		if strPartName.Valid {
			objPartNo.PartName = strPartName.String
		}

		objPartNoList = append(objPartNoList, objPartNo)
	}
	err = objListPartNo.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}

	var objData GetPartNoByIdData
	objData.Data = objPartNoList
	c.IndentedJSON(http.StatusOK, objData)
}
func InchargeIsUnique(c *gin.Context) {
	var objInchargeData ConsiderIncharge
	if err := c.BindJSON(&objInchargeData); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	err := db.QueryRow("SELECT * FROM mst_consideration_incharge WHERE mc_id= ? and sd_id= ? and mci_id != ?", objInchargeData.Mc_id, objInchargeData.Sd_id, objInchargeData.Mci_id).Scan(&objInchargeData.Mci_id, &objInchargeData.Mc_id, &objInchargeData.Sd_id, &objInchargeData.Mci_status, &objInchargeData.Create_date, &objInchargeData.Update_date, &objInchargeData.Create_by, &objInchargeData.Update_by)
	if err == sql.ErrNoRows {
		c.IndentedJSON(http.StatusOK, false)
		return
	}
	c.IndentedJSON(http.StatusOK, true)
}
func InsertIncharge(c *gin.Context) {
	var objConsideration ConsiderIncharge
	if err := c.BindJSON(&objConsideration); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	objResult, err := db.Exec("INSERT INTO mst_consideration_incharge(mc_id,sd_id,create_date,create_by) VALUES(?,?,?,?)", objConsideration.Mc_id, objConsideration.Sd_id, objConsideration.Create_date, objConsideration.Create_by)
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
func UpdateIncharge(c *gin.Context) {
	var objConsideration ConsiderIncharge
	if err := c.BindJSON(&objConsideration); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	objResult, err := db.Exec("Update mst_consideration_incharge SET mc_id = ?, sd_id = ?, update_date = ?, update_by = ? WHERE mci_id = ?", objConsideration.Mc_id, objConsideration.Sd_id, objConsideration.Update_date, objConsideration.Update_by, objConsideration.Mci_id)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})
}
func ChangeInchargeStatus(c *gin.Context) {
	var objConsideration ConsiderIncharge
	if err := c.BindJSON(&objConsideration); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	objResult, err := db.Exec("Update mst_consideration_incharge SET mci_status = ? WHERE mci_id = ?", objConsideration.Mci_status, objConsideration.Mci_id)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})
}

// select option ---------------------------
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
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString
		err := objListMenud.Scan(&objMenud.Smd_id, &objMenud.Smd_name, &objMenud.Smd_link, &objMenud.Smg_id, &objMenud.Smd_status, &strCreateDate, &strUpdateDate, &strCreateBy, &strUpdateBy)
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
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString
		err := objListMenud.Scan(&objMenud.Smd_id, &objMenud.Smd_name, &objMenud.Smd_link, &objMenud.Smg_id, &objMenud.Smd_status, &strCreateDate, &strUpdateDate, &strCreateBy, &strUpdateBy)
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
func ListWorkflowGroup(c *gin.Context) {
	var objWorkflowGroupList []WorkflowGroup
	objListWorkflowg, err := db.Query("SELECT * FROM `sys_workflow_group` WHERE swg_status=1")
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
		err := objListWorkflowg.Scan(&workflowg.Swg_id, &workflowg.Swg_name, &workflowg.Swg_max_lv, &workflowg.Swg_status, &strCreateDate, &strUpdateDate, &strCreateBy, &strUpdateBy)
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
func ListUsers(c *gin.Context) {
	var objUserSessionList []UserSession
	objListUser, err := db.Query("SELECT su.*,sd.sd_name,spg.spg_name FROM `sys_user` AS su LEFT JOIN sys_department AS sd ON su.sd_id = sd.sd_id LEFT JOIN sys_permission_group AS spg ON su.spg_id = spg.spg_id WHERE su_status=1")
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListUser.Close()
	for objListUser.Next() {
		var objUsers UserSession
		var strUserImgPath sql.NullString
		var strUserImgName sql.NullString
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString
		err := objListUser.Scan(&objUsers.Su_id, &objUsers.Su_fname, &objUsers.Su_lname, &objUsers.Su_email, &objUsers.Su_emp_code, &objUsers.Su_password, &objUsers.Su_tel, &strUserImgPath, &strUserImgName, &objUsers.Spg_id, &objUsers.Sd_id, &objUsers.Spc_id, &objUsers.Su_status, &strCreateDate, &strUpdateDate, &strCreateBy, &strUpdateBy, &objUsers.Sd_name, &objUsers.Spg_name)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		StringReplace(&objUsers.Sd_name, "\u0026", "&", 1)
		if strUserImgPath.Valid {
			objUsers.Su_img_path = strUserImgPath.String
		}
		if strUserImgName.Valid {
			objUsers.Su_img_name = strUserImgName.String
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
	objListDepartment, err := db.Query("SELECT * FROM `sys_department` WHERE sd_status=1")
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListDepartment.Close()
	for objListDepartment.Next() {
		var objDepartment Department
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString
		err := objListDepartment.Scan(&objDepartment.Sd_id, &objDepartment.Sd_name, &objDepartment.Sd_status, &strCreateDate, &strUpdateDate, &strCreateBy, &strUpdateBy)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
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
func ListConsideration(c *gin.Context) {
	var objConsiderationList []Consideration
	objConsideration, err := db.Query("SELECT * FROM `mst_consideration` WHERE mc_status=1")
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objConsideration.Close()
	for objConsideration.Next() {
		var objConsider Consideration
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString
		err := objConsideration.Scan(&objConsider.Mc_id, &objConsider.Mc_title, &objConsider.Mc_weight, &objConsider.Mc_status, &strCreateDate, &strUpdateDate, &strCreateBy, &strUpdateBy)
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
		objConsiderationList = append(objConsiderationList, objConsider)
	}
	err = objConsideration.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, objConsiderationList)
}

// view form -----------------------------
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
func ListIncharge(c *gin.Context) {
	var objInchargeDeptList []InchargeDepartment
	objListIncharge, err := db.Query("SELECT mci.*,sd.sd_name FROM `mst_consideration_incharge` AS mci LEFT JOIN sys_department AS sd ON mci.sd_id = sd.sd_id WHERE mci.mci_status=1 ORDER BY mci.mc_id")
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListIncharge.Close()
	for objListIncharge.Next() {
		var objIncharge InchargeDepartment
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString
		err := objListIncharge.Scan(&objIncharge.Mci_id, &objIncharge.Mc_id, &objIncharge.Sd_id, &objIncharge.Mci_status, &strCreateDate, &strUpdateDate, &strCreateBy, &strUpdateBy, &objIncharge.Sd_name)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		if strCreateDate.Valid {
			objIncharge.Create_date = strCreateDate.String
		}
		if strUpdateDate.Valid {
			objIncharge.Update_date = strUpdateDate.String
		}
		if strCreateBy.Valid {
			objIncharge.Create_by = strCreateBy.String
		}
		if strUpdateBy.Valid {
			objIncharge.Update_by = strUpdateBy.String
		}
		objInchargeDeptList = append(objInchargeDeptList, objIncharge)
	}
	err = objListIncharge.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, objInchargeDeptList)
}
func ListInchargeScorable(c *gin.Context) {
	var objFeasibilityScoreList []ViewFeasibilityScore
	iFeasibilityId := c.Param("if")
	iDepartmentId := c.Param("sd")
	objListScore, err := db.Query("SELECT mc.*, ifcp.ifcp_score, ifcp.ifcp_comment, ifcp.ifcp_file_name, ifcp.ifcp_file_path, ifcp.ifcp_submit FROM "+
		"`mst_consideration_incharge` AS mci "+
		"LEFT JOIN `mst_consideration` AS mc ON mci.mc_id = mc.mc_id "+
		"LEFT JOIN ( SELECT * FROM info_feasibility_consern_point WHERE if_id = ? ) AS ifcp ON mc.mc_id = ifcp.mc_id "+
		"WHERE mc.mc_status = 1 AND mci.mci_status = 1 AND mci.sd_id = ? ORDER BY mc.mc_id", iFeasibilityId, iDepartmentId)
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

// Line Notify ----------------------------
func LineNotify(c *gin.Context) {
	client := resty.New()
	var objResult map[string]string
	json.Unmarshal([]byte(`{
		"message": "สวัสดีไกด์",
		"stickerId": "125",
		"stickerPackageId": "1"
	}`), &objResult)

	objRespond, err := client.R().
		SetHeader("Authorization", "Bearer ffPxZ5rDxpVdLdHNSWWqlwGnXmnhdmeunAASbrLtrnX").
		SetFormData(objResult).Post("https://notify-api.line.me/api/notify")
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"ERROR LINE Notify API: ": err.Error()})
		return
	}
	if objRespond.StatusCode() != http.StatusOK {
		c.IndentedJSON(http.StatusOK, gin.H{"ERROR LINE Notify API: ": objRespond.Status()})
		return
	}
	objBody := objRespond.String()
	c.IndentedJSON(http.StatusOK, gin.H{"Response": objBody})
}

// Email ----------------------------------
func EmailUserData(c *gin.Context) {
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
	err := db.QueryRow("SELECT * FROM `sys_user` WHERE su_emp_code= ?", objUser.Su_emp_code).Scan(&objUser.Su_id, &objUser.Su_fname, &objUser.Su_lname, &objUser.Su_email, &objUser.Su_emp_code, &objUser.Su_password, &objUser.Su_tel, &strUserImgPath, &strUserImgName, &objUser.Spg_id, &objUser.Sd_id, &objUser.Spc_id, &objUser.Su_status, &strCreateDate, &strUpdateDate, &strCreateBy, &strUpdateBy)
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

// other ---------------------------
func CountConsideration() ([]ConsiderationCount, error) {
	var objConsider []ConsiderationCount
	rows, err := db.Query("SELECT mc_id FROM `mst_consideration` WHERE mc_status=1")
	if err != nil {
		return nil, err
	}
	defer rows.Close()

	for rows.Next() {
		var consider ConsiderationCount
		if err := rows.Scan(&consider.Mc_id); err != nil {
			return nil, err
		}
		objConsider = append(objConsider, consider)
	}

	// Check for any error during the iteration
	if err := rows.Err(); err != nil {
		return nil, err
	}

	return objConsider, nil
}
