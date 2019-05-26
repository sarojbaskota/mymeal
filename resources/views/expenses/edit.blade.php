<!--edit Modal -->
    <!--cerate Modal -->
    <div class="modal fade" id="expenses_edit" role="dialog">
                <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title">Entry Edit</h4>
                    </div>
                    <div class="modal-body">
                    <form id="edit_expenses">
                        <div class="form-group">
                            <label for="date">Date:</label>
                            <input type="date" name="date" class="date form-control">
                            <div class="date_error"></div>
                            <input type="hidden" class="id">
                        </div>
                        <div class="form-group">
                            <label for="expenses_category_id">Expenses Category:</label>
                            <select name="expenses_category_id" class="expenses_category_id form-control">
                            <option value="">select</option>
                            @foreach($expenses_categories as $expenses_category)
                            <option value="{{$expenses_category['id']}}">{{$expenses_category['title']}}</option>
                            @endforeach
                            </select>
                            <div class="expenses_category_id_error"></div>
                        </div>
                        <div class="form-group">
                            <label for="supplier_id">Supplier:</label>
                            <select name="supplier_id" class="supplier_id form-control">
                            <option value="">select</option>
                            @foreach($suppliers as $supplier)
                            <option value="{{$supplier['id']}}">{{$supplier['supplier_name']}}</option>
                            @endforeach
                            </select>
                            <div class="supplier_id_error"></div>
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount:</label>
                           <input type="number" name="amount" class="amount form-control">
                           <div class="amount_error"></div>
                        </div>
                        <div class="form-group">
                            <label for="payment">Payment:</label>
                            <select name="payment" class="payment form-control">
                            <option value="0">Select</option>
                            <option value="paid">Paid</option>
                            <option value="pending">Pending</option>
                            </select>
                            <div class="payment_error"></div>
                        </div>
                        <div class="form-group">
                            <label for="remarks">Remarks:</label>
                           <input type="text" name="remarks" class="remarks form-control">
                           <div class="remarks_error"></div>
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
<!-- modal -->