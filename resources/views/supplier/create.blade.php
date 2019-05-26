<!--cerate Modal -->
<div class="modal fade" id="supplier" role="dialog">
                <div class="modal-dialog">
                
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title">Add suppliers</h4>
                    </div>
                    <div class="modal-body">
                    <form id="create_supplier">
                        <div class="form-group">
                            <label for="title">Supplier Name:</label>
                            <input type="text" name="supplier_name" class="supplier_name form-control" placeholder="Supplier Name" min="0" max="50" step="100" data-parsley-validation-threshold="1" data-parsley-trigger="keyup" data-parsley-pattern="^[a-zA-Z ]+$" required>
                            <li class="actual_error" style="display: none; "></li>
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