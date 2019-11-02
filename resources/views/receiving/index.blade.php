@extends('layouts.sale')
@section('content')
<div class="content-wrapper" ng-app="tutapos">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>{{__('Recevings')}}</h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
            <div class="box box-success">
                <div class="box-header"><h3 class="box-title"> {{trans('receiving.item_receiving')}}</h3></div>
            </div>
            <div class="box box-success">
                <div class="box-header"></div>    
                <div class="box-body">
                    @include('partials.flash')
                    <div class="row" ng-controller="SearchItemCtrl">

                        <div class="col-md-3">
                            <label>{{trans('receiving.search_item')}} <input ng-model="searchKeyword" class="form-control"></label>

                            <table class="table table-hover">
                            <tr ng-repeat="item in items  | filter: searchKeyword | limitTo:10">

                            <td>@{{item.item_name}}</td><td><button class="btn btn-success btn-xs" type="button" ng-click="addReceivingTemp(item,newreceivingtemp)"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span></button></td>
                            </tr>
                            </table>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                {{ Form::open(array('url' => 'receivings', 'class' => 'form-horizontal')) }}
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="invoice" class="col-sm-3 control-label">{{trans('receiving.invoice')}}</label>
                                            <div class="col-sm-9">
                                            <input type="text" class="form-control" id="invoice" value="@if ($receiving) {{$receiving->id + 1}} @else 1 @endif" readonly/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="employee" class="col-sm-3 control-label">{{trans('receiving.employee')}}</label>
                                            <div class="col-sm-9">
                                            <input type="text" class="form-control" name="employee_id" id="employee" value="{{ Auth::user()->name }}" readonly/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <label for="supplier_id" class="col-sm-4 control-label">{{trans('receiving.supplier')}}</label>
                                            <div class="col-sm-8">
                                            {{ Form::select('supplier_id', $supplier, null, array('class' => 'form-control','placeholder'=>'Select a supplier', 'required')) }}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="payment_type" class="col-sm-4 control-label">{{trans('receiving.payment_type')}}</label>
                                            <div class="col-sm-8">
                                            {{ Form::select('payment_type', array('Cash' => 'Cash', 'Check' => 'Check', 'Debit Card' => 'Debit Card', 'Credit Card' => 'Credit Card'), null, array('class' => 'form-control','placeholder'=>'Select a Payment type', 'required')) }}
                                            </div>
                                        </div>
                                    </div>
                            </div>

                            <table class="table table-bordered">
                                <tr><th>{{trans('receiving.item_id')}}</th><th>{{trans('receiving.item_name')}}</th><th>{{trans('receiving.cost')}}</th><th>{{trans('receiving.quantity')}}</th><th>{{trans('receiving.total')}}</th><th>&nbsp;</th></tr>
                                <tr ng-repeat="newreceivingtemp in receivingtemp">
                                <td>@{{newreceivingtemp.item_id}}</td><td>@{{newreceivingtemp.item.item_name}}</td><td>{{currencySymbol()}}@{{newreceivingtemp.item.cost_price }}</td><td><input type="text" style="text-align:center" autocomplete="off" name="quantity" ng-change="updateReceivingTemp(newreceivingtemp)" ng-model="newreceivingtemp.quantity" size="2"></td><td>{{currencySymbol()}}@{{newreceivingtemp.item.cost_price * newreceivingtemp.quantity }}</td><td><button class="btn btn-danger btn-xs" type="button" ng-click="removeReceivingTemp(newreceivingtemp.id)"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></td>
                                </tr>
                            </table>
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label for="total" class="col-sm-4 control-label">{{trans('receiving.amount_tendered')}}</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <div class="input-group-addon">{{currencySymbol()}}</div>
                                                <input type="text" class="form-control" name="total" id="amount_tendered" ng-model="amount_tendered" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div>&nbsp;</div>
                                    <div class="form-group">
                                        <label for="total" class="col-sm-4 control-label">{{trans('receiving.amount_payment')}}</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <div class="input-group-addon">{{currencySymbol()}}</div>
                                                <input type="text" class="form-control" name="payment" id="payment" ng-model='payment' required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div>&nbsp;</div>
                                    <div class="form-group">
                                        <label for="employee" class="col-sm-4 control-label">{{trans('receiving.comments')}}</label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control" name="comments" id="comments" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="supplier_id" class="col-sm-6 control-label">{{trans('receiving.grand_total')}}</label>
                                        <div class="col-sm-6">
                                            <p class="form-control-static"><b>{{currencySymbol()}}@{{sum(receivingtemp) }}</b></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="supplier_id" class="col-sm-6 control-label">{{trans('receiving.amount_tendered')}}</label>
                                        <div class="col-sm-6">
                                            <p class="form-control-static"><b>{{currencySymbol()}}@{{ amount_tendered }}</b></p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="supplier_id" class="col-sm-6 control-label">{{trans('receiving.amount_payment')}}</label>
                                        <div class="col-sm-6">
                                            <p class="form-control-static"><b>{{currencySymbol()}}@{{ payment }}</b></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="supplier_id" class="col-sm-6 control-label">{{trans('receiving.amount_dues')}}</label>
                                        <div class="col-sm-6">
                                            <p class="form-control-static"><b>{{currencySymbol()}}@{{amount_tendered - payment }}</b></p>
                                        </div>
                                    </div>
                                    <div>&nbsp;</div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                        <button type="submit" class="btn btn-success btn-block">{{trans('receiving.submit')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                {{ Form::close() }}
                        </div>
                    </div>
                </div>
                <div class="box-footer"></div>
            </div>
        </div>
    </div>
</section>
</div>
@endsection
@section('script')
    <script type="text/javascript" src="{{asset('js/angular.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/recevings.js')}}"></script>
@endsection