@extends('layouts.sale')
@section('css')
    <link rel="stylesheet" href="{{asset('css/print.css')}}">
@endsection
@section('content')
<div class="content-wrapper sale-background" ng-app="tutapos">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Receivings</h1>
    </section>

    <!-- Main content -->
    <section class="content panel">
     
       <div class="row">
            <div class="col-md-12 bottom_border text-center">
                @if(!empty(DB::table('flexible_pos_settings')->first()->logo_path))
                <img src="{{asset(DB::table('flexible_pos_settings')->first()->logo_path)}}" alt="" height="40px">
                @else
                <img src="{{asset('images/fpos.png')}}" alt="" height="40px">
                @endif 
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 bottom_border">
                {{trans('receiving.supplier')}}: {{ $receivings->supplier->company_name}}<br />
                {{trans('receiving.receiving_id')}}: RECV{{$receivingItemsData->receiving_id}}<br />
                {{trans('receiving.employee')}}: {{$receivings->user->name}}<br />
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 header-border">
                
               <table class="table table-responsive">
                    <tr>
                        <td>{{trans('receiving.item')}}</td>
                        <td>{{trans('receiving.price')}}</td>
                        <td>{{trans('receiving.qty')}}</td>
                        <td class="text-right">{{trans('receiving.total')}}</td>
                    </tr>
                    @foreach($receivingItems as $value)
                    <tr>
                        <td>{{$value->item->item_name}}</td>
                        <td>{{currencySymbol().$value->cost_price}}</td>
                        <td>{{$value->quantity}}</td>
                        <td class="text-right">{{currencySymbol().$value->total_cost}}</td>
                    </tr>
                    @endforeach
                </table>
            
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-8 header-border2">
                {{trans('receiving.payment_type')}}: {{$receivings->payment_type}}
            </div>
            <div class="col-xs-6 col-sm-4 header-border2">
                <div class="row">
                    <div class="col-xs-6">{{trans('receiving.amount_tendered')}}: </div><div class="col-xs-6"> <span class="text-left">{{currencySymbol()}}</span><span class="pull-right"> {{$receivings->total}}</span></div>
                    
                    <div class="col-xs-6">{{trans('receiving.amount_payment')}}:</div>
                    <div class="col-xs-6"> 
                        <span class="text-left">{{currencySymbol()}}</span><span class="pull-right"> {{$receivings->payment}}</span>
                    </div>
                    
                    <div class="col-xs-6">{{trans('receiving.amount_dues')}} : </div>
                    <div class="col-xs-6"> <span class="text-left">{{currencySymbol()}}</span><span class="pull-right"> {{$receivings->dues}}</span></div>
                </div>
            </div>
        </div>
        <hr class="hidden-print"/>
        <div class="row">
            <div class="col-md-8">
                &nbsp;
            </div>
            <div class="col-md-2">
                <button type="button" onclick="printInvoice()" class="btn btn-info pull-right hidden-print">{{trans('receiving.print')}}</button> 
            </div>
            <div class="col-md-2">
                <a href="{{ url('/receivings') }}" type="button" class="btn btn-info pull-right hidden-print">{{trans('receiving.new_receiving')}}</a>
            </div>
        </div>
    </section>
</div>
@endsection