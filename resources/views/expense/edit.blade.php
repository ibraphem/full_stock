@extends('layouts.admin')

@section('content')
{{ Html::script('js/angular.min.js', array('type' => 'text/javascript')) }}
{{ Html::script('js/automate.js', array('type' => 'text/javascript')) }}
<div class="content-wrapper" ng-app="automateApp">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>{{__('Expenses')}}</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> {{__('Home')}}</a></li>
        <li><a href="#">{{__('Expense')}}</a></li>
        <li class="active">@if(isset($expense)) {{__('Edit')}} @else {{__('Create')}} @endif</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
            <!-- /.box-header -->
          <!-- /.box -->
			@include('partials.flash')
            <div class="box box-success">
            	<div class="box-header">
		              <h3 class="box-title">@if(isset($expense)) {{__('Edit')}} @else {{__('Create')}} @endif {{__('Expense')}}</h3><a class="btn btn-small btn-success pull-right" href="{{ URL::to('expense') }}"><i class="fa fa-list"></i>&nbsp; {{__('List')}}</a>
            	</div>
            </div>
          <div class="box box-success">
            
            <!-- /.box-header -->
            <div class="box-body" ng-controller="automateController">
					<div class="box-header"></div>
				@if(isset($expense))
					{{ Form::model($expense, array('route' => array('expense.update', $expense->id), 'method' => 'PUT', 'files' => true,)) }}
				@else
					{{ Form::open(array('url' => 'expense', 'files' => true,)) }}
				@endif
				<div class="col-md-6" >
					<div class="form-group row">
						{{ Form::label('expense_category', __('Select category') .' *',['class'=>'col-sm-3 text-right']) }}
						<div class="col-sm-7 no-margin no-right-padding">
						{{ Form::select('expense_category_id', $expense_categories, null, array('class' => 'form-control')) }}
						</div>
						<div class="col-sm-2 no-margin no-left-padding">
							<a class="btn btn-success pull-right" href="{{url('expenses')}}/#modal-id" data-toggle="modal"><i class="fa fa-plus"></i>&nbsp; {{__('Add')}}</a>
						</div>
					</div>
					<div class="form-group row">
					{{ Form::label('description', __('Description') .' *',['class'=>'col-sm-3 text-right']) }}
					<div class="col-sm-9"> 
						{{ Form::text('description', null, array('class' => 'form-control', 'required')) }}
					</div>
					</div>

					<div class="form-group row">
					{{ Form::label('qty', __('Quantity'),['class'=>'col-sm-3 text-right']) }}
						<div class="col-sm-9">
							@if(isset($expense))
							{{ Form::number('qty', null, array('class' => 'form-control', 'ng-model'=>'qty', 'ng-init'=>"qty='$expense->qty'")) }}
								@else
								{{ Form::number('qty', null, array('class' => 'form-control', 'ng-model'=>'qty')) }}
							@endif
						</div>
					</div>

					<div class="form-group row">
					{{ Form::label('unit_price', __('Unit Amount'), ['class'=>'col-sm-3 text-right']) }}
						<div class="col-sm-9">
							@if(isset($expense))
					{{ Form::number('unit_price', null, array('class' => 'form-control', 'ng-model'=>'unit_price', 'ng-init'=>"unit_price='$expense->unit_price'")) }}
							@else
							{{ Form::number('unit_price', null, array('class' => 'form-control', 'ng-model'=>'unit_price')) }}
							@endif
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group row">
						{{ Form::label('type', __('Payment Type'),['class'=>'col-sm-3 text-right']) }}
						<div class="col-sm-9"> 
						{{ Form::select('payment_type', ['cash'=>'Cash','bank'=>'Bank', 'bkash'=>'Bkash', 'check'=>'Check'], null, array('class' => 'form-control')) }}
						</div>
					</div>
					<div class="form-group row">
						{{ Form::label('total', __('Total'),['class'=>'col-sm-3 text-right']) }}
						<div class="col-sm-9"> 
							<span data-ng-bind=" qty * unit_price | currency"></span>
						</div>
					</div>
					<div class="form-group row">
					{{ Form::label('payment', __('Payment'),['class'=>'col-sm-3 text-right']) }}
					<div class="col-sm-9">
						@if(isset($expense))
					{{ Form::text('payment', null, array('class' => 'form-control', 'ng-model'=> 'payment', 'ng-init'=>"payment='$expense->payment'")) }}
						@else
					{{ Form::text('payment', null, array('class' => 'form-control', 'ng-model'=> 'payment')) }}
							@endif
					</div>
					</div>
					
					<div class="form-group row">
						{{ Form::label('dues', __('Dues'),['class'=>'col-sm-3 text-right']) }}
						<div class="col-sm-9"> 
						<span data-ng-bind=" qty * unit_price - payment | currency"></span>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 text-right"> 
						{{ Form::submit(trans('customer.submit'), array('class' => 'btn btn-success btn-sp')) }}
						</div>
					</div>
				</div>
				{{ Form::close() }}
				</div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
<div class="modal fade" id="modal-id">
	<div class="modal-dialog">
		{{ Form::open(['route' => 'expensecategory.store', 'method' => 'post']) }}
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">{{__('Add A Expense Category')}}</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					{{ Form::label('name', __('Name')) }}
					{{ Form::text('name', null, array('class' => 'form-control')) }}
				</div>
				<div class="form-group">
					{{ Form::label('description', __('Description')) }}
					{{ Form::textarea('description', null, array('class' => 'form-control')) }}
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">{{__('Close')}}</button>
				<button type="submit" class="btn btn-success">{{__('Create')}}</button>
			</div>
		</div>
		{{ Form::close() }}
	</div>
</div>
@endsection