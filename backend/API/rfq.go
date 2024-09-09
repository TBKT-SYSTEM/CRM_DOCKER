package API

import (
	"database/sql"
	"log"
	"net/http"

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

func InsertRfq(c *gin.Context) {
	log.Println("InsertRfq called")
	var objRfq Rfq

	if err := c.BindJSON(&objRfq); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}

	objResult, err := db.Exec("INSERT INTO info_rfq (ir_id, ir_customer, ir_ref_nbc, ir_pro_life, ir_pro_tim, ir_duedate, ir_status, create_date, update_date, create_by, update_by) VALUES(?,?,?,?,?,?,?,?,?,?,?)", objRfq.Ir_id, objRfq.Ir_customer, objRfq.Ir_ref_nbc, objRfq.Ir_pro_life, objRfq.Ir_pro_tim, objRfq.Ir_duedate, objRfq.Ir_status, objRfq.Create_date, objRfq.Create_date, objRfq.Create_by, objRfq.Create_by)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}

	objLastId, err := objResult.LastInsertId()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}
	c.IndentedJSON(http.StatusOK, objLastId)
}

func ListRfqTable(c *gin.Context) {
	var objRfqList []RfqTable
	objListRfq, err := db.Query("SELECT inr.*, su.su_fname, su.su_lname, su.su_img_path, su.su_img_name FROM `info_rfq` AS inr LEFT JOIN sys_user AS su ON inr.update_by = su.su_emp_code ORDER BY inr.ir_id")
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListRfq.Close()
	for objListRfq.Next() {
		var objRfq RfqTable
		var strUserFname sql.NullString
		var strUserLname sql.NullString
		var strUserImgPath sql.NullString
		var strUserImgName sql.NullString
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString
		err := objListRfq.Scan(&objRfq.Ir_id, &objRfq.Ir_customer, &objRfq.Ir_ref_nbc, &objRfq.Ir_pro_life, &objRfq.Ir_pro_tim, &objRfq.Ir_duedate, &objRfq.Ir_status, &strCreateDate, &strUpdateDate, &strCreateBy, &strUpdateBy, &strUserFname, &strUserLname, &strUserImgPath, &strUserImgName)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		if strUserFname.Valid {
			objRfq.Su_fname = strUserFname.String
		}
		if strUserLname.Valid {
			objRfq.Su_lname = strUserLname.String
		}
		if strUserImgPath.Valid {
			objRfq.Su_img_path = strUserImgPath.String
		}
		if strUserImgName.Valid {
			objRfq.Su_img_name = strUserImgName.String
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
	var strDuedate sql.NullString
	var strCreateDate sql.NullString
	var strUpdateDate sql.NullString
	var strCreateBy sql.NullString
	var strUpdateBy sql.NullString
	err := db.QueryRow("SELECT inr.*, su.su_fname, su.su_lname, su.su_img_path, su.su_img_name FROM `info_rfq` AS inr LEFT JOIN sys_user AS su ON inr.update_by = su.su_emp_code WHERE inr.ir_id = ? ORDER BY inr.ir_id", iId).Scan(&objRfq.Ir_id, &objRfq.Ir_customer, &objRfq.Ir_ref_nbc, &objRfq.Ir_pro_life, &objRfq.Ir_pro_tim, &strDuedate, &objRfq.Ir_status, &strCreateDate, &strUpdateDate, &strCreateBy, &strUpdateBy, &objRfq.Su_fname, &objRfq.Su_lname, &objRfq.Su_img_path, &objRfq.Su_img_name)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	if strDuedate.Valid {
		objRfq.Ir_duedate = strDuedate.String
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

func ListBtnRfq(c *gin.Context) {
	// log.Println("List Part No By Id : ", c.Param("id"))
	var objBtnList []GetBtnRfq
	objListData, err := db.Query("SELECT swd.swd_id, swd.swd_app_lv, swd.su_id, swd.swg_id, swd.sat_id, su.su_fname, su.su_lname, swg.swg_name, sat.sat_name FROM sys_workflow_detail swd LEFT JOIN sys_user su ON swd.su_id = su.su_id LEFT JOIN sys_workflow_group swg ON swd.swg_id = swg.swg_id LEFT JOIN sys_approve_type sat ON swd.sat_id = sat.sat_id WHERE su.su_emp_code = ?", c.Param("id"))
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListData.Close()
	for objListData.Next() {
		var objListBtn GetBtnRfq
		err := objListData.Scan(&objListBtn.Swd_id, &objListBtn.Swd_app_lv, &objListBtn.Su_id, &objListBtn.Swg_id, &objListBtn.Sat_id, &objListBtn.Su_fname, &objListBtn.Su_lname, &objListBtn.Swg_name, &objListBtn.Sat_name)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		}
		objBtnList = append(objBtnList, objListBtn)
	}
	err = objListData.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}

	var objData GetBtnRfqData
	objData.Data = objBtnList
	c.IndentedJSON(http.StatusOK, objData)
}
