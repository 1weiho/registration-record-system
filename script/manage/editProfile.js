$(() => {
    getEmployeeProfile();
    let editState = getUrl();
    if (editState == "false") {
        $("#modal-error").modal("show");
    }
    if (editState == "true") {
        $("#modal-success").modal("show");
    }
});

const getUrl = () => {
    let param = new URLSearchParams(window.location.search);
    return param.get("state");
};

const getEmployeeProfile = () => {
    $.ajax({
        url: "../backend/manage/getEmployeeProfile.php",
        method: "POST",
        success: (res) => {
            displayStoreProfile(res);
            changeCheck(res);
        },
    });
};

const displayStoreProfile = (data) => {
    $("#input-employee-name").val(data[0]["employee_name"]);
    $("#input-employee-email").val(data[0]["employee_email"]);
};

const changeCheck = (data) => {
    $("#input-employee-name, #input-employee-email").on("input", function () {
        if (
            $("#input-employee-name").val() == data[0]["employee_name"] &&
            $("#input-employee-email").val() == data[0]["employee_email"]
        ) {
            $("#submit-btn").attr("disabled", true);
        } else {
            $("#submit-btn").removeAttr("disabled");
        }
    });
};
