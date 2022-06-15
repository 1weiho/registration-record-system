$(() => {
    getStoreProfile();
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

const getStoreProfile = () => {
    $.ajax({
        url: "../backend/store/getStoreProfile.php",
        method: "POST",
        success: (res) => {
            displayStoreProfile(res);
            changeCheck(res);
        },
    });
};

const displayStoreProfile = (data) => {
    $("#input-store-name").val(data[0]["store_name"]);
    $("#input-store-address").val(data[0]["store_address"]);
};

const changeCheck = (data) => {
    $("#input-store-name, #input-store-address").on("input", function () {
        if (
            $("#input-store-name").val() == data[0]["store_name"] &&
            $("#input-store-address").val() == data[0]["store_address"]
        ) {
            console.log("disable");
            $("#submit-btn").attr("disabled", true);
        } else {
            console.log("enable");
            $("#submit-btn").removeAttr("disabled");
        }
    });
};
