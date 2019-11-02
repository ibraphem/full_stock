@extends('layouts.admin')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>{{__('Daily Reports')}}</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> {{__('Home')}}</a></li>
        <li><a href="#">{{__('Daily Reports')}}</a></li>
        <li class="active">All</li>
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
              <h3 class="box-title">{{__('Expense List')}}</h3><a class="btn btn-small btn-success pull-right" href="{{ URL::to('reports/dailyreport/create') }}"><i class="fa fa-plus"></i>&nbsp; {{__('Create Daily Report')}}</a>
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
                        <th>{{__('Previous Balance')}}</th>
                        <th>{{__('Sales')}}</th>
                        <th>{{__('Dues')}}</th>
                        <th>{{__('Sale Profit')}}</th>
                        <th>{{__('Expenses')}}</th>
                        <th>{{__('Receivings')}}</th>
                        <th>{{__('Receivings Payment')}}</th>
                        <th>{{__('Total Costing')}}</th>
                        <th>{{__('Gross')}}</th>
                        <th>{{__('Net Balance')}}</th>
                        <th>{{__('Actions')}}</th>
                    </tr>
                </thead>
                <tbody>
    	@foreach($dailyreports as $value)
        <tr>
          <td>{{ $value->created_at }}</td>
          <td>{{ $value->prev_balance }}</td>
          <td>{{ $value->total_sales }}</td>
          <td>{{$value->total_dues}}</td>
          <td>{{$value->sale_profit}}</td>
          <td>{{$value->total_expense}}</td>
          <td>{{$value->total_receivings}}</td>
          <td>{{$value->total_receivings_payment}}</td>
          <td>{{$value->total_costing}}</td>
          <td>{{$value->total_profit}}</td>
          <td>{{$value->net_balance}}</td>
          <td class="item_btn_group">
              <div class="btn-group">
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-list"></i><span class="caret"></span>
                  <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                  <li>
                      <a href="#" class="delete-form" onclick='return confirm("{{__('are you sure?')}}")'><i class="fa fa-trash-o"></i>
                  {{ Form::open(array('url' => 'reports/dailyreport/' . $value->id, 'class' => 'form-inline')) }}
                  {{ Form::hidden('_method', 'DELETE') }}
                  {{ Form::submit(trans('expense.delete'), array('class' => 'delete-btn')) }}
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