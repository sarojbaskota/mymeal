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
        <table id="expenses-table" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th style="width: 20px;">SN</th>
                    <th style="width: 140px;">Action</th>
                    <th>Day</th>
                    <th>Expenses Category</th>
                    <th>Supplier</th>
                    <th>Payment</th>
                    <th>Amount</th>
                    <th>Remarks</th>
                    <th style="width: 120px;">Created On</th>
                </tr>
            </thead>
            <tbody>
                @foreach($expenses as $expense)
                <tr> 
                    <td>{{$loop->iteration}}</td>
                    <td>
                        <a class="btn btn-primary btn-sm show_expense" data-id=" {{$expense->id}} " > <i class="glyphicon glyphicon-eye-open" ></i> </a>
                        <a class="btn btn-success btn-sm edit" data-id=" {{$expense->id}} "> <i class="glyphicon glyphicon-edit" ></i> </a>
                        <a class="btn btn-danger btn-sm delete" data-id=" {{$expense->id}} "> <i class="glyphicon glyphicon-trash" ></i> </a>
                    </td>
                    <td>{{$expense->date}}</td>
                    <td>{{$expense->title}}</td>
                    <td>{{$expense->supplier_name}}</td>
                    <td class="{{($expense->payment == 'pending')? 'callout callout-danger' : ''}}" >{{$expense->payment}}</td>
                    <td>{{$expense->amount}}</td>
                    <td>{{$expense->remarks}}</td>
                    <td>{{$expense->created_at}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
    <div id="show_modal"></div>
</section>
<!-- /.content -->
@include('expenses.create')
@include('expenses.edit')
@endsection
@section('scripts')
<script src="{{asset('js/expenses.js')}}"></script>
@endsection