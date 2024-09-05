package API

import (
	"github.com/gin-contrib/cors"
	"github.com/gin-gonic/gin"
)

func Routy() {
	router := gin.Default()
	router.Use(cors.Default())

	router.POST("/login/login", Login)
	router.POST("/login/username_unique", UsernameIsUnique)
	router.POST("/log/login", LogLogin)
	router.POST("/log/logout", LogLogout)

	router.GET("/user/:id", ListUserById)
	router.GET("/user/table", ListUserTable)
	router.GET("/user/table2", ListUserTable2)
	router.POST("/user/emp_code_unique", UserIsUnique)
	router.POST("/user/insert", InsertUser)
	router.PUT("/user/update", UpdateUser)
	router.PUT("/user/change_status", ChangeUserStatus)
	router.PUT("/setting/user", SettingUser)
	router.PUT("/setting/password", SettingPassword)
	router.POST("/update/signature", UpdateSignature)

	router.GET("/spg_table", ListSpgTable)
	router.POST("/spg_table/insert", InsertSpg)
	router.PUT("/spg_table/update", UpdateSpg)
	router.POST("/spg_table/is_unique", SpgIsUnique)
	router.PUT("/spg_table/change_status", ChangeSpgStatus)

	router.GET("/spd_table/:id", ListSpdTable)
	router.POST("/spd_table/is_unique", SpdIsUnique)
	router.POST("/spd_table/insert", InsertSpd)
	router.PUT("/spd_table/update", UpdateSpd)
	router.PUT("/spd_table/change_status", ChangeSpdStatus)

	router.GET("/menu_group/table", ListMenuGroupTable)
	router.POST("/menu_group/is_unique", SmgIsUnique)
	router.POST("/menu_group/insert", InsertSmg)
	router.PUT("/menu_group/update", UpdateSmg)
	router.PUT("/menu_group/change_status", ChangeSmgStatus)

	router.GET("/menu_detail/table/:id", ListMenuDetailTable)
	router.POST("/menu_detail/is_unique", SmdIsUnique)
	router.POST("/menu_detail/insert", InsertSmd)
	router.PUT("/menu_detail/update", UpdateSmd)
	router.PUT("/menu_detail/change_status", ChangeSmdStatus)

	router.GET("/department/table", ListDepartmentTable)
	router.POST("/department/is_unique", SdIsUnique)
	router.POST("/department/insert", InsertSd)
	router.PUT("/department/update", UpdateSd)
	router.PUT("/department/change_status", ChangeSdStatus)

	router.GET("/workflow_group/table", ListWorkflowGroupTable)
	router.GET("/workflow_group/:id", ListWorkflowGroupById)
	router.POST("/workflow_group/is_unique", SwgIsUnique)
	router.POST("/workflow_group/insert", InsertSwg)
	router.PUT("/workflow_group/update", UpdateSwg)
	router.PUT("/workflow_group/change_status", ChangeSwgStatus)

	router.GET("/workflow_detail/table/:id", ListWorkflowDetailTable)
	router.POST("/workflow_detail/is_unique", SwdIsUnique)
	router.POST("/workflow_detail/insert", InsertSwd)
	router.PUT("/workflow_detail/update", UpdateSwd)
	router.PUT("/workflow_detail/change_status", ChangeSwdStatus)

	router.GET("/feasibility/:id", ListFeasibility)
	router.GET("/feasibility/table", ListFeasibilityTable)
	router.GET("/feasibility/last_id", FeasibilityLastid)
	router.POST("/feasibility/insert", InsertFeasibility)
	router.PUT("/feasibility/update", UpdateFeasibility)
	router.PUT("/feasibility/update_partno", UpdatePartNoFeasibility)
	router.PUT("/feasibility/change_status", ChangeFeasibilityStatus)

	router.GET("/feasibilityHistory/table", ListFeasibilityTableHistory)
	router.GET("/feasibilityHistory/tableDate/:date", ListFeasibilityTableHistoryDate)

	router.GET("/manage_feasibility/table/:id", ListManageFeasibilityTable)
	router.PUT("/manage_feasibility/scoring", UpdateFeasibilityScore)
	router.PUT("/manage_feasibility/commenting", UpdateFeasibilityComment)
	router.PUT("/manage_feasibility/file", UpdateFeasibilityFile)
	router.PUT("/manage_feasibility/submit", UpdateFeasibilitySubmit)

	router.GET("/consideration/table", ListConsiderationTable)
	router.POST("/consideration/insert", InsertConsideration)
	router.PUT("/consideration/update", UpdateConsideration)
	router.PUT("/consideration/change_status", ChangeConsiderationStatus)

	router.GET("/incharge/table", ListInchargeTable)
	router.POST("/incharge/is_unique", InchargeIsUnique)
	router.POST("/incharge/insert", InsertIncharge)
	router.PUT("/incharge/update", UpdateIncharge)
	router.PUT("/incharge/change_status", ChangeInchargeStatus)

	router.GET("/side_menu/side_menuGroup/:id", SideMenuGroup)
	router.GET("/side_menu/side_menuDetail/:id", SideMenuDetail)

	router.GET("/option/list_plant", ListPlant)
	router.GET("/option/list_spg", ListPermissionGroup)
	router.GET("/option/list_smg", ListMenuGroup)
	router.GET("/option/list_smd", ListMenuDetail)
	router.GET("/option/list_smd/:id", ListMenuDetailById)
	router.GET("/option/list_swg", ListWorkflowGroup)
	router.GET("/option/list_mrt", ListRequirementType)
	router.GET("/option/list_user", ListUsers)
	router.GET("/option/list_approve_type", ListApproveType)
	router.GET("/option/list_department", ListDepartment)
	router.GET("/option/list_mc", ListConsideration)

	router.GET("/view/feas_score/:id", ListConsiderationScore)
	router.GET("/view/in_dept", ListIncharge)
	router.GET("/view/scorable/:if/:sd", ListInchargeScorable)
	router.GET("/view/partno/:id", ListPartNoById)

	router.GET("/notify", LineNotify)
	router.POST("/email/userdata", EmailUserData)

	router.Run(":8080")
	// router.Run("192.168.161.219:9002")
}
