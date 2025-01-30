package API

import (
	"bytes"
	"database/sql"
	"encoding/base64"
	"encoding/json"
	"fmt"
	"html/template"
	"log"
	"net/http"
	"regexp"
	"strconv"
	"strings"
	"time"

	// "encoding/json"
	// "github.com/go-resty/resty/v2"

	"github.com/gin-gonic/gin"
	"github.com/go-gomail/gomail"
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
	var objMenu []SideMenu
	objListMenu, err := db.Query("SELECT smg.smg_id, spg_id, smg.smg_name, smg.smg_icon,smd.smd_id,smd.smd_name,smd.smd_link FROM" +
		" sys_permission_detail AS spd" +
		" LEFT JOIN sys_menu_detail AS smd ON spd.smd_id = smd.smd_id" +
		" LEFT JOIN sys_menu_group AS smg ON smd.smg_id = smg.smg_id" +
		" WHERE spd.spg_id = " + iId + " AND smg_status=1 AND spd_status=1" +
		" GROUP BY smg_id" +
		" ORDER BY smg.smg_order_no")
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
		" ORDER BY smg.smg_order_no, spd.spd_order_no")
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
	objListMenug, err := db.Query("SELECT smg.*, su.su_firstname, su.su_lastname, su.su_sign_path, su.su_sign_file FROM `sys_menu_group` AS smg LEFT JOIN sys_users AS su ON smg.smg_updated_by = su.su_username ORDER BY smg.smg_id")
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
		err := objListMenug.Scan(&objMenug.Smg_id, &objMenug.Smg_name, &objMenug.Smg_icon, &objMenug.Smg_order, &objMenug.Smg_status, &strCreateDate, &strCreateBy, &strUpdateDate, &strUpdateBy, &strUserFname, &strUserLname, &strUserImgPath, &strUserImgName)
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
func ListDocumentTypeTable(c *gin.Context) {
	var objDocumentTypeList []DocumentTypeTable
	objListDocType, err := db.Query("SELECT mdt.*, su.su_firstname, su.su_lastname FROM `mst_document_type` AS mdt LEFT JOIN sys_users AS su ON mdt.mdt_updated_by = su.su_username ORDER BY mdt.mdt_id")
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}

	defer objListDocType.Close()
	for objListDocType.Next() {
		var objDocType DocumentTypeTable
		err := objListDocType.Scan(&objDocType.Mdt_id, &objDocType.Mdt_name, &objDocType.Mdt_position1, &objDocType.Mdt_position2, &objDocType.Map_id, &objDocType.Mdt_status, &objDocType.Create_date, &objDocType.Create_by, &objDocType.Update_date, &objDocType.Update_by, &objDocType.Su_firstname, &objDocType.Su_lastname)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		objDocumentTypeList = append(objDocumentTypeList, objDocType)
	}
	err = objListDocType.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}

	var objData DocumentTypeData
	objData.Data = objDocumentTypeList
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
func MdtIsUnique(c *gin.Context) {
	var objDocumentType DocumentType
	if err := c.BindJSON(&objDocumentType); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	err := db.QueryRow("SELECT * FROM mst_document_type WHERE mdt_name = ? and mdt_id != ?", objDocumentType.Mdt_name, objDocumentType.Mdt_id).Scan(&objDocumentType.Mdt_id, &objDocumentType.Mdt_name, &objDocumentType.Mdt_position1, &objDocumentType.Mdt_position2, &objDocumentType.Map_id, &objDocumentType.Mdt_status, &objDocumentType.Create_date, &objDocumentType.Update_date, &objDocumentType.Create_by, &objDocumentType.Update_by)
	if err == sql.ErrNoRows {
		c.IndentedJSON(http.StatusOK, false)
		return
	}
	c.IndentedJSON(http.StatusOK, true)
}
func MdcnIsUnique(c *gin.Context) {
	var objDocumentNo DocControlNo
	if err := c.BindJSON(&objDocumentNo); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	err := db.QueryRow("SELECT * FROM mst_document_control_no WHERE mdcn_position1 = ? and mdt_id = ? and mdcn_id != ?", objDocumentNo.Mdcn_position1, objDocumentNo.Mdt_id, objDocumentNo.Mdcn_id).Scan(&objDocumentNo.Mdcn_id, &objDocumentNo.Mdt_id, &objDocumentNo.Mdcn_position1, &objDocumentNo.Mdcn_position2, &objDocumentNo.Create_date, &objDocumentNo.Create_by, &objDocumentNo.Update_date, &objDocumentNo.Update_by)
	if err == sql.ErrNoRows {
		c.IndentedJSON(http.StatusOK, false)
		return
	}
	c.IndentedJSON(http.StatusOK, true)
}
func InsertSmg(c *gin.Context) {
	var objMenuGroup MenuGroup
	var orderNo int

	if err := c.BindJSON(&objMenuGroup); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}

	errCount := db.QueryRow("SELECT COUNT(smg_order_no) FROM sys_menu_group WHERE smg_status = 1").Scan(&orderNo)
	if errCount != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": errCount.Error()})
		return
	}

	objResult, err := db.Exec("INSERT INTO sys_menu_group(smg_name, smg_icon, smg_order_no, smg_created_date, smg_created_by, smg_updated_date, smg_updated_by) VALUES(?,?,?,?,?,?,?)", objMenuGroup.Smg_name, objMenuGroup.Smg_icon, orderNo+1, objMenuGroup.Create_date, objMenuGroup.Create_by, objMenuGroup.Create_date, objMenuGroup.Create_by)

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
func InsertMdt(c *gin.Context) {
	var objDocumentType DocumentType
	if err := c.BindJSON(&objDocumentType); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}

	objResult, err := db.Exec("INSERT INTO mst_document_type(mdt_name, mdt_position1, mdt_position2, map_id, mdt_status, mdt_created_date, mdt_created_by, mdt_updated_date, mdt_updated_by) VALUES(?,?,?,?,?,?,?,?,?)", objDocumentType.Mdt_name, objDocumentType.Mdt_position1, objDocumentType.Mdt_position2, objDocumentType.Map_id, objDocumentType.Mdt_status, objDocumentType.Create_date, objDocumentType.Create_by, objDocumentType.Create_date, objDocumentType.Create_by)

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
func InsertMdcn(c *gin.Context) {
	var objDocumentConNo DocControlNo
	if err := c.BindJSON(&objDocumentConNo); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}

	objResult, err := db.Exec("INSERT INTO mst_document_control_no(mdt_id, mdcn_position1, mdcn_position2, mdcn_created_date, mdcn_created_by, mdcn_updated_date, mdcn_updated_by) VALUES(?,?,?,?,?,?,?)", objDocumentConNo.Mdt_id, objDocumentConNo.Mdcn_position1, objDocumentConNo.Mdcn_position2, objDocumentConNo.Create_date, objDocumentConNo.Create_by, objDocumentConNo.Create_date, objDocumentConNo.Create_by)

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
	objResult, err := db.Exec("Update sys_menu_group SET smg_name = ?, smg_icon = ?, smg_order_no = ?, smg_updated_date = ?, smg_updated_by = ? WHERE smg_id = ?", objMenuGroup.Smg_name, objMenuGroup.Smg_icon, objMenuGroup.Smg_order, objMenuGroup.Update_date, objMenuGroup.Update_by, objMenuGroup.Smg_id)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})
}
func UpdateMdt(c *gin.Context) {
	var objDocumentType DocumentType
	if err := c.BindJSON(&objDocumentType); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}

	objResult, err := db.Exec("Update mst_document_type SET mdt_name = ?, mdt_position1 = ?, mdt_position2 = ?, map_id = ?, mdt_updated_date = ?, mdt_updated_by = ? WHERE mdt_id = ?", objDocumentType.Mdt_name, objDocumentType.Mdt_position1, objDocumentType.Mdt_position2, objDocumentType.Map_id, objDocumentType.Update_date, objDocumentType.Update_by, objDocumentType.Mdt_id)
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
	objResult, err := db.Exec("Update sys_menu_group SET smg_status = ?, smg_updated_date = ?, smg_updated_by = ? WHERE smg_id = ?", objMenuGroup.Smg_status, objMenuGroup.Update_date, objMenuGroup.Update_by, objMenuGroup.Smg_id)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})
}

func ChangeDmtStatus(c *gin.Context) {
	var objDocumentType DocumentType
	if err := c.BindJSON(&objDocumentType); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	objResult, err := db.Exec("Update mst_document_type SET mdt_status = ?, mdt_updated_date = ?, mdt_updated_by = ? WHERE mdt_id = ?", objDocumentType.Mdt_status, objDocumentType.Update_date, objDocumentType.Update_by, objDocumentType.Mdt_id)
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
	objListMenud, err := db.Query("SELECT smd.*, su.su_firstname, su.su_lastname, su.su_sign_path, su.su_sign_file FROM `sys_menu_detail` AS smd LEFT JOIN sys_users AS su ON smd.smd_updated_by = su.su_username WHERE smd.smg_id = ? ORDER BY smd.smd_id", iId)
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
		var strUserSignPath sql.NullString
		var strUserSignFile sql.NullString
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString
		var strOrderNo sql.NullInt64

		err := objListMenud.Scan(&objMenuDetail.Smd_id, &objMenuDetail.Smg_id, &objMenuDetail.Smd_name, &objMenuDetail.Smd_link, &strOrderNo, &objMenuDetail.Smd_status, &strCreateDate, &strCreateBy, &strUpdateDate, &strUpdateBy, &strUserFname, &strUserLname, &strUserSignPath, &strUserSignFile)

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
		if strUserSignPath.Valid {
			objMenuDetail.Su_sign_path = strUserSignPath.String
		}
		if strUserSignFile.Valid {
			objMenuDetail.Su_sign_file = strUserSignFile.String
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
		if strOrderNo.Valid {
			objMenuDetail.Smd_order_no = int(strOrderNo.Int64)
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
func ListDocControlDetailTable(c *gin.Context) {
	var objDocControlDetailList []DocControlDetailTable
	iId := c.Param("id")
	objListDocControl, err := db.Query("SELECT mdcn.*, mdt.mdt_name, su.su_firstname, su.su_lastname, su.su_sign_path, su.su_sign_file FROM `mst_document_control_no` AS mdcn LEFT JOIN mst_document_type AS mdt ON mdcn.mdt_id = mdt.mdt_id LEFT JOIN sys_users AS su ON mdcn.mdcn_updated_by = su.su_username WHERE mdcn.mdt_id = ? ORDER BY mdcn.mdcn_id", iId)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListDocControl.Close()
	for objListDocControl.Next() {
		var objDocControlTetail DocControlDetailTable
		var strUserFname sql.NullString
		var strUserLname sql.NullString
		var strUserSignPath sql.NullString
		var strUserSignFile sql.NullString
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString
		var strPosition2 sql.NullString

		err := objListDocControl.Scan(&objDocControlTetail.Mdcn_id, &objDocControlTetail.Mdt_id, &objDocControlTetail.Mdcn_position1, &strPosition2, &strCreateDate, &strCreateBy, &strUpdateDate, &strUpdateBy, &objDocControlTetail.Mdt_name, &strUserFname, &strUserLname, &strUserSignPath, &strUserSignFile)

		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}

		if strPosition2.Valid {
			objDocControlTetail.Mdcn_position2 = strPosition2.String
		}
		if strUserFname.Valid {
			objDocControlTetail.Su_fname = strUserFname.String
		}
		if strUserLname.Valid {
			objDocControlTetail.Su_lname = strUserLname.String
		}
		if strUserSignPath.Valid {
			objDocControlTetail.Su_sign_path = strUserSignPath.String
		}
		if strUserSignFile.Valid {
			objDocControlTetail.Su_sign_file = strUserSignFile.String
		}
		if strCreateDate.Valid {
			objDocControlTetail.Create_date = strCreateDate.String
		}
		if strUpdateDate.Valid {
			objDocControlTetail.Update_date = strUpdateDate.String
		}
		if strCreateBy.Valid {
			objDocControlTetail.Create_by = strCreateBy.String
		}
		if strUpdateBy.Valid {
			objDocControlTetail.Update_by = strUpdateBy.String
		}
		objDocControlDetailList = append(objDocControlDetailList, objDocControlTetail)
	}
	err = objListDocControl.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	var objData DocControlDetailData
	objData.Data = objDocControlDetailList
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
	objResult, err := db.Exec("INSERT INTO sys_menu_detail(smd_name, smd_link, smg_id, smd_created_date, smd_created_by, smd_updated_date, smd_updated_by) VALUES(?,?,?,?,?,?,?)", objMenuDetail.Smd_name, objMenuDetail.Smd_link, objMenuDetail.Smg_id, objMenuDetail.Create_date, objMenuDetail.Create_by, objMenuDetail.Create_date, objMenuDetail.Create_by)
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
	objResult, err := db.Exec("Update sys_menu_detail SET smd_name = ?, smd_link = ?, smd_updated_date = ?, smd_updated_by = ? WHERE smd_id = ?", objMenuDetail.Smd_name, objMenuDetail.Smd_link, objMenuDetail.Update_date, objMenuDetail.Update_by, objMenuDetail.Smd_id)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})
}
func UpdateMdcn(c *gin.Context) {
	var objDocCon DocControlNo
	if err := c.BindJSON(&objDocCon); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	objResult, err := db.Exec("Update mst_document_control_no SET mdt_id = ?, mdcn_position1 = ?, mdcn_updated_date = ?, mdcn_updated_by = ? WHERE mdcn_id = ?", objDocCon.Mdt_id, objDocCon.Mdcn_position1, objDocCon.Update_date, objDocCon.Update_by, objDocCon.Mdcn_id)
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
	objResult, err := db.Exec("Update sys_menu_detail SET smd_status = ?, smd_updated_date = ?, smd_updated_by = ? WHERE smd_id = ?", objMenuDetail.Smd_status, objMenuDetail.Update_date, objMenuDetail.Update_by, objMenuDetail.Smd_id)
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
	objListDept, err := db.Query("SELECT sd.*, su.su_firstname, su.su_lastname, su.su_sign_path, su.su_sign_file FROM `sys_department` AS sd LEFT JOIN sys_users AS su ON sd.sd_updated_by = su.su_username ORDER BY sd.sd_id")
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}

	defer objListDept.Close()
	for objListDept.Next() {
		var objDepartment DepartmentTable
		var strDeptAName sql.NullString
		var strUserFname sql.NullString
		var strUserLname sql.NullString
		var strUserSignPath sql.NullString
		var strUserSignFile sql.NullString
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString
		err := objListDept.Scan(&objDepartment.Sd_id, &objDepartment.Sd_plant_cd, &objDepartment.Sd_dept_cd, &objDepartment.Sd_dept_name, &strDeptAName, &objDepartment.Sd_status, &strCreateDate, &strCreateBy, &strUpdateDate, &strUpdateBy, &strUserFname, &strUserLname, &strUserSignPath, &strUserSignFile)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		if strDeptAName.Valid {
			objDepartment.Sd_dept_aname = strDeptAName.String
		}
		if strUserFname.Valid {
			objDepartment.Su_fname = strUserFname.String
		}
		if strUserLname.Valid {
			objDepartment.Su_lname = strUserLname.String
		}
		if strUserSignPath.Valid {
			objDepartment.Su_sign_path = strUserSignPath.String
		}
		if strUserSignFile.Valid {
			objDepartment.Su_sign_file = strUserSignFile.String
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
	err := db.QueryRow("SELECT * FROM sys_department WHERE sd_dept_name = ? and sd_dept_cd = ? and sd_id != ?", objDepartmentData.Sd_name, objDepartmentData.Sd_name_cd, objDepartmentData.Sd_id).Scan(&objDepartmentData.Sd_id, &objDepartmentData.Sd_name, &objDepartmentData.Sd_status, &objDepartmentData.Create_date, &objDepartmentData.Update_date, &objDepartmentData.Create_by, &objDepartmentData.Update_by)
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
	objResult, err := db.Exec("INSERT INTO sys_department(sd_plant_cd, sd_dept_cd, sd_dept_name, sd_dept_aname, sd_status, sd_created_date, sd_created_by, sd_updated_date, sd_updated_by) VALUES(?,?,?,?,?,?,?,?,?)", objDepartmentData.Sd_plant_cd, objDepartmentData.Sd_name_cd, objDepartmentData.Sd_Aname, objDepartmentData.Sd_name, 1, objDepartmentData.Create_date, objDepartmentData.Create_by, objDepartmentData.Create_date, objDepartmentData.Create_by)
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
	objResult, err := db.Exec("Update sys_department SET sd_dept_cd = ?, sd_dept_name = ?, sd_dept_aname = ?, sd_plant_cd = ?, sd_updated_date = ?, sd_updated_by = ? WHERE sd_id = ?", objDepartmentData.Sd_name_cd, objDepartmentData.Sd_name, objDepartmentData.Sd_Aname, objDepartmentData.Sd_plant_cd, objDepartmentData.Update_date, objDepartmentData.Update_by, objDepartmentData.Sd_id)
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
	objResult, err := db.Exec("Update sys_department SET sd_status = ?, sd_updated_date = ?, sd_updated_by = ? WHERE sd_id = ?", objDepartmentData.Sd_status, objDepartmentData.Update_date, objDepartmentData.Update_by, objDepartmentData.Sd_id)
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
	objListConsider, err := db.Query("SELECT mci.*, su.su_firstname, su.su_lastname, su.su_sign_path, su.su_sign_file FROM `mst_consideration_item` AS mci LEFT JOIN sys_users AS su ON mci.mci_updated_by = su.su_username ORDER BY mci.mci_id")
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
		err := objListConsider.Scan(&objConsider.Mci_id, &objConsider.Mci_name, &objConsider.Mci_calculate_type, &objConsider.Mci_status, &strCreateDate, &strCreateBy, &strUpdateDate, &strUpdateBy, &strUserFname, &strUserLname, &strUserImgPath, &strUserImgName)
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
			objConsider.Su_sign_path = strUserImgPath.String
		}
		if strUserImgName.Valid {
			objConsider.Su_sign_file = strUserImgName.String
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
	objResult, err := db.Exec("INSERT INTO mst_consideration_item(mci_name,mci_calculate_type,mci_status,mci_created_date,mci_created_by,mci_updated_date,mci_updated_by) VALUES(?,?,?,?,?,?,?)", objConsideration.Mci_name, objConsideration.Mci_calculate_type, 1, objConsideration.Create_date, objConsideration.Create_by, objConsideration.Create_date, objConsideration.Create_by)
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
	objResult, err := db.Exec("Update mst_consideration_item SET mci_name = ?, mci_calculate_type = ?, mci_updated_date = ?, mci_updated_by = ? WHERE mci_id = ?", objConsideration.Mci_name, objConsideration.Mci_calculate_type, objConsideration.Update_date, objConsideration.Update_by, objConsideration.Mci_id)
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
	objResult, err := db.Exec("Update mst_consideration_item SET mci_status = ?, mci_updated_date = ?, mci_updated_by = ? WHERE mci_id = ?", objConsideration.Mci_status, objConsideration.Update_date, objConsideration.Update_by, objConsideration.Mci_id)
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
	objListIncharge, err := db.Query("SELECT mcip.*, mci.mci_name, sd_dept_name, su.su_firstname, su.su_lastname, su.su_sign_path, su.su_sign_file FROM `mst_consideration_item_pic` AS mcip LEFT JOIN sys_users AS su ON mcip.mcip_updated_by = su.su_username LEFT JOIN mst_consideration_item AS mci ON mci.mci_id = mcip.mci_id LEFT JOIN sys_department AS sd ON mcip.sd_id = sd.sd_id ORDER BY mcip.mcip_id")
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
		var strUserSignPath sql.NullString
		var strUserSignFile sql.NullString
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString
		err := objListIncharge.Scan(&objIncharge.Mcip_id, &objIncharge.Mci_id, &objIncharge.Mcip_weight, &objIncharge.Sd_id, &objIncharge.Mcip_status, &strCreateDate, &strCreateBy, &strUpdateDate, &strUpdateBy, &objIncharge.Mci_name, &objIncharge.Sd_dept_name, &strUserFname, &strUserLname, &strUserSignPath, &strUserSignFile)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		if strUserFname.Valid {
			objIncharge.Su_firstname = strUserFname.String
		}
		if strUserLname.Valid {
			objIncharge.Su_lastname = strUserLname.String
		}
		if strUserSignPath.Valid {
			objIncharge.Su_sign_path = strUserSignPath.String
		}
		if strUserSignFile.Valid {
			objIncharge.Su_sign_file = strUserSignFile.String
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
	var objPartNoList []RfqGroupPart
	objListPartNo, err := db.Query("SELECT idi_id, idi_item_no, idi_item_name, idi_model, idi_remark FROM `info_document_item` WHERE idc_id = ? AND idi_status = 1 ORDER BY idi_id", c.Param("id"))
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListPartNo.Close()
	for objListPartNo.Next() {
		var objPartNo RfqGroupPart
		var strModel sql.NullString
		var strRemark sql.NullString
		err := objListPartNo.Scan(&objPartNo.Idi_id, &objPartNo.Idi_item_no, &objPartNo.Idi_item_name, &strModel, &strRemark)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		if strModel.Valid {
			objPartNo.Idi_model = strModel.String
		}
		if strRemark.Valid {
			objPartNo.Idi_remark = strRemark.String
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
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": "Invalid input: " + err.Error()})
		return
	}
	query := `SELECT mcip_id FROM mst_consideration_item_pic WHERE mci_id = ? AND sd_id = ?`

	rows, err := db.Query(query, objInchargeData.Mci_id, objInchargeData.Sd_id)
	if err != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"error": "Database query error"})
		return
	}
	defer rows.Close()

	count := 0
	for rows.Next() {
		count++
	}

	if count > 0 {
		c.IndentedJSON(http.StatusOK, true)
	} else {
		c.IndentedJSON(http.StatusOK, false)
	}
}
func InchargeIsUniqueEdit(c *gin.Context) {
	var objInchargeData ConsiderIncharge

	if err := c.BindJSON(&objInchargeData); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": "Invalid input: " + err.Error()})
		return
	}

	query := `SELECT mcip_id FROM mst_consideration_item_pic WHERE mci_id = ? AND sd_id = ? AND mcip_id != ?`

	rows, err := db.Query(query, objInchargeData.Mci_id, objInchargeData.Sd_id, objInchargeData.Mcip_id)
	if err != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"error": "Database query error"})
		return
	}
	defer rows.Close()

	count := 0
	for rows.Next() {
		count++
	}

	if count > 0 {
		c.IndentedJSON(http.StatusOK, true)
	} else {
		c.IndentedJSON(http.StatusOK, false)
	}
}

func InsertIncharge(c *gin.Context) {
	var objConsideration ConsiderIncharge
	if err := c.BindJSON(&objConsideration); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	objResult, err := db.Exec("INSERT INTO mst_consideration_item_pic(mci_id, mcip_weight, sd_id, mcip_status, mcip_created_date, mcip_created_by, mcip_updated_date, mcip_updated_by) VALUES(?, ?, ?, ?, ?, ?, ?, ?)", objConsideration.Mci_id, objConsideration.Mcip_weight, objConsideration.Sd_id, 1, objConsideration.Create_date, objConsideration.Create_by, objConsideration.Create_date, objConsideration.Create_by)
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
	objResult, err := db.Exec("Update mst_consideration_item_pic SET mci_id = ?, mcip_weight = ?, sd_id = ?, mcip_updated_date = ?, mcip_updated_by = ? WHERE mcip_id = ?", objConsideration.Mci_id, objConsideration.Mcip_weight, objConsideration.Sd_id, objConsideration.Update_date, objConsideration.Update_by, objConsideration.Mcip_id)
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
	objResult, err := db.Exec("Update mst_consideration_item_pic SET mcip_status = ?, mcip_updated_date = ?, mcip_updated_by = ? WHERE mcip_id = ?", objConsideration.Mcip_status, objConsideration.Update_date, objConsideration.Update_by, objConsideration.Mcip_id)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})
}
func ListConsideration(c *gin.Context) {
	var objConsiderationList []Consideration
	objConsideration, err := db.Query("SELECT * FROM `mst_consideration_item` WHERE mci_status=1")
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
		err := objConsideration.Scan(&objConsider.Mci_id, &objConsider.Mci_name, &objConsider.Mci_calculate_type, &objConsider.Mci_status, &strCreateDate, &strUpdateDate, &strCreateBy, &strUpdateBy)
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
		"message1": "กินข้าวหรือยังครับ",
		"stickerId": "10882",
		"stickerPackageId": "789"
	}`), &objResult)

	objRespond, err := client.R().
		// Group คุยคนเดียว
		SetHeader("Authorization", "Bearer HEz7aXgkvssjDRj84bi1KuH8GsV4f7yccpljGDtUOVl").
		// SetHeader("Authorization", "Bearer ffPxZ5rDxpVdLdHNSWWqlwGnXmnhdmeunAASbrLtrnX").
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
func NotifyAlert(c *gin.Context) {
	username := c.Param("username")
	id := c.Param("id")
	if username == "" || id == "" {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": "Missing required parameters: username or id"})
		return
	}
	var objNotifies []Notify

	rows, err := db.Query(`SELECT ida.su_id, ida.ida_created_by, snc.snc_id, snc.snc_type, snc.ida_id, snc.snc_show_users, snc.snc_read_status, snc.snc_created_date, snc.snc_updated_date FROM sys_notification_ctrl snc LEFT JOIN info_document_approval ida ON ida.ida_id = snc.ida_id LEFT JOIN info_document_control idc ON idc.idc_id = ida.idc_id WHERE ida.ida_created_by = ? OR ida.su_id = ? ORDER BY snc.snc_id DESC`, username, id)

	if err != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"error": err.Error()})
		return
	}
	defer rows.Close()

	for rows.Next() {
		var objNotify Notify
		err := rows.Scan(
			&objNotify.Su_id,
			&objNotify.Ida_created_by,
			&objNotify.Snc_id,
			&objNotify.Snc_type,
			&objNotify.Ida_id,
			&objNotify.Snc_show_users,
			&objNotify.Snc_read_status,
			&objNotify.Snc_created_date,
			&objNotify.Snc_updated_date,
		)
		if err != nil {
			c.IndentedJSON(http.StatusInternalServerError, gin.H{"error": err.Error()})
			return
		}

		objNotifies = append(objNotifies, objNotify)
	}

	if len(objNotifies) == 0 {
		c.IndentedJSON(http.StatusOK, gin.H{"message": "No data found"})
		return
	}

	c.IndentedJSON(http.StatusOK, objNotifies)
}

// Email ----------------------------------
func EmailUserData(c *gin.Context) {
	var objUser Users
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
	err := db.QueryRow("SELECT * FROM `sys_users` WHERE su_username = ?", objUser.Su_username).Scan(&objUser.Su_id, &objUser.Spg_id, &objUser.Su_username, &objUser.Su_password, &objUser.Su_firstname, &objUser.Su_lastname, &objUser.Su_email, &objUser.Sd_id, &strUserImgPath, &strUserImgName, &objUser.Su_status, &strCreateDate, &strCreateBy, &strUpdateDate, &strUpdateBy, &objUser.Su_last_accress)
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
func NotifyUpdate(c *gin.Context) {
	iId := c.Param("id")
	_, err := db.Exec("Update sys_notification_ctrl SET snc_read_status = 1 WHERE snc_id = ?", iId)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}

	c.IndentedJSON(http.StatusOK, "Success")
}

func SendMail(c *gin.Context, docId int, idaId int, userName string, userEmail string, caseType string) error {
	type EmailApprove struct {
		DocId        int
		Username     string
		Detail       string
		detailReject string
		LinkApporve  string
		LinkReject   string
		LinkPreview  string
	}
	type Document struct {
		Idc_id         int    `json:"idc_id"`
		Idc_running_no string `json:"idc_running_no"`
	}

	var templateMail string
	var detail string
	var detailReject string

	MAILER_HOST := "smtp.office365.com"
	MAILER_PORT := 25
	MAILER_USERNAME := "admin_pcsystem@tbkk.co.th"
	MAILER_PASSWORD := "AvZZ$4"

	var objDocument Document
	queryGetRefer := "SELECT idc_running_no FROM info_document_control WHERE idc_id = ?"
	err := db.QueryRow(queryGetRefer, docId).Scan(&objDocument.Idc_running_no)
	if err != nil {
		if err == sql.ErrNoRows {
			c.IndentedJSON(http.StatusOK, gin.H{"Error": "No data found"})
		} else {
			c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
		}
		return err
	}

	docIdStr := strconv.Itoa(docId)
	encodedDocId := base64.StdEncoding.EncodeToString([]byte(docIdStr))

	idaIdStr := strconv.Itoa(idaId)
	encodedIdaId := base64.StdEncoding.EncodeToString([]byte(idaIdStr))

	approveURL := "http://172.21.64.221:8081/Welcome/approveEmail/?documentId=" + encodedDocId + "&idaId=" + encodedIdaId + "&type=" + base64.StdEncoding.EncodeToString([]byte("waiting"))
	rejectURL := "http://172.21.64.221:8081/Welcome/approveEmail/?documentId=" + encodedDocId + "&idaId=" + encodedIdaId + "&type=" + base64.StdEncoding.EncodeToString([]byte("reject"))
	previewURL := "http://172.21.64.221:8081/Welcome/approveEmail/?documentId=" + encodedDocId + "&idaId=" + encodedIdaId + "&type=" + base64.StdEncoding.EncodeToString([]byte("preview"))

	if caseType == "waiting" {
		templateMail = "template/email_template2.html"
		detail = `You have a new document "` + objDocument.Idc_running_no + `" that needs approval.`
	} else if caseType == "approve" {
		templateMail = "template/email_template3.html"
		detail = `Your document "` + objDocument.Idc_running_no + `" has been approved`
	} else if caseType == "reject" {
		templateMail = "template/email_template3.html"
		detail = `Your document "` + objDocument.Idc_running_no + `" has been rejected`
	}

	data := EmailApprove{
		DocId:        docId,
		Username:     userName,
		Detail:       detail,
		detailReject: detailReject,
		LinkApporve:  approveURL,
		LinkReject:   rejectURL,
		LinkPreview:  previewURL,
	}

	tmpl, err := template.ParseFiles(templateMail)
	if err != nil {
		log.Fatalf("Failed to parse template: %v. Please check if the file exists at: %s", err, templateMail)
	}

	var body bytes.Buffer
	if err := tmpl.Execute(&body, data); err != nil {
		log.Fatalf("Failed to execute template: %v", err)
	}

	mailer := gomail.NewMessage()
	mailer.SetHeader("From", MAILER_USERNAME)
	mailer.SetHeader("To", userEmail)
	mailer.SetHeader("Subject", "New Document From CRM System")
	mailer.SetBody("text/html", body.String())

	// (Optional) แนบไฟล์
	// mailer.Attach("path/to/file.pdf")

	// ตั้งค่า SMTP
	dialer := gomail.NewDialer(MAILER_HOST, MAILER_PORT, MAILER_USERNAME, MAILER_PASSWORD)

	// ส่งอีเมล
	err = dialer.DialAndSend(mailer)
	if err != nil {
		return err
	}

	return nil
}

func ApproveByEmail(c *gin.Context) {
	type Document struct {
		Idc_id         int    `json:"idc_id"`
		Idc_running_no string `json:"idc_running_no"`
	}
	type notiActive struct {
		Ida_id    int    `json:"ida_id"`
		Su_id     int    `json:"su_id"`
		Ida_count string `json:"ida_count"`
		Sat_id    int    `json:"sat_id"`
	}
	type userEmail struct {
		Su_id        int    `json:"su_id"`
		Su_firstname string `json:"su_firstname"`
		Su_email     string `json:"su_email"`
		Su_username  string `json:"su_username"`
	}
	type userCreate struct {
		Su_id        int    `json:"su_id"`
		Su_firstname string `json:"su_firstname"`
		Su_email     string `json:"su_email"`
	}

	docID := c.Param("documentId")
	idaID := c.Param("idaId")
	caseType := c.Param("caseType")
	strCreateDate := time.Now().Format("2006-01-02 15:04:05")
	strShowUsers := "You have a new document!"
	strShowUsers2 := "Your document has been approved!"

	var objUserCreate userCreate
	getEmail := "SELECT su.su_id, su.su_firstname, su.su_email FROM sys_users su LEFT JOIN info_document_control idc ON idc.idc_created_by = su.su_username WHERE idc.idc_id = ?"
	err := db.QueryRow(getEmail, docID).Scan(&objUserCreate.Su_id, &objUserCreate.Su_firstname, &objUserCreate.Su_email)

	if err != nil {
		if err == sql.ErrNoRows {
			c.IndentedJSON(http.StatusOK, gin.H{"Error": "No user found"})
			return
		}
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
		return
	}

	var cheIda int
	checkIda := "SELECT ida_id FROM info_document_approval WHERE ida_id = ? AND ida_action = 0"
	err = db.QueryRow(checkIda, idaID).Scan(&cheIda)
	if err != nil {
		if err == sql.ErrNoRows {
			c.IndentedJSON(http.StatusOK, "This document has already been approved")
			return
		}
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
		return
	} else {
		var objNotiActive notiActive
		err = db.QueryRow("SELECT ida_id, su_id, COUNT(ida_id) AS ida_count, MIN(sat_id) AS sat_id FROM info_document_approval WHERE idc_id = ? AND ida_action = 0 AND ida_status = 1", docID).Scan(&objNotiActive.Ida_id, &objNotiActive.Su_id, &objNotiActive.Ida_count, &objNotiActive.Sat_id)
		if err == sql.ErrNoRows {
			c.IndentedJSON(http.StatusOK, false)
			return
		}

		var objEmail userEmail
		getEmail := "SELECT su_id, su_firstname, su_email, su_username FROM sys_users WHERE su_id = ?"
		err = db.QueryRow(getEmail, objNotiActive.Su_id).Scan(&objEmail.Su_id, &objEmail.Su_firstname, &objEmail.Su_email, &objEmail.Su_username)

		if err != nil {
			if err == sql.ErrNoRows {
				c.IndentedJSON(http.StatusOK, gin.H{"Error": "No user found"})
				return
			}
			c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
			return
		}

		var updateIda string
		if caseType == "email" {
			updateIda = "UPDATE info_document_approval SET ida_action = 1, ida_status = 9, ida_route = 2, ida_updated_date = ?, ida_updated_by = ? WHERE idc_id = ? AND ida_id = ?"
		} else {
			updateIda = "UPDATE info_document_approval SET ida_action = 1, ida_status = 9, ida_route = 1, ida_updated_date = ?, ida_updated_by = ? WHERE idc_id = ? AND ida_id = ?"
		}
		_, err = db.Exec(updateIda, strCreateDate, objEmail.Su_username, docID, idaID)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
			return
		} else {
			_, err = db.Exec("INSERT INTO sys_notification_ctrl(snc_type, ida_id, snc_show_users, snc_read_status, snc_created_date, snc_updated_date) VALUES(?, ?, ?, ?, ?, ?)", 2, idaID, strShowUsers2, 0, strCreateDate, strCreateDate)
			if err != nil {
				c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
			}

			var objNotiActive notiActive
			err = db.QueryRow("SELECT ida_id, su_id, COUNT(ida_id) AS ida_count, MIN(sat_id) AS sat_id FROM info_document_approval WHERE idc_id = ? AND ida_action = 0 AND ida_status = 1", docID).Scan(&objNotiActive.Ida_id, &objNotiActive.Su_id, &objNotiActive.Ida_count, &objNotiActive.Sat_id)
			if err == sql.ErrNoRows {
				c.IndentedJSON(http.StatusOK, false)
				return
			} else {
				idcId, err := strconv.Atoi(docID)
				if err != nil {
					fmt.Println("Error converting to int:", err)
					return
				}

				if objNotiActive.Ida_count == "0" || objNotiActive.Ida_count == "" {
					err = InsertReferDoc(c, idcId)
					if err != nil {
						c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
						return
					}

					err = SendMail(c, idcId, objNotiActive.Ida_id, objUserCreate.Su_firstname, objUserCreate.Su_email, "approve")
					if err != nil {
						c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
						return
					}

					var strUpdatedByEmp string
					getUser := db.QueryRow("SELECT idc_created_by FROM info_document_control WHERE idc_id = ?", idcId).Scan(&strUpdatedByEmp)
					if getUser != nil {
						c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error1": getUser.Error()})
						return
					}
					_, err = db.Exec("UPDATE info_document_control SET idc_status = 9, idc_updated_date = ?, idc_updated_by = ? WHERE idc_Id = ?", strCreateDate, strUpdatedByEmp, idcId)
					if err != nil {
						c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
						return
					}

				} else {
					_, err = db.Exec("INSERT INTO sys_notification_ctrl(snc_type, ida_id, snc_show_users, snc_read_status, snc_created_date, snc_updated_date) VALUES(?, ?, ?, ?, ?, ?)", 1, objNotiActive.Ida_id, strShowUsers, 0, strCreateDate, strCreateDate)
					if err != nil {
						c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
					}

					var objEmail userEmail
					getEmail := "SELECT su_id, su_firstname, su_email, su_username FROM sys_users WHERE su_id = ?"
					err = db.QueryRow(getEmail, objNotiActive.Su_id).Scan(&objEmail.Su_id, &objEmail.Su_firstname, &objEmail.Su_email, &objEmail.Su_username)

					if err != nil {
						if err == sql.ErrNoRows {
							c.IndentedJSON(http.StatusOK, gin.H{"Error": "No user found"})
							return
						}
						c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
						return
					}

					err = SendMail(c, idcId, objNotiActive.Ida_id, objUserCreate.Su_firstname, objUserCreate.Su_email, "approve")
					if err != nil {
						c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
						return
					}

					err = SendMail(c, idcId, objNotiActive.Ida_id, objEmail.Su_firstname, objEmail.Su_email, "waiting")
					if err != nil {
						c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
						return
					}
				}
			}
		}
	}

	c.IndentedJSON(http.StatusOK, true)
}

func RejectByEmail(c *gin.Context) {
	type notiActive struct {
		Ida_id    int    `json:"ida_id"`
		Su_id     int    `json:"su_id"`
		Ida_count string `json:"ida_count"`
		Sat_id    int    `json:"sat_id"`
	}
	type userEmail struct {
		Su_id        int    `json:"su_id"`
		Su_firstname string `json:"su_firstname"`
		Su_email     string `json:"su_email"`
		Su_username  string `json:"su_username"`
	}
	type userCreate struct {
		Su_id        int    `json:"su_id"`
		Su_firstname string `json:"su_firstname"`
		Su_email     string `json:"su_email"`
	}

	docID := c.Param("documentId")
	idaID := c.Param("idaId")
	reason := c.Param("reason")
	caseType := c.Param("caseType")
	strCreateDate := time.Now().Format("2006-01-02 15:04:05")
	var objNotiActive notiActive
	strShowUsers := "Your document has been rejected!"

	var cheIda int
	checkIda := "SELECT ida_id FROM info_document_approval WHERE ida_id = ? AND ida_action = 0"
	err := db.QueryRow(checkIda, idaID).Scan(&cheIda)
	if err != nil {
		if err == sql.ErrNoRows {
			c.IndentedJSON(http.StatusOK, "This document has already been rejected")
			return
		}
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
		return
	} else {
		err = db.QueryRow("SELECT ida_id, su_id, COUNT(ida_id) AS ida_count, MIN(sat_id) AS sat_id FROM info_document_approval WHERE idc_id = ? AND ida_action = 0 AND ida_status = 1", docID).Scan(&objNotiActive.Ida_id, &objNotiActive.Su_id, &objNotiActive.Ida_count, &objNotiActive.Sat_id)
		if err == sql.ErrNoRows {
			c.IndentedJSON(http.StatusOK, false)
			return
		} else {
			var objEmail userEmail
			getEmail := "SELECT su_id, su_firstname, su_email, su_username FROM sys_users WHERE su_id = ?"
			err := db.QueryRow(getEmail, objNotiActive.Su_id).Scan(&objEmail.Su_id, &objEmail.Su_firstname, &objEmail.Su_email, &objEmail.Su_username)

			if err != nil {
				if err == sql.ErrNoRows {
					c.IndentedJSON(http.StatusOK, gin.H{"Error": "No user found"})
					return
				}
				c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
				return
			} else {
				updateIda := "UPDATE info_document_approval SET ida_status = 6 WHERE idc_id = ?"
				_, err := db.Exec(updateIda, docID)
				if err != nil {
					c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
					return
				} else {
					var updateIdaBy string
					if caseType == "email" {
						updateIdaBy = "UPDATE info_document_approval SET ida_action = 1, ida_route = 2, ida_reject_reason = ?, ida_updated_date = ?, ida_updated_by = ? WHERE idc_id = ? AND ida_id = ? AND su_id = ?"
					} else {
						updateIdaBy = "UPDATE info_document_approval SET ida_action = 1, ida_route = 1, ida_reject_reason = ?, ida_updated_date = ?, ida_updated_by = ? WHERE idc_id = ? AND ida_id = ? AND su_id = ?"
					}

					_, err = db.Exec(updateIdaBy, reason, strCreateDate, objEmail.Su_username, docID, objNotiActive.Ida_id, objNotiActive.Su_id)
					if err != nil {
						c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
						return
					} else {
						_, err := db.Exec("UPDATE temp_refer_document SET trd_status = 5, trd_updated_date = ? WHERE idc_id = ?", strCreateDate, docID)
						if err != nil {
							c.IndentedJSON(http.StatusInternalServerError, gin.H{
								"Error": err.Error(),
							})
							return
						} else {
							_, err := db.Exec("UPDATE info_document_control SET idc_status = 6, idc_updated_date = ?, idc_updated_by = ? WHERE idc_id = ?", strCreateDate, objEmail.Su_username, docID)
							if err != nil {
								c.IndentedJSON(http.StatusInternalServerError, gin.H{
									"Error": err.Error(),
								})
								return
							} else {
								var objUserCreate userCreate
								getEmail := "SELECT su.su_id, su.su_firstname, su.su_email FROM sys_users su LEFT JOIN info_document_control idc ON idc.idc_created_by = su.su_username WHERE idc.idc_id = ?"
								err := db.QueryRow(getEmail, docID).Scan(&objUserCreate.Su_id, &objUserCreate.Su_firstname, &objUserCreate.Su_email)

								if err != nil {
									if err == sql.ErrNoRows {
										c.IndentedJSON(http.StatusOK, gin.H{"Error": "No user found"})
										return
									}
									c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
									return
								}
								idcId, err := strconv.Atoi(docID)
								if err != nil {
									fmt.Println("Error converting to int:", err)
									return
								}

								_, err = db.Exec("INSERT INTO sys_notification_ctrl(snc_type, ida_id, snc_show_users, snc_read_status, snc_created_date, snc_updated_date) VALUES(?, ?, ?, ?, ?, ?)", 2, objNotiActive.Ida_id, strShowUsers, 0, strCreateDate, strCreateDate)
								if err != nil {
									c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
								}
								var doc_no string
								err = db.QueryRow("SELECT idc_running_no FROM info_document_control WHERE idc_id = ?", docID).Scan(&doc_no)
								if err != nil {
									c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error1.1": err.Error()})
									return
								}
								substring := doc_no[:3]

								if substring == "NBC" {
									_, err = db.Exec("UPDATE info_document_control SET idc_result_confirm = 1 WHERE idc_Id = ?", docID)
									if err != nil {
										c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
										return
									}
								}

								err = SendMail(c, idcId, objNotiActive.Ida_id, objUserCreate.Su_firstname, objUserCreate.Su_email, "reject")
								if err != nil {
									c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
									return
								}
							}
						}
					}
				}
			}
		}
	}

	c.IndentedJSON(http.StatusOK, true)
}
