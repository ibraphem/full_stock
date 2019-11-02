@if(count($daily_sales) || count($customer_payments) || count($receiving_payments) || count($expenses) )
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
            @if(isset($prev_balance))
            {{number_format($prev_balance)}}
            @endif
        </td>
    </tr>
    {{--get daily sales --}}
    @foreach($daily_sales as $daily_sale)
        @if($daily_sale->payment > '0.00')
        <tr>
        <?php $sale = DB::table('sales')->where('id', $daily_sale->sale_id)->first(); ?>
        <?php $customer = DB::table('customers')->where('id', $sale->customer_id)->first(); ?>
            <td>{{$customer->name}}</td>
            <td></td>
            <td>{{$daily_sale->payment}}</td>
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
            <td>{{number_format($customer_payment->payment)}}</td>
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
            <td>{{$supplier->name}}</td>
            <td></td>
            <td>{{number_format($receiving_payment->payment)}}</td>
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
            <td>{{number_format($expense->payment)}}</td>
            <td></td>
        </tr>
        @endif
    @endforeach
    <tr>
        <td><strong>{{__('Total')}}</strong></td>
        <td></td>
        <td>
        <?php $total_sales_payment = DB::table('sale_payments')->whereDate('created_at', '=', $request->DateCreated)->sum('payment'); ?>
        <?php $total_customer_payment = DB::table('customer_payments')->whereDate('created_at', '=', $request->DateCreated)->sum('payment'); ?>
        <strong>{{number_format( $total_sales_payment + $total_customer_payment)}}</strong>
        </td>
        <td>
        <?php $total_receivings_payment = DB::table('receiving_payments')->whereDate('created_at', '=', $request->DateCreated)->sum('payment'); ?>
        <?php $total_expenses_payment = DB::table('expenses')->whereDate('created_at', '=', $request->DateCreated)->sum('payment'); ?>
        <strong>{{number_format($total_receivings_payment + $total_expenses_payment )}}</strong>
        </td>
        <td>
            <strong>
            {{number_format($prev_balance + $total_sales_payment + $total_customer_payment - $total_receivings_payment - $total_expenses_payment)}}
            </strong>
        </td>
    </tr>
    
    </tbody>
</table>
@if(!$dailyreport)
<form action="{{url('reports/createpastdailyreport')}}" method="GET">
    {{csrf_field()}}
<input type="hidden" name="DateCreated" value="{{$request->DateCreated}}" >
<button type="submit" class="btn btn-success pull-right" onclick="return confirm('{{__('Are you Sure You want to close the report!')}}')">{{__('Close Report')}} </button>
</form>
@endif
@else
<h3 class="alert alert-warning text-center">{{__('No reports Available')}}</h3>
@endif