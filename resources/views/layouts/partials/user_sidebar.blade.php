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
        <li class="{{(Request::segment(1) == 'supplier')?'active':''}}"><a href="{{url('supplier')}}"><i class="glyphicon glyphicon-shopping-cart"></i> <span>Manage Supplier</span></a></li>
        <li class="{{(Request::segment(1) == 'payment')?'active':''}}"><a href="{{url('payment')}}"><i class="glyphicon glyphicon-check"></i> <span>Manage Payment</span></a></li>
        <li class="treeview {{ Request::segment(1) === 'expenses' ? 'active' : null }}{{ Request::segment(1) === 'expense-category' ? 'active' : null }}">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Manage Expenses</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::segment(1) === 'expenses' ? 'active' : null }}"><a href="{{url('expenses')}}"><i class="fa fa-circle-o"></i>Expenses On</a></li>
            <li class="{{ Request::segment(1) === 'expense-category' ? 'active' : null }}"><a href="{{url('expense-category')}}"><i class="fa fa-circle-o"></i> Expenses Category</a></li>
          </ul>
        </li>
        <!-- expenses reports -->
        <li class="treeview {{ Request::segment(1) === 'monthly-expenses' ? 'active' : null }}{{ Request::segment(1) === 'expenses-with-supplier' ? 'active' : null }}">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Expenses Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::segment(1) === 'monthly-expenses' ? 'active' : null }}"><a href="{{url('monthly-expenses')}}"><i class="fa fa-circle-o"></i> Monthly Expenses</a></li>
            <li class="{{ Request::segment(1) === 'expenses-with-supplier' ? 'active' : null }}"><a href="{{url('expenses-with-supplier')}}"><i class="fa fa-circle-o"></i> Expenses With Supplier</a></li>
          </ul>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>