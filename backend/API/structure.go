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
	Su_id           int    `json:"su_id"`
	Spg_id          int    `json:"spg_id"`
	Su_username     string `json:"su_username"`
	Su_password     string `json:"su_password"`
	Su_firstname    string `json:"su_firstname"`
	Su_lastname     string `json:"su_lastname"`
	Su_email        string `json:"su_email"`
	Sd_id           int    `json:"sd_id"`
	Su_sign_path    string `json:"su_sign_path"`
	Su_sign_file    string `json:"su_sign_file"`
	Su_status       int    `json:"su_status"`
	Create_date     string `json:"su_created_date"`
	Update_date     string `json:"su_updated_date"`
	Create_by       string `json:"su_created_by"`
	Update_by       string `json:"su_updated_by"`
	Su_last_accress string `json:"su_last_access"`
	Spg_name        string `json:"spg_name"`
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
	Su_id           int    `json:"su_id"`
	Spg_id          int    `json:"spg_id"`
	Su_username     string `json:"su_username"`
	Su_password     string `json:"su_password"`
	Su_firstname    string `json:"su_firstname"`
	Su_lastname     string `json:"su_lastname"`
	Su_email        string `json:"su_email"`
	Sd_id           int    `json:"sd_id"`
	Su_sign_path    string `json:"su_sign_path"`
	Su_sign_file    string `json:"su_sign_file"`
	Su_status       int    `json:"su_status"`
	Create_date     string `json:"su_created_date"`
	Update_date     string `json:"su_updated_date"`
	Create_by       string `json:"su_created_by"`
	Update_by       string `json:"su_updated_by"`
	Su_last_accress string `json:"su_last_access"`
	Sd_dept_name    string `json:"sd_dept_name"`
	Spg_name        string `json:"spg_name"`
}
type Users struct {
	Su_id           int    `json:"su_id"`
	Spg_id          int    `json:"spg_id"`
	Su_username     string `json:"su_username"`
	Su_password     string `json:"su_password"`
	Su_firstname    string `json:"su_firstname"`
	Su_lastname     string `json:"su_lastname"`
	Su_email        string `json:"su_email"`
	Sd_id           int    `json:"sd_id"`
	Su_sign_path    string `json:"su_sign_path"`
	Su_sign_file    string `json:"su_sign_file"`
	Su_status       int    `json:"su_status"`
	Create_date     string `json:"su_created_date"`
	Update_date     string `json:"su_updated_date"`
	Create_by       string `json:"su_created_by"`
	Update_by       string `json:"su_updated_by"`
	Su_last_accress string `json:"su_last_access"`
}
type UsersSession struct {
	Su_id           int    `json:"su_id"`
	Spg_id          int    `json:"spg_id"`
	Su_username     string `json:"su_username"`
	Su_password     string `json:"su_password"`
	Su_firstname    string `json:"su_firstname"`
	Su_lastname     string `json:"su_lastname"`
	Su_email        string `json:"su_email"`
	Sd_id           int    `json:"sd_id"`
	Su_sign_path    string `json:"su_sign_path"`
	Su_sign_file    string `json:"su_sign_file"`
	Su_status       int    `json:"su_status"`
	Create_date     string `json:"su_created_date"`
	Update_date     string `json:"su_updated_date"`
	Create_by       string `json:"su_created_by"`
	Update_by       string `json:"su_updated_by"`
	Su_last_accress string `json:"su_last_access"`
	Sd_dept_name    string `json:"sd_dept_name"`
	Spg_name        string `json:"spg_name"`
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
	Create_date string `json:"spg_created_date"`
	Update_date string `json:"spg_updated_date"`
	Create_by   string `json:"spg_created_by"`
	Update_by   string `json:"spg_updated_by"`
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
	Create_date string `json:"spd_created_date"`
	Update_date string `json:"spd_updated_date"`
	Create_by   string `json:"spd_created_by"`
	Update_by   string `json:"spd_updated_by"`
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
type DocumentTypeData struct {
	Data []DocumentTypeTable `json:"data"`
}
type DocumentTypeTable struct {
	Mdt_id        int    `json:"mdt_id"`
	Mdt_name      string `json:"mdt_name"`
	Mdt_position1 string `json:"mdt_position1"`
	Mdt_position2 string `json:"mdt_position2"`
	Map_id        int    `json:"map_id"`
	Mdt_status    int    `json:"mdt_status"`
	Create_date   string `json:"mdt_created_date"`
	Update_date   string `json:"mdt_updated_date"`
	Create_by     string `json:"mdt_created_by"`
	Update_by     string `json:"mdt_updated_by"`
	Su_firstname  string `json:"su_firstname"`
	Su_lastname   string `json:"su_lastname"`
}
type DocumentType struct {
	Mdt_id        int    `json:"mdt_id"`
	Mdt_name      string `json:"mdt_name"`
	Mdt_position1 string `json:"mdt_position1"`
	Mdt_position2 string `json:"mdt_position2"`
	Map_id        int    `json:"map_id"`
	Mdt_status    int    `json:"mdt_status"`
	Create_date   string `json:"mdt_created_date"`
	Update_date   string `json:"mdt_updated_date"`
	Create_by     string `json:"mdt_created_by"`
	Update_by     string `json:"mdt_updated_by"`
}
type DocEnclosures struct {
	Mde_id       int    `json:"mde_id"`
	Mde_name     string `json:"mde_name"`
	Mde_required int    `json:"mde_required"`
	Mde_status   int    `json:"mde_status"`
	Create_date  string `json:"mde_created_date"`
	Create_by    string `json:"mde_created_by"`
	Update_date  string `json:"mde_updated_date"`
	Update_by    string `json:"mde_updated_by"`
}
type DocSubject struct {
	Mds_id       int    `json:"mds_id"`
	Mds_name     string `json:"mds_name"`
	Mds_required int    `json:"mds_required"`
	Mds_status   int    `json:"mds_status"`
	Create_date  string `json:"mds_created_date"`
	Create_by    string `json:"mds_created_by"`
	Update_date  string `json:"mds_updated_date"`
	Update_by    string `json:"mds_updated_by"`
}
type Packing struct {
	Mdpc_id       int    `json:"mdpc_id"`
	Mdpc_name     string `json:"mdpc_name"`
	Mdpc_required int    `json:"mdpc_required"`
	Mdpc_status   int    `json:"mdpc_status"`
	Create_date   string `json:"mdpc_created_date"`
	Create_by     string `json:"mdpc_created_by"`
	Update_date   string `json:"mdpc_updated_date"`
	Update_by     string `json:"mdpc_updated_by"`
}
type Purchase struct {
	Mdpu_id       int    `json:"mdpu_id"`
	Mdpu_name     string `json:"mdpu_name"`
	Mdpu_required int    `json:"mdpu_required"`
	Mdpu_status   int    `json:"mdpu_status"`
	Create_date   string `json:"mdpu_created_date"`
	Create_by     string `json:"mdpu_created_by"`
	Update_date   string `json:"mdpu_updated_date"`
	Update_by     string `json:"mdpu_updated_by"`
}
type Attn struct {
	Mda_id      int    `json:"mda_id"`
	Mda_name    string `json:"mda_name"`
	Sd_id       int    `json:"sd_id"`
	Mda_status  int    `json:"mda_status"`
	Create_date string `json:"mda_created_date"`
	Create_by   string `json:"mda_created_by"`
	Update_date string `json:"mda_updated_date"`
	Update_by   string `json:"mda_updated_by"`
}
type ApprovePattern struct {
	Map_id      int    `json:"map_id"`
	Map_name    string `json:"map_name"`
	Map_detail  string `json:"map_detail"`
	Map_status  int    `json:"map_status"`
	Create_date string `json:"map_created_date"`
	Update_date string `json:"map_updated_date"`
	Create_by   string `json:"map_created_by"`
	Update_by   string `json:"map_updated_by"`
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
	Smg_order   int    `json:"smg_order_no"`
	Smg_status  int    `json:"smg_status"`
	Create_date string `json:"smg_created_date"`
	Update_date string `json:"smg_updated_date"`
	Create_by   string `json:"smg_created_by"`
	Update_by   string `json:"smg_updated_by"`
}
type MenuDetail struct {
	Smd_id       int    `json:"smd_id"`
	Smd_name     string `json:"smd_name"`
	Smd_link     string `json:"smd_link"`
	Smg_id       int    `json:"smg_id"`
	Smd_order_no int    `json:"smd_order_no"`
	Smd_status   int    `json:"smd_status"`
	Create_date  string `json:"smd_created_date"`
	Update_date  string `json:"smd_updated_date"`
	Create_by    string `json:"smd_created_by"`
	Update_by    string `json:"smd_updated_by"`
}
type MenuDetailData struct {
	Data []MenuDetailTable `json:"data"`
}
type MenuDetailTable struct {
	Smd_id       int    `json:"smd_id"`
	Smd_name     string `json:"smd_name"`
	Smd_link     string `json:"smd_link"`
	Smg_id       int    `json:"smg_id"`
	Smd_order_no int    `json:"smd_order_no"`
	Smd_status   int    `json:"smd_status"`
	Create_date  string `json:"create_date"`
	Update_date  string `json:"update_date"`
	Create_by    string `json:"create_by"`
	Update_by    string `json:"update_by"`
	Su_fname     string `json:"su_firstname"`
	Su_lname     string `json:"su_lastname"`
	Su_sign_path string `json:"su_sign_path"`
	Su_sign_file string `json:"su_sign_file"`
}
type DocControlDetailData struct {
	Data []DocControlDetailTable `json:"data"`
}
type DocControlDetailTable struct {
	Mdcn_id        int    `json:"mdcn_id"`
	Mdt_id         int    `json:"mdt_id"`
	Mdcn_position1 string `json:"mdcn_position1"`
	Mdcn_position2 string `json:"mdcn_position2"`
	Create_date    string `json:"mdcn_created_date"`
	Create_by      string `json:"mdcn_created_by"`
	Update_date    string `json:"mdcn_updated_date"`
	Update_by      string `json:"mdcn_updated_by"`
	Mdt_name       string `json:"mdt_name"`
	Su_fname       string `json:"su_firstname"`
	Su_lname       string `json:"su_lastname"`
	Su_sign_path   string `json:"su_sign_path"`
	Su_sign_file   string `json:"su_sign_file"`
}
type DocControlNo struct {
	Mdcn_id        int    `json:"mdcn_id"`
	Mdt_id         int    `json:"mdt_id"`
	Mdcn_position1 string `json:"mdcn_position1"`
	Mdcn_position2 string `json:"mdcn_position2"`
	Create_date    string `json:"mdcn_created_date"`
	Create_by      string `json:"mdcn_created_by"`
	Update_date    string `json:"mdcn_updated_date"`
	Update_by      string `json:"mdcn_updated_by"`
}
type DepartmentData struct {
	Data []DepartmentTable `json:"data"`
}
type DepartmentTable struct {
	Sd_id         int    `json:"sd_id"`
	Sd_plant_cd   int    `json:"sd_plant_cd"`
	Sd_dept_cd    string `json:"sd_dept_cd"`
	Sd_dept_name  string `json:"sd_dept_name"`
	Sd_dept_aname string `json:"sd_dept_aname"`
	Sd_status     int    `json:"sd_status"`
	Create_date   string `json:"sd_created_date"`
	Create_by     string `json:"sd_created_by"`
	Update_date   string `json:"sd_updated_date"`
	Update_by     string `json:"sd_updated_by"`
	Su_fname      string `json:"su_fname"`
	Su_lname      string `json:"su_lname"`
	Su_sign_path  string `json:"su_sign_path"`
	Su_sign_file  string `json:"su_sign_file"`
}
type Department struct {
	Sd_id       int    `json:"sd_id"`
	Sd_plant_cd int    `json:"sd_plant_cd"`
	Sd_name_cd  string `json:"sd_dept_cd"`
	Sd_name     string `json:"sd_dept_name"`
	Sd_Aname    string `json:"sd_dept_aname"`
	Sd_status   int    `json:"sd_status"`
	Create_date string `json:"sd_created_date"`
	Update_date string `json:"sd_updated_date"`
	Create_by   string `json:"sd_created_by"`
	Update_by   string `json:"sd_updated_by"`
}

type FeasibilityData struct {
	Data []FeasibilityTable `json:"data"`
}
type FeasibilityTable struct {
	If_id          int    `json:"if_id"`
	If_doc_no      string `json:"if_doc_no"`
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
	Su_id           string              `json:"su_id"`
	Doc_type        int                 `json:"doc_type"`
}
type GetPartNoByIdData struct {
	Data []RfqGroupPart `json:"data"`
}
type RfqGroupPart struct {
	Idi_id        int    `json:"idi_id"`
	Idi_item_no   string `json:"idi_item_no"`
	Idi_item_name string `json:"idi_item_name"`
	Idi_model     string `json:"idi_model"`
	Idi_remark    string `json:"idi_remark"`
}

type RfqGroupVolume struct {
	Year   string `json:"year"`
	Volume string `json:"volume"`
}
type RfqGroupVolumeDetail struct {
	Idv_id   int    `json:"idv_id"`
	Idv_year string `json:"idv_year"`
	Idv_qty  string `json:"idv_qty"`
}
type GetRfq struct {
	Idc_id              int                    `json:"idc_id"`
	Mdt_id              int                    `json:"mdt_id"`
	Idc_refer_doc       int                    `json:"idc_refer_doc"`
	Idc_running_no      string                 `json:"idc_running_no"`
	Idc_issue_year      string                 `json:"idc_issue_year"`
	Idc_issue_month     string                 `json:"idc_issue_month"`
	Idc_issue_seq_no    string                 `json:"idc_issue_seq_no"`
	Idc_customer_type   int                    `json:"idc_customer_type"`
	Idc_customer_name   string                 `json:"idc_customer_name"`
	Idc_plant_cd        int                    `json:"idc_plant_cd"`
	Mds_id              int                    `json:"mds_id"`
	Idc_subject_note    string                 `json:"idc_subject_note"`
	Mde_id              int                    `json:"mde_id"`
	Idc_enclosures_note string                 `json:"idc_enclosures_note"`
	Idc_project_life    int                    `json:"idc_project_life"`
	Idc_project_start   string                 `json:"idc_project_start"`
	Idc_issue_date      string                 `json:"idc_issue_date"`
	Idc_closing_date    string                 `json:"idc_closing_date"`
	Idc_reply_date      string                 `json:"idc_reply_date"`
	Idc_result_confirm  int                    `json:"idc_result_confirm"`
	Idc_status          int                    `json:"idc_status"`
	Idc_note1           string                 `json:"idc_note1"`
	Idc_note2           string                 `json:"idc_note2"`
	Idc_file_path       string                 `json:"idc_file_path"`
	Idc_physical_path   string                 `json:"idc_physical_path"`
	Idc_cancel_reason   string                 `json:"idc_cancel_reason"`
	Idc_created_date    string                 `json:"idc_created_date"`
	Idc_created_by      string                 `json:"idc_created_by"`
	Idc_updated_date    string                 `json:"idc_updated_date"`
	Idc_updated_by      string                 `json:"idc_updated_by"`
	Idat_item           []string               `json:"idat_item"`
	Idpu_item           []string               `json:"idpu_item"`
	Idpc_item           []string               `json:"idpc_item"`
	IrGroupPart         []RfqGroupPart         `json:"ir_group_part"`
	IrGroupVolume       []RfqGroupVolumeDetail `json:"ir_group_volume"`
}
type Rfq struct {
	Idc_id              int              `json:"idc_id"`
	Mdt_id              int              `json:"mdt_id"`
	Idc_refer_doc       int              `json:"idc_refer_doc"`
	Idc_running_no      string           `json:"idc_running_no"`
	Idc_issue_year      string           `json:"idc_issue_year"`
	Idc_issue_month     string           `json:"idc_issue_month"`
	Idc_issue_seq_no    string           `json:"idc_issue_seq_no"`
	Idc_customer_type   int              `json:"idc_customer_type"`
	Idc_customer_name   string           `json:"idc_customer_name"`
	Idc_plant_cd        int              `json:"idc_plant_cd"`
	Mds_id              int              `json:"mds_id"`
	Idc_subject_note    string           `json:"idc_subject_note"`
	Mde_id              int              `json:"mde_id"`
	Idc_enclosures_note string           `json:"idc_enclosures_note"`
	Idc_project_life    int              `json:"idc_project_life"`
	Idc_project_start   string           `json:"idc_project_start"`
	Idc_issue_date      string           `json:"idc_issue_date"`
	Idc_closing_date    string           `json:"idc_closing_date"`
	Idc_reply_date      string           `json:"idc_reply_date"`
	Idc_result_confirm  int              `json:"idc_result_confirm"`
	Idc_status          int              `json:"idc_status"`
	Idc_note1           string           `json:"idc_note1"`
	Idc_note2           string           `json:"idc_note2"`
	Idc_file_path       string           `json:"idc_file_path"`
	Idc_physical_path   string           `json:"idc_physical_path"`
	Idc_cancel_reason   string           `json:"idc_cancel_reason"`
	Idc_created_date    string           `json:"idc_created_date"`
	Idc_created_by      string           `json:"idc_created_by"`
	Idc_updated_date    string           `json:"idc_updated_date"`
	Idc_updated_by      string           `json:"idc_updated_by"`
	Idat_item           []string         `json:"idat_item"`
	Idpu_item           []string         `json:"idpu_item"`
	Idpc_item           []string         `json:"idpc_item"`
	IrGroupPart         []RfqGroupPart   `json:"ir_group_part"`
	IrGroupVolume       []RfqGroupVolume `json:"ir_group_volume"`
}

type RfqData struct {
	Data []RfqTable `json:"data"`
}

type RfqTable struct {
	Idc_id              int    `json:"idc_id"`
	Mdt_id              int    `json:"mdt_id"`
	Idc_refer_doc       int    `json:"idc_refer_doc"`
	Idc_running_no      string `json:"idc_running_no"`
	Idc_issue_year      string `json:"idc_issue_year"`
	Idc_issue_month     string `json:"idc_issue_month"`
	Idc_issue_seq_no    string `json:"idc_issue_seq_no"`
	Idc_customer_type   int    `json:"idc_customer_type"`
	Idc_customer_name   string `json:"idc_customer_name"`
	Idc_plant_cd        int    `json:"idc_plant_cd"`
	Mds_id              int    `json:"mds_id"`
	Idc_subject_note    string `json:"idc_subject_note"`
	Mde_id              int    `json:"mde_id"`
	Idc_enclosures_note string `json:"idc_enclosures_note"`
	Idc_project_life    int    `json:"idc_project_life"`
	Idc_project_start   string `json:"idc_project_start"`
	Idc_issue_date      string `json:"idc_issue_date"`
	Idc_closing_date    string `json:"idc_closing_date"`
	Idc_reply_date      string `json:"idc_reply_date"`
	Idc_result_confirm  int    `json:"idc_result_confirm"`
	Idc_status          int    `json:"idc_status"`
	Idc_note1           string `json:"idc_note1"`
	Idc_note2           string `json:"idc_note2"`
	Idc_file_path       string `json:"idc_file_path"`
	Idc_physical_path   string `json:"idc_physical_path"`
	Idc_cancel_reason   string `json:"idc_cancel_reason"`
	Idc_created_date    string `json:"idc_created_date"`
	Idc_created_by      string `json:"idc_created_by"`
	Idc_updated_date    string `json:"idc_updated_date"`
	Idc_updated_by      string `json:"idc_updated_by"`
	Su_firstname        string `json:"su_firstname"`
	Su_lastname         string `json:"su_lastname"`
	Su_sign_path        string `json:"su_sign_path"`
	Su_sign_file        string `json:"su_sign_file"`
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

type GetDocNo struct {
	Mdt_id         int    `json:"mdt_id"`
	Doc_mst        string `json:"doc_mst"`
	Doc_cur_no_po1 string `json:"doc_cur_no_po1"`
	Doc_cur_no_po2 int    `json:"doc_cur_no_po2"`
	Doc_run_no     string `json:"doc_run_no"`
}

type ManageConsernData struct {
	Data []ManageConsernTable `json:"data"`
}

type ManageConsernTable struct {
	Ifcp_id        int     `json:"ifcp_id"`
	If_id          int     `json:"if_id"`
	Mc_id          int     `json:"mc_id"`
	Mc_title       string  `json:"mc_title"`
	Mc_weight      float64 `json:"mc_weight"`
	Ifcp_score     float64 `json:"ifcp_score"`
	Ifcp_comment   string  `json:"ifcp_comment"`
	Ifcp_file_name string  `json:"ifcp_file_name"`
	Ifcp_file_path string  `json:"ifcp_file_path"`
	Ifcp_submit    int     `json:"ifcp_submit"`
	Ifcp_status    int     `json:"ifcp_status"`
	Update_date    string  `json:"update_date"`
	Update_by      string  `json:"update_by"`
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

type ImportFrom struct {
	Mif_id      int    `json:"mif_id"`
	Mif_name    string `json:"mif_name"`
	Mif_status  int    `json:"mif_status"`
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
	Swg_id       int    `json:"swg_id"`
	Sd_id        int    `json:"sd_id"`
	Swg_max_lv   int    `json:"swg_max_level"`
	Swg_status   int    `json:"swg_status"`
	Create_date  string `json:"swg_created_date"`
	Update_date  string `json:"swg_updated_date"`
	Create_by    string `json:"swg_created_by"`
	Update_by    string `json:"swg_updated_by"`
	Su_fname     string `json:"su_fname"`
	Su_lname     string `json:"su_lname"`
	Sd_dept_name string `json:"sd_dept_name"`
	Sd_dept_cd   string `json:"sd_dept_cd"`
}
type WorkflowGroup struct {
	Swg_id       int    `json:"swg_id"`
	Sd_id        int    `json:"sd_id"`
	Swg_max_lv   int    `json:"swg_max_level"`
	Swg_status   int    `json:"swg_status"`
	Create_date  string `json:"swg_created_date"`
	Update_date  string `json:"swg_updated_date"`
	Create_by    string `json:"swg_created_by"`
	Update_by    string `json:"swg_updated_by"`
	Sd_dept_name string `json:"sd_dept_name"`
}
type WorkflowDetailData struct {
	Data []WorkflowDetailTable `json:"data"`
}
type WorkflowDetailTable struct {
	Swd_id       int    `json:"swd_id"`
	Swd_level_no int    `json:"swd_level_no"`
	Su_id        int    `json:"su_id"`
	Swg_id       int    `json:"swg_id"`
	Sat_id       int    `json:"sat_id"`
	Swd_status   int    `json:"swd_status"`
	Create_date  string `json:"create_date"`
	Update_date  string `json:"update_date"`
	Create_by    string `json:"create_by"`
	Update_by    string `json:"update_by"`
	Fullname     string `json:"fullname"`
	Sd_id        int    `json:"sd_id"`
	Sat_name     string `json:"sat_name"`
	Su_fname     string `json:"su_fname"`
	Su_lname     string `json:"su_lname"`
	Su_img_path  string `json:"su_img_path"`
	Su_img_name  string `json:"su_img_name"`
}
type WorkflowDetail struct {
	Swd_id       int    `json:"swd_id"`
	Swd_level_no int    `json:"swd_level_no"`
	Su_id        int    `json:"su_id"`
	Swg_id       int    `json:"swg_id"`
	Sat_id       int    `json:"sat_id"`
	Swd_status   int    `json:"swd_status"`
	Create_date  string `json:"swd_created_date"`
	Update_date  string `json:"swd_updated_date"`
	Create_by    string `json:"swd_created_by"`
	Update_by    string `json:"swd_updated_by"`
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
	Mci_id             int    `json:"mci_id"`
	Mci_name           string `json:"mci_name"`
	Mci_calculate_type int    `json:"mci_calculate_type"`
	Mci_status         int    `json:"mci_status"`
	Create_date        string `json:"mci_created_date"`
	Create_by          string `json:"mci_created_by"`
	Update_date        string `json:"mci_updated_date"`
	Update_by          string `json:"mci_updated_by"`
	Su_fname           string `json:"su_firstname"`
	Su_lname           string `json:"su_lastname"`
	Su_sign_path       string `json:"su_sign_path"`
	Su_sign_file       string `json:"su_sign_file"`
}
type Consideration struct {
	Mci_id             int    `json:"mci_id"`
	Mci_name           string `json:"mci_name"`
	Mci_calculate_type int    `json:"mci_calculate_type"`
	Mci_status         int    `json:"mci_status"`
	Create_date        string `json:"mci_created_date"`
	Create_by          string `json:"mci_created_by"`
	Update_date        string `json:"mci_updated_date"`
	Update_by          string `json:"mci_updated_by"`
}
type ConsiderationCount struct {
	Mc_id int `json:"mc_id"`
}

type ConsiderInchargeData struct {
	Data []ConsiderInchargeTable `json:"data"`
}
type ConsiderInchargeTable struct {
	Mcip_id      int    `json:"mcip_id"`
	Mci_id       int    `json:"mci_id"`
	Mcip_weight  string `json:"mcip_weight"`
	Sd_id        int    `json:"sd_id"`
	Mcip_status  int    `json:"mcip_status"`
	Create_date  string `json:"mcip_created_date"`
	Create_by    string `json:"mcip_created_by"`
	Update_date  string `json:"mcip_updated_date"`
	Update_by    string `json:"mcip_updated_by"`
	Mci_name     string `json:"mci_name"`
	Sd_dept_name string `json:"sd_dept_name"`
	Su_firstname string `json:"su_firstname"`
	Su_lastname  string `json:"su_lastname"`
	Su_sign_path string `json:"su_sign_path"`
	Su_sign_file string `json:"su_sign_file"`
}
type ConsiderIncharge struct {
	Mcip_id     int    `json:"mcip_id"`
	Mci_id      int    `json:"mci_id"`
	Mcip_weight string `json:"mcip_weight"`
	Sd_id       int    `json:"sd_id"`
	Mcip_status int    `json:"mcip_status"`
	Create_date string `json:"mcip_created_date"`
	Create_by   string `json:"mcip_created_by"`
	Update_date string `json:"mcip_updated_date"`
	Update_by   string `json:"mcip_updated_by"`
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

type Notify struct {
	Su_id            int    `json:"su_id"`
	Ida_created_by   string `json:"ida_created_by"`
	Snc_id           int    `json:"snc_id"`
	Snc_type         int    `json:"snc_type"`
	Ida_id           int    `json:"ida_id"`
	Snc_show_users   string `json:"snc_show_users"`
	Snc_read_status  int    `json:"snc_read_status"`
	Snc_created_date string `json:"snc_created_date"`
	Snc_updated_date string `json:"snc_updated_date"`
}
