package API

type UserExp struct {
	PLANT_CD  string `json:"PLANT_CD"`
	USER_CD   string `json:"USER_CD"`
	USER_NAME string `json:"USER_NAME"`
	PASSWORD  string `json:"PASSWORD"`
	ADDRESS   string `json:"ADDRESS"`
	SEC_CD    string `json:"SEC_CD"`
	SEC_NM    string `json:"SEC_NM"`
}

type SideMenu struct {
	Spg_id   int    `json:"spg_id"`
	Smg_id   int    `json:"smg_id"`
	Smg_name string `json:"smg_name"`
	Smg_icon string `json:"smg_icon"`
	Smd_id   int    `json:"smd_id"`
	Smd_name string `json:"smd_name"`
	Smd_link string `json:"smd_link"`
}

type Log struct {
	La_id          int    `json:"la_id"`
	Su_id          int    `json:"su_id"`
	La_login_date  string `json:"la_login_date"`
	La_logout_date string `json:"la_logout_date"`
}

type UserData struct {
	Data []UserTable `json:"data"`
}
type UserTable struct {
	Su_id       int    `json:"su_id"`
	Su_fname    string `json:"su_fname"`
	Su_lname    string `json:"su_lname"`
	Su_email    string `json:"su_email"`
	Su_emp_code string `json:"su_emp_code"`
	Su_password string `json:"su_password"`
	Su_tel      string `json:"su_tel"`
	Su_img_path string `json:"su_img_path"`
	Su_img_name string `json:"su_img_name"`
	Spg_id      int    `json:"spg_id"`
	Spg_name    string `json:"spg_name"`
	Sd_id       int    `json:"sd_id"`
	Spc_id      int    `json:"spc_id"`
	Su_status   int    `json:"su_status"`
	Create_date string `json:"create_date"`
	Update_date string `json:"update_date"`
	Create_by   string `json:"create_by"`
	Update_by   string `json:"update_by"`
}
type User struct {
	Su_id       int    `json:"su_id"`
	Su_fname    string `json:"su_fname"`
	Su_lname    string `json:"su_lname"`
	Su_email    string `json:"su_email"`
	Su_emp_code string `json:"su_emp_code"`
	Su_password string `json:"su_password"`
	Su_tel      string `json:"su_tel"`
	Su_img_path string `json:"su_img_path"`
	Su_img_name string `json:"su_img_name"`
	Spg_id      int    `json:"spg_id"`
	Sd_id       int    `json:"sd_id"`
	Spc_id      int    `json:"spc_id"`
	Su_status   int    `json:"su_status"`
	Create_date string `json:"create_date"`
	Update_date string `json:"update_date"`
	Create_by   string `json:"create_by"`
	Update_by   string `json:"update_by"`
}
type UserSession struct {
	Su_id       int    `json:"su_id"`
	Su_fname    string `json:"su_fname"`
	Su_lname    string `json:"su_lname"`
	Su_email    string `json:"su_email"`
	Su_emp_code string `json:"su_emp_code"`
	Su_password string `json:"su_password"`
	Su_tel      string `json:"su_tel"`
	Su_img_path string `json:"su_img_path"`
	Su_img_name string `json:"su_img_name"`
	Spg_id      int    `json:"spg_id"`
	Sd_id       int    `json:"sd_id"`
	Spc_id      int    `json:"spc_id"`
	Su_status   int    `json:"su_status"`
	Create_date string `json:"create_date"`
	Update_date string `json:"update_date"`
	Create_by   string `json:"create_by"`
	Update_by   string `json:"update_by"`
	Sd_name     string `json:"sd_name"`
	Spg_name    string `json:"spg_name"`
}

type Signature struct {
	Su_id         int    `json:"su_id"`
	Snt_file_name string `json:"snt_file_name"`
	Snt_file_path string `json:"snt_file_path"`
	Snt_status    int    `json:"snt_status"`
	Create_date   string `json:"create_date"`
	Update_date   string `json:"update_date"`
	Create_by     string `json:"create_by"`
	Update_by     string `json:"update_by"`
}

type PermissionGroupData struct {
	Data []PermissionGroupTable `json:"data"`
}
type PermissionGroupTable struct {
	Spg_id      int    `json:"spg_id"`
	Spg_name    string `json:"spg_name"`
	Spg_status  int    `json:"spg_status"`
	Create_date string `json:"create_date"`
	Update_date string `json:"update_date"`
	Create_by   string `json:"create_by"`
	Update_by   string `json:"update_by"`
	Su_fname    string `json:"su_fname"`
	Su_lname    string `json:"su_lname"`
	Su_img_path string `json:"su_img_path"`
	Su_img_name string `json:"su_img_name"`
}
type PermissionGroup struct {
	Spg_id      int    `json:"spg_id"`
	Spg_name    string `json:"spg_name"`
	Spg_status  int    `json:"spg_status"`
	Create_date string `json:"create_date"`
	Update_date string `json:"update_date"`
	Create_by   string `json:"create_by"`
	Update_by   string `json:"update_by"`
}
type PermissionDetailData struct {
	Data []PermissionDetailTable `json:"data"`
}
type PermissionDetailTable struct {
	Spd_id      int    `json:"spd_id"`
	Spg_id      int    `json:"spg_id"`
	Spd_status  int    `json:"spd_status"`
	Create_date string `json:"create_date"`
	Update_date string `json:"update_date"`
	Create_by   string `json:"create_by"`
	Update_by   string `json:"update_by"`
	Smg_name    string `json:"smg_name"`
	Smg_id      int    `json:"smg_id"`
	Smd_name    string `json:"smd_name"`
	Smd_id      int    `json:"smd_id"`
	Su_fname    string `json:"su_fname"`
	Su_lname    string `json:"su_lname"`
	Su_img_path string `json:"su_img_path"`
	Su_img_name string `json:"su_img_name"`
}
type PermissionDetail struct {
	Spd_id      int    `json:"spd_id"`
	Spg_id      int    `json:"spg_id"`
	Spd_status  int    `json:"spd_status"`
	Create_date string `json:"create_date"`
	Update_date string `json:"update_date"`
	Create_by   string `json:"create_by"`
	Update_by   string `json:"update_by"`
	Smd_name    string `json:"smd_name"`
	Smd_id      int    `json:"smd_id"`
	Order_no    int    `json:"order_no"`
}

type Plant struct {
	Spc_id      int    `json:"spc_id"`
	Spc_code    int    `json:"spc_code"`
	Spc_name    string `json:"spc_name"`
	Spc_status  int    `json:"spc_status"`
	Create_date string `json:"create_date"`
	Update_date string `json:"update_date"`
	Create_by   string `json:"create_by"`
	Update_by   string `json:"update_by"`
}

type MenuGroupData struct {
	Data []MenuGroupTable `json:"data"`
}
type MenuGroupTable struct {
	Smg_id      int    `json:"smg_id"`
	Smg_name    string `json:"smg_name"`
	Smg_icon    string `json:"smg_icon"`
	Smg_order   int    `json:"smg_order"`
	Smg_status  int    `json:"smg_status"`
	Create_date string `json:"create_date"`
	Update_date string `json:"update_date"`
	Create_by   string `json:"create_by"`
	Update_by   string `json:"update_by"`
	Su_fname    string `json:"su_fname"`
	Su_lname    string `json:"su_lname"`
	Su_img_path string `json:"su_img_path"`
	Su_img_name string `json:"su_img_name"`
}
type MenuGroup struct {
	Smg_id      int    `json:"smg_id"`
	Smg_name    string `json:"smg_name"`
	Smg_icon    string `json:"smg_icon"`
	Smg_order   int    `json:"smg_order"`
	Smg_status  int    `json:"smg_status"`
	Create_date string `json:"create_date"`
	Update_date string `json:"update_date"`
	Create_by   string `json:"create_by"`
	Update_by   string `json:"update_by"`
}
type MenuDetail struct {
	Smd_id      int    `json:"smd_id"`
	Smd_name    string `json:"smd_name"`
	Smd_link    string `json:"smd_link"`
	Smg_id      int    `json:"smg_id"`
	Smd_status  int    `json:"smd_status"`
	Create_date string `json:"create_date"`
	Update_date string `json:"update_date"`
	Create_by   string `json:"create_by"`
	Update_by   string `json:"update_by"`
}
type MenuDetailData struct {
	Data []MenuDetailTable `json:"data"`
}
type MenuDetailTable struct {
	Smd_id      int    `json:"smd_id"`
	Smd_name    string `json:"smd_name"`
	Smd_link    string `json:"smd_link"`
	Smg_id      int    `json:"smg_id"`
	Smd_status  int    `json:"smd_status"`
	Create_date string `json:"create_date"`
	Update_date string `json:"update_date"`
	Create_by   string `json:"create_by"`
	Update_by   string `json:"update_by"`
	Su_fname    string `json:"su_fname"`
	Su_lname    string `json:"su_lname"`
	Su_img_path string `json:"su_img_path"`
	Su_img_name string `json:"su_img_name"`
}
type DepartmentData struct {
	Data []DepartmentTable `json:"data"`
}
type DepartmentTable struct {
	Sd_id       int    `json:"sd_id"`
	Sd_name     string `json:"sd_name"`
	Sd_status   int    `json:"sd_status"`
	Create_date string `json:"create_date"`
	Update_date string `json:"update_date"`
	Create_by   string `json:"create_by"`
	Update_by   string `json:"update_by"`
	Su_fname    string `json:"su_fname"`
	Su_lname    string `json:"su_lname"`
	Su_img_path string `json:"su_img_path"`
	Su_img_name string `json:"su_img_name"`
}
type Department struct {
	Sd_id       int    `json:"sd_id"`
	Sd_name     string `json:"sd_name"`
	Sd_status   int    `json:"sd_status"`
	Create_date string `json:"create_date"`
	Update_date string `json:"update_date"`
	Create_by   string `json:"create_by"`
	Update_by   string `json:"update_by"`
}

type FeasibilityData struct {
	Data []FeasibilityTable `json:"data"`
}
type FeasibilityTable struct {
	If_id          int    `json:"if_id"`
	If_ref         string `json:"if_ref"`
	If_customer    string `json:"if_customer"`
	If_import_tran int    `json:"if_import_tran"`
	Mrt_id         int    `json:"mrt_id"`
	If_duedate     string `json:"if_duedate"`
	If_status      int    `json:"if_status"`
	Create_date    string `json:"create_date"`
	Update_date    string `json:"update_date"`
	Create_by      string `json:"create_by"`
	Update_by      string `json:"update_by"`
	Mrt_name       string `json:"mrt_name"`
	Su_fname       string `json:"su_fname"`
	Su_lname       string `json:"su_lname"`
	Su_img_path    string `json:"su_img_path"`
	Su_img_name    string `json:"su_img_name"`
}

type FeasibilityDataHistory struct {
	Data []FeasibilityHistory `json:"data"`
}

type FeasibilityHistory struct {
	If_id           int    `json:"if_id"`
	If_ref          string `json:"if_ref"`
	If_created_date string `json:"if_created_date"`
	If_customer     string `json:"if_customer"`
	Mrt_name        string `json:"mrt_name"`
	Su_fname        string `json:"su_fname"`
	Su_lname        string `json:"su_lname"`
	Su_img_path     string `json:"su_img_path"`
	Su_img_name     string `json:"su_img_name"`
	If_score        string `json:"if_score"`
}
type Feasibility struct {
	If_id          int    `json:"if_id"`
	If_ref         string `json:"if_ref"`
	If_customer    string `json:"if_customer"`
	If_import_tran int    `json:"if_import_tran"`
	If_part_no     string `json:"if_part_no"`
	If_part_name   string `json:"if_part_name"`
	Mrt_id         int    `json:"mrt_id"`
	If_duedate     string `json:"if_duedate"`
	If_status      int    `json:"if_status"`
	Create_date    string `json:"create_date"`
	Update_date    string `json:"update_date"`
	Create_by      string `json:"create_by"`
	Update_by      string `json:"update_by"`
}

type Feasibility1 struct {
	If_id           int                 `json:"if_id"`
	If_doc_no       string              `json:"if_doc_no"`
	If_ref          string              `json:"if_ref"`
	If_customer     string              `json:"if_customer"`
	If_customer_new string              `json:"if_customer_new"`
	If_import_tran  int                 `json:"if_import_tran"`
	If_group_part   []map[string]string `json:"if_group_part"`
	Mrt_id          int                 `json:"mrt_id"`
	If_duedate      string              `json:"if_duedate"`
	If_status       int                 `json:"if_status"`
	Create_date     string              `json:"create_date"`
	Update_date     string              `json:"update_date"`
	Create_by       string              `json:"create_by"`
	Update_by       string              `json:"update_by"`
}

type Rfq struct {
	Ir_id       string `json:"ir_ref"`
	Ir_customer string `json:"ir_customer"`
	Ir_ref_nbc  int    `json:"ir_ref_nbc"`
	Ir_pro_life string `json:"ir_pro_life"`
	Ir_pro_tim  string `json:"ir_sop"`
	Ir_duedate  string `json:"ir_duedate"`
	Ir_status   int    `json:"ir_status"`
	Create_date string `json:"create_date"`
	Update_date string `json:"update_date"`
	Create_by   string `json:"create_by"`
	Update_by   string `json:"update_by"`
}

type RfqData struct {
	Data []RfqTable `json:"data"`
}

type RfqTable struct {
	Ir_id       string `json:"ir_ref"`
	Ir_customer string `json:"ir_customer"`
	Ir_ref_nbc  int    `json:"ir_ref_nbc"`
	Ir_pro_life string `json:"ir_pro_life"`
	Ir_pro_tim  string `json:"ir_sop"`
	Ir_duedate  string `json:"ir_duedate"`
	Ir_status   int    `json:"ir_status"`
	Create_date string `json:"create_date"`
	Update_date string `json:"update_date"`
	Create_by   string `json:"create_by"`
	Update_by   string `json:"update_by"`
	Su_fname    string `json:"su_fname"`
	Su_lname    string `json:"su_lname"`
	Su_img_path string `json:"su_img_path"`
	Su_img_name string `json:"su_img_name"`
}

type GetRfqFileByIdData struct {
	Data []GetRfqFileById `json:"data"`
}
type GetRfqFileById struct {
	Sfu_id        int    `json:"sfu_id"`
	Sfu_file_name string `json:"sfu_file_name"`
	Sfu_file_path string `json:"sfu_file_path"`
}

type GetBtnRfqData struct {
	Data []GetBtnRfq `json:"data"`
}
type GetBtnRfq struct {
	Swd_id     int    `json:"swd_id"`
	Swd_app_lv int    `json:"swd_app_lv"`
	Su_id      int    `json:"su_id"`
	Swg_id     int    `json:"swg_id"`
	Sat_id     int    `json:"sat_id"`
	Su_fname   string `json:"su_fname"`
	Su_lname   string `json:"su_lname"`
	Swg_name   string `json:"swg_name"`
	Sat_name   string `json:"sat_name"`
}

type GroupPartNo struct {
	Ifpn_id  int    `json:"ifpn_id"`
	PartNo   string `json:"partNo"`
	PartName string `json:"partName"`
}

type GetLastID struct {
	Last_id int `json:"last_id"`
}
type ManageFeasibilityData struct {
	Data []ManageFeasibilityTable `json:"data"`
}
type ManageFeasibilityTable struct {
	Ifcp_id        int     `json:"ifcp_id"`
	If_id          int     `json:"if_id"`
	Mc_id          int     `json:"mc_id"`
	Ifcp_score     float64 `json:"ifcp_score"`
	Ifcp_comment   string  `json:"ifcp_comment"`
	Ifcp_file_name string  `json:"ifcp_file_name"`
	Ifcp_file_path string  `json:"ifcp_file_path"`
	Ifcp_submit    int     `json:"ifcp_submit"`
	Ifcp_status    int     `json:"ifcp_status"`
	Create_date    string  `json:"create_date"`
	Update_date    string  `json:"update_date"`
	Create_by      string  `json:"create_by"`
	Update_by      string  `json:"update_by"`
	If_customer    string  `json:"if_customer"`
	If_part_no     string  `json:"if_part_no"`
	If_part_name   string  `json:"if_part_name"`
	If_duedate     string  `json:"if_duedate"`
	Sd_id          int     `json:"sd_id"`
	Su_fname       string  `json:"su_fname"`
	Su_lname       string  `json:"su_lname"`
	Su_img_path    string  `json:"su_img_path"`
	Su_img_name    string  `json:"su_img_name"`
}
type ManageFeasibility struct {
	Ifcp_id        int     `json:"ifcp_id"`
	If_id          int     `json:"if_id"`
	Mc_id          int     `json:"mc_id"`
	Ifcp_score     float64 `json:"ifcp_score"`
	Ifcp_comment   string  `json:"ifcp_comment"`
	Ifcp_file_name string  `json:"ifcp_file_name"`
	Ifcp_file_path string  `json:"ifcp_file_path"`
	Ifcp_submit    int     `json:"ifcp_submit"`
	Ifcp_status    int     `json:"ifcp_status"`
	Create_date    string  `json:"create_date"`
	Update_date    string  `json:"update_date"`
	Create_by      string  `json:"create_by"`
	Update_by      string  `json:"update_by"`
}

type RequirementType struct {
	Mrt_id      int    `json:"mrt_id"`
	Mrt_name    string `json:"mrt_name"`
	Mrt_status  int    `json:"mrt_status"`
	Create_date string `json:"create_date"`
	Update_date string `json:"update_date"`
	Create_by   string `json:"create_by"`
	Update_by   string `json:"update_by"`
}

type RequirementCus struct {
	Mct_id      int    `json:"mct_id"`
	Mct_name    string `json:"mct_name"`
	Mct_status  int    `json:"mct_status"`
	Create_date string `json:"create_date"`
	Update_date string `json:"update_date"`
	Create_by   string `json:"create_by"`
	Update_by   string `json:"update_by"`
}

type WorkflowGroupData struct {
	Data []WorkflowGroupTable `json:"data"`
}
type WorkflowGroupTable struct {
	Swg_id      int    `json:"swg_id"`
	Swg_name    string `json:"swg_name"`
	Swg_max_lv  int    `json:"swg_max_lv"`
	Swg_status  int    `json:"swg_status"`
	Create_date string `json:"create_date"`
	Update_date string `json:"update_date"`
	Create_by   string `json:"create_by"`
	Update_by   string `json:"update_by"`
	Su_fname    string `json:"su_fname"`
	Su_lname    string `json:"su_lname"`
	Su_img_path string `json:"su_img_path"`
	Su_img_name string `json:"su_img_name"`
}
type WorkflowGroup struct {
	Swg_id      int    `json:"swg_id"`
	Swg_name    string `json:"swg_name"`
	Swg_max_lv  int    `json:"swg_max_lv"`
	Swg_status  int    `json:"swg_status"`
	Create_date string `json:"create_date"`
	Update_date string `json:"update_date"`
	Create_by   string `json:"create_by"`
	Update_by   string `json:"update_by"`
}
type WorkflowDetailData struct {
	Data []WorkflowDetailTable `json:"data"`
}
type WorkflowDetailTable struct {
	Swd_id      int    `json:"swd_id"`
	Swd_app_lv  int    `json:"swd_app_lv"`
	Su_id       int    `json:"su_id"`
	Swg_id      int    `json:"swg_id"`
	Sat_id      int    `json:"sat_id"`
	Swd_status  int    `json:"swd_status"`
	Create_date string `json:"create_date"`
	Update_date string `json:"update_date"`
	Create_by   string `json:"create_by"`
	Update_by   string `json:"update_by"`
	Fullname    string `json:"fullname"`
	Swg_name    string `json:"swg_name"`
	Sat_name    string `json:"sat_name"`
	Su_fname    string `json:"su_fname"`
	Su_lname    string `json:"su_lname"`
	Su_img_path string `json:"su_img_path"`
	Su_img_name string `json:"su_img_name"`
}
type WorkflowDetail struct {
	Swd_id      int    `json:"swd_id"`
	Swd_app_lv  int    `json:"swd_app_lv"`
	Su_id       int    `json:"su_id"`
	Swg_id      int    `json:"swg_id"`
	Sat_id      int    `json:"sat_id"`
	Swd_status  int    `json:"swd_status"`
	Create_date string `json:"create_date"`
	Update_date string `json:"update_date"`
	Create_by   string `json:"create_by"`
	Update_by   string `json:"update_by"`
}
type ApproveType struct {
	Sat_id      int    `json:"sat_id"`
	Sat_name    string `json:"sat_name"`
	Sat_status  int    `json:"sat_status"`
	Create_date string `json:"create_date"`
	Update_date string `json:"update_date"`
	Create_by   string `json:"create_by"`
	Update_by   string `json:"update_by"`
}
type ConsiderationData struct {
	Data []ConsiderationTable `json:"data"`
}
type ConsiderationTable struct {
	Mc_id       int     `json:"mc_id"`
	Mc_title    string  `json:"mc_title"`
	Mc_weight   float64 `json:"mc_weight"`
	Mc_status   int     `json:"mc_status"`
	Create_date string  `json:"create_date"`
	Update_date string  `json:"update_date"`
	Create_by   string  `json:"create_by"`
	Update_by   string  `json:"update_by"`
	Su_fname    string  `json:"su_fname"`
	Su_lname    string  `json:"su_lname"`
	Su_img_path string  `json:"su_img_path"`
	Su_img_name string  `json:"su_img_name"`
}
type Consideration struct {
	Mc_id       int     `json:"mc_id"`
	Mc_title    string  `json:"mc_title"`
	Mc_weight   float64 `json:"mc_weight"`
	Mc_status   int     `json:"mc_status"`
	Create_date string  `json:"create_date"`
	Update_date string  `json:"update_date"`
	Create_by   string  `json:"create_by"`
	Update_by   string  `json:"update_by"`
}
type ConsiderationCount struct {
	Mc_id int `json:"mc_id"`
}

type ConsiderInchargeData struct {
	Data []ConsiderInchargeTable `json:"data"`
}
type ConsiderInchargeTable struct {
	Mci_id      int    `json:"mci_id"`
	Mc_id       int    `json:"mc_id"`
	Sd_id       int    `json:"sd_id"`
	Mci_status  int    `json:"mci_status"`
	Create_date string `json:"create_date"`
	Update_date string `json:"update_date"`
	Create_by   string `json:"create_by"`
	Update_by   string `json:"update_by"`
	Mc_title    string `json:"mc_title"`
	Sd_name     string `json:"sd_name"`
	Su_fname    string `json:"su_fname"`
	Su_lname    string `json:"su_lname"`
	Su_img_path string `json:"su_img_path"`
	Su_img_name string `json:"su_img_name"`
}
type ConsiderIncharge struct {
	Mci_id      int    `json:"mci_id"`
	Mc_id       int    `json:"mc_id"`
	Sd_id       int    `json:"sd_id"`
	Mci_status  int    `json:"mci_status"`
	Create_date string `json:"create_date"`
	Update_date string `json:"update_date"`
	Create_by   string `json:"create_by"`
	Update_by   string `json:"update_by"`
}

type GetPartNoByIdData struct {
	Data []GetPartNoById `json:"data"`
}
type GetPartNoById struct {
	Ifpn_id  int    `json:"ifpn_id"`
	PartNo   string `json:"partNo"`
	PartName string `json:"partName"`
}

type ViewFeasibilityScore struct {
	Mc_id          int     `json:"mc_id"`
	Mc_title       string  `json:"mc_title"`
	Mc_weight      float64 `json:"mc_weight"`
	Mc_status      int     `json:"mc_status"`
	Create_date    string  `json:"create_date"`
	Update_date    string  `json:"update_date"`
	Create_by      string  `json:"create_by"`
	Update_by      string  `json:"update_by"`
	Ifcp_score     float64 `json:"ifcp_score"`
	Ifcp_comment   string  `json:"ifcp_comment"`
	Ifcp_file_name string  `json:"ifcp_file_name"`
	Ifcp_file_path string  `json:"ifcp_file_path"`
	Ifcp_submit    int     `json:"ifcp_submit"`
}
type InchargeDepartment struct {
	Mci_id      int    `json:"mci_id"`
	Mc_id       int    `json:"mc_id"`
	Sd_id       int    `json:"sd_id"`
	Mci_status  int    `json:"mci_status"`
	Create_date string `json:"create_date"`
	Update_date string `json:"update_date"`
	Create_by   string `json:"create_by"`
	Update_by   string `json:"update_by"`
	Sd_name     string `json:"sd_name"`
}
