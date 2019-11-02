@extends('layouts.admin')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>{{__('Expense Category')}}</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> {{__('Home')}}</a></li>
        <li><a href="#">{{__('Expense Category')}}</a></li>
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
              <h3 class="box-title">{{__('Expense Category List')}}</h3><a class="btn btn-small btn-success pull-right" href="#modal-id" data-toggle="modal"><i class="fa fa-plus"></i>&nbsp; {{__('Create Expense Category')}}</a>
              
              <div class="modal fade" id="modal-id">
                  <div class="modal-dialog">
                      {{ Form::open(['route' => 'expensecategory.store', 'method' => 'post']) }}
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              <h4 class="modal-title">{{__('Add A Expense Category')}}</h4>
                          </div>
                          <div class="modal-body">
                              <div class="form-group">
                                  {{ Form::label('name', __('Name *')) }}
                                  {{ Form::text('name', null, array('class' => 'form-control', 'required')) }}
                              </div>
                              <div class="form-group">
                                  {{ Form::label('description', __('Description')) }}
                                  {{ Form::textarea('description', null, array('class' => 'form-control')) }}
                              </div>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">{{__('Close')}}</button>
                              <button type="submit" class="btn btn-success">{{__('Create')}}</button>
                          </div>
                      </div>
                      {{ Form::close() }}
                  </div>
              </div>

            </div>
          </div>
            <!-- /.box-header -->
            <div class="box box-success">
              <div class="box-header">
                  <div class="button-group">
                    @foreach($expense_categories as $value)
                    <button type="button" class="btn btn-info"><a href="{{route('expensecategory.show', $value->id)}}" style="color:#fff;">{{$value->name}}</a></button>
                    @endforeach
                  </div>
              </div>
            <div class="box-body">
              @if(!empty($expensecategory))
                @include('expense.partials.expense_table', ['expenses'=>$expensecategory->expense])
              @endif
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
