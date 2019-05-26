$(document).ready(function () {
    var base_url = "http://localhost:8000";
    // parsly
    // suppliers manage 
    $(function () {
        $("#create_supplier")
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
        $("#edit_supplier")
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
        $("#supplier").modal({
            backdrop: "static",
            keyboard: false,
            show: true
        });
    });
    $("#modal_close");

    $(".supplier_name").keyup(function () {
        $(".actual_error").hide("slow");
    });
    // store
    $("#create_supplier").submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: base_url + "/supplier",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            type: "POST",
            data: $(this).serialize(),
            success: function (result) {
                // datatable
                $("#supplier_table").load(
                    window.location + " #supplier_table"
                );
                // datatable
                if(!result.errors) {
                    swal({
                        title: result.status,
                        icon: "success",
                        button: "Done"
                    }).then(result => {
                        $("#create_supplier").trigger("reset");
                        $("#supplier").modal("toggle");
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
    $("#supplier_table").on("click", "tbody .edit", function () {
        var id = $(this).data("id");
        $.ajax({
            url: base_url + "/supplier/" + id + "/edit",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            type: "GET",
            success: function (result) {
                console.log(result.supplier);

                $("#supplier_edit").modal({
                    backdrop: "static",
                    keyboard: false,
                    show: true
                });
                $("#supplier_edit form .supplier_name").val(
                    result.supplier.supplier_name
                );
                $("#supplier_edit form .id").val(id);
            }
        });
    });
    //update
    $("#edit_supplier").submit(function (e) {
        e.preventDefault();
        var id = $("#edit_supplier .id").val();
        $.ajax({
            url: base_url + "/supplier/" + id,
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
                        $("#edit_supplier").trigger("reset");
                        $("#supplier_edit").modal("toggle");
                        $(".parsley-errors-list").toggleClass("hidden");
                        // datatable
                        $("#supplier_table").load(
                            window.location + " #supplier_table"
                        );
                    });
                }
            }
        });
    });
    // delete
    $("#supplier_table").on("click", "tbody .delete", function () {
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
                    url: base_url + "/supplier/" + id,
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
                            $("#supplier_table").load(
                                window.location + " #supplier_table"
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
    $("#supplier_table").on("click", "tbody .show_supplier", function (e) {
        var id = $(this).data("id");
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: base_url + "/supplier/" + id,
            success: function (data) {
                console.log(data);
                $("#show_modal").html(data);
                $("#show_data").modal("show");
            }
        });
    });
});
