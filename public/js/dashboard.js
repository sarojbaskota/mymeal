$(document).ready(function () {
    var base_url = "http://localhost:8000";
    $("#meal_info").submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: base_url + "/quick-info",
            type: "GET",
            data: $(this).serialize(),
            success: function (response) {
                $("#result").show();
                if(response.errors) {
                    $("#result span").text("Error");
                }
                $("#result span").text(response.total);
            }
        });
    });

    $("#meal_payment").submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: base_url + "/payment-info",
            type: "GET",
            data: $(this).serialize(),
            success: function (response) {
                $("#payment").show();
                if(response.errors) {
                    $("#payment span").text("Error");
                }
                $("#payment span").text(response.total);
            }
        });
    });
    $(".btn-box-tool").click(function () {
        $("#payment").hide();
        $("#result").hide();
    });
});