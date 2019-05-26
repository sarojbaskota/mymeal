<!--edit Modal -->
<div class="modal fade" id="supplier_edit" role="dialog">
        <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Edit supplier</h4>
            </div>
            <div class="modal-body">
            <form id="edit_supplier">
                <div class="form-group">
                    <label for="supplier Name">supplier Name:</label>
                    <input type="text" name="supplier_name" class="supplier_name form-control" placeholder="supplier_name" min="0" max="50" step="100" data-parsley-validation-threshold="1" data-parsley-trigger="keyup" data-parsley-pattern="^[a-zA-Z ]+$" required>
                    <li class="actual_error" style="display: none; "></li>
                    <input type="hidden" class="id">
                </div>
                <div class="modal-footer">
                <div class=" row">
                    <div class="form-group col-md-6">
                    <button type="submit" class="btn btn-success pull-left">Submit</button>
                    </div>
            </form>
                    <div class="form-group col-md-6">
                    <button type="button" class="btn btn-danger modal_close" data-dismiss="modal">Close</button>
                    </div>
                </div>
                </div>
                </div>
            </div>
            
            </div>
    </div>
<!-- modal -->
