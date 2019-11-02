@extends('layouts.sale')
@section('content')
<div class="content-wrapper" id="app">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>{{__('Daily Reports')}}</h1>
      
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-success">
                    <div class="box-header hidden-print"><h3 class="box-title">{{__('Daily Report')}}</h3> <a class="btn btn-small btn-success pull-right" href="{{ URL::to('reports/dailyreport') }}"><i class="fa fa-list"></i>&nbsp; {{__('List')}}</a></div>
                </div>
                <div class="box box-success">
                    <div class="box-header"></div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group form-inline hidden-print">
                                    <label for="StartDate">{{__('Select Date')}}</label>
                                    <input type="text" name="StartDate" id="reportStartDate" class="form-control" required />
                                </div>
                            </div>
                            <div class="col-md-5">
                                <h3 class="panel-title text-left" style="margin-left: 50px;">{{__('DAILY INCOME AND EXPENSE')}}</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" id="daily-report">
                                <h4 class="text-center"> {{__('Date')}} : {{\Carbon\Carbon::today()->format('Y-m-d')}}</h4>
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>{{__('Income Source')}}</th>
                                        <th>{{__('Expense Source')}}</th>
                                        <th>{{__('Credit')}}</th>
                                        <th>{{__('Debit')}}</th>
                                        <th>{{__('Balance')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{__('Previous Balance')}}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            @if(empty($exist_report))
                                            {{currencySymbol().$starting_balance}}
                                            @else
                                            {{ currencySymbol().$starting_balance = $exist_report->prev_balance}}
                                            @endif
                                        </td>
                                    </tr>
                                    {{--get daily sales --}}
                                    @foreach($daily_sales as $daily_sale)
                                        @if($daily_sale->payment > '0.00')
                                        <tr>
                                            <?php $sale = DB::table('sales')->where('id', $daily_sale->sale_id)->first();
                                            $customer = DB::table('customers')->where('id', $sale->customer_id)->first(); ?>
                                            <td>Sales: {{$customer->name}}</td>
                                            <td></td>
                                            <td>{{currencySymbol().$daily_sale->payment}}</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        @endif
                                    @endforeach
                                   
                                    {{--get daily payments for individual customer--}}
                                    @foreach($customer_payments as $customer_payment)
                                        @if($customer_payment->payment > '0.00')
                                        <tr>
                                            <td>{{$customer_payment->customer->name}}</td>
                                            <td></td>
                                            <td>{{currencySymbol().number_format($customer_payment->payment)}}</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        @endif
                                    @endforeach
                                    {{--get daily receivings--}}
                                    @foreach($receiving_payments as $receiving_payment)
                                        @if($receiving_payment->payment > '0.00')
                                        <tr>
                                            <td></td>
                                            <?php $receiving = DB::table('receivings')->where('id', $receiving_payment->receiving_id)->first();
                                            $supplier = DB::table('suppliers')->where('id', $receiving->supplier_id)->first(); ?>
                                            <td>Receivings: {{$supplier->name}}</td>
                                            <td></td>
                                            <td>{{currencySymbol().number_format($receiving_payment->payment)}}</td>
                                            <td></td>
                                        </tr>
                                        @endif
                                    @endforeach
                                    {{--get daily purchases for chicks--}}
                                    @foreach($expenses as $expense)
                                        @if($expense->payment > '0.00')
                                        <tr>
                                            <td></td>
                                            <td>{{$expense->expense_category->name . " : " .$expense->description}}</td>
                                            <td></td>
                                            <td>{{currencySymbol().number_format($expense->payment)}}</td>
                                            <td></td>
                                        </tr>
                                        @endif
                                    @endforeach
                                    <tr>
                                        <td><strong>{{__('Total')}}</strong></td>
                                        <td></td>
                                        <td>
                                        <?php $total_sales_payment = DB::table('sale_payments')->whereDate('created_at', '=', date('Y-m-d'))->sum('payment'); ?>
                                        <?php $total_customer_payment = DB::table('customer_payments')->whereDate('created_at', '=', date('Y-m-d'))->sum('payment'); ?>
                                        <strong>{{currencySymbol().number_format( $total_sales_payment + $total_customer_payment)}}</strong>
                                        </td>
                                        <td>
                                        <?php $total_receivings_payment = DB::table('receiving_payments')->whereDate('created_at', '=', date('Y-m-d'))->sum('payment'); ?>
                                        <?php $total_expenses_payment = DB::table('expenses')->whereDate('created_at', '=', date('Y-m-d'))->sum('payment'); ?>
                                        <strong>{{currencySymbol().number_format($total_receivings_payment + $total_expenses_payment )}}</strong>
                                        </td>
                                        <td>
                                            <strong>
                                                {{currencySymbol().number_format($starting_balance + $total_sales_payment + $total_customer_payment - $total_receivings_payment - $total_expenses_payment,2)}}
                                        </strong>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                @if(empty($dailyreport) || is_null($exist_report))
                            <a href="{{url('reports/createdailyreport')}}" class="btn btn-success pull-right" onclick="return confirm('Are you Sure You want to close the report!')">Close Report </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <p>*** You should close the daily report on the end of the working day to get the accurate result.</p>
                    </div>
                    </div>

            </div>
        </div>
    </section>
</div>
@endsection