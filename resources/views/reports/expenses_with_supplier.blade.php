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
       <form id="monthlyForm" action="{{url('expenses-with-supplier')}}" method="GET">
            <div class="row">
                <div class="form-group col-md-2">
                    <select name="year" class="form-control">
                    <option value="0">Year</option>
                    @foreach(config('custom.dates.years')  as $key => $value)
                        <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>   
                <div class="form-group col-md-2">
                    <select name="month" class="form-control">
                    <option value="0">Month</option>
                        @foreach(config('custom.dates.months')  as $key => $value)
                        <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div> 
                <div class="form-group col-md-2">
                    <select name="supplier_id" class="form-control">
                    <option value="0">Supplier</option>
                        @foreach($suppliers  as $supplier)
                        <option value="{{$supplier->id}}">{{$supplier->supplier_name}}</option>
                        @endforeach
                    </select>
                </div> 
                <div class="form-group col-md-2">
                    <button type="submit" class="btn btn-primary btn-sm">Calculate</button>
                </div>  
            </div>   
       </form>
    </div>
        <!-- /.box-header -->
    <div class="box-body">
        <table id="meal_table" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th style="width: 20px;">Day</th>
                    <th>Expenses</th>
                    <th>Payment</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Remarks</th>
                    <th style="width: 120px;">Created On</th>
                </tr>
            </thead>
            <tbody>
               @foreach($reports as $report)
                <tr> 
                    <td>{{$report->date->format('d')}}</td>
                    <td>{{$report->title}}</td>
                    <td class="{{($report->payment == 'pending')? 'callout callout-danger' : ''}}">{{$report->payment}}</td>
                    <td>{{$report->amount}}</td>
                    <td>{{$report->date}}</td>
                    <td>{{$report->remarks}}</td>
                    <td>{{$report->created_at}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <tr> 

        <div class="row">
            <div class="col-md-2"><b>Pending : {{$pending}}</b></tr></div>
            <div class="col-md-2"><b>Paid : {{$paid}}</b></tr></div>
            <div class="col-md-2"><b>Total : {{$total_amount}}</b></tr></div>
        </div>
    </div>
</div>
@endsection