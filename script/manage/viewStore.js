$(() => {
    let store_id = getUrl();
    getStoreInfo(store_id);
    getStoreRegister(store_id);
});

const getUrl = () => {
    let param = new URLSearchParams(window.location.search);
    return param.get("id");
};

const getStoreInfo = (store_id) => {
    $.ajax({
        url: "../backend/manage/getStoreInfo.php",
        method: "POST",
        data: { store_id: store_id },
        success: (res) => {
            if (res) {
                $('#store-name').html(res[0]['store_name']);
                $('#store-address').html(res[0]['store_address']);
            } else {
                let url = 'manageStore.php';
                window.location = url;
            }
        },
    });
}

const getStoreRegister = (store_id) => {
    $.ajax({
        url: "../backend/manage/getStoreRegister.php",
        method: "POST",
        data: { store_id: store_id },
        success: (res) => {
            if (res) {
                res.forEach((element) => {
                    displayRecord(element);
                });
                displayRecordCount(res.length);
            } else {
                let url = 'manageStore.php';
                window.location = url;
            }
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
        <td>${data["register_time"]}</td>
    </tr>
    `;
    $("#register-table").prepend(html);
};

const displayRecordCount = (data) => {
    $("#record-count").html(data);
};

const showRegisterInfo = (data) => {
    let html = `
        家長姓名：${data["parent_name"]}<br>
        家長電話：${data["phone_num"]}<br>
        店家：${data["store_name"]}<br>
        店家地址：${data["store_address"]}<br>
        報名時間：${data["register_time"]}<br>
    `;
    $("#modal-text").html(html);
    $("#modal-error").modal("show");
};
