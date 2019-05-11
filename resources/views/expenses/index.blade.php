@extends('layouts.user')

@section('content')
<section class="content-header">
      <h1>
       Meal Expenses
        <small>Manage expenses of meals</small>
      </h1>
      <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i>Meal Expenses</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
    <div class="box">
    <div class="box-header">
        <button class=" box-title btn btn-primary" id="Entry_new">New Entry</button>
    </div>
        <!-- /.box-header -->
    <div class="box-body">
        <table id="meal_table" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th style="width: 20px;">SN</th>
                     <th style="width: 140px;">Action</th>
                     <th>Day</th>
                    <th>Meal Type</th>
                    <th>Restaurant</th>
                    <th>Payment</th>
                    <th>Price</th>
                    <th>Remarks</th>
                    <th style="width: 120px;">Created On</th>
                </tr>
            </thead>
            <tbody>
                @foreach($meals as $meal)
                <tr> <td>{{$loop->iteration}}</td>
                      <td>
                      <a class="btn btn-primary btn-sm show_meal" data-id=" {{$meal->id}} " > <i class="glyphicon glyphicon-eye-open" ></i> </a>
                      <a class="btn btn-success btn-sm edit" data-id=" {{$meal->id}} "> <i class="glyphicon glyphicon-edit" ></i> </a>
                      <a class="btn btn-danger btn-sm delete" data-id=" {{$meal->id}} "> <i class="glyphicon glyphicon-trash" ></i> </a>
                      </td>
                      <td>{{$meal->date}}</td>
                    <td>{{$meal->title}}</td>
                    <td>{{$meal->restaurant_name}}</td>
                    <td>{{$meal->payment}}</td>
                    <td>{{$meal->price}}</td>
                    <td>{{$meal->remarks}}</td>
                    <td>{{$meal->created_at}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div id="show_modal"></div>
    </section>
    <!-- /.content -->
      <!--cerate Modal -->
        <div class="modal fade" id="meal_expenses" role="dialog">
                <div class="modal-dialog">
                
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title">New Entry</h4>
                    </div>
                    <div class="modal-body">
                    <form id="create_expenses">
                        <div class="form-group">
                            <label for="date">Date:</label>
                            <input type="date" name="date" class="date form-control" required>
                            <div class="date_error"></div>
                        </div>
                        <div class="form-group">
                            <label for="meal_id">Meal:</label>
                            <select name="meal_id" class="meal_id form-control">
                            <option value="">select</option>
                            @foreach($meal_types as $meal)
                            <option value="{{$meal['id']}}">{{$meal['title']}}</option>
                            @endforeach
                            </select>
                            <div class="meal_id_error"></div>
                        </div>
                        <div class="form-group">
                            <label for="restaurant_id">Restaurant:</label>
                            <select name="restaurant_id" class="restaurant_id form-control">
                            <option value="">select</option>
                            @foreach($restaurants as $restaurant)
                            <option value="{{$restaurant['id']}}">{{$restaurant['restaurant_name']}}</option>
                            @endforeach
                            </select>
                            <div class="restaurant_id_error"></div>
                        </div>
                        <div class="form-group">
                            <label for="price">Price:</label>
                           <input type="number" name="price" class="price form-control">
                           <div class="price_error"></div>
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
                            <input type="date" name="date" class="date form-control" required>
                            <div class="date_error"></div>
                            <input type="hidden" class="id">
                        </div>
                        <div class="form-group">
                            <label for="meal_id">Meal:</label>
                            <select name="meal_id" class="meal_id form-control">
                            <option value="">select</option>
                            @foreach($meal_types as $meal)
                            <option value="{{$meal['id']}}">{{$meal['title']}}</option>
                            @endforeach
                            </select>
                            <div class="meal_id_error"></div>
                        </div>
                        <div class="form-group">
                            <label for="restaurant_id">Restaurant:</label>
                            <select name="restaurant_id" class="restaurant_id form-control">
                            <option value="">select</option>
                            @foreach($restaurants as $restaurant)
                            <option value="{{$restaurant['id']}}">{{$restaurant['restaurant_name']}}</option>
                            @endforeach
                            </select>
                            <div class="restaurant_id_error"></div>
                        </div>
                        <div class="form-group">
                            <label for="price">Price:</label>
                           <input type="number" name="price" class="price form-control">
                           <div class="price_error"></div>
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

@endsection
@section('scripts')
<script src="{{asset('js/expenses.js')}}"></script>
@endsection