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
                     <dd>Meal Type</dd>
                     <dt>
                       {{$expense->title}}
                     </dt>
                     <dd>Restaurant</dd>
                     <dt>
                       {{$expense->restaurant_name}}
                     </dt>
                     <dd>Payment</dd>
                     <dt>
                       {{$expense->payment}}
                     </dt>
                     <dd>Price</dd>
                     <dt>
                       {{$expense->price}}
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