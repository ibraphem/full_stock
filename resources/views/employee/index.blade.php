@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>{{trans('employee.list_employees')}}</h1>
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
          <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">{{__('Employee List')}}</h3>
                @if($user->hasPermissionTo('employees.create'))
              <a class="btn btn-small btn-primary pull-right left-margin-10" href="{{ URL::to('employees/create') }}"><i class="fa fa-plus"></i> {{trans('employee.new_employee')}}</a>
                @endif
                @if($user->hasPermissionTo('employeerole.create'))
                <a class="btn btn-small btn-success pull-right left-margin-10" href="#createRole" data-toggle="modal"><i class="fa fa-plus"></i> {{__('Create Role')}}</a>
                @endif
                <a class="btn btn-small btn-info pull-right left-margin-10" href="{{route('permissions.list')}}" data-toggle="modal"><i class="fa fa-plus"></i> {{__('Permissions')}}</a>

            </div>
          </div>
            <!-- /.box-header -->
        <div class="box box-success">
          <div class="box-header"></div>
        <div class="box-body">
            <table id="myTable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <td class="hidden-xs">{{trans('employee.person_id')}}</td>
                        <td>{{trans('employee.name')}}</td>
                        <td>{{trans('employee.email')}}</td>
                        <td class="hidden-xs">&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                </thead>
                <tbody>
                @foreach($employee as $value)
                    <tr>
                        <td class="hidden-xs">{{ $value->id }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->email }}</td>
                        <td class="hidden-xs">@if($user->hasPermissionTo('assaign.roles'))
                            <form action="{{route('assign.roles')}}" method="post">
                                <input type="hidden" name="email" value="{{$value->email}}">
                                @foreach($roles as $role)
                                <span style="margin-right:30px"><input type="checkbox" name="role[]" value="{{$role->name}}" {{(\App\User::where('email',$value->email)->first()->hasRole($role->name)) ? 'checked' : ''}}>{{$role->name}}</span>
                                @endforeach
                                {{csrf_field()}}
                                <button type="submit" class="btn btn-success">{{__('Assign Role')}}</button>
                            </form>@endif</td>
                        <td class="item_btn_group">
                            <div class="btn-group">
                              <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-list"></i><span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                              </button>
                              <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('employees/' . $value->id . '/edit') }}"><i class="fa fa-pencil"></i> {{trans('employee.edit')}}</a></li>
                                <li>
                                    <a href="#" class="delete-form" onclick="return confirm('are you sure?')"><i class="fa fa-trash-o"></i>{{ Form::open(array('url' => 'employees/' . $value->id, 'class' => 'form-inline')) }}
                                {{ Form::hidden('_method', 'DELETE') }}
                                {{ Form::submit(trans('employee.delete'), array('class' => 'delete-btn')) }}
                            {{ Form::close() }}</a></li>
                              </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
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
<div class="modal fade" id="createRole">
    <div class="modal-dialog">
        {{ Form::open(['route' => 'employeerole.create', 'method' => 'post']) }}
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">{{__('Add Employee Role')}}</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    {{ Form::label('name', 'Name') }}
                    {{ Form::text('name', null, array('class' => 'form-control', 'required')) }}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{__('Close')}}</button>
                <button type="submit" class="btn btn-primary">{{__('Create')}}</button>
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>
@endsection
