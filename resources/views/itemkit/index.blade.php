@extends('layouts.admin')

@section('content')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>{{trans('itemkit.item_kits')}}</h1>
            
        </section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">{{trans('itemkit.item_kits')}}</div>

				<div class="panel-body">
				<a class="btn btn-small btn-success" href="{{ URL::to('item-kits/create') }}">{{trans('itemkit.new_item_kit')}}</a>
				<hr />
@if (Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>{{trans('itemkit.item_kit_id')}}</td>
            <td>{{trans('itemkit.item_kit_name')}}</td>
            <td>{{trans('itemkit.cost_price')}}</td>
            <td>{{trans('itemkit.selling_price')}}</td>
            <td>{{trans('itemkit.item_kit_description')}}</td>
            <td>&nbsp;</td>
        </tr>
    </thead>
    <tbody>
        @foreach($itemkits as $value)
        <tr>
            <td>{{$value->id}}</td>
            <td>{{$value->item_name}}</td>
            <td>{{$value->cost_price}}</td>
            <td>{{$value->selling_price}}</td>
            <td>{{$value->description}}</td>
            <td>..</td>
        </tr>
        @endforeach
    
    </tbody>
</table>
				</div>
			</div>
		</div>
	</div>
</section>
    </div>
@endsection