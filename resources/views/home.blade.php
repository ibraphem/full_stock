@extends('layouts.app')
@section('page-style')
<link rel="stylesheet" href="{{asset('css/pages/dashboard.css')}}">
@endsection
@section('content')
	<div class="content-wrapper">
		<div class="row">
			<div class="col-md-12">

				<div class="panel-heading">
					@include('partials.flash')
					<h1>{{ __('Dashboard') }} <small>{{trans('dashboard.statistics')}}</small></h1></div>

				<div class="panel-body">
					
					@if(auth()->user()->hasPermissionTo('Sale-receive-chart Dashboard'))
					<div class="box box-success">
						<div class="box-header with-border">
							<h4>{{__('Sale & Receive Flow')}}</h4>
						</div>
						<div class="box-body">
								<div id="area-chart" ></div>
							<input type="hidden" id="chartData" value="{{ json_encode($incomeexpensechart) }}">
						</div>
					</div>
					@endif
					<!-- latest section -->
					@if(auth()->user()->hasPermissionTo('Latest-income-expense Dashboard'))
					@include('dashboard.partials.latest')
					@endif
					<div class="row">
						<div class="col-md-4">
							<div class="purple well">
								<i class="fa fa-user" aria-hidden="true"></i><br>
								<span>{{trans('dashboard.total_employees')}} : {{$employees}}</span>
							</div>
						</div>
						<div class="col-md-4">
							<div class="chocolate well">
								<i class="fa fa-users" aria-hidden="true"></i><br>
								<span>{{trans('dashboard.total_customers')}} : {{$customers}}</span>
							</div>
						</div>
						<div class="col-md-4">
							<div class="well yellow">
								<i class="fa fa-cubes" aria-hidden="true"></i><br>
								<span>{{trans('dashboard.total_suppliers')}} : {{$suppliers}}</span>
							</div>
						</div>
					</div>

					<div class="row">
					  <div class="col-md-3">
						<div class="well green">
							<i class="fa fa-bars" aria-hidden="true"></i><br>
							<span>{{trans('dashboard.total_items')}} : {{$items}}</span>
						</div>
					  </div>
					  <div class="col-md-3">
						<div class="well blue">
							<i class="fa fa-list" aria-hidden="true"></i><br>
							<span>{{trans('dashboard.total_expenses')}} : {{$expenses}}</span>
						</div>
					  </div>
					  <div class="col-md-3">
						<div class="violet well">
							<i class="fa fa-sitemap" aria-hidden="true"></i><br>
							<span>{{trans('dashboard.total_receivings')}} : {{$receivings}}</span>
						</div>
					  </div>
					  <div class="col-md-3">
						<div class="brown well">
							<i class="fa fa-shopping-cart" aria-hidden="true"></i><br>
							<span>{{trans('dashboard.total_sales')}} : {{$sales}}</span>
						</div>
					  </div>
					</div>

				</div>
			</div>
		</div>
	</div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.0/morris.min.js"></script>
<script src="{{asset('js/dashboard.js')}}"></script>
<script>
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	});
</script>
@endsection
