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
        <li class="{{(Request::segment(1) == 'expenses')?'active':''}}"><a href="{{url('expenses')}}"><i class="fa fa-group"></i> <span>Expenses On</span></a></li>
        <li class="{{(Request::segment(1) == 'meal-type')?'active':''}}"><a href="{{url('meal-type')}}"><i class="fa fa-group"></i> <span>Meal Type</span></a></li>
        <li class="{{(Request::segment(1) == 'restaurant')?'active':''}}"><a href="{{url('restaurant')}}"><i class="fa fa-group"></i> <span>Manage Restaurant</span></a></li>
        <li class="{{(Request::segment(1) == 'payment')?'active':''}}"><a href="{{url('payment')}}"><i class="fa fa-group"></i> <span>Manage Payment</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>