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
		var strPosition3 sql.NullString
		err := objListDocType.Scan(&objDocType.Mdt_id, &objDocType.Mdt_name, &objDocType.Mdt_position1, &objDocType.Mdt_position2, &strPosition3, &objDocType.Mdt_status, &objDocType.Create_date, &objDocType.Create_by, &objDocType.Update_date, &objDocType.Update_by, &objDocType.Su_firstname, &objDocType.Su_lastname)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		if strPosition3.Valid {
			objDocType.Mdt_position3 = strPosition3.String
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
	err := db.QueryRow("SELECT * FROM mst_document_type WHERE mdt_name = ? and mdt_id != ?", objDocumentType.Mdt_name, objDocumentType.Mdt_id).Scan(&objDocumentType.Mdt_id, &objDocumentType.Mdt_name, &objDocumentType.Mdt_position1, &objDocumentType.Mdt_position2, &objDocumentType.Mdt_position3, &objDocumentType.Mdt_status, &objDocumentType.Create_date, &objDocumentType.Update_date, &objDocumentType.Create_by, &objDocumentType.Update_by)
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
	err := db.QueryRow("SELECT * FROM mst_document_control_no WHERE mdcn_position1 = ? and mdt_id = ? and mdcn_id != ?", objDocumentNo.Mdcn_position1, objDocumentNo.Mdt_id, objDocumentNo.Mdcn_id).Scan(&objDocumentNo.Mdcn_id, &objDocumentNo.Mdt_id, &objDocumentNo.Mdcn_position1, &objDocumentNo.Mdcn_position2, &objDocumentNo.Mdcn_position3, &objDocumentNo.Create_date, &objDocumentNo.Create_by, &objDocumentNo.Update_date, &objDocumentNo.Update_by)
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
	var strPosition3 sql.NullString
	if err := c.BindJSON(&objDocumentType); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}

	if strPosition3.Valid {
		objDocumentType.Mdt_position3 = strPosition3.String
	}

	objResult, err := db.Exec("INSERT INTO mst_document_type(mdt_name, mdt_position1, mdt_position2, mdt_position3, mdt_status, mdt_created_date, mdt_created_by, mdt_updated_date, mdt_updated_by) VALUES(?,?,?,?,?,?,?,?,?)", objDocumentType.Mdt_name, objDocumentType.Mdt_position1, objDocumentType.Mdt_position2, strPosition3, objDocumentType.Mdt_status, objDocumentType.Create_date, objDocumentType.Create_by, objDocumentType.Create_date, objDocumentType.Create_by)

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
	var strPosition2 sql.NullString
	var strPosition3 sql.NullString
	if err := c.BindJSON(&objDocumentConNo); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}

	if strPosition2.Valid {
		objDocumentConNo.Mdcn_position2 = strPosition2.String
	}
	if strPosition3.Valid {
		objDocumentConNo.Mdcn_position3 = strPosition3.String
	}

	objResult, err := db.Exec("INSERT INTO mst_document_control_no(mdt_id, mdcn_position1, mdcn_position2, mdcn_position3, mdcn_created_date, mdcn_created_by, mdcn_updated_date, mdcn_updated_by) VALUES(?,?,?,?,?,?,?,?)", objDocumentConNo.Mdt_id, objDocumentConNo.Mdcn_position1, strPosition2, strPosition3, objDocumentConNo.Create_date, objDocumentConNo.Create_by, objDocumentConNo.Create_date, objDocumentConNo.Create_by)

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
	var strPosition3 sql.NullString
	if err := c.BindJSON(&objDocumentType); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}

	if strPosition3.Valid {
		objDocumentType.Mdt_position3 = strPosition3.String
	}

	objResult, err := db.Exec("Update mst_document_type SET mdt_name = ?, mdt_position1 = ?, mdt_position2 = ?, mdt_position3 = ?, mdt_updated_date = ?, mdt_updated_by = ? WHERE mdt_id = ?", objDocumentType.Mdt_name, objDocumentType.Mdt_position1, objDocumentType.Mdt_position2, strPosition3, objDocumentType.Update_date, objDocumentType.Update_by, objDocumentType.Mdt_id)
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
		var strPosition3 sql.NullString

		err := objListDocControl.Scan(&objDocControlTetail.Mdcn_id, &objDocControlTetail.Mdt_id, &objDocControlTetail.Mdcn_position1, &strPosition2, &strPosition3, &strCreateDate, &strCreateBy, &strUpdateDate, &strUpdateBy, &objDocControlTetail.Mdt_name, &strUserFname, &strUserLname, &strUserSignPath, &strUserSignFile)

		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}

		if strPosition2.Valid {
			objDocControlTetail.Mdcn_position2 = strPosition2.String
		}
		if strPosition3.Valid {
			objDocControlTetail.Mdcn_position3 = strPosition3.String
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
	objListDept, err := db.Query("SELECT sd.*, su.su_fname, su.su_lname, su.su_img_path, su.su_img_name FROM `sys_department` AS sd LEFT JOIN sys_user AS su ON sd.sd_updated_by = su.su_emp_code ORDER BY sd.sd_id")
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
		err := objListDept.Scan(&objDepartment.Sd_id, &objDepartment.Sd_plant_cd, &objDepartment.Sd_dept_cd, &objDepartment.Sd_dept_name, &objDepartment.Sd_status, &strCreateDate, &strCreateBy, &strUpdateDate, &strUpdateBy, &strUserFname, &strUserLname, &strUserImgPath, &strUserImgName)
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
	objResult, err := db.Exec("INSERT INTO sys_department(sd_plant_cd, sd_dept_cd, sd_dept_name, sd_status, sd_created_date, sd_created_by, sd_updated_date, sd_updated_by) VALUES(?,?,?,?,?,?,?,?)", objDepartmentData.Sd_plant_cd, objDepartmentData.Sd_name_cd, objDepartmentData.Sd_name, 1, objDepartmentData.Create_date, objDepartmentData.Create_by, objDepartmentData.Create_date, objDepartmentData.Create_by)
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
	objResult, err := db.Exec("Update sys_department SET sd_dept_cd = ?, sd_dept_name = ?, sd_plant_cd = ?, sd_updated_date = ?, sd_updated_by = ? WHERE sd_id = ?", objDepartmentData.Sd_name_cd, objDepartmentData.Sd_name, objDepartmentData.Sd_plant_cd, objDepartmentData.Update_date, objDepartmentData.Update_by, objDepartmentData.Sd_id)
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
	objListConsider, err := db.Query("SELECT mc.*, su.su_firstname, su.su_lastname, su.su_sign_path, su.su_sign_file FROM `mst_consideration` AS mc LEFT JOIN sys_users AS su ON mc.update_by = su.su_username ORDER BY mc.mc_id")
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
	objResult, err := db.Exec("INSERT INTO mst_consideration(mc_title,mc_weight,create_date,create_by,update_date,update_by) VALUES(?,?,?,?,?,?)", objConsideration.Mc_title, objConsideration.Mc_weight, objConsideration.Create_date, objConsideration.Create_by, objConsideration.Create_date, objConsideration.Create_by)
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
	objResult, err := db.Exec("Update mst_consideration SET mc_status = ?, update_date = ?, update_by = ? WHERE mc_id = ?", objConsideration.Mc_status, objConsideration.Update_date, objConsideration.Update_by, objConsideration.Mc_id)
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
	objListIncharge, err := db.Query("SELECT mci.*, mc.mc_title, sd_dept_name, su.su_firstname, su.su_lastname, su.su_sign_path, su.su_sign_file FROM `mst_consideration_incharge` AS mci LEFT JOIN sys_users AS su ON mci.update_by = su.su_username LEFT JOIN mst_consideration AS mc ON mci.mc_id = mc.mc_id LEFT JOIN sys_department AS sd ON mci.sd_id = sd.sd_id ORDER BY mci.mci_id")
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
	objListPartNo, err := db.Query("SELECT irpn_id, irpn_part_no, irpn_part_name, irpn_model, irpn_remark FROM `info_rfq_part_no` WHERE ir_id = ? ORDER BY irpn_id", c.Param("id"))
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListPartNo.Close()
	for objListPartNo.Next() {
		var objPartNo GetPartNoById
		var strRemark sql.NullString
		err := objListPartNo.Scan(&objPartNo.Irpn_id, &objPartNo.Irpn_part_no, &objPartNo.Irpn_part_name, &objPartNo.Irpn_model, &strRemark)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		if strRemark.Valid {
			objPartNo.Irpn_remark = strRemark.String
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
	objResult, err := db.Exec("Update mst_consideration_incharge SET mci_status = ?, update_date = ?, update_by = ? WHERE mci_id = ?", objConsideration.Mci_status, objConsideration.Update_date, objConsideration.Update_by, objConsideration.Mci_id)
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
		var strPosition3 sql.NullString
		err := objListDocType.Scan(&objDocType.Mdt_id, &objDocType.Mdt_name, &objDocType.Mdt_position1, &objDocType.Mdt_position2, &strPosition3, &objDocType.Mdt_status, &strCreateDate, &strUpdateDate, &strCreateBy, &strUpdateBy)
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
		if strPosition3.Valid {
			objDocType.Mdt_position3 = strPosition3.String
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
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString
		err := objListDepartment.Scan(&objDepartment.Sd_id, &objDepartment.Sd_plant_cd, &objDepartment.Sd_name_cd, &objDepartment.Sd_name, &objDepartment.Sd_status, &strCreateDate, &strUpdateDate, &strCreateBy, &strUpdateBy)
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
		"message": "กินข้าวหรือยังครับ",
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
