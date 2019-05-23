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
    </div>
        <!-- /.box-header -->
    <div class="box-body">
        <table id="meal_table" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th style="width: 20px;">SN</th>
                     <th style="width: 20px;">Settled</th>
                    <th>Expenses</th>
                    <th>Restaurant</th>
                    <th>Payment</th>
                    <th>Price</th>
                    <th>Date</th>
                    <th>Remarks</th>
                    <th style="width: 120px;">Created On</th>
                </tr>
            </thead>
            <tbody>
                @foreach($expenses as $expense)
                <tr> 
                    <td>{{$loop->iteration}}</td>
                    <td>
                    <a class="btn btn-primary btn-sm settled" data-id=" {{$expense->id}} " > <i class="glyphicon glyphicon-ok" ></i> </a>
                    </td>
                    <td>{{$expense->title}}</td>
                    <td>{{$expense->restaurant_name}}</td>
                    <td>{{$expense->payment}}</td>
                    <td>{{$expense->price}}</td>
                    <td>{{$expense->date}}</td>
                    <td>{{$expense->remarks}}</td>
                    <td>{{$expense->created_at}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{asset('js/payment.js')}}"></script>
@endsection