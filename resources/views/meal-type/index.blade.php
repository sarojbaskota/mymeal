@extends('layouts.user')

@section('content')
<section class="content-header">
      <h1>
        Meal Types 
        <small>Manage types of meals</small>
      </h1>
      <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Meal Type</a></li>
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
        <table id="meal_table" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th style="width: 20px;">SN</th>
                     <th style="width: 140px;">Action</th>
                    <th>Title</th>
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
                    <td> <strong>{{$meal->title}}</strong> </td>
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
        <div class="modal fade" id="meal_types" role="dialog">
                <div class="modal-dialog">
                
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title">Add New</h4>
                    </div>
                    <div class="modal-body">
                    <form id="create_meal">
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" name="title" class="title form-control" placeholder="title" min="0" max="50" step="100" data-parsley-validation-threshold="1" data-parsley-trigger="keyup" data-parsley-pattern="^[a-zA-Z ]+$" required>
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
<script src="{{asset('js/mealtypes.js')}}"></script>
@endsection