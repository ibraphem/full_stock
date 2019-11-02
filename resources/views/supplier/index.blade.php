@extends('layouts.admin')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>{{__('Suppliers')}}</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> {{__('Home')}}</a></li>
        <li><a href="#">{{__('Suppliers')}}</a></li>
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
              <h3 class="box-title">{{__('Suppliers List')}}</h3><a class="btn btn-small btn-success pull-right" href="{{ URL::to('suppliers/create') }}"><i class="fa fa-plus"></i>&nbsp; {{trans('supplier.new_supplier')}}</a>
            </div>
          </div>
            <!-- /.box-header -->
            <div class="box box-success">
              <div class="box-header"></div>
            <div class="box-body">
                    <table id="myTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <td>{{trans('supplier.company_name')}}</td>
                                <td class="hidden-xs">{{trans('supplier.name')}}</td>
                                <td class="hidden-xs">{{trans('supplier.email')}}</td>
                                <td>{{trans('supplier.phone_number')}}</td>
                                <td class="hidden-xs">{{trans('supplier.avatar')}}</td>
                                <td>&nbsp;</td>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($supplier as $value)
                            <tr>
                                <td>{{ $value->company_name }}</td>
                                <td class="hidden-xs">{{ $value->name }}</td>
                                <td class="hidden-xs">{{ $value->email }}</td>
                                <td>{{ $value->phone_number }}</td>
                                <td class="hidden-xs"><img src="{{asset($value->avatar)}}" alt="" height="50"></td>
                                <td class="item_btn_group">
                                    <div class="btn-group">
                                      <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-list"></i><span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                      </button>
                                      <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ url('suppliers/' . $value->id . '/') }}"><i class="fa fa-eye"></i> View Profile</a></li>
                                        <li><a href="{{ url('suppliers/' . $value->id . '/edit') }}"><i class="fa fa-pencil"></i> {{trans('item.edit')}}</a></li>
                                        <li>
                                            <a href="#" class="delete-form" onclick="return confirm('are you sure?')"><i class="fa fa-trash-o"></i>{{ Form::open(array('url' => 'suppliers/' . $value->id, 'class' => 'form-inline')) }}
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
            