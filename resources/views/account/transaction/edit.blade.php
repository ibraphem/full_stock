@extends('layouts.admin')

@section('content')
    {{ Html::script('js/angular.min.js', array('type' => 'text/javascript')) }}
    {{ Html::script('js/automate.js', array('type' => 'text/javascript')) }}
    <div class="content-wrapper" ng-app="automateApp">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>{{__('Transactions')}}</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> {{__('Home')}}</a></li>
                <li><a href="#">{{__('Transaction')}}</a></li>
                <li class="active">@if(isset($transaction)) {{__('Edit')}}@else{{__('Create')}}@endif</li>
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
                            <h3 class="box-title">@if(isset($transaction)) {{__('Edit')}}@else{{__('Create')}}@endif  {{__('Transaction')}}</h3><a class="btn btn-small btn-success pull-right" href="{{ URL::to('transactions') }}"><i class="fa fa-list"></i>&nbsp; List</a>
                        </div>
                    </div>
                    <div class="box box-success">
                        <!-- /.box-header -->
                        <div class="box-body" ng-controller="automateController">
                            <div class="box-header"></div>
                            @if(isset($transaction))
                                {{ Form::model($transaction, array('route' => array('transactions.update', $transaction->id), 'method' => 'PUT', 'files' => true,)) }}
                            @else
                                {{ Form::open(array('url' => 'transactions', 'files' => true,)) }}
                            @endif
                            <div class="col-md-6" >
                                <div class="form-group row">
                                    {{ Form::label('transaction_type', __('Transaction Type') .' *',['class'=>'col-sm-4 text-right']) }}
                                    <div class="col-sm-8">
                                        {{ Form::select('transaction_type', ['1'=>'Payment','2'=>'Receipt','3'=>'Charge'],null, array('class' => 'form-control','required')) }}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    {{ Form::label('account_id', __('Account') .' *', ['class'=>'col-sm-4 text-right']) }}
                                    <div class="col-sm-8">
                                        {{ Form::select('account_id', $accounts, null, array('class' => 'form-control', 'placeholder'=>'Select an account','required')) }}
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    {{ Form::label('transaction_with', __('Transaction with') .' *', ['class'=>'col-sm-4 text-right']) }}
                                    <div class="col-sm-8">
                                        {{ Form::text('transaction_with', null, array('class' => 'form-control', 'placeholder'=>'Payee/Receipient name','required')) }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{ Form::label('amount', __('Amount') .' *',['class'=>'col-sm-4 text-right']) }}
                                    <div class="col-sm-8">
                                        {{ Form::number('amount', null, array('class' => 'form-control','required')) }}
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