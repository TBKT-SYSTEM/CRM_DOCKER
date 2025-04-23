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

func RfqLastid(c *gin.Context) {
	var objLastId GetLastID
	err := db.QueryRow("SELECT COUNT(ir_id) AS last_id FROM info_rfq").Scan(&objLastId.Last_id)
	if err == sql.ErrNoRows {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, objLastId)
}

func GetRFQ(c *gin.Context) {
	var objDocNo GetRfqNew
	var strReferDoc sql.NullInt64
	var strPlant sql.NullInt64
	var strMde sql.NullInt64
	var strSubjectNote sql.NullString
	var strEnclosuresNote sql.NullString
	var strProlife sql.NullInt64
	var strProstart sql.NullString
	var strIssueDate sql.NullString
	var strCloseDate sql.NullString
	var strReplyDate sql.NullString
	var strNote1 sql.NullString
	var strNote2 sql.NullString
	var strFilePath sql.NullString
	var strPhysicalPath sql.NullString
	var strCancelReason sql.NullString

	query := "SELECT * FROM info_document_control WHERE idc_id = ?"
	err := db.QueryRow(query, c.Param("id")).Scan(&objDocNo.Idc_id, &objDocNo.Mdt_id, &strReferDoc, &objDocNo.Idc_running_no, &objDocNo.Idc_issue_year, &objDocNo.Idc_issue_month, &objDocNo.Idc_issue_seq_no, &objDocNo.Idc_customer_type, &objDocNo.Idc_customer_name, &strPlant, &objDocNo.Mds_id, &strSubjectNote, &strMde, &strEnclosuresNote, &strProlife, &strProstart, &strIssueDate, &strCloseDate, &strReplyDate, &objDocNo.Idc_result_confirm, &objDocNo.Idc_status, &strNote1, &strNote2, &strFilePath, &strPhysicalPath, &strCancelReason, &objDocNo.Idc_created_date, &objDocNo.Idc_created_by, &objDocNo.Idc_updated_date, &objDocNo.Idc_updated_by)
	if err == sql.ErrNoRows {
		c.IndentedJSON(http.StatusOK, gin.H{"Error1": err.Error()})
		return
	}

	if strReferDoc.Valid {
		objDocNo.Idc_refer_doc = int(strReferDoc.Int64)
	}
	if strPlant.Valid {
		objDocNo.Idc_plant_cd = int(strPlant.Int64)
	}
	if strMde.Valid {
		objDocNo.Mde_id = int(strMde.Int64)
	}
	if strSubjectNote.Valid {
		objDocNo.Idc_subject_note = strSubjectNote.String
	}
	if strEnclosuresNote.Valid {
		objDocNo.Idc_enclosures_note = strEnclosuresNote.String
	}
	if strProlife.Valid {
		objDocNo.Idc_project_life = int(strProlife.Int64)
	}
	if strProstart.Valid {
		objDocNo.Idc_project_start = strProstart.String
	}
	if strIssueDate.Valid {
		objDocNo.Idc_issue_date = strIssueDate.String
	}
	if strCloseDate.Valid {
		objDocNo.Idc_closing_date = strCloseDate.String
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

	rowsAttn, err := db.Query("SELECT mda_id FROM `info_document_attn` WHERE idc_id = ? AND idat_status = 1 ORDER BY idat_id", c.Param("id"))
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error2": err.Error()})
		return
	}
	defer rowsAttn.Close()
	for rowsAttn.Next() {
		var idatID string
		if err := rowsAttn.Scan(&idatID); err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{"Error3": err.Error()})
			return
		}
		objDocNo.Idat_item = append(objDocNo.Idat_item, idatID)
	}
	if err := rowsAttn.Err(); err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error4": err.Error()})
		return
	}

	rowsItem, err := db.Query("SELECT idi_id, idi_item_no, idi_item_name, idi_model, idi_remark FROM `info_document_item` WHERE idc_id = ? AND idi_status = 1 ORDER BY idi_id", c.Param("id"))
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error5": err.Error()})
		return
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
			return
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
			return
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
				return
			}
			groupPart.IrGroupVolume = append(groupPart.IrGroupVolume, groupVolume)
		}

		if err := rowsVolume.Err(); err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
			return
		}

		objDocNo.IrGroupPart = append(objDocNo.IrGroupPart, groupPart)
	}

	if err := rowsItem.Err(); err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}

	c.IndentedJSON(http.StatusOK, objDocNo)
}
func RfqDocNo(c *gin.Context) {
	var objDocNo GetDocNo
	searchParam := "%" + c.Param("id") + "%"
	query := "SELECT mdt.mdt_id, CONCAT(mdt.mdt_position1, '-', mdt.mdt_position2) AS doc_mst, mdcn.mdcn_position1 AS doc_cur_no_p1, mdcn.mdcn_position2 AS doc_cur_no_p2, CONCAT( CONCAT(mdt.mdt_position1, '-', mdt.mdt_position2), '-', CONCAT(mdcn.mdcn_position1) ) AS doc_run_no FROM mst_document_type mdt LEFT JOIN mst_document_control_no mdcn ON mdcn.mdt_id = mdt.mdt_id WHERE mdt.mdt_name LIKE ? AND mdt.mdt_status = 1"
	err := db.QueryRow(query, searchParam).Scan(&objDocNo.Mdt_id, &objDocNo.Doc_mst, &objDocNo.Doc_cur_no_po1, &objDocNo.Doc_cur_no_po2, &objDocNo.Doc_run_no)
	if err == sql.ErrNoRows {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, objDocNo)
}

func InsertRfq(c *gin.Context) {
	var objRfq RfqNew
	var chkDept int

	if err := c.BindJSON(&objRfq); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}

	var strNote sql.NullString
	var strComment sql.NullString
	var strIssueDate sql.NullString
	var strReplyDate sql.NullString
	var strFilePath sql.NullString
	var strPhysicalPath sql.NullString
	var strCancelReason sql.NullString
	var strReferDoc sql.NullInt64

	if objRfq.Idc_refer_doc == 0 {
		strReferDoc = sql.NullInt64{Int64: 0, Valid: false}
	} else {
		strReferDoc = sql.NullInt64{Int64: int64(objRfq.Idc_refer_doc), Valid: true}
	}

	strNote = sql.NullString{
		String: objRfq.Idc_note1,
		Valid:  objRfq.Idc_note1 != "",
	}
	strComment = sql.NullString{
		String: objRfq.Idc_note2,
		Valid:  objRfq.Idc_note2 != "",
	}
	strIssueDate = sql.NullString{
		String: objRfq.Idc_issue_date,
		Valid:  objRfq.Idc_issue_date != "",
	}
	strReplyDate = sql.NullString{
		String: objRfq.Idc_reply_date,
		Valid:  objRfq.Idc_reply_date != "",
	}
	strFilePath = sql.NullString{
		String: objRfq.Idc_file_path,
		Valid:  objRfq.Idc_file_path != "",
	}
	strPhysicalPath = sql.NullString{
		String: objRfq.Idc_physical_path,
		Valid:  objRfq.Idc_physical_path != "",
	}
	strCancelReason = sql.NullString{
		String: objRfq.Idc_cancel_reason,
		Valid:  objRfq.Idc_cancel_reason != "",
	}

	err := db.QueryRow("SELECT sd_id FROM sys_users WHERE su_username = ?", objRfq.Idc_created_by).Scan(&chkDept)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"False": err.Error()})
		return
	}

	if chkDept != 22 {
		c.IndentedJSON(http.StatusOK, gin.H{"False": "Your department is incorrect please contact your administrator."})
		return
	}

	objResult, err := db.Exec("INSERT INTO info_document_control (mdt_id, idc_refer_doc, idc_running_no, idc_issue_year, idc_issue_month, idc_issue_seq_no, idc_customer_type, idc_customer_name, idc_plant_cd, mds_id, idc_subject_note, mde_id, idc_enclosures_note, idc_project_life, idc_project_start, idc_issue_date, idc_closing_date, idc_reply_date, idc_result_confirm, idc_status, idc_note1, idc_note2, idc_file_path, idc_physical_path, idc_cancel_reason, idc_created_date, idc_created_by, idc_updated_date, idc_updated_by) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", objRfq.Mdt_id, strReferDoc, objRfq.Idc_running_no, objRfq.Idc_issue_year, objRfq.Idc_issue_month, objRfq.Idc_issue_seq_no, objRfq.Idc_customer_type, objRfq.Idc_customer_name, objRfq.Idc_plant_cd, objRfq.Mds_id, objRfq.Idc_subject_note, objRfq.Mde_id, objRfq.Idc_enclosures_note, objRfq.Idc_project_life, objRfq.Idc_project_start, strIssueDate, objRfq.Idc_closing_date, strReplyDate, objRfq.Idc_result_confirm, objRfq.Idc_status, strNote, strComment, strFilePath, strPhysicalPath, strCancelReason, objRfq.Idc_created_date, objRfq.Idc_created_by, objRfq.Idc_created_date, objRfq.Idc_created_by)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"False": err.Error()})
		return
	}

	objLastId, err := objResult.LastInsertId()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"False": err.Error()})
		return
	}

	// Insert Part No
	for index, partCurrent := range objRfq.IrGroupPart {
		valuesVolume := []string{}
		partNo := partCurrent.Idi_item_no
		partName := partCurrent.Idi_item_name
		model := partCurrent.Idi_model
		remark := partCurrent.Idi_remark
		orderNo := index + 1

		if remark == "" {
			remark = ""
		}

		query := "INSERT INTO info_document_item (idc_id, idi_item_no, idi_item_name, idi_model, idi_order_no, idi_status, idi_remark, idi_created_date, idi_created_by, idi_updated_date, idi_updated_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"

		itemInsert, err := db.Exec(query, objLastId, partNo, partName, model, orderNo, 1, remark, objRfq.Idc_created_date, objRfq.Idc_created_by, objRfq.Idc_created_date, objRfq.Idc_created_by)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{"False": err.Error()})
			return
		}

		itemLastId, err := itemInsert.LastInsertId()
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{"False": "ไม่สามารถดึง Last Insert ID ได้"})
			return
		}

		var sql string = "INSERT INTO info_document_volume (idi_id, idv_year, idv_qty, idv_status, idv_created_date, idv_created_by, idv_updated_date, idv_updated_by) VALUES "
		for _, volume := range partCurrent.IrGroupVolume {
			value := fmt.Sprintf("(%d, %s, %s, %d, '%s', '%s', '%s', '%s')",
				itemLastId,
				volume.Idv_year,
				volume.Idv_qty,
				1,
				objRfq.Idc_created_date,
				objRfq.Idc_created_by,
				objRfq.Idc_created_date,
				objRfq.Idc_created_by)
			valuesVolume = append(valuesVolume, value)
		}

		if len(valuesVolume) == 0 {
			c.IndentedJSON(http.StatusOK, gin.H{"False": "ไม่มีข้อมูลที่สามารถบันทึกได้"})
			return
		}

		sql += strings.Join(valuesVolume, ",")
		_, errPartItem := db.Exec(sql)

		if errPartItem != nil {
			c.IndentedJSON(http.StatusOK, gin.H{"False": errPartItem.Error()})
			return
		}
	}

	// Insert Attn
	var sqlAttn string = "INSERT INTO info_document_attn (idc_id, mda_id, idat_status, idat_created_date, idat_created_by, idat_updated_date, idat_updated_by) VALUES "
	objListAttn := []string{}

	for _, attnCurrent := range objRfq.Idat_item {

		attnID, err := strconv.Atoi(attnCurrent)
		if err != nil {
			fmt.Println("Error converting attnCurrent to int:", err)
			continue
		}

		objAttn := fmt.Sprintf("(%d, %d, %d, '%s', '%s', '%s', '%s')",
			objLastId,
			attnID,
			1,
			objRfq.Idc_created_date,
			objRfq.Idc_created_by,
			objRfq.Idc_created_date,
			objRfq.Idc_created_by)

		objListAttn = append(objListAttn, objAttn)
	}

	if len(objListAttn) == 0 {
		c.IndentedJSON(http.StatusOK, gin.H{"False": "ไม่มีข้อมูลที่สามารถบันทึกได้"})
		return
	}

	sqlAttn += strings.Join(objListAttn, ",")

	_, errAttn := db.Exec(sqlAttn)
	if errAttn != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"False": errAttn.Error()})
		return
	}

	_, errUpdateSeq := db.Exec("UPDATE mst_document_control_no SET mdcn_position2 = ? WHERE mdt_id = ?", objRfq.Idc_issue_seq_no, objRfq.Mdt_id)
	if errUpdateSeq != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"False": errUpdateSeq.Error()})
		return
	}

	c.IndentedJSON(http.StatusOK, gin.H{"Error": objLastId})
}

func ListRfqTable(c *gin.Context) {
	var objRfqList []RfqTable
	var mdtID int
	docType := c.Param("id")

	query := "SELECT mdt_id FROM mst_document_type WHERE mdt_name LIKE ?"
	err := db.QueryRow(query, "%"+docType+"%").Scan(&mdtID)
	if err != nil {
		if err == sql.ErrNoRows {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": "No matching document type found",
			})
			return
		}
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}

	objListRfq, err := db.Query("SELECT idc.*, su.su_firstname, su.su_lastname, su.su_sign_path, su.su_sign_file, ( SELECT CASE WHEN COUNT(*) > 0 THEN 'true' ELSE 'false' END FROM info_document_control idc_sub LEFT JOIN mst_document_type mdt ON mdt.mdt_id = idc_sub.mdt_id WHERE mdt.mdt_name LIKE '%NBC%' AND idc_sub.idc_refer_doc = idc.idc_id ) AS btnNBC, (SELECT ida_reject_reason FROM info_document_approval WHERE ida_status = 6 AND idc_id = idc.idc_id ORDER BY ida_reject_reason IS NULL,   ida_reject_reason LIMIT 1 ) AS rejectMessage FROM `info_document_control` AS idc LEFT JOIN sys_users AS su ON idc.idc_updated_by = su.su_username WHERE idc.mdt_id = ? AND idc.idc_created_date BETWEEN ? AND ? ORDER BY idc.idc_id;", mdtID, c.Param("stratDate")+" 00:00:00", c.Param("endDate")+" 23:59:59")
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}

	defer objListRfq.Close()
	for objListRfq.Next() {
		var objRfq RfqTable
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
		var strFirstName sql.NullString
		var strLastName sql.NullString
		var strSignPath sql.NullString
		var strSignFile sql.NullString
		var strReject sql.NullString

		err := objListRfq.Scan(&objRfq.Idc_id, &objRfq.Mdt_id, &strReferDoc, &objRfq.Idc_running_no, &objRfq.Idc_issue_year, &objRfq.Idc_issue_month, &objRfq.Idc_issue_seq_no, &objRfq.Idc_customer_type, &objRfq.Idc_customer_name, &objRfq.Idc_plant_cd, &objRfq.Mds_id, &strSubjectNote, &objRfq.Mde_id, &strEnclosuresNote, &objRfq.Idc_project_life, &objRfq.Idc_project_start, &strIssueDate, &objRfq.Idc_closing_date, &strReplyDate, &objRfq.Idc_result_confirm, &objRfq.Idc_status, &strNote1, &strNote2, &strFilePath, &strPhysicalPath, &strCancelReason, &objRfq.Idc_created_date, &objRfq.Idc_created_by, &objRfq.Idc_updated_date, &objRfq.Idc_updated_by, &strFirstName, &strLastName, &strSignPath, &strSignFile, &objRfq.Btn_nbc, &strReject)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}

		if strReferDoc.Valid {
			objRfq.Idc_refer_doc = int(strReferDoc.Int64)
		}
		if strSubjectNote.Valid {
			objRfq.Idc_subject_note = strSubjectNote.String
		}
		if strEnclosuresNote.Valid {
			objRfq.Idc_enclosures_note = strEnclosuresNote.String
		}
		if strIssueDate.Valid {
			objRfq.Idc_issue_date = strIssueDate.String
		}
		if strReplyDate.Valid {
			objRfq.Idc_reply_date = strReplyDate.String
		}
		if strNote1.Valid {
			objRfq.Idc_note1 = strNote1.String
		}
		if strNote2.Valid {
			objRfq.Idc_note2 = strNote2.String
		}
		if strFilePath.Valid {
			objRfq.Idc_file_path = strFilePath.String
		}
		if strPhysicalPath.Valid {
			objRfq.Idc_physical_path = strPhysicalPath.String
		}
		if strCancelReason.Valid {
			objRfq.Idc_cancel_reason = strCancelReason.String
		}
		if strFirstName.Valid {
			objRfq.Su_firstname = strFirstName.String
		}
		if strLastName.Valid {
			objRfq.Su_lastname = strLastName.String
		}
		if strSignPath.Valid {
			objRfq.Su_sign_path = strSignPath.String
		}
		if strSignFile.Valid {
			objRfq.Su_sign_file = strSignFile.String
		}
		if strReject.Valid {
			objRfq.Reject_message = strReject.String
		}
		objRfqList = append(objRfqList, objRfq)
	}

	err = objListRfq.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}

	var objData RfqData
	objData.Data = objRfqList
	c.IndentedJSON(http.StatusOK, objData)
}

// func ListRFQ(c *gin.Context) {
// 	var objRfq RfqTable
// 	iId := c.Param("id")
// 	var strRefFm sql.NullInt64
// 	var strRefNbc sql.NullInt64
// 	var strNote sql.NullString
// 	var strComment sql.NullString
// 	var strUserFname sql.NullString
// 	var strUserLname sql.NullString
// 	var strUserSignPath sql.NullString
// 	var strUserSignFile sql.NullString
// 	var strCreateDate sql.NullString
// 	var strUpdateDate sql.NullString
// 	var strCreateBy sql.NullString
// 	var strUpdateBy sql.NullString
// 	err := db.QueryRow("SELECT ir.*, su.su_firstname, su.su_lastname, su.su_sign_path, su.su_sign_file FROM `info_rfq` AS ir LEFT JOIN sys_users AS su ON ir.ir_updated_by = su.su_username WHERE ir.ir_id = ? ORDER BY ir.ir_id", iId).Scan(&objRfq.Ir_id, &objRfq.Ir_doc_no, &objRfq.Ir_customer, &objRfq.Ir_import_tran, &objRfq.Ir_mrt, &objRfq.Ir_enclosures, &strRefFm, &strRefNbc, &objRfq.Ir_pro_life, &objRfq.Ir_pro_tim, &objRfq.Ir_duedate, &strNote, &strComment, &objRfq.Ir_status, &strCreateDate, &strCreateBy, &strUpdateDate, &strUpdateBy, &strUserFname, &strUserLname, &strUserSignPath, &strUserSignFile)
// 	if err != nil {
// 		c.IndentedJSON(http.StatusOK, gin.H{
// 			"Error": err.Error(),
// 		})
// 		return
// 	}

// 	groupPart, err := db.Query("SELECT irpn_id, irpn_part_no, irpn_part_name, irpn_model, irpn_remark FROM info_rfq_part_no WHERE ir_id = ? AND irpn_status = 1 ORDER BY irpn_id", iId)
// 	if err != nil {
// 		c.IndentedJSON(http.StatusOK, gin.H{
// 			"Error": err.Error(),
// 		})
// 		return
// 	}
// 	defer groupPart.Close()

// 	for groupPart.Next() {
// 		var partGroup RfqGroupPart
// 		var remark sql.NullString

// 		err := groupPart.Scan(&partGroup.Irpn_id, &partGroup.IrPartNo, &partGroup.IrPartName, &partGroup.IrModel, &remark)
// 		if err != nil {
// 			c.IndentedJSON(http.StatusOK, gin.H{
// 				"Error": err.Error(),
// 			})
// 			return
// 		}

// 		remarkValue := ""
// 		if remark.Valid {
// 			remarkValue = remark.String
// 		}

// 		partGroup.IrRemark = remarkValue
// 		objRfq.IrGroupPart = append(objRfq.IrGroupPart, partGroup)
// 	}

// 	groupVolume, err := db.Query("SELECT irv_year, irv_volume FROM info_rfq_volume WHERE ir_id = ? AND irv_status_flg = 1 ORDER BY irv_id", iId)
// 	if err != nil {
// 		c.IndentedJSON(http.StatusOK, gin.H{
// 			"Error": err.Error(),
// 		})
// 		return
// 	}
// 	defer groupVolume.Close()

// 	for groupVolume.Next() {
// 		var volumeGroup RfqGroupVolume

// 		err := groupVolume.Scan(&volumeGroup.Year, &volumeGroup.Volume)
// 		if err != nil {
// 			c.IndentedJSON(http.StatusOK, gin.H{
// 				"Error": err.Error(),
// 			})
// 			return
// 		}

// 		objRfq.IrGroupVolume = append(objRfq.IrGroupVolume, volumeGroup)
// 	}

// 	var formChkGroup RfqGroupCheckbox

// 	queryFormChk := db.QueryRow(`SELECT irfc_pu_dept, irfc_pe_dept, irfc_scm_dept, irfc_ce_dept, irfc_gdc_dept, irfc_raw_puc, irfc_mold_puc, irfc_menufac_puc, irfc_transport_puc, irfc_cast_poc, irfc_machin_poc, irfc_assembly_poc, irfc_pack_poc FROM info_rfq_formcheck WHERE ir_id = ? AND irfc_status_flg = 1 ORDER BY irfc_id LIMIT 1`, iId).Scan(&formChkGroup.IrPuDept, &formChkGroup.IrPeDept, &formChkGroup.IrScmDept, &formChkGroup.IrCeDept, &formChkGroup.IrGdcDept, &formChkGroup.IrRawPuc, &formChkGroup.IrMoldPuc, &formChkGroup.IrMenufacPuc, &formChkGroup.IrTransportPuc, &formChkGroup.IrCastPoc, &formChkGroup.IrMachinPoc, &formChkGroup.IrAssemblyPoc, &formChkGroup.IrPackPoc)
// 	if queryFormChk != nil {
// 		c.IndentedJSON(http.StatusOK, gin.H{
// 			"Error": queryFormChk.Error(),
// 		})
// 		return
// 	}

// 	objRfq.IrGroupCheckbox = append(objRfq.IrGroupCheckbox, formChkGroup)

// 	if strRefFm.Valid {
// 		objRfq.Ir_ref_fm = int(strRefFm.Int64)
// 	}
// 	if strRefNbc.Valid {
// 		objRfq.Ir_ref_nbc = int(strRefNbc.Int64)
// 	}
// 	if strUserFname.Valid {
// 		objRfq.Su_firstname = strUserFname.String
// 	}
// 	if strUserLname.Valid {
// 		objRfq.Su_lastname = strUserLname.String
// 	}
// 	if strNote.Valid {
// 		objRfq.Ir_note = strNote.String
// 	}
// 	if strComment.Valid {
// 		objRfq.Ir_comment = strComment.String
// 	}
// 	if strUserSignPath.Valid {
// 		objRfq.Su_sign_path = strUserSignPath.String
// 	}
// 	if strUserSignFile.Valid {
// 		objRfq.Su_sign_file = strUserSignFile.String
// 	}
// 	if strCreateDate.Valid {
// 		objRfq.Create_date = strCreateDate.String
// 	}
// 	if strUpdateDate.Valid {
// 		objRfq.Update_date = strUpdateDate.String
// 	}
// 	if strCreateBy.Valid {
// 		objRfq.Create_by = strCreateBy.String
// 	}
// 	if strUpdateBy.Valid {
// 		objRfq.Update_by = strUpdateBy.String
// 	}
// 	c.IndentedJSON(http.StatusOK, objRfq)
// }

func CreateNbc(c *gin.Context) {
	iId := c.Param("id")
	strUpdateBy := c.Param("userID")
	strUpdateDate := time.Now().Format("2006-01-02 15:04:05")

	var objReferRfq GetRfqNew
	var objDocNo GetDocNo
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

	queryGetRefer := "SELECT * FROM info_document_control WHERE idc_id = ?"
	err := db.QueryRow(queryGetRefer, iId).Scan(&objReferRfq.Idc_id, &objReferRfq.Mdt_id, &strReferDoc, &objReferRfq.Idc_running_no, &objReferRfq.Idc_issue_year, &objReferRfq.Idc_issue_month, &objReferRfq.Idc_issue_seq_no, &objReferRfq.Idc_customer_type, &objReferRfq.Idc_customer_name, &objReferRfq.Idc_plant_cd, &objReferRfq.Mds_id, &strSubjectNote, &objReferRfq.Mde_id, &strEnclosuresNote, &objReferRfq.Idc_project_life, &objReferRfq.Idc_project_start, &strIssueDate, &objReferRfq.Idc_closing_date, &strReplyDate, &objReferRfq.Idc_result_confirm, &objReferRfq.Idc_status, &strNote1, &strNote2, &strFilePath, &strPhysicalPath, &strCancelReason, &objReferRfq.Idc_created_date, &objReferRfq.Idc_created_by, &objReferRfq.Idc_updated_date, &objReferRfq.Idc_updated_by)
	if err == sql.ErrNoRows {
		c.IndentedJSON(http.StatusOK, gin.H{"Error4": err.Error()})
		return
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
	rowsAttn, err := db.Query("SELECT mda_id FROM `info_document_attn` WHERE idc_id = ? AND idat_status = 1 ORDER BY idat_id", iId)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error10": err.Error()})
		return
	}
	defer rowsAttn.Close()
	for rowsAttn.Next() {
		var mdaID int
		if err := rowsAttn.Scan(&mdaID); err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{"Error11": err.Error()})
			return
		}
		objReferRfq.Idat_item = append(objReferRfq.Idat_item, fmt.Sprintf("%d", mdaID))
	}

	if err := rowsAttn.Err(); err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error12": err.Error()})
		return
	}

	/////////////////////  GET ITEM  ///////////////////////
	rowsItem, err := db.Query("SELECT idi_id, idi_item_no, idi_item_name, idi_model, idi_remark FROM `info_document_item` WHERE idc_id = ? AND idi_status = 1 ORDER BY idi_id", iId)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error5": err.Error()})
		return
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
			return
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
			return
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
				return
			}
			groupPart.IrGroupVolume = append(groupPart.IrGroupVolume, groupVolume)
		}

		if err := rowsVolume.Err(); err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
			return
		}

		objReferRfq.IrGroupPart = append(objReferRfq.IrGroupPart, groupPart)
	}

	if err := rowsItem.Err(); err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error7": err.Error()})
		return
	}

	var strNote2Null sql.NullString
	query := "SELECT mdt.mdt_id, CONCAT(mdt.mdt_position1, '-', mdt.mdt_position2) AS doc_mst, mdcn.mdcn_position1 AS doc_cur_no_p1, mdcn.mdcn_position2 AS doc_cur_no_p2, CONCAT( CONCAT(mdt.mdt_position1, '-', mdt.mdt_position2), '-', CONCAT(mdcn.mdcn_position1) ) AS doc_run_no FROM mst_document_type mdt LEFT JOIN mst_document_control_no mdcn ON mdcn.mdt_id = mdt.mdt_id WHERE mdt.mdt_id = ? AND mdt.mdt_status = 1"
	err = db.QueryRow(query, 2).Scan(&objDocNo.Mdt_id, &objDocNo.Doc_mst, &objDocNo.Doc_cur_no_po1, &objDocNo.Doc_cur_no_po2, &objDocNo.Doc_run_no)

	if err == sql.ErrNoRows {
		c.IndentedJSON(http.StatusOK, gin.H{"Error19": err.Error()})
		return
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

	docCrurent, err := db.Exec("INSERT INTO info_document_control (mdt_id, idc_refer_doc, idc_running_no, idc_issue_year, idc_issue_month, idc_issue_seq_no, idc_customer_type, idc_customer_name, idc_plant_cd, mds_id, idc_subject_note, mde_id, idc_enclosures_note, idc_project_life, idc_project_start, idc_issue_date, idc_closing_date, idc_result_confirm, idc_status, idc_note1, idc_note2, idc_file_path, idc_physical_path, idc_cancel_reason, idc_created_date, idc_created_by, idc_updated_date, idc_updated_by) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", objDocNo.Mdt_id, iId, runNo, objReferRfq.Idc_issue_year, objReferRfq.Idc_issue_month, objDocNo.Doc_cur_no_po2, objReferRfq.Idc_customer_type, objReferRfq.Idc_customer_name, objReferRfq.Idc_plant_cd, objReferRfq.Mds_id, objReferRfq.Idc_subject_note, objReferRfq.Mde_id, objReferRfq.Idc_enclosures_note, objReferRfq.Idc_project_life, objReferRfq.Idc_project_start, strIssueDate, objReferRfq.Idc_closing_date, objReferRfq.Idc_result_confirm, 1, strNote1, strNote2Null, strFilePath, strPhysicalPath, strCancelReason, strUpdateDate, strUpdateBy, strUpdateDate, strUpdateBy)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error20": err.Error()})
		return
	}

	iLastID, err := docCrurent.LastInsertId()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error21": err.Error()})
		return
	}

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

		itemInsert, err := db.Exec(query, iLastID, partNo, partName, model, orderNo, 1, remark, strUpdateDate, strUpdateBy, strUpdateDate, strUpdateBy)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{"False": err.Error()})
			return
		}

		itemLastId, err := itemInsert.LastInsertId()
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{"False": "ไม่สามารถดึง Last Insert ID ได้"})
			return
		}

		var sql string = "INSERT INTO info_document_volume (idi_id, idv_year, idv_qty, idv_status, idv_created_date, idv_created_by, idv_updated_date, idv_updated_by) VALUES "
		for _, volume := range partCurrent.IrGroupVolume {
			value := fmt.Sprintf("(%d, %s, %s, %d, '%s', '%s', '%s', '%s')",
				itemLastId,
				volume.Idv_year,
				volume.Idv_qty,
				1,
				strUpdateDate,
				strUpdateBy,
				strUpdateDate,
				strUpdateBy)
			valuesVolume = append(valuesVolume, value)
		}

		if len(valuesVolume) == 0 {
			c.IndentedJSON(http.StatusOK, gin.H{"False": "ไม่มีข้อมูลที่สามารถบันทึกได้"})
			return
		}

		sql += strings.Join(valuesVolume, ",")
		_, errPartItem := db.Exec(sql)

		if errPartItem != nil {
			c.IndentedJSON(http.StatusOK, gin.H{"False": errPartItem.Error()})
			return
		}
	}

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
			strUpdateDate,
			strUpdateBy,
			strUpdateDate,
			strUpdateBy)

		objListAttn = append(objListAttn, objAttn)
	}

	if len(objListAttn) == 0 {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": "ไม่มีข้อมูลที่สามารถบันทึกได้"})
		return
	}

	sqlAttn += strings.Join(objListAttn, ",")

	_, errAttn := db.Exec(sqlAttn)
	if errAttn != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error25": errAttn.Error()})
		return
	}

	_, errUpdateSeq := db.Exec("UPDATE mst_document_control_no SET mdcn_position2 = ? WHERE mdt_id = ?", objDocNo.Doc_cur_no_po2, objDocNo.Mdt_id)
	if errUpdateSeq != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error28": errUpdateSeq.Error()})
		return
	}

	c.IndentedJSON(http.StatusOK, gin.H{"Update": iLastID})
}
func SubmitRfq(c *gin.Context) {
	iId := c.Param("id")
	type InputData struct {
		NBCCheck         bool   `json:"nbcCheck"`
		FeasibilityCheck bool   `json:"feasibilityCheck"`
		IntReplyDate     string `json:"intReplydate"`
		CreateDate       string `json:"createDate"`
		CreateBy         string `json:"createBy"`
	}
	type DocAppData struct {
		Position1 string
		SwgId     int
		UserID    int
		SatID     int
	}
	var objData InputData
	if err := c.BindJSON(&objData); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}

	type userEmail struct {
		Su_id        int    `json:"su_id"`
		Su_firstname string `json:"su_firstname"`
		Su_email     string `json:"su_email"`
	}

	var objReferRfq GetRfq
	var objEmail userEmail
	var idaCurrent int

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

	queryGetRefer := "SELECT * FROM info_document_control WHERE idc_id = ?"
	err := db.QueryRow(queryGetRefer, iId).Scan(&objReferRfq.Idc_id, &objReferRfq.Mdt_id, &strReferDoc, &objReferRfq.Idc_running_no, &objReferRfq.Idc_issue_year, &objReferRfq.Idc_issue_month, &objReferRfq.Idc_issue_seq_no, &objReferRfq.Idc_customer_type, &objReferRfq.Idc_customer_name, &objReferRfq.Idc_plant_cd, &objReferRfq.Mds_id, &strSubjectNote, &objReferRfq.Mde_id, &strEnclosuresNote, &objReferRfq.Idc_project_life, &objReferRfq.Idc_project_start, &strIssueDate, &objReferRfq.Idc_closing_date, &strReplyDate, &objReferRfq.Idc_result_confirm, &objReferRfq.Idc_status, &strNote1, &strNote2, &strFilePath, &strPhysicalPath, &strCancelReason, &objReferRfq.Idc_created_date, &objReferRfq.Idc_created_by, &objReferRfq.Idc_updated_date, &objReferRfq.Idc_updated_by)
	if err == sql.ErrNoRows {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
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

	rowsItem, err := db.Query("SELECT idi_id, idi_item_no, idi_item_name, idi_model, idi_remark FROM `info_document_item` WHERE idc_id = ? AND idi_status = 1 ORDER BY idi_id", c.Param("id"))
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
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
			c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
			return
		}
		if strModel.Valid {
			groupPart.Idi_model = strModel.String
		}
		if strRemark.Valid {
			groupPart.Idi_remark = strRemark.String
		}
		objReferRfq.IrGroupPart = append(objReferRfq.IrGroupPart, groupPart)
	}

	if err := rowsItem.Err(); err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}

	query := ` SELECT mdt.mdt_position1, swd.swg_id, swd.su_id, swd.sat_id FROM mst_document_type mdt LEFT JOIN info_document_control idc ON idc.mdt_id = mdt.mdt_id LEFT JOIN mst_approve_pattern map ON map.map_id = mdt.map_id LEFT JOIN mst_approve_pattern_detail mapd ON map.map_id = mapd.map_id LEFT JOIN sys_approve_type sat ON sat.sat_id = mapd.sat_id LEFT JOIN sys_workflow_detail swd ON sat.sat_id = swd.sat_id LEFT JOIN sys_users su ON su.su_id = swd.su_id WHERE mdt.mdt_id = ( SELECT mdt_id FROM info_document_control WHERE idc_id = ? ) AND swd.swg_id = ( SELECT swg_id FROM sys_workflow_group swg LEFT JOIN sys_department sd ON sd.sd_id = swg.sd_id LEFT JOIN sys_users su ON sd.sd_id = su.sd_id WHERE su.su_username = ? ) AND swd.swd_status = 1 GROUP BY swd.su_id ORDER BY mapd.mapd_seq_no `

	rows, err := db.Query(query, iId, objData.CreateBy)
	if err != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"error": "Failed to execute query"})
		return
	}
	defer rows.Close()

	var results []DocAppData
	for rows.Next() {
		var data DocAppData
		if err := rows.Scan(&data.Position1, &data.SwgId, &data.UserID, &data.SatID); err != nil {
			c.IndentedJSON(http.StatusInternalServerError, gin.H{"error": "Failed to scan row data"})
			return
		}
		results = append(results, data)
	}
	if err := rows.Err(); err != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"error": "Error occurred while reading rows"})
		return
	} else {
		convertedId, err := strconv.Atoi(iId)
		if err != nil {
			c.IndentedJSON(http.StatusBadRequest, gin.H{"error": "Invalid ID, must be an integer"})
			return
		}

		var sqlIda string = "INSERT INTO info_document_approval (swg_id, su_id, sat_id, ida_seq_no, idc_id, ida_created_date, ida_created_by, ida_updated_date, ida_updated_by) VALUES "
		objListIda := []string{}
		countSeqNo := 1

		for _, idaCurrent := range results {
			objIda := fmt.Sprintf("(%d, %d, %d, %d, %d, '%s', '%s', '%s', '%s')",
				idaCurrent.SwgId,
				idaCurrent.UserID,
				idaCurrent.SatID,
				countSeqNo,
				convertedId,
				objData.CreateDate,
				objData.CreateBy,
				objData.CreateDate,
				objData.CreateBy,
			)
			countSeqNo++
			objListIda = append(objListIda, objIda)
		}

		if len(objListIda) == 0 {
			c.IndentedJSON(http.StatusBadRequest, gin.H{"error": "ไม่มีข้อมูลที่สามารถบันทึกได้"})
			return
		}

		sqlIda += strings.Join(objListIda, ",")

		_, errIda := db.Exec(sqlIda)
		if errIda != nil {
			c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": errIda.Error()})
			return
		}
		type notiActive struct {
			Ida_id    int    `json:"ida_id"`
			Su_id     int    `json:"su_id"`
			Ida_count string `json:"ida_count"`
			Sat_id    int    `json:"sat_id"`
		}
		var objNotiActive notiActive
		strShowUsers := "You have a new document"
		err = db.QueryRow("SELECT ida_id, su_id, COUNT(ida_id) AS ida_count, MIN(sat_id) AS sat_id FROM info_document_approval WHERE idc_id = ? AND ida_action = 0 AND ida_status = 1", iId).Scan(&objNotiActive.Ida_id, &objNotiActive.Su_id, &objNotiActive.Ida_count, &objNotiActive.Sat_id)
		if err == sql.ErrNoRows {
			c.IndentedJSON(http.StatusOK, false)
			return
		}
		idaCurrent = objNotiActive.Ida_id
		_, err = db.Exec("INSERT INTO sys_notification_ctrl(snc_type, ida_id, snc_show_users, snc_read_status, snc_created_date, snc_updated_date) VALUES(?, ?, ?, ?, ?, ?)", 1, objNotiActive.Ida_id, strShowUsers, 0, objData.CreateDate, objData.CreateDate)

		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		}

		getEmail := "SELECT su_id, su_firstname, su_email FROM sys_users WHERE su_id = ?"
		err = db.QueryRow(getEmail, objNotiActive.Su_id).Scan(&objEmail.Su_id, &objEmail.Su_firstname, &objEmail.Su_email)

		if err != nil {
			if err == sql.ErrNoRows {
				c.IndentedJSON(http.StatusOK, gin.H{"Error": "No user found"})
				return
			}
			c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
			return
		}
	}

	if objData.NBCCheck {
		var objDocNo GetDocNo
		if objData.IntReplyDate == "" {
			c.IndentedJSON(http.StatusBadRequest, gin.H{"error": "Reply date is required"})
			return
		}

		query := "SELECT mdt.mdt_id, CONCAT(mdt.mdt_position1, '-', mdt.mdt_position2) AS doc_mst, mdcn.mdcn_position1 AS doc_cur_no_p1, mdcn.mdcn_position2 AS doc_cur_no_p2, CONCAT( CONCAT(mdt.mdt_position1, '-', mdt.mdt_position2), '-', CONCAT(mdcn.mdcn_position1) ) AS doc_run_no FROM mst_document_type mdt LEFT JOIN mst_document_control_no mdcn ON mdcn.mdt_id = mdt.mdt_id WHERE mdt.mdt_name LIKE ? AND mdt.mdt_status = 1"
		err := db.QueryRow(query, "%NBC%").Scan(&objDocNo.Mdt_id, &objDocNo.Doc_mst, &objDocNo.Doc_cur_no_po1, &objDocNo.Doc_cur_no_po2, &objDocNo.Doc_run_no)

		if err == sql.ErrNoRows {
			c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
			return
		}

		_, err = db.Exec("INSERT INTO temp_refer_document (idc_id, mdt_id, trd_created_date, trd_updated_date) VALUES(?, ?, ?, ?)", iId, objDocNo.Mdt_id, objData.CreateDate, objData.CreateDate)

		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
			return
		}

		_, errUpdateReplyDate := db.Exec("UPDATE info_document_control SET idc_reply_date = ? WHERE idc_id = ?", objData.IntReplyDate, iId)
		if errUpdateReplyDate != nil {
			c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": errUpdateReplyDate.Error()})
			return
		}

	}

	if objData.FeasibilityCheck {
		var objDocNo GetDocNo

		query := `SELECT mdt.mdt_id, CONCAT(mdt.mdt_position1, '-', mdt.mdt_position2) AS doc_mst, mdcn.mdcn_position1 AS doc_cur_no_p1, mdcn.mdcn_position2 AS doc_cur_no_p2, CONCAT( CONCAT(mdt.mdt_position1, '-', mdt.mdt_position2), '-', CONCAT(mdcn.mdcn_position1) ) AS doc_run_no FROM mst_document_type mdt LEFT JOIN mst_document_control_no mdcn ON mdcn.mdt_id = mdt.mdt_id WHERE mdt.mdt_name LIKE ? AND mdt.mdt_status = 1`
		err := db.QueryRow(query, "%feasibility%").Scan(&objDocNo.Mdt_id, &objDocNo.Doc_mst, &objDocNo.Doc_cur_no_po1, &objDocNo.Doc_cur_no_po2, &objDocNo.Doc_run_no)

		if err == sql.ErrNoRows {
			c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
			return
		}

		_, err = db.Exec("INSERT INTO temp_refer_document (idc_id, mdt_id, trd_created_date, trd_updated_date) VALUES(?, ?, ?, ?)", iId, objDocNo.Mdt_id, objData.CreateDate, objData.CreateDate)

		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
			return
		}
	}

	_, err = db.Exec("UPDATE info_document_control SET idc_status = 2, idc_updated_date = ?, idc_updated_by = ? WHERE idc_id = ?", objData.CreateDate, objData.CreateBy, iId)
	if err != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{
			"Error": err.Error(),
		})
		return
	}

	errMail := SendMail(c, objReferRfq.Idc_id, idaCurrent, objEmail.Su_firstname, objEmail.Su_email, "waiting")
	if errMail != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": errMail.Error()})
		return
	}

	c.IndentedJSON(http.StatusOK, gin.H{"Update": objData})
}

// func ListRfqFileId(c *gin.Context) {
// 	// log.Println("List Part No By Id : ", c.Param("id"))
// 	var objFileList []GetRfqFileById
// 	objListFile, err := db.Query("SELECT sfu_id, sfu_file_name, sfu_file_path FROM `sys_files_upload` WHERE sfu_doc_no = ?", c.Param("id"))
// 	if err != nil {
// 		c.IndentedJSON(http.StatusOK, gin.H{
// 			"Error": err.Error(),
// 		})
// 		return
// 	}
// 	defer objListFile.Close()
// 	for objListFile.Next() {
// 		var objListRfq GetRfqFileById
// 		err := objListFile.Scan(&objListRfq.Sfu_id, &objListRfq.Sfu_file_name, &objListRfq.Sfu_file_path)
// 		if err != nil {
// 			c.IndentedJSON(http.StatusOK, gin.H{
// 				"Error": err.Error(),
// 			})
// 			return
// 		}
// 		objFileList = append(objFileList, objListRfq)
// 	}
// 	err = objListFile.Err()
// 	if err != nil {
// 		c.IndentedJSON(http.StatusOK, gin.H{
// 			"Error": err.Error(),
// 		})
// 		return
// 	}

// 	var objData GetRfqFileByIdData
// 	objData.Data = objFileList
// 	c.IndentedJSON(http.StatusOK, objData)
// }

func EditRfq(c *gin.Context) {
	var objRfq RfqNew
	var groupPartCountOld []int

	if err := c.BindJSON(&objRfq); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}

	var strNote sql.NullString
	var strComment sql.NullString
	var strFile sql.NullString
	var strPhysical sql.NullString

	strNote = sql.NullString{
		String: objRfq.Idc_note1,
		Valid:  objRfq.Idc_note1 != "",
	}
	strComment = sql.NullString{
		String: objRfq.Idc_note2,
		Valid:  objRfq.Idc_note2 != "",
	}
	strFile = sql.NullString{
		String: objRfq.Idc_file_path,
		Valid:  objRfq.Idc_file_path != "",
	}
	strPhysical = sql.NullString{
		String: objRfq.Idc_physical_path,
		Valid:  objRfq.Idc_physical_path != "",
	}

	_, err := db.Exec(` UPDATE info_document_control  SET  idc_customer_type = ?,  idc_customer_name = ?,  idc_plant_cd = ?,  mds_id = ?,  idc_subject_note = ?,  mde_id = ?,  idc_enclosures_note = ?,  idc_project_life = ?,  idc_project_start = ?,  idc_closing_date = ?,  idc_note1 = ?,  idc_note2 = ?,  idc_file_path = ?,  idc_physical_path = ?,  idc_updated_date = ?,  idc_updated_by = ?  WHERE idc_id = ? `, objRfq.Idc_customer_type, objRfq.Idc_customer_name, objRfq.Idc_plant_cd, objRfq.Mds_id, objRfq.Idc_subject_note, objRfq.Mde_id, objRfq.Idc_enclosures_note, objRfq.Idc_project_life, objRfq.Idc_project_start, objRfq.Idc_closing_date, strNote, strComment, strFile, strPhysical, objRfq.Idc_updated_date, objRfq.Idc_updated_by, objRfq.Idc_id)

	if err != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
		return
	} else {
		////////////////////////////////////// Group Part //////////////////////////////////
		rows, err := db.Query(
			"SELECT idi_id FROM info_document_item WHERE idc_id = ? AND idi_status = 1", objRfq.Idc_id)
		if err != nil {
			c.JSON(http.StatusInternalServerError, gin.H{"error": "Database error"})
			return
		}
		defer rows.Close()

		for rows.Next() {
			var idi_id int
			if err := rows.Scan(&idi_id); err != nil {
				c.JSON(http.StatusInternalServerError, gin.H{"error": "Database error"})
				return
			}
			groupPartCountOld = append(groupPartCountOld, idi_id)
		}

		if err := rows.Err(); err != nil {
			c.JSON(http.StatusInternalServerError, gin.H{"error": "Database error"})
			return
		}

		if len(groupPartCountOld) == len(objRfq.IrGroupPart) {
			//////////////////////////////////// Old Group Part //////////////////////////////////-------------
			for i, part := range objRfq.IrGroupPart {
				var remark sql.NullString
				if part.Idi_remark == "" {
					remark = sql.NullString{String: "", Valid: false}
				} else {
					remark = sql.NullString{String: part.Idi_remark, Valid: true}
				}

				_, err := db.Exec(
					"UPDATE info_document_item SET idi_item_no = ?, idi_item_name = ?, idi_model = ?, idi_remark = ?, idi_updated_date = ?, idi_updated_by = ? WHERE idi_id = ?",
					part.Idi_item_no, part.Idi_item_name, part.Idi_model, remark, objRfq.Idc_updated_date, objRfq.Idc_updated_by, groupPartCountOld[i],
				)

				if err != nil {
					c.JSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
					return
				} else {
					_, err := db.Exec("UPDATE info_document_volume SET idv_status = 0 WHERE idi_id = ?", groupPartCountOld[i])
					if err != nil {
						c.JSON(http.StatusInternalServerError, gin.H{"ErrorFlgStatus": "Failed to update old parts status"})
						return
					}

					for _, volume := range part.IrGroupVolume {
						if volume.Idv_id == 0 {
							_, err := db.Exec(
								"INSERT INTO info_document_volume(idi_id, idv_year, idv_qty, idv_created_date, idv_created_by, idv_updated_date, idv_updated_by) VALUES(?,?,?,?,?,?,?)",
								groupPartCountOld[i], volume.Idv_year, volume.Idv_qty, objRfq.Idc_updated_date, objRfq.Idc_updated_by, objRfq.Idc_updated_date, objRfq.Idc_updated_by,
							)
							if err != nil {
								c.JSON(http.StatusInternalServerError, gin.H{"ErrorInsertNew(OldGroupPart)": err.Error()})
								return
							}
						} else {
							_, err := db.Exec(
								"UPDATE info_document_volume SET idv_year = ?, idv_qty = ?, idv_status = 1, idv_updated_date = ?, idv_updated_by = ? WHERE idv_id = ? AND idi_id = ?",
								volume.Idv_year, volume.Idv_qty, objRfq.Idc_updated_date, objRfq.Idc_updated_by, volume.Idv_id, groupPartCountOld[i],
							)
							if err != nil {
								c.JSON(http.StatusInternalServerError, gin.H{"ErrorUpdate(OldGroupPart)": err.Error()})
								return
							}
						}
					}
				}

			}
		} else {
			// 	//////////////////////////////////// New Group Part //////////////////////////////////------------
			_, err := db.Exec("UPDATE info_document_item SET idi_status = 0 WHERE idc_id = ?", objRfq.Idc_id)
			if err != nil {
				c.JSON(http.StatusInternalServerError, gin.H{"Error": "Failed to update old parts status"})
				return
			}
			_, err = db.Exec("UPDATE info_document_volume idv SET idv_status = 0 WHERE EXISTS ( SELECT 1 FROM info_document_item idi JOIN info_document_control idc ON idc.idc_id = idi.idc_id WHERE idi.idi_id = idv.idi_id AND idc.idc_id = ?)", objRfq.Idc_id)
			if err != nil {
				c.JSON(http.StatusInternalServerError, gin.H{"Error": "Failed to update old parts status"})
				return
			}

			var remark sql.NullString
			var orderItem int

			for _, item := range objRfq.IrGroupPart {
				orderItem++
				if item.Idi_id == 0 {

					if item.Idi_remark == "" {
						remark = sql.NullString{String: "", Valid: false}
					} else {
						remark = sql.NullString{String: item.Idi_remark, Valid: true}
					}

					itemInsert, err := db.Exec("INSERT INTO info_document_item (idc_id, idi_item_no, idi_item_name, idi_model, idi_order_no, idi_status, idi_remark, idi_created_date, idi_created_by, idi_updated_date, idi_updated_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
						objRfq.Idc_id, item.Idi_item_no, item.Idi_item_name, item.Idi_model, orderItem, 1, remark, objRfq.Idc_updated_date, objRfq.Idc_updated_by, objRfq.Idc_updated_date, objRfq.Idc_updated_by,
					)

					if err != nil {
						c.JSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
						return
					} else {
						itemLastId, errLastID := itemInsert.LastInsertId()
						if errLastID != nil {
							c.JSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
							return
						}

						for _, volume := range item.IrGroupVolume {
							if volume.Idv_id == 0 {
								_, err := db.Exec(
									"INSERT INTO info_document_volume(idi_id, idv_year, idv_qty, idv_created_date, idv_created_by, idv_updated_date, idv_updated_by) VALUES(?,?,?,?,?,?,?)",
									itemLastId, volume.Idv_year, volume.Idv_qty, objRfq.Idc_updated_date, objRfq.Idc_updated_by, objRfq.Idc_updated_date, objRfq.Idc_updated_by,
								)
								if err != nil {
									c.JSON(http.StatusInternalServerError, gin.H{"ErrorInsertNew(OldGroupPart)": err.Error()})
									return
								}
							} else {
								_, err := db.Exec(
									"UPDATE info_document_volume SET idv_year = ?, idv_qty = ?, idv_status = 1, idv_updated_date = ?, idv_updated_by = ? WHERE idv_id = ? AND idi_id = ?",
									volume.Idv_year, volume.Idv_qty, objRfq.Idc_updated_date, objRfq.Idc_updated_by, volume.Idv_id, itemLastId,
								)
								if err != nil {
									c.JSON(http.StatusInternalServerError, gin.H{"ErrorUpdate(OldGroupPart)": err.Error()})
									return
								}
							}
						}
					}
				} else {
					if item.Idi_remark == "" {
						remark = sql.NullString{String: "", Valid: false}
					} else {
						remark = sql.NullString{String: item.Idi_remark, Valid: true}
					}

					_, err := db.Exec("UPDATE info_document_item SET idi_item_no = ?, idi_item_name = ?, idi_model = ?, idi_remark = ?, idi_order_no = ?, idi_status = ?, idi_updated_date = ?, idi_updated_by = ? WHERE idi_id = ?", item.Idi_item_no, item.Idi_item_name, item.Idi_model, remark, orderItem, 1, objRfq.Idc_updated_date, objRfq.Idc_updated_by, item.Idi_id)

					if err != nil {
						c.JSON(http.StatusInternalServerError, gin.H{"ErrorFlgStatus": "Failed to update old parts status"})
						return
					} else {
						for _, volume := range item.IrGroupVolume {
							if volume.Idv_id == 0 {
								_, err := db.Exec(
									"INSERT INTO info_document_volume(idi_id, idv_year, idv_qty, idv_created_date, idv_created_by, idv_updated_date, idv_updated_by) VALUES(?,?,?,?,?,?,?)",
									item.Idi_id, volume.Idv_year, volume.Idv_qty, objRfq.Idc_updated_date, objRfq.Idc_updated_by, objRfq.Idc_updated_date, objRfq.Idc_updated_by,
								)
								if err != nil {
									c.JSON(http.StatusInternalServerError, gin.H{"ErrorInsertNew(OldGroupPart)": err.Error()})
									return
								}
							} else {
								_, err := db.Exec(
									"UPDATE info_document_volume SET idv_year = ?, idv_qty = ?, idv_status = 1, idv_updated_date = ?, idv_updated_by = ? WHERE idv_id = ? AND idi_id = ?",
									volume.Idv_year, volume.Idv_qty, objRfq.Idc_updated_date, objRfq.Idc_updated_by, volume.Idv_id, item.Idi_id,
								)
								if err != nil {
									c.JSON(http.StatusInternalServerError, gin.H{"ErrorUpdate(OldGroupPart)": err.Error()})
									return
								}
							}
						}
					}
				}
			}
		}

		//////////////////////////////////// Attn //////////////////////////////////-----------------------
		var currentAttn []int
		var noCurrentAttn []int

		rows, err = db.Query("SELECT mda_id FROM info_document_attn WHERE idc_id = ?", objRfq.Idc_id)
		if err != nil {
			c.JSON(http.StatusInternalServerError, gin.H{"error": "Database error"})
			return
		}
		defer rows.Close()

		for rows.Next() {
			var idat_id int
			if err := rows.Scan(&idat_id); err != nil {
				c.JSON(http.StatusInternalServerError, gin.H{"error": "Database error"})
				return
			}
			currentAttn = append(currentAttn, idat_id)
		}

		for _, item := range objRfq.Idat_item {
			num, err := strconv.Atoi(item)
			if err != nil {
				c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
				return
			}
			noCurrentAttn = append(noCurrentAttn, num)
		}

		currentAttnMap := make(map[int]bool)
		for _, id := range currentAttn {
			currentAttnMap[id] = true
		}

		_, err = db.Exec("UPDATE info_document_attn SET idat_status = 0 WHERE idc_id = ?", objRfq.Idc_id)
		if err != nil {
			c.JSON(http.StatusInternalServerError, gin.H{"Error": "Failed to update old volume status"})
			return
		}

		updateSQL := "UPDATE info_document_attn SET idat_status = 1, idat_updated_date = ?, idat_updated_by = ? WHERE idc_id = ? AND mda_id = ?"
		insertSQL := "INSERT INTO info_document_attn (idc_id, mda_id, idat_created_date, idat_created_by, idat_updated_date, idat_updated_by, idat_status) VALUES (?, ?, ?, ?, ?, ?, 1)"

		for _, id := range noCurrentAttn {
			if currentAttnMap[id] {
				_, err := db.Exec(updateSQL, objRfq.Idc_updated_date, objRfq.Idc_updated_by, objRfq.Idc_id, id)
				if err != nil {
					c.JSON(http.StatusInternalServerError, gin.H{"error": "Error updating record", "id": id})
					return
				}
			} else {
				_, err := db.Exec(insertSQL, objRfq.Idc_id, id, objRfq.Idc_updated_date, objRfq.Idc_updated_by, objRfq.Idc_updated_date, objRfq.Idc_updated_by)
				if err != nil {
					c.JSON(http.StatusInternalServerError, gin.H{"error": "Error inserting record", "id": id})
					return
				}
			}
		}

		c.IndentedJSON(http.StatusOK, gin.H{"Update": "Update Success"})
	}
}

// func ListBtnRfq(c *gin.Context) {
// 	// log.Println("List Part No By Id : ", c.Param("id"))
// 	var objBtnList []GetBtnRfq
// 	objListData, err := db.Query("SELECT swd.swd_id, swd.swd_app_lv, swd.su_id, swd.swg_id, swd.sat_id, su.su_fname, su.su_lname, swg.swg_name, sat.sat_name FROM sys_workflow_detail swd LEFT JOIN sys_user su ON swd.su_id = su.su_id LEFT JOIN sys_workflow_group swg ON swd.swg_id = swg.swg_id LEFT JOIN sys_approve_type sat ON swd.sat_id = sat.sat_id WHERE su.su_emp_code = ?", c.Param("id"))
// 	if err != nil {
// 		c.IndentedJSON(http.StatusOK, gin.H{
// 			"Error": err.Error(),
// 		})
// 		return
// 	}
// 	defer objListData.Close()
// 	for objListData.Next() {
// 		var objListBtn GetBtnRfq
// 		err := objListData.Scan(&objListBtn.Swd_id, &objListBtn.Swd_app_lv, &objListBtn.Su_id, &objListBtn.Swg_id, &objListBtn.Sat_id, &objListBtn.Su_fname, &objListBtn.Su_lname, &objListBtn.Swg_name, &objListBtn.Sat_name)
// 		if err != nil {
// 			c.IndentedJSON(http.StatusOK, gin.H{
// 				"Error": err.Error(),
// 			})
// 			return
// 		}
// 		objBtnList = append(objBtnList, objListBtn)
// 	}
// 	err = objListData.Err()
// 	if err != nil {
// 		c.IndentedJSON(http.StatusOK, gin.H{
// 			"Error": err.Error(),
// 		})
// 		return
// 	}

// 	var objData GetBtnRfqData
// 	objData.Data = objBtnList
// 	c.IndentedJSON(http.StatusOK, objData)
// }

func GetReferRFQ(c *gin.Context) {
	type GetRunNo struct {
		Running_no string
	}
	var objValue GetRunNo
	err := db.QueryRow("SELECT idc_running_no FROM info_document_control WHERE idc_id = ?", c.Param("id")).Scan(&objValue.Running_no)
	if err == sql.ErrNoRows {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Running_no": "-",
		})
		return
	}
	c.IndentedJSON(http.StatusOK, objValue)
}
