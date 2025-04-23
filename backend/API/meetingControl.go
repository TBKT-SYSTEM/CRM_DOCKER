package API

import (
	"fmt"
	"log"
	"net/http"
	"strings"
	"time"

	"github.com/gin-gonic/gin"
)

func InsertMeeting(c *gin.Context) {
	var objMeeting MeetingControl
	// var mcipID []int
	if err := c.BindJSON(&objMeeting); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}

	for _, item := range objMeeting.Imc_group_member {
		log.Println(item.Sd_id)
		log.Println(item.Imm_name)
	}

	objResult, err := db.Exec("INSERT INTO info_meeting_control (mdt_id, idc_id, imc_date, imc_detail, imc_created_date, imc_created_by, imc_updated_date, imc_updated_by) VALUES(?, ?, ?, ?, ?, ?, ?, ?)", objMeeting.Mdt_id, objMeeting.Idc_id, objMeeting.Imc_date, objMeeting.Imc_detail, objMeeting.Imc_created_date, objMeeting.Imc_created_by, objMeeting.Imc_created_date, objMeeting.Imc_created_by)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}

	objLastId, err := objResult.LastInsertId()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}

	var sqlMember string = "INSERT INTO info_meeting_member (imc_id, sd_id, imm_name, imm_created_date, imm_created_by, imm_updated_date, imm_updated_by) VALUES "
	valueMember := []string{}

	for _, item := range objMeeting.Imc_group_member {
		value := fmt.Sprintf("(%d, %d, '%s', '%s', '%s', '%s', '%s')",
			objLastId,
			item.Sd_id,
			item.Imm_name,
			objMeeting.Imc_created_date,
			objMeeting.Imc_created_by,
			objMeeting.Imc_created_date,
			objMeeting.Imc_created_by)
		valueMember = append(valueMember, value)
	}

	if len(valueMember) == 0 {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": "ไม่มีข้อมูลที่สามารถบันทึกได้"})
		return
	}

	sqlMember += strings.Join(valueMember, ",")
	_, errMemberItem := db.Exec(sqlMember)

	if errMemberItem != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"ErrorMember": errMemberItem.Error()})
		return
	}

	var sql string = "INSERT INTO info_meeting_next_action (imc_id, imnc_topic_no, imnc_topic_detail, sd_id, imnc_date, imnc_created_date, imnc_created_by, imnc_updated_date, imnc_updated_by) VALUES "
	valueAction := []string{}

	for _, item := range objMeeting.Imc_group_action {
		value := fmt.Sprintf("(%d, %d, '%s', %d, '%s', '%s', '%s', '%s', '%s')",
			objLastId,
			item.Imnc_topic_no,
			item.Imnc_topic_detail,
			item.Sd_id,
			item.Imnc_date,
			objMeeting.Imc_created_date,
			objMeeting.Imc_created_by,
			objMeeting.Imc_created_date,
			objMeeting.Imc_created_by)
		valueAction = append(valueAction, value)
	}

	if len(valueAction) == 0 {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": "ไม่มีข้อมูลที่สามารถบันทึกได้"})
		return
	}

	sql += strings.Join(valueAction, ",")
	_, errActionItem := db.Exec(sql)

	if errActionItem != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"ErrorAction": errActionItem.Error()})
		return
	}

	c.IndentedJSON(http.StatusOK, objMeeting)
}
func ListMeetingTable(c *gin.Context) {
	var objMeetingList []MeetingTable

	now := time.Now()
	startDate := time.Date(now.Year(), now.Month(), 1, 0, 0, 0, 0, now.Location())
	endDate := startDate.AddDate(0, 1, -1)

	objListMeeting, err := db.Query("SELECT imc.imc_id, idc.idc_id, idc.idc_customer_type, mdt.mdt_position1, idc.idc_running_no, idc.idc_customer_name, imc.imc_status, imc.imc_date, imc.imc_created_by, su.su_firstname, su.su_lastname FROM info_meeting_control AS imc LEFT JOIN info_document_control AS idc ON idc.idc_id = imc.idc_id LEFT JOIN mst_document_type AS mdt ON mdt.mdt_id = idc.mdt_id LEFT JOIN sys_users AS su ON imc.imc_created_by = su.su_username WHERE imc.imc_created_date BETWEEN ? AND ? ORDER BY imc.imc_id", startDate.Format("2006-01-02"), endDate.Format("2006-01-02"))
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}

	defer objListMeeting.Close()
	for objListMeeting.Next() {
		var objMeeting MeetingTable
		err := objListMeeting.Scan(&objMeeting.Imc_id, &objMeeting.Idc_id, &objMeeting.Idc_customer_type, &objMeeting.Mdt_position1, &objMeeting.Idc_running_no, &objMeeting.Idc_customer_name, &objMeeting.Imc_status, &objMeeting.Imc_date, &objMeeting.Imc_created_by, &objMeeting.Su_firstname, &objMeeting.Su_lastname)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
			return
		}

		objMeetingList = append(objMeetingList, objMeeting)
	}

	err = objListMeeting.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}

	var objData MeetingTableData
	objData.Data = objMeetingList
	c.IndentedJSON(http.StatusOK, objData)
}

func ListMeetingSearch(c *gin.Context) {
	var objMeetingList []MeetingTable
	startDate := c.Param("startDate")
	objListMeeting, err := db.Query("SELECT imc.imc_id, idc.idc_id, idc.idc_customer_type, mdt.mdt_position1, idc.idc_running_no, idc.idc_customer_name, imc.imc_status, imc.imc_date, imc.imc_created_by, su.su_firstname, su.su_lastname FROM info_meeting_control AS imc LEFT JOIN info_document_control AS idc ON idc.idc_id = imc.idc_id LEFT JOIN mst_document_type AS mdt ON mdt.mdt_id = idc.mdt_id LEFT JOIN sys_users AS su ON imc.imc_created_by = su.su_username WHERE imc.imc_date = ? ORDER BY imc.imc_id", startDate)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}

	defer objListMeeting.Close()
	for objListMeeting.Next() {
		var objMeeting MeetingTable
		err := objListMeeting.Scan(&objMeeting.Imc_id, &objMeeting.Idc_id, &objMeeting.Idc_customer_type, &objMeeting.Mdt_position1, &objMeeting.Idc_running_no, &objMeeting.Idc_customer_name, &objMeeting.Imc_status, &objMeeting.Imc_date, &objMeeting.Imc_created_by, &objMeeting.Su_firstname, &objMeeting.Su_lastname)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
			return
		}

		objMeetingList = append(objMeetingList, objMeeting)
	}

	err = objListMeeting.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}

	var objData MeetingTableData
	objData.Data = objMeetingList
	c.IndentedJSON(http.StatusOK, objData)
}
func GetMeeting(c *gin.Context) {
	var objMeetingList []MeetingTable
	imcID := c.Param("id")

	objListMeeting, err := db.Query("SELECT imc.imc_id, idc.idc_id, idc.idc_customer_type, mdt.mdt_id, mdt.mdt_position1, idc.idc_running_no, idc.idc_customer_name, imc.imc_status, imc.imc_date, imc.imc_detail, imc.imc_created_by, su.su_firstname, su.su_lastname FROM info_meeting_control AS imc LEFT JOIN info_document_control AS idc ON idc.idc_id = imc.idc_id LEFT JOIN mst_document_type AS mdt ON mdt.mdt_id = idc.mdt_id LEFT JOIN sys_users AS su ON imc.imc_created_by = su.su_username WHERE imc.imc_id = ? ORDER BY imc.imc_id", imcID)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}
	defer objListMeeting.Close()

	for objListMeeting.Next() {
		var objMeeting MeetingTable
		err := objListMeeting.Scan(&objMeeting.Imc_id, &objMeeting.Idc_id, &objMeeting.Idc_customer_type, &objMeeting.Mdt_id, &objMeeting.Mdt_position1, &objMeeting.Idc_running_no, &objMeeting.Idc_customer_name, &objMeeting.Imc_status, &objMeeting.Imc_date, &objMeeting.Imc_detail, &objMeeting.Imc_created_by, &objMeeting.Su_firstname, &objMeeting.Su_lastname)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
			return
		}
		objMeetingList = append(objMeetingList, objMeeting)
	}

	err = objListMeeting.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}

	rowsMember, err := db.Query("SELECT imm.*, sd.sd_dept_name FROM `info_meeting_member` imm LEFT JOIN sys_department sd ON imm.sd_id = sd.sd_id WHERE imm.imc_id = ? AND imm.imm_status IN (1, 5, 9) ORDER BY imm.imc_id", imcID)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}
	defer rowsMember.Close()

	for i := range objMeetingList {
		for rowsMember.Next() {
			var groupMember MeetingGroupMemberDetail
			if err := rowsMember.Scan(
				&groupMember.Imm_id,
				&groupMember.Imc_id,
				&groupMember.Sd_id,
				&groupMember.Imm_name,
				&groupMember.Imm_status,
				&groupMember.Imm_created_date,
				&groupMember.Imm_created_by,
				&groupMember.Imm_updated_date,
				&groupMember.Imm_updated_by,
				&groupMember.Sd_dept_name,
			); err != nil {
				c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
				return
			}

			if objMeetingList[i].Imc_id == groupMember.Imc_id {
				objMeetingList[i].Imc_group_member = append(objMeetingList[i].Imc_group_member, groupMember)
			}
		}
	}

	if err := rowsMember.Err(); err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"ErrorRowsMember": err.Error()})
		return
	}

	rowsAction, err := db.Query("SELECT imnc.*, sd.sd_dept_name FROM `info_meeting_next_action` imnc LEFT JOIN sys_department sd ON imnc.sd_id = sd.sd_id WHERE imc_id = ? AND imnc.imnc_status IN (1, 5, 9) ORDER BY imnc_id", imcID)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}
	defer rowsAction.Close()

	for i := range objMeetingList {
		for rowsAction.Next() {
			var groupAction MeetingGroupActionDetail
			if err := rowsAction.Scan(
				&groupAction.Imnc_id,
				&groupAction.Imc_id,
				&groupAction.Imnc_topic_no,
				&groupAction.Imnc_topic_detail,
				&groupAction.Sd_id,
				&groupAction.Imnc_date,
				&groupAction.Imnc_status,
				&groupAction.Imnc_created_date,
				&groupAction.Imnc_created_by,
				&groupAction.Imnc_updated_date,
				&groupAction.Imnc_updated_by,
				&groupAction.Sd_dept_name,
			); err != nil {
				c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
				return
			}

			if objMeetingList[i].Imc_id == groupAction.Imc_id {
				objMeetingList[i].Imc_group_action = append(objMeetingList[i].Imc_group_action, groupAction)
			}
		}
	}

	if err := rowsAction.Err(); err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"ErrorAction": err.Error()})
		return
	}

	c.IndentedJSON(http.StatusOK, objMeetingList)
}
func EditMeeting(c *gin.Context) {
	var objMeeting MeetingControl
	var groupMemberCountOld []int
	var groupActionCountOld []int

	if err := c.BindJSON(&objMeeting); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}

	_, err := db.Exec(`UPDATE info_meeting_control SET idc_id = ?, imc_date =?, imc_detail = ?, imc_updated_date = ?, imc_updated_by = ? WHERE imc_id = ?`, objMeeting.Idc_id, objMeeting.Imc_date, objMeeting.Imc_detail, objMeeting.Imc_updated_date, objMeeting.Imc_updated_by, objMeeting.Imc_id)

	if err != nil {
		c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error": err.Error()})
		return
	}

	//////////////////////////////////// Update Member //////////////////////////////////-------------
	rows, err := db.Query(
		"SELECT imm_id FROM info_meeting_member WHERE imc_id = ? AND imm_status = 1", objMeeting.Imc_id)
	if err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": "Database error"})
		return
	}
	defer rows.Close()

	for rows.Next() {
		var imm_id int
		if err := rows.Scan(&imm_id); err != nil {
			c.JSON(http.StatusInternalServerError, gin.H{"error": "Database error"})
			return
		}
		groupMemberCountOld = append(groupMemberCountOld, imm_id)
	}

	if err := rows.Err(); err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": "Database error"})
		return
	}

	newMemberGroupCount := len(objMeeting.Imc_group_member)

	if len(groupMemberCountOld) == newMemberGroupCount {
		//////////////////////////////////// Old Group Member //////////////////////////////////-------------
		for i, item := range objMeeting.Imc_group_member {
			_, err := db.Exec(
				"UPDATE info_meeting_member SET sd_id = ?, imm_name = ?, imm_updated_date = ?, imm_updated_by = ? WHERE imm_id = ?",
				item.Sd_id, item.Imm_name, objMeeting.Imc_updated_date, objMeeting.Imc_updated_by, groupMemberCountOld[i],
			)
			if err != nil {
				c.JSON(http.StatusInternalServerError, gin.H{"Error1": err.Error()})
				return
			}
		}
	} else {
		// 	//////////////////////////////////// New Group Member //////////////////////////////////------------
		_, err := db.Exec("UPDATE info_meeting_member SET imm_status = 0 WHERE imc_id = ?", objMeeting.Imc_id)
		if err != nil {
			c.JSON(http.StatusInternalServerError, gin.H{"Error2": "Failed to update old parts status"})
			return
		}

		var zeroIdMember []MeetingGroupMember
		var nonZeroIdMember []MeetingGroupMember

		for _, item := range objMeeting.Imc_group_member {
			if item.Imm_id == 0 {
				zeroIdMember = append(zeroIdMember, item)
			} else {
				nonZeroIdMember = append(nonZeroIdMember, item)
			}
		}

		if len(nonZeroIdMember) > 0 {
			sqlUpdate := "UPDATE info_meeting_member SET sd_id = ?, imm_name = ?, imm_status = ?, imm_updated_date = ?, imm_updated_by = ? WHERE imm_id = ?"

			for _, itemCurrent := range nonZeroIdMember {
				_, err := db.Exec(sqlUpdate, itemCurrent.Sd_id, itemCurrent.Imm_name, 1, objMeeting.Imc_updated_date, objMeeting.Imc_updated_by, itemCurrent.Imm_id)

				if err != nil {
					c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error3": err.Error()})
					return
				}
			}
		}

		if len(zeroIdMember) > 0 {
			sqlInsert := `INSERT INTO info_meeting_member (imc_id, sd_id, imm_name, imm_created_date, imm_created_by, imm_updated_date, imm_updated_by) VALUES (?, ?, ?, ?, ?, ?, ?)`

			for _, itemCurrent := range zeroIdMember {
				_, err := db.Exec(sqlInsert, objMeeting.Imc_id, itemCurrent.Sd_id, itemCurrent.Imm_name, objMeeting.Imc_updated_date, objMeeting.Imc_updated_by, objMeeting.Imc_updated_date, objMeeting.Imc_updated_by)

				if err != nil {
					c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error4": err.Error()})
					return
				}
			}
		}
	}

	//////////////////////////////////// Update Action //////////////////////////////////-------------
	rows, err = db.Query(
		"SELECT imnc_id FROM info_meeting_next_action WHERE imc_id = ? AND imnc_status = 1", objMeeting.Imc_id)
	if err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": "Database error"})
		return
	}
	defer rows.Close()

	for rows.Next() {
		var imnc_id int
		if err := rows.Scan(&imnc_id); err != nil {
			c.JSON(http.StatusInternalServerError, gin.H{"error": "Database error"})
			return
		}
		groupActionCountOld = append(groupActionCountOld, imnc_id)
	}

	if err := rows.Err(); err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": "Database error"})
		return
	}

	newActionGroupCount := len(objMeeting.Imc_group_action)

	if len(groupActionCountOld) == newActionGroupCount {
		//////////////////////////////////// Old Group Member //////////////////////////////////-------------
		for i, item := range objMeeting.Imc_group_action {
			_, err := db.Exec(
				"UPDATE info_meeting_next_action SET imnc_topic_no = ?, imnc_topic_detail = ?, sd_id = ?, imnc_date = ?, imnc_updated_date = ?, imnc_updated_by = ? WHERE imnc_id = ?",
				item.Imnc_topic_no, item.Imnc_topic_detail, item.Sd_id, item.Imnc_date, objMeeting.Imc_updated_date, objMeeting.Imc_updated_by, groupActionCountOld[i],
			)
			if err != nil {
				c.JSON(http.StatusInternalServerError, gin.H{"Error5": err.Error()})
				return
			}
		}
	} else {
		// 	//////////////////////////////////// New Group Member //////////////////////////////////------------
		_, err := db.Exec("UPDATE info_meeting_next_action SET imnc_status = 0 WHERE imc_id = ?", objMeeting.Imc_id)
		if err != nil {
			c.JSON(http.StatusInternalServerError, gin.H{"Error6": "Failed to update old parts status"})
			return
		}

		var zeroIdAction []MeetingGroupAction
		var nonZeroIdAction []MeetingGroupAction

		for _, item := range objMeeting.Imc_group_action {
			if item.Imnc_id == 0 {
				zeroIdAction = append(zeroIdAction, item)
			} else {
				nonZeroIdAction = append(nonZeroIdAction, item)
			}
		}

		if len(nonZeroIdAction) > 0 {
			sqlUpdate := "UPDATE info_meeting_next_action SET imnc_topic_no = ?, imnc_topic_detail = ?, sd_id = ?, imnc_date = ?, imnc_status = ?, imnc_updated_date = ?, imnc_updated_by = ? WHERE imnc_id = ?"

			for _, itemCurrent := range nonZeroIdAction {
				_, err := db.Exec(sqlUpdate, itemCurrent.Imnc_topic_no, itemCurrent.Imnc_topic_detail, itemCurrent.Sd_id, itemCurrent.Imnc_date, 1, objMeeting.Imc_updated_date, objMeeting.Imc_updated_by, itemCurrent.Imnc_id)

				if err != nil {
					c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error7": err.Error()})
					return
				}
			}
		}

		if len(zeroIdAction) > 0 {
			sqlInsert := `INSERT INTO info_meeting_next_action (imc_id, imnc_topic_no, imnc_topic_detail, sd_id, imnc_date, imnc_created_date, imnc_created_by, imnc_updated_date, imnc_updated_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)`

			for _, itemCurrent := range zeroIdAction {
				_, err := db.Exec(sqlInsert, objMeeting.Imc_id, itemCurrent.Imnc_topic_no, itemCurrent.Imnc_topic_detail, itemCurrent.Sd_id, itemCurrent.Imnc_date, objMeeting.Imc_updated_date, objMeeting.Imc_updated_by, objMeeting.Imc_updated_date, objMeeting.Imc_updated_by)

				if err != nil {
					c.IndentedJSON(http.StatusInternalServerError, gin.H{"Error8": err.Error()})
					return
				}
			}
		}
	}

	c.IndentedJSON(http.StatusOK, objMeeting)
}
func ListMeetingViewAll(c *gin.Context) {
	var objMeetingList []MeetingTable
	now := time.Now()
	startDate := time.Date(now.Year(), now.Month(), 1, 0, 0, 0, 0, now.Location())
	endDate := startDate.AddDate(0, 1, -1)
	objListMeeting, err := db.Query("SELECT imc.imc_id, idc.idc_id, idc.idc_customer_type, mdt.mdt_position1, idc.idc_running_no, idc.idc_customer_name, imc.imc_status, imc.imc_date, imc.imc_created_by, su.su_firstname, su.su_lastname FROM info_meeting_control AS imc LEFT JOIN info_document_control AS idc ON idc.idc_id = imc.idc_id LEFT JOIN mst_document_type AS mdt ON mdt.mdt_id = idc.mdt_id LEFT JOIN sys_users AS su ON imc.imc_created_by = su.su_username WHERE imc.imc_date BETWEEN ? AND ? ORDER BY imc.imc_id", startDate, endDate)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}

	defer objListMeeting.Close()
	for objListMeeting.Next() {
		var objMeeting MeetingTable
		err := objListMeeting.Scan(&objMeeting.Imc_id, &objMeeting.Idc_id, &objMeeting.Idc_customer_type, &objMeeting.Mdt_position1, &objMeeting.Idc_running_no, &objMeeting.Idc_customer_name, &objMeeting.Imc_status, &objMeeting.Imc_date, &objMeeting.Imc_created_by, &objMeeting.Su_firstname, &objMeeting.Su_lastname)
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
			return
		}

		objMeetingList = append(objMeetingList, objMeeting)
	}

	err = objListMeeting.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}

	var objData MeetingTableData
	objData.Data = objMeetingList
	c.IndentedJSON(http.StatusOK, objData)
}
