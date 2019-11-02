@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>{{__('Customer')}}</h1>
      
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
					<h3 class="box-title">@if(!empty($customer)){{__('Edit')}} @else {{__('Create')}} @endif {{__('Customer')}}</h3><a class="btn btn-small btn-success pull-right" href="{{ URL::to('customers') }}"><i class="fa fa-list"></i>&nbsp; {{__('List')}}</a>
            	</div>
            </div>
          <div class="box box-success">
            
            <!-- /.box-header -->
            <div class="box-body">
					<div class="box-header"></div>

					@if(!empty($customer))
						{{ Form::model($customer, array('route' => array('customers.update', $customer->id), 'method' => 'PUT', 'files' => true)) }}
					@else
						{{ Form::open(array('url' => 'customers', 'files' => true,)) }}
					@endif
				<div class="col-sm-6">
					<div class="form-group row">
					{{ Form::label('name', trans('customer.name') .' *',['class'=>'col-sm-3 text-right']) }}
					<div class="col-sm-9"> 
						{{ Form::text('name', null, array('class' => 'form-control', 'required')) }}
					</div>
					</div>

					<div class="form-group row">
					{{ Form::label('email', trans('customer.email'),['class'=>'col-sm-3 text-right']) }}
						<div class="col-sm-9">
							{{ Form::text('email', null, array('class' => 'form-control')) }}
						</div>
					</div>

					<div class="form-group row">
					{{ Form::label('phone_number', trans('customer.phone_number'), ['class'=>'col-sm-3 text-right']) }}
						<div class="col-sm-9"> 
					{{ Form::text('phone_number', null, array('class' => 'form-control')) }}
						</div>
					</div>
					
					<div class="form-group row">
						{{ Form::label('address', trans('customer.address'),['class'=>'col-sm-3 text-right']) }}
						<div class="col-sm-9"> 
							{{ Form::text('address', null, array('class' => 'form-control')) }}
						</div>
					</div>

					<div class="form-group row">
					{{ Form::label('city', trans('customer.city'),['class'=>'col-sm-3 text-right']) }}
					<div class="col-sm-9"> 
					{{ Form::text('city', null, array('class' => 'form-control')) }}
					</div>
					</div>
					
					<div class="form-group row">
						{{ Form::label('state', trans('customer.state'),['class'=>'col-sm-3 text-right']) }}
						<div class="col-sm-9"> 
							{{ Form::text('state', null, array('class' => 'form-control')) }}
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group row">
						{{ Form::label('zip', trans('customer.zip'),['class'=>'col-sm-3 text-right']) }}
						<div class="col-sm-9"> 
						{{ Form::text('zip', null, array('class' => 'form-control')) }}
						</div>
					</div>

					<div class="form-group row">
						{{ Form::label('company_name', trans('customer.company_name'),['class'=>'col-sm-3 text-right']) }}
						<div class="col-sm-9"> 
						{{ Form::text('company_name', null, array('class' => 'form-control')) }}
						</div>
					</div>

					<div class="form-group row">
						{{ Form::label('account', trans('customer.account') .' #',['class'=>'col-sm-3 text-right']) }}
						<div class="col-sm-9"> 
						{{ Form::text('account', null, array('class' => 'form-control')) }}
						</div>
					</div>

					<div class="form-group row">
						{{ Form::label('prev_balance', trans('customer.prev_balance'),['class'=>'col-sm-3 text-right']) }}
						<div class="col-sm-9">
							@if(isset($customer))
						{{ Form::number('prev_balance', null, ['class' => 'form-control']) }}
								@else
								{{ Form::number('prev_balance', 0, ['class' => 'form-control']) }}
								@endif
						</div>
					</div>

					<div class="form-group row">
						{{ Form::label('payment', trans('customer.payment') ,['class'=>'col-sm-3 text-right']) }}
						<div class="col-sm-9">
							@if(isset($customer))
							{{ Form::number('payment', null, ['class' => 'form-control', 'readonly'=>'']) }}
							@else
							{{ Form::number('payment', 0, ['class' => 'form-control']) }}
							@endif
						</div>
					</div>
					<div class="form-group row">
						{{ Form::label('avatar', trans('customer.choose_avatar'),['class'=>'col-sm-3 text-right']) }}
						<div class="col-sm-9">
						{{ Form::file('avatar', null, array('class' => 'form-control')) }}
							@if(isset($customer->avatar))
							<img src="{{asset($customer->avatar)}}" alt="" height="35">
							@endif
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
@endsection