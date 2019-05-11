@extends('layouts.user')

@section('content')
<section class="content-header">
      <h1>
       Restaurants
        <small>Manage Restaurants</small>
      </h1>
      <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Restaurant</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content container-fluid">
    <div class="box">
    <div class="box-header">
        <button class=" box-title btn btn-primary" id="add_new">Add New</button>
    </div>
        <!-- /.box-header -->
    <div class="box-body">
        <table id="restaurant_table" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th style="width: 20px;">SN</th>
                     <th style="width: 145px;">Action</th>
                    <th>Restaurant Name</th>
                    <th style="width: 120px;">Created On</th>
                </tr>
            </thead>
            <tbody>
                @foreach($restaurants as $restaurant)
                <tr> <td>{{$loop->iteration}}</td>
                      <td>
                      <a class="btn btn-primary btn-sm show_restaurant" data-id=" {{$restaurant->id}} " > <i class="glyphicon glyphicon-eye-open" ></i> </a>
                      <a class="btn btn-success btn-sm edit" data-id=" {{$restaurant->id}} "> <i class="glyphicon glyphicon-edit" ></i> </a>
                      <a class="btn btn-danger btn-sm delete" data-id=" {{$restaurant->id}} "> <i class="glyphicon glyphicon-trash" ></i> </a>

                      </td>
                    <td> <strong>{{$restaurant->restaurant_name}}</strong> </td>
                    <td>{{$restaurant->created_at}}</td>
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
        <div class="modal fade" id="restaurant" role="dialog">
                <div class="modal-dialog">
                
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title">Add Restaurants</h4>
                    </div>
                    <div class="modal-body">
                    <form id="create_restaurant">
                        <div class="form-group">
                            <label for="title">Restaurant Name:</label>
                            <input type="text" name="restaurant_name" class="restaurant_name form-control" placeholder="Restaurant Name" min="0" max="50" step="100" data-parsley-validation-threshold="1" data-parsley-trigger="keyup" data-parsley-pattern="^[a-zA-Z ]+$" required>
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
<!--edit Modal -->
    <div class="modal fade" id="restaurant_edit" role="dialog">
        <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Edit Restaurant</h4>
            </div>
            <div class="modal-body">
            <form id="edit_restaurant">
                <div class="form-group">
                    <label for="Restaurant Name">Restaurant Name:</label>
                    <input type="text" name="restaurant_name" class="restaurant_name form-control" placeholder="restaurant_name" min="0" max="50" step="100" data-parsley-validation-threshold="1" data-parsley-trigger="keyup" data-parsley-pattern="^[a-zA-Z ]+$" required>
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

@endsection
@section('scripts')
<script src="{{asset('js/restaurant.js')}}"></script>
<!-- <script src="{{asset('js/parsley.js')}}"></script> -->
@endsection