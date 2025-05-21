package API

import (
	"database/sql"
	"fmt"
	"net/http"
	"strconv"
	"strings"

	"github.com/gin-gonic/gin"
)

// Feasibility Management ---------------------------
func ListManageFeasibilityTable(c *gin.Context) {
	var objFeasibilityList []ManageFeasibilityTable
	iId := c.Param("id")
	objListFeas, err := db.Query("SELECT ifcp.*, inf.if_customer, inf.if_duedate, sd.sd_id, su.su_fname, su.su_lname, su.su_img_path, su.su_img_name FROM "+
		"`info_feasibility_consern_point` AS ifcp "+
		"LEFT JOIN info_feasibility AS inf ON ifcp.if_id = inf.if_id "+
		"LEFT JOIN mst_consideration AS mc ON ifcp.mc_id = mc.mc_id "+
		"LEFT JOIN mst_consideration_incharge AS mci ON mci.mc_id = mc.mc_id "+
		"LEFT JOIN sys_department AS sd ON mci.sd_id = sd.sd_id "+
		"LEFT JOIN sys_user AS su ON ifcp.update_by = su.su_emp_code "+
		"WHERE ifcp.ifcp_submit = 0 AND inf.if_status = 1 AND sd.sd_id = ? GROUP BY ifcp.if_id ORDER BY ifcp.ifcp_id ASC", iId)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListFeas.Close()
	for objListFeas.Next() {
		var objFeasibility ManageFeasibilityTable
		var strUserFname sql.NullString
		var strUserLname sql.NullString
		var strUserImgPath sql.NullString
		var strUserImgName sql.NullString
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString
		var fScore sql.NullFloat64
		var strComment sql.NullString
		var strFile_name sql.NullString
		var strFile_path sql.NullString
		err := objListFeas.Scan(&objFeasibility.Ifcp_id, &objFeasibility.If_id, &objFeasibility.Mc_id, &fScore, &strComment, &strFile_name, &strFile_path, &objFeasibility.Ifcp_submit, &objFeasibility.Ifcp_status, &strCreateDate, &strUpdateDate, &strCreateBy, &strUpdateBy, &objFeasibility.If_customer, &objFeasibility.If_duedate, &objFeasibility.Sd_id, &strUserFname, &strUserLname, &strUserImgPath, &strUserImgName)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		if strUserFname.Valid {
			objFeasibility.Su_fname = strUserFname.String
		}
		if strUserLname.Valid {
			objFeasibility.Su_lname = strUserLname.String
		}
		if strUserImgPath.Valid {
			objFeasibility.Su_img_path = strUserImgPath.String
		}
		if strUserImgName.Valid {
			objFeasibility.Su_img_name = strUserImgName.String
		}
		if strCreateDate.Valid {
			objFeasibility.Create_date = strCreateDate.String
		}
		if strUpdateDate.Valid {
			objFeasibility.Update_date = strUpdateDate.String
		}
		if strCreateBy.Valid {
			objFeasibility.Create_by = strCreateBy.String
		}
		if strUpdateBy.Valid {
			objFeasibility.Update_by = strUpdateBy.String
		}
		if fScore.Valid {
			objFeasibility.Ifcp_score = fScore.Float64
		}
		if strComment.Valid {
			objFeasibility.Ifcp_comment = strComment.String
		}
		if strFile_name.Valid {
			objFeasibility.Ifcp_file_name = strFile_name.String
		}
		if strFile_path.Valid {
			objFeasibility.Ifcp_file_path = strFile_path.String
		}
		objFeasibilityList = append(objFeasibilityList, objFeasibility)
	}
	err = objListFeas.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}

	var objData ManageFeasibilityData
	objData.Data = objFeasibilityList
	c.IndentedJSON(http.StatusOK, objData)
}

func ListConsiderationScoreByid(c *gin.Context) {
	var objConsiderationList []ManageConsernTable
	If_id := c.Param("if_id")
	Sd_id := c.Param("sd_id")
	objListCons, err := db.Query("SELECT ifcp.ifcp_id, ifcp.if_id, ifcp.mc_id, mc.mc_title, mc.mc_weight, ifcp.ifcp_score, ifcp.ifcp_comment, ifcp.ifcp_file_name, ifcp.ifcp_file_path, ifcp.ifcp_submit, ifcp.ifcp_status, ifcp.update_date, ifcp.update_by FROM info_feasibility_consern_point ifcp LEFT JOIN info_feasibility inf ON ifcp.if_id = inf.if_id LEFT JOIN mst_consideration_incharge mci ON mci.mc_id = ifcp.mc_id LEFT JOIN sys_department sd ON sd.sd_id = mci.sd_id LEFT JOIN mst_consideration mc ON mc.mc_id = ifcp.mc_id WHERE ifcp.if_id = ? AND mci.sd_id = ? AND ifcp.ifcp_submit = 0 AND ifcp.ifcp_status = 1", If_id, Sd_id)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListCons.Close()
	for objListCons.Next() {
		var objConsideration ManageConsernTable
		var strUpdateDate sql.NullString
		var strUpdateBy sql.NullString
		var strComment sql.NullString
		var strFile_name sql.NullString
		var strFile_path sql.NullString
		err := objListCons.Scan(&objConsideration.Ifcp_id, &objConsideration.If_id, &objConsideration.Mc_id, &objConsideration.Mc_title,
			&objConsideration.Mc_weight, &objConsideration.Ifcp_score, &strComment, &strFile_name, &strFile_path, &objConsideration.Ifcp_submit, &objConsideration.Ifcp_status, &strUpdateDate, &strUpdateBy)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}

		if strUpdateDate.Valid {
			objConsideration.Update_date = strUpdateDate.String
		}
		if strUpdateBy.Valid {
			objConsideration.Update_by = strUpdateBy.String
		}
		if strComment.Valid {
			objConsideration.Ifcp_comment = strComment.String
		}
		if strFile_name.Valid {
			objConsideration.Ifcp_file_name = strFile_name.String
		}
		if strFile_path.Valid {
			objConsideration.Ifcp_file_path = strFile_path.String
		}
		objConsiderationList = append(objConsiderationList, objConsideration)
	}
	err = objListCons.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}

	var objData ManageConsernData
	objData.Data = objConsiderationList
	c.IndentedJSON(http.StatusOK, objData)
}

func UpdateFeasibilityScore(c *gin.Context) {
	var objFeasibility ManageFeasibility
	if err := c.BindJSON(&objFeasibility); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	objResult, err := db.Exec("Update info_feasibility_consern_point SET ifcp_score = ?, update_date = ?, update_by = ? WHERE if_id = ? AND mc_id = ?", objFeasibility.Ifcp_score, objFeasibility.Update_date, objFeasibility.Update_by, objFeasibility.If_id, objFeasibility.Mc_id)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})
}
func UpdateFeasibilityComment(c *gin.Context) {
	var objFeasibility ManageFeasibility
	if err := c.BindJSON(&objFeasibility); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	objResult, err := db.Exec("Update info_feasibility_consern_point SET ifcp_comment = ?, update_date = ?, update_by = ? WHERE if_id = ? AND mc_id = ?", objFeasibility.Ifcp_comment, objFeasibility.Update_date, objFeasibility.Update_by, objFeasibility.If_id, objFeasibility.Mc_id)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})
}
func UpdateFeasibilityFile(c *gin.Context) {
	var objFeasibility ManageFeasibility
	if err := c.BindJSON(&objFeasibility); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	objResult, err := db.Exec("Update info_feasibility_consern_point SET ifcp_file_name = ?,ifcp_file_path = ?, update_date = ?, update_by = ? WHERE if_id = ? AND mc_id = ?", objFeasibility.Ifcp_file_name, objFeasibility.Ifcp_file_path, objFeasibility.Update_date, objFeasibility.Update_by, objFeasibility.If_id, objFeasibility.Mc_id)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})
}
func UpdateFeasibilitySubmit(c *gin.Context) {
	var objFeasibility ManageFeasibilityTable
	if err := c.BindJSON(&objFeasibility); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	objResult, err := db.Exec("UPDATE info_feasibility_consern_point SET ifcp_submit = ?, update_date = ?, update_by = ? WHERE if_id = ? AND mc_id IN ( SELECT mc.mc_id FROM "+
		"`mst_consideration_incharge` AS mci "+
		"LEFT JOIN `mst_consideration` AS mc ON mci.mc_id = mc.mc_id "+
		"LEFT JOIN ( SELECT * FROM info_feasibility_consern_point WHERE if_id = ? ) AS ifcp ON mc.mc_id = ifcp.mc_id "+
		"WHERE mc.mc_status = 1 AND mci.mci_status = 1 AND mci.sd_id = ?)", objFeasibility.Ifcp_submit, objFeasibility.Update_date, objFeasibility.Update_by, objFeasibility.If_id, objFeasibility.If_id, objFeasibility.Sd_id)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})
}

// Feasibility ---------------------------
func ListFeasibilityTable(c *gin.Context) {
	var objFSList []NbcTable
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

	objListFS, err := db.Query("SELECT idc.*, su.su_firstname, su.su_lastname, su.su_sign_path, su.su_sign_file, (SELECT CASE WHEN COUNT(*) > 0 THEN 'true' ELSE 'false' END FROM info_document_control idc_sub LEFT JOIN mst_document_type mdt ON mdt.mdt_id = idc_sub.mdt_id WHERE mdt.mdt_name LIKE '%NBC%' AND idc_sub.idc_refer_doc = idc.idc_id) AS btnNBC, (SELECT CASE WHEN run_no.mdt_id != 3 THEN 'null' ELSE COALESCE(run_no.idc_running_no, 'null') END FROM info_document_control run_no WHERE run_no.idc_id = idc.idc_refer_doc) AS run_no FROM info_document_control AS idc LEFT JOIN sys_users AS su ON idc.idc_updated_by = su.su_username WHERE idc.mdt_id = ? AND idc.idc_created_date BETWEEN ? AND ? ORDER BY idc.idc_id", mdtID, c.Param("stratDate")+" 00:00:00", c.Param("endDate")+" 23:59:59")
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}

	defer objListFS.Close()
	for objListFS.Next() {
		var objFS NbcTable
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

		err := objListFS.Scan(&objFS.Idc_id, &objFS.Mdt_id, &strReferDoc, &objFS.Idc_running_no, &objFS.Idc_issue_year, &objFS.Idc_issue_month, &objFS.Idc_issue_seq_no, &objFS.Idc_customer_type, &objFS.Idc_customer_name, &strPlant, &objFS.Mds_id, &strSubjectNote, &strMde, &strEnclosuresNote, &strProlife, &strProstart, &strIssueDate, &strCloseingDate, &strReplyDate, &objFS.Idc_result_confirm, &objFS.Idc_status, &strNote1, &strNote2, &strFilePath, &strPhysicalPath, &strCancelReason, &objFS.Idc_created_date, &objFS.Idc_created_by, &objFS.Idc_updated_date, &objFS.Idc_updated_by, &strFirstName, &strLastName, &strSignPath, &strSignFile, &objFS.Btn_nbc, &strRunNo)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}

		if strReferDoc.Valid {
			objFS.Idc_refer_doc = int(strReferDoc.Int64)
		}
		if strPlant.Valid {
			objFS.Idc_plant_cd = int(strPlant.Int64)
		}
		if strMde.Valid {
			objFS.Mde_id = int(strMde.Int64)
		}
		if strProlife.Valid {
			objFS.Idc_project_life = int(strProlife.Int64)
		}
		if strProstart.Valid {
			objFS.Idc_project_start = strProstart.String
		}
		if strCloseingDate.Valid {
			objFS.Idc_closing_date = strCloseingDate.String
		}
		if strSubjectNote.Valid {
			objFS.Idc_subject_note = strSubjectNote.String
		}
		if strEnclosuresNote.Valid {
			objFS.Idc_enclosures_note = strEnclosuresNote.String
		}
		if strIssueDate.Valid {
			objFS.Idc_issue_date = strIssueDate.String
		}
		if strReplyDate.Valid {
			objFS.Idc_reply_date = strReplyDate.String
		}
		if strNote1.Valid {
			objFS.Idc_note1 = strNote1.String
		}
		if strNote2.Valid {
			objFS.Idc_note2 = strNote2.String
		}
		if strFilePath.Valid {
			objFS.Idc_file_path = strFilePath.String
		}
		if strPhysicalPath.Valid {
			objFS.Idc_physical_path = strPhysicalPath.String
		}
		if strCancelReason.Valid {
			objFS.Idc_cancel_reason = strCancelReason.String
		}
		if strFirstName.Valid {
			objFS.Su_firstname = strFirstName.String
		}
		if strLastName.Valid {
			objFS.Su_lastname = strLastName.String
		}
		if strSignPath.Valid {
			objFS.Su_sign_path = strSignPath.String
		}
		if strSignFile.Valid {
			objFS.Su_sign_file = strSignFile.String
		}
		if strRunNo.Valid {
			objFS.Run_no = strRunNo.String
		}
		objFSList = append(objFSList, objFS)
	}

	err = objListFS.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}

	var objData NbcData
	objData.Data = objFSList
	c.IndentedJSON(http.StatusOK, objData)
}
func ListFeasibilityItem(c *gin.Context) {
	var objFSList []FeasibilityItem

	objListFS, err := db.Query("SELECT ifs.ifs_id, ifs.mcip_id, mci.mci_name, mcip.mcip_weight, ifs.ifs_score, ifs.ifs_total, ifs.ifs_comment, sd.sd_dept_aname, ifs.ifs_status, mcip.sd_id FROM info_feasibility_score ifs LEFT JOIN mst_consideration_item_pic mcip ON ifs.mcip_id = mcip.mcip_id LEFT JOIN mst_consideration_item mci ON mci.mci_id = mcip.mci_id LEFT JOIN sys_department sd ON sd.sd_id = mcip.sd_id WHERE ifs.idc_id = " + c.Param("id") + " ORDER BY ifs.ifs_id ASC")
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}

	defer objListFS.Close()
	for objListFS.Next() {
		var objFS FeasibilityItem
		var strScore sql.NullString
		var strTotal sql.NullString
		var strComment sql.NullString

		err := objListFS.Scan(&objFS.Ifs_id, &objFS.Mcip_id, &objFS.Mci_name, &objFS.Mcip_weight, &strScore, &strTotal, &strComment, &objFS.Sd_dept_aname, &objFS.Ifs_status, &objFS.Sd_id)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}

		if strScore.Valid {
			objFS.Ifs_score = strScore.String
		}
		if strTotal.Valid {
			objFS.Ifs_total = strTotal.String
		}
		if strComment.Valid {
			objFS.Ifs_comment = strComment.String
		}
		objFSList = append(objFSList, objFS)
	}

	err = objListFS.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}

	c.IndentedJSON(http.StatusOK, objFSList)
}

func ListFeasibility(c *gin.Context) {
	var objFS NbcTable
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

	query := "SELECT idc.*, su.su_firstname, su.su_lastname, su.su_sign_path, su.su_sign_file, (SELECT CASE WHEN COUNT(*) > 0 THEN 'true' ELSE 'false' END FROM info_document_control idc_sub LEFT JOIN mst_document_type mdt ON mdt.mdt_id = idc_sub.mdt_id WHERE mdt.mdt_name LIKE '%NBC%' AND idc_sub.idc_refer_doc = idc.idc_id) AS btnNBC, (SELECT CASE WHEN run_no.mdt_id != 3 THEN 'null' ELSE COALESCE(run_no.idc_running_no, 'null') END FROM info_document_control run_no WHERE run_no.idc_id = idc.idc_refer_doc) AS run_no FROM info_document_control AS idc LEFT JOIN sys_users AS su ON idc.idc_updated_by = su.su_username WHERE idc.idc_id = ?"
	err := db.QueryRow(query, c.Param("id")).Scan(&objFS.Idc_id, &objFS.Mdt_id, &strReferDoc, &objFS.Idc_running_no, &objFS.Idc_issue_year, &objFS.Idc_issue_month, &objFS.Idc_issue_seq_no, &objFS.Idc_customer_type, &objFS.Idc_customer_name, &strPlant, &objFS.Mds_id, &strSubjectNote, &strMde, &strEnclosuresNote, &strProlife, &strProstart, &strIssueDate, &strCloseingDate, &strReplyDate, &objFS.Idc_result_confirm, &objFS.Idc_status, &strNote1, &strNote2, &strFilePath, &strPhysicalPath, &strCancelReason, &objFS.Idc_created_date, &objFS.Idc_created_by, &objFS.Idc_updated_date, &objFS.Idc_updated_by, &strFirstName, &strLastName, &strSignPath, &strSignFile, &objFS.Btn_nbc, &strRunNo)
	if err == sql.ErrNoRows {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}

	if strReferDoc.Valid {
		objFS.Idc_refer_doc = int(strReferDoc.Int64)
	}
	if strPlant.Valid {
		objFS.Idc_plant_cd = int(strPlant.Int64)
	}
	if strMde.Valid {
		objFS.Mde_id = int(strMde.Int64)
	}
	if strProlife.Valid {
		objFS.Idc_project_life = int(strProlife.Int64)
	}
	if strProstart.Valid {
		objFS.Idc_project_start = strProstart.String
	}
	if strCloseingDate.Valid {
		objFS.Idc_closing_date = strCloseingDate.String
	}
	if strSubjectNote.Valid {
		objFS.Idc_subject_note = strSubjectNote.String
	}
	if strEnclosuresNote.Valid {
		objFS.Idc_enclosures_note = strEnclosuresNote.String
	}
	if strIssueDate.Valid {
		objFS.Idc_issue_date = strIssueDate.String
	}
	if strReplyDate.Valid {
		objFS.Idc_reply_date = strReplyDate.String
	}
	if strNote1.Valid {
		objFS.Idc_note1 = strNote1.String
	}
	if strNote2.Valid {
		objFS.Idc_note2 = strNote2.String
	}
	if strFilePath.Valid {
		objFS.Idc_file_path = strFilePath.String
	}
	if strPhysicalPath.Valid {
		objFS.Idc_physical_path = strPhysicalPath.String
	}
	if strCancelReason.Valid {
		objFS.Idc_cancel_reason = strCancelReason.String
	}
	if strFirstName.Valid {
		objFS.Su_firstname = strFirstName.String
	}
	if strLastName.Valid {
		objFS.Su_lastname = strLastName.String
	}
	if strSignPath.Valid {
		objFS.Su_sign_path = strSignPath.String
	}
	if strSignFile.Valid {
		objFS.Su_sign_file = strSignFile.String
	}
	if strRunNo.Valid {
		objFS.Run_no = strRunNo.String
	}

	c.IndentedJSON(http.StatusOK, objFS)
}

func FeasibilityLastid(c *gin.Context) {
	var objLastId GetLastID
	err := db.QueryRow("SELECT COUNT(if_id) AS last_id FROM info_feasibility").Scan(&objLastId.Last_id)
	if err == sql.ErrNoRows {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, objLastId)
}

func FeasibilityTotalScore(c *gin.Context) {
	type ojbScoreDetail struct {
		Mcip_weight string  `json:"mcip_weight"`
		Ifs_score   float64 `json:"ifs_score"`
		Ifs_total   float64 `json:"ifs_total"`
	}
	var sumTotalScore float64

	rows, err := db.Query("SELECT MIN(mcip.mcip_weight) AS mcip_weight, COALESCE( ROUND(AVG(ifs.ifs_total / (mcip.mcip_weight * 5)) * 5, 2), 0) AS ifs_score, COALESCE(ROUND((AVG(ifs.ifs_total / (mcip.mcip_weight * 5)) * 5 * MIN(mcip.mcip_weight)),2),0) AS ifs_total FROM info_feasibility_score ifs LEFT JOIN mst_consideration_item_pic mcip ON ifs.mcip_id = mcip.mcip_id LEFT JOIN mst_consideration_item mci ON mci.mci_id = mcip.mci_id LEFT JOIN sys_department sd ON sd.sd_id = mcip.sd_id WHERE ifs.idc_id = ? GROUP BY mci.mci_name ORDER BY MIN(ifs.ifs_id) ASC", c.Param("id"))

	if err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": "Database query error"})
		return
	}

	for rows.Next() {
		var ojbScore ojbScoreDetail
		err := rows.Scan(&ojbScore.Mcip_weight, &ojbScore.Ifs_score, &ojbScore.Ifs_total)
		if err != nil {
			c.JSON(http.StatusInternalServerError, gin.H{"error": "Database scan error"})
			return
		}
		sumTotalScore += ojbScore.Ifs_total
	}

	if err = rows.Err(); err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": "Database error"})
		return
	}

	c.IndentedJSON(http.StatusOK, sumTotalScore)
}

func InsertFeasibility(c *gin.Context) {
	var objFs FeasibilityInsert
	var mcipID []int
	if err := c.BindJSON(&objFs); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}

	var strSubjectNote sql.NullString
	var strReferDoc sql.NullInt64

	if objFs.Idc_refer_doc == 0 {
		strReferDoc = sql.NullInt64{Int64: 0, Valid: false}
	} else {
		strReferDoc = sql.NullInt64{Int64: int64(objFs.Idc_refer_doc), Valid: true}
	}

	strSubjectNote = sql.NullString{
		String: objFs.Idc_subject_note,
		Valid:  objFs.Idc_subject_note != "",
	}

	objResult, err := db.Exec("INSERT INTO info_document_control (mdt_id, idc_refer_doc, idc_running_no, idc_issue_year, idc_issue_month, idc_issue_seq_no, idc_customer_type, idc_customer_name, mds_id, idc_subject_note, idc_result_confirm, idc_status, idc_created_date, idc_created_by, idc_updated_date, idc_updated_by) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", &objFs.Mdt_id, &strReferDoc, &objFs.Idc_running_no, &objFs.Idc_issue_year, &objFs.Idc_issue_month, &objFs.Idc_issue_seq_no, &objFs.Idc_customer_type, &objFs.Idc_customer_name, &objFs.Mds_id, &strSubjectNote, &objFs.Idc_result_confirm, &objFs.Idc_status, &objFs.Idc_created_date, &objFs.Idc_created_by, &objFs.Idc_created_date, &objFs.Idc_created_by)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}

	_, errUpdateSeq := db.Exec("UPDATE mst_document_control_no SET mdcn_position2 = ? WHERE mdt_id = ?", objFs.Idc_issue_seq_no, objFs.Mdt_id)
	if errUpdateSeq != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": errUpdateSeq.Error()})
		return
	}

	objLastId, err := objResult.LastInsertId()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}

	var sql string = "INSERT INTO info_document_item (idc_id, idi_item_no, idi_item_name, idi_model, idi_order_no, idi_status, idi_remark, idi_created_date, idi_created_by, idi_updated_date, idi_updated_by) VALUES "
	values := []string{}

	for index, partCurrent := range objFs.IrGroupPart {
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
			objFs.Idc_created_date,
			objFs.Idc_created_by,
			objFs.Idc_created_date,
			objFs.Idc_created_by)
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
	} else {
		rows, err := db.Query(
			"SELECT mcip_id FROM mst_consideration_item_pic WHERE mcip_status = 1")
		if err != nil {
			c.JSON(http.StatusInternalServerError, gin.H{"error": "Database error"})
			return
		}
		defer rows.Close()

		for rows.Next() {
			var mcip_id int
			if err := rows.Scan(&mcip_id); err != nil {
				c.JSON(http.StatusInternalServerError, gin.H{"error": "Database error"})
				return
			}
			mcipID = append(mcipID, mcip_id)
		}

		if err := rows.Err(); err != nil {
			c.JSON(http.StatusInternalServerError, gin.H{"error": "Database error"})
			return
		}

		var sql string = "INSERT INTO info_feasibility_score (idc_id, mcip_id, ifs_created_date, ifs_created_by, ifs_updated_date, ifs_updated_by) VALUES "
		values := []string{}

		for _, id := range mcipID {

			value := fmt.Sprintf("(%d, %d, '%s', '%s', '%s', '%s')",
				objLastId,
				id,
				objFs.Idc_created_date,
				objFs.Idc_created_by,
				objFs.Idc_created_date,
				objFs.Idc_created_by)
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
	}

	c.IndentedJSON(http.StatusOK, objLastId)
}
func UpdateFeasibility(c *gin.Context) {
	var objFs FeasibilityInsert
	var groupPartCountOld []int
	if err := c.BindJSON(&objFs); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}

	objResult, err := db.Exec("Update info_document_control SET idc_customer_type = ?, idc_customer_name = ?, mds_id = ?, idc_subject_note = ?, idc_updated_date = ?, idc_updated_by = ? WHERE idc_id = ?", objFs.Idc_customer_type, objFs.Idc_customer_name, objFs.Mds_id, objFs.Idc_subject_note, objFs.Idc_updated_date, objFs.Idc_updated_by, objFs.Idc_id)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	} else {
		rows, err := db.Query(
			"SELECT idi_id FROM info_document_item WHERE idc_id = ? AND idi_status = 1", objFs.Idc_id)
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

		newPartGroupCount := len(objFs.IrGroupPart)
		if len(groupPartCountOld) == newPartGroupCount {
			//////////////////////////////////// Old Group Part //////////////////////////////////-------------
			for i, part := range objFs.IrGroupPart {
				var remark sql.NullString
				if part.Idi_remark == "" {
					remark = sql.NullString{String: "", Valid: false}
				} else {
					remark = sql.NullString{String: part.Idi_remark, Valid: true}
				}

				_, err := db.Exec(
					"UPDATE info_document_item SET idi_item_no = ?, idi_item_name = ?, idi_model = ?, idi_remark = ?, idi_updated_date = ?, idi_updated_by = ? WHERE idi_id = ?",
					part.Idi_item_no, part.Idi_item_name, part.Idi_model, remark, objFs.Idc_updated_date, objFs.Idc_updated_by, groupPartCountOld[i],
				)
				if err != nil {
					c.JSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
					return
				}
			}
		} else {
			// 	//////////////////////////////////// New Group Part //////////////////////////////////------------
			_, err := db.Exec("UPDATE info_document_item SET idi_status = 0 WHERE idc_id = ?", objFs.Idc_id)
			if err != nil {
				c.JSON(http.StatusInternalServerError, gin.H{"Error": "Failed to update old parts status"})
				return
			}

			var zeroIdParts []RfqGroupPart
			var nonZeroIdParts []RfqGroupPart
			var orderItem int

			for _, item := range objFs.IrGroupPart {
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
					_, err := db.Exec(sqlUpdate, partCurrent.Idi_item_no, partCurrent.Idi_item_name, partCurrent.Idi_model, partCurrent.Idi_remark, orderItem, 1, objFs.Idc_updated_date, objFs.Idc_updated_by, partCurrent.Idi_id)

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
					_, err := db.Exec(sqlInsert, objFs.Idc_id, partCurrent.Idi_item_no, partCurrent.Idi_item_name, partCurrent.Idi_model, orderItem, 1, partCurrent.Idi_remark, objFs.Idc_updated_date, objFs.Idc_updated_by, objFs.Idc_updated_date, objFs.Idc_updated_by)

					if err != nil {
						c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
						return
					}
				}
			}
		}
	}

	c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})
}
func ChangeFeasibilityStatus(c *gin.Context) {
	var objFeasibility Feasibility
	if err := c.BindJSON(&objFeasibility); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	objResult, err := db.Exec("Update info_feasibility SET if_status = ? WHERE if_id = ?", objFeasibility.If_status, objFeasibility.If_id)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})
}

// Feasibility History --------------------------
func ListFeasibilityTableHistory(c *gin.Context) {
	var objFeasibilityList []FeasibilityHistory
	objListFeasibility, err := db.Query("SELECT inf.if_id, inf.if_ref, inf.create_date, inf.if_customer, mrt.mrt_name, su.su_fname, su.su_lname, su.su_img_path, su.su_img_name, SUM(ifcp.ifcp_score) AS Score FROM info_feasibility AS inf LEFT JOIN sys_user AS su ON inf.update_by = su.su_emp_code LEFT JOIN mst_requirement_type AS mrt ON mrt.mrt_id = inf.mrt_id LEFT JOIN info_feasibility_consern_point AS ifcp ON inf.if_id = ifcp.if_id GROUP BY inf.if_id, inf.if_ref, inf.create_date, inf.if_customer, mrt.mrt_name, su.su_fname, su.su_lname, su.su_img_path, su.su_img_name ORDER BY inf.if_id")
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListFeasibility.Close()
	for objListFeasibility.Next() {
		var objFeasibility FeasibilityHistory
		var strUserFname sql.NullString
		var strUserLname sql.NullString
		var strUserImgPath sql.NullString
		var strUserImgName sql.NullString
		var intScore sql.NullString
		err := objListFeasibility.Scan(&objFeasibility.If_id, &objFeasibility.If_ref, &objFeasibility.If_created_date, &objFeasibility.If_customer, &objFeasibility.Mrt_name, &strUserFname, &strUserLname, &strUserImgPath, &strUserImgName, &intScore)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		if strUserFname.Valid {
			objFeasibility.Su_fname = strUserFname.String
		}
		if strUserLname.Valid {
			objFeasibility.Su_lname = strUserLname.String
		}
		if strUserImgPath.Valid {
			objFeasibility.Su_img_path = strUserImgPath.String
		}
		if strUserImgName.Valid {
			objFeasibility.Su_img_name = strUserImgName.String
		}
		if intScore.Valid {
			objFeasibility.If_score = intScore.String
		}

		objFeasibilityList = append(objFeasibilityList, objFeasibility)
	}
	err = objListFeasibility.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}

	var objData FeasibilityDataHistory
	objData.Data = objFeasibilityList
	c.IndentedJSON(http.StatusOK, objData)
}

func ListFeasibilityTableHistoryDate(c *gin.Context) {
	var objFeasibilityList []FeasibilityHistory
	date := c.Param("date")
	objListFeasibility, err := db.Query("SELECT inf.if_id, inf.if_ref, inf.create_date, inf.if_customer, mrt.mrt_name, su.su_fname, su.su_lname, su.su_img_path, su.su_img_name, SUM(ifcp.ifcp_score) AS Score FROM info_feasibility AS inf LEFT JOIN sys_user AS su ON inf.update_by = su.su_emp_code LEFT JOIN mst_requirement_type AS mrt ON mrt.mrt_id = inf.mrt_id LEFT JOIN info_feasibility_consern_point AS ifcp ON inf.if_id = ifcp.if_id WHERE DATE(inf.create_date) = ? GROUP BY inf.if_id, inf.if_ref, inf.create_date, inf.if_customer, mrt.mrt_name, su.su_fname, su.su_lname, su.su_img_path, su.su_img_name ORDER BY inf.if_id", date)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListFeasibility.Close()
	for objListFeasibility.Next() {
		var objFeasibility FeasibilityHistory
		var strUserFname sql.NullString
		var strUserLname sql.NullString
		var strUserImgPath sql.NullString
		var strUserImgName sql.NullString
		var intScore sql.NullString
		err := objListFeasibility.Scan(&objFeasibility.If_id, &objFeasibility.If_ref, &objFeasibility.If_created_date, &objFeasibility.If_customer, &objFeasibility.Mrt_name, &strUserFname, &strUserLname, &strUserImgPath, &strUserImgName, &intScore)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		if strUserFname.Valid {
			objFeasibility.Su_fname = strUserFname.String
		}
		if strUserLname.Valid {
			objFeasibility.Su_lname = strUserLname.String
		}
		if strUserImgPath.Valid {
			objFeasibility.Su_img_path = strUserImgPath.String
		}
		if strUserImgName.Valid {
			objFeasibility.Su_img_name = strUserImgName.String
		}
		if intScore.Valid {
			objFeasibility.If_score = intScore.String
		}

		objFeasibilityList = append(objFeasibilityList, objFeasibility)
	}
	err = objListFeasibility.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}

	var objData FeasibilityDataHistory
	objData.Data = objFeasibilityList
	c.IndentedJSON(http.StatusOK, objData)
}

func SaveScore(c *gin.Context) {
	type Score struct {
		Idc_id           int    `json:"idc_id"`
		Ifs_id           int    `json:"ifs_id"`
		Mcip_weight      string `json:"mcip_weight"`
		Ifs_score        string `json:"ifs_score"`
		Ifs_comment      string `json:"ifs_comment"`
		Ifs_Updated_date string `json:"ifs_updated_date"`
		Ifs_Updated_by   string `json:"ifs_updated_by"`
	}
	var objScore Score
	if err := c.BindJSON(&objScore); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}

	mcipWeight, err := strconv.ParseFloat(objScore.Mcip_weight, 64)
	if err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": "Invalid mcip_weight value"})
		return
	}

	ifsScore, err := strconv.Atoi(objScore.Ifs_score)
	if err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": "Invalid ifs_score value"})
		return
	}

	ifsTotal := int(mcipWeight*float64(ifsScore)*10000) / 10000

	objResult, err := db.Exec("UPDATE info_feasibility_score SET ifs_score = ?, ifs_comment = ?, ifs_total = ?, ifs_status = 1, ifs_updated_date = ?, ifs_updated_by = ? WHERE ifs_id = ?", objScore.Ifs_score, objScore.Ifs_comment, ifsTotal, objScore.Ifs_Updated_date, objScore.Ifs_Updated_by, objScore.Ifs_id)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}

	var idcStautus int
	err = db.QueryRow("SELECT idc_status FROM info_document_control WHERE idc_id = ?", objScore.Idc_id).Scan(&idcStautus)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}

	if idcStautus == 1 {
		_, err = db.Exec("UPDATE info_document_control SET idc_status = 2, idc_updated_date = ?, idc_updated_by = ? WHERE idc_id = ?", objScore.Ifs_Updated_date, objScore.Ifs_Updated_by, objScore.Idc_id)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
			return
		}
	}

	c.IndentedJSON(http.StatusOK, objResult)
}
func SubmitFeasibility(c *gin.Context) {
	iId := c.Param("id")
	type InputData struct {
		Idc_created_date string `json:"idc_created_date"`
		Idc_created_by   string `json:"idc_created_by"`
	}
	type DocAppData struct {
		Sd_id    int
		Deptname string
		SwgId    int
		UserID   int
		SatID    int
	}
	var objData InputData
	if err := c.BindJSON(&objData); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}

	var objReferRfq GetRfq
	// var idaCurrent int

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
		c.IndentedJSON(http.StatusOK, gin.H{"Error1": err.Error()})
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

	query := `SELECT sd.sd_id, sd.sd_dept_aname, swd.swg_id, swd.su_id, swd.sat_id FROM sys_workflow_detail swd LEFT JOIN sys_workflow_group swg ON swd.swg_id = swg.swg_id LEFT JOIN sys_department sd ON sd.sd_id = swg.sd_id WHERE swg.sd_id IN (31, 41, 19, 22, 16, 20, 15, 47) AND swd.sat_id = (SELECT MAX(swd_inner.sat_id) FROM sys_workflow_detail swd_inner LEFT JOIN sys_workflow_group swg_inner ON swd_inner.swg_id = swg_inner.swg_id LEFT JOIN sys_department sd_inner ON sd_inner.sd_id = swg_inner.sd_id WHERE sd_inner.sd_dept_aname = sd.sd_dept_aname) AND swd.swd_status = 1 ORDER BY swd.swg_id`

	rows, err := db.Query(query)
	if err != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"error": "Failed to execute query"})
		return
	}
	defer rows.Close()

	var results []DocAppData
	for rows.Next() {
		var data DocAppData
		if err := rows.Scan(&data.Sd_id, &data.Deptname, &data.SwgId, &data.UserID, &data.SatID); err != nil {
			c.IndentedJSON(http.StatusInternalServerError, gin.H{"error": "Failed to scan row data"})
			return
		}
		results = append(results, data)
	}
	if err := rows.Err(); err != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"error": "Error occurred while reading rows"})
		return
	} else {
		_, err = db.Exec("UPDATE info_feasibility_score SET ifs_status = 2, ifs_updated_date = ?, ifs_updated_by = ? WHERE idc_id = ?", objData.Idc_created_date, objData.Idc_created_by, iId)

		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{"Error2": err.Error()})
			return
		}

		convertedId, err := strconv.Atoi(iId)
		if err != nil {
			c.IndentedJSON(http.StatusBadRequest, gin.H{"error": "Invalid ID, must be an integer"})
			return
		}

		// Get Considereration by id
		type objCons struct {
			Ifs_id  int
			Mcip_id int
			Sd_id   int
		}
		queryGetCons := `SELECT ifs.ifs_id, ifs.mcip_id, mcip.sd_id FROM info_feasibility_score ifs LEFT JOIN mst_consideration_item_pic mcip ON mcip.mcip_id = ifs.mcip_id WHERE ifs.idc_id = ?`

		rowsCons, err := db.Query(queryGetCons, convertedId)
		if err != nil {
			c.IndentedJSON(http.StatusInternalServerError, gin.H{"error": "Failed to execute query"})
			return
		}
		defer rowsCons.Close()

		var resultsCons []objCons
		for rowsCons.Next() {
			var dataCons objCons
			if err := rowsCons.Scan(&dataCons.Ifs_id, &dataCons.Mcip_id, &dataCons.Sd_id); err != nil {
				c.IndentedJSON(http.StatusInternalServerError, gin.H{"error": "Failed to scan row data"})
				return
			}
			resultsCons = append(resultsCons, dataCons)
		}
		if err := rowsCons.Err(); err != nil {
			c.IndentedJSON(http.StatusInternalServerError, gin.H{"error": "Error occurred while reading rows"})
			return
		}

		// Insert Approval
		var sqlIda string = "INSERT INTO info_document_approval (swg_id, su_id, sat_id, ida_seq_no, idc_id, ifs_id, ida_created_date, ida_created_by, ida_updated_date, ida_updated_by) VALUES "
		objListIda := []string{}
		countSeqNo := 1
		usedApp := make(map[int]bool)
		for _, consItem := range resultsCons {
			for _, appItem := range results {
				if consItem.Sd_id == appItem.Sd_id {
					usedApp[appItem.Sd_id] = true
					objIda := fmt.Sprintf("(%d, %d, %d, %d, %d, %d, '%s', '%s', '%s', '%s')",
						appItem.SwgId,
						appItem.UserID,
						appItem.SatID,
						countSeqNo,
						convertedId,
						consItem.Ifs_id,
						objData.Idc_created_date,
						objData.Idc_created_by,
						objData.Idc_created_date,
						objData.Idc_created_by,
					)
					objListIda = append(objListIda, objIda)
					countSeqNo++
				}
			}
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

		type UnusedDept struct {
			Sd_id  int
			SwgId  int
			UserID int
			SatID  int
		}

		unusedApp := []UnusedDept{}
		for _, appItem := range results {
			if !usedApp[appItem.Sd_id] {
				unusedApp = append(unusedApp, UnusedDept{
					Sd_id:  appItem.Sd_id,
					SwgId:  appItem.SwgId,
					UserID: appItem.UserID,
					SatID:  appItem.SatID,
				})
			}
		}

		objListIdaUnused := []string{}
		sqlIda = "INSERT INTO info_document_approval (swg_id, su_id, sat_id, ida_seq_no, idc_id, ida_created_date, ida_created_by, ida_updated_date, ida_updated_by) VALUES "
		for _, appItemUnused := range unusedApp {
			objIda := fmt.Sprintf("(%d, %d, %d, %d, %d, '%s', '%s', '%s', '%s')",
				appItemUnused.SwgId,
				appItemUnused.UserID,
				appItemUnused.SatID,
				countSeqNo,
				convertedId,
				objData.Idc_created_date,
				objData.Idc_created_by,
				objData.Idc_created_date,
				objData.Idc_created_by,
			)
			objListIdaUnused = append(objListIdaUnused, objIda)
			countSeqNo++
		}

		if len(objListIdaUnused) == 0 {
			c.IndentedJSON(http.StatusBadRequest, gin.H{"error": "ไม่มีข้อมูลที่สามารถบันทึกได้"})
			return
		}

		sqlIda += strings.Join(objListIdaUnused, ",")

		_, errIda = db.Exec(sqlIda)
		if errIda != nil {
			c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error4": errIda.Error()})
			return
		}
		type notiActive struct {
			Ida_id       int    `json:"ida_id"`
			Su_id        int    `json:"su_id"`
			Su_firstname string `json:"su_firstname"`
			Su_email     string `json:"su_email"`
		}
		strShowUsers := "You have a new document"
		query := `SELECT ida.ida_id, ida.su_id, CONCAT(su.su_firstname, ' ', su.su_lastname) AS su_firstname, su.su_email FROM info_document_approval ida LEFT JOIN sys_users su ON su.su_id = ida.su_id WHERE ida.idc_id = ? AND ida.ida_action = 0 GROUP BY su_id`

		rowsUserApp, err := db.Query(query, iId)
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
				objData.Idc_created_date,
				objData.Idc_created_date,
			)
			objListNoti = append(objListNoti, objIda)

			errMail := SendMail(c, objReferRfq.Idc_id, itemNoti.Ida_id, itemNoti.Su_firstname, itemNoti.Su_email, "waiting")
			if errMail != nil {
				c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error5": errMail.Error()})
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

	_, err = db.Exec("UPDATE info_document_control SET idc_status = 2, idc_updated_date = ?, idc_updated_by = ? WHERE idc_id = ?", objData.Idc_created_date, objData.Idc_created_by, iId)
	if err != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error6": err.Error()})
		return
	}

	c.IndentedJSON(http.StatusOK, gin.H{"Update": results})
}

func NewSubmitFeasibility(c *gin.Context) {
	iId := c.Param("id")
	type InputData struct {
		Idc_created_date string `json:"idc_created_date"`
		Idc_created_by   string `json:"idc_created_by"`
		Sd_id            int    `json:"sd_id"`
	}
	type DocAppData struct {
		Sd_id    int
		Deptname string
		SwgId    int
		UserID   int
		SatID    int
	}

	var objData InputData
	if err := c.BindJSON(&objData); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	var objReferRfq GetRfq
	// var idaCurrent int

	var strReferDoc sql.NullInt64
	var strSubjectNote sql.NullString
	var strEnclosuresNote sql.NullString
	var strProlife sql.NullString
	var strProstart sql.NullString
	var strIssueDate sql.NullString
	var strReplyDate sql.NullString
	var strNote1 sql.NullString
	var strNote2 sql.NullString
	var strFilePath sql.NullString
	var strPhysicalPath sql.NullString
	var strCancelReason sql.NullString

	queryGetRefer := "SELECT * FROM info_document_control WHERE idc_id = ?"
	err := db.QueryRow(queryGetRefer, iId).Scan(&objReferRfq.Idc_id, &objReferRfq.Mdt_id, &strReferDoc, &objReferRfq.Idc_running_no, &objReferRfq.Idc_issue_year, &objReferRfq.Idc_issue_month, &objReferRfq.Idc_issue_seq_no, &objReferRfq.Idc_customer_type, &objReferRfq.Idc_customer_name, &objReferRfq.Idc_plant_cd, &objReferRfq.Mds_id, &strSubjectNote, &objReferRfq.Mde_id, &strEnclosuresNote, &strProlife, &strProstart, &strIssueDate, &objReferRfq.Idc_closing_date, &strReplyDate, &objReferRfq.Idc_result_confirm, &objReferRfq.Idc_status, &strNote1, &strNote2, &strFilePath, &strPhysicalPath, &strCancelReason, &objReferRfq.Idc_created_date, &objReferRfq.Idc_created_by, &objReferRfq.Idc_updated_date, &objReferRfq.Idc_updated_by)
	if err == sql.ErrNoRows {
		c.IndentedJSON(http.StatusOK, gin.H{"Error1.1": err.Error()})
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
	if strProlife.Valid {
		objReferRfq.Idc_issue_date = strProlife.String
	}
	if strProstart.Valid {
		objReferRfq.Idc_issue_date = strProstart.String
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

	var results DocAppData
	query := `SELECT sd.sd_id, sd.sd_dept_aname, swd.swg_id, swd.su_id, swd.sat_id FROM sys_workflow_detail swd LEFT JOIN sys_workflow_group swg ON swd.swg_id = swg.swg_id LEFT JOIN sys_department sd ON sd.sd_id = swg.sd_id WHERE swg.sd_id = ? AND swd.sat_id = (SELECT MAX(swd_inner.sat_id) FROM sys_workflow_detail swd_inner LEFT JOIN sys_workflow_group swg_inner ON swd_inner.swg_id = swg_inner.swg_id LEFT JOIN sys_department sd_inner ON sd_inner.sd_id = swg_inner.sd_id WHERE sd_inner.sd_dept_aname = sd.sd_dept_aname) AND swd.swd_status = 1 ORDER BY swd.swg_id`

	err = db.QueryRow(query, objData.Sd_id).Scan(&results.Sd_id, &results.Deptname, &results.SwgId, &results.UserID, &results.SatID)
	if err != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"error": "Failed to execute query"})
		return
	} else {
		_, err = db.Exec("UPDATE info_feasibility_score AS ifs JOIN mst_consideration_item_pic AS mcip ON mcip.mcip_id = ifs.mcip_id JOIN sys_department AS sd ON sd.sd_id = mcip.sd_id SET ifs.ifs_status = 2, ifs.ifs_updated_date = ?, ifs.ifs_updated_by = ? WHERE ifs.idc_id = ? AND mcip.sd_id = ?", objData.Idc_created_date, objData.Idc_created_by, iId, objData.Sd_id)

		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{"Error1": err.Error()})
			return
		}

		convertedId, err := strconv.Atoi(iId)
		if err != nil {
			c.IndentedJSON(http.StatusBadRequest, gin.H{"error": "Invalid ID, must be an integer"})
			return
		}

		type objCons struct {
			Ifs_id  int
			Mcip_id int
			Sd_id   int
		}
		queryGetCons := `SELECT ifs.ifs_id, ifs.mcip_id, mcip.sd_id FROM info_feasibility_score ifs LEFT JOIN mst_consideration_item_pic mcip ON mcip.mcip_id = ifs.mcip_id LEFT JOIN sys_department sd ON sd.sd_id = mcip.sd_id WHERE ifs.idc_id = ? AND sd.sd_id = ?`

		rowsCons, err := db.Query(queryGetCons, convertedId, objData.Sd_id)
		if err != nil {
			c.IndentedJSON(http.StatusInternalServerError, gin.H{"error": "Failed to execute query"})
			return
		}
		defer rowsCons.Close()

		var resultsCons []objCons
		for rowsCons.Next() {
			var dataCons objCons
			if err := rowsCons.Scan(&dataCons.Ifs_id, &dataCons.Mcip_id, &dataCons.Sd_id); err != nil {
				c.IndentedJSON(http.StatusInternalServerError, gin.H{"error": "Failed to scan row data"})
				return
			}
			resultsCons = append(resultsCons, dataCons)
		}
		if err := rowsCons.Err(); err != nil {
			c.IndentedJSON(http.StatusInternalServerError, gin.H{"error": "Error occurred while reading rows"})
			return
		}

		var countSeqNo int
		err = db.QueryRow(`SELECT IFNULL(MAX(ida_seq_no), 0) + 1 AS count FROM info_document_approval WHERE idc_id = ?`, convertedId).Scan(&countSeqNo)
		if err != nil {
			c.IndentedJSON(http.StatusInternalServerError, gin.H{"error": "Failed to execute query"})
			return
		}

		var chkInfoIda int
		err = db.QueryRow(`SELECT CASE WHEN COUNT(su_id) > 0 THEN 1 ELSE 0 END AS info_ida FROM info_document_approval WHERE su_id = ? AND idc_id = ?`, results.UserID, convertedId).Scan(&chkInfoIda)
		if err != nil {
			c.IndentedJSON(http.StatusInternalServerError, gin.H{"error": "Failed to execute query"})
			return
		}

		if chkInfoIda == 1 {
			updateIdaBy := "UPDATE info_document_approval SET ida_status = 1, ida_action = 0, ida_route = 0, ida_reject_reason = ?, ida_updated_date = ?, ida_updated_by = ? WHERE idc_id = ? AND su_id = ?"
			_, err = db.Exec(updateIdaBy, "", objData.Idc_created_date, objData.Idc_created_by, convertedId, results.UserID)
			if err != nil {
				c.IndentedJSON(http.StatusOK, gin.H{"Error2": err.Error()})
				return
			}
		} else {
			// Insert Approval
			var sqlIda string = "INSERT INTO info_document_approval (swg_id, su_id, sat_id, ida_seq_no, idc_id, ifs_id, ida_created_date, ida_created_by, ida_updated_date, ida_updated_by) VALUES "
			objListIda := []string{}
			for _, consItem := range resultsCons {
				objIda := fmt.Sprintf("(%d, %d, %d, %d, %d, %d, '%s', '%s', '%s', '%s')",
					results.SwgId,
					results.UserID,
					results.SatID,
					countSeqNo,
					convertedId,
					consItem.Ifs_id,
					objData.Idc_created_date,
					objData.Idc_created_by,
					objData.Idc_created_date,
					objData.Idc_created_by,
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
				c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error3.3": errIda.Error()})
				return
			}
		}

		type notiActive struct {
			Ida_id       int    `json:"ida_id"`
			Su_id        int    `json:"su_id"`
			Su_firstname string `json:"su_firstname"`
			Su_email     string `json:"su_email"`
		}
		strShowUsers := "You have a new document"
		query := `SELECT ida.ida_id, ida.su_id, CONCAT(su.su_firstname, ' ', su.su_lastname) AS su_firstname, su.su_email FROM info_document_approval ida LEFT JOIN sys_users su ON su.su_id = ida.su_id WHERE ida.idc_id = ? AND ida.ida_action = 0 AND su.sd_id = ? GROUP BY su_id`

		rowsUserApp, err := db.Query(query, iId, objData.Sd_id)
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
				objData.Idc_created_date,
				objData.Idc_created_date,
			)
			objListNoti = append(objListNoti, objIda)

			errMail := SendMail(c, objReferRfq.Idc_id, itemNoti.Ida_id, itemNoti.Su_firstname, itemNoti.Su_email, "waiting")
			if errMail != nil {
				c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error4": errMail.Error()})
				return
			}
		}

		if len(objListNoti) == 0 {
			c.IndentedJSON(http.StatusBadRequest, gin.H{"error": "ไม่มีข้อมูลที่สามารถบันทึกได้2"})
			return
		}

		sqlNoti += strings.Join(objListNoti, ",")
		_, errNoti := db.Exec(sqlNoti)
		if errNoti != nil {
			c.IndentedJSON(http.StatusInternalServerError, gin.H{"errNoti": errNoti.Error()})
			return
		}
	}

	_, err = db.Exec("UPDATE info_document_control SET idc_status = 2, idc_updated_date = ?, idc_updated_by = ? WHERE idc_id = ?", objData.Idc_created_date, objData.Idc_created_by, iId)
	if err != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error5": err.Error()})
		return
	}

	c.IndentedJSON(http.StatusOK, gin.H{"Update": results})
}
