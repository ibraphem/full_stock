<div class="row">
    <!---Income-->
    <div class="col-md-4">
        <div class="info-box">
            <a href="{{route('sales.index')}}"><span class="info-box-icon bg-aqua"><i class="fa fa-shopping-cart"></i></span></a>
            <div class="info-box-content">
                <span class="info-box-text">{{__('Total Incomes')}}</span>
                <span class="info-box-number">{{currencySymbol().number_format($totalincome, 2)}}</span>
                <div class="progress-group" title="{{__('Income Dues').' '.currencySymbol().number_format($income_dues, 2)}}" data-toggle="tooltip" data-html="true">
                    <div class="progress sm">
                        <div class="progress-bar progress-bar-aqua" style="width: 100%"></div>
                    </div>
                    <span class="progress-text">{{__('Receivables')}}</span>
                    <span class="progress-number">{{currencySymbol().number_format($income_dues, 2)}}</span>
                </div>
            </div>
        </div>
    </div>

    <!---Expense-->
    <div class="col-md-4">
        <div class="info-box">
            <a href="{{route('receivings.index')}}"><span class="info-box-icon bg-red"><i class="fa fa-cart-arrow-down"></i></span></a>
            <div class="info-box-content">
                <span class="info-box-text">{{__('Total Expenses')}}</span>
            <span class="info-box-number">{{currencySymbol().number_format($total_exp, 2)}}</span>
                <div class="progress-group" title="{{__('Expense Dues').' '.currencySymbol().number_format($exp_dues, 2)}}" data-toggle="tooltip" data-html="true">
                    <div class="progress sm">
                        <div class="progress-bar progress-bar-red" style="width: 100%"></div>
                    </div>
                    <span class="progress-text">{{__('Payables')}}</span>
                    <span class="progress-number">{{currencySymbol().number_format($exp_dues, 2)}}</span>
                </div>
            </div>
        </div>
    </div>
    @php
        $sign = '';
        $total_profit = $totalincome - $total_exp;
        if ($total_profit < 0) {
            $sign = ' - ';
            $total_profit = abs($total_profit);
        }
    @endphp
    <!---Profit-->
    <div class="col-md-4">
        <div class="info-box">
            <a href="#"><span class="info-box-icon bg-green"><i class="fa fa-dollar"></i></span></a>
            <div class="info-box-content">
                <span class="info-box-text">{{__('Total Profit')}}</span>
                <span class="info-box-number">{{$sign.currencySymbol().number_format($total_profit, 2)}}</span>
                <div class="progress-group" title="{{__('Income Dues').' '.currencySymbol().number_format($income_dues, 2)}}" data-toggle="tooltip" data-html="true">
                    <div class="progress sm">
                        <div class="progress-bar progress-bar-green" style="width: 100%"></div>
                    </div>
                    <span class="progress-text">{{__('Upcoming')}}</span>
                    <span class="progress-number">{{currencySymbol().number_format($income_dues, 2)}}</span>
                </div>
            </div>
        </div>
    </div>
</div>