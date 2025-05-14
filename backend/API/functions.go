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
	var order int
	if err := c.BindJSON(&objMenuDetail); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}

	query := `SELECT IFNULL(MAX(smd_order_no) + 1 , 0 + 1) AS max_order FROM sys_menu_detail WHERE smg_id = ?`
	err := db.QueryRow(query, objMenuDetail.Smg_id).Scan(&order)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}

	objResult, err := db.Exec("INSERT INTO sys_menu_detail(smd_name, smd_link, smd_order_no, smg_id, smd_created_date, smd_created_by, smd_updated_date, smd_updated_by) VALUES(?,?,?,?,?,?,?,?)", objMenuDetail.Smd_name, objMenuDetail.Smd_link, order, objMenuDetail.Smg_id, objMenuDetail.Create_date, objMenuDetail.Create_by, objMenuDetail.Create_date, objMenuDetail.Create_by)
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
	objResult, err := db.Exec("INSERT INTO sys_department(sd_plant_cd, sd_dept_cd, sd_dept_name, sd_dept_aname, sd_status, sd_created_date, sd_created_by, sd_updated_date, sd_updated_by) VALUES(?,?,?,?,?,?,?,?,?)", objDepartmentData.Sd_plant_cd, objDepartmentData.Sd_name_cd, objDepartmentData.Sd_name, objDepartmentData.Sd_Aname, 1, objDepartmentData.Create_date, objDepartmentData.Create_by, objDepartmentData.Create_date, objDepartmentData.Create_by)
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
	objListIncharge, err := db.Query("SELECT mcip.*, mci.mci_name, sd_dept_aname, sd_dept_name, su.su_firstname, su.su_lastname, su.su_sign_path, su.su_sign_file FROM `mst_consideration_item_pic` AS mcip LEFT JOIN sys_users AS su ON mcip.mcip_updated_by = su.su_username LEFT JOIN mst_consideration_item AS mci ON mci.mci_id = mcip.mci_id LEFT JOIN sys_department AS sd ON mcip.sd_id = sd.sd_id ORDER BY mcip.mcip_id")
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
		err := objListIncharge.Scan(&objIncharge.Mcip_id, &objIncharge.Mci_id, &objIncharge.Mcip_weight, &objIncharge.Sd_id, &objIncharge.Mcip_status, &strCreateDate, &strCreateBy, &strUpdateDate, &strUpdateBy, &objIncharge.Mci_name, &objIncharge.Sd_dept_aname, &objIncharge.Sd_dept_name, &strUserFname, &strUserLname, &strUserSignPath, &strUserSignFile)
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

	rows, err := db.Query(`SELECT ida.su_id, ida.ida_created_by, snc.snc_id, snc.snc_type, snc.ida_id, snc.snc_show_users, snc.snc_read_status, snc.snc_created_date, snc.snc_updated_date FROM sys_notification_ctrl snc LEFT JOIN info_document_approval ida ON ida.ida_id = snc.ida_id LEFT JOIN info_document_control idc ON idc.idc_id = ida.idc_id WHERE (ida.ida_created_by = ? OR ida.su_id = ?) AND YEAR(snc.snc_created_date) = YEAR(CURDATE()) AND MONTH(snc.snc_created_date) = MONTH(CURDATE()) ORDER BY snc.snc_id DESC`, username, id)

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
		DocId             int
		Username          string
		Detail            string
		ReferenceDocument string
		Customer          string
		Subject           string
		ProjectLife       int
		ProjectStart      string
		TableDetail       template.HTML
		detailReject      string
		LinkApporve       string
		LinkReject        string
		LinkPreview       string
	}
	type Document struct {
		Idc_id         int    `json:"idc_id"`
		Idc_running_no string `json:"idc_running_no"`
	}

	var templateMail string
	var detail string
	var detailReject string
	var tableBody string
	var tableDetail string

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

	var Fullname string
	queryGetActionBy := "SELECT CONCAT(su.su_firstname, ' ', su.su_lastname) AS fullname FROM info_document_approval ida LEFT JOIN sys_users su ON su.su_id = ida.su_id WHERE ida.ida_id = ?"
	err = db.QueryRow(queryGetActionBy, idaId).Scan(&Fullname)
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
		detail = `Your document "` + objDocument.Idc_running_no + `" has been approved by ` + Fullname
	} else if caseType == "reject" {
		templateMail = "template/email_template3.html"
		detail = `Your document "` + objDocument.Idc_running_no + `" has been rejected by ` + Fullname
	}

	var DatareferenceDocument string
	var Datacustomer string
	var Datasubject string
	var DataprojectLife int
	var DataprojectStart string
	otherDetailQuery := "SELECT IFNULL(( SELECT tb2.idc_running_no FROM info_document_control tb2 WHERE tb2.idc_id = idc.idc_refer_doc ), '-') AS refer_doc, idc.idc_customer_name, CASE WHEN idc.mds_id = 4 THEN idc.idc_subject_note ELSE mds.mds_name END AS subject_name, idc.idc_project_life, idc.idc_project_start FROM info_document_control idc LEFT JOIN mst_document_subject mds ON mds.mds_id = idc.mds_id WHERE idc.idc_id = ?"
	err = db.QueryRow(otherDetailQuery, docId).Scan(&DatareferenceDocument, &Datacustomer, &Datasubject, &DataprojectLife, &DataprojectStart)
	if err != nil {
		if err == sql.ErrNoRows {
			c.IndentedJSON(http.StatusOK, gin.H{"Error": "No data found"})
		} else {
			c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
		}
		return err
	}

	var docType int
	docTypeQuery := "SELECT mdt_id FROM info_document_control WHERE idc_id = ?"
	err = db.QueryRow(docTypeQuery, docId).Scan(&docType)
	if err != nil {
		if err == sql.ErrNoRows {
			c.IndentedJSON(http.StatusOK, gin.H{"Error": "No data found"})
		} else {
			c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
		}
		return err
	}

	if docType == 1 {
		type ConsernDetail struct {
			Mcip_weight string  `json:"mcip_weight"`
			Ifs_score   float64 `json:"ifs_score"`
			Ifs_total   float64 `json:"ifs_total"`
			Mci_name    string  `json:"mci_name"`
			Ifs_comment string  `json:"ifs_comment"`
		}

		var ojbScoreDetail []ConsernDetail
		queryScoreDetail := "SELECT mcip.mcip_weight, ifs.ifs_score, ifs.ifs_total, mci.mci_name, CASE WHEN ifs.ifs_comment IS NULL OR ifs.ifs_comment = '' THEN '-' ELSE ifs.ifs_comment END AS ifs_comment FROM info_feasibility_score ifs LEFT JOIN mst_consideration_item_pic mcip ON mcip.mcip_id = ifs.mcip_id LEFT JOIN mst_consideration_item mci ON mci.mci_id = mcip.mci_id WHERE ifs.idc_id = (SELECT idc_id FROM info_document_approval WHERE ida_id = ?) AND mcip.sd_id = (SELECT swg.sd_id FROM info_document_approval ida LEFT JOIN sys_workflow_group swg ON swg.swg_id = ida.swg_id WHERE ida_id = ?)"
		rows, err := db.Query(queryScoreDetail, idaId, idaId)
		if err != nil {
			if err == sql.ErrNoRows {
				c.IndentedJSON(http.StatusOK, gin.H{"Error": "No data found"})
			} else {
				c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
			}
			return err
		}
		for rows.Next() {
			var objScoreDetail ConsernDetail
			if err := rows.Scan(&objScoreDetail.Mcip_weight, &objScoreDetail.Ifs_score, &objScoreDetail.Ifs_total, &objScoreDetail.Mci_name, &objScoreDetail.Ifs_comment); err != nil {
				c.IndentedJSON(http.StatusInternalServerError, gin.H{"error": "Failed to scan row data"})
				return err
			}
			ojbScoreDetail = append(ojbScoreDetail, objScoreDetail)
		}

		if err := rows.Err(); err != nil {
			c.IndentedJSON(http.StatusInternalServerError, gin.H{"error": "Error occurred while reading rows"})
			return err
		}

		for i := range ojbScoreDetail {
			tableDetail += `<tr>
								<td style="border: 1px solid #b0d4f1; padding: 8px 12px; text-align: center;">` + ojbScoreDetail[i].Mcip_weight + `</td>
								<td style="border: 1px solid #b0d4f1; padding: 8px 12px; text-align: center;">` + strconv.FormatFloat(ojbScoreDetail[i].Ifs_score, 'f', -1, 64) + `</td>
								<td style="border: 1px solid #b0d4f1; padding: 8px 12px; text-align: center;">` + strconv.FormatFloat(ojbScoreDetail[i].Ifs_total, 'f', -1, 64) + `</td>
								<td style="border: 1px solid #b0d4f1; padding: 8px 12px; text-align: center;">` + ojbScoreDetail[i].Mci_name + `</td>	
								<td style="border: 1px solid #b0d4f1; padding: 8px 12px; text-align: center;">` + ojbScoreDetail[i].Ifs_comment + `</td>
							</tr>`

			tableBody = `<tr>
                        <td style="padding: 20px 0;">
                            <table role="presentation" cellspacing="0" cellpadding="10" border="0" align="center"
                                style="margin: 0 auto; border-collapse: collapse; width: 100%; font-family: Arial, sans-serif; font-size: 14px; color: #333; border: 1px solid #b0d4f1;">
                                <thead>
                                    <tr style="background-color: #e1f0fb;">
                                        <th style="border: 1px solid #b0d4f1; padding: 8px 12px; text-align: center;">
                                            Weight</th>
                                        <th style="border: 1px solid #b0d4f1; padding: 8px 12px; text-align: center;">
                                            Score</th>
                                        <th style="border: 1px solid #b0d4f1; padding: 8px 12px; text-align: center;">
                                            Total</th>
                                        <th style="border: 1px solid #b0d4f1; padding: 8px 12px; text-align: center;">
                                            Consideration</th>
                                        <th style="border: 1px solid #b0d4f1; padding: 8px 12px; text-align: center;">
                                            Comment</th>
                                    </tr>
                                </thead>
                                <tbody>
									` + tableDetail + `
                                </tbody>
                            </table>
                        </td>
                    </tr>`
		}
	} else {
		tableBody = ``
	}

	data := EmailApprove{
		DocId:             docId,
		Username:          userName,
		Detail:            detail,
		ReferenceDocument: DatareferenceDocument,
		Customer:          Datacustomer,
		Subject:           Datasubject,
		ProjectLife:       DataprojectLife,
		ProjectStart:      DataprojectStart,
		TableDetail:       template.HTML(tableBody),
		detailReject:      detailReject,
		LinkApporve:       approveURL,
		LinkReject:        rejectURL,
		LinkPreview:       previewURL,
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
		Sd_id        int    `json:"sd_id"`
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

	var cheIdc int
	checkIda := "SELECT idc_status FROM info_document_control WHERE idc_id = ?"
	err = db.QueryRow(checkIda, docID).Scan(&cheIdc)
	if err != nil {
		if err == sql.ErrNoRows {
			c.IndentedJSON(http.StatusOK, "This document not found!")
			return
		}
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
		return
	} else {
		if cheIdc == 6 || cheIdc == 5 || cheIdc == 9 || cheIdc == 1 {
			statuses := map[int]string{
				6: "rejected",
				5: "cancelled",
				9: "approved",
				1: "not submitted",
			}
			c.IndentedJSON(http.StatusOK, fmt.Sprintf("This document has been %s!", statuses[cheIdc]))
			return
		}

		var cheIdaStatus int
		checkIdaStatus := "SELECT ida_status FROM info_document_approval WHERE ida_id = ?"
		err = db.QueryRow(checkIdaStatus, idaID).Scan(&cheIdaStatus)
		if err != nil {
			if err == sql.ErrNoRows {
				c.IndentedJSON(http.StatusOK, "This document not found!")
				return
			}
			c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
			return
		}
		// log.Println("IDA_ID => ", idaID)
		// log.Println("IDA_STATUS => ", cheIdaStatus)
		if cheIdaStatus == 6 || cheIdaStatus == 5 || cheIdaStatus == 9 {
			statuses := map[int]string{
				6: "rejected",
				5: "cancelled",
				9: "approved",
			}
			c.IndentedJSON(http.StatusOK, fmt.Sprintf("This document has been %s!", statuses[cheIdaStatus]))
			return
		}

		var chkMdt int
		sqlMdt := "SELECT mdt_id FROM info_document_control WHERE idc_id = ?"
		err := db.QueryRow(sqlMdt, docID).Scan(&chkMdt)
		if err == sql.ErrNoRows {
			c.IndentedJSON(http.StatusOK, "This document not found!")
			return
		} else {
			if chkMdt == 1 {
				var objEmailFS userEmail
				var idaSendMail int
				var chkOterDept int
				getEmail := "SELECT su.su_id, su.su_firstname, su.su_email, su.su_username, su.sd_id FROM sys_users su LEFT JOIN info_document_approval ida ON ida.su_id = su.su_id WHERE ida.ida_id = ? GROUP BY ida.su_id"
				err := db.QueryRow(getEmail, idaID).Scan(&objEmailFS.Su_id, &objEmailFS.Su_firstname, &objEmailFS.Su_email, &objEmailFS.Su_username, &objEmailFS.Sd_id)

				if err == sql.ErrNoRows {
					c.IndentedJSON(http.StatusOK, "No user found")
					return
				}

				var updateIda string
				if caseType == "email" {
					updateIda = "UPDATE info_document_approval SET ida_action = 1, ida_status = 9, ida_route = 2, ida_updated_date = ?, ida_updated_by = ? WHERE idc_id = ? AND su_id = ?"
				} else {
					updateIda = "UPDATE info_document_approval SET ida_action = 1, ida_status = 9, ida_route = 1, ida_updated_date = ?, ida_updated_by = ? WHERE idc_id = ? AND su_id = ?"
				}
				_, err = db.Exec(updateIda, strCreateDate, objEmailFS.Su_username, docID, objEmailFS.Su_id)
				if err != nil {
					c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
					return
				} else {
					getSendIda := "SELECT MIN(ida_id) AS ida_id FROM info_document_approval WHERE su_id = ? AND idc_id = ?"
					err = db.QueryRow(getSendIda, objEmailFS.Su_id, docID).Scan(&idaSendMail)
					if err != nil {
						c.IndentedJSON(http.StatusOK, fmt.Sprintf("Error get send ida: %s", err))
						return
					}

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

					_, err = db.Exec("UPDATE info_feasibility_score AS ifs JOIN mst_consideration_item_pic AS mcip ON mcip.mcip_id = ifs.mcip_id JOIN sys_department AS sd ON sd.sd_id = mcip.sd_id SET ifs.ifs_status = 9, ifs.ifs_updated_date = ?, ifs.ifs_updated_by = ? WHERE ifs.idc_id = ? AND mcip.sd_id = ?", strCreateDate, objEmailFS.Su_username, docID, objEmailFS.Sd_id)
					if err != nil {
						c.IndentedJSON(http.StatusInternalServerError, gin.H{
							"Error": err.Error(),
						})
						return
					}

					idcId, err := strconv.Atoi(docID)
					if err != nil {
						fmt.Println("Error converting to int:", err)
						return
					}

					_, err = db.Exec("INSERT INTO sys_notification_ctrl(snc_type, ida_id, snc_show_users, snc_read_status, snc_created_date, snc_updated_date) VALUES(?, ?, ?, ?, ?, ?)", 2, idaSendMail, strShowUsers2, 0, strCreateDate, strCreateDate)
					if err != nil {
						c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
					}

					err = SendMail(c, idcId, idaSendMail, objUserCreate.Su_firstname, objUserCreate.Su_email, "approve")
					if err != nil {
						c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
						return
					}
				}

				var chkStatusAll int
				err = db.QueryRow(`SELECT CASE WHEN COUNT(*) = SUM(ifs_status = 9) THEN 1 ELSE 0 END AS all_done FROM info_feasibility_score WHERE idc_id = ?`, docID).Scan(&chkStatusAll)
				if err != nil {
					c.IndentedJSON(http.StatusInternalServerError, gin.H{"error": "Failed to execute query"})
					return
				}

				if chkStatusAll == 1 {
					var userCreateDoc string
					err = db.QueryRow(`SELECT COUNT(DISTINCT su.su_id) AS dept FROM info_document_approval ida LEFT JOIN sys_users su ON su.su_id = ida.su_id WHERE idc_id = ?`, docID).Scan(&chkOterDept)
					if err != nil {
						c.IndentedJSON(http.StatusInternalServerError, gin.H{"error": "Failed to execute query"})
						return
					}

					err = db.QueryRow(`SELECT idc_created_by FROM info_document_control WHERE idc_id = ?`, docID).Scan(&userCreateDoc)
					if err != nil {
						c.IndentedJSON(http.StatusInternalServerError, gin.H{"error": "Failed to execute query"})
						return
					}

					if chkOterDept == 5 {
						type DocAppData struct {
							Sd_id    int
							Deptname string
							SwgId    int
							UserID   int
							SatID    int
						}

						type notiActive struct {
							Ida_id       int    `json:"ida_id"`
							Su_id        int    `json:"su_id"`
							Su_firstname string `json:"su_firstname"`
							Su_email     string `json:"su_email"`
						}

						query := `SELECT sd.sd_id, sd.sd_dept_aname, swd.swg_id, swd.su_id, swd.sat_id FROM sys_workflow_detail swd LEFT JOIN sys_workflow_group swg ON swd.swg_id = swg.swg_id LEFT JOIN sys_department sd ON sd.sd_id = swg.sd_id WHERE swg.sd_id IN (41, 20, 47) AND swd.sat_id = (SELECT MAX(swd_inner.sat_id) FROM sys_workflow_detail swd_inner LEFT JOIN sys_workflow_group swg_inner ON swd_inner.swg_id = swg_inner.swg_id LEFT JOIN sys_department sd_inner ON sd_inner.sd_id = swg_inner.sd_id WHERE sd_inner.sd_dept_aname = sd.sd_dept_aname) AND swd.swd_status = 1 ORDER BY swd.swg_id`

						rows, err := db.Query(query)
						if err != nil {
							c.IndentedJSON(http.StatusInternalServerError, gin.H{"error": "Failed to execute query"})
							return
						}
						defer rows.Close()

						var otherDept []DocAppData
						for rows.Next() {
							var data DocAppData
							if err := rows.Scan(&data.Sd_id, &data.Deptname, &data.SwgId, &data.UserID, &data.SatID); err != nil {
								c.IndentedJSON(http.StatusInternalServerError, gin.H{"error": "Failed to scan row data"})
								return
							}
							otherDept = append(otherDept, data)
						}
						if err := rows.Err(); err != nil {
							c.IndentedJSON(http.StatusInternalServerError, gin.H{"error": "Error occurred while reading rows"})
							return
						}

						idcId, err := strconv.Atoi(docID)
						if err != nil {
							fmt.Println("Error converting to int:", err)
							return
						}

						var countSeqNo int
						err = db.QueryRow(`SELECT IFNULL(MAX(ida_seq_no), 0) + 1 AS count FROM info_document_approval WHERE idc_id = ?`, idcId).Scan(&countSeqNo)
						if err != nil {
							c.IndentedJSON(http.StatusInternalServerError, gin.H{"error": "Failed to execute query"})
							return
						}

						// Insert Approval
						var sqlIda string = "INSERT INTO info_document_approval (swg_id, su_id, sat_id, ida_seq_no, idc_id, ida_created_date, ida_created_by, ida_updated_date, ida_updated_by) VALUES "
						objListIda := []string{}
						for _, consItem := range otherDept {
							objIda := fmt.Sprintf("(%d, %d, %d, %d, %d, '%s', '%s', '%s', '%s')",
								consItem.SwgId,
								consItem.UserID,
								consItem.SatID,
								countSeqNo,
								idcId,
								strCreateDate,
								userCreateDoc,
								strCreateDate,
								userCreateDoc,
							)
							objListIda = append(objListIda, objIda)
							countSeqNo++
						}

						if len(objListIda) == 0 {
							c.IndentedJSON(http.StatusBadRequest, gin.H{"error": "ไม่มีข้อมูลที่สามารถบันทึกได้"})
							return
						}

						sqlIda += strings.Join(objListIda, ",")

						_, errIda := db.Exec(sqlIda)
						if errIda != nil {
							c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error3": errIda.Error()})
							return
						}

						query = `SELECT ida.ida_id, ida.su_id, CONCAT(su.su_firstname, ' ', su.su_lastname) AS su_firstname, su.su_email FROM info_document_approval ida LEFT JOIN sys_users su ON su.su_id = ida.su_id WHERE ida.idc_id = ? AND ida.ida_action = 0 GROUP BY su_id`

						rowsUserApp, err := db.Query(query, idcId)
						if err != nil {
							c.IndentedJSON(http.StatusInternalServerError, gin.H{"error": "Failed to execute query"})
							return
						}
						defer rowsUserApp.Close()

						var results []notiActive
						for rowsUserApp.Next() {
							var data notiActive
							if err := rowsUserApp.Scan(&data.Ida_id, &data.Su_id, &data.Su_firstname, &data.Su_email); err != nil {
								c.IndentedJSON(http.StatusInternalServerError, gin.H{"error": "Failed to scan row data"})
								return
							}
							results = append(results, data)
						}
						if err := rowsUserApp.Err(); err != nil {
							c.IndentedJSON(http.StatusInternalServerError, gin.H{"error": "Error occurred while reading rows"})
							return
						}

						objListNoti := []string{}
						sqlNoti := "INSERT INTO sys_notification_ctrl(snc_type, ida_id, snc_show_users, snc_read_status, snc_created_date, snc_updated_date) VALUES "
						for _, itemNoti := range results {
							objIda := fmt.Sprintf("(%d, %d, '%s', %d, '%s', '%s')",
								1,
								itemNoti.Ida_id,
								strShowUsers,
								0,
								strCreateDate,
								strCreateDate,
							)
							objListNoti = append(objListNoti, objIda)

							errMail := SendMail(c, idcId, itemNoti.Ida_id, itemNoti.Su_firstname, itemNoti.Su_email, "waiting")
							if errMail != nil {
								c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": errMail.Error()})
								return
							}
						}

						if len(objListNoti) == 0 {
							c.IndentedJSON(http.StatusBadRequest, gin.H{"error": "ไม่มีข้อมูลที่สามารถบันทึกได้"})
							return
						}

						sqlNoti += strings.Join(objListNoti, ",")
						_, errNoti := db.Exec(sqlNoti)
						if errNoti != nil {
							c.IndentedJSON(http.StatusInternalServerError, gin.H{"errNoti": errNoti.Error()})
							return
						}
					}
				}

				var chkAllApprove string
				sqlChkAllApprove := "SELECT IF( COUNT(DISTINCT ida_status) = 1 AND MAX(ida_status) = 9, 9, 0 ) AS ida_status_check FROM info_document_approval WHERE idc_id = ?"
				err = db.QueryRow(sqlChkAllApprove, docID).Scan(&chkAllApprove)
				if err == sql.ErrNoRows {
					c.IndentedJSON(http.StatusOK, "Error check all approve")
					return
				}
				// 0 = Not approval all, 9 = has all approval
				if chkAllApprove == "9" && chkOterDept == 8 {
					_, err = db.Exec("UPDATE info_document_control SET idc_status = 9, idc_issue_date = ?, idc_updated_date = ?, idc_updated_by = ? WHERE idc_id = ?", strCreateDate, strCreateDate, objEmailFS.Su_username, docID)
					if err != nil {
						c.IndentedJSON(http.StatusInternalServerError, gin.H{
							"Error": err.Error(),
						})
						return
					}
				}

				c.IndentedJSON(http.StatusOK, true)
				return
			}
		}

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
				c.IndentedJSON(http.StatusOK, gin.H{"Error1": "No user found"})
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
			c.IndentedJSON(http.StatusOK, gin.H{"Error1e": err.Error()})
			return
		} else {
			_, err = db.Exec("INSERT INTO sys_notification_ctrl(snc_type, ida_id, snc_show_users, snc_read_status, snc_created_date, snc_updated_date) VALUES(?, ?, ?, ?, ?, ?)", 2, idaID, strShowUsers2, 0, strCreateDate, strCreateDate)
			if err != nil {
				c.IndentedJSON(http.StatusOK, gin.H{"Error2e": err.Error()})
			}

			var objNotiActive notiActive
			err = db.QueryRow("SELECT ida_id, su_id, COUNT(ida_id) AS ida_count, MIN(sat_id) AS sat_id FROM info_document_approval WHERE idc_id = ? AND ida_action = 0 AND ida_status = 1", docID).Scan(&objNotiActive.Ida_id, &objNotiActive.Su_id, &objNotiActive.Ida_count, &objNotiActive.Sat_id)
			if err == sql.ErrNoRows {
				c.IndentedJSON(http.StatusOK, false)
				return
			} else {
				idcId, err := strconv.Atoi(docID)
				if err != nil {
					fmt.Println("Error3e converting to int:", err)
					return
				}

				IdaID, err := strconv.Atoi(idaID)
				if err != nil {
					fmt.Println("Error3.3e converting to int:", err)
					return
				}

				if objNotiActive.Ida_count == "0" || objNotiActive.Ida_count == "" {
					err = InsertReferDoc(c, idcId)
					if err != nil {
						c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error4e": err.Error()})
						return
					}

					err = SendMail(c, idcId, IdaID, objUserCreate.Su_firstname, objUserCreate.Su_email, "approve")
					if err != nil {
						c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error5e": err.Error()})
						return
					}

					var strUpdatedByEmp string
					getUser := db.QueryRow("SELECT idc_created_by FROM info_document_control WHERE idc_id = ?", idcId).Scan(&strUpdatedByEmp)
					if getUser != nil {
						c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error1": getUser.Error()})
						return
					}
					_, err = db.Exec("UPDATE info_document_control SET idc_status = 9, idc_issue_date= ?, idc_updated_date = ?, idc_updated_by = ? WHERE idc_Id = ?", strCreateDate, strCreateDate, strUpdatedByEmp, idcId)
					if err != nil {
						c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error6e": err.Error()})
						return
					}

				} else {
					_, err = db.Exec("INSERT INTO sys_notification_ctrl(snc_type, ida_id, snc_show_users, snc_read_status, snc_created_date, snc_updated_date) VALUES(?, ?, ?, ?, ?, ?)", 1, objNotiActive.Ida_id, strShowUsers, 0, strCreateDate, strCreateDate)
					if err != nil {
						c.IndentedJSON(http.StatusOK, gin.H{"Error7e": err.Error()})
					}

					var objEmail userEmail
					getEmail := "SELECT su_id, su_firstname, su_email, su_username FROM sys_users WHERE su_id = ?"
					err = db.QueryRow(getEmail, objNotiActive.Su_id).Scan(&objEmail.Su_id, &objEmail.Su_firstname, &objEmail.Su_email, &objEmail.Su_username)

					if err != nil {
						if err == sql.ErrNoRows {
							c.IndentedJSON(http.StatusOK, gin.H{"Error2": "No user found"})
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
		Sd_id        int    `json:"sd_id"`
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
	var strShowUsers string
	var cheIdc int
	checkIda := "SELECT idc_status FROM info_document_control WHERE idc_id = ?"
	err := db.QueryRow(checkIda, docID).Scan(&cheIdc)
	if err != nil {
		if err == sql.ErrNoRows {
			c.IndentedJSON(http.StatusOK, "This document not found!")
			return
		}
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
		return
	} else {
		if cheIdc == 6 || cheIdc == 5 || cheIdc == 9 || cheIdc == 1 {
			statuses := map[int]string{
				6: "rejected",
				5: "cancelled",
				9: "approved",
				1: "not submitted",
			}
			c.IndentedJSON(http.StatusOK, fmt.Sprintf("This document has been %s!", statuses[cheIdc]))
			return
		}

		var chkMdt int
		sqlMdt := "SELECT mdt_id FROM info_document_control WHERE idc_id = ?"
		err := db.QueryRow(sqlMdt, docID).Scan(&chkMdt)
		if err == sql.ErrNoRows {
			c.IndentedJSON(http.StatusOK, "This document not found!")
			return
		} else {
			if chkMdt == 1 {
				var objEmailFS userEmail
				getEmail := "SELECT su.su_id, su.su_firstname, su.su_email, su.su_username, su.sd_id FROM sys_users su LEFT JOIN info_document_approval ida ON ida.su_id = su.su_id WHERE ida.ida_id = ? GROUP BY ida.su_id"
				err := db.QueryRow(getEmail, idaID).Scan(&objEmailFS.Su_id, &objEmailFS.Su_firstname, &objEmailFS.Su_email, &objEmailFS.Su_username, &objEmailFS.Sd_id)

				if err == sql.ErrNoRows {
					c.IndentedJSON(http.StatusOK, "No user found")
					return
				}

				updateIda := "UPDATE info_document_approval SET ida_status = 6 WHERE idc_id = ?"
				_, err = db.Exec(updateIda, docID)
				if err != nil {
					c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
					return
				} else {
					var updateIdaBy string
					if caseType == "email" {
						updateIdaBy = "UPDATE info_document_approval SET ida_action = 1, ida_route = 2, ida_reject_reason = ?, ida_updated_date = ?, ida_updated_by = ? WHERE idc_id = ? AND su_id = ?"
					} else {
						updateIdaBy = "UPDATE info_document_approval SET ida_action = 1, ida_route = 1, ida_reject_reason = ?, ida_updated_date = ?, ida_updated_by = ? WHERE idc_id = ? AND su_id = ?"
					}

					_, err = db.Exec(updateIdaBy, reason, strCreateDate, objEmailFS.Su_username, docID, objEmailFS.Su_id)
					if err != nil {
						c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
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

						var chkOterDept int
						err = db.QueryRow(`SELECT COUNT(DISTINCT CASE WHEN ida.ida_status = 9 THEN su.su_id ELSE NULL END) AS dept FROM info_document_approval ida LEFT JOIN sys_users su ON su.su_id = ida.su_id WHERE idc_id = ?`, docID).Scan(&chkOterDept)
						if err != nil {
							c.IndentedJSON(http.StatusInternalServerError, gin.H{"error": "Failed to execute query"})
							return
						}

						if chkOterDept >= 5 {
							_, err = db.Exec("UPDATE info_document_control SET idc_status = 6, idc_updated_date = ?, idc_updated_by = ? WHERE idc_id = ?", strCreateDate, objEmailFS.Su_username, docID)
							if err != nil {
								c.IndentedJSON(http.StatusInternalServerError, gin.H{
									"Error": err.Error(),
								})
								return
							}

							_, err = db.Exec("UPDATE info_feasibility_score AS ifs JOIN mst_consideration_item_pic AS mcip ON mcip.mcip_id = ifs.mcip_id JOIN sys_department AS sd ON sd.sd_id = mcip.sd_id SET ifs.ifs_status = 0, ifs_score = 0, ifs_total = ?, ifs.ifs_updated_date = ?, ifs.ifs_updated_by = ? WHERE ifs.idc_id = ?", "", strCreateDate, objEmailFS.Su_username, docID)
							if err != nil {
								c.IndentedJSON(http.StatusInternalServerError, gin.H{
									"Error": err.Error(),
								})
								return
							}

						} else {
							_, err = db.Exec("UPDATE info_feasibility_score AS ifs JOIN mst_consideration_item_pic AS mcip ON mcip.mcip_id = ifs.mcip_id JOIN sys_department AS sd ON sd.sd_id = mcip.sd_id SET ifs.ifs_status = 6, ifs.ifs_updated_date = ?, ifs.ifs_updated_by = ? WHERE ifs.idc_id = ? AND mcip.sd_id = ?", strCreateDate, objEmailFS.Su_username, docID, objEmailFS.Sd_id)
							if err != nil {
								c.IndentedJSON(http.StatusInternalServerError, gin.H{
									"Error": err.Error(),
								})
								return
							}
						}

						///////////////////// Old //////////////////////

						idcId, err := strconv.Atoi(docID)
						if err != nil {
							fmt.Println("Error converting to int:", err)
							return
						}

						var idcSendMail int
						getSendIda := "SELECT MIN(ida_id) AS ida_id FROM info_document_approval WHERE su_id = ? AND idc_id = ?"
						err = db.QueryRow(getSendIda, objEmailFS.Su_id, docID).Scan(&idcSendMail)
						if err != nil {
							c.IndentedJSON(http.StatusOK, fmt.Sprintf("Error get send ida: %s", err))
							return
						}

						var doc_no string
						err = db.QueryRow("SELECT idc_running_no FROM info_document_control WHERE idc_id = ?", docID).Scan(&doc_no)
						if err != nil {
							c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error1.1": err.Error()})
							return
						}

						strShowUsers = "Your document " + doc_no + " was rejected"

						_, err = db.Exec("INSERT INTO sys_notification_ctrl(snc_type, ida_id, snc_show_users, snc_read_status, snc_created_date, snc_updated_date) VALUES(?, ?, ?, ?, ?, ?)", 2, idcSendMail, strShowUsers, 0, strCreateDate, strCreateDate)
						if err != nil {
							c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
						}

						err = SendMail(c, idcId, idcSendMail, objUserCreate.Su_firstname, objUserCreate.Su_email, "reject")
						if err != nil {
							c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
							return
						}

					}
				}
				c.IndentedJSON(http.StatusOK, true)
				return
			}
		}

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
								var doc_no string
								err = db.QueryRow("SELECT idc_running_no FROM info_document_control WHERE idc_id = ?", docID).Scan(&doc_no)
								if err != nil {
									c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error1.1": err.Error()})
									return
								}

								strShowUsers = "Your document" + doc_no + " was rejected"

								_, err = db.Exec("INSERT INTO sys_notification_ctrl(snc_type, ida_id, snc_show_users, snc_read_status, snc_created_date, snc_updated_date) VALUES(?, ?, ?, ?, ?, ?)", 2, objNotiActive.Ida_id, strShowUsers, 0, strCreateDate, strCreateDate)
								if err != nil {
									c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
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
func GetDataRFQ(DocId int) (GetRfq, error) {
	var objDocNo GetRfq
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

	query := "SELECT * FROM info_document_control WHERE idc_id = ?"
	err := db.QueryRow(query, DocId).Scan(&objDocNo.Idc_id, &objDocNo.Mdt_id, &strReferDoc, &objDocNo.Idc_running_no, &objDocNo.Idc_issue_year, &objDocNo.Idc_issue_month, &objDocNo.Idc_issue_seq_no, &objDocNo.Idc_customer_type, &objDocNo.Idc_customer_name, &objDocNo.Idc_plant_cd, &objDocNo.Mds_id, &strSubjectNote, &objDocNo.Mde_id, &strEnclosuresNote, &objDocNo.Idc_project_life, &objDocNo.Idc_project_start, &strIssueDate, &objDocNo.Idc_closing_date, &strReplyDate, &objDocNo.Idc_result_confirm, &objDocNo.Idc_status, &strNote1, &strNote2, &strFilePath, &strPhysicalPath, &strCancelReason, &objDocNo.Idc_created_date, &objDocNo.Idc_created_by, &objDocNo.Idc_updated_date, &objDocNo.Idc_updated_by)
	if err != nil {
		if err == sql.ErrNoRows {
			return objDocNo, nil
		}
		return objDocNo, err
	}

	if strReferDoc.Valid {
		objDocNo.Idc_refer_doc = int(strReferDoc.Int64)
	}
	if strSubjectNote.Valid {
		objDocNo.Idc_subject_note = strSubjectNote.String
	}
	if strEnclosuresNote.Valid {
		objDocNo.Idc_enclosures_note = strEnclosuresNote.String
	}
	if strIssueDate.Valid {
		objDocNo.Idc_issue_date = strIssueDate.String
	}
	if strReplyDate.Valid {
		objDocNo.Idc_reply_date = strReplyDate.String
	}
	if strNote1.Valid {
		objDocNo.Idc_note1 = strNote1.String
	}
	if strNote2.Valid {
		objDocNo.Idc_note2 = strNote2.String
	}
	if strFilePath.Valid {
		objDocNo.Idc_file_path = strFilePath.String
	}
	if strPhysicalPath.Valid {
		objDocNo.Idc_physical_path = strPhysicalPath.String
	}
	if strCancelReason.Valid {
		objDocNo.Idc_cancel_reason = strCancelReason.String
	}

	rowsAttn, err := db.Query("SELECT mda_id FROM `info_document_attn` WHERE idc_id = ? AND idat_status = 1 ORDER BY idat_id", DocId)
	if err != nil {
		return objDocNo, err
	}
	defer rowsAttn.Close()
	for rowsAttn.Next() {
		var idatID string
		if err := rowsAttn.Scan(&idatID); err != nil {
			return objDocNo, err
		}
		objDocNo.Idat_item = append(objDocNo.Idat_item, idatID)
	}
	if err := rowsAttn.Err(); err != nil {
		return objDocNo, err
	}

	rowsIdpu, err := db.Query("SELECT mdpu_id FROM `info_document_purchase_cost` WHERE idc_id = ? AND idpu_status = 1 ORDER BY idpu_id", DocId)
	if err != nil {
		return objDocNo, err
	}
	defer rowsIdpu.Close()
	for rowsIdpu.Next() {
		var idpuID string
		if err := rowsIdpu.Scan(&idpuID); err != nil {
			return objDocNo, err
		}
		objDocNo.Idpu_item = append(objDocNo.Idpu_item, idpuID)
	}
	if err := rowsIdpu.Err(); err != nil {
		return objDocNo, err
	}

	rowsIdpc, err := db.Query("SELECT mdpc_id FROM `info_document_process_cost` WHERE idc_id = ? AND idpc_status = 1 ORDER BY idpc_id", DocId)
	if err != nil {
		return objDocNo, err
	}
	defer rowsIdpc.Close()
	for rowsIdpc.Next() {
		var idpcID string
		if err := rowsIdpc.Scan(&idpcID); err != nil {
			return objDocNo, err
		}
		objDocNo.Idpc_item = append(objDocNo.Idpc_item, idpcID)
	}
	if err := rowsIdpc.Err(); err != nil {
		return objDocNo, err
	}

	rowsItem, err := db.Query("SELECT idi_id, idi_item_no, idi_item_name, idi_model, idi_remark FROM `info_document_item` WHERE idc_id = ? AND idi_status = 1 ORDER BY idi_id", DocId)
	if err != nil {
		return objDocNo, err
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
			return objDocNo, err
		}
		if strModel.Valid {
			groupPart.Idi_model = strModel.String
		}
		if strRemark.Valid {
			groupPart.Idi_remark = strRemark.String
		}
		objDocNo.IrGroupPart = append(objDocNo.IrGroupPart, groupPart)
	}

	if err := rowsItem.Err(); err != nil {
		return objDocNo, err
	}

	rowsVolume, err := db.Query("SELECT idv_id, idv_year, idv_qty FROM `info_document_volume` WHERE idc_id = ? AND idv_status = 1 ORDER BY idv_id", DocId)
	if err != nil {
		return objDocNo, err
	}
	defer rowsVolume.Close()
	for rowsVolume.Next() {
		var groupVolume RfqGroupVolumeDetail
		if err := rowsVolume.Scan(
			&groupVolume.Idv_id,
			&groupVolume.Idv_year,
			&groupVolume.Idv_qty,
		); err != nil {
			return objDocNo, err
		}
		objDocNo.IrGroupVolume = append(objDocNo.IrGroupVolume, groupVolume)
	}

	if err := rowsVolume.Err(); err != nil {
		return objDocNo, err
	}

	return objDocNo, nil
}
func CancelDocument(c *gin.Context) {
	iId := c.Param("id")
	iReason := c.Param("reason")
	strUpdateBy := c.Param("userID")
	strUpdateDate := time.Now().Format("2006-01-02 15:04:05")

	objResult, err := db.Exec("UPDATE info_document_control SET idc_status = 5, idc_cancel_reason = ?, idc_updated_date = ?, idc_updated_by = ? WHERE idc_id = ?", iReason, strUpdateDate, strUpdateBy, iId)
	if err != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{
			"Error": err.Error(),
		})
		return
	}

	c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})
}
func ReverseDocument(c *gin.Context) {
	iId := c.Param("id")
	strUpdateBy := c.Param("userID")
	strUpdateDate := time.Now().Format("2006-01-02 15:04:05")

	objResult, err := db.Exec("UPDATE info_document_control SET idc_status = 1, idc_updated_date = ?, idc_updated_by = ? WHERE idc_id = ?", strUpdateDate, strUpdateBy, iId)
	if err != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{
			"Error": err.Error(),
		})
		return
	}

	c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})
}
func CancelMeeting(c *gin.Context) {
	iId := c.Param("id")
	iReason := c.Param("reason")
	strUpdateBy := c.Param("userID")
	strUpdateDate := time.Now().Format("2006-01-02 15:04:05")

	objResult, err := db.Exec("UPDATE info_meeting_control SET imc_status = 5, idc_cancel_reason = ?, imc_updated_date = ?, imc_updated_by = ? WHERE imc_id = ?", iReason, strUpdateDate, strUpdateBy, iId)
	if err != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"ErrorImc": err.Error()})
		return
	}

	_, err = db.Exec("UPDATE info_meeting_member SET imm_status = 5, imm_updated_date = ?, imm_updated_by = ? WHERE imc_id = ?", strUpdateDate, strUpdateBy, iId)
	if err != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"ErrorImm": err.Error()})
		return
	}

	_, err = db.Exec("UPDATE info_meeting_next_action SET imnc_status = 5, imnc_updated_date = ?, imnc_updated_by = ? WHERE imc_id = ?", strUpdateDate, strUpdateBy, iId)
	if err != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"ErrorImm": err.Error()})
		return
	}

	c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})
}
func ReverseMeeting(c *gin.Context) {
	iId := c.Param("id")
	strUpdateBy := c.Param("userID")
	strUpdateDate := time.Now().Format("2006-01-02 15:04:05")

	objResult, err := db.Exec("UPDATE info_meeting_control SET imc_status = 1, idc_cancel_reason = '', imc_updated_date = ?, imc_updated_by = ? WHERE imc_id = ?", strUpdateDate, strUpdateBy, iId)
	if err != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"ErrorImc": err.Error()})
		return
	}

	_, err = db.Exec("UPDATE info_meeting_member SET imm_status = 1, imm_updated_date = ?, imm_updated_by = ? WHERE imc_id = ?", strUpdateDate, strUpdateBy, iId)
	if err != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"ErrorImm": err.Error()})
		return
	}

	_, err = db.Exec("UPDATE info_meeting_next_action SET imnc_status = 1, imnc_updated_date = ?, imnc_updated_by = ? WHERE imc_id = ?", strUpdateDate, strUpdateBy, iId)
	if err != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"ErrorImm": err.Error()})
		return
	}

	c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})
}
func CloseMeeting(c *gin.Context) {
	iId := c.Param("id")
	strUpdateBy := c.Param("userID")
	strUpdateDate := time.Now().Format("2006-01-02 15:04:05")

	objResult, err := db.Exec("UPDATE info_meeting_control SET imc_status = 9, imc_updated_date = ?, imc_updated_by = ? WHERE imc_id = ?", strUpdateDate, strUpdateBy, iId)
	if err != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"ErrorImc": err.Error()})
		return
	}

	_, err = db.Exec("UPDATE info_meeting_member SET imm_status = 9, imm_updated_date = ?, imm_updated_by = ? WHERE imc_id = ?", strUpdateDate, strUpdateBy, iId)
	if err != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"ErrorImm": err.Error()})
		return
	}

	_, err = db.Exec("UPDATE info_meeting_next_action SET imnc_status = 9, imnc_updated_date = ?, imnc_updated_by = ? WHERE imc_id = ?", strUpdateDate, strUpdateBy, iId)
	if err != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"ErrorImm": err.Error()})
		return
	}

	c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})
}
