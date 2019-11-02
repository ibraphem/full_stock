@extends('layouts.sale')
@section('content')
<div class="content-wrapper" id="app">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>{{__('Sales/Invoices')}}</h1>
    </section>
    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-md-12">
            @include('partials.flash')
            <div class="box box-success">
                <div class="box-header"><h3 class="box-title"> {{__('All Sales')}}</h3> 
                @if(auth()->user()->hasPermissionTo('sales.create'))
                <a class="btn btn-small btn-success pull-right" href="{{ URL::to('sales/create') }}"><i class="fa fa-plus"></i>&nbsp; {{__('Add Sale')}}</a>
                @endif
            </div>
            </div>
            <div class="box box-success">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label >{{__('From')}}</label>
                                <input type="text" name="StartDate" id="lStartDate" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="EndDate">{{__('To')}}</label>
                                <input type="text" name="EndDate" id="lEndDate" class="form-control" required />
                            </div>
                        </div>
                    </div>
                    <div id="list-sale-report">
                        @include('customer.partials.sale_table', ['salereport'=>$sales, 'type'=>'all'])
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
</div>
@endsection