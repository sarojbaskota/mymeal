$(document).ready(function () {
    var base_url = "http://localhost:8000";
    // parsly
    // restaurants manage 
    $(function () {
        $("#create_restaurant")
            .parsley()
            .on("field:validated", function () {
                var ok = $(".parsley-error").length === 0;
                $(".bs-callout-info").toggleClass("hidden", !ok);
                $(".bs-callout-warning").toggleClass("hidden", ok);
            })
            .on("form:submit", function () {
                return false; // Don't submit form for this demo
            });
    });
    $(function () {
        $("#edit_restaurant")
            .parsley()
            .on("field:validated", function () {
                var ok = $(".parsley-error").length === 0;
                $(".bs-callout-info").toggleClass("hidden", !ok);
                $(".bs-callout-warning").toggleClass("hidden", ok);
            })
            .on("form:submit", function () {
                return false; // Don't submit form for this demo
            });
    });
    // create modal
    $("#add_new").click(function () {
        $("#restaurant").modal({
            backdrop: "static",
            keyboard: false,
            show: true
        });
    });
    $("#modal_close");

    $(".restaurant_name").keyup(function () {
        $(".actual_error").hide("slow");
    });
    // store
    $("#create_restaurant").submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: base_url + "/restaurant",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            type: "POST",
            data: $(this).serialize(),
            success: function (result) {
                // datatable
                $("#restaurant_table").load(
                    window.location + " #restaurant_table"
                );
                // datatable
                if(!result.errors) {
                    swal({
                        title: result.status,
                        icon: "success",
                        button: "Done"
                    }).then(result => {
                        $("#create_restaurant").trigger("reset");
                        $("#restaurant").modal("toggle");
                        $(".parsley-errors-list").toggleClass("hidden");
                    });
                }
                if(result.errors) {
                    $(".parsley-required").hide();
                    $(".parsley-range").hide();
                    $(".actual_error").remove();
                    $(".parsley-errors-list").append(
                        "<li class='actual_error'>" + result.errors + "</li>"
                    );
                }
            }
        });
    });
    // open edit
    $("#restaurant_table").on("click", "tbody .edit", function () {
        var id = $(this).data("id");
        $.ajax({
            url: base_url + "/restaurant/" + id + "/edit",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            type: "GET",
            success: function (result) {
                console.log(result.restaurant);

                $("#restaurant_edit").modal({
                    backdrop: "static",
                    keyboard: false,
                    show: true
                });
                $("#restaurant_edit form .restaurant_name").val(
                    result.restaurant.restaurant_name
                );
                $("#restaurant_edit form .id").val(id);
            }
        });
    });
    //update
    $("#edit_restaurant").submit(function (e) {
        e.preventDefault();
        var id = $("#edit_restaurant .id").val();
        $.ajax({
            url: base_url + "/restaurant/" + id,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            type: "PUT",
            data: $(this).serialize(),
            success: function (result) {
                if(!result.errors) {
                    swal({
                        title: result.status,
                        icon: "success",
                        button: "Done"
                    }).then(result => {
                        $("#edit_restaurant").trigger("reset");
                        $("#restaurant_edit").modal("toggle");
                        $(".parsley-errors-list").toggleClass("hidden");
                        // datatable
                        $("#restaurant_table").load(
                            window.location + " #restaurant_table"
                        );
                        // datatable
                    });
                }
                if(result.errors) {
                    $(".parsley-required").hide();
                    $(".parsley-range").hide();
                    $(".actual_error").remove();
                    $(".parsley-errors-list").append(
                        "<li class='actual_error'>" + result.errors + "</li>"
                    );
                }
            }
        });
    });
    // delete
    $("#restaurant_table").on("click", "tbody .delete", function () {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this data !",
            icon: "warning",
            buttons: true,
            dangerMode: true
        }).then(willDelete => {
            if(willDelete) {
                var id = $(this).data("id");
                $.ajax({
                    url: base_url + "/restaurant/" + id,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        )
                    },
                    type: "DELETE",
                    success: function (result) {
                        swal({
                            title: result.status,
                            icon: "success",
                            button: "Done"
                        }).then(result => {
                            // datatable
                            $("#restaurant_table").load(
                                window.location + " #restaurant_table"
                            );
                            // datatable
                        });
                    }
                });
            } else {
                swal("Your Data is safe!");
            }
        });
    });
    // show details
    // view quick details of user
    $("#restaurant_table").on("click", "tbody .show_restaurant", function (e) {
        var id = $(this).data("id");
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: base_url + "/restaurant/" + id,
            success: function (data) {
                console.log(data);
                $("#show_modal").html(data);
                $("#show_data").modal("show");
            }
        });
    });
});
