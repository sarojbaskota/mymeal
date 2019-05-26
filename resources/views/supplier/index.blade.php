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
        <button class=" box-title btn btn-primary" id="add_new">Add New</button>
    </div>
        <!-- /.box-header -->
    <div class="box-body">
        <table id="supplier_table" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th style="width: 20px;">SN</th>
                     <th style="width: 145px;">Action</th>
                    <th>Supplier Name</th>
                    <th style="width: 120px;">Created On</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($suppliers as $supplier)
                    <tr> <td>{{$loop->iteration}}</td>
                            <td>
                            <!-- <a class="btn btn-primary btn-sm show_supplier" data-id=" {{$supplier->id}} " > <i class="glyphicon glyphicon-eye-open" ></i> </a> -->
                            <a class="btn btn-success btn-sm edit" data-id=" {{$supplier->id}} "> <i class="glyphicon glyphicon-edit" ></i> </a>
                            <a class="btn btn-danger btn-sm delete" data-id=" {{$supplier->id}} "> <i class="glyphicon glyphicon-trash" ></i> </a>

                            </td>
                        <td> <strong> <a href="{{url('supplier/'.$supplier->id)}}">{{$supplier->supplier_name}}</a> </strong> </td>
                        <td>{{$supplier->created_at}}</td>
                    </tr>
                @empty
                  <p>No Transactions</p>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div id="show_modal"></div>
    </section>
    <!-- /.content -->
      @include('supplier.create')
      @include('supplier.edit')
@endsection
@section('scripts')
<script src="{{asset('js/supplier.js')}}"></script>
@endsection