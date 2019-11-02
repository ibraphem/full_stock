@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>{{__('All Permissions')}}</h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                @include('partials.flash')
                <!-- /.box-header -->
                    <!-- /.box -->
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">{{__('Permissions')}}</h3>
                        <!-- @if(auth()->user()->hasPermissionTo('permissions.create'))
                            <a class="btn btn-small btn-success pull-right" href="#createPermission" data-toggle="modal"><i class="fa fa-plus"></i>&nbsp; {{__('Create Permission')}}</a>
                            @endif -->
                        </div>
                    </div>
                    {{ Form::open(['url'=>route('permissionrole.create')]) }}
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="box box-success">
                                <div class="box-header">{{__('Please Select a Role')}}</div>
                                <div class="box-body">
                                    {{ Form::select('role_id', $roles, $role_id, ['class'=>'form-control', 'onchange'=>'onChange()', 'id'=>'role_id']) }}
                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($all_permissions as $key=>$svalue)
                        <div class="col-sm-3">
                            <div class="box box-success permission-list">
                                <div class="box-header"><b>{{ucfirst($key)}}</b> <input type="checkbox" id="checkAllPer" class="pull-right" onclick="checkPermissions(this)" {{($role->hasAnyPermission($svalue)) ? 'checked' : ''}}></div>
                                <div class="box-body">
                                    @foreach($svalue as $value)
                                        <p><input type="checkbox" name="permissions[]" value="{{$value->id}}" {{($role->hasPermissionTo($value->name)) ? 'checked' : ''}} onclick="checAllkPermissions(this)"> {{$value->label}}</p>
                                    @endforeach
                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-success">{{__('Submit')}}</button>
                    {{ Form::close() }}
                    <!-- /.box-header -->

                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <div class="modal fade" id="createPermission">
        <div class="modal-dialog">
            <!-- {{ Form::open(['route' => 'permissions.create', 'method' => 'post']) }}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">{{__('Add a Permission')}}</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        {{ Form::label('label', __('Name')) }}
                        {{ Form::text('label', null, array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('name', __('Route')) }}
                        {{ Form::text('name', null, array('class' => 'form-control')) }}
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{__('Close')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('Create')}}</button>
                </div>
            </div>
            {{ Form::close() }} -->
        </div>
    </div>
@endsection
