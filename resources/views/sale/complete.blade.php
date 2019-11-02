@extends('layouts.sale')
@section('css')
    <link rel="stylesheet" href="{{asset('css/print.css')}}">
@endsection
@section('content')
<div class="content-wrapper sale-background" ng-app="tutapos">
    <!-- Content Header (Page header) -->
    <section class="content-header" >
      <h1>{{__('Sales/Invoice')}}</h1>
      
    </section>
    <!-- Main content -->
    <section class="content panel" >
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-3 bottom_border text-left">
                <div class="sale-logo">
                    @if(!empty(DB::table('flexible_pos_settings')->first()->logo_path))
                    <img src="{{asset(DB::table('flexible_pos_settings')->first()->logo_path)}}" alt="logo" >
                    @else
                    <img src="{{asset('images/fpos.png')}}" alt="logo">
                    @endif 
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6 bottom_border text-center">
                @if(!empty(DB::table('flexible_pos_settings')->first()->logo_path))
                     <strong>{{DB::table('flexible_pos_settings')->first()->company_name}}</strong><br>
                @else
                 <strong>{{__('FLEXIBLEPOS')}}</strong><br>
                @endif 
                
                @if(!empty(DB::table('flexible_pos_settings')->first()->company_address))
                     {{DB::table('flexible_pos_settings')->first()->company_address}}<br>
                @else
                {{__('A reliable Company for your Business Software')}}<br>
                {{__('PHONE')}} : 01779652777<br>
                {{__('Infront of Hazera Taju Degree College,')}}<br>
                {{__('Chandgaon, Chittagong, Bangladesh.')}}
                @endif 
                

            </div>
            <div class="col-md-3 col-sm-3 col-xs-3 bottom_border">

            </div>
        </div>
        <div class="row header-border margin-bottom-15"></div>
        <div class="row bottom_border sale-heading-info">

                <div class="col-md-7 col-sm-7 col-xs-6 text-left">
                    {{trans('sale.customer')}}: {{ $sales->customer->name}}<br />
                    @if(!empty($sales->customer->address))
                    {{trans('sale.address')}}: {{ $sales->customer->address}}<br />
                    @endif
                    {{trans('sale.sale_id')}}: SALE{{$sales->id}}<br />

                </div>
                <div class="col-md-5 col-sm-5 col-xs-6 text-right">
                    Date : {{ Carbon\Carbon::now() }}<br>
                    @if(!empty($sales->customer->phone_number))
                    {{trans('sale.mobile')}} : {{$sales->customer->phone_number}}<br>
                    @endif
                    {{trans('sale.employee')}}: {{$sales->user->name}}<br />
                </div>

        </div>
        <div class="row header-border2"></div>
        <div class="row bottom_border">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive font-size-15">
                    <table class="table">
                        <thead>
                        <tr>
                            <td>{{trans('sale.item')}}</td>
                            <td>{{trans('sale.price')}}</td>
                            <td>{{trans('sale.qty')}}</td>
                            <td align="right">{{trans('sale.total')}}</td>
                        </tr>
                        </thead>
                        @foreach($saleItems as $value)
                            <tr>
                                <td>{{$value->item->item_name}}</td>
                                <td>{{$value->selling_price}}</td>
                                <td>{{$value->quantity}}</td>
                                <td align="right">{{$value->total_selling}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="row bottom_border print_footer header-border font-size-15">
            <div class="col-md-7 col-sm-7 col-xs-6">
                {{trans('sale.payment_type')}}: {{$sales->payment_type}}
            </div>
            <div class="col-md-2 col-sm-1"></div>
            <div class="col-md-3 col-sm-4 col-xs-6">
                <div class="row">
                    <div class="col-xs-4">{{__('Subtotal')}}: </div><div class="col-xs-8"> <span class="text-left">{{currencySymbol()}}</span><span class="pull-right"> {{ $sales->discount + $sales->grand_total - $sales->tax }}</span></div>
                    <div class="col-xs-4">{{__('Discount')}}: </div>
                    <div class="col-xs-8"> 
                        <span class="text-left"> {{currencySymbol()}}</span><span class="pull-right"> {{ $sales->discount }}</span>
                    </div>
                    <div class="col-xs-4">{{__('Payment')}}: </div>
                    <div class="col-xs-8"> 
                        <span class="text-left"> {{currencySymbol()}}</span><span class="pull-right"> {{ $sales->payment }}</span>
                    </div>
                    <div class="col-xs-4">{{__('Tax')}}: </div><div class="col-xs-8"> <span class="text-left">{{currencySymbol()}}</span><span class="pull-right"> {{ $sales->tax }}</span></div>
                    <div class="col-xs-4">{{__('Dues')}}: </div><div class="col-xs-8"> <span class="text-left">{{currencySymbol()}}</span><span class="pull-right"> {{ $sales->dues }}</span></div>
                </div>
            </div>
        </div>
        <hr class="hidden-print"/>
        <div class="row">
            <div class="col-md-8">
                &nbsp;
            </div>
            <div class="col-md-2">
                <button type="button" onclick="printInvoice()" class="btn btn-info pull-right hidden-print">{{trans('sale.print')}}</button>
            </div>
            <div class="col-md-2">
                <a href="{{ url('/sales') }}" type="button" class="btn btn-info pull-right hidden-print">{{trans('sale.new_sale')}}</a>
            </div>
        </div>
    </section>
</div>
@endsection