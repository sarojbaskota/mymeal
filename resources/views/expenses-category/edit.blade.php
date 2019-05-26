<!--edit Modal -->
<div class="modal fade" id="meal_edit" role="dialog">
        <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Add New</h4>
            </div>
            <div class="modal-body">
            <form id="edit_meal">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" name="title" class="title form-control" placeholder="title" min="0" max="50" step="100" data-parsley-validation-threshold="1" data-parsley-trigger="keyup" data-parsley-pattern="^[a-zA-Z ]+$" required>
                    <li class="actual_error" style="display: none; "></li>
                    <input type="hidden" name="id" class="id">
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
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
