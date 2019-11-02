@extends('layouts.admin')

@section('content')
{{ Html::script('js/angular.min.js', array('type' => 'text/javascript')) }}
{{ Html::script('js/automate.js', array('type' => 'text/javascript')) }}
<div class="content-wrapper" ng-app="automateApp">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>{{__('Accounts')}}</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> {{__('Home')}}</a></li>
            <li><a href="#">{{__('Account')}}</a></li>
            <li class="active">@if(isset($account)){{__('Edit')}} @else {{__('Create')}} @endif</li>
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
                        <div class="box-header">
                            <h3 class="box-title">@if(isset($account)){{__('Edit')}} @else {{__('Create')}} @endif {{__('Account')}}</h3><a class="btn btn-small btn-success pull-right" href="{{ URL::to('accounts') }}"><i class="fa fa-list"></i>&nbsp; {{__('List')}}</a>
                        </div>
                    </div>
                </div>
                <div class="box box-success">
                    <!-- /.box-header -->
                    <div class="box-body" ng-controller="automateController">
                        <div class="box-header"></div>
                        @if(isset($account))
                        {{ Form::model($account, array('route' => array('accounts.update', $account->id), 'method' => 'PUT', 'files' => true)) }}
                        @else
                            {{ Form::open(array('url' => 'accounts', 'files' => true,)) }}
                        @endif
                        <div class="col-md-6" >
                            <div class="form-group row">
                                {{ Form::label('name', __('Name') .' *',['class'=>'col-sm-3 text-right']) }}
                                <div class="col-sm-9">
                                    {{ Form::text('name', null, array('class' => 'form-control', 'required')) }}
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('company', __('Bank/Company').' *',['class'=>'col-sm-3 text-right']) }}
                                <div class="col-sm-9">
                                    {{ Form::text('company', null, array('class' => 'form-control', 'required')) }}
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('branch_name', __('Branch'), ['class'=>'col-sm-3 text-right']) }}
                                <div class="col-sm-9">
                                    {{ Form::text('branch_name', null, array('class' => 'form-control')) }}
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('account_no', __('Account No'),['class'=>'col-sm-3 text-right']) }}
                                <div class="col-sm-9">
                                    {{ Form::number('account_no', null, array('class' => 'form-control')) }}
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                {{ Form::label('email', __('Email'),['class'=>'col-sm-3 text-right']) }}
                                <div class="col-sm-9">
                                    {{ Form::text('email', null, array('class'=>'form-control')) }}
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('pin', __('Pin'),['class'=>'col-sm-3 text-right']) }}
                                <div class="col-sm-9">
                                    {{ Form::number('pin', null, array('class' => 'form-control')) }}
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('balance', __('Balance').' *',['class'=>'col-sm-3 text-right']) }}
                                <div class="col-sm-9">
                                    {{ Form::number('balance', null, array('class' => 'form-control', 'required')) }}
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