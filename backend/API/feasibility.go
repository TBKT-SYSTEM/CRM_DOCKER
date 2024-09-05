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
	var objFeasibilityList []FeasibilityTable
	objListFeasibility, err := db.Query("SELECT inf.*,mrt.mrt_name, su.su_fname, su.su_lname, su.su_img_path, su.su_img_name FROM `info_feasibility` AS inf LEFT JOIN sys_user AS su ON inf.update_by = su.su_emp_code LEFT JOIN mst_requirement_type AS mrt ON mrt.mrt_id = inf.mrt_id ORDER BY inf.if_id")
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	defer objListFeasibility.Close()
	for objListFeasibility.Next() {
		var objFeasibility FeasibilityTable
		var strUserFname sql.NullString
		var strUserLname sql.NullString
		var strUserImgPath sql.NullString
		var strUserImgName sql.NullString
		var strDuedate sql.NullString
		var strCreateDate sql.NullString
		var strUpdateDate sql.NullString
		var strCreateBy sql.NullString
		var strUpdateBy sql.NullString
		err := objListFeasibility.Scan(&objFeasibility.If_id, &objFeasibility.If_ref, &objFeasibility.If_customer, &objFeasibility.If_import_tran, &objFeasibility.Mrt_id, &strDuedate, &objFeasibility.If_status, &strCreateDate, &strUpdateDate, &strCreateBy, &strUpdateBy, &objFeasibility.Mrt_name, &strUserFname, &strUserLname, &strUserImgPath, &strUserImgName)
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
		if strDuedate.Valid {
			objFeasibility.If_duedate = strDuedate.String
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
		objFeasibilityList = append(objFeasibilityList, objFeasibility)
	}
	err = objListFeasibility.Err()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}

	var objData FeasibilityData
	objData.Data = objFeasibilityList
	c.IndentedJSON(http.StatusOK, objData)
}

func ListFeasibility(c *gin.Context) {
	var objFeasibility Feasibility1
	iId := c.Param("id")
	var strDuedate sql.NullString
	var strCreateDate sql.NullString
	var strUpdateDate sql.NullString
	var strCreateBy sql.NullString
	var strUpdateBy sql.NullString
	err := db.QueryRow("SELECT * FROM `info_feasibility` WHERE if_id= ?", iId).Scan(&objFeasibility.If_id, &objFeasibility.If_ref, &objFeasibility.If_customer, &objFeasibility.If_import_tran, &objFeasibility.Mrt_id, &strDuedate, &objFeasibility.If_status, &strCreateDate, &strUpdateDate, &strCreateBy, &strUpdateBy)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	if strDuedate.Valid {
		objFeasibility.If_duedate = strDuedate.String
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
	c.IndentedJSON(http.StatusOK, objFeasibility)
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
func InsertFeasibility(c *gin.Context) {
	var objFeasibility Feasibility1

	if err := c.BindJSON(&objFeasibility); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}

	objResult, err := db.Exec("INSERT INTO info_feasibility(if_ref,if_customer,if_import_tran,mrt_id,if_duedate,create_date,update_date,create_by,update_by) VALUES(?,?,?,?,?,?,?,?,?)", objFeasibility.If_ref, objFeasibility.If_customer, objFeasibility.If_import_tran, objFeasibility.Mrt_id, objFeasibility.If_duedate, objFeasibility.Create_date, objFeasibility.Update_date, objFeasibility.Create_by, objFeasibility.Update_by)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	}
	objLastId, err := objResult.LastInsertId()
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
		return
	} else {
		objConsiderationCount, err := CountConsideration()
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{"Error": err.Error()})
			return
		}

		var sql string = "INSERT INTO info_feasibility_consern_point (if_id, mc_id, create_date, update_date, create_by, update_by) VALUES "
		values := []string{}

		for _, consideration := range objConsiderationCount {
			value := fmt.Sprintf("(%d, %d, '%s', '%s', '%s', '%s')",
				objLastId,
				consideration.Mc_id,
				objFeasibility.Create_date,
				objFeasibility.Update_date,
				objFeasibility.Create_by,
				objFeasibility.Update_by)
			values = append(values, value)
		}

		sql += strings.Join(values, ",")

		objResult, err := db.Exec(sql)
		if err != nil {
			c.IndentedJSON(http.StatusInternalServerError, gin.H{
				"Error": err.Error(),
			})
			return
		}

		iMaxId, err := objResult.LastInsertId()
		if err != nil {
			c.IndentedJSON(http.StatusOK, gin.H{
				"Error": err.Error(),
			})
			return
		} else {
			var sql string = "INSERT INTO info_feasibility_part_no (if_id, ifpn_part_no, ifpn_part_name, ifpn_status, create_date, update_date, create_by, update_by) VALUES "
			values := []string{}

			for i, part_current := range objFeasibility.If_group_part {
				var partNo, partName string
				for key, value := range part_current {
					if key == "partNo"+fmt.Sprint(i+1) {
						partNo = value
					} else if key == "partName"+fmt.Sprint(i+1) {
						partName = value
					}
				}
				value := fmt.Sprintf("(%d, '%s', '%s', %d, '%s', '%s', '%s', '%s')",
					objLastId,
					partNo,
					partName,
					1,
					objFeasibility.Create_date,
					objFeasibility.Update_date,
					objFeasibility.Create_by,
					objFeasibility.Update_by)
				values = append(values, value)
			}

			// Combine the SQL statement with the values
			sql += strings.Join(values, ",")

			objResult, err := db.Exec(sql)
			if err != nil {
				c.IndentedJSON(http.StatusInternalServerError, gin.H{
					"Error": err.Error(),
				})
				return
			}

			iMaxPartId, err := objResult.LastInsertId()
			if err != nil {
				c.IndentedJSON(http.StatusInternalServerError, gin.H{
					"Error": err.Error(),
				})
				return
			} else {
				c.IndentedJSON(http.StatusOK, gin.H{
					"insertID":           iMaxId,
					"insertPartID":       iMaxPartId,
					"TotalConsideration": len(objConsiderationCount),
					"Error":              nil,
				})
			}

		}

	}
}
func UpdatePartNoFeasibility(c *gin.Context) {

	var rawData []map[string]interface{}

	if err := c.BindJSON(&rawData); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	var partNo, partName, update_date, update_by string
	var ifpnID int

	for _, item := range rawData {
		if value, ok := item["ifpn_id"].(string); ok {
			ifpnID, _ = strconv.Atoi(value)
		}
		if value, ok := item["partNo"].(string); ok {
			partNo = value
		}
		if value, ok := item["partName"].(string); ok {
			partName = value
		}
		if value, ok := item["update_date"].(string); ok {
			update_date = value
		}
		if value, ok := item["update_by"].(string); ok {
			update_by = value
		}
	}

	if partNo == "" || partName == "" || ifpnID == 0 {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": "Incomplete data"})
		return
	}
	objResult, err := db.Exec("Update info_feasibility_part_no SET ifpn_part_no = ?, ifpn_part_name = ?, update_date = ?, update_by = ? WHERE ifpn_id = ?", partNo, partName, update_date, update_by, ifpnID)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
	}
	c.IndentedJSON(http.StatusOK, gin.H{"Update": objResult})
}
func UpdateFeasibility(c *gin.Context) {
	var objFeasibility Feasibility
	if err := c.BindJSON(&objFeasibility); err != nil {
		c.IndentedJSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}
	objResult, err := db.Exec("Update info_feasibility SET if_customer = ?, if_import_tran = ?, mrt_id = ?, if_duedate=?,  update_date = ?, update_by = ? WHERE if_id = ?", objFeasibility.If_customer, objFeasibility.If_import_tran, objFeasibility.Mrt_id, objFeasibility.If_duedate, objFeasibility.Update_date, objFeasibility.Update_by, objFeasibility.If_id)
	if err != nil {
		c.IndentedJSON(http.StatusOK, gin.H{
			"Error": err.Error(),
		})
		return
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
