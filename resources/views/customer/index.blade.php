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
              <h3 class="box-title">{{__('Customers List')}}</h3><a class="btn btn-small btn-success pull-right" href="{{ URL::to('customers/create') }}"><i class="fa fa-plus"></i>&nbsp; {{trans('customer.new_customer')}}</a>
            </div>
          </div>
            <!-- /.box-header -->
            <div class="box box-success">
              <div class="box-header"></div>
            <div class="box-body">
              <table id="myTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="50" class="hidden-xs">{{trans('customer.customer_id')}}</th>
                        <th>{{trans('customer.name')}}</th>
                        <th>{{trans('customer.email')}}</th>
                        <th class="hidden-xs">{{trans('customer.phone_number')}}</th>
                        <th class="hidden-xs">{{trans('customer.avatar')}}</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
    @foreach($customer as $value)
        <tr>
          <td class="hidden-xs">{{ $value->id }}</td>
          <td>{{ $value->name }}</td>
          <td>{{ $value->email }}</td>
          <td class="hidden-xs">{{ $value->phone_number }}</td>
          <td class="hidden-xs"><img src="{{asset($value->avatar)}}" alt="" height="50"></td>
          <td class="item_btn_group">
              <div class="btn-group">
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-list"></i><span class="caret"></span>
                  <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="{{ url('customers/' . $value->id . '/') }}"><i class="fa fa-eye"></i> View Profile</a></li>
                  <li><a href="{{ url('customers/' . $value->id . '/edit') }}"><i class="fa fa-pencil"></i> {{trans('item.edit')}}</a></li>
                  <li>
                      <a href="#" class="delete-form" onclick="return confirm('are you sure?')"><i class="fa fa-trash-o"></i>{{ Form::open(array('url' => 'customers/' . $value->id, 'class' => 'form-inline')) }}
                  {{ Form::hidden('_method', 'DELETE') }}
                  {{ Form::submit(trans('item.delete'), array('class' => 'delete-btn')) }}
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
