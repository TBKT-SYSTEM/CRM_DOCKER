function getTimeNow() {
    const currentTime = new Date();
    let year = currentTime.getFullYear()
    let month = currentTime.getMonth() + 1
    if (month < 10) {
        month = '0' + month
    }
    let day = currentTime.getDate()
    if (day < 10) {
        day = '0' + day
    }

    let hour = currentTime.getHours()
    if (hour < 10) {
        hour = '0' + hour
    }
    let min = currentTime.getMinutes()
    if (min < 10) {
        min = '0' + min
    }
    let sec = currentTime.getSeconds()
    if (sec < 10) {
        sec = '0' + sec
    }
    let formattedDate = year + '/' + month + '/' + day + ' ' + hour + ':' + min + ':' + sec
    return formattedDate
}
function addDaysToDate(date, days) {
    let result = new Date(date);
    result.setDate(result.getDate() + days);
    let year = result.getFullYear();
    let month = String(result.getMonth() + 1).padStart(2, '0');
    let day = String(result.getDate()).padStart(2, '0');

    return `${year}/${month}/${day}`;
}
function getTwoDigitYear() {
    const currentTime = new Date();
    let year = currentTime.getFullYear().toString()
    return year.substring(2, 4);
}
async function getLastId(url) {
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

async function getDocNo(url, id) {
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
async function is_unique(data, url) {
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
function is_empty(val) {
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
function is_equal(val1, val2) {
    return val1 === val2;
}
function is_english(val) {
    return /^[A-Za-z]+$/.test(val);
}
function form_err(element, message) {
    element.style.border = "1px solid #ff0000";
    element.nextElementSibling.style.display = "block";
    element.nextElementSibling.innerHTML = message;
    element.focus();
}

function form_errValid(element, message) {
    element.classList.add('is-invalid');
    if (element.classList.contains('select2')) {
        const select2Selection = element.parentElement.querySelector('.select2-selection.select2-selection--single');
        select2Selection.style.borderColor = 'var(--bs-danger2)';
        select2Selection.style.paddingRight = 'calc(1.5em + 16px)';
        select2Selection.style.backgroundImage = 'url("data:image/svg+xml,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 12 12%27 width=%2712%27 height=%2712%27 fill=%27none%27 stroke=%27%23FA896B%27%3e%3ccircle cx=%276%27 cy=%276%27 r=%274.5%27/%3e%3cpath stroke-linejoin=%27round%27 d=%27M5.8 3.6h.4L6 6.5z%27/%3e%3ccircle cx=%276%27 cy=%278.2%27 r=%270.6%27 fill=%27%23FA896B%27 stroke=%27none%27/%3e%3c/svg%3e")';
        select2Selection.style.backgroundRepeat = 'no-repeat';
        select2Selection.style.backgroundPosition = 'right calc(2.375em + 4px) center';
        select2Selection.style.backgroundSize = 'calc(0.75em + 8px) calc(0.75em + 8px)';
    }
    let invalidFeedback = element.parentElement.querySelector('.invalid-feedback');
    if (invalidFeedback) {
        invalidFeedback.style.display = "block";
        invalidFeedback.innerHTML = message;
    }
    element.focus();
}


function form_okValid(element) {
    element.classList.remove('is-invalid');
    element.classList.add('is-valid');
    if (element.classList.contains('select2')) {
        const select2Selection = element.parentElement.querySelector('.selection .select2-selection.select2-selection--single');
        if (select2Selection) {
            select2Selection.style.borderColor = 'var(--bs-success)';
            select2Selection.style.paddingRight = 'calc(1.5em + 16px)';
            select2Selection.style.backgroundImage = 'url("data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 8 8%27%3E%3Cpath fill=%27%2313DEB9%27 d=%27M2.3 6.73l-1.7-2.2c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z%27/%3E%3C/svg%3E")';
            select2Selection.style.backgroundRepeat = 'no-repeat';
            select2Selection.style.backgroundPosition = 'right calc(2.375em + 4px) center';
            select2Selection.style.backgroundSize = 'calc(0.75em + 8px) calc(0.75em + 8px)';
        }
    }
    let invalidFeedback = element.parentElement.querySelector('.invalid-feedback');
    if (invalidFeedback) {
        invalidFeedback.style.display = "none";
    }

}


function form_defaultValid(element) {
    element.classList.remove('is-valid');
}


function form_errCus(element1, element2, message) {
    element2.style.border = "1px solid #ff0000";
    element2.nextElementSibling.style.display = "block";
    element2.nextElementSibling.innerHTML = message;
    element1.style.border = "1px solid #ff0000";
    element1.nextElementSibling.style.display = "block";
    element1.nextElementSibling.innerHTML = message;
    element1.focus();
}
function form_ok(element) {
    element.style.border = "1px solid #d1d3e2";
    element.nextElementSibling.style.display = "none";
}
function form_okCus(element1, element2) {
    element2.style.border = "1px solid #d1d3e2";
    element2.nextElementSibling.style.display = "none";
    element1.style.border = "1px solid #d1d3e2";
    element1.nextElementSibling.style.display = "none";
}

async function checkPartGroup(partNo, partName, model) {
    if (is_empty(partNo.value)) {
        form_errValid(partNo, '*Plase Enter Part No.');
        return false;
    } else {
        form_okValid(partNo)
        if (is_empty(partName.value)) {
            form_errValid(partName, '*Plase Enter Part Name');
            return false;
        } else {
            form_okValid(partName)
            if (is_empty(model.value)) {
                form_errValid(model, '*Plase Enter Model');
                return false;
            } else {
                form_okValid(model)
                return true;
            }
        }
    }
}

// validate forms ----------------------
async function login_validate() {
    var name = document.form_login.su_username
    var password = document.form_login.su_password

    // name -----
    if (is_empty(name.value)) {
        form_err(name, "*Please Enter username");
        $('#btnSignIn').text('Sign In');
        return false;
    } else {
        if (name.value.includes(" ")) {
            form_err(name, "*Please Enter valid username");
            $('#btnSignIn').text('Sign In');
            return false;
        } else {
            form_ok(name);
            if (is_empty(password.value)) {
                form_err(password, "*Please Enter password");
                $('#btnSignIn').text('Sign In');
                return false;
            } else {
                form_ok(password);
                return true;
            }
        }
    }
}
async function user_validate(formType) {
    var form, emp_code, fname, lname, email, spc_id, spg_id, sd_id, tel, id, url, unique_data;
    url = API_URL + "user/emp_code_unique"
    if (formType == "add") {
        form = document.add_form
        id = 0
    } else {
        form = document.edit_form
        let getid = form.su_id
        id = parseInt(getid.value)
    }
    emp_code = form.su_username
    fname = form.su_firstname
    lname = form.su_lastname
    email = form.su_email
    spg_id = form.spg_id
    sd_id = form.sd_id

    // name -----
    if (is_empty(emp_code.value)) {
        form_err(emp_code, "*Please Enter employee code");
        return false;
    } else {
        unique_data = {
            "su_id": id,
            "su_emp_code": emp_code.value
        }
        try {
            var chk_unique = await is_unique(unique_data, url);
            // console.log(chk_unique);
            if (chk_unique) {
                form_err(emp_code, "*employee code is Duplicate");
                return false;
            } else {
                form_ok(emp_code);
            }
        } catch (err) {
            console.log(err);
        }
        if (is_empty(fname.value)) {
            form_err(fname, "*Please Enter First name");
            return false;
        } else {
            form_ok(fname);
            if (is_empty(lname.value)) {
                form_err(lname, "*Please Enter Last name");
                return false;
            } else {
                form_ok(lname);
                if (is_empty(email.value)) {
                    form_err(email, "*Please Enter email");
                    return false;
                } else {
                    if (valid_email(email.value)) {
                        form_err(email, "*Please Enter valid email");
                        return false;
                    } else {
                        form_ok(email);
                        if (is_empty(sd_id.value)) {
                            form_err(sd_id, "*Please Enter Department");
                            return false;
                        } else {
                            form_ok(sd_id);
                            if (is_empty(spg_id.value)) {
                                form_err(spg_id, "*Please Enter Permission");
                                return false;
                            } else {
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
async function spg_validate(formType) {
    var name, id, url, unique_data;
    url = API_URL + "spg_table/is_unique"
    if (formType == "add") {
        name = document.getElementById("inpPermissionGroup")
        id = 0
    } else {
        name = document.edit_formPerg.spg_name
        let getid = document.edit_formPerg.spg_id
        id = parseInt(getid.value)
    }

    // name -----
    if (is_empty(name.value)) {
        form_err(name, "*Please Enter permission group");
        return false;
    } else {
        unique_data = {
            "spg_id": id,
            "spg_name": name.value
        }
        try {
            var chk_unique = await is_unique(unique_data, url);
            if (chk_unique) {
                form_err(name, "*permission group is Duplicate");
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
async function spd_validate(formType) {
    var menud, menug, perg_id, id, url, unique_data;
    perg_id = document.getElementById("selPermissionGroup")
    url = API_URL + "spd_table/is_unique"
    if (formType == "add") {
        menud = document.getElementById("selSubMenu")
        menug = document.getElementById("selMainMenu")
        id = 0
    } else {
        menud = document.frmEditPermission.smd_id
        menug = document.frmEditPermission.smg_id
        let getid = document.frmEditPermission.spd_id
        id = parseInt(getid.value)
    }

    // name -----
    if (is_empty(perg_id.value)) {
        form_err(perg_id, "*Please Enter permission group");
        return false;
    } else {
        form_ok(perg_id);
        if (is_empty(menug.value)) {
            form_err(menug, "*Please Enter menu group");
            return false;
        } else {
            form_ok(menug);
            if (is_empty(menud.value)) {
                form_err(menud, "*Please Enter menu detail");
                return false;
            } else {
                form_ok(menud);
                unique_data = {
                    "spg_id": parseInt(perg_id.value),
                    "smd_id": parseInt(menud.value),
                    "spd_id": id
                }
                try {
                    var chk_unique = await is_unique(unique_data, url);
                    if (chk_unique) {
                        form_err(menud, "*permission detail is Duplicate");
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

async function mdt_validate(formType) {
    var mdt_name, mdt_position1, mdt_position2, map_id, id, url, unique_data;
    url = API_URL + "document_type/is_unique"
    if (formType == "add") {
        mdt_name = document.getElementById("inpDocName");
        mdt_position1 = document.getElementById("inpDocPo1");
        mdt_position2 = document.getElementById("inpDocPo2");
        map_id = document.getElementById("inpDocPo3");
        id = 0;
    } else {
        mdt_name = document.frmEditDocType.mdt_name;
        mdt_position1 = document.frmEditDocType.mdt_position1
        mdt_position2 = document.frmEditDocType.mdt_position2
        map_id = document.frmEditDocType.map_id
        let getid = document.frmEditDocType.mdt_id
        id = parseInt(getid.value)
    }

    // name -----
    if (is_empty(mdt_name.value)) {
        form_err(mdt_name, "*Please Enter Document Type Name");
        return false;
    } else {
        unique_data = {
            "mdt_id": id,
            "mdt_name": mdt_name.value,
        }
        try {
            var chk_unique = await is_unique(unique_data, url);
            if (chk_unique) {
                form_err(mdt_name, "*Document name is Duplicate");
                return false;
            } else {
                if (!is_english(mdt_name.value)) {
                    form_err(mdt_name, "*Document name format is invalid");
                } else {
                    form_ok(mdt_name);
                    if (is_empty(mdt_position1.value)) {
                        form_err(mdt_position1, "*Please Enter Document Type Position 1");
                        return false;
                    } else {
                        if (!is_english(mdt_position1.value)) {
                            form_err(mdt_position1, "*Document type position 1 format is invalid");
                            return false;
                        } else {
                            form_ok(mdt_position1);
                            if (is_empty(mdt_position2.value)) {
                                form_err(mdt_position2, "*Please Enter Document Type Position 2");
                                return false;
                            } else {
                                form_ok(mdt_position2);
                                if (!is_english(mdt_position2.value)) {
                                    form_err(mdt_position2, "*Document type position 2 format is invalid");
                                    return false;
                                } else {
                                    form_ok(mdt_position2);
                                    if (is_empty(map_id.value)) {
                                        form_ok(map_id);
                                        return true;
                                    } else {
                                        form_ok(map_id);
                                        return true;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        } catch (err) {
            console.log(err); // Handle error
        }
    }
}

async function mdcn_validate(formType) {
    var mdcn_position1, mdcn_position2, mdcn_position3, id, url, unique_data, mdt_id;
    url = API_URL + "document_control_no/is_unique"
    if (formType == "add") {
        mdcn_position1 = document.getElementById("inpDocNoPo1");
        mdt_id = document.getElementById("selDoctype");
        id = 0;
    } else {
        mdcn_position1 = document.frmEditDocControl.mdcn_position1;
        mdt_id = document.frmEditDocControl.mdt_id;
        id = parseInt(mdt_id.value);
    }

    // name -----
    if (is_empty(mdt_id.value)) {
        form_err(mdt_id, "*Please Select Document Type");
        return false;
    } else {
        form_ok(mdt_id);
        if (is_empty(mdcn_position1.value)) {
            form_err(mdcn_position1, "*Please Select Position 1");
            return false;
        } else {
            unique_data = {
                "mdcn_id": id,
                "mdt_id": parseInt(mdt_id.value),
                "mdcn_position1": mdcn_position1.value,
            }
            try {
                var chk_unique = await is_unique(unique_data, url);
                if (chk_unique) {
                    form_err(mdcn_position1, "*Position is Duplicate");
                    return false;
                } else {
                    form_ok(mdcn_position1);
                    return true;
                }
            } catch (err) {
                console.log(err); // Handle error
            }
        }
    }
}

async function smg_validate(formType) {
    var smg_name, smg_icon, id, url, unique_data;
    url = API_URL + "menu_group/is_unique"
    if (formType == "add") {
        smg_name = document.getElementById("inpMainMenu")
        smg_icon = document.getElementById("inpMenuIcon")
        id = 0
    } else {
        smg_name = document.frmEditMainMenu.smg_name
        smg_icon = document.frmEditMainMenu.smg_icon
        let getid = document.frmEditMainMenu.smg_id
        id = parseInt(getid.value)
    }

    // name -----
    if (is_empty(smg_name.value)) {
        form_err(smg_name, "*Please Enter main menu");
        return false;
    } else {
        unique_data = {
            "smg_id": id,
            "smg_name": smg_name.value,
        }
        try {
            var chk_unique = await is_unique(unique_data, url);
            if (chk_unique) {
                form_err(smg_name, "*Main menu is Duplicate");
                return false;
            } else {
                form_ok(smg_name);
                if (is_empty(smg_icon.value)) {
                    form_err(smg_icon, "*Please Enter menu icon");
                    return false;
                } else {
                    form_ok(smg_icon);
                    return true;
                }
            }
        } catch (err) {
            console.log(err); // Handle error
        }
    }
}
async function smd_validate(formType) {
    var name, menu_link, menug_id, id, url, unique_data;
    menug_id = document.getElementById("selMainMenu")
    url = API_URL + "menu_detail/is_unique"
    if (formType == "add") {
        name = document.getElementById("inpSubMenu")
        menu_link = document.getElementById("inpMenuController")
        id = 0
    } else {
        name = document.frmEditSubMenu.smd_name
        menu_link = document.frmEditSubMenu.smd_link
        let getid = document.frmEditSubMenu.smd_id
        id = parseInt(getid.value)
    }

    // name -----
    if (is_empty(menug_id.value)) {
        form_err(menug_id, "*Please Enter Main menu");
        return false;
    } else {
        form_ok(menug_id);
        if (is_empty(name.value)) {
            form_err(name, "*Please Enter menu detail");
            return false;
        } else {
            form_ok(name);
            if (is_empty(menu_link.value)) {
                form_err(menu_link, "*Please Enter controller path");
                return false;
            } else {
                form_ok(menu_link);
                unique_data = {
                    "smg_id": parseInt(menug_id.value),
                    "smd_name": name.value,
                    "smd_id": id
                }
                try {
                    var chk_unique = await is_unique(unique_data, url);
                    if (chk_unique) {
                        form_err(name, "*Menu detail is Duplicate");
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
async function settingUser_validate() {
    var fname, lname, email, spc_id, spg_id, dept, tel;
    let getid = document.frmEditProfile.su_id
    id = parseInt(getid.value)
    fname = document.frmEditProfile.su_firstname
    lname = document.frmEditProfile.su_lastname
    email = document.frmEditProfile.su_email
    dept = document.frmEditProfile.sd_id
    // spc_id = document.frmEditProfile.spc_id
    // tel = document.frmEditProfile.su_tel
    // spg_id = document.frmEditProfile.spg_id

    if (is_empty(fname.value)) {
        form_err(fname, "*Please Enter First name");
        return false;
    } else {
        form_ok(fname);
        if (is_empty(lname.value)) {
            form_err(lname, "*Please Enter Last name");
            return false;
        } else {
            form_ok(lname);
            if (is_empty(email.value)) {
                form_err(email, "*Please Enter email");
                return false;
            } else {
                if (valid_email(email.value)) {
                    form_err(email, "*Please Enter valid email");
                    return false;
                } else {
                    form_ok(email);
                    if (is_empty(dept.value)) {
                        form_err(dept, "*Please Enter Department");
                        return false;
                    } else {
                        form_ok(dept);
                        return true;
                    }
                }
            }
        }
    }
}
async function settingPsw_validate() {
    var su_password, chk_password, id;
    let getid = document.frmChangePassword.su_id
    id = parseInt(getid.value)
    su_password = document.frmChangePassword.su_password
    chk_password = document.frmChangePassword.chk_password

    if (is_empty(su_password.value)) {
        form_err(su_password, "*Please Enter new password");
        return false;
    } else {
        form_ok(su_password);
        if (is_empty(chk_password.value)) {
            form_err(chk_password, "*Please Enter confirm password");
            return false;
        } else {
            if (!is_equal(su_password.value, chk_password.value)) {
                form_err(chk_password, "*Confirm password isn't correct");
                return false;
            } else {
                form_ok(chk_password);
                return true;
            }
        }
    }
}
async function department_validate(formType) {
    var sd_dept_name, sd_dept_cd, sd_plant_cd, id, url, unique_data;
    url = API_URL + "department/is_unique"
    if (formType == "add") {
        sd_dept_name = document.getElementById("inpDepartment")
        sd_dept_cd = document.getElementById("inpDepartmentCd")
        sd_plant_cd = document.getElementById("inpPlant")
        id = 0
    } else {
        sd_dept_name = document.edit_form.sd_dept_name
        sd_dept_cd = document.edit_form.sd_dept_cd
        sd_plant_cd = document.edit_form.sd_plant_cd
        let getid = document.edit_form.sd_id
        id = parseInt(getid.value)
    }

    // name -----
    if (is_empty(sd_dept_name.value)) {
        form_err(sd_dept_name, "*Please Enter department name");
        return false;
    } else if (is_empty(sd_dept_cd.value)) {
        form_err(sd_dept_cd, "*Please Enter department code");
        return false;
    } else if (is_empty(sd_plant_cd.value)) {
        sd_plant_cd = 0;
    } else {
        unique_data = {
            "sd_id": id,
            "sd_plant_cd": parseInt(sd_plant_cd.value),
            "sd_dept_name": sd_dept_name.value,
            "sd_dept_cd": sd_dept_cd.value,
        }
        try {
            var chk_unique = await is_unique(unique_data, url);
            if (chk_unique) {
                form_err(sd_dept_name, "*Department is Duplicate");
                return false;
            } else {
                form_ok(sd_dept_name);
                return true;
            }
        } catch (err) {
            console.log(err); // Handle error
        }
    }
}
async function forgot_validate() {
    let element = document.getElementById("emp_code");
    let url = API_URL + "user/emp_code_unique"
    if (is_empty(element.value)) {
        form_err(element, "*Please Enter employee code");
        return false;
    } else {
        unique_data = {
            "su_id": 0,
            "su_emp_code": emp_code.value
        }
        try {
            var chk_unique = await is_unique(unique_data, url);
            if (!chk_unique) {
                form_err(emp_code, "*This employee code isn't exist");
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
async function swg_validate(formType) {
    var dept, lv, id, url, unique_data;
    url = API_URL + "workflow_group/is_unique"
    if (formType == "add") {
        dept = document.getElementById("selDept")
        lv = document.getElementById("inpMaxLv")
        id = 0
    } else {
        dept = document.edit_formWorkflowGroup.sd_id
        lv = document.edit_formWorkflowGroup.swg_max_level
        let getid = document.edit_formWorkflowGroup.swg_id
        id = parseInt(getid.value)
    }

    // name -----
    if (is_empty(dept.value)) {
        form_err(dept, "*Please Select department");
        return false;
    } else {
        unique_data = {
            "swg_id": id,
            "sd_id": parseInt(dept.value),
            "swg_max_level": parseInt(lv.value),
        }
        try {
            var chk_unique = await is_unique(unique_data, url);
            if (chk_unique) {
                form_err(dept, "*Workflow group is Duplicate");
                form_ok(lv);
                return false;
            } else {
                form_ok(dept);
                if (is_empty(lv.value)) {
                    form_err(lv, "*Please Enter Max level");
                    return false;
                } else {
                    form_ok(lv);
                    return true;
                }
            }
        } catch (err) {
            console.log(err); // Handle error
        }
    }
}
async function swd_validate(formType) {
    var userid, appLv, appType, swg_id, id, url, unique_data;
    swg_id = document.getElementById("selWorkflowGroup")
    url = API_URL + "workflow_detail/is_unique"
    if (formType == "add") {
        appLv = document.getElementById("selAppLv")
        userid = document.getElementById("selUser")
        appType = document.getElementById("selApproveType")
        id = 0
    } else {
        appLv = document.frmEditWorkflow.swd_app_lv
        userid = document.frmEditWorkflow.su_id
        appType = document.frmEditWorkflow.sat_id
        let getid = document.frmEditWorkflow.swd_id
        id = parseInt(getid.value)
    }

    // name -----
    if (is_empty(swg_id.value)) {
        form_err(swg_id, "*Please Enter workflow group");
        return false;
    } else {
        form_ok(swg_id);
        if (is_empty(appLv.value)) {
            form_err(appLv, "*Please Enter approve level");
            return false;
        } else {
            form_ok(appLv);
            if (is_empty(userid.value)) {
                form_err(userid, "*Please Select user");
                return false;
            } else {
                form_ok(userid);
                if (is_empty(appType.value)) {
                    form_err(appType, "*Please Select approve type");
                    return false;
                } else {
                    form_ok(appType);
                    unique_data = {
                        "swd_level_no": parseInt(appLv.value),
                        "swg_id": parseInt(swg_id.value),
                        "swd_id": id,
                        "su_id": parseInt(userid.value),
                    }
                    try {
                        var chk_unique = await is_unique(unique_data, url);
                        if (chk_unique) {
                            form_err(userid, "*Users is already exist");
                            return false;
                        } else {
                            form_ok(userid);
                            return true;
                        }
                    } catch (err) {
                        console.log(err); // Handle error
                    }
                    form_ok(appLv);
                    return true;
                }
            }
        }
    }
}
async function mc_validate(formType) {
    var title, weight, id;
    if (formType == "add") {
        title = document.getElementById("inpTitle")
        weight = document.getElementById("inpCal")
        id = 0
    } else {
        title = document.edit_formConsider.mci_name
        weight = document.edit_formConsider.mci_calculate_type
        let getid = document.edit_formConsider.mci_id
        id = parseInt(getid.value)
    }

    if (is_empty(title.value)) {
        form_err(title, "*Please Enter title");
        return false;
    } else {
        form_ok(title);
        if (is_empty(weight.value)) {
            form_err(weight, "*Please Select Calculate Type");
            return false;
        } else {
            form_ok(weight);
            return true;
        }
    }
}
async function incharge_validate(formType) {
    var consern, dept, id, url, unique_data;
    url = API_URL + "incharge/is_unique"
    if (formType == "add") {
        consern = document.getElementById("selConsern")
        weight = document.getElementById("selWeight")
        dept = document.getElementById("selDept")
        id = 0
    } else {
        consern = document.frmEditConsideration.mci_id
        weight = document.frmEditConsideration.mcip_weight
        dept = document.frmEditConsideration.sd_id
        let getid = document.frmEditConsideration.item_id
        id = parseInt(getid.value)
    }

    if (is_empty(consern.value)) {
        form_err(consern, "*Please Select Consideration");
        return false;
    } else {
        form_ok(consern);
        if (is_empty(weight.value)) {
            form_err(weight, "*Please Enter Weight 0-5");
            return false;
        } else {
            if (weight.value < 0 || weight.value > 5) {
                form_err(weight, "*Please Enter Weight 0-5");
                return false;
            } else {
                form_ok(weight);
                if (is_empty(dept.value)) {
                    form_err(dept, "*Please Select Department");
                    return false;
                } else {
                    if (formType == "edit") {
                        url = API_URL + "incharge/is_unique_edit";
                    }
                    unique_data = {
                        "mcip_id": id,
                        "mci_id": parseInt(consern.value),
                        "mcip_weight": weight.value,
                        "sd_id": parseInt(dept.value),
                    }
                    try {
                        var chk_unique = await is_unique(unique_data, url);
                        if (chk_unique) {
                            form_err(consern, "*Data is Duplicate");
                            form_err(weight, "*Data is Duplicate");
                            form_err(dept, "*Data is Duplicate");
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
    }
}

async function edit_partno(data) {
    var partNo = "";
    var partName = "";
    if (data.length = 5) {
        for (var i = 0; i < data.length; i++) {
            if (data[i].partNo) {
                partNo = data[i].partNo;
            }
            if (data[i].partName) {
                partName = data[i].partName;
            }
        }
    }
    if (is_empty(partNo)) {
        return "err_prtNo";
    } else if (is_empty(partName)) {
        return "err_prtName";
    } else {
        return "ok";
    }
}

async function Feasibility_validate(formType) {

    var if_customer, if_customer_new, if_import_tran, mrt_id, if_ref, refcon, doc_no, id, url;
    url = API_URL + "feasibility/last_id";
    if_ref = "FM-S&M-" + getTwoDigitYear() + "-";
    if (formType == "add") {
        if_customer = document.add_form.if_customer
        if_import_tran = document.add_form.if_import_tran
        if_customer_new = document.add_form.if_customer_new
        mrt_id = document.add_form.mrt_id
        if_qty_part_no = document.add_form.if_qty_part_no
        // refcon = document.getElementById("add_if_ref")
        doc_no = document.getElementById("doc_no")
        id = 0
    } else {
        if_customer = document.edit_form.if_customer
        if_import_tran = document.edit_form.if_import_tran
        mrt_id = document.edit_form.mrt_id
        refcon = document.getElementById("edit_if_ref")
        doc_no = document.getElementById("doc_no")
        let getid = document.edit_form.if_id
        id = parseInt(getid.value)
    }

    var partInsert = [];
    var partNoInputs = $('#form_part_no input[name="if_part_no[]"]');
    var partNameInputs = $('#form_part_no input[name="if_part_name[]"]');
    var modelInputs = $('#form_part_no input[name="ir_model[]"]');

    partNoInputs.each(function (index) {
        var partNo = $(this).val();
        var partName = partNameInputs.eq(index).val();
        var model = modelInputs.eq(index).val();
        if (partNo && partName && model) {
            partInsert.push({ ['partNo' + (index + 1)]: partNo, ['partName' + (index + 1)]: partName, ['model' + (index + 1)]: model });
        }
    });

    if (!is_empty(if_customer.value) && !is_empty(if_customer_new.value)) {
        form_errCus(if_customer, if_customer_new, "*Please select 1 type of customer.");
        $('#navpill-111').addClass('active show');
        $('a[href="#navpill-111"]').addClass('active').attr('aria-selected', 'false');
        $('#navpill-222').removeClass('active show');
        $('a[href="#navpill-222"]').removeClass('active').attr('aria-selected', 'true').removeAttr('tabindex');
        return false;
    } else {
        if (is_empty(if_customer.value) && is_empty(if_customer_new.value)) {
            form_errCus(if_customer, if_customer_new, "*Please select 1 type of customer.");
            $('#navpill-111').addClass('active show');
            $('a[href="#navpill-111"]').addClass('active').attr('aria-selected', 'false');
            $('#navpill-222').removeClass('active show');
            $('a[href="#navpill-222"]').removeClass('active').attr('aria-selected', 'true').removeAttr('tabindex');
            return false;
        } else {
            form_okCus(if_customer, if_customer_new);
            if (is_empty(if_import_tran.value)) {
                form_err(if_import_tran, "*Please Enter Import From");
                $('#navpill-111').addClass('active show');
                $('a[href="#navpill-111"]').addClass('active').attr('aria-selected', 'false');
                $('#navpill-222').removeClass('active show');
                $('a[href="#navpill-222"]').removeClass('active').attr('aria-selected', 'true').removeAttr('tabindex');
                return false;
            } else {
                form_ok(if_import_tran);
                if (is_empty(mrt_id.value)) {
                    form_err(mrt_id, "*Please Enter Requirement");
                    $('#navpill-111').addClass('active show');
                    $('a[href="#navpill-111"]').addClass('active').attr('aria-selected', 'false');
                    $('#navpill-222').removeClass('active show');
                    $('a[href="#navpill-222"]').removeClass('active').attr('aria-selected', 'true').removeAttr('tabindex');
                    return false;
                } else {
                    form_ok(mrt_id);
                    if (formType == "add") {
                        if (is_empty(if_qty_part_no.value)) {
                            form_err(if_qty_part_no, "*Please Enter Quentity Part No.");
                            $('#navpill-111').removeClass('active show');
                            $('a[href="#navpill-111"]').removeClass('active').attr('aria-selected', 'false');
                            $('#navpill-222').addClass('active show');
                            $('a[href="#navpill-222"]').addClass('active').attr('aria-selected', 'true').removeAttr('tabindex');
                            return false;
                        } else {
                            if (partInsert.length == 0) {
                                let indexCount = $('#inpQtyPartNo').val();

                                for (let i = 0; i < indexCount; i++) {
                                    let partNo = document.getElementById('inpPartNo' + i);
                                    let partName = document.getElementById('inpPartName' + i);
                                    let model = document.getElementById('inpModel' + i);

                                    if (is_empty(partNo.value)) {
                                        form_err(partNo, "*Please Enter Part No.");
                                    } else {
                                        form_ok(partNo);
                                    }
                                    if (is_empty(partName.value)) {
                                        form_err(partName, "*Please Enter Part Name");
                                    } else {
                                        form_ok(partName);
                                    }
                                    if (is_empty(model.value)) {
                                        form_err(model, "*Please Enter Part Name");
                                    } else {
                                        form_ok(model);
                                    }
                                }
                            } else {
                                let indexCount = $('#inpQtyPartNo').val();
                                let partName0 = document.getElementById('inpPartName0');
                                form_ok(partName0);

                                for (let i = 1; i < indexCount; i++) {
                                    let partNo = document.getElementById('inpPartNo' + i);
                                    let partName = document.getElementById('inpPartName' + i);
                                    let model = document.getElementById('inpModel' + i);

                                    if (is_empty(partNo.value)) {
                                        form_err(partNo, "*Please Enter Part No.");
                                        return false;
                                    } else {
                                        form_ok(partNo);
                                        if (is_empty(partName.value)) {
                                            form_err(partName, "*Please Enter Part Name");
                                            return false;
                                        } else {
                                            form_ok(partName);
                                            if (is_empty(model.value)) {
                                                form_err(model, "*Please Enter Model");
                                                return false;
                                            } else {
                                                form_ok(model);
                                            }
                                        }
                                    }
                                }
                                if (formType == "add") {
                                    try {
                                        var last_id = await getLastId(url);
                                        // console.log('last :', last_id['last_id']);
                                        if (typeof last_id['last_id'] != "number") {
                                            return false;
                                        } else {
                                            if (++last_id['last_id'] < 10) {
                                                if_ref += "00" + last_id['last_id'];
                                            } else if (last_id['last_id'] < 100) {
                                                if_ref += "0" + last_id['last_id'];
                                            } else {
                                                if_ref += last_id['last_id'];
                                            }
                                            doc_no.value = if_ref;
                                            return true, partInsert;
                                        }
                                    } catch (err) {
                                        console.log(err); // Handle error
                                    }
                                } else {
                                    var duedate = document.edit_form.if_duedate;
                                    if (is_empty(duedate.value)) {
                                        form_err(duedate, "*Please Enter Due date");
                                        return false;
                                    } else {
                                        form_ok(duedate);
                                        return true;
                                    }
                                }
                            }
                        }
                    } else {
                        var duedate = document.edit_form.if_duedate;
                        if (is_empty(duedate.value)) {
                            form_err(duedate, "*Please Enter Due date");
                            return false;
                        } else {
                            form_ok(duedate);
                            return true;
                        }
                    }

                }
            }
        }
    }
}

async function Rfq_validate(formType) {
    var ir_customer, ir_customer_new, if_ref_fm, ir_ref_nbc, ir_pro_life, ir_sop, refcon, id, url, urlDocNo, ir_ref, ir_doc_no;
    var fileInput = document.getElementById('inpFile');
    var files = fileInput.files;

    urlDocNo = API_URL + "rfq/doc_no/2";
    url = API_URL + "rfq/last_id";
    ir_doc_no = await getDocNo(urlDocNo);
    ir_ref = ir_doc_no['doc_no'] + '-';
    if (formType == "add") {
        ir_customer = document.add_form.ir_customer;
        ir_customer_new = document.add_form.ir_customer_new;
        if_ref_fm = document.add_form.if_ref_fm;
        ir_ref_nbc = document.add_form.ir_ref_nbc;
        ir_pro_life = document.add_form.ir_pro_life;
        ir_sop = document.add_form.ir_sop;
        ir_file1 = document.add_form.ir_file;
        refcon = document.getElementById('inpDocNo');
        ir_qty_part_no = document.add_form.ir_qty_part_no
        id = 0;
    } else {
        ir_customer = document.edit_form.ir_customer;
        ir_customer_new = document.edit_form.ir_customer_new;
        if_ref_fm = document.edit_form.if_ref_fm;
        ir_ref_nbc = document.edit_form.ir_ref_nbc;
        ir_pro_life = document.edit_form.ir_pro_life;
        ir_sop = document.edit_form.ir_sop;
        ir_file1 = document.edit_form.ir_file;
        ir_qty_part_no = document.edit_form.ir_qty_part_no
        let getid = document.edit_form.ir_id;
        id = parseInt(getid.value);
    }

    if (!is_empty(ir_customer.value) && !is_empty(ir_customer_new.value)) {
        form_errCus(ir_customer, ir_customer_new, "*Please select 1 type of customer.");
        $('#navpill-111').addClass('active show');
        $('a[href="#navpill-111"]').addClass('active').attr('aria-selected', 'false');
        $('#navpill-222').removeClass('active show');
        $('a[href="#navpill-222"]').removeClass('active').attr('aria-selected', 'true').removeAttr('tabindex');
        return false;
    } else {
        if (is_empty(ir_customer.value) && is_empty(ir_customer_new.value)) {
            form_errCus(ir_customer, ir_customer_new, "*Please select 1 type of customer.");
            $('#navpill-111').addClass('active show');
            $('a[href="#navpill-111"]').addClass('active').attr('aria-selected', 'false');
            $('#navpill-222').removeClass('active show');
            $('a[href="#navpill-222"]').removeClass('active').attr('aria-selected', 'true').removeAttr('tabindex');
            return false;
        } else {
            form_okCus(ir_customer, ir_customer_new);
            cusActive(ir_customer.value);
            if (is_empty(ir_pro_life.value)) {
                form_err(ir_pro_life, "*Please Enter Project Life");
                cusActive(ir_customer.value);
                return false;
            } else {
                if (ir_pro_life.value == 0 || ir_pro_life.value > 10) {
                    form_err(ir_pro_life, "*Please Enter Project Life between 1 to 10");
                    return false;
                }
                form_ok(ir_pro_life);
                if (is_empty(ir_sop.value)) {
                    form_err(ir_sop, "*Please Enter Program Timing Info. (SOP)");
                    cusActive(ir_customer.value);
                    return false;
                } else {
                    form_ok(ir_sop);
                    var partInsert = [];
                    var partNoInputs = $('#form_part_no input[name="ir_part_no[]"]');
                    var partNameInputs = $('#form_part_no input[name="ir_part_name[]"]');
                    var modelInputs = $('#form_part_no input[name="ir_model[]"]');
                    var remarkInputs = $('#form_part_no input[name="ir_remark[]"]');

                    partNoInputs.each(function (index) {
                        var partNo = $(this).val();
                        var partName = partNameInputs.eq(index).val();
                        var model = modelInputs.eq(index).val();
                        var remark = remarkInputs.eq(index).val();
                        if (partNo && partName && model) {
                            partInsert.push({
                                ['partNo' + (index + 1)]: partNo,
                                ['partName' + (index + 1)]: partName,
                                ['model' + (index + 1)]: model,
                                ['remark' + (index + 1)]: remark
                            });
                        }
                    });

                    if (is_empty(ir_qty_part_no.value)) {
                        form_err(ir_qty_part_no, "*Please Enter Quentity Part No.");
                        return false;
                    } else {
                        if (partInsert.length == 0) {
                            let indexCount = $('#inpQtyPartNo').val();
                            for (let i = 0; i < indexCount; i++) {
                                let partNo = document.getElementById('inpPartNo' + i);
                                let partName = document.getElementById('inpPartName' + i);
                                let models = document.getElementById('inpModel' + i);

                                if (is_empty(partNo.value)) {
                                    form_ok(models);
                                    form_err(partNo, "*Please Enter Part No.");
                                    return false;
                                } else {
                                    form_ok(partNo);
                                }
                                if (is_empty(partName.value)) {
                                    form_err(partName, "*Please Enter Part Name");
                                    return false;
                                } else {
                                    form_ok(partName);
                                }
                                if (is_empty(models.value)) {
                                    form_err(models, "*Please Enter Model");
                                    return false;
                                } else {
                                    form_ok(models);
                                }
                            }
                        } else {
                            let indexCount = $('#inpQtyPartNo').val();
                            let partNo0 = document.getElementById('inpPartNo0');
                            let partName0 = document.getElementById('inpPartName0');
                            let model0 = document.getElementById('inpModel0');
                            form_ok(partNo0);
                            form_ok(partName0);
                            form_ok(model0);
                            for (let i = 1; i < indexCount; i++) {
                                let partNo = document.getElementById('inpPartNo' + i);
                                let partName = document.getElementById('inpPartName' + i);
                                let models = document.getElementById('inpModel' + i);

                                if (is_empty(partNo.value)) {
                                    form_err(partNo, "*Please Enter Part No.");
                                    return false;
                                } else {
                                    form_ok(partNo);
                                    if (is_empty(partName.value)) {
                                        form_err(partName, "*Please Enter Part Name");
                                        return false;
                                    } else {
                                        form_ok(partName);
                                        if (is_empty(models.value)) {
                                            form_err(models, "*Please Enter Model");
                                            return false;
                                        } else {
                                            form_ok(models);
                                        }
                                    }
                                }
                            }
                            var fileArr = [];
                            if (formType == "add") {
                                if (files.length == 0) {
                                    fileArr = [];
                                } else {
                                    for (var iFile = 0; iFile < files.length; iFile++) {
                                        fileArr.push(files[iFile].name);
                                    }
                                }
                                try {
                                    var last_id = await getLastId(url);
                                    if (typeof last_id['last_id'] != "number") {
                                        form_err(refcon, "*Error generate reference no.");
                                        return false;
                                    } else {
                                        form_ok(refcon);
                                        if (++last_id['last_id'] < 10) {
                                            if (last_id['last_id'] == 0) {
                                                ir_ref += "001";
                                            } else {
                                                ir_ref += "00" + last_id['last_id'];
                                            }
                                        } else if (last_id['last_id'] < 100) {
                                            ir_ref += "0" + last_id['last_id'];
                                        } else {
                                            ir_ref += last_id['last_id'];
                                        }
                                        refcon.value = ir_ref;
                                        let data = {
                                            fileArr: fileArr,
                                            partInsert: partInsert
                                        }
                                        return true, data;
                                    }
                                } catch (err) {
                                    console.log(err); // Handle error
                                }
                            } else {
                                if (files.length == 0) {
                                    fileArr = [];
                                } else {
                                    for (var iFile = 0; iFile < files.length; iFile++) {
                                        fileArr.push(files[iFile].name);
                                    }
                                }
                                let data = {
                                    fileArr: fileArr,
                                }
                                return true, data;
                            }
                        }
                    }
                }
            }
        }
    }
}

async function Rfq_valid(formType) {
    var id, urlDocNo, ir_doc, ir_doc_no, idc_customer_type, idc_customer_name, mds_id, idc_subject_note, mde_id, idc_enclosures_note, idc_closing_date, idc_plant_cd;

    urlDocNo = API_URL + "rfq/doc_no/RFQ";
    ir_doc_no = await getDocNo(urlDocNo);
    ir_doc = "";

    if (formType == "add") {
        idc_plant_cd = document.add_form.idc_plant_cd;
        idc_customer_type = document.add_form.idc_customer_type;
        idc_customer_name = document.add_form.idc_customer_name;
        mds_id = document.add_form.mds_id;
        idc_subject_note = document.add_form.idc_subject_note;
        mde_id = document.add_form.mde_id;
        idc_enclosures_note = document.add_form.idc_enclosures_note;
        idc_closing_date = document.add_form.idc_closing_date;
        id = 0;
    } else {
        idc_plant_cd = document.edit_form.idc_plant_cd;
        idc_customer_type = document.edit_form.idc_customer_type;
        idc_customer_name = document.edit_form.idc_customer_name;
        mds_id = document.edit_form.mds_id;
        idc_subject_note = document.edit_form.idc_subject_note;
        mde_id = document.edit_form.mde_id;
        idc_enclosures_note = document.edit_form.idc_enclosures_note;
        idc_closing_date = document.edit_form.idc_closing_date;
        let getid = document.edit_form.idc_id;
        id = parseInt(getid.value);
    }
    if (is_empty(idc_customer_type.value)) {
        form_errValid(idc_plant_cd, "*Please Select Plant");
        return false;
    } else {
        form_okValid(idc_plant_cd);
    }

    if (is_empty(idc_customer_type.value)) {
        form_errValid(idc_customer_type, "*Please Select Customer Type");
        return false;
    } else {
        form_okValid(idc_customer_type);
        if (is_empty(idc_customer_name.value)) {
            form_errValid(idc_customer_name, "*Please Select Customer Name");
            return false;
        } else {
            form_okValid(idc_customer_name);
            if (is_empty(mds_id.value)) {
                form_errValid(mds_id, "*Please Subject");
                return false;
            } else {
                form_okValid(mds_id);
                if (idc_subject_note.disabled) {
                    form_okValid(idc_subject_note);
                } else {
                    if (is_empty(idc_subject_note.value)) {
                        form_errValid(idc_subject_note, "*Please Enter Other Subject");
                        return false;
                    } else {
                        form_okValid(idc_subject_note);
                    }
                }
                ////// Enclosures
                if (is_empty(mde_id.value)) {
                    form_errValid(mde_id, "*Please Select Enclosures");
                    return false;
                } else {
                    form_okValid(mde_id);
                    if (idc_enclosures_note.disabled) {
                        form_okValid(idc_enclosures_note);
                    } else {
                        if (is_empty(idc_enclosures_note.value)) {
                            form_errValid(idc_enclosures_note, "*Please Enter Other Enclosures");
                            return false;
                        } else {
                            form_okValid(idc_enclosures_note);
                        }
                    }
                }
                if (is_empty(idc_closing_date.value) || idc_closing_date.value == '') {
                    form_errValid(idc_closing_date, "*Please Select Due Date");
                    return false;
                }
                else {
                    form_okValid(idc_closing_date);
                }

                if (formType == "add") {
                    try {
                        if (typeof ir_doc_no['doc_cur_no_po2'] != "number") {
                            return false;
                        } else {
                            if (++ir_doc_no['doc_cur_no_po2'] < 10) {
                                if (ir_doc_no['doc_cur_no_po2'] == 0) {
                                    ir_doc += "001";
                                } else {
                                    ir_doc += "00" + ir_doc_no['doc_cur_no_po2'];
                                }
                            } else if (ir_doc_no['doc_cur_no_po2'] < 100) {
                                ir_doc += "0" + ir_doc_no['doc_cur_no_po2'];
                            } else {
                                ir_doc += ir_doc_no['doc_cur_no_po2'];
                            }
                            return true, ir_doc_no['doc_run_no'] + '-' + ir_doc;
                        }
                    } catch (err) {
                        console.log(err); // Handle error
                    }
                } else {
                    // console.log(id);
                    if (!id) {
                        return false;
                    }
                    return true, id;
                }
            }
        }
    }
}

async function Fs_valid(formType) {
    var id, urlDocNo, ir_doc, ir_doc_no, idc_customer_type, idc_customer_name, mds_id, idc_subject_note;

    urlDocNo = API_URL + "rfq/doc_no/Feasibility";
    ir_doc_no = await getDocNo(urlDocNo);
    ir_doc = "";

    if (formType == "add") {
        idc_customer_type = document.add_form.idc_customer_type;
        idc_customer_name = document.add_form.idc_customer_name;
        mds_id = document.add_form.mds_id;
        idc_subject_note = document.add_form.idc_subject_note;
        id = 0;
    } else {
        let getid = document.edit_form.idc_id;
        idc_customer_type = document.edit_form.idc_customer_type;
        idc_customer_name = document.edit_form.idc_customer_name;
        mds_id = document.edit_form.mds_id;
        idc_subject_note = document.edit_form.idc_subject_note;
        id = parseInt(getid.value);
    }

    if (is_empty(idc_customer_type.value)) {
        form_errValid(idc_customer_type, "*Please Select Customer Type");
        return false;
    } else {
        form_okValid(idc_customer_type);
        if (is_empty(idc_customer_name.value)) {
            form_errValid(idc_customer_name, "*Please Select Customer Name");
            return false;
        } else {
            form_okValid(idc_customer_name);
            if (is_empty(mds_id.value)) {
                form_errValid(mds_id, "*Please Select Subject");
                return false;
            } else {
                form_okValid(mds_id);
                if (idc_subject_note.disabled) {
                    form_okValid(idc_subject_note);
                } else {
                    if (is_empty(idc_subject_note.value)) {
                        form_errValid(idc_subject_note, "*Please Enter Other Subject");
                        return false;
                    } else {
                        form_okValid(idc_subject_note);
                    }
                }

                if (formType == "add") {
                    try {
                        if (typeof ir_doc_no['doc_cur_no_po2'] != "number") {
                            return false;
                        } else {
                            if (++ir_doc_no['doc_cur_no_po2'] < 10) {
                                if (ir_doc_no['doc_cur_no_po2'] == 0) {
                                    ir_doc += "001";
                                } else {
                                    ir_doc += "00" + ir_doc_no['doc_cur_no_po2'];
                                }
                            } else if (ir_doc_no['doc_cur_no_po2'] < 100) {
                                ir_doc += "0" + ir_doc_no['doc_cur_no_po2'];
                            } else {
                                ir_doc += ir_doc_no['doc_cur_no_po2'];
                            }
                            return true, ir_doc_no['doc_run_no'] + '-' + ir_doc;
                        }
                    } catch (err) {
                        console.log(err); // Handle error
                    }
                } else {
                    // console.log(id);
                    if (!id) {
                        return false;
                    }
                    return true, id;
                }
            }
        }
    }
}

async function cusActive(cus) {
    if (!is_empty(cus)) {
        $('#navpill-111').addClass('active show');
        $('a[href="#navpill-111"]').addClass('active').attr('aria-selected', 'false');
        $('#navpill-222').removeClass('active show');
        $('a[href="#navpill-222"]').removeClass('active').attr('aria-selected', 'true').removeAttr('tabindex');
    } else {
        $('#navpill-222').addClass('active show');
        $('a[href="#navpill-222"]').addClass('active').attr('aria-selected', 'false');
        $('#navpill-111').removeClass('active show');
        $('a[href="#navpill-111"]').removeClass('active').attr('aria-selected', 'true').removeAttr('tabindex');
    }
}

async function scoring_validate(element) {
    let value = element.val();
    if (value > 5 || value < 1 || value != Math.floor(value)) {
        form_err_scoring(element, "*Please enter 1-5");
        return false;
    }

    form_ok_scoring(element);
    return parseInt(element.val());
}

function form_err_scoring(element, message) {
    element.css("border", "1px solid #ff0000");
    element.next().css("display", "block");
    element.next().html(message);
    element.focus();
}

function form_ok_scoring(element) {
    element.css("border", "1px solid #d1d3e2");
    element.next().css("display", "none");
}