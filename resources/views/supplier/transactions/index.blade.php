@extends('layouts.user')

@section('content')
<section class="content-header">
      <h1>
       Suppliers
        <small>{{config('app.name')}}</small>
      </h1>
      <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Suppliers</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content container-fluid">
    <div class="box">
    <div class="box-header">
       supplier name
    </div>
        <!-- /.box-header -->
    <div class="box-body">
        <table id="supplier_table" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th style="width: 20px;">SN</th>
                    <th>Expense on</th>
                    <th>Amount</th>
                    <th style="width: 120px;">Day</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transactions)
                <tr> <td>{{$loop->iteration}}</td>
                    <td> <strong>{{$transactions->title}}</strong> </td>
                    <td>{{$transactions->amount}}</td>
                    <td>{{$transactions->date}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
    </section>
@endsection