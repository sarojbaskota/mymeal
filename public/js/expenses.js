$(document).ready(function () {
    var base_url = "http://localhost:8000";
    // parsly
    // create meal types
    $(function () {
        $("#create_expenses")
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
    $("#Entry_new").click(function () {
        $("#meal_expenses").modal({
            backdrop: "static",
            keyboard: false,
            show: true
        });
    });
    $("#modal_close");

    $(".form-group input").focusin(function () {
        $(".actual_error").hide();
    });
    $(".form-group select").change(function () {
        $(".actual_error").hide();
    });
    $(".form-group .date").change(function () {
        $(".actual_error").hide();
    });
    $(".modal_close").click(function () {
        $(".actual_error").hide();
    });
    // store
    $("#create_expenses").submit(function (e) {
        e.preventDefault();
        var title = $("#create_expenses .title").val();
        $.ajax({
            url: base_url + "/expenses",
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
                        $("#create_expenses").trigger("reset");
                        $("#meal_expenses").modal("toggle");
                        $(".parsley-errors-list").toggleClass("hidden");
                    });
                }
                if(result.errors) {
                    if(result.errors.date) {
                        $(".date_error").append(
                            "<span class='actual_error'>" + result.errors.date + "</span>"
                        );
                    }
                    if(result.errors.payment) {
                        $(".payment_error").append(
                            "<span class='actual_error'>" + result.errors.payment + "</span>"
                        );
                    }
                    if(result.errors.meal_id) {
                        $(".meal_id_error").append(
                            "<span class='actual_error'>" + result.errors.meal_id + "</span>"
                        );
                    }
                    if(result.errors.restaurant_id) {
                        $(".restaurant_id_error").append(
                            "<span class='actual_error'>" + result.errors.restaurant_id + "</span>"
                        );
                    }
                    if(result.errors.price) {
                        $(".price_error").append(
                            "<span class='actual_error'>" + result.errors.price + "</span>"
                        );
                    }
                    if(result.errors.remarks) {
                        $(".remarks_error").append(
                            "<span class='actual_error'>" + result.errors.remarks + "</span>"
                        );
                    }
                    $(".parsley-required").hide();
                    $(".parsley-range").hide();
                }
            }
        });
    });
    // open edit
    $(".modal_close").click(function () {
        $("#edit_expenses").trigger("reset");
    });
    $("#meal_table").on("click", "tbody .edit", function () {
        var id = $(this).data("id");
        $.ajax({
            url: base_url + "/expenses/" + id + "/edit",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            type: "GET",
            success: function (result) {
                console.log(result.meal.title);
                $("#expenses_edit").modal({
                    backdrop: "static",
                    keyboard: false,
                    show: true
                });
                var onlydate = result.expense.date.split(' ');
                var newdate = onlydate[0];
                var dt = newdate.split('-');

                var date = dt[1] + "/" + dt[2] + "/" + dt[0];
                swal({
                    title: date,
                    icon: "info",
                    button: "Got It"
                });
                //Set value of input date
                $("#edit_expenses .date").val(date);
                $("#edit_expenses .id").val(id);
                $("#edit_expenses").val(result.expense.expense_id);
                $('#edit_expenses .meal_id option[value=' + result.meal.id + ']').attr('selected', 'selected');
                $('#edit_expenses .restaurant_id option[value=' + result.restaurant.id + ']').attr('selected', 'selected');
                $('#edit_expenses .payment option[value=' + result.expense.payment + ']').attr('selected', 'selected');
                $("#edit_expenses .price").val(result.expense.price);
                $("#edit_expenses .remarks").val(result.expense.remarks);
            }
        });
    });
    //update
    $("#edit_expenses").submit(function (e) {
        e.preventDefault();
        var id = $("#edit_expenses .id").val();
        $.ajax({
            url: base_url + "/expenses/" + id,
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
                        $("#edit_expenses").trigger("reset");
                        $("#expenses_edit").modal("toggle");
                        $(".parsley-errors-list").toggleClass("hidden");
                        // datatable
                        $("#meal_table").load(window.location + " #meal_table");
                        // datatable
                    });
                }
                if(result.errors) {
                    if(result.errors.date) {
                        $(".date_error").append(
                            "<span class='actual_error'>" + result.errors.date + "</span>"
                        );
                    }
                    if(result.errors.payment) {
                        $(".payment_error").append(
                            "<span class='actual_error'>" + result.errors.payment + "</span>"
                        );
                    }
                    if(result.errors.meal_id) {
                        $(".meal_id_error").append(
                            "<span class='actual_error'>" + result.errors.meal_id + "</span>"
                        );
                    }
                    if(result.errors.restaurant_id) {
                        $(".restaurant_id_error").append(
                            "<span class='actual_error'>" + result.errors.restaurant_id + "</span>"
                        );
                    }
                    if(result.errors.price) {
                        $(".price_error").append(
                            "<span class='actual_error'>" + result.errors.price + "</span>"
                        );
                    }
                    if(result.errors.remarks) {
                        $(".remarks_error").append(
                            "<span class='actual_error'>" + result.errors.remarks + "</span>"
                        );
                    }
                    $(".parsley-required").hide();
                    $(".parsley-range").hide();
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
                    url: base_url + "/expenses/" + id,
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
            url: base_url + "/expenses/" + id,
            success: function (data) {
                console.log(data);
                $("#show_modal").html(data);
                $("#show_data").modal("show");
            }
        });
    });
});
