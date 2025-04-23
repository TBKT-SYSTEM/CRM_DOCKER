package API

import (

	// "encoding/json"
	// "github.com/go-resty/resty/v2"

	"fmt"
	"net/http"
	"time"

	"github.com/gin-gonic/gin"
	_ "github.com/go-sql-driver/mysql"
)

func GetDone(c *gin.Context) {
	year := c.Param("year")
	var data []int
	dataDoc := make(map[string]interface{})

	query := "SELECT COALESCE(COUNT(d.idc_id), 0) AS datas FROM (SELECT '2025-01' AS month UNION ALL SELECT '2025-02' UNION ALL SELECT '2025-03' UNION ALL SELECT '2025-04' UNION ALL SELECT '2025-05' UNION ALL SELECT '2025-06' UNION ALL SELECT '2025-07' UNION ALL SELECT '2025-08' UNION ALL SELECT '2025-09' UNION ALL SELECT '2025-10' UNION ALL SELECT '2025-11' UNION ALL SELECT '2025-12') AS months LEFT JOIN info_document_control d ON DATE_FORMAT(d.idc_created_date, '%Y-%m') = months.month AND d.idc_status = 9 AND d.mdt_id = 3 AND d.idc_issue_year = ? GROUP BY months.month ORDER BY months.month"
	rows, err := db.Query(query, year)
	if err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": "Database query error"})
		return
	}
	defer rows.Close()

	for rows.Next() {
		var count int
		if err := rows.Scan(&count); err != nil {
			c.JSON(http.StatusInternalServerError, gin.H{"error": "Database scan error"})
			return
		}
		data = append(data, count)
	}

	if err = rows.Err(); err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": "Database error"})
		return
	}

	for i := 0; i < 12; i++ {
		formatted := fmt.Sprintf("%02d", i+1)
		key := fmt.Sprintf("DocYear%d", i+1)

		getDocno := `SELECT idc_running_no, idc_customer_name, idc_created_date, idc_closing_date FROM info_document_control 
					 WHERE idc_issue_year = ? AND mdt_id = 3 AND idc_status = 9 AND idc_issue_month = ?`
		rows, err := db.Query(getDocno, year, formatted)
		if err != nil {
			c.JSON(http.StatusInternalServerError, gin.H{"error": "Query error"})
			return
		}
		defer rows.Close()

		docList := []map[string]string{}
		for rows.Next() {
			var runningNo, customerName, createdDate, closingDate string
			if err := rows.Scan(&runningNo, &customerName, &createdDate, &closingDate); err != nil {
				c.JSON(http.StatusInternalServerError, gin.H{"error": "Scan error"})
				return
			}

			t, _ := time.Parse("2006-01-02 15:04:05", createdDate)
			createdDate = t.Format("2006-01-02")

			docList = append(docList, map[string]string{
				"runningNo":    runningNo,
				"customerName": customerName,
				"createdDate":  createdDate,
				"closingDate":  closingDate,
			})
		}
		dataDoc[key] = docList
	}

	c.JSON(http.StatusOK, gin.H{
		"data":  data,
		"docNo": dataDoc,
	})
}
func GetPending(c *gin.Context) {
	var data []int
	dataDoc := make(map[string]interface{})
	year := c.Param("year")

	query := "SELECT COALESCE(COUNT(d.idc_id), 0) AS datas FROM (SELECT '2025-01' AS month UNION ALL SELECT '2025-02' UNION ALL SELECT '2025-03' UNION ALL SELECT '2025-04' UNION ALL SELECT '2025-05' UNION ALL SELECT '2025-06' UNION ALL SELECT '2025-07' UNION ALL SELECT '2025-08' UNION ALL SELECT '2025-09' UNION ALL SELECT '2025-10' UNION ALL SELECT '2025-11' UNION ALL SELECT '2025-12') AS months LEFT JOIN info_document_control d ON DATE_FORMAT(d.idc_created_date, '%Y-%m') = months.month AND d.idc_status = 2 AND d.mdt_id = 3 AND d.idc_closing_date >= CURDATE() AND d.idc_issue_year = ? GROUP BY months.month ORDER BY months.month"
	rows, err := db.Query(query, year)
	if err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": "Database query error"})
		return
	}
	defer rows.Close()

	for rows.Next() {
		var count int
		if err := rows.Scan(&count); err != nil {
			c.JSON(http.StatusInternalServerError, gin.H{"error": "Database scan error"})
			return
		}
		data = append(data, count)
	}

	if err = rows.Err(); err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": "Database error"})
		return
	}

	for i := 0; i < 12; i++ {
		formatted := fmt.Sprintf("%02d", i+1)
		key := fmt.Sprintf("DocYear%d", i+1)

		getDocno := `SELECT idc_running_no, idc_customer_name, idc_created_date, idc_closing_date FROM info_document_control 
					 WHERE idc_issue_year = ? AND mdt_id = 3 AND idc_status = 2 AND idc_issue_month = ? AND idc_closing_date >= CURDATE()`
		rows, err := db.Query(getDocno, year, formatted)
		if err != nil {
			c.JSON(http.StatusInternalServerError, gin.H{"error": "Query error"})
			return
		}
		defer rows.Close()

		docList := []map[string]string{}
		for rows.Next() {
			var runningNo, customerName, createdDate, closingDate string
			if err := rows.Scan(&runningNo, &customerName, &createdDate, &closingDate); err != nil {
				c.JSON(http.StatusInternalServerError, gin.H{"error": "Scan error"})
				return
			}

			t, _ := time.Parse("2006-01-02 15:04:05", createdDate)
			createdDate = t.Format("2006-01-02")

			docList = append(docList, map[string]string{
				"runningNo":    runningNo,
				"customerName": customerName,
				"createdDate":  createdDate,
				"closingDate":  closingDate,
			})
		}
		dataDoc[key] = docList
	}

	c.JSON(http.StatusOK, gin.H{
		"data":  data,
		"docNo": dataDoc,
	})

}
func GetDelay(c *gin.Context) {
	year := c.Param("year")
	var data []int
	dataDoc := make(map[string]interface{})

	query := "SELECT COALESCE(COUNT(d.idc_id), 0) AS datas FROM (SELECT '2025-01' AS month UNION ALL SELECT '2025-02' UNION ALL SELECT '2025-03' UNION ALL SELECT '2025-04' UNION ALL SELECT '2025-05' UNION ALL SELECT '2025-06' UNION ALL SELECT '2025-07' UNION ALL SELECT '2025-08' UNION ALL SELECT '2025-09' UNION ALL SELECT '2025-10' UNION ALL SELECT '2025-11' UNION ALL SELECT '2025-12') AS months LEFT JOIN info_document_control d ON DATE_FORMAT(d.idc_created_date, '%Y-%m') = months.month AND d.idc_status = 2 AND d.mdt_id = 3 AND d.idc_closing_date < CURDATE() AND d.idc_issue_year = ? GROUP BY months.month ORDER BY months.month"
	rows, err := db.Query(query, year)
	if err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": "Database query error"})
		return
	}
	defer rows.Close()

	for rows.Next() {
		var count int
		if err := rows.Scan(&count); err != nil {
			c.JSON(http.StatusInternalServerError, gin.H{"error": "Database scan error"})
			return
		}
		data = append(data, count)
	}

	if err = rows.Err(); err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": "Database error"})
		return
	}

	for i := 0; i < 12; i++ {
		formatted := fmt.Sprintf("%02d", i+1)
		key := fmt.Sprintf("DocYear%d", i+1)

		getDocno := `SELECT idc_running_no, idc_customer_name, idc_created_date, idc_closing_date FROM info_document_control 
					 WHERE idc_issue_year = ? AND mdt_id = 3 AND idc_status = 2 AND idc_issue_month = ? AND idc_closing_date <= CURDATE()`
		rows, err := db.Query(getDocno, year, formatted)
		if err != nil {
			c.JSON(http.StatusInternalServerError, gin.H{"error": "Query error"})
			return
		}
		defer rows.Close()

		docList := []map[string]string{}
		for rows.Next() {
			var runningNo, customerName, createdDate, closingDate string
			if err := rows.Scan(&runningNo, &customerName, &createdDate, &closingDate); err != nil {
				c.JSON(http.StatusInternalServerError, gin.H{"error": "Scan error"})
				return
			}

			t, _ := time.Parse("2006-01-02 15:04:05", createdDate)
			createdDate = t.Format("2006-01-02")

			docList = append(docList, map[string]string{
				"runningNo":    runningNo,
				"customerName": customerName,
				"createdDate":  createdDate,
				"closingDate":  closingDate,
			})
		}
		dataDoc[key] = docList
	}

	c.JSON(http.StatusOK, gin.H{
		"data":  data,
		"docNo": dataDoc,
	})
}
func GetCancel(c *gin.Context) {
	year := c.Param("year")
	var data []int
	dataDoc := make(map[string]interface{})

	query := "SELECT COALESCE(COUNT(d.idc_id), 0) AS datas FROM (SELECT '2025-01' AS month UNION ALL SELECT '2025-02' UNION ALL SELECT '2025-03' UNION ALL SELECT '2025-04' UNION ALL SELECT '2025-05' UNION ALL SELECT '2025-06' UNION ALL SELECT '2025-07' UNION ALL SELECT '2025-08' UNION ALL SELECT '2025-09' UNION ALL SELECT '2025-10' UNION ALL SELECT '2025-11' UNION ALL SELECT '2025-12') AS months LEFT JOIN info_document_control d ON DATE_FORMAT(d.idc_created_date, '%Y-%m') = months.month AND d.idc_status = 5 AND d.mdt_id = 3 AND d.idc_issue_year = ? GROUP BY months.month ORDER BY months.month"
	rows, err := db.Query(query, year)
	if err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": "Database query error"})
		return
	}
	defer rows.Close()

	for rows.Next() {
		var count int
		if err := rows.Scan(&count); err != nil {
			c.JSON(http.StatusInternalServerError, gin.H{"error": "Database scan error"})
			return
		}
		data = append(data, count)
	}

	if err = rows.Err(); err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": "Database error"})
		return
	}

	for i := 0; i < 12; i++ {
		formatted := fmt.Sprintf("%02d", i+1)
		key := fmt.Sprintf("DocYear%d", i+1)

		getDocno := `SELECT idc_running_no, idc_customer_name, idc_created_date, idc_closing_date FROM info_document_control 
					 WHERE idc_issue_year = ? AND mdt_id = 3 AND idc_status = 5 AND idc_issue_month = ?`
		rows, err := db.Query(getDocno, year, formatted)
		if err != nil {
			c.JSON(http.StatusInternalServerError, gin.H{"error": "Query error"})
			return
		}
		defer rows.Close()

		docList := []map[string]string{}
		for rows.Next() {
			var runningNo, customerName, createdDate, closingDate string
			if err := rows.Scan(&runningNo, &customerName, &createdDate, &closingDate); err != nil {
				c.JSON(http.StatusInternalServerError, gin.H{"error": "Scan error"})
				return
			}

			t, _ := time.Parse("2006-01-02 15:04:05", createdDate)
			createdDate = t.Format("2006-01-02")

			docList = append(docList, map[string]string{
				"runningNo":    runningNo,
				"customerName": customerName,
				"createdDate":  createdDate,
				"closingDate":  closingDate,
			})
		}
		dataDoc[key] = docList
	}

	c.JSON(http.StatusOK, gin.H{
		"data":  data,
		"docNo": dataDoc,
	})

}
func GetCustomer(c *gin.Context) {
	year := c.Param("year")
	type Customer struct {
		CustomerName string   `json:"idc_customer_name"`
		Cancel       int      `json:"cancel"`
		CancelList   []string `json:"cancel_list"`
		Delay        int      `json:"delay"`
		DelayList    []string `json:"delay_list"`
		Pending      int      `json:"pending"`
		PendingList  []string `json:"pending_list"`
		Done         int      `json:"done"`
		DoneList     []string `json:"done_list"`
	}

	query := "SELECT idc.idc_customer_name, SUM(CASE WHEN idc_status = 5 THEN 1 ELSE 0 END) AS cancel, SUM(CASE WHEN idc_closing_date < CURDATE() AND idc_status = 2 THEN 1 ELSE 0 END) AS delay, SUM(CASE WHEN idc_closing_date >= CURDATE() AND idc_status = 2 THEN 1 ELSE 0 END) AS pending, SUM(CASE WHEN idc.idc_status = 9 THEN 1 ELSE 0 END) AS done FROM info_document_control idc WHERE idc.mdt_id = 3 AND idc.idc_issue_year = ? GROUP BY idc.idc_customer_name"
	rows, err := db.Query(query, year)
	if err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": "Database query error"})
		return
	}
	defer rows.Close()

	var data []Customer

	for rows.Next() {
		var customer Customer
		if err := rows.Scan(&customer.CustomerName, &customer.Cancel, &customer.Delay, &customer.Pending, &customer.Done); err != nil {
			c.JSON(http.StatusInternalServerError, gin.H{"error": "scan error"})
			return
		}

		customer.CancelList = getRunningNoList(customer.CustomerName, year, 5, "")
		customer.DelayList = getRunningNoList(customer.CustomerName, year, 2, "AND idc_closing_date < CURDATE()")
		customer.PendingList = getRunningNoList(customer.CustomerName, year, 2, "AND idc_closing_date >= CURDATE()")
		customer.DoneList = getRunningNoList(customer.CustomerName, year, 9, "")

		data = append(data, customer)
	}

	if err = rows.Err(); err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": "Database error"})
		return
	}

	c.JSON(http.StatusOK, gin.H{"data": data})
}
func getRunningNoList(customerName string, year string, status int, condition string) []string {
	query := fmt.Sprintf(`
		SELECT idc_running_no 
		FROM info_document_control 
		WHERE mdt_id = 3 
		  AND idc_issue_year = ? 
		  AND idc_customer_name = ? 
		  AND idc_status = ? %s
	`, condition)

	rows, err := db.Query(query, year, customerName, status)
	if err != nil {
		return []string{}
	}
	defer rows.Close()

	var list []string
	for rows.Next() {
		var runningNo string
		if err := rows.Scan(&runningNo); err == nil {
			list = append(list, runningNo)
		}
	}
	return list
}

func GetDocDelay(c *gin.Context) {
	type DocumentStatus struct {
		Name        string      `json:"name"`
		Dept        string      `json:"dept"`
		StatusType  string      `json:"status_type"`
		DueDate     interface{} `json:"duedate"`
		Su_username string      `json:"su_username"`
	}

	DocNo := c.Param("docNo")

	getCreated := `SELECT CONCAT('K. ', su.su_firstname) AS name, sd.sd_dept_aname AS dept, 'DONE' AS status_type, DATE_FORMAT(idc.idc_created_date, '%e %b %Y') AS duedate, su.su_username FROM info_document_control idc LEFT JOIN sys_users su ON su.su_username = idc.idc_created_by LEFT JOIN sys_department sd ON sd.sd_id = su.sd_id WHERE idc.idc_running_no = ?`

	rows, err := db.Query(getCreated, DocNo)
	if err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": "query error"})
		return
	}
	defer rows.Close()

	var results []DocumentStatus

	for rows.Next() {
		var item DocumentStatus
		var duedateRaw []byte

		if err := rows.Scan(&item.Name, &item.Dept, &item.StatusType, &duedateRaw, &item.Su_username); err != nil {
			c.JSON(http.StatusInternalServerError, gin.H{"error": "scan error"})
			return
		}

		item.DueDate = string(duedateRaw)

		results = append(results, item)
	}

	query := `SELECT CONCAT('K. ', su.su_firstname) AS name, sd_dept_aname AS dept, CASE WHEN ida.ida_status = 9 OR ida.ida_updated_date < idc.idc_closing_date THEN 'DONE' ELSE 'DELAYED' END AS status_type, CASE WHEN ida.ida_status = 9 OR ida.ida_updated_date < idc.idc_closing_date THEN DATE_FORMAT(ida.ida_updated_date, '%e %b %Y')  ELSE DATEDIFF(CURDATE(), idc.idc_closing_date) END AS duedate, su.su_username FROM info_document_approval ida LEFT JOIN sys_users su ON su.su_id = ida.su_id LEFT JOIN info_document_control idc ON idc.idc_id = ida.idc_id LEFT JOIN sys_department sd ON sd.sd_id = su.sd_id WHERE idc.idc_running_no = ? ORDER BY ida.ida_id`

	rows, err = db.Query(query, DocNo)
	if err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": "query error"})
		return
	}
	defer rows.Close()

	for rows.Next() {
		var item DocumentStatus
		var duedateRaw []byte

		if err := rows.Scan(&item.Name, &item.Dept, &item.StatusType, &duedateRaw, &item.Su_username); err != nil {
			c.JSON(http.StatusInternalServerError, gin.H{"error": "scan error"})
			return
		}

		item.DueDate = string(duedateRaw)

		results = append(results, item)
	}

	c.JSON(http.StatusOK, gin.H{"Data": results})
}
func GetDocPending(c *gin.Context) {
	type DocumentStatus struct {
		Name        string      `json:"name"`
		Dept        string      `json:"dept"`
		StatusType  string      `json:"status_type"`
		DueDate     interface{} `json:"duedate"`
		Su_username string      `json:"su_username"`
	}

	DocNo := c.Param("docNo")

	getCreated := ` SELECT CONCAT('K. ', su.su_firstname) AS name, sd.sd_dept_aname AS dept, 'DONE' AS status_type, DATE_FORMAT(idc.idc_created_date, '%e %b %Y') AS duedate, su.su_username FROM info_document_control idc LEFT JOIN sys_users su ON su.su_username = idc.idc_created_by LEFT JOIN sys_department sd ON sd.sd_id = su.sd_id WHERE idc.idc_running_no = ?`

	rows, err := db.Query(getCreated, DocNo)
	if err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": "query error"})
		return
	}
	defer rows.Close()

	var results []DocumentStatus

	for rows.Next() {
		var item DocumentStatus
		var duedateRaw []byte

		if err := rows.Scan(&item.Name, &item.Dept, &item.StatusType, &duedateRaw, &item.Su_username); err != nil {
			c.JSON(http.StatusInternalServerError, gin.H{"error": "scan error"})
			return
		}

		item.DueDate = string(duedateRaw)

		results = append(results, item)
	}

	query := `SELECT CONCAT('K. ', su.su_firstname) AS name, sd_dept_aname AS dept, CASE WHEN ida.ida_status = 9 AND ida.ida_action = 1 THEN 'DONE' ELSE 'WAITING' END AS status_type, CASE WHEN ida.ida_status = 9 AND ida.ida_action = 1 THEN DATE_FORMAT(ida.ida_updated_date, '%e %b %Y') ELSE DATEDIFF(idc.idc_closing_date, CURDATE()) END AS duedate, su.su_username FROM info_document_approval ida LEFT JOIN sys_users su ON su.su_id = ida.su_id LEFT JOIN info_document_control idc ON idc.idc_id = ida.idc_id LEFT JOIN sys_department sd ON sd.sd_id = su.sd_id WHERE idc.idc_running_no = ? ORDER BY ida.ida_id`

	rows, err = db.Query(query, DocNo)
	if err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": "query error"})
		return
	}
	defer rows.Close()

	for rows.Next() {
		var item DocumentStatus
		var duedateRaw []byte

		if err := rows.Scan(&item.Name, &item.Dept, &item.StatusType, &duedateRaw, &item.Su_username); err != nil {
			c.JSON(http.StatusInternalServerError, gin.H{"error": "scan error"})
			return
		}

		item.DueDate = string(duedateRaw)

		results = append(results, item)
	}

	c.JSON(http.StatusOK, gin.H{"Data": results})
}
func GetDate(c *gin.Context) {
	type DocumentStatus struct {
		CreatedDate string `json:"idc_created_date"`
		ClosingDate string `json:"idc_closing_date"`
	}

	DocNo := c.Param("docNo")

	getCreated := `SELECT DATE_FORMAT(idc_created_date, '%e %b %Y') AS idc_created_date, DATE_FORMAT(idc_closing_date, '%e %b %Y') AS idc_closing_date FROM info_document_control WHERE idc_running_no = ?`

	rows, err := db.Query(getCreated, DocNo)
	if err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": "query error"})
		return
	}
	defer rows.Close()

	var results []DocumentStatus

	for rows.Next() {
		var item DocumentStatus
		if err := rows.Scan(&item.CreatedDate, &item.ClosingDate); err != nil {
			c.JSON(http.StatusInternalServerError, gin.H{"error": "scan error"})
			return
		}
		results = append(results, item)
	}

	c.JSON(http.StatusOK, gin.H{"Data": results})
}
