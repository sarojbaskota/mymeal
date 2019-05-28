var base_url = "http://localhost:8000";
$("#profile").click(function () {
    var id = $(this).data("id");
    $.ajax({
        url: base_url + "/profile/" + id,
        type: "GET",
        success: function (result) {
            $('#dynamic_modal').html(result);
            $("#edit_user_modal").modal({
                backdrop: "static",
                keyboard: false,
                show: true
            });
        }
    });
});