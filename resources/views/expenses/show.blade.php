<!-- show Modal -->
<!-- Modal -->
<div class="modal fade" id="show_data" role="dialog">
                <div class="modal-dialog">
                
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title">Details of Expenses</h4>
                    </div>
                    <div class="modal-body">
                    <dl>
                    <dd>Day</dd>
                     <dt>
                       {{$expense->date}}
                     </dt>
                     <dd>Expenses Category</dd>
                     <dt>
                       {{$expense->title}}
                     </dt>
                     <dd>Supplier</dd>
                     <dt>
                       {{$expense->supplier_name}}
                     </dt>
                     <dd>Payment</dd>
                     <dt>
                       {{$expense->payment}}
                     </dt>
                     <dd>Amount</dd>
                     <dt>
                       {{$expense->amount}}
                     </dt>
                     <dd>Remarks</dd>
                     <dt>
                       {{$expense->remarks}}
                     </dt>
                     <dd>Created On</dd>
                     <dt>
                       {{$expense->created_at}}
                     </dt>
                    </dl>
                        </div>
                </div>
                            </div>
                        </div>
                        
                        </div>
            </div>
    <!-- modal -->
<!-- end modal -->