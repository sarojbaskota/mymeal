$(document).ready(function () {
    var base_url = "http://localhost:8000";
    $(".settled").click(function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        swal({
            title: "Are you sure?",
            icon: "info",
            buttons: true,
        })
            .then((willAccept) => {
                if(willAccept) {
                    $.ajax({
                        url: base_url + "/settled/" + id,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                        },
                        type: "POST",
                        success: function (result) {
                            swal({
                                title: result.status,
                                icon: "success",
                                button: "Done"
                            }).then(result => {
                                console.log(result);
                                location.reload();
                            });
                        },
                    });
                }
            });
    });
});