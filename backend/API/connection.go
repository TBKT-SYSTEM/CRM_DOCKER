package API

import (
	"database/sql"

	_ "github.com/go-sql-driver/mysql"
)

var db *sql.DB

func ConnectDb() {
	var err error
	// db, err = sql.Open("mysql", "monty:some_pass@tcp(192.168.161.98:3306)/crm_db_uat")
	db, err = sql.Open("mysql", "monty:some_pass@tcp(192.168.161.98:3306)/crm_db_dev")
	if err != nil {
		panic(err.Error())
	}
	Routy()
}
