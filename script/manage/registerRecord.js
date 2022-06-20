$(() => {
    getRegisterRecord();
});

const getRegisterRecord = () => {
    $.ajax({
        url: "../backend/manage/getRegisterRecord.php",
        method: "POST",
        success: (res) => {
            res.forEach((element) => {
                displayRecord(element);
            });
            displayRecordCount(res.length);
        },
    });
};

const getRegisterInfo = (register_id) => {
    $.ajax({
        url: "../backend/manage/getRegisterInfo.php",
        method: "POST",
        data: { register_id: register_id },
        success: (res) => {
            showRegisterInfo(res[0]);
        },
    });
};

const displayRecord = (data) => {
    let html = `
    <tr onclick="getRegisterInfo(${data["register_id"]});">
        <td>${data["serial_num"]}</td>
        <td>${data["parent_name"]}</td>
        <td>${data["phone_num"]}</td>
        <td>${data["store_name"]}</td>
    </tr>
    `;
    $("#register-table").prepend(html);
};

const displayRecordCount = (data) => {
    $("#record-count").html(data);
};

const showRegisterInfo = (data) => {
    let html = `
        家長姓名：${data['parent_name']}<br>
        家長電話：${data['phone_num']}<br>
        店家：${data['store_name']}<br>
        店家地址：${data["store_address"]}<br>
        報名時間：${data['register_time']}<br>
    `
    $("#modal-text").html(html);
    $("#modal-error").modal("show");
};
