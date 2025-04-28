async function getTimeAgo(createdDate) {
    const createdTime = new Date(createdDate);
    const now = new Date();
    const diffMs = now - createdTime;

    const diffMinutes = Math.floor(diffMs / 60000);
    const diffHours = Math.floor(diffMs / 3600000);
    const diffDays = Math.floor(diffMs / 86400000);
    const diffMonths = Math.floor(diffMs / (30 * 86400000));
    const diffYears = Math.floor(diffMs / (365 * 86400000));

    if (diffYears > 0) {
        return `${diffYears} year${diffYears > 1 ? 's' : ''} ago`;
    } else if (diffMonths > 0) {
        return `${diffMonths} month${diffMonths > 1 ? 's' : ''} ago`;
    } else if (diffDays > 0) {
        return `${diffDays} day${diffDays > 1 ? 's' : ''} ago`;
    } else if (diffHours > 0) {
        return `${diffHours} hour${diffHours > 1 ? 's' : ''} ago`;
    } else if (diffMinutes > 0) {
        return `${diffMinutes} min ago`;
    } else {
        return 'Just now';
    }
}

async function notifyClick(id, status_type) {
    await $.ajax({
        type: 'PUT',
        url: API_URL + "notify/update/" + id,
        success: function (result) {
            if (result) {
                alertNotification();
            }
        }
    });
}

async function alertNotification() {
    var su_id = document.getElementById('suID').value;
    var su_username = document.getElementById('sessUsr').value;
    $.ajax({
        method: "GET",
        url: API_URL + 'notify/alert/' + su_id + '/' + su_username,
        success: async function (data) {
            // console.log(data);
            var html = '';
            let bgColor = '';
            let newNoti = 0;
            for (var i = 0; i < data.length; i++) {
                if (data[i].snc_type == 1) {
                    let str_username = data[i].ida_created_by.slice(2);
                    const timeAgo = await getTimeAgo(data[i].snc_created_date);
                    if (data[i].su_id == su_id) {
                        bgColor = data[i].snc_read_status == 0 ? (newNoti++, 'bg-info-subtle') : '';
                        html += `<button type="button" class="py-6 px-7 d-flex align-items-center dropdown-item mb-1 ${bgColor}" onclick="notifyClick(${data[i].snc_id}, ${data[i].snc_type})">
                                    <span class="me-3">
                                        <img class="rounded-circle" width="35" height="35" alt="" src="http://192.168.161.207/tbkk_shopfloor_sys/asset/img_emp/${str_username}.jpg" onerror="this.onerror=null; this.src='http://192.168.161.219/ticketMaintenance//assets/img/avatars/no-avatar.png'">
                                    </span>
                                    <div class="w-100">
                                        <h6 class="mb-1 fw-semibold lh-base" style="white-space: normal;">${data[i].snc_show_users}</h6>
                                        <span class="fs-2 d-block text-body-secondary">Please check the documents.</span>
                                        <span class="fs-2 d-block text-body-secondary">${timeAgo}</span>
                                    </div>
                                </button>`;
                    }
                }
                if (data[i].snc_type == 2) {
                    let str_username = data[i].ida_created_by.slice(2);
                    const timeAgo = await getTimeAgo(data[i].snc_created_date);
                    if (data[i].ida_created_by == su_username) {
                        bgColor = data[i].snc_read_status == 0 ? (newNoti++, 'bg-info-subtle') : '';
                        html += `<button type="button" class="py-6 px-7 d-flex align-items-center dropdown-item mb-1 ${bgColor}" onclick="notifyClick(${data[i].snc_id}, ${data[i].snc_type})">
                                    <span class="me-3">
                                        <img class="rounded-circle" width="35" height="35" alt="" src="http://192.168.161.207/tbkk_shopfloor_sys/asset/img_emp/${str_username}.jpg" onerror="this.onerror=null; this.src='http://192.168.161.219/ticketMaintenance//assets/img/avatars/no-avatar.png'">
                                    </span>
                                    <div class="w-100">
                                        <h6 class="mb-1 fw-semibold lh-base" style="white-space: normal;">${data[i].snc_show_users}</h6>
                                        <span class="fs-2 d-block fw-semibold text-body-secondary">Please check the documents.</span>
                                        <span class="fs-2 d-block text-body-secondary">${timeAgo}</span>
                                    </div>
                                </button>`;

                    }
                }
            }
            if (newNoti == 0) {
                $('a .notification').removeClass('bg-primary');
            } else {
                $('a .notification').addClass('bg-primary');
            }
            html += '<div class="p-2"></div>';
            $('#notificationBody').html(html);
            $('#notificationCount').text(newNoti + ' New');
        },
    });
}

$(document).ready(function () {
    function alertNotificationRecursive() {
        alertNotification().then(() => {
            setTimeout(alertNotificationRecursive, 600000);
        }).catch(err => {
            console.error(err);
            setTimeout(alertNotificationRecursive, 600000);
        });
    }

    alertNotificationRecursive();
});
