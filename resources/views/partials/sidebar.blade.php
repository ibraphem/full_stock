@if (Auth::check())
<aside class="main-sidebar">
	<section class="sidebar">
	
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      @if(auth()->user()->hasPermissionTo('customers.index'))
        <li class=""><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> <span>{{trans('menu.dashboard')}}</span></a></li>
        <li class="{{(Request::is('customers')) ? 'active' : ''}} "><a href="{{ url('/customers') }}"><i class="fa fa-users"></i> <span>{{trans('menu.customers')}}</span></a></li>
      @endif
      @if(auth()->user()->hasPermissionTo('items.index'))
    <li class="{{(Request::is('items')) ? 'active' : ''}} "><a href="{{ url('/items') }}"><i class="fa fa-bars"></i> <span>Stocks</span></a></li>
      @endif
<!-- <li><a href="{{ url('/item-kits') }}">{{trans('menu.item_kits')}}</a></li> -->
      @if(auth()->user()->hasPermissionTo('suppliers.index'))
        <li class="{{(Request::is('suppliers')) ? 'active' : ''}} "><a href="{{ url('/suppliers') }}"><i class="fa fa-cubes"></i> <span>{{trans('menu.suppliers')}}</span></a></li>
      @endif

      @if(auth()->user()->hasPermissionTo('receivings.index') || auth()->user()->hasPermissionTo('receivings.create'))
      <li class="{{(Request::is('receivings') || Request::is('receivings/create')) ? 'active' : ''}} treeview">
          <a href="#"><i class="fa fa-sitemap"></i> <span>{{__('Rcv./Purchases')}}</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
          <ul class="treeview-menu">
              @if(auth()->user()->hasPermissionTo('receivings.index'))
              <li class="{{(Request::is('receivings')) ? 'active' : ''}} ">
                  <a href="{{ url('/receivings') }}"><i class="fa fa-circle-o"></i> <span>{{__('Purchase List')}}</span></a>
              </li>
              @endif
              @if(auth()->user()->hasPermissionTo('receivings.create'))
                <li class="{{(Request::is('receivings/create')) ? 'active' : ''}} "><a href="{{ url('/receivings/create') }}"><i class="fa fa-circle-o"></i> <span>{{__('Create Purchase')}}</span></a></li>
              @endif
          </ul>
      </li>
      @endif

      @if(auth()->user()->hasPermissionTo('sales.index') || auth()->user()->hasPermissionTo('sales.create'))
      <li class="{{(Request::is('sales') || Request::is('sales/create')) ? 'active' : ''}} treeview">
          <a href="#"><i class="fa fa-shopping-cart"></i> <span>{{__('Sales')}}</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
          <ul class="treeview-menu">
              @if(auth()->user()->hasPermissionTo('sales.index'))
              <li class="{{(Request::is('sales')) ? 'active' : ''}} ">
                  <a href="{{ url('/sales') }}"><i class="fa fa-circle-o"></i> <span>{{__('Sales List')}}</span></a>
              </li>
              @endif
              @if(auth()->user()->hasPermissionTo('sales.create'))
              <li class="{{(Request::is('sales/create')) ? 'active' : ''}}">
                  <a href="{{ url('sales/create') }}"><i class="fa fa-circle-o"></i> {{__('Add Sales/Invoice')}}</a>
              </li>
              @endif
          </ul>
      </li>
      @endif


      @if(auth()->user()->hasPermissionTo('accounts.index') || auth()->user()->hasPermissionTo('transactions.index'))
      <li class="{{(Request::is('accounts') || Request::is('transactions')) ? 'active' : ''}} treeview">
          <a href="#"><i class="fa fa-university"></i> <span>{{trans('menu.accounts')}}</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
          <ul class="treeview-menu">
              @if(auth()->user()->hasPermissionTo('accounts.index'))
              <li class="{{(Request::is('accounts')) ? 'active' : ''}} ">
                  <a href="{{ url('/accounts') }}"><i class="fa fa-circle-o"></i> <span>{{trans('menu.accounts')}}</span></a>
              </li>
              @endif
              @if(auth()->user()->hasPermissionTo('transactions.index'))
              <li class="{{(Request::is('transactions')) ? 'active' : ''}}">
                  <a href="{{ url('transactions') }}"><i class="fa fa-circle-o"></i> Transactions</a>
              </li>
              @endif
          </ul>
      </li>
      @endif

    @if(auth()->user()->hasPermissionTo('expense.index') || auth()->user()->hasPermissionTo('expensecategory.index'))
    <li class="{{(Request::is('expense') || Request::is('expensecategory')) ? 'active' : ''}} treeview">
      <a href="#">
        <i class="fa fa-dollar"></i> <span>{{trans('menu.expense')}}</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        @if(auth()->user()->hasPermissionTo('expense.index'))
        <li class="{{(Request::is('expense')) ? 'active' : ''}}"><a href="{{ url('/expense') }}"><i class="fa fa-circle-o"></i> <span>{{trans('menu.expense')}}</span></a></li>
        @endif
        @if(auth()->user()->hasPermissionTo('expensecategory.index'))
        <li class="{{(Request::is('expensecategory')) ? 'active' : ''}}"><a href="{{ url('expensecategory') }}"><i class="fa fa-circle-o"></i> Expense Category</a></li>
        @endif
      </ul>
    </li>
    @endif

    @if(auth()->user()->hasPermissionTo('reports.getsales') || auth()->user()->hasPermissionTo('dailyreport.create') || auth()->user()->hasPermissionTo('receivings.index') || auth()->user()->hasPermissionTo('sales.index'))
    <li class="{{(Request::is('reports/receivings') || Request::is('reports/sales') || Request::is('reports/dailyreport/create')) ? 'active' : ''}} treeview">
      <a href="#">
        <i class="fa fa-money"></i> <span>{{trans('menu.reports')}}</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        @if(auth()->user()->hasPermissionTo('receivings.index'))
        <li class="{{(Request::is('reports/receivings')) ? 'active' : ''}}"><a href="{{ url('/reports/receivings') }}"><i class="fa fa-circle-o"></i> {{__('Expense Report')}}</a></li>
        @endif
        @if(auth()->user()->hasPermissionTo('sales.index'))
        <li class="{{(Request::is('reports/sales')) ? 'active' : ''}}"><a href="{{ url('/reports/sales') }}"><i class="fa fa-circle-o"></i> {{__('Income Report')}}</a></li>
        @endif
        @if(auth()->user()->hasPermissionTo('dailyreport.create'))
        <li class="{{(Request::is('reports/dailyreport/create')) ? 'active' : ''}}"><a href="{{ url('/reports/dailyreport/create') }}"><i class="fa fa-circle-o"></i> {{trans('menu.daily_report')}}</a></li>
        @endif
        @if(auth()->user()->hasPermissionTo('dailyreport.index'))
        <li class="{{(Request::is('reports/dailyreport')) ? 'active' : ''}}"><a href="{{route('dailyreport.index')}}"><i class="fa fa-circle-o" aria-hidden="true"></i> {{__('Report Summary')}}</a></li>
        @endif
      </ul>
    </li>
    @endif

      @if(auth()->user()->hasPermissionTo('employees.index'))
        <li class="{{(Request::is('employees')) ? 'active' : ''}}"><a href="{{ url('/employees') }}"><i class="fa fa-user"></i> <span>{{trans('menu.employees')}}</span></a></li>
      @endif
      @if(Auth::user()->hasPermissionTo('flexiblepossetting.create'))
        <li class="{{(Request::is('flexiblepossetting/create')) ? 'active' : ''}}"><a href="{{ route('flexiblepossetting.create') }}"><i class="fa fa-gear"></i> <span>{{__('Settings')}}</span></a></li>
      @endif
    </ul>
</section>
</aside>
@endif