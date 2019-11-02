@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>{{__('Stocks')}}</h1>
      
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
					<h3 class="box-title">@if(isset($item)){{__('Edit')}}@else {{__('Add')}} @endif {{__('Item')}}</h3><a class="btn btn-small btn-success pull-right" href="{{ URL::to('items') }}"><i class="fa fa-list"></i>&nbsp; List</a>
            	</div>
            </div>
          <div class="box box-success">
            
            <!-- /.box-header -->
            <div class="box-body">
				<div class="box-header"></div>
					@if(isset($item))
					 	{{ Form::model($item, array('route' => array('items.update', $item->id), 'method' => 'PUT', 'files' => true)) }}
					@else
						{{ Form::open(['url' => 'items', 'files' => true]) }}
					@endif
					<div class="col-md-6">
						
						<div class="form-group row">
						{{ Form::label('upc_ean_isbn', trans('item.upc_ean_isbn').' *', ['class'=>'col-sm-3 text-right']) }}
							<div class="col-sm-9"> 
							{{ Form::text('upc_ean_isbn',null, ['class' => 'form-control', 'required']) }}
							</div>
						</div>

						<div class="form-group row">
						{{ Form::label('item_name', trans('item.item_name').' *', ['class'=>'col-sm-3 text-right']) }}
							<div class="col-sm-9">
							{{ Form::text('item_name', null, ['class' => 'form-control','required']) }}
							</div>
						</div>

						<div class="form-group row">
						{{ Form::label('size', trans('item.size'), ['class'=>'col-sm-3 text-right']) }}
						<div class="col-sm-9"> 
						{{ Form::text('size', null, ['class' => 'form-control']) }}
						</div>
						</div>

						<div class="form-group row">
						{{ Form::label('description', trans('item.description'), ['class'=>'col-sm-3 text-right']) }}
						<div class="col-sm-9"> 
						{{ Form::textarea('description', null, ['class' => 'form-control', 'rows'=>4]) }}
						</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group row">
						{{ Form::label('cost_price', trans('item.cost_price').' *', ['class'=>'col-sm-3 text-right']) }}
						<div class="col-sm-9"> 
						{{ Form::text('cost_price', null, ['class' => 'form-control', 'required']) }}
						</div>
						</div>

						<div class="form-group row">
						{{ Form::label('selling_price', trans('item.selling_price').' *', ['class'=>'col-sm-3 text-right']) }}
						<div class="col-sm-9"> 
						{{ Form::text('selling_price', null, ['class' => 'form-control', 'required']) }}
						</div>
						</div>

						<div class="form-group row">
							{{ Form::label('quantity', trans('item.quantity').' *', ['class'=>'col-sm-3 text-right']) }}
							<div class="col-sm-9"> 
							{{ Form::text('quantity', null, ['class' => 'form-control', 'required']) }}
							</div>
						</div>
						<div class="form-group row">
							{{ Form::label('stock_limit', __('Stock Limit'), ['class'=>'col-sm-3 text-right']) }}
							<div class="col-sm-9"> 
							{{ Form::number('stock_limit', null, ['class' => 'form-control']) }}
							</div>
						</div>
						<div class="form-group row">
							{{ Form::label('expire_date', __('Expire Date'), ['class'=>'col-sm-3 text-right']) }}
							<div class="col-sm-9"> 
							{{ Form::date('expire_date', null, ['class' => 'form-control']) }}
							</div>
						</div>
						<div class="form-group row">
							{{ Form::label('avatar', trans('item.choose_avatar'), ['class'=>'col-sm-3 text-right']) }}
							<div class="col-sm-9">
							{{ Form::file('avatar', null, ['class' => 'form-control']) }}
								@if(isset($item))
								<img src="{{asset($item->avatar)}}" alt="" height="35">
								@endif
							</div>
						</div>
						<div class="row"> 
							<div class="col-sm-12 text-right">
							{{ Form::submit(trans('item.submit'), ['class' => 'btn btn-success btn-sp']) }}
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

