$(document).ready(function () {
    var base_url = "http://localhost:8000";
    // parsly
    // create meal types
    $(function () {
        $("#create_meal")
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

    // edit_meal
    $(function () {
        $("#edit_meal")
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
    // hide error if modal close
    $("#meal_types").on("click", ".modal_close", function () {
        // $(".parsley-errors-list").style("display:none"); /*here add style for display none*/
    });
    // create modal
    $("#add_new").click(function () {
        // $("#meal_types").modal("show");
        $("#meal_types").modal({
            backdrop: "static",
            keyboard: false,
            show: true
        });
    });
    $("#modal_close");

    $(".title").keyup(function () {
        $(".actual_error").hide("slow");
    });
    // store
    $("#create_meal").submit(function (e) {
        e.preventDefault();
        var title = $("#create_meal .title").val();
        $.ajax({
            url: base_url + "/meal-type",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            type: "POST",
            data: $(this).serialize(),
            success: function (result) {
                // datatable
                $("#meal_table").load(window.location + " #meal_table");
                // datatable
                if(!result.errors) {
                    swal({
                        title: result.status,
                        icon: "success",
                        button: "Done"
                    }).then(result => {
                        $("#create_meal").trigger("reset");
                        $("#meal_types").modal("toggle");
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
    $("#meal_table").on("click", "tbody .edit", function () {
        var id = $(this).data("id");
        $.ajax({
            url: base_url + "/meal-type/" + id + "/edit",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            type: "GET",
            success: function (result) {
                console.log(result.meal);

                $("#meal_edit").modal({
                    backdrop: "static",
                    keyboard: false,
                    show: true
                });
                $("#meal_edit form .title").val(result.meal.title);
                $("#meal_edit form .id").val(id);
            }
        });
    });
    //update
    $("#edit_meal").submit(function (e) {
        e.preventDefault();
        var id = $("#edit_meal .id").val();
        $.ajax({
            url: base_url + "/meal-type/" + id,
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
                        $("#edit_meal").trigger("reset");
                        $("#meal_edit").modal("toggle");
                        $(".parsley-errors-list").toggleClass("hidden");
                        // datatable
                        $("#meal_table").load(window.location + " #meal_table");
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
    $("#meal_table").on("click", "tbody .delete", function () {
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
                    url: base_url + "/meal-type/" + id,
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
                            $("#meal_table").load(
                                window.location + " #meal_table"
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
    $("#meal_table").on("click", "tbody .show_meal", function (e) {
        var id = $(this).data("id");
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: base_url + "/meal-type/" + id,
            success: function (data) {
                console.log(data);
                $("#show_modal").html(data);
                $("#show_data").modal("show");
            }
        });
    });
});
