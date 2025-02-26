package API

import (
	"database/sql"
	"fmt"
	"net/http"
	"strconv"
	"strings"

	"github.com/gin-gonic/gin"
)

func ListNbcTable(c *gin.Context) {
	var objNbcList []NbcTable
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

	objListNbc, err := db.Query("SELECT idc.*, su.su_firstname, su.su_lastname, su.su_sign_path, su.su_sign_file, (SELECT CASE WHEN COUNT(*) > 0 THEN 'true' ELSE 'false' END FROM info_document_control idc_sub LEFT JOIN mst_document_type mdt ON mdt.mdt_id = idc_sub.mdt_id WHERE mdt.mdt_name LIKE '%NBC%' AND idc_sub.idc_refer_doc = idc.idc_id) AS btnNBC, (SELECT CASE WHEN run_no.mdt_id != 3 THEN 'null' ELSE COALESCE(run_no.idc_running_no, 'null') END FROM info_document_control run_no WHERE run_no.idc_id = idc.idc_refer_doc) AS run_no FROM info_document_control AS idc LEFT JOIN sys_users AS su ON idc.idc_updated_by = su.su_username WHERE idc.mdt_id = ? AND idc.idc_created_date BETWEEN ? AND ? ORDER BY idc.idc_id", mdtID, c.Param("stratDate")+" 00:00:00", c.Param("endDate")+" 23:59:59")
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}

	defer objListNbc.Close()
	for objListNbc.Next() {
		var objNbc NbcTable
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
		var strRunNo sql.NullString

		err := objListNbc.Scan(&objNbc.Idc_id, &objNbc.Mdt_id, &strReferDoc, &objNbc.Idc_running_no, &objNbc.Idc_issue_year, &objNbc.Idc_issue_month, &objNbc.Idc_issue_seq_no, &objNbc.Idc_customer_type, &objNbc.Idc_customer_name, &objNbc.Idc_plant_cd, &objNbc.Mds_id, &strSubjectNote, &objNbc.Mde_id, &strEnclosuresNote, &objNbc.Idc_project_life, &objNbc.Idc_project_start, &strIssueDate, &objNbc.Idc_closing_date, &strReplyDate, &objNbc.Idc_result_confirm, &objNbc.Idc_status, &strNote1, &strNote2, &strFilePath, &strPhysicalPath, &strCancelReason, &objNbc.Idc_created_date, &objNbc.Idc_created_by, &objNbc.Idc_updated_date, &objNbc.Idc_updated_by, &strFirstName, &strLastName, &strSignPath, &strSignFile, &objNbc.Btn_nbc, &strRunNo)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}

		if strReferDoc.Valid {
			objNbc.Idc_refer_doc = int(strReferDoc.Int64)
		}
		if strSubjectNote.Valid {
			objNbc.Idc_subject_note = strSubjectNote.String
		}
		if strEnclosuresNote.Valid {
			objNbc.Idc_enclosures_note = strEnclosuresNote.String
		}
		if strIssueDate.Valid {
			objNbc.Idc_issue_date = strIssueDate.String
		}
		if strReplyDate.Valid {
			objNbc.Idc_reply_date = strReplyDate.String
		}
		if strNote1.Valid {
			objNbc.Idc_note1 = strNote1.String
		}
		if strNote2.Valid {
			objNbc.Idc_note2 = strNote2.String
		}
		if strFilePath.Valid {
			objNbc.Idc_file_path = strFilePath.String
		}
		if strPhysicalPath.Valid {
			objNbc.Idc_physical_path = strPhysicalPath.String
		}
		if strCancelReason.Valid {
			objNbc.Idc_cancel_reason = strCancelReason.String
		}
		if strFirstName.Valid {
			objNbc.Su_firstname = strFirstName.String
		}
		if strLastName.Valid {
			objNbc.Su_lastname = strLastName.String
		}
		if strSignPath.Valid {
			objNbc.Su_sign_path = strSignPath.String
		}
		if strSignFile.Valid {
			objNbc.Su_sign_file = strSignFile.String
		}
		if strRunNo.Valid {
			objNbc.Run_no = strRunNo.String
		}
		objNbcList = append(objNbcList, objNbc)
	}

	err = objListNbc.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}

	var objData NbcData
	objData.Data = objNbcList
	c.IndentedJSON(http.StatusOK, objData)
}
func GetNBC(c *gin.Context) {
	var objNbcList []NbcTable

	objListNbc, err := db.Query("SELECT idc.*, su.su_firstname, su.su_lastname, su.su_sign_path, su.su_sign_file, (SELECT CASE WHEN COUNT(*) > 0 THEN 'true' ELSE 'false' END FROM info_document_control idc_sub LEFT JOIN mst_document_type mdt ON mdt.mdt_id = idc_sub.mdt_id WHERE mdt.mdt_name LIKE '%NBC%' AND idc_sub.idc_refer_doc = idc.idc_id) AS btnNBC, (SELECT CASE WHEN run_no.mdt_id != 3 THEN 'null' ELSE COALESCE(run_no.idc_running_no, 'null') END FROM info_document_control run_no WHERE run_no.idc_id = idc.idc_refer_doc) AS run_no FROM info_document_control AS idc LEFT JOIN sys_users AS su ON idc.idc_updated_by = su.su_username WHERE idc.idc_id = ?", c.Param("id"))
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}

	defer objListNbc.Close()
	for objListNbc.Next() {
		var objNbc NbcTable
		var strReferDoc sql.NullInt64
		var strPlant sql.NullInt64
		var strMde sql.NullInt64
		var strProlife sql.NullInt64
		var strProstart sql.NullString
		var strCloseingDate sql.NullString
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
		var strRunNo sql.NullString

		err := objListNbc.Scan(&objNbc.Idc_id, &objNbc.Mdt_id, &strReferDoc, &objNbc.Idc_running_no, &objNbc.Idc_issue_year, &objNbc.Idc_issue_month, &objNbc.Idc_issue_seq_no, &objNbc.Idc_customer_type, &objNbc.Idc_customer_name, &strPlant, &objNbc.Mds_id, &strSubjectNote, &strMde, &strEnclosuresNote, &strProlife, &strProstart, &strIssueDate, &strCloseingDate, &strReplyDate, &objNbc.Idc_result_confirm, &objNbc.Idc_status, &strNote1, &strNote2, &strFilePath, &strPhysicalPath, &strCancelReason, &objNbc.Idc_created_date, &objNbc.Idc_created_by, &objNbc.Idc_updated_date, &objNbc.Idc_updated_by, &strFirstName, &strLastName, &strSignPath, &strSignFile, &objNbc.Btn_nbc, &strRunNo)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
			return
		}

		if strReferDoc.Valid {
			objNbc.Idc_refer_doc = int(strReferDoc.Int64)
		}
		if strPlant.Valid {
			objNbc.Idc_plant_cd = int(strPlant.Int64)
		}
		if strMde.Valid {
			objNbc.Mde_id = int(strMde.Int64)
		}
		if strProlife.Valid {
			objNbc.Idc_project_life = int(strProlife.Int64)
		}
		if strProstart.Valid {
			objNbc.Idc_project_start = strProstart.String
		}
		if strSubjectNote.Valid {
			objNbc.Idc_subject_note = strSubjectNote.String
		}
		if strEnclosuresNote.Valid {
			objNbc.Idc_enclosures_note = strEnclosuresNote.String
		}
		if strIssueDate.Valid {
			objNbc.Idc_issue_date = strIssueDate.String
		}
		if strCloseingDate.Valid {
			objNbc.Idc_closing_date = strCloseingDate.String
		}
		if strReplyDate.Valid {
			objNbc.Idc_reply_date = strReplyDate.String
		}
		if strNote1.Valid {
			objNbc.Idc_note1 = strNote1.String
		}
		if strNote2.Valid {
			objNbc.Idc_note2 = strNote2.String
		}
		if strFilePath.Valid {
			objNbc.Idc_file_path = strFilePath.String
		}
		if strPhysicalPath.Valid {
			objNbc.Idc_physical_path = strPhysicalPath.String
		}
		if strCancelReason.Valid {
			objNbc.Idc_cancel_reason = strCancelReason.String
		}
		if strFirstName.Valid {
			objNbc.Su_firstname = strFirstName.String
		}
		if strLastName.Valid {
			objNbc.Su_lastname = strLastName.String
		}
		if strSignPath.Valid {
			objNbc.Su_sign_path = strSignPath.String
		}
		if strSignFile.Valid {
			objNbc.Su_sign_file = strSignFile.String
		}
		if strRunNo.Valid {
			objNbc.Run_no = strRunNo.String
		}
		objNbcList = append(objNbcList, objNbc)
	}

	err = objListNbc.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}

	var objData NbcData
	objData.Data = objNbcList
	c.IndentedJSON(http.StatusOK, objData)
}
func GetDocByRunNo(c *gin.Context) {
	var objDocNo GetRfq
	var strReferDoc sql.NullInt64
	var strPlant sql.NullInt64
	var strMde sql.NullInt64
	var strSubjectNote sql.NullString
	var strEnclosuresNote sql.NullString
	var strProLife sql.NullInt64
	var strProstart sql.NullString
	var strIssueDate sql.NullString
	var strCloseDate sql.NullString
	var strReplyDate sql.NullString
	var strNote1 sql.NullString
	var strNote2 sql.NullString
	var strFilePath sql.NullString
	var strPhysicalPath sql.NullString
	var strCancelReason sql.NullString

	query := "SELECT * FROM info_document_control WHERE idc_running_no = ?"
	err := db.QueryRow(query, c.Param("id")).Scan(&objDocNo.Idc_id, &objDocNo.Mdt_id, &strReferDoc, &objDocNo.Idc_running_no, &objDocNo.Idc_issue_year, &objDocNo.Idc_issue_month, &objDocNo.Idc_issue_seq_no, &objDocNo.Idc_customer_type, &objDocNo.Idc_customer_name, &strPlant, &objDocNo.Mds_id, &strSubjectNote, &strMde, &strEnclosuresNote, &strProLife, &strProstart, &strIssueDate, &strCloseDate, &strReplyDate, &objDocNo.Idc_result_confirm, &objDocNo.Idc_status, &strNote1, &strNote2, &strFilePath, &strPhysicalPath, &strCancelReason, &objDocNo.Idc_created_date, &objDocNo.Idc_created_by, &objDocNo.Idc_updated_date, &objDocNo.Idc_updated_by)
	if err == sql.ErrNoRows {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}

	if strReferDoc.Valid {
		objDocNo.Idc_refer_doc = int(strReferDoc.Int64)
	}
	if strPlant.Valid {
		objDocNo.Idc_plant_cd = int(strPlant.Int64)
	}
	if strSubjectNote.Valid {
		objDocNo.Idc_subject_note = strSubjectNote.String
	}
	if strMde.Valid {
		objDocNo.Mde_id = int(strMde.Int64)
	}
	if strProLife.Valid {
		objDocNo.Idc_project_life = int(strProLife.Int64)
	}
	if strProstart.Valid {
		objDocNo.Idc_project_start = strProstart.String
	}
	if strEnclosuresNote.Valid {
		objDocNo.Idc_enclosures_note = strEnclosuresNote.String
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

	rowsAttn, err := db.Query("SELECT mda_id FROM `info_document_attn` WHERE idc_id = ? AND idat_status = 1 ORDER BY idat_id", objDocNo.Idc_id)
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

	rowsIdpu, err := db.Query("SELECT mdpu_id FROM `info_document_purchase_cost` WHERE idc_id = ? AND idpu_status = 1 ORDER BY idpu_id", objDocNo.Idc_id)
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

	rowsIdpc, err := db.Query("SELECT mdpc_id FROM `info_document_process_cost` WHERE idc_id = ? AND idpc_status = 1 ORDER BY idpc_id", objDocNo.Idc_id)
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

	rowsItem, err := db.Query("SELECT idi_id, idi_item_no, idi_item_name, idi_model, idi_remark FROM `info_document_item` WHERE idc_id = ? AND idi_status = 1 ORDER BY idi_id", objDocNo.Idc_id)
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

	rowsVolume, err := db.Query("SELECT idv_id, idv_year, idv_qty FROM `info_document_volume` WHERE idc_id = ? AND idv_status = 1 ORDER BY idv_id", objDocNo.Idc_id)
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
func EditNbc(c *gin.Context) {
	type UpdateNbc struct {
		Idc_id            int    `json:"idc_id"`
		Idc_note2         string `json:"idc_note2"`
		Idc_file_path     string `json:"idc_file_path"`
		Idc_physical_path string `json:"idc_physical_path"`
		Idc_updated_date  string `json:"idc_updated_date"`
		Idc_updated_by    string `json:"idc_updated_by"`
	}
	var objNbc UpdateNbc
	var strNote2 sql.NullString
	var strFilePath sql.NullString
	var strPhysicalPath sql.NullString

	if err := c.BindJSON(&objNbc); err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}

	strNote2 = sql.NullString{
		String: objNbc.Idc_note2,
		Valid:  objNbc.Idc_note2 != "",
	}
	strFilePath = sql.NullString{
		String: objNbc.Idc_file_path,
		Valid:  objNbc.Idc_file_path != "",
	}
	strPhysicalPath = sql.NullString{
		String: objNbc.Idc_physical_path,
		Valid:  objNbc.Idc_physical_path != "",
	}

	objResult, err := db.Exec("UPDATE info_document_control SET idc_note2 = ?, idc_file_path = ?, idc_physical_path = ?, idc_updated_date = ?, idc_updated_by = ? WHERE idc_id = ?", strNote2, strFilePath, strPhysicalPath, objNbc.Idc_updated_date, objNbc.Idc_updated_by, objNbc.Idc_id)
	if err != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{
			"Error": err.Error(),
		})
		return
	}

	c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})
}

func SubmitNbc(c *gin.Context) {
	iId := c.Param("id")
	type InputData struct {
		Idc_created_date string `json:"idc_created_date"`
		Idc_created_by   string `json:"idc_created_by"`
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

	query := ` SELECT mdt.mdt_position1, swd.swg_id, swd.su_id, swd.sat_id FROM mst_document_type mdt LEFT JOIN info_document_control idc ON idc.mdt_id = mdt.mdt_id LEFT JOIN mst_approve_pattern map ON map.map_id = mdt.map_id LEFT JOIN mst_approve_pattern_detail mapd ON map.map_id = mapd.map_id LEFT JOIN sys_approve_type sat ON sat.sat_id = mapd.sat_id LEFT JOIN sys_workflow_detail swd ON sat.sat_id = swd.sat_id LEFT JOIN sys_users su ON su.su_id = swd.su_id WHERE mdt.mdt_id = ( SELECT mdt_id FROM info_document_control WHERE idc_id = ? ) AND swd.swg_id = ( SELECT swg_id FROM sys_workflow_group swg LEFT JOIN sys_department sd ON sd.sd_id = swg.sd_id WHERE swg.sd_id = 19 ) AND swd.swd_status = 1 GROUP BY swd.su_id ORDER BY mapd.mapd_seq_no `

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
				objData.Idc_created_date,
				objData.Idc_created_by,
				objData.Idc_created_date,
				objData.Idc_created_by,
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
		_, err = db.Exec("INSERT INTO sys_notification_ctrl(snc_type, ida_id, snc_show_users, snc_read_status, snc_created_date, snc_updated_date) VALUES(?, ?, ?, ?, ?, ?)", 1, objNotiActive.Ida_id, strShowUsers, 0, objData.Idc_created_date, objData.Idc_created_date)

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

	_, err = db.Exec("UPDATE info_document_control SET idc_status = 2, idc_updated_date = ?, idc_updated_by = ? WHERE idc_id = ?", objData.Idc_created_date, objData.Idc_created_by, iId)
	if err != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
		return
	}

	errMail := SendMail(c, objReferRfq.Idc_id, idaCurrent, objEmail.Su_firstname, objEmail.Su_email, "waiting")
	if errMail != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": errMail.Error()})
		return
	}

	c.IndentedJSON(http.StatusOK, gin.H{"Update": objData})
}
