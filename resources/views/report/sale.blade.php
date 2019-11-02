@extends('layouts.sale')
@section('content')
<div class="content-wrapper" id="app">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>{{__('Income Report (Sales/Invoices)')}}</h1>
    </section>
    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-md-12">
            @include('partials.flash')
            <div class="box box-success">
                <div class="box-header"><h3 class="box-title">{{__('Income Summary')}}</h3></div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="well well-sm">{{trans('report-sale.grand_total')}}: {{DB::table('sales')->where('status', '!=', 0)->sum('grand_total')}}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="well well-sm">{{trans('report-sale.payment')}}: {{DB::table('sales')->where('status', '!=', 0)->sum('payment')}}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="well well-sm">{{trans('report-sale.dues')}}: {{DB::table('sales')->where('status', '!=', 0)->sum('dues')}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box box-success">
                <div class="box-header">
                    <form action="" method="get" id="saleReportFilterForm">
                        <select name="month" id="month" onchange="saleReportFilter()" >
                            <option value="">Month</option>
                            @foreach($months as $key=>$month)
                            <option value="{{$key}}"
                            {{(!empty($input['month']) && $input['month'] == $key) ? 'selected' : ''}}
                            >{{$month}}</option>
                            @endforeach
                        </select>
                        <select name="year" id="year" onchange="saleReportFilter()">
                            <option value="">Year</option>
                            @php 
                            $year = date('Y'); @endphp
                            @for($i= $year; $i>=($year - 5); $i--)
                            <option value="{{$i}}" 
                            {{(!empty($input['year']) && $input['year'] == $i) ? 'selected' : ''}}
                            >{{$i}}</option>
                            @endfor
                        </select>
                    </form>
                </div>
                <div class="box-body">
                   
                    <div id="list-sale-report">

                        <table class="table table-striped table-bordered" id="myTable1">
                            <thead>
                                <tr>
                                    <th>&nbsp;</th>
                                    @foreach($units as $key=>$unit)
                                        <th>{{$unit}}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        {{__('Total Sales')}}
                                    </td>
                                    @foreach($units as $key=>$unit)
                                    <td>{{ !empty($formated_report[$key]) ? count($formated_report[$key]) : 0}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>
                                        {{__('Sales Amount')}}
                                    </td>
                                    @foreach($units as $key=>$unit)
                                    @php
                                    $total_amount[$key] = 0;
                                    $total_payment[$key] = 0;
                                    $total_dues[$key] = 0;
                                    $total_discount[$key] = 0;
                                    $total_tax[$key] = 0;
                                    if(!empty($formated_report[$key])) {
                                        foreach($formated_report[$key] as $value) {
                                            $total_amount[$key] = $total_amount[$key] + $value->grand_total;
                                            $total_payment[$key] = $total_payment[$key] + $value->payment;
                                            $total_dues[$key] = $total_dues[$key] + $value->dues;
                                            $total_discount[$key] = $total_discount[$key] + $value->discount;
                                            $total_tax[$key] = $total_tax[$key] + $value->tax;
                                        }
                                    }
                                    @endphp
                                    <td>{{ currencySymbol().$total_amount[$key]}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>
                                        {{__('Sales Payment')}}
                                    </td>
                                    @foreach($units as $key=>$unit)
                                    <td>{{ currencySymbol().$total_payment[$key]}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>
                                        {{__('Sales Dues')}}
                                    </td>
                                    @foreach($units as $key=>$unit)
                                    <td>{{ currencySymbol().$total_dues[$key]}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>
                                        {{__('Sales Discount')}}
                                    </td>
                                    @foreach($units as $key=>$unit)
                                    <td>{{ currencySymbol().$total_discount[$key]}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>
                                        {{__('Sales Tax')}}
                                    </td>
                                    @foreach($units as $key=>$unit)
                                    <td>{{ currencySymbol().$total_tax[$key]}}</td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
</div>
@endsection
