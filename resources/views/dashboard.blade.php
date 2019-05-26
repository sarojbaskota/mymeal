@extends('layouts.user')

@section('content')
<section class="content-header">
      
</section>
<!-- Main content -->
<section class="content container-fluid">
  <div class="row">
     <div class="col-md-4">
     <div class="box box-info collapsed-box">
                <div class="box-header with-border">
                  <h3 class="box-title">Total Meal Expenses</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <form id="meal_info">
                            <div class="row" style="margin-left:0px; margin-top:10px;margin-right: 5px;">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select name="year" class="year form-control">
                                            <option value="">YEAR</option>
                                            @for($i=2019;$i>=2010;$i--)
                                            <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select name="month" class="month form-control">
                                            <option value="">Month</option>
                                            <option value="1">January</option>
                                            <option value="2">February</option>
                                            <option value="3">March</option>
                                            <option value="4">April</option>
                                            <option value="5">May</option>
                                            <option value="6">June</option>
                                            <option value="7">July</option>
                                            <option value="8">August</option>
                                            <option value="9">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="4">December</option>
                                        </select>
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <select name="restaurant_id" class="restaurant_id form-control">
                                    <option value="">Resto</option>
                                    @foreach($suppliers as $supplier)
                                    <option value="{{$supplier['id']}}">{{$supplier['supplier_name']}}</option>
                                    @endforeach
                                    </select>
                                    <div class="restaurant_id_error"></div>
                                </div>
                                </div>
                              
                            </div>   
                            <div class="form-group" style="    text-align: center; margin-top:10px;">
                                <button type="submit" class="btn label-info btn-sm">Calculate</button>
                            </div>
                    </form>
                    <div style="display:none;" id="result" class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box">
                      <span class="info-box-icon bg-green"></span>
                      <div class="info-box-content">
                      </div>
                      <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                </div>
                <!-- /.box-body -->
               
                <div class="box-footer text-center">
                  <a href="{{url('expenses')}}" class="uppercase">View All Expenses</a>
                </div>
                <!-- /.box-footer -->
              </div>
     </div>
     <!-- //unpaid -->
     <div class="col-md-8">
     <div class="box box-info collapsed-box">
                <div class="box-header with-border">
                  <h3 class="box-title">Paid Or Unpaid Meal Expenses</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <form id="meal_payment">
                            <div class="row" style="margin-left:0px; margin-top:10px;margin-right: 5px;">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <select name="year" class="year form-control">
                                            <option value="">Year</option>
                                            @for($i=2019;$i>=2010;$i--)
                                            <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div> 
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <select name="month" class="month form-control">
                                            <option value="">Month</option>
                                            <option value="1">January</option>
                                            <option value="2">February</option>
                                            <option value="3">March</option>
                                            <option value="4">April</option>
                                            <option value="5">May</option>
                                            <option value="6">June</option>
                                            <option value="7">July</option>
                                            <option value="8">August</option>
                                            <option value="9">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="4">December</option>
                                        </select>
                                    </div> 
                                </div>
                                <div class="col-md-2">
                                  <div class="form-group">
                                    <select name="restaurant_id" class="restaurant_id form-control">
                                    <option value="">Resto</option>
                                    @foreach($suppliers as $supplier)
                                    <option value="{{$supplier['id']}}">{{$supplier['supplier_name']}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <select name="payment" class="payment form-control">
                                            <option value="">Choose</option>
                                            <option value="paid">Paid</option>
                                            <option value="pending">Pending</option>
                                        </select>
                                    </div> 
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                    <select name="meal_id" class="meal_id form-control">
                                      <option value="">Expenses Category</option>
                                      @foreach($expenses_categories as $expenses_category)
                                      <option value="{{$expenses_category['id']}}">{{$expenses_category['title']}}</option>
                                      @endforeach
                                  </select>
                                    </div> 
                                </div>
                                <div class="col-md-2">
                                  <div class="form-group">
                                  <button type="submit" class="btn label-info btn-sm">Calculate</button>
                                  </div>
                                </div>
                            </div>   
                    </form>
                    <div style="display:none;" id="payment" class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box">
                      <span class="info-box-icon bg-green"></span>
                      <div class="info-box-content">
                      </div>
                      <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                </div>
                <!-- /.box-body -->
               
                <div class="box-footer text-center">
                  <a href="{{url('expenses')}}" class="uppercase">View All Expenses</a>
                </div>
                <!-- /.box-footer -->
              </div>
     </div>
  </div>
</section>

@endsection
@section('scripts')
<script src="{{asset('js/dashboard.js')}}"></script>
@endsection