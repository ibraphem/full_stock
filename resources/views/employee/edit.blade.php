@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>{{__('Employee')}}</h1>
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
					<h3 class="box-title">@if(isset($employee)){{trans('employee.update_employee')}}@else {{trans('employee.new_employee')}}@endif</h3><a class="btn btn-small btn-success pull-right" href="{{ URL::to('employees') }}"><i class="fa fa-list"></i>&nbsp; {{__('List')}}</a>
            	</div>
            </div>
          <div class="box box-success">
            
            <!-- /.box-header -->
            <div class="box-body">
				<div class="box-header"></div>
				@if(isset($employee))
					{{ Form::model($employee, array('route' => array('employees.update', $employee->id), 'method' => 'PUT')) }}
				@else
					{{ Form::open(array('url' => 'employees')) }}
				@endif
				<div class="col-md-6">
					
					<div class="form-group row">
						{{ Form::label('name', trans('employee.name').' *', ['class'=>'col-sm-3 text-right']) }}
						<div class="col-sm-9"> 
						{{ Form::text('name', null, array('class' => 'form-control')) }}
						</div>
					</div>

					<div class="form-group row">
						{{ Form::label('email', trans('employee.email').' *', ['class'=>'col-sm-3 text-right']) }}
						<div class="col-sm-9"> 
							{{ Form::text('email', null, array('class' => 'form-control')) }}
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group row">
						{{ Form::label('password', trans('employee.password'), ['class'=>'col-sm-3 text-right']) }}
						<div class="col-sm-9"> 
							<input type="password" class="form-control" name="password" placeholder="Password">
						</div>
					</div>

					<div class="form-group row">
						{{ Form::label('password_confirmation', trans('employee.confirm_password'), ['class'=>'col-sm-3 text-right']) }}
						<div class="col-sm-9"> 
							<input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
						</div>
					</div>

					{{ Form::submit(trans('employee.submit'), array('class' => 'btn btn-success btn-sp pull-right')) }}
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