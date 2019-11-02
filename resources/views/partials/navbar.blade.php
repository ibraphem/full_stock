<header class="main-header">
    <!-- Logo -->
    <a href="/" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">
        @if(!empty(setting('fevicon_path')))
        <img src="{{asset(setting('fevicon_path'))}}" alt="" height="40px" width="40px">
        @else
        <img src="{{asset('images/fevicon.png')}}" alt="" height="40px" width="40px">
        @endif

      </span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
          @if(!empty(setting('logo_path')))
        <img src="{{asset(setting('logo_path'))}}" alt="" height="40px">
        @else
        <img src="{{asset('images/fpos.png')}}" alt="" height="40px">
        @endif        
        </span>

    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

       <a href="#" class="dropdown-toggle sidebar-toggle quick-icon" role="button" data-toggle="dropdown" id="menu1">
            <i class="fa fa-plus"></i>
        </a>
        <ul class="dropdown-menu quick-dropdown" role="menu" aria-labelledby="menu1">
          @if(auth()->user()->hasPermissionTo('sales.create'))
          <li role="presentation">
            <a role="menuitem" tabindex="-1" href="{{ url('sales/create') }}"><i class="fa fa-shopping-cart"></i> {{__('Sale/Invoice')}}</a>
          </li>
          @endif
          @if(auth()->user()->hasPermissionTo('items.create'))
          <li role="presentation"><a role="menuitem" tabindex="-1" href="{{route('items.create')}}"><i class="fa fa-product-hunt" aria-hidden="true"></i> {{__('Item')}}</a></li>
          @endif
          @if(auth()->user()->hasPermissionTo('expense.create'))
          <li role="presentation"><a role="menuitem" tabindex="-1" href="{{route('expense.create')}}"><i class="fa fa-credit-card" aria-hidden="true"></i> {{__('Expense')}}</a></li>
          @endif
          @if(auth()->user()->hasPermissionTo('customers.create'))
          <li role="presentation"><a role="menuitem" tabindex="-1" href="{{route('customers.create')}}"><i class="fa fa-user-plus" aria-hidden="true"></i> {{__('Customer')}}</a></li>
          @endif
          
        </ul>
      
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          @if (Auth::guest())
			<li><a href="{{ url('/login') }}">{{__('Login')}}</a></li>
		@else
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{asset('dist/img/avatar.png')}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{asset('dist/img/avatar.png')}}" class="img-circle" alt="User Image">

                <p>
                  {{ Auth::user()->name }}
                  <small>{{__('Member since')}} {{Auth::user()->created_at->format('Y-m-d')}}</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-6 text-center">
                    @if(Auth::user()->hasPermissionTo('flexiblepossetting.create'))
                    <a href="{{route('flexiblepossetting.create')}}">{{__('Settings')}}</a>
                      @endif
                  </div>
                  <div class="col-xs-6 text-center">
                    @if(Auth::user()->hasPermissionTo('flexiblepossetting.create'))
                    <a href="{{route('permissions.list')}}">{{__('Permissions')}}</a>
                      @endif
                  </div>

                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                <a href="{{route('employees.edit', Auth::user()->id)}}" class="btn btn-success btn-flat">{{__('Profile')}}</a>
                </div>
                <div class="pull-right">
                  <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" class="btn btn-success btn-flat">
                            {{trans('menu.logout')}}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                </div>
              </li>
            </ul>
          </li>
          @endif
        </ul>
      </div>
    </nav>
  </header>