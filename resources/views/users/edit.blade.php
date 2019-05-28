  <!--cerate Modal -->
<div class="modal fade" id="edit_user_modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">My Profile</h4>
            </div>
                    <div class="modal-body">
                        <form id="create_expenses">
                            <div class="form-group">
                                <label for="date">Name:</label>
                                <input type="text" name="name" class="form-control">
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                            </div>
                        </form>
                         <div class="form-group row">
                             <div class="col-md-6">
                               <button type="submit" class="btn btn-primary btn-sm modal_close" data-dismiss="modal">Update</button>
                             </div>
                             <div class="col-md-6">
                               <button type="button" class="btn btn-danger btn-sm modal_close" data-dismiss="modal">Close</button>
                             </div>
                         </div>
                    </div>
        </div>
     </div>
</div>
<!-- modal -->