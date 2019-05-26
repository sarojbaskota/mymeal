<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
           @if(Auth::user()->avatar)
            <img src="{{asset('images/avatar/'.Auth::user()->avatar)}}" class="img-circle" alt="User Image">
          @else
            <img src="{{asset('images/defaults/avatar.png')}}" class="img-circle" alt="User Image">
          @endif
        </div>
        <div class="pull-left info">
          <p> {{Auth::user()->name}} </p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Navigation</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="{{(Request::segment(1) == 'dashboard')?'active':''}}"><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li class="{{(Request::segment(1) == 'expenses')?'active':''}}"><a href="{{url('expenses')}}"><i class="glyphicon glyphicon-edit"></i> <span>Expenses On</span></a></li>
        <li class="{{(Request::segment(1) == 'expense-category')?'active':''}}"><a href="{{url('expense-category')}}"><i class="glyphicon glyphicon-option-vertical"></i> <span>Expenses Category</span></a></li>
        <li class="{{(Request::segment(1) == 'supplier')?'active':''}}"><a href="{{url('supplier')}}"><i class="glyphicon glyphicon-shopping-cart"></i> <span>Manage Supplier</span></a></li>
        <li class="{{(Request::segment(1) == 'payment')?'active':''}}"><a href="{{url('payment')}}"><i class="glyphicon glyphicon-check"></i> <span>Manage Payment</span></a></li>
        <li class="{{(Request::segment(1) == 'monthly-expenses')?'active':''}}"><a href="{{url('monthly-expenses')}}"><i class="glyphicon glyphicon-list-alt"></i> <span>Monthly Expenses</span></a></li>
        <li class="{{(Request::segment(1) == 'expenses-with-supplier')?'active':''}}"><a href="{{url('expenses-with-supplier')}}"><i class="glyphicon glyphicon-king"></i> <span>Expenses With Supplier</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>