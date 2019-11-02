@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>{{__('Transactions')}}</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> {{__('Home')}}</a></li>
                <li><a href="#">{{__('Transactions')}}</a></li>
                <li class="active">{{__('All')}}</li>
            </ol>
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
                            <h3 class="box-title">{{__('Transaction List')}}</h3><a class="btn btn-small btn-success pull-right" href="{{ URL::to('transactions/create') }}"><i class="fa fa-plus"></i>&nbsp; {{__('Create Transaction')}}</a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box box-success">
                        <div class="box-header"></div>
                        <div class="box-body">
                            <table id="myTable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th width="140">{{__('Created at')}}</th>
                                    <th width="30">{{__('Transaction Type')}}</th>
                                    <th>{{__('Amount')}}</th>
                                    <th class="hidden-xs">{{__('Company')}}</th>
                                    <th class="hidden-xs">{{__('Created By')}}</th>
                                    <th>{{__('Actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($transactions as $value)
                                    <tr>
                                        <td>{{ $value->created_at }}</td>
                                        @if($value->transaction_type == 1)
                                        <td>{{__('Payment')}}</td>
                                        @elseif($value->transaction_type == 2)
                                        <td>{{__('Receipt')}}</td>
                                        @else
                                        <td>{{__('Charge')}}</td>
                                        @endif
                                        <td>{{ $value->amount}}</td>
                                        <td class="hidden-xs">{{ $value->account->company }}</td>
                                        <td class="hidden-xs">{{$value->user->name}}</td>
                                        <td class="item_btn_group">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                                    <i class="fa fa-list"></i><span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="{{ url('transactions/' . $value->id . '/edit') }}"><i class="fa fa-pencil"></i> {{trans('transaction.edit')}}</a></li>
                                                    <li>
                                                        <a href="#" class="delete-form" onclick="return confirm('are you sure?')"><i class="fa fa-trash-o"></i>{{ Form::open(array('url' => 'transactions/' . $value->id, 'class' => 'form-inline')) }}
                                                        {{ Form::hidden('_method', 'DELETE') }}
                                                        {{ Form::submit(trans('transaction.delete'), array('class' => 'delete-btn')) }}
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
@endsection
