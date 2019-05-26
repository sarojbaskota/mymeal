$(document).ready(function () {
    var base_url = "http://localhost:8000";
    // parsly
    // create expenses_category types
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
        $("#create_expenses_modal").modal({
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
                $("#expenses-table").load(window.location + " #expenses-table");
                // datatable
                if(!result.errors) {
                    swal({
                        title: result.status,
                        icon: "success",
                        button: "Done"
                    }).then(result => {
                        $("#create_expenses").trigger("reset");
                        $("#create_expenses_modal").modal("toggle");
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
                    if(result.errors.expenses_category_id) {
                        $(".expenses_category_id_error").append(
                            "<span class='actual_error'>" + result.errors.expenses_category_id + "</span>"
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
        $("#expenses_edit").trigger("reset");
    });
    $("#expenses-table").on("click", "tbody .edit", function () {
        var id = $(this).data("id");
        $.ajax({
            url: base_url + "/expenses/" + id + "/edit",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            type: "GET",
            success: function (result) {
                console.log(result);
                $("#expenses_edit").modal({
                    backdrop: "static",
                    keyboard: false,
                    show: true
                });
                var onlydate = result.expenses.date.split(' ');
                var newdate = onlydate[0];
                var dt = newdate.split('-');

                var date = dt[1] + "/" + dt[2] + "/" + dt[0];
                // alert(date);
                swal({
                    title: date,
                    icon: "info",
                    button: "Got It"
                });
                //Set value of input date
                $("#expenses_edit .date").val(date);
                $("#expenses_edit .id").val(id);
                $("#expenses_edit").val(result.expenses.expense_id);
                $('#expenses_edit .expenses_category_id option[value=' + result.expenses_category.id + ']').attr('selected', 'selected');
                $('#expenses_edit .supplier_id option[value=' + result.supplier.id + ']').attr('selected', 'selected');
                $('#expenses_edit .payment option[value=' + result.expenses.payment + ']').attr('selected', 'selected');
                $("#expenses_edit .amount").val(result.expenses.amount);
                $("#expenses_edit .remarks").val(result.expenses.remarks);
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
            type: 'PUT',
            data: $('#edit_expenses').serialize(),
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
                        $("#expenses-table").load(window.location + " #expenses-table");
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
                    if(result.errors.expenses_category_id) {
                        $(".expenses_category_id_error").append(
                            "<span class='actual_error'>" + result.errors.expenses_category_id + "</span>"
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
    $("#expenses-table").on("click", "tbody .delete", function () {
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
                            $("#expenses-table").load(
                                window.location + " #expenses-table"
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
    $("#expenses-table").on("click", "tbody .show_expense", function (e) {
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
