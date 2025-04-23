package API

import (

	// "encoding/json"
	// "github.com/go-resty/resty/v2"

	"database/sql"
	"net/http"
	"time"

	"github.com/gin-gonic/gin"
	_ "github.com/go-sql-driver/mysql"
)

func GetRemainTask(c *gin.Context) {
	var objList []RemainTask

	objListRemainTask, err := db.Query("SELECT ida_id, idc_id, (SELECT mdt.mdt_position1 FROM mst_document_type AS mdt LEFT JOIN info_document_control AS idc ON idc.mdt_id = mdt.mdt_id WHERE idc.idc_id = curr.idc_id) AS doc_type, (SELECT idc2.idc_running_no FROM info_document_control AS idc2 WHERE idc2.idc_id = curr.idc_id) AS doc_no, (SELECT idc3.idc_running_no FROM info_document_control AS idc3 WHERE idc3.idc_id = (SELECT idc4.idc_refer_doc FROM info_document_control AS idc4 WHERE idc4.idc_id = curr.idc_id)) AS refer_doc, (SELECT idc1.idc_customer_name FROM info_document_control AS idc1 WHERE idc1.idc_id = curr.idc_id) AS idc_customer, ida_seq_no, su_id, ida_status, (SELECT ida_action FROM info_document_approval AS prev WHERE prev.idc_id = curr.idc_id AND prev.ida_seq_no < curr.ida_seq_no ORDER BY prev.ida_seq_no DESC LIMIT 1) AS prev_ida_action, swg_id, (SELECT GROUP_CONCAT(su.su_firstname) FROM sys_workflow_detail AS swd LEFT JOIN sys_users AS su ON swd.su_id = su.su_id WHERE swd.swg_id = curr.swg_id AND swd.swd_status = 1) AS work_flow, (SELECT idc.idc_created_date FROM info_document_control AS idc WHERE idc.idc_id = curr.idc_id) AS idc_created_date, (SELECT idc.idc_created_by FROM info_document_control AS idc WHERE idc.idc_id = curr.idc_id) AS idc_created_by, (SELECT su_firstname FROM sys_users AS su WHERE su.su_username = (SELECT idc.idc_created_by FROM info_document_control AS idc WHERE idc.idc_id = curr.idc_id)) AS su_firstname FROM info_document_approval AS curr WHERE ida_status = 1 AND ida_action = 0 AND su_id = ? AND (SELECT idc_status FROM info_document_control AS tbldoc WHERE tbldoc.idc_id = curr.idc_id) = 2 GROUP BY idc_id ORDER BY idc_created_date ASC", c.Param("id"))
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

func GetManageTask(c *gin.Context) {
	var objList []ManageTask
	now := time.Now()
	startDate := time.Date(now.Year(), now.Month(), 1, 0, 0, 0, 0, now.Location())
	endDate := startDate.AddDate(0, 1, -1)

	objListRemainTask, err := db.Query("SELECT idc.idc_id, idc.idc_customer_type, mdt.mdt_position1, idc.idc_running_no, (SELECT idc3.idc_running_no FROM info_document_control AS idc3 WHERE idc3.idc_id = (SELECT idc4.idc_refer_doc FROM info_document_control AS idc4 WHERE idc4.idc_id = idc.idc_id)) AS refer_doc, idc_customer_name, idc.idc_status, idc.idc_created_date, idc.idc_created_by, su.su_firstname FROM info_document_control idc LEFT JOIN mst_document_type mdt ON mdt.mdt_id = idc.mdt_id LEFT JOIN sys_users su ON su.su_username = idc.idc_created_by WHERE idc_created_date BETWEEN ? AND ? ORDER BY idc.idc_created_date", startDate, endDate)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}

	defer objListRemainTask.Close()
	for objListRemainTask.Next() {
		var objRemain ManageTask
		var strReferDoc sql.NullString

		err := objListRemainTask.Scan(&objRemain.Idc_id, &objRemain.Idc_customer_type, &objRemain.Mdt_position1, &objRemain.Idc_running_no, &strReferDoc, &objRemain.Idc_customer_name, &objRemain.Idc_status, &objRemain.Idc_created_date, &objRemain.Idc_created_by, &objRemain.Su_firstname)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
			return
		}

		if strReferDoc.Valid {
			objRemain.Refer_doc = strReferDoc.String
		}
		objList = append(objList, objRemain)
	}

	err = objListRemainTask.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}

	var objData ManageTaskData
	objData.Data = objList
	c.IndentedJSON(http.StatusOK, objData)
}

func ListSearchManageTask(c *gin.Context) {
	var objList []ManageTask
	startDate := c.Param("startDate")
	endDate := c.Param("endDate")

	objListRemainTask, err := db.Query("SELECT idc.idc_id, idc.idc_customer_type, mdt.mdt_position1, idc.idc_running_no, (SELECT idc3.idc_running_no FROM info_document_control AS idc3 WHERE idc3.idc_id = (SELECT idc4.idc_refer_doc FROM info_document_control AS idc4 WHERE idc4.idc_id = idc.idc_id)) AS refer_doc, idc_customer_name, idc.idc_status, idc.idc_created_date, idc.idc_created_by, su.su_firstname FROM info_document_control idc LEFT JOIN mst_document_type mdt ON mdt.mdt_id = idc.mdt_id LEFT JOIN sys_users su ON su.su_username = idc.idc_created_by WHERE idc.idc_created_date BETWEEN ? AND ? ORDER BY idc.idc_created_date", startDate, endDate)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}

	defer objListRemainTask.Close()
	for objListRemainTask.Next() {
		var objRemain ManageTask
		var strReferDoc sql.NullString

		err := objListRemainTask.Scan(&objRemain.Idc_id, &objRemain.Idc_customer_type, &objRemain.Mdt_position1, &objRemain.Idc_running_no, &strReferDoc, &objRemain.Idc_customer_name, &objRemain.Idc_status, &objRemain.Idc_created_date, &objRemain.Idc_created_by, &objRemain.Su_firstname)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
			return
		}

		if strReferDoc.Valid {
			objRemain.Refer_doc = strReferDoc.String
		}
		objList = append(objList, objRemain)
	}

	err = objListRemainTask.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}

	var objData ManageTaskData
	objData.Data = objList
	c.IndentedJSON(http.StatusOK, objData)
}

func GetManageApproval(c *gin.Context) {
	var objList []ManageTask
	userID := c.Param("id")
	now := time.Now()
	startDate := time.Date(now.Year(), now.Month(), 1, 0, 0, 0, 0, now.Location())
	endDate := startDate.AddDate(0, 1, -1)

	objListRemainTask, err := db.Query("SELECT idc.idc_id, idc.idc_customer_type, mdt.mdt_position1, idc.idc_running_no, (SELECT idc3.idc_running_no FROM info_document_control AS idc3 WHERE idc3.idc_id = (SELECT idc4.idc_refer_doc FROM info_document_control AS idc4 WHERE idc4.idc_id = idc.idc_id)) AS refer_doc, idc_customer_name, idc.idc_status, idc.idc_created_date, idc.idc_created_by, su.su_firstname FROM info_document_control idc LEFT JOIN mst_document_type mdt ON mdt.mdt_id = idc.mdt_id LEFT JOIN sys_users su ON su.su_username = idc.idc_created_by LEFT JOIN info_document_approval ida ON ida.idc_id = idc.idc_id WHERE idc.idc_created_date BETWEEN ? AND ? AND ida.su_id = ? GROUP BY idc.idc_id ORDER BY idc.idc_created_date", startDate, endDate, userID)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}

	defer objListRemainTask.Close()
	for objListRemainTask.Next() {
		var objRemain ManageTask
		var strReferDoc sql.NullString

		err := objListRemainTask.Scan(&objRemain.Idc_id, &objRemain.Idc_customer_type, &objRemain.Mdt_position1, &objRemain.Idc_running_no, &strReferDoc, &objRemain.Idc_customer_name, &objRemain.Idc_status, &objRemain.Idc_created_date, &objRemain.Idc_created_by, &objRemain.Su_firstname)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
			return
		}

		if strReferDoc.Valid {
			objRemain.Refer_doc = strReferDoc.String
		}
		objList = append(objList, objRemain)
	}

	err = objListRemainTask.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}

	var objData ManageTaskData
	objData.Data = objList
	c.IndentedJSON(http.StatusOK, objData)
}

func ListSearchManageApproval(c *gin.Context) {
	var objList []ManageTask
	userID := c.Param("id")
	startDate := c.Param("startDate")
	endDate := c.Param("endDate")

	objListRemainTask, err := db.Query("SELECT idc.idc_id, idc.idc_customer_type, mdt.mdt_position1, idc.idc_running_no, (SELECT idc3.idc_running_no FROM info_document_control AS idc3 WHERE idc3.idc_id = (SELECT idc4.idc_refer_doc FROM info_document_control AS idc4 WHERE idc4.idc_id = idc.idc_id)) AS refer_doc, idc_customer_name, idc.idc_status, idc.idc_created_date, idc.idc_created_by, su.su_firstname FROM info_document_control idc LEFT JOIN mst_document_type mdt ON mdt.mdt_id = idc.mdt_id LEFT JOIN sys_users su ON su.su_username = idc.idc_created_by LEFT JOIN info_document_approval ida ON ida.idc_id = idc.idc_id WHERE idc.idc_created_date BETWEEN ? AND ? AND ida.su_id = ? GROUP BY idc.idc_id ORDER BY idc.idc_created_date", startDate, endDate, userID)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}

	defer objListRemainTask.Close()
	for objListRemainTask.Next() {
		var objRemain ManageTask
		var strReferDoc sql.NullString

		err := objListRemainTask.Scan(&objRemain.Idc_id, &objRemain.Idc_customer_type, &objRemain.Mdt_position1, &objRemain.Idc_running_no, &strReferDoc, &objRemain.Idc_customer_name, &objRemain.Idc_status, &objRemain.Idc_created_date, &objRemain.Idc_created_by, &objRemain.Su_firstname)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
			return
		}

		if strReferDoc.Valid {
			objRemain.Refer_doc = strReferDoc.String
		}
		objList = append(objList, objRemain)
	}

	err = objListRemainTask.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}

	var objData ManageTaskData
	objData.Data = objList
	c.IndentedJSON(http.StatusOK, objData)
}
