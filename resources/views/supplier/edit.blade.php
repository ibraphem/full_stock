@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>{{ __('Supplier')}}</h1>
      
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
            <!-- /.box-header -->
          <!-- /.box -->
            @if (Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif
			@if(!empty($errors->all()))
				<div class="alert alert-danger">
					{{ Html::ul($errors->all()) }}
				</div>
			@endif
            <div class="box box-success">
            	<div class="box-header">
					<h3 class="box-title">@if(!empty($supplier)){{__('Edit')}} @else {{__('Add')}} @endif {{__('Supplier')}}</h3><a class="btn btn-small btn-success pull-right" href="{{ URL::to('suppliers') }}"><i class="fa fa-list"></i>&nbsp; List</a>
            	</div>
            </div>
          <div class="box box-success">
            
            <!-- /.box-header -->
            <div class="box-body">
					<div class="box-header"></div>
					@if(!empty($supplier))
					{{ Form::model($supplier, array('route' => array('suppliers.update', $supplier->id), 'method' => 'PUT', 'files' => true)) }}
					@else
					{{ Form::open(array('url' => 'suppliers', 'files' => true)) }}
					@endif
				<div class="col-md-6"> 

					<div class="form-group row">
					{{ Form::label('company_name', trans('supplier.company_name').' *', ['class'=> 'col-sm-4 text-right']) }}
					<div class="col-sm-8">
					{{ Form::text('company_name', Null, array('class' => 'form-control', 'required')) }}
					</div>
					</div>

					<div class="form-group row">
					{{ Form::label('name', trans('supplier.name').' *', ['class'=> 'col-sm-4 text-right']) }}
					<div class="col-sm-8">
					{{ Form::text('name', Null, array('class' => 'form-control')) }}
					</div>
					</div>

					<div class="form-group row">
					{{ Form::label('email', trans('supplier.email'), ['class'=> 'col-sm-4 text-right']) }}
					<div class="col-sm-8">
					{{ Form::text('email', Null, array('class' => 'form-control')) }}
					</div>
					</div>

					<div class="form-group row">
					{{ Form::label('phone_number', trans('supplier.phone_number'), ['class'=> 'col-sm-4 text-right']) }}
					<div class="col-sm-8">
					{{ Form::text('phone_number', Null, array('class' => 'form-control')) }}
					</div>
					</div>

					<div class="form-group row">
					{{ Form::label('address', trans('supplier.address'), ['class'=> 'col-sm-4 text-right']) }}
					<div class="col-sm-8">
					{{ Form::text('address', Null, array('class' => 'form-control')) }}
					</div>
					</div>
					<div class="form-group row">
						{{ Form::label('city', trans('supplier.city'), ['class'=> 'col-sm-4 text-right']) }}
						<div class="col-sm-8">
						{{ Form::text('city', Null, array('class' => 'form-control')) }}
						</div>
					</div>
					<div class="form-group row">
						{{ Form::label('state', trans('supplier.state'), ['class'=> 'col-sm-4 text-right']) }}
						<div class="col-sm-8">
						{{ Form::text('state', Null, array('class' => 'form-control')) }}
						</div>
					</div>
				</div>
				<div class="col-md-6">
					
					<div class="form-group row">
					{{ Form::label('zip', trans('supplier.zip'), ['class'=> 'col-sm-4 text-right']) }}
					<div class="col-sm-8">
					{{ Form::text('zip', Null, array('class' => 'form-control')) }}
					</div>
					</div>
					<div class="form-group row">
					{{ Form::label('comments', trans('supplier.comments'), ['class'=> 'col-sm-4 text-right']) }}
					<div class="col-sm-8">
					{{ Form::text('comments', Null, array('class' => 'form-control')) }}
					</div>
					</div>
					<div class="form-group row">
					{{ Form::label('account', trans('supplier.account').' #', ['class'=> 'col-sm-4 text-right']) }}
					<div class="col-sm-8">
					{{ Form::text('account', Null, array('class' => 'form-control')) }}
					</div>
					</div>
					<div class="form-group row">
						{{ Form::label('prev_balance', trans('supplier.prev_balance'),['class'=>'col-sm-4 text-right']) }}
						<div class="col-sm-8">
							@if(isset($supplier))
						{{ Form::number('prev_balance', null, ['class' => 'form-control']) }}
							@else
						{{ Form::number('prev_balance', 0, ['class' => 'form-control']) }}
								@endif
						</div>
					</div>
					<div class="form-group row">
						{{ Form::label('payment', trans('supplier.payment') ,['class'=>'col-sm-4 text-right']) }}
						<div class="col-sm-8">
							@if(isset($supplier))
						{{ Form::number('payment', null, ['class' => 'form-control', 'readonly'=>'']) }}
							@else
						{{ Form::number('payment', 0, ['class' => 'form-control']) }}
								@endif
						</div>
					</div>
					<div class="form-group row">
					{{ Form::label('avatar', trans('supplier.choose_avatar'), ['class'=> 'col-sm-4 text-right']) }}
					<div class="col-sm-8">
					{{ Form::file('avatar', Null, array('class' => 'form-control')) }}
						@if(isset($supplier->avatar))
						<img src="{{asset($supplier->avatar)}}" alt="" height="35">
						@endif
					</div>
					</div>
					<div class="row">
						<div class="col-sm-12 text-right">
							{{ Form::submit(trans('supplier.submit'), array('class' => 'btn btn-success btn-sp')) }}
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