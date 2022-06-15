$(() => {
    getRegisterRecord();
});

const getRegisterRecord = () => {
    $.ajax({
        url: "../backend/store/getRegisterRecord.php",
        method: "POST",
        success: (res) => {
            res.forEach((element) => {
                displayRecord(element);
            });
            displayRecordCount(res.length);
        },
    });
};

const displayRecord = (data) => {
    let html = `
    <tr>
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
