package API

import (

	// "encoding/json"
	// "github.com/go-resty/resty/v2"

	"database/sql"
	"net/http"

	"github.com/gin-gonic/gin"
	_ "github.com/go-sql-driver/mysql"
)

func GetRemainTask(c *gin.Context) {
	var objList []RemainTask

	objListRemainTask, err := db.Query("SELECT ida_id, idc_id, (SELECT mdt.mdt_position1 FROM mst_document_type AS mdt LEFT JOIN info_document_control AS idc ON idc.mdt_id = mdt.mdt_id WHERE idc.idc_id = curr.idc_id) AS doc_type, (SELECT idc2.idc_running_no FROM info_document_control AS idc2 WHERE idc2.idc_id = curr.idc_id) AS doc_no, (SELECT idc3.idc_running_no FROM info_document_control AS idc3 WHERE idc3.idc_id = (SELECT idc4.idc_refer_doc FROM info_document_control AS idc4 WHERE idc4.idc_id = curr.idc_id)) AS refer_doc, (SELECT idc1.idc_customer_name FROM info_document_control AS idc1 WHERE idc1.idc_id = curr.idc_id) AS idc_customer, ida_seq_no, su_id, ida_status, (SELECT ida_action FROM info_document_approval AS prev WHERE prev.idc_id = curr.idc_id AND prev.ida_seq_no < curr.ida_seq_no ORDER BY prev.ida_seq_no DESC LIMIT 1) AS prev_ida_action, swg_id, (SELECT GROUP_CONCAT(su.su_firstname) FROM sys_workflow_detail AS swd LEFT JOIN sys_users AS su ON swd.su_id = su.su_id WHERE swd.swg_id = curr.swg_id) AS work_flow, (SELECT idc.idc_created_date FROM info_document_control AS idc WHERE idc.idc_id = curr.idc_id) AS idc_created_date, (SELECT idc.idc_created_by FROM info_document_control AS idc WHERE idc.idc_id = curr.idc_id) AS idc_created_by, (SELECT su_firstname FROM sys_users AS su WHERE su.su_username = (SELECT idc.idc_created_by FROM info_document_control AS idc WHERE idc.idc_id = curr.idc_id)) AS su_firstname FROM info_document_approval AS curr WHERE ida_status = 1 AND su_id = ? AND ( SELECT ida_action FROM info_document_approval AS prev WHERE prev.idc_id = curr.idc_id AND prev.ida_seq_no < curr.ida_seq_no ORDER BY prev.ida_seq_no DESC LIMIT 1 ) = 1 AND (SELECT idc_status FROM info_document_control AS tbldoc WHERE tbldoc.idc_id = curr.idc_id) = 2", c.Param("id"))
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}

	defer objListRemainTask.Close()
	for objListRemainTask.Next() {
		var objRemain RemainTask
		var strReferDoc sql.NullString
		var strPrevAction sql.NullInt64

		err := objListRemainTask.Scan(&objRemain.Ida_id, &objRemain.Idc_id, &objRemain.Doc_type, &objRemain.Doc_no, &strReferDoc, &objRemain.Idc_customer, &objRemain.Ida_seq_no, &objRemain.Su_id, &objRemain.Ida_status, &strPrevAction, &objRemain.Swg_id, &objRemain.Work_flow, &objRemain.Idc_created_date, &objRemain.Idc_created_by, &objRemain.Su_firstname)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
			return
		}

		if strReferDoc.Valid {
			objRemain.Refer_doc = strReferDoc.String
		}
		if strPrevAction.Valid {
			objRemain.Prev_ida_action = int(strPrevAction.Int64)
		}
		objList = append(objList, objRemain)
	}

	err = objListRemainTask.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}

	var objData RemainTaskData
	objData.Data = objList
	c.IndentedJSON(http.StatusOK, objData)
}
