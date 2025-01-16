package API

import (
	"database/sql"
	"fmt"
	"log"
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

func CheckApproveRfq(c *gin.Context) {
	var idc_id int
	id := c.Param("id")

	query := `SELECT idc.idc_id FROM info_document_control idc LEFT JOIN mst_document_type mdt ON mdt.mdt_id = idc.mdt_id WHERE mdt.mdt_name LIKE '%NBC%' AND idc.idc_refer_doc = ?`

	err := db.QueryRow(query, id).Scan(&idc_id)
	if err != nil {
		if err == sql.ErrNoRows {
			c.IndentedJSON(http.StatusOK, true)
			return
		}
		log.Printf("Error querying database: %v", err)
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"error": "Database query failed"})
		return
	}

	c.IndentedJSON(http.StatusOK, false)
}

func GetRFQ(c *gin.Context) {
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
	err := db.QueryRow(query, c.Param("id")).Scan(&objDocNo.Idc_id, &objDocNo.Mdt_id, &strReferDoc, &objDocNo.Idc_running_no, &objDocNo.Idc_issue_year, &objDocNo.Idc_issue_month, &objDocNo.Idc_issue_seq_no, &objDocNo.Idc_customer_type, &objDocNo.Idc_customer_name, &objDocNo.Idc_plant_cd, &objDocNo.Mds_id, &strSubjectNote, &objDocNo.Mde_id, &strEnclosuresNote, &objDocNo.Idc_project_life, &objDocNo.Idc_project_start, &strIssueDate, &objDocNo.Idc_closing_date, &strReplyDate, &objDocNo.Idc_result_confirm, &objDocNo.Idc_status, &strNote1, &strNote2, &strFilePath, &strPhysicalPath, &strCancelReason, &objDocNo.Idc_created_date, &objDocNo.Idc_created_by, &objDocNo.Idc_updated_date, &objDocNo.Idc_updated_by)
	if err == sql.ErrNoRows {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
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

	rowsAttn, err := db.Query("SELECT mda_id FROM `info_document_attn` WHERE idc_id = ? AND idat_status = 1 ORDER BY idat_id", c.Param("id"))
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer rowsAttn.Close()
	for rowsAttn.Next() {
		var idatID string
		if err := rowsAttn.Scan(&idatID); err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		objDocNo.Idat_item = append(objDocNo.Idat_item, idatID)
	}
	if err := rowsAttn.Err(); err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}

	rowsIdpu, err := db.Query("SELECT mdpu_id FROM `info_document_purchase_cost` WHERE idc_id = ? AND idpu_status = 1 ORDER BY idpu_id", c.Param("id"))
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer rowsIdpu.Close()
	for rowsIdpu.Next() {
		var idpuID string
		if err := rowsIdpu.Scan(&idpuID); err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		objDocNo.Idpu_item = append(objDocNo.Idpu_item, idpuID)
	}
	if err := rowsIdpu.Err(); err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}

	rowsIdpc, err := db.Query("SELECT mdpc_id FROM `info_document_process_cost` WHERE idc_id = ? AND idpc_status = 1 ORDER BY idpc_id", c.Param("id"))
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer rowsIdpc.Close()
	for rowsIdpc.Next() {
		var idpcID string
		if err := rowsIdpc.Scan(&idpcID); err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		objDocNo.Idpc_item = append(objDocNo.Idpc_item, idpcID)
	}
	if err := rowsIdpc.Err(); err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
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
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
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
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}

	rowsVolume, err := db.Query("SELECT idv_id, idv_year, idv_qty FROM `info_document_volume` WHERE idc_id = ? AND idv_status = 1 ORDER BY idv_id", c.Param("id"))
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer rowsVolume.Close()
	for rowsVolume.Next() {
		var groupVolume RfqGroupVolumeDetail
		if err := rowsVolume.Scan(
			&groupVolume.Idv_id,
			&groupVolume.Idv_year,
			&groupVolume.Idv_qty,
		); err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		objDocNo.IrGroupVolume = append(objDocNo.IrGroupVolume, groupVolume)
	}

	if err := rowsVolume.Err(); err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}

	c.IndentedJSON(http.StatusOK, objDocNo)
}
func RfqDocNo(c *gin.Context) {
	var objDocNo GetDocNo
	query := "SELECT mdt.mdt_id, CONCAT(mdt.mdt_position1, '-', mdt.mdt_position2) AS doc_mst, mdcn.mdcn_position1 AS doc_cur_no_p1, mdcn.mdcn_position2 AS doc_cur_no_p2, CONCAT( CONCAT(mdt.mdt_position1, '-', mdt.mdt_position2), '-', CONCAT(mdcn.mdcn_position1) ) AS doc_run_no FROM mst_document_type mdt LEFT JOIN mst_document_control_no mdcn ON mdcn.mdt_id = mdt.mdt_id WHERE mdt.mdt_position1 = ? AND mdt.mdt_status = 1"
	err := db.QueryRow(query, c.Param("id")).Scan(&objDocNo.Mdt_id, &objDocNo.Doc_mst, &objDocNo.Doc_cur_no_po1, &objDocNo.Doc_cur_no_po2, &objDocNo.Doc_run_no)
	if err == sql.ErrNoRows {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, objDocNo)
}

func InsertRfq(c *gin.Context) {
	var objRfq Rfq

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

	objResult, err := db.Exec("INSERT INTO info_document_control (mdt_id, idc_refer_doc, idc_running_no, idc_issue_year, idc_issue_month, idc_issue_seq_no, idc_customer_type, idc_customer_name, idc_plant_cd, mds_id, idc_subject_note, mde_id, idc_enclosures_note, idc_project_life, idc_project_start, idc_issue_date, idc_closing_date, idc_reply_date, idc_result_confirm, idc_status, idc_note1, idc_note2, idc_file_path, idc_physical_path, idc_cancel_reason, idc_created_date, idc_created_by, idc_updated_date, idc_updated_by) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", objRfq.Mdt_id, strReferDoc, objRfq.Idc_running_no, objRfq.Idc_issue_year, objRfq.Idc_issue_month, objRfq.Idc_issue_seq_no, objRfq.Idc_customer_type, objRfq.Idc_customer_name, objRfq.Idc_plant_cd, objRfq.Mds_id, objRfq.Idc_subject_note, objRfq.Mde_id, objRfq.Idc_enclosures_note, objRfq.Idc_project_life, objRfq.Idc_project_start, strIssueDate, objRfq.Idc_closing_date, strReplyDate, objRfq.Idc_result_confirm, objRfq.Idc_status, strNote, strComment, strFilePath, strPhysicalPath, strCancelReason, objRfq.Idc_created_date, objRfq.Idc_created_by, objRfq.Idc_created_date, objRfq.Idc_created_by)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}

	objLastId, err := objResult.LastInsertId()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}

	// Insert Part No
	var sql string = "INSERT INTO info_document_item (idc_id, idi_item_no, idi_item_name, idi_model, idi_order_no, idi_status, idi_remark, idi_created_date, idi_created_by, idi_updated_date, idi_updated_by) VALUES "
	values := []string{}

	for index, partCurrent := range objRfq.IrGroupPart {
		partNo := partCurrent.Idi_item_no
		partName := partCurrent.Idi_item_name
		model := partCurrent.Idi_model
		remark := partCurrent.Idi_remark
		orderNo := index + 1

		if partNo == "" {
			partNo = "NULL"
		} else {
			partNo = fmt.Sprintf("'%s'", partNo)
		}

		if partName == "" {
			partName = "NULL"
		} else {
			partName = fmt.Sprintf("'%s'", partName)
		}

		if model == "" {
			model = "NULL"
		} else {
			model = fmt.Sprintf("'%s'", model)
		}

		if remark == "" {
			remark = "NULL"
		} else {
			remark = fmt.Sprintf("'%s'", remark)
		}

		value := fmt.Sprintf("(%d, %s, %s, %s, %d, %d, %s, '%s', '%s', '%s', '%s')",
			objLastId,
			partNo,
			partName,
			model,
			orderNo,
			1,
			remark,
			objRfq.Idc_created_date,
			objRfq.Idc_created_by,
			objRfq.Idc_created_date,
			objRfq.Idc_created_by)
		values = append(values, value)
	}

	if len(values) == 0 {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": "ไม่มีข้อมูลที่สามารถบันทึกได้"})
		return
	}

	sql += strings.Join(values, ",")
	_, errPartItem := db.Exec(sql)

	if errPartItem != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": errPartItem.Error()})
		return
	}

	// Insert Volume
	var sqlVolume string = "INSERT INTO info_document_volume (idc_id, idv_year, idv_qty, idv_status, idv_created_date, idv_created_by, idv_updated_date, idv_updated_by) VALUES "
	objListVolume := []string{}

	for _, volumeCurrent := range objRfq.IrGroupVolume {
		objVolume := fmt.Sprintf("(%d, '%s', '%s', %d, '%s', '%s', '%s', '%s')",
			objLastId,
			volumeCurrent.Year,
			volumeCurrent.Volume,
			1,
			objRfq.Idc_created_date,
			objRfq.Idc_created_by,
			objRfq.Idc_created_date,
			objRfq.Idc_created_by)

		objListVolume = append(objListVolume, objVolume)
	}

	if len(objListVolume) == 0 {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": "ไม่มีข้อมูลที่สามารถบันทึกได้"})
		return
	}

	sqlVolume += strings.Join(objListVolume, ",")

	_, errVolume := db.Exec(sqlVolume)
	if errVolume != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": errVolume.Error()})
		return
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
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": "ไม่มีข้อมูลที่สามารถบันทึกได้"})
		return
	}

	sqlAttn += strings.Join(objListAttn, ",")

	_, errAttn := db.Exec(sqlAttn)
	if errAttn != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": errAttn.Error()})
		return
	}

	// Insert Idpu
	var sqlIdpu string = "INSERT INTO info_document_purchase_cost (idc_id, mdpu_id, idpu_note, idpu_status, idpu_created_date, idpu_created_by, idpu_updated_date, idpu_updated_by) VALUES "
	objListIdpu := []string{}

	for _, idpuCurrent := range objRfq.Idpu_item {

		idpuID, err := strconv.Atoi(idpuCurrent)
		if err != nil {
			fmt.Println("Error converting attnCurrent to int:", err)
			continue
		}

		objIdpu := fmt.Sprintf("(%d, %d, NULL, %d, '%s', '%s', '%s', '%s')",
			objLastId,
			idpuID,
			1,
			objRfq.Idc_created_date,
			objRfq.Idc_created_by,
			objRfq.Idc_created_date,
			objRfq.Idc_created_by)

		objListIdpu = append(objListIdpu, objIdpu)
	}

	if len(objListIdpu) == 0 {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": "ไม่มีข้อมูลที่สามารถบันทึกได้"})
		return
	}

	sqlIdpu += strings.Join(objListIdpu, ",")

	_, errIdpu := db.Exec(sqlIdpu)
	if errIdpu != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": errIdpu.Error()})
		return
	}

	// Insert Idpc
	var sqlIdpc string = "INSERT INTO info_document_process_cost (idc_id, mdpc_id, idpc_note, idpc_status, idpc_created_date, idpc_created_by, idpc_updated_date, idpc_updated_by) VALUES "
	objListIdpc := []string{}

	for _, idpcCurrent := range objRfq.Idpc_item {

		idpcID, err := strconv.Atoi(idpcCurrent)
		if err != nil {
			fmt.Println("Error converting attnCurrent to int:", err)
			continue
		}

		objIdpc := fmt.Sprintf("(%d, %d, NULL, %d, '%s', '%s', '%s', '%s')",
			objLastId,
			idpcID,
			1,
			objRfq.Idc_created_date,
			objRfq.Idc_created_by,
			objRfq.Idc_created_date,
			objRfq.Idc_created_by)

		objListIdpc = append(objListIdpc, objIdpc)
	}

	if len(objListIdpc) == 0 {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": "ไม่มีข้อมูลที่สามารถบันทึกได้"})
		return
	}

	sqlIdpc += strings.Join(objListIdpc, ",")

	_, errIdpc := db.Exec(sqlIdpc)
	if errIdpc != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": errIdpc.Error()})
		return
	}

	_, errUpdateSeq := db.Exec("UPDATE mst_document_control_no SET mdcn_position2 = ? WHERE mdt_id = ?", objRfq.Idc_issue_seq_no, objRfq.Mdt_id)
	if errUpdateSeq != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": errUpdateSeq.Error()})
		return
	}

	c.IndentedJSON(http.StatusOK, objLastId)
}

func ListRfqTable(c *gin.Context) {
	var objRfqList []RfqTable
	var mdtID int

	errMdt := db.QueryRow("SELECT mdt_id FROM mst_document_type WHERE mdt_position1 = ?", c.Param("id")).Scan(&mdtID)
	if errMdt != nil {
		if errMdt == sql.ErrNoRows {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": "No matching document type found",
			})
			return
		}
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": errMdt.Error(),
		})
		return
	}

	objListRfq, err := db.Query("SELECT idc.*, su.su_firstname, su.su_lastname, su.su_sign_path, su.su_sign_file FROM `info_document_control` AS idc LEFT JOIN sys_users AS su ON idc.idc_updated_by = su.su_username WHERE mdt_id = ? AND idc_created_date BETWEEN ? AND ? ORDER BY idc.idc_id", mdtID, c.Param("stratDate"), c.Param("endDate"))
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

		err := objListRfq.Scan(&objRfq.Idc_id, &objRfq.Mdt_id, &strReferDoc, &objRfq.Idc_running_no, &objRfq.Idc_issue_year, &objRfq.Idc_issue_month, &objRfq.Idc_issue_seq_no, &objRfq.Idc_customer_type, &objRfq.Idc_customer_name, &objRfq.Idc_plant_cd, &objRfq.Mds_id, &strSubjectNote, &objRfq.Mde_id, &strEnclosuresNote, &objRfq.Idc_project_life, &objRfq.Idc_project_start, &strIssueDate, &objRfq.Idc_closing_date, &strReplyDate, &objRfq.Idc_result_confirm, &objRfq.Idc_status, &strNote1, &strNote2, &strFilePath, &strPhysicalPath, &strCancelReason, &objRfq.Idc_created_date, &objRfq.Idc_created_by, &objRfq.Idc_updated_date, &objRfq.Idc_updated_by, &strFirstName, &strLastName, &strSignPath, &strSignFile)
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

func CancelRfq(c *gin.Context) {
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

func ReverseRfq(c *gin.Context) {
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

	var objReferRfq GetRfq

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
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
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
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}

	query := ` SELECT mdt.mdt_position1, swd.swg_id, swd.su_id, swd.sat_id FROM mst_document_type mdt LEFT JOIN info_document_control idc ON idc.mdt_id = mdt.mdt_id LEFT JOIN mst_approve_pattern map ON map.map_id = mdt.map_id LEFT JOIN mst_approve_pattern_detail mapd ON map.map_id = mapd.map_id LEFT JOIN sys_approve_type sat ON sat.sat_id = mapd.sat_id LEFT JOIN sys_workflow_detail swd ON sat.sat_id = swd.sat_id LEFT JOIN sys_users su ON su.su_id = swd.su_id WHERE mdt.mdt_id = ( SELECT mdt_id FROM info_document_control WHERE idc_id = ? ) AND swd.swg_id = ( SELECT swg_id FROM sys_workflow_group swg LEFT JOIN sys_department sd ON sd.sd_id = swg.sd_id WHERE sd.sd_dept_name = 'Sales & Marketing PLANT1' ) GROUP BY swd.su_id ORDER BY mapd.mapd_seq_no `

	rows, err := db.Query(query, iId)
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
			Ida_count string `json:"ida_count"`
			Sat_id    int    `json:"sat_id"`
		}
		var objNotiActive notiActive
		strShowUsers := "RFQ"
		err = db.QueryRow("SELECT ida_id, COUNT(ida_id) AS ida_count, MIN(sat_id) AS sat_id FROM info_document_approval WHERE idc_id = ? AND ida_action = 0", iId).Scan(&objNotiActive.Ida_id, &objNotiActive.Ida_count, &objNotiActive.Sat_id)
		if err == sql.ErrNoRows {
			c.IndentedJSON(http.StatusOK, false)
			return
		}
		_, err = db.Exec("INSERT INTO sys_notification_ctrl(snc_type, ida_id, snc_show_users, snc_read_status, snc_created_date, snc_updated_date) VALUES(?, ?, ?, ?, ?, ?)", 1, objNotiActive.Ida_id, strShowUsers, 0, objData.CreateDate, objData.CreateDate)

		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		}
	}

	if objData.NBCCheck {
		var objDocNo GetDocNo
		var runNo string
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

		objResult, err := db.Exec("INSERT INTO info_document_control (mdt_id, idc_refer_doc, idc_running_no, idc_issue_year, idc_issue_month, idc_issue_seq_no, idc_customer_type, idc_customer_name, idc_plant_cd, mds_id, idc_subject_note, mde_id, idc_enclosures_note, idc_project_life, idc_project_start, idc_issue_date, idc_closing_date, idc_reply_date, idc_result_confirm, idc_status, idc_note1, idc_note2, idc_file_path, idc_physical_path, idc_cancel_reason, idc_created_date, idc_created_by, idc_updated_date, idc_updated_by) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", objDocNo.Mdt_id, iId, runNo, objReferRfq.Idc_issue_year, objReferRfq.Idc_issue_month, objDocNo.Doc_cur_no_po2, objReferRfq.Idc_customer_type, objReferRfq.Idc_customer_name, objReferRfq.Idc_plant_cd, objReferRfq.Mds_id, objReferRfq.Idc_subject_note, objReferRfq.Mde_id, objReferRfq.Idc_enclosures_note, objReferRfq.Idc_project_life, objReferRfq.Idc_project_start, strIssueDate, objReferRfq.Idc_closing_date, objData.IntReplyDate, objReferRfq.Idc_result_confirm, 1, strNote1, strNote2, strFilePath, strPhysicalPath, strCancelReason, objData.CreateDate, objData.CreateBy, objData.CreateDate, objData.CreateBy)

		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
			return
		}

		objLastId, err := objResult.LastInsertId()
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
			return
		}

		// 	// Insert Part No
		var sql string = "INSERT INTO info_document_item (idc_id, idi_item_no, idi_item_name, idi_model, idi_order_no, idi_status, idi_remark, idi_created_date, idi_created_by, idi_updated_date, idi_updated_by) VALUES "
		values := []string{}

		for index, partCurrent := range objReferRfq.IrGroupPart {
			partNo := partCurrent.Idi_item_no
			partName := partCurrent.Idi_item_name
			model := partCurrent.Idi_model
			remark := partCurrent.Idi_remark
			orderNo := index + 1

			if partNo == "" {
				partNo = "NULL"
			} else {
				partNo = fmt.Sprintf("'%s'", partNo)
			}

			if partName == "" {
				partName = "NULL"
			} else {
				partName = fmt.Sprintf("'%s'", partName)
			}

			if model == "" {
				model = "NULL"
			} else {
				model = fmt.Sprintf("'%s'", model)
			}

			if remark == "" {
				remark = "NULL"
			} else {
				remark = fmt.Sprintf("'%s'", remark)
			}

			value := fmt.Sprintf("(%d, %s, %s, %s, %d, %d, %s, '%s', '%s', '%s', '%s')",
				objLastId,
				partNo,
				partName,
				model,
				orderNo,
				1,
				remark,
				objData.CreateDate,
				objData.CreateBy,
				objData.CreateDate,
				objData.CreateBy)
			values = append(values, value)
		}

		if len(values) == 0 {
			c.IndentedJSON(http.StatusBadRequest, gin.H{"error": "ไม่มีข้อมูลที่สามารถบันทึกได้"})
			return
		}

		sql += strings.Join(values, ",")
		_, errPartItem := db.Exec(sql)

		if errPartItem != nil {
			c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": errPartItem.Error()})
			return
		}

		_, errUpdateSeq := db.Exec("UPDATE mst_document_control_no SET mdcn_position2 = ? WHERE mdt_id = ?", objDocNo.Doc_cur_no_po2, objDocNo.Mdt_id)
		if errUpdateSeq != nil {
			c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": errUpdateSeq.Error()})
			return
		}
	}

	if objData.FeasibilityCheck {
		var objDocNo GetDocNo
		var replyDate sql.NullString
		var runNo string

		query := `SELECT mdt.mdt_id, CONCAT(mdt.mdt_position1, '-', mdt.mdt_position2) AS doc_mst, mdcn.mdcn_position1 AS doc_cur_no_p1, mdcn.mdcn_position2 AS doc_cur_no_p2, CONCAT( CONCAT(mdt.mdt_position1, '-', mdt.mdt_position2), '-', CONCAT(mdcn.mdcn_position1) ) AS doc_run_no FROM mst_document_type mdt LEFT JOIN mst_document_control_no mdcn ON mdcn.mdt_id = mdt.mdt_id WHERE mdt.mdt_name LIKE ? AND mdt.mdt_status = 1`
		err := db.QueryRow(query, "%feasibility%").Scan(&objDocNo.Mdt_id, &objDocNo.Doc_mst, &objDocNo.Doc_cur_no_po1, &objDocNo.Doc_cur_no_po2, &objDocNo.Doc_run_no)

		if err == sql.ErrNoRows {
			c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
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

		if replyDate.Valid {
			objData.IntReplyDate = replyDate.String
		}

		objResult, err := db.Exec("INSERT INTO info_document_control (mdt_id, idc_refer_doc, idc_running_no, idc_issue_year, idc_issue_month, idc_issue_seq_no, idc_customer_type, idc_customer_name, idc_plant_cd, mds_id, idc_subject_note, mde_id, idc_enclosures_note, idc_project_life, idc_project_start, idc_issue_date, idc_closing_date, idc_reply_date, idc_result_confirm, idc_status, idc_note1, idc_note2, idc_file_path, idc_physical_path, idc_cancel_reason, idc_created_date, idc_created_by, idc_updated_date, idc_updated_by) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", objDocNo.Mdt_id, iId, runNo, objReferRfq.Idc_issue_year, objReferRfq.Idc_issue_month, objDocNo.Doc_cur_no_po2, objReferRfq.Idc_customer_type, objReferRfq.Idc_customer_name, objReferRfq.Idc_plant_cd, objReferRfq.Mds_id, objReferRfq.Idc_subject_note, objReferRfq.Mde_id, objReferRfq.Idc_enclosures_note, objReferRfq.Idc_project_life, objReferRfq.Idc_project_start, strIssueDate, objReferRfq.Idc_closing_date, replyDate, objReferRfq.Idc_result_confirm, 1, strNote1, strNote2, strFilePath, strPhysicalPath, strCancelReason, objData.CreateDate, objData.CreateBy, objData.CreateDate, objData.CreateBy)

		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
			return
		}

		objLastId, err := objResult.LastInsertId()
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
			return
		}

		// 	// Insert Part No
		var sql string = "INSERT INTO info_document_item (idc_id, idi_item_no, idi_item_name, idi_model, idi_order_no, idi_status, idi_remark, idi_created_date, idi_created_by, idi_updated_date, idi_updated_by) VALUES "
		values := []string{}

		for index, partCurrent := range objReferRfq.IrGroupPart {
			partNo := partCurrent.Idi_item_no
			partName := partCurrent.Idi_item_name
			model := partCurrent.Idi_model
			remark := partCurrent.Idi_remark
			orderNo := index + 1

			if partNo == "" {
				partNo = "NULL"
			} else {
				partNo = fmt.Sprintf("'%s'", partNo)
			}

			if partName == "" {
				partName = "NULL"
			} else {
				partName = fmt.Sprintf("'%s'", partName)
			}

			if model == "" {
				model = "NULL"
			} else {
				model = fmt.Sprintf("'%s'", model)
			}

			if remark == "" {
				remark = "NULL"
			} else {
				remark = fmt.Sprintf("'%s'", remark)
			}

			value := fmt.Sprintf("(%d, %s, %s, %s, %d, %d, %s, '%s', '%s', '%s', '%s')",
				objLastId,
				partNo,
				partName,
				model,
				orderNo,
				1,
				remark,
				objData.CreateDate,
				objData.CreateBy,
				objData.CreateDate,
				objData.CreateBy)
			values = append(values, value)
		}

		if len(values) == 0 {
			c.IndentedJSON(http.StatusBadRequest, gin.H{"error": "ไม่มีข้อมูลที่สามารถบันทึกได้"})
			return
		}

		sql += strings.Join(values, ",")
		_, errPartItem := db.Exec(sql)

		if errPartItem != nil {
			c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": errPartItem.Error()})
			return
		}

		_, errUpdateSeq := db.Exec("UPDATE mst_document_control_no SET mdcn_position2 = ? WHERE mdt_id = ?", objDocNo.Doc_cur_no_po2, objDocNo.Mdt_id)
		if errUpdateSeq != nil {
			c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": errUpdateSeq.Error()})
			return
		}
	}

	_, err = db.Exec("UPDATE info_document_control SET idc_status = 2 WHERE idc_id = ?", iId)
	if err != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{
			"Error": err.Error(),
		})
		return
	}

	_, err = db.Exec("UPDATE info_document_control SET idc_status = 2 WHERE idc_id = ?", iId)
	if err != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{
			"Error": err.Error(),
		})
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
	var objRfq Rfq
	var groupPartCountOld []int
	var groupVolumeCountOld []int

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

		newPartGroupCount := len(objRfq.IrGroupPart)

		if len(groupPartCountOld) == newPartGroupCount {
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
				}
			}
		} else {
			// 	//////////////////////////////////// New Group Part //////////////////////////////////------------
			_, err := db.Exec("UPDATE info_document_item SET idi_status = 0 WHERE idc_id = ?", objRfq.Idc_id)
			if err != nil {
				c.JSON(http.StatusInternalServerError, gin.H{"Error": "Failed to update old parts status"})
				return
			}

			var zeroIdParts []RfqGroupPart
			var nonZeroIdParts []RfqGroupPart
			var orderItem int

			for _, item := range objRfq.IrGroupPart {
				if item.Idi_id == 0 {
					zeroIdParts = append(zeroIdParts, item)
				} else {
					nonZeroIdParts = append(nonZeroIdParts, item)
				}
			}

			if len(nonZeroIdParts) > 0 {
				sqlUpdate := "UPDATE info_document_item SET idi_item_no = ?, idi_item_name = ?, idi_model = ?, idi_remark = ?, idi_order_no = ?, idi_status = ?, idi_updated_date = ?, idi_updated_by = ? WHERE idi_id = ?"

				for _, partCurrent := range nonZeroIdParts {
					orderItem++
					_, err := db.Exec(sqlUpdate, partCurrent.Idi_item_no, partCurrent.Idi_item_name, partCurrent.Idi_model, partCurrent.Idi_remark, orderItem, 1, objRfq.Idc_updated_date, objRfq.Idc_updated_by, partCurrent.Idi_id)

					if err != nil {
						c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
						return
					}
				}
			}

			if len(zeroIdParts) > 0 {
				sqlInsert := `INSERT INTO info_document_item (idc_id, idi_item_no, idi_item_name, idi_model, idi_order_no, idi_status, idi_remark, idi_created_date, idi_created_by, idi_updated_date, idi_updated_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)`

				for _, partCurrent := range zeroIdParts {
					orderItem++
					_, err := db.Exec(sqlInsert, objRfq.Idc_id, partCurrent.Idi_item_no, partCurrent.Idi_item_name, partCurrent.Idi_model, orderItem, 1, partCurrent.Idi_remark, objRfq.Idc_updated_date, objRfq.Idc_updated_by, objRfq.Idc_updated_date, objRfq.Idc_updated_by)

					if err != nil {
						c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
						return
					}
				}
			}
		}
		//////////////////////////////////// Group Volume //////////////////////////////////-------------
		rowsVolume, err := db.Query(
			"SELECT idv_id FROM info_document_volume WHERE idc_id = ? AND idv_status = 1", objRfq.Idc_id)
		if err != nil {
			c.JSON(http.StatusInternalServerError, gin.H{"error": "Database error"})
			return
		}
		defer rowsVolume.Close()

		for rowsVolume.Next() {
			var idv_id int
			if err := rowsVolume.Scan(&idv_id); err != nil {
				c.JSON(http.StatusInternalServerError, gin.H{"error": "Database error"})
				return
			}
			groupVolumeCountOld = append(groupVolumeCountOld, idv_id)
		}

		if err := rowsVolume.Err(); err != nil {
			c.JSON(http.StatusInternalServerError, gin.H{"error": "Database error"})
			return
		}

		if len(groupVolumeCountOld) == len(objRfq.IrGroupVolume) {
			for i, item := range objRfq.IrGroupVolume {
				_, err := db.Exec(
					"UPDATE info_document_volume SET idv_year = ?, idv_qty = ?, idv_updated_date = ?, idv_updated_by = ? WHERE idv_id = ?", item.Year, item.Volume, objRfq.Idc_updated_date, objRfq.Idc_updated_by, groupVolumeCountOld[i])
				if err != nil {
					c.JSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
					return
				}
			}
		} else {
			_, err := db.Exec("UPDATE info_document_volume SET idv_status = 0 WHERE idc_id = ?", objRfq.Idc_id)
			if err != nil {
				c.JSON(http.StatusInternalServerError, gin.H{"Error": "Failed to update old volume status"})
				return
			}

			sqlInsert := `INSERT INTO info_document_volume (idc_id, idv_year, idv_qty, idv_status, idv_created_date, idv_created_by, idv_updated_date, idv_updated_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?)`

			for _, partCurrent := range objRfq.IrGroupVolume {
				_, err := db.Exec(sqlInsert, objRfq.Idc_id, partCurrent.Year, partCurrent.Volume, 1, objRfq.Idc_updated_date, objRfq.Idc_updated_by, objRfq.Idc_updated_date, objRfq.Idc_updated_by)

				if err != nil {
					c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
					return
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
		//////////////////////////////////// Mdpu //////////////////////////////////-----------------------
		var currentMdpu []int
		var noCurrentMdpu []int

		rows, err = db.Query("SELECT mdpu_id FROM info_document_purchase_cost WHERE idc_id = ?", objRfq.Idc_id)
		if err != nil {
			c.JSON(http.StatusInternalServerError, gin.H{"error": "Database error"})
			return
		}
		defer rows.Close()

		for rows.Next() {
			var value int
			if err := rows.Scan(&value); err != nil {
				c.JSON(http.StatusInternalServerError, gin.H{"error": "Database error"})
				return
			}
			currentMdpu = append(currentMdpu, value)
		}

		for _, item := range objRfq.Idpu_item {
			num, err := strconv.Atoi(item)
			if err != nil {
				c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
				return
			}
			noCurrentMdpu = append(noCurrentMdpu, num)
		}

		currentMdpuMap := make(map[int]bool)
		for _, id := range currentMdpu {
			currentMdpuMap[id] = true
		}

		_, err = db.Exec("UPDATE info_document_purchase_cost SET idpu_status = 0 WHERE idc_id = ?", objRfq.Idc_id)
		if err != nil {
			c.JSON(http.StatusInternalServerError, gin.H{"Error": "Failed to update old volume status"})
			return
		}

		updateMdpuSQL := "UPDATE info_document_purchase_cost SET idpu_status = 1, idpu_updated_date = ?, idpu_updated_by = ? WHERE idc_id = ? AND mdpu_id = ?"
		insertMdpuSQL := "INSERT INTO info_document_purchase_cost (idc_id, mdpu_id, idpu_created_date, idpu_created_by, idpu_updated_date, idpu_updated_by, idpu_status) VALUES (?, ?, ?, ?, ?, ?, 1)"

		for _, id := range noCurrentMdpu {
			if currentMdpuMap[id] {
				_, err := db.Exec(updateMdpuSQL, objRfq.Idc_updated_date, objRfq.Idc_updated_by, objRfq.Idc_id, id)
				if err != nil {
					c.JSON(http.StatusInternalServerError, gin.H{"error": "Error updating record", "id": id})
					return
				}
			} else {
				_, err := db.Exec(insertMdpuSQL, objRfq.Idc_id, id, objRfq.Idc_updated_date, objRfq.Idc_updated_by, objRfq.Idc_updated_date, objRfq.Idc_updated_by)
				if err != nil {
					c.JSON(http.StatusInternalServerError, gin.H{"error": "Error inserting record", "id": id})
					return
				}
			}
		}
		//////////////////////////////////// Mdpc //////////////////////////////////-----------------------
		var currentMdpc []int
		var noCurrentMdpc []int

		rows, err = db.Query("SELECT mdpc_id FROM info_document_process_cost WHERE idc_id = ?", objRfq.Idc_id)
		if err != nil {
			c.JSON(http.StatusInternalServerError, gin.H{"error": "Database error"})
			return
		}
		defer rows.Close()

		for rows.Next() {
			var value int
			if err := rows.Scan(&value); err != nil {
				c.JSON(http.StatusInternalServerError, gin.H{"error": "Database error"})
				return
			}
			currentMdpc = append(currentMdpc, value)
		}

		for _, item := range objRfq.Idpc_item {
			num, err := strconv.Atoi(item)
			if err != nil {
				c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
				return
			}
			noCurrentMdpc = append(noCurrentMdpc, num)
		}

		currentMdpcMap := make(map[int]bool)
		for _, id := range currentMdpc {
			currentMdpcMap[id] = true
		}

		_, err = db.Exec("UPDATE info_document_process_cost SET idpc_status = 0 WHERE idc_id = ?", objRfq.Idc_id)
		if err != nil {
			c.JSON(http.StatusInternalServerError, gin.H{"Error": "Failed to update old volume status"})
			return
		}

		updateMdpcSQL := "UPDATE info_document_process_cost SET idpc_status = 1, idpc_updated_date = ?, idpc_updated_by = ? WHERE idc_id = ? AND mdpc_id = ?"
		insertMdpcSQL := "INSERT INTO info_document_process_cost (idc_id, mdpc_id, idpc_created_date, idpc_created_by, idpc_updated_date, idpc_updated_by, idpc_status) VALUES (?, ?, ?, ?, ?, ?, 1)"

		for _, id := range noCurrentMdpc {
			if currentMdpcMap[id] {
				_, err := db.Exec(updateMdpcSQL, objRfq.Idc_updated_date, objRfq.Idc_updated_by, objRfq.Idc_id, id)
				if err != nil {
					c.JSON(http.StatusInternalServerError, gin.H{"error": "Error updating record", "id": id})
					return
				}
			} else {
				_, err := db.Exec(insertMdpcSQL, objRfq.Idc_id, id, objRfq.Idc_updated_date, objRfq.Idc_updated_by, objRfq.Idc_updated_date, objRfq.Idc_updated_by)
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
