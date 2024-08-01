function getTimeNow(){
    const currentTime = new Date();
    let year = currentTime.getFullYear()
    let month = currentTime.getMonth()+1
    if(month<10){
        month = '0'+month
    }
    let day = currentTime.getDate()
    if(day<10){
        day = '0'+day
    }

    let hour = currentTime.getHours()
    if(hour<10){
        hour = '0'+hour
    }
    let min = currentTime.getMinutes()
    if(min<10){
        min = '0'+min
    }
    let sec = currentTime.getSeconds()
    if(sec<10){
        sec = '0'+sec
    }
    let formattedDate = year+'/'+month+'/'+day+' '+hour+':'+min+':'+sec
    return formattedDate
}
function getTwoDigitYear(){
    const currentTime = new Date();
    let year = currentTime.getFullYear().toString()
    return year.substring(2,4);
}
async function getLastId(url){
    try {
        var result = await $.ajax({
            type: 'GET',
            url: url,
        });
        return result;
    } catch (err) {
        console.log(err);
        throw err;
    }
}
// validate functions ----------------
async function is_unique(data,url){
    try {
        var result = await $.ajax({
            type: 'POST',
            dataType: 'json',
            contentType: 'application/json',
            url: url,
            data: JSON.stringify(data)
        });
        return result;
    } catch (err) {
        console.log(err);
        throw err;
    }
}
function is_empty(val){
    return val == null || val.trim() == "";
}
function valid_email(val) {
    var validRegex = /^[a-zA-Z0-9_]+@[a-zA-Z]+(?:\.[a-zA-Z]+)*$/;
    return !val.match(validRegex);
}
function alpha_numeric_thai(val) {
    return !val.match(/^[A-Z0-9ก-๛เ\s]+$/i);
}
function numeric(val) {
    return !val.match(/^[0-9]/);
}
function is_equal(val1,val2){
    return val1 === val2;
}
function form_err(element,message){
    element.style.border = "1px solid #ff0000";
    element.nextElementSibling.style.display = "block";
    element.nextElementSibling.innerHTML = message;
    element.focus();
}
function form_ok(element){
    element.style.border = "1px solid #d1d3e2";
    element.nextElementSibling.style.display = "none";
}

// validate forms ----------------------
async function login_validate(){
    var name = document.form_login.su_emp_code
    var password = document.form_login.su_password

    // name -----
    if(is_empty(name.value)){
        form_err(name,"*Please Enter username");
        return false;
    }else{
        form_ok(name);
        if(is_empty(password.value)){
            form_err(password,"*Please Enter password");
            return false;
        }else{
            form_ok(password);
            return true;
        }
    }
}
async function user_validate(formType){
    var form,emp_code,fname,lname,email,spc_id,spg_id,sd_id,tel,id,url,unique_data;
    url = API_URL+"user/emp_code_unique"
    if(formType=="add"){
        form = document.add_form
        id = 0
    }else{
        form = document.edit_form
        let getid = form.su_id
        id = parseInt(getid.value)
    }
    emp_code = form.su_emp_code
    fname = form.su_fname
    lname = form.su_lname
    email = form.su_email
    spc_id = form.spc_id
    spg_id = form.spg_id
    sd_id = form.sd_id
    tel = form.su_tel

    // name -----
    if(is_empty(emp_code.value)){
        form_err(emp_code,"*Please Enter employee code");
        return false;
    }else{
        unique_data = {
            "su_id":id,
            "su_emp_code":emp_code.value
        }
        try {
            var chk_unique = await is_unique(unique_data, url);
            // console.log(chk_unique);
            if (chk_unique) {
                form_err(emp_code,"*employee code is Duplicate");
                return false;
            } else {
                form_ok(emp_code);
            }
        } catch (err) {
            console.log(err);
        }
        if(is_empty(fname.value)){
            form_err(fname,"*Please Enter First name");
            return false;
        }else{
            form_ok(fname);
            if(is_empty(lname.value)){
                form_err(lname,"*Please Enter Last name");
                return false;
            }else{
                form_ok(lname);
                if(is_empty(email.value)){
                    form_err(email,"*Please Enter email");
                    return false;
                }else{
                    if(valid_email(email.value)){
                        form_err(email,"*Please Enter valid email");
                        return false;
                    }else{
                        form_ok(email);
                        if(is_empty(sd_id.value)){
                            form_err(sd_id,"*Please Enter Department");
                            return false;
                        }else{
                            if(is_empty(tel.value)){
                                form_err(tel,"*Please Enter Telephone");
                                return false;
                            }else{
                                if(numeric(tel.value)){
                                    form_err(tel,"*Please Enter valid telephone");
                                    return false;
                                }else{
                                    if(!is_equal(tel.value.length,10)){
                                        form_err(tel,"*Phone number must be 10 number");
                                        return false;
                                    }else{
                                        form_ok(tel);
                                        if(is_empty(spc_id.value)){
                                            form_err(spc_id,"*Please Enter Plant");
                                            return false;
                                        }else{
                                            form_ok(spc_id);
                                            if(is_empty(spg_id.value)){
                                                form_err(spg_id,"*Please Enter Permission");
                                                return false;
                                            }else{
                                                form_ok(spg_id);
                                                return true;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
async function spg_validate(formType){
    var name,id,url,unique_data;
    url = API_URL+"spg_table/is_unique"
    if(formType=="add"){
        name = document.getElementById("inpPermissionGroup")
        id = 0
    }else{
        name = document.edit_formPerg.spg_name
        let getid = document.edit_formPerg.spg_id
        id = parseInt(getid.value)
    }

    // name -----
    if(is_empty(name.value)){
        form_err(name,"*Please Enter permission group");
        return false;
    }else{
        unique_data = {
            "spg_id":id,
            "spg_name":name.value
        }
        try {
            var chk_unique = await is_unique(unique_data, url);
            if (chk_unique) {
                form_err(name,"*permission group is Duplicate");
                return false;
            } else {
                form_ok(name);
                return true;
            }
        } catch (err) {
            console.log(err); // Handle error
        }
    }
}
async function spd_validate(formType){
    var menud,menug,perg_id,id,url,unique_data;
    perg_id = document.getElementById("selPermissionGroup")
    url = API_URL+"spd_table/is_unique"
    if(formType=="add"){
        menud = document.getElementById("selSubMenu")
        menug = document.getElementById("selMainMenu")
        id = 0
    }else{
        menud = document.frmEditPermission.smd_id
        menug = document.frmEditPermission.smg_id
        let getid = document.frmEditPermission.spd_id
        id = parseInt(getid.value)
    }

    // name -----
    if(is_empty(perg_id.value)){
        form_err(perg_id,"*Please Enter permission group");
        return false;
    }else{
        form_ok(perg_id);
        if(is_empty(menug.value)){
            form_err(menug,"*Please Enter menu group");
            return false;
        }else{
            form_ok(menug);
            if(is_empty(menud.value)){
                form_err(menud,"*Please Enter menu detail");
                return false;
            }else{
                form_ok(menud);
                unique_data = {
                    "spg_id":parseInt(perg_id.value),
                    "smd_id":parseInt(menud.value),
                    "spd_id":id
                }
                try {
                    var chk_unique = await is_unique(unique_data, url);
                    if (chk_unique) {
                        form_err(menud,"*permission detail is Duplicate");
                        return false;
                    } else {
                        form_ok(menud);
                        return true;
                    }
                } catch (err) {
                    console.log(err); // Handle error
                }
            }
        }
    }
}
async function smg_validate(formType){
    var smg_name,smg_icon,id,url,unique_data;
    url = API_URL+"menu_group/is_unique"
    if(formType=="add"){
        smg_name = document.getElementById("inpMainMenu")
        smg_icon = document.getElementById("inpMenuIcon")
        id = 0
    }else{
        smg_name = document.frmEditMainMenu.smg_name
        smg_icon = document.frmEditMainMenu.smg_icon
        let getid = document.frmEditMainMenu.smg_id
        id = parseInt(getid.value)
    }

    // name -----
    if(is_empty(smg_name.value)){
        form_err(smg_name,"*Please Enter main menu");
        return false;
    }else{
        unique_data = {
            "smg_id":id,
            "smg_name":smg_name.value,
        }
        try {
            var chk_unique = await is_unique(unique_data, url);
            if (chk_unique) {
                form_err(smg_name,"*Main menu is Duplicate");
                return false;
            } else {
                form_ok(smg_name);
                if(is_empty(smg_icon.value)){
                    form_err(smg_icon,"*Please Enter menu icon");
                    return false;
                }else{
                    form_ok(smg_icon);
                    return true;
                }
            }
        } catch (err) {
            console.log(err); // Handle error
        }
    }
}
async function smd_validate(formType){
    var name,menu_link,menug_id,id,url,unique_data;
    menug_id = document.getElementById("selMainMenu")
    url = API_URL+"menu_detail/is_unique"
    if(formType=="add"){
        name = document.getElementById("inpSubMenu")
        menu_link = document.getElementById("inpMenuController")
        id = 0
    }else{
        name = document.frmEditSubMenu.smd_name
        menu_link = document.frmEditSubMenu.smd_link
        let getid = document.frmEditSubMenu.smd_id
        id = parseInt(getid.value)
    }

    // name -----
    if(is_empty(menug_id.value)){
        form_err(menug_id,"*Please Enter Main menu");
        return false;
    }else{
        form_ok(menug_id);
        if(is_empty(name.value)){
            form_err(name,"*Please Enter menu detail");
            return false;
        }else{
            form_ok(name);
            if(is_empty(menu_link.value)){
                form_err(menu_link,"*Please Enter controller path");
                return false;
            }else{
                form_ok(menu_link);
                unique_data = {
                    "smg_id":parseInt(menug_id.value),
                    "smd_name":name.value,
                    "smd_id":id
                }
                try {
                    var chk_unique = await is_unique(unique_data, url);
                    if (chk_unique) {
                        form_err(name,"*Menu detail is Duplicate");
                        return false;
                    } else {
                        form_ok(name);
                        return true;
                    }
                } catch (err) {
                    console.log(err); // Handle error
                }
            }
        }
    }
}
async function settingUser_validate(){
    var fname,lname,email,spc_id,spg_id,dept,tel;
    let getid = document.frmEditProfile.su_id
    id = parseInt(getid.value)
    fname = document.frmEditProfile.su_fname
    lname = document.frmEditProfile.su_lname
    email = document.frmEditProfile.su_email
    spc_id = document.frmEditProfile.spc_id
    dept = document.frmEditProfile.sd_id
    tel = document.frmEditProfile.su_tel
    // spg_id = document.frmEditProfile.spg_id

    if(is_empty(fname.value)){
        form_err(fname,"*Please Enter First name");
        return false;
    }else{
        form_ok(fname);
        if(is_empty(lname.value)){
            form_err(lname,"*Please Enter Last name");
            return false;
        }else{
            form_ok(lname);
            if(is_empty(email.value)){
                form_err(email,"*Please Enter email");
                return false;
            }else{
                if(valid_email(email.value)){
                    form_err(email,"*Please Enter valid email");
                    return false;
                }else{
                    form_ok(email);
                    if(is_empty(spc_id.value)){
                        form_err(spc_id,"*Please Enter Plant");
                        return false;
                    }else{
                        form_ok(spc_id);
                        if(is_empty(dept.value)){
                            form_err(dept,"*Please Enter Department");
                            return false;
                        }else{
                            form_ok(dept);
                            if(is_empty(tel.value)){
                                form_err(tel,"*Please Enter Phone number");
                                return false;
                            }else{
                                if(numeric(tel.value)){
                                    form_err(tel,"*Please Enter valid telephone");
                                    return false;
                                }else{
                                    if(!is_equal(tel.value.length,10)){
                                        form_err(tel,"*Phone number must be 10 number");
                                        return false;
                                    }else{
                                        form_ok(tel);
                                        return true;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
async function settingPsw_validate(){
    var su_password,chk_password,id;
    let getid = document.frmChangePassword.su_id
    id = parseInt(getid.value)
    su_password = document.frmChangePassword.su_password
    chk_password = document.frmChangePassword.chk_password

    if(is_empty(su_password.value)){
        form_err(su_password,"*Please Enter new password");
        return false;
    }else{
        form_ok(su_password);
        if(is_empty(chk_password.value)){
            form_err(chk_password,"*Please Enter confirm password");
            return false;
        }else{
            if(!is_equal(su_password.value,chk_password.value)){
                form_err(chk_password,"*Confirm password isn't correct");
                return false;
            }else{
                form_ok(chk_password);
                return true;
            }
        }
    }
}
async function department_validate(formType){
    var sd_name,id,url,unique_data;
    url = API_URL+"department/is_unique"
    if(formType=="add"){
        sd_name = document.getElementById("inpDepartment")
        id = 0
    }else{
        sd_name = document.edit_form.sd_name
        let getid = document.edit_form.sd_id
        id = parseInt(getid.value)
    }

    // name -----
    if(is_empty(sd_name.value)){
        form_err(sd_name,"*Please Enter department");
        return false;
    }else{
        unique_data = {
            "sd_id":id,
            "sd_name":sd_name.value,
        }
        try {
            var chk_unique = await is_unique(unique_data, url);
            if (chk_unique) {
                form_err(sd_name,"*Department is Duplicate");
                return false;
            } else {
                form_ok(sd_name);
                return true;
            }
        } catch (err) {
            console.log(err); // Handle error
        }
    }
}
async function forgot_validate(){
    let element = document.getElementById("emp_code");
    let url = API_URL+"user/emp_code_unique"
    if(is_empty(element.value)){
        form_err(element,"*Please Enter employee code");
        return false;
    }else{
        unique_data = {
            "su_id":0,
            "su_emp_code":emp_code.value
        }
        try {
            var chk_unique = await is_unique(unique_data, url);
            if (!chk_unique) {
                form_err(emp_code,"*This employee code isn't exist");
                return false;
            } else {
                form_ok(emp_code);
                return true;
            }
        } catch (err) {
            console.log(err);
        }
    }
}
async function swg_validate(formType){
    var name,max,id,url,unique_data;
    url = API_URL+"workflow_group/is_unique"
    if(formType=="add"){
        name = document.getElementById("inpWorkflowGroup")
        max = document.getElementById("inpWorkflowGroup")
        id = 0
    }else{
        name = document.edit_formWorkflowGroup.swg_name
        max = document.edit_formWorkflowGroup.swg_max_lv
        let getid = document.edit_formWorkflowGroup.swg_id
        id = parseInt(getid.value)
    }

    // name -----
    if(is_empty(name.value)){
        form_err(name,"*Please Enter workflow group");
        return false;
    }else{
        unique_data = {
            "swg_id":id,
            "swg_name":name.value
        }
        try {
            var chk_unique = await is_unique(unique_data, url);
            if (chk_unique) {
                form_err(name,"*Workflow group is Duplicate");
                return false;
            } else {
                form_ok(name);
                if(is_empty(max.value)){
                    form_err(max,"*Please Enter Max level");
                    return false;
                }else{
                    form_ok(max);
                    return true;
                }
            }
        } catch (err) {
            console.log(err); // Handle error
        }
    }
}
async function swd_validate(formType){
    var userid,appLv,appType,swg_id,id,url,unique_data;
    swg_id = document.getElementById("selWorkflowGroup")
    url = API_URL+"workflow_detail/is_unique"
    if(formType=="add"){
        appLv = document.getElementById("selAppLv")
        userid = document.getElementById("selUser")
        appType = document.getElementById("selApproveType")
        id = 0
    }else{
        appLv = document.frmEditWorkflow.swd_app_lv
        userid = document.frmEditWorkflow.su_id
        appType = document.frmEditWorkflow.sat_id
        let getid = document.frmEditWorkflow.swd_id
        id = parseInt(getid.value)
    }

    // name -----
    if(is_empty(swg_id.value)){
        form_err(swg_id,"*Please Enter workflow group");
        return false;
    }else{
        form_ok(swg_id);
        if(is_empty(appLv.value)){
            form_err(appLv,"*Please Enter approve level");
            return false;
        }else{
            form_ok(appLv);
            if(is_empty(userid.value)){
                form_err(userid,"*Please Select user");
                return false;
            }else{
                form_ok(userid);
                if(is_empty(appType.value)){
                    form_err(appType,"*Please Select approve type");
                    return false;
                }else{
                    form_ok(appType);
                    unique_data = {
                        "swd_app_lv":parseInt(appLv.value),
                        "swg_id":parseInt(swg_id.value),
                        "swd_id":id
                    }
                    try {
                        var chk_unique = await is_unique(unique_data, url);
                        if (chk_unique) {
                            form_err(appLv,"*approve level is Duplicate");
                            return false;
                        } else {
                            form_ok(appLv);
                            return true;
                        }
                    } catch (err) {
                        console.log(err); // Handle error
                    }
                }
            }
        }
    }
}
async function mc_validate(formType){
    var title,weight,id;
    if(formType=="add"){
        title = document.getElementById("inpTitle")
        weight = document.getElementById("inpWeight")
        id = 0
    }else{
        title = document.edit_formConsider.mc_title
        weight = document.edit_formConsider.mc_weight
        let getid = document.edit_formConsider.mc_id
        id = parseInt(getid.value)
    }

    if(is_empty(title.value)){
        form_err(title,"*Please Enter title");
        return false;
    }else{
        form_ok(title);
        if(is_empty(weight.value)){
            form_err(weight,"*Please Enter weight");
            return false;
        }else{
            form_ok(weight);
            return true;
        }
    }
}
async function incharge_validate(formType){
    var title,dept,id,url,unique_data;
    url = API_URL+"incharge/is_unique"
    if(formType=="add"){
        title = document.getElementById("selTitle")
        dept = document.getElementById("selDept")
        id = 0
    }else{
        title = document.frmEditConsideration.mc_id
        dept = document.frmEditConsideration.sd_id
        let getid = document.frmEditConsideration.mci_id
        id = parseInt(getid.value)
    }

    if(is_empty(title.value)){
        form_err(title,"*Please Enter title");
        return false;
    }else{
        form_ok(title);
        if(is_empty(dept.value)){
            form_err(dept,"*Please Enter department");
            return false;
        }else{
            unique_data = {
                "mc_id":parseInt(title.value),
                "sd_id":parseInt(dept.value),
                "mci_id":id
            }
            try {
                var chk_unique = await is_unique(unique_data, url);
                if (chk_unique) {
                    form_err(dept,"*Incharge is Duplicate");
                    return false;
                } else {
                    form_ok(dept);
                    return true;
                }
            } catch (err) {
                console.log(err); // Handle error
            }
        }
    }
}

async function Feasibility_validate(formType){
    var if_customer,if_import_tran,if_part_no,if_part_name,mrt_id,if_ref,refcon,id,url;
    url = API_URL+"feasibility/last_id";
    if_ref = "RFQ-SM-"+getTwoDigitYear()+"-";
    if(formType=="add"){
        if_customer = document.add_form.if_customer
        if_import_tran = document.add_form.if_import_tran
        if_part_no = document.add_form.if_part_no
        if_part_name = document.add_form.if_part_name
        mrt_id = document.add_form.mrt_id
        refcon = document.getElementById("add_if_ref")
        id = 0
    }else{
        if_customer = document.edit_form.if_customer
        if_import_tran = document.edit_form.if_import_tran
        if_part_no = document.edit_form.if_part_no
        if_part_name = document.edit_form.if_part_name
        mrt_id = document.edit_form.mrt_id
        refcon = document.getElementById("edit_if_ref")
        let getid = document.edit_form.if_id
        id = parseInt(getid.value)
    }

    // name -----
    if(is_empty(if_customer.value)){
        form_err(if_customer,"*Please Enter Customer");
        return false;
    }else{
        form_ok(if_import_tran);
        if(is_empty(if_import_tran.value)){
            form_err(if_import_tran,"*Please Enter Import From");
            return false;
        }else{
            form_ok(if_import_tran);
            if(is_empty(if_part_no.value)){
                form_err(if_part_no,"*Please Enter Part No");
                return false;
            }else{
                form_ok(if_part_no);
                if(is_empty(if_part_name.value)){
                    form_err(if_part_name,"*Please Enter Part Name");
                    return false;
                }else{
                    form_ok(if_part_name);
                    if(is_empty(mrt_id.value)){
                        form_err(mrt_id,"*Please Enter Requirement");
                        return false;
                    }else{
                        form_ok(mrt_id);
                        if(formType=="add"){
                            try {
                                var last_id = await getLastId(url);
                                // console.log(last_id['last_id']);
                                if(typeof last_id['last_id'] != "number"){
                                    form_err(refcon,"*Error generate reference no.");
                                    return false;
                                }else{
                                    form_ok(refcon);
                                    if(++last_id['last_id'] <10){
                                        if_ref += "00"+last_id['last_id'];
                                    }else if(last_id['last_id'] <100){
                                        if_ref += "0"+last_id['last_id'];
                                    }else{
                                        if_ref += last_id['last_id'];
                                    }
                                    refcon.value = if_ref;
                                    return true;
                                }
                            } catch (err) {
                                console.log(err); // Handle error
                            }
                        }else{
                            var duedate = document.edit_form.if_duedate;
                            if(is_empty(duedate.value)){
                                form_err(duedate,"*Please Enter Due date");
                                return false;
                            }else{
                                form_ok(duedate);
                                return true;
                            }
                        }
                    }
                }
            }
        }
    }
}
async function scoring_validate(element){
    if(element.value > 5  || element.value < 1){
        form_err(element,"*Please enter 1-5");
        return false;
    }else{
        form_ok(element);
        return true;
    }
}