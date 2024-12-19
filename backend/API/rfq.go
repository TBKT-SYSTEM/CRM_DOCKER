package API

import (
	"database/sql"
	"fmt"
	"log"
	"net/http"
	"strconv"
	"strings"

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

func RfqDocNo(c *gin.Context) {
	var objDocNo GetDocNo
	query := "SELECT CONCAT( mdt.mdt_position1, '-', mdt.mdt_position2, CASE WHEN mdt.mdt_position3 IS NOT NULL AND mdt.mdt_position3 != '' THEN CONCAT('-', mdt.mdt_position3) ELSE '' END ) AS doc_type, CONCAT( mdcn.mdcn_position1, CASE WHEN mdcn.mdcn_position2 IS NOT NULL AND mdcn.mdcn_position2 != '' THEN CONCAT('-', mdcn.mdcn_position2) ELSE '' END, CASE WHEN mdcn.mdcn_position3 IS NOT NULL AND mdcn.mdcn_position3 != '' THEN CONCAT('-', mdcn.mdcn_position3) ELSE '' END ) AS doc_con_no, CONCAT( CONCAT( mdt.mdt_position1, '-', mdt.mdt_position2, CASE WHEN mdt.mdt_position3 IS NOT NULL AND mdt.mdt_position3 != '' THEN CONCAT('-', mdt.mdt_position3) ELSE '' END ), '-', CONCAT( mdcn.mdcn_position1, CASE WHEN mdcn.mdcn_position2 IS NOT NULL AND mdcn.mdcn_position2 != '' THEN CONCAT('-', mdcn.mdcn_position2) ELSE '' END, CASE WHEN mdcn.mdcn_position3 IS NOT NULL AND mdcn.mdcn_position3 != '' THEN CONCAT('-', mdcn.mdcn_position3) ELSE '' END ) ) AS doc_no FROM mst_document_type mdt LEFT JOIN mst_document_control_no mdcn ON mdcn.mdt_id = mdt.mdt_id WHERE mdt.mdt_id = ?"
	err := db.QueryRow(query, c.Param("id")).Scan(&objDocNo.Doc_type, &objDocNo.Doc_con_no, &objDocNo.Doc_no)
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

	var strRefFm sql.NullInt64
	var strRefNbc sql.NullInt64
	var strNote sql.NullString
	var strComment sql.NullString

	if strRefFm.Valid {
		objRfq.IrRefFm = int(strRefFm.Int64)
	}
	if strRefNbc.Valid {
		objRfq.IrRefNbc = int(strRefNbc.Int64)
	}

	strNote = sql.NullString{
		String: objRfq.IrNote,
		Valid:  objRfq.IrNote != "",
	}
	strComment = sql.NullString{
		String: objRfq.IrComment,
		Valid:  objRfq.IrComment != "",
	}

	objResult, err := db.Exec("INSERT INTO info_rfq (ir_doc_no, ir_customer, ir_import_tran, ir_mrt, ir_enclosures, ir_ref_fm, ir_ref_nbc, ir_pro_life, ir_pro_tim, ir_duedate, ir_note, ir_comment, ir_status, ir_created_date, ir_created_by, ir_updated_date, ir_updated_by) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", objRfq.IrDocNo, objRfq.IrCustomer, objRfq.IrImportTran, objRfq.IrMrt, objRfq.IrEnclosures, strRefFm, strRefNbc, objRfq.IrProLife, objRfq.IrProTim, objRfq.IrDueDate, strNote, strComment, objRfq.IrStatus, objRfq.IrCreatedDate, objRfq.IrCreatedBy, objRfq.IrCreatedDate, objRfq.IrCreatedBy)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}

	objLastId, err := objResult.LastInsertId()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	} else {
		var sql string = "INSERT INTO info_rfq_part_no (ir_id, irpn_part_no, irpn_part_name, irpn_model, irpn_remark, irpn_status, irpn_created_date, irpn_created_by, irpn_updated_date, irpn_updated_by) VALUES "
		values := []string{}

		for _, partCurrent := range objRfq.IrGroupPart {
			partNo := partCurrent.IrPartNo
			partName := partCurrent.IrPartName
			model := partCurrent.IrModel
			remark := partCurrent.IrRemark

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

			value := fmt.Sprintf("(%d, %s, %s, %s, %s, %d, '%s', '%s', '%s', '%s')",
				objLastId,
				partNo,
				partName,
				model,
				remark,
				1,
				objRfq.IrCreatedDate,
				objRfq.IrCreatedBy,
				objRfq.IrCreatedDate,
				objRfq.IrCreatedBy)
			values = append(values, value)
		}

		if len(values) == 0 {
			c.IndentedJSON(http.StatusBadRequest, gin.H{"error": "ไม่มีข้อมูลที่สามารถบันทึกได้"})
			return
		}

		sql += strings.Join(values, ",")
		_, err := db.Exec(sql)
		if err != nil {
			c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
			return
		} else {
			// Insert into info_rfq_checkbox

			var sql string = "INSERT INTO info_rfq_formcheck (ir_id, irfc_pu_dept, irfc_pe_dept, irfc_scm_dept, irfc_ce_dept, irfc_gdc_dept, irfc_raw_puc, irfc_mold_puc, irfc_menufac_puc, irfc_transport_puc, irfc_cast_poc, irfc_machin_poc, irfc_assembly_poc, irfc_pack_poc, irfc_status_flg, irfc_created_date, irfc_created_by, irfc_updated_date, irfc_updated_by) VALUES "
			values := []string{}

			for _, chkBoxCurrent := range objRfq.IrGroupCheckbox {
				value := fmt.Sprintf("(%d, %d, %d, %d, %d, %d, %d, %d, %d, %d, %d, %d, %d, %d, %d, '%s', '%s', '%s', '%s')",
					objLastId,
					chkBoxCurrent.IrPuDept,
					chkBoxCurrent.IrPeDept,
					chkBoxCurrent.IrScmDept,
					chkBoxCurrent.IrCeDept,
					chkBoxCurrent.IrGdcDept,
					chkBoxCurrent.IrRawPuc,
					chkBoxCurrent.IrMoldPuc,
					chkBoxCurrent.IrMenufacPuc,
					chkBoxCurrent.IrTransportPuc,
					chkBoxCurrent.IrCastPoc,
					chkBoxCurrent.IrMachinPoc,
					chkBoxCurrent.IrAssemblyPoc,
					chkBoxCurrent.IrPackPoc,
					1,
					objRfq.IrCreatedDate,
					objRfq.IrCreatedBy,
					objRfq.IrCreatedDate,
					objRfq.IrCreatedBy)

				values = append(values, value)
			}

			if len(values) == 0 {
				c.IndentedJSON(http.StatusBadRequest, gin.H{"error": "ไม่มีข้อมูลที่สามารถบันทึกได้"})
				return
			}

			// รวมคำสั่ง SQL ทั้งหมด
			sql += strings.Join(values, ",")

			log.Println(sql)

			// ส่งคำสั่ง SQL ไปยังฐานข้อมูล
			_, err := db.Exec(sql)
			if err != nil {
				c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
				return
			} else {
				// Insert into info_rfq_volume

				var sql string = "INSERT INTO info_rfq_volume (ir_id, irv_year, irv_volume, irv_status_flg, irv_created_date, irv_created_by, irv_updated_date, irv_updated_by) VALUES "
				values := []string{}

				for _, volumeCurrent := range objRfq.IrGroupVolume {
					value := fmt.Sprintf("(%d, '%s', '%s', %d, '%s', '%s', '%s', '%s')",
						objLastId,
						volumeCurrent.Year,
						volumeCurrent.Volume,
						1,
						objRfq.IrCreatedDate,
						objRfq.IrCreatedBy,
						objRfq.IrCreatedDate,
						objRfq.IrCreatedBy)

					values = append(values, value)
				}

				if len(values) == 0 {
					c.IndentedJSON(http.StatusBadRequest, gin.H{"error": "ไม่มีข้อมูลที่สามารถบันทึกได้"})
					return
				}

				// รวมคำสั่ง SQL ทั้งหมด
				sql += strings.Join(values, ",")

				log.Println(sql)

				// ส่งคำสั่ง SQL ไปยังฐานข้อมูล
				_, err := db.Exec(sql)
				if err != nil {
					c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
					return
				} else {
					c.IndentedJSON(http.StatusOK, gin.H{
						"insertRfqID":    objLastId,
						"insertPart":     len(objRfq.IrGroupPart),
						"insertCheckBox": len(objRfq.IrGroupCheckbox),
						"insertVolume":   len(objRfq.IrGroupVolume),
						"Error":          nil,
					})
				}
			}
		}
	}
}

func ListRfqTable(c *gin.Context) {
	var objRfqList []RfqTable
	objListRfq, err := db.Query("SELECT ir.*, su.su_firstname, su.su_lastname, su.su_sign_path, su.su_sign_file FROM `info_rfq` AS ir LEFT JOIN sys_users AS su ON ir.ir_updated_by = su.su_username ORDER BY ir.ir_id")
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListRfq.Close()
	for objListRfq.Next() {
		var objRfq RfqTable
		var strRefFm sql.NullInt64
		var strRefNbc sql.NullInt64
		var strNote sql.NullString
		var strComment sql.NullString
		var strUserFname sql.NullString
		var strUserLname sql.NullString
		var strUserSignPath sql.NullString
		var strUserSignFile sql.NullString
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString
		err := objListRfq.Scan(&objRfq.Ir_id, &objRfq.Ir_doc_no, &objRfq.Ir_customer, &objRfq.Ir_import_tran, &objRfq.Ir_mrt, &objRfq.Ir_enclosures, &strRefFm, &strRefNbc, &objRfq.Ir_pro_life, &objRfq.Ir_pro_tim, &objRfq.Ir_duedate, &strNote, &strComment, &objRfq.Ir_status, &strCreateDate, &strCreateBy, &strUpdateDate, &strUpdateBy, &strUserFname, &strUserLname, &strUserSignPath, &strUserSignFile)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		if strRefFm.Valid {
			objRfq.Ir_ref_fm = int(strRefFm.Int64)
		}
		if strRefNbc.Valid {
			objRfq.Ir_ref_nbc = int(strRefNbc.Int64)
		}
		if strNote.Valid {
			objRfq.Ir_note = strNote.String
		}
		if strComment.Valid {
			objRfq.Ir_comment = strComment.String
		}
		if strUserFname.Valid {
			objRfq.Su_firstname = strUserFname.String
		}
		if strUserLname.Valid {
			objRfq.Su_lastname = strUserLname.String
		}
		if strUserSignPath.Valid {
			objRfq.Su_sign_path = strUserSignPath.String
		}
		if strUserSignFile.Valid {
			objRfq.Su_sign_file = strUserSignFile.String
		}
		if strCreateDate.Valid {
			objRfq.Create_date = strCreateDate.String
		}
		if strUpdateDate.Valid {
			objRfq.Update_date = strUpdateDate.String
		}
		if strCreateBy.Valid {
			objRfq.Create_by = strCreateBy.String
		}
		if strUpdateBy.Valid {
			objRfq.Update_by = strUpdateBy.String
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

func ListRFQ(c *gin.Context) {
	var objRfq RfqTable
	iId := c.Param("id")
	var strRefFm sql.NullInt64
	var strRefNbc sql.NullInt64
	var strNote sql.NullString
	var strComment sql.NullString
	var strUserFname sql.NullString
	var strUserLname sql.NullString
	var strUserSignPath sql.NullString
	var strUserSignFile sql.NullString
	var strCreateDate sql.NullString
	var strUpdateDate sql.NullString
	var strCreateBy sql.NullString
	var strUpdateBy sql.NullString
	err := db.QueryRow("SELECT ir.*, su.su_firstname, su.su_lastname, su.su_sign_path, su.su_sign_file FROM `info_rfq` AS ir LEFT JOIN sys_users AS su ON ir.ir_updated_by = su.su_username WHERE ir.ir_id = ? ORDER BY ir.ir_id", iId).Scan(&objRfq.Ir_id, &objRfq.Ir_doc_no, &objRfq.Ir_customer, &objRfq.Ir_import_tran, &objRfq.Ir_mrt, &objRfq.Ir_enclosures, &strRefFm, &strRefNbc, &objRfq.Ir_pro_life, &objRfq.Ir_pro_tim, &objRfq.Ir_duedate, &strNote, &strComment, &objRfq.Ir_status, &strCreateDate, &strCreateBy, &strUpdateDate, &strUpdateBy, &strUserFname, &strUserLname, &strUserSignPath, &strUserSignFile)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}

	groupPart, err := db.Query("SELECT irpn_id, irpn_part_no, irpn_part_name, irpn_model, irpn_remark FROM info_rfq_part_no WHERE ir_id = ? AND irpn_status = 1 ORDER BY irpn_id", iId)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer groupPart.Close()

	for groupPart.Next() {
		var partGroup RfqGroupPart
		var remark sql.NullString

		err := groupPart.Scan(&partGroup.Irpn_id, &partGroup.IrPartNo, &partGroup.IrPartName, &partGroup.IrModel, &remark)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}

		remarkValue := ""
		if remark.Valid {
			remarkValue = remark.String
		}

		partGroup.IrRemark = remarkValue
		objRfq.IrGroupPart = append(objRfq.IrGroupPart, partGroup)
	}

	groupVolume, err := db.Query("SELECT irv_year, irv_volume FROM info_rfq_volume WHERE ir_id = ? AND irv_status_flg = 1 ORDER BY irv_id", iId)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer groupVolume.Close()

	for groupVolume.Next() {
		var volumeGroup RfqGroupVolume

		err := groupVolume.Scan(&volumeGroup.Year, &volumeGroup.Volume)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}

		objRfq.IrGroupVolume = append(objRfq.IrGroupVolume, volumeGroup)
	}

	var formChkGroup RfqGroupCheckbox

	queryFormChk := db.QueryRow(`SELECT irfc_pu_dept, irfc_pe_dept, irfc_scm_dept, irfc_ce_dept, irfc_gdc_dept, irfc_raw_puc, irfc_mold_puc, irfc_menufac_puc, irfc_transport_puc, irfc_cast_poc, irfc_machin_poc, irfc_assembly_poc, irfc_pack_poc FROM info_rfq_formcheck WHERE ir_id = ? AND irfc_status_flg = 1 ORDER BY irfc_id LIMIT 1`, iId).Scan(&formChkGroup.IrPuDept, &formChkGroup.IrPeDept, &formChkGroup.IrScmDept, &formChkGroup.IrCeDept, &formChkGroup.IrGdcDept, &formChkGroup.IrRawPuc, &formChkGroup.IrMoldPuc, &formChkGroup.IrMenufacPuc, &formChkGroup.IrTransportPuc, &formChkGroup.IrCastPoc, &formChkGroup.IrMachinPoc, &formChkGroup.IrAssemblyPoc, &formChkGroup.IrPackPoc)
	if queryFormChk != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": queryFormChk.Error(),
		})
		return
	}

	objRfq.IrGroupCheckbox = append(objRfq.IrGroupCheckbox, formChkGroup)

	if strRefFm.Valid {
		objRfq.Ir_ref_fm = int(strRefFm.Int64)
	}
	if strRefNbc.Valid {
		objRfq.Ir_ref_nbc = int(strRefNbc.Int64)
	}
	if strUserFname.Valid {
		objRfq.Su_firstname = strUserFname.String
	}
	if strUserLname.Valid {
		objRfq.Su_lastname = strUserLname.String
	}
	if strNote.Valid {
		objRfq.Ir_note = strNote.String
	}
	if strComment.Valid {
		objRfq.Ir_comment = strComment.String
	}
	if strUserSignPath.Valid {
		objRfq.Su_sign_path = strUserSignPath.String
	}
	if strUserSignFile.Valid {
		objRfq.Su_sign_file = strUserSignFile.String
	}
	if strCreateDate.Valid {
		objRfq.Create_date = strCreateDate.String
	}
	if strUpdateDate.Valid {
		objRfq.Update_date = strUpdateDate.String
	}
	if strCreateBy.Valid {
		objRfq.Create_by = strCreateBy.String
	}
	if strUpdateBy.Valid {
		objRfq.Update_by = strUpdateBy.String
	}
	c.IndentedJSON(http.StatusOK, objRfq)
}

func CancelRfq(c *gin.Context) {
	iId := c.Param("id")
	iReason := c.Param("reason")
	log.Println("iReason : ", iReason)

	objResult, err := db.Exec("UPDATE info_rfq SET ir_status = 0 WHERE ir_id = ?", iId)
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

	objResult, err := db.Exec("UPDATE info_rfq SET ir_status = 1 WHERE ir_id = ?", iId)
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

	objResult, err := db.Exec("UPDATE info_rfq SET ir_status = 9 WHERE ir_id = ?", iId)
	if err != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{
			"Error": err.Error(),
		})
		return
	}

	c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})
}

func ListRfqFileId(c *gin.Context) {
	// log.Println("List Part No By Id : ", c.Param("id"))
	var objFileList []GetRfqFileById
	objListFile, err := db.Query("SELECT sfu_id, sfu_file_name, sfu_file_path FROM `sys_files_upload` WHERE sfu_doc_no = ?", c.Param("id"))
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListFile.Close()
	for objListFile.Next() {
		var objListRfq GetRfqFileById
		err := objListFile.Scan(&objListRfq.Sfu_id, &objListRfq.Sfu_file_name, &objListRfq.Sfu_file_path)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		objFileList = append(objFileList, objListRfq)
	}
	err = objListFile.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}

	var objData GetRfqFileByIdData
	objData.Data = objFileList
	c.IndentedJSON(http.StatusOK, objData)
}

func EditRfq(c *gin.Context) {
	var objRfq Rfq
	var groupPartCountOld []int
	var groupVolumeCountOld []int

	if err := c.BindJSON(&objRfq); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}

	var strRefFm sql.NullInt64
	var strRefNbc sql.NullInt64
	var strNote sql.NullString
	var strComment sql.NullString

	if strRefFm.Valid {
		objRfq.IrRefFm = int(strRefFm.Int64)
	}
	if strRefNbc.Valid {
		objRfq.IrRefNbc = int(strRefNbc.Int64)
	}

	strNote = sql.NullString{
		String: objRfq.IrNote,
		Valid:  objRfq.IrNote != "",
	}
	strComment = sql.NullString{
		String: objRfq.IrComment,
		Valid:  objRfq.IrComment != "",
	}

	_, err := db.Exec("UPDATE info_rfq SET ir_customer = ?, ir_import_tran = ?, ir_mrt = ?, ir_enclosures = ?, ir_ref_fm = ?, ir_ref_nbc = ?, ir_pro_life = ?, ir_pro_tim = ?, ir_duedate = ?, ir_note = ?, ir_comment = ?, ir_updated_date = ?, ir_updated_by = ? WHERE ir_id = ?", objRfq.IrCustomer, objRfq.IrImportTran, objRfq.IrMrt, objRfq.IrEnclosures, strRefFm, strRefNbc, objRfq.IrProLife, objRfq.IrProTim, objRfq.IrDueDate, strNote, strComment, objRfq.IrCreatedDate, objRfq.IrCreatedBy, objRfq.IrId)
	if err != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
		return
	} else {
		//////////////////////////////////// Group Part //////////////////////////////////

		rows, err := db.Query("SELECT irpn_id FROM info_rfq_part_no WHERE ir_id = ? AND irpn_status = 1 ORDER BY irpn_id", objRfq.IrId)
		if err != nil {
			c.JSON(http.StatusInternalServerError, gin.H{"error": "Database error"})
			return
		}
		defer rows.Close()

		for rows.Next() {
			var irpnId int
			if err := rows.Scan(&irpnId); err != nil {
				c.JSON(http.StatusInternalServerError, gin.H{"error": "Database error"})
				return
			}
			groupPartCountOld = append(groupPartCountOld, irpnId)
		}

		if err := rows.Err(); err != nil {
			c.JSON(http.StatusInternalServerError, gin.H{"error": "Database error"})
			return
		}

		newPartGroupCount := len(objRfq.IrGroupPart)

		if len(groupPartCountOld) == newPartGroupCount {
			//////////////////////////////////// Old Group Part //////////////////////////////////
			for i, part := range objRfq.IrGroupPart {
				var remark sql.NullString
				if part.IrRemark == "" {
					remark = sql.NullString{String: "", Valid: false}
				} else {
					remark = sql.NullString{String: part.IrRemark, Valid: true}
				}

				_, err := db.Exec(
					"UPDATE info_rfq_part_no SET irpn_part_no = ?, irpn_part_name = ?, irpn_model = ?, irpn_remark = ? WHERE irpn_id = ?",
					part.IrPartNo, part.IrPartName, part.IrModel, remark, groupPartCountOld[i],
				)
				if err != nil {
					c.JSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
					return
				}
			}
		} else {
			//////////////////////////////////// New Group Part //////////////////////////////////

			_, err := db.Exec("UPDATE info_rfq_part_no SET irpn_status = 0 WHERE ir_id = ?", objRfq.IrId)
			if err != nil {
				c.JSON(http.StatusInternalServerError, gin.H{"Error": "Failed to update old parts status"})
				return
			}

			var sql string = "INSERT INTO info_rfq_part_no (ir_id, irpn_part_no, irpn_part_name, irpn_model, irpn_remark, irpn_status, irpn_created_date, irpn_created_by, irpn_updated_date, irpn_updated_by) VALUES "
			values := []string{}

			for _, partCurrent := range objRfq.IrGroupPart {
				partNo := partCurrent.IrPartNo
				partName := partCurrent.IrPartName
				model := partCurrent.IrModel
				remark := partCurrent.IrRemark

				if remark == "" {
					remark = "NULL"
				} else {
					remark = fmt.Sprintf("'%s'", remark)
				}

				value := fmt.Sprintf("(%d, '%s', '%s', '%s', %s, %d, '%s', '%s', '%s', '%s')",
					objRfq.IrId,
					partNo,
					partName,
					model,
					remark,
					1,
					objRfq.IrCreatedDate,
					objRfq.IrCreatedBy,
					objRfq.IrCreatedDate,
					objRfq.IrCreatedBy)

				values = append(values, value)
			}

			if len(values) == 0 {
				c.IndentedJSON(http.StatusBadRequest, gin.H{"error": "ไม่มีข้อมูลที่สามารถบันทึกได้"})
				return
			}

			sql += strings.Join(values, ",")

			_, err = db.Exec(sql)
			if err != nil {
				c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
				return
			}
		}

		//////////////////////////////////// Group Volume //////////////////////////////////

		rowsVolume, err := db.Query("SELECT irv_id FROM info_rfq_volume WHERE ir_id = ? AND irv_status_flg = 1 ORDER BY irv_id", objRfq.IrId)
		if err != nil {
			c.JSON(http.StatusInternalServerError, gin.H{"error": "Database error"})
			return
		}
		defer rowsVolume.Close()

		for rowsVolume.Next() {
			var irvId int
			if err := rowsVolume.Scan(&irvId); err != nil {
				c.JSON(http.StatusInternalServerError, gin.H{"error": "Database error"})
				return
			}
			groupVolumeCountOld = append(groupVolumeCountOld, irvId)
		}

		if err := rowsVolume.Err(); err != nil {
			c.JSON(http.StatusInternalServerError, gin.H{"error": "Database error"})
			return
		}

		newVolumeGroupCount := len(objRfq.IrGroupVolume)

		if len(groupVolumeCountOld) == newVolumeGroupCount {
			//////////////////////////////////// Old Group Volume //////////////////////////////////
			for i, volume := range objRfq.IrGroupVolume {
				_, err := db.Exec(
					"UPDATE info_rfq_volume SET irv_year = ?, irv_volume = ?, irv_updated_date = ?, irv_updated_by = ? WHERE irv_id = ? AND ir_id = ?", volume.Year, volume.Volume, objRfq.IrCreatedDate, objRfq.IrCreatedBy, groupVolumeCountOld[i], objRfq.IrId,
				)
				if err != nil {
					c.JSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
					return
				}
			}
		} else {
			//////////////////////////////////// New Group Volume //////////////////////////////////

			_, err := db.Exec("UPDATE info_rfq_volume SET irv_status_flg = 0 WHERE ir_id = ?", objRfq.IrId)
			if err != nil {
				c.JSON(http.StatusInternalServerError, gin.H{"Error": "Failed to update old Volume status"})
				return
			}

			var sql string = "INSERT INTO info_rfq_volume (ir_id, irv_year, irv_volume, irv_status_flg, irv_created_date, irv_created_by, irv_updated_date, irv_updated_by) VALUES "
			values := []string{}

			for _, volumeCurrent := range objRfq.IrGroupVolume {
				year := volumeCurrent.Year
				volume, err := strconv.Atoi(volumeCurrent.Volume)
				if err != nil {
					c.JSON(http.StatusBadRequest, gin.H{"error": fmt.Sprintf("Invalid volume value: %s", volumeCurrent.Volume)})
					return
				}

				value := fmt.Sprintf("(%d, '%s', %d, %d, '%s', '%s', '%s', '%s')",
					objRfq.IrId,
					year,
					volume,
					1,
					objRfq.IrCreatedDate,
					objRfq.IrCreatedBy,
					objRfq.IrCreatedDate,
					objRfq.IrCreatedBy)

				values = append(values, value)
			}

			if len(values) == 0 {
				c.IndentedJSON(http.StatusBadRequest, gin.H{"error": "ไม่มีข้อมูลที่สามารถบันทึกได้"})
				return
			}

			sql += strings.Join(values, ",")

			_, err = db.Exec(sql)
			if err != nil {
				c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
				return
			}
		}

		//////////////////////////////////// Checkbox //////////////////////////////////
		log.Println("Checkbox")
		_, err = db.Exec("UPDATE info_rfq_formcheck SET irfc_pu_dept = ?, irfc_pe_dept = ?, irfc_scm_dept = ?, irfc_ce_dept = ?, irfc_gdc_dept = ?, irfc_raw_puc = ?, irfc_mold_puc = ?, irfc_menufac_puc = ?, irfc_transport_puc = ?, irfc_cast_poc = ?, irfc_machin_poc = ?, irfc_assembly_poc = ?, irfc_pack_poc = ?, irfc_updated_date = ?, irfc_updated_by = ? WHERE ir_id = ?",
			objRfq.IrGroupCheckbox[0].IrPuDept,
			objRfq.IrGroupCheckbox[0].IrPeDept,
			objRfq.IrGroupCheckbox[0].IrScmDept,
			objRfq.IrGroupCheckbox[0].IrCeDept,
			objRfq.IrGroupCheckbox[0].IrGdcDept,
			objRfq.IrGroupCheckbox[0].IrRawPuc,
			objRfq.IrGroupCheckbox[0].IrMoldPuc,
			objRfq.IrGroupCheckbox[0].IrMenufacPuc,
			objRfq.IrGroupCheckbox[0].IrTransportPuc,
			objRfq.IrGroupCheckbox[0].IrCastPoc,
			objRfq.IrGroupCheckbox[0].IrMachinPoc,
			objRfq.IrGroupCheckbox[0].IrAssemblyPoc,
			objRfq.IrGroupCheckbox[0].IrPackPoc,
			objRfq.IrCreatedDate,
			objRfq.IrCreatedBy,
			objRfq.IrId)

		if err != nil {
			c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
			return
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
