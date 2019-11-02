@extends('layouts.sale')
@section('content')
<div class="content-wrapper" ng-app="flexiblepos">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>{{__('Sales')}}</h1>
      
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
            @include('partials.flash')
            <div class="box box-success">
                <div class="box-header"><h3 class="box-title"> {{trans('sale.sales_register')}}</h3></div>
            </div>
            <div class="box box-success">
                <div class="box-header"></div>
                <div class="box-body">
                    
                    <div class="row" ng-controller="SearchItemCtrl">

                        <div class="col-md-3">
                            <label>{{trans('sale.search_item')}} <input ng-model="searchKeyword" class="form-control"></label>

                            <table class="table table-hover">
                            <tr ng-repeat="item in items  | filter: searchKeyword | limitTo:10">

                            <td>@{{item.item_name}}</td>
                            <td><button class="btn btn-success btn-xs" type="button" ng-click="addSaleTemp(item, newsaletemp)"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span></button></td>

                            </tr>
                            </table>
                        </div>
                        <div class="col-md-9">
                            {{ Form::open(array('url' => 'sales', 'class' => 'form-horizontal', 'id'=>'saleForm')) }}
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="invoice" class="col-sm-3 control-label">{{trans('sale.invoice')}}</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" id="invoice" value="@if ($sale) {{$sale->id + 1}} @else 1 @endif" readonly/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="employee" class="col-sm-3 control-label">{{trans('sale.employee')}}</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" id="employee" value="{{ Auth::user()->name }}" readonly/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label for="customer_id" class="col-sm-4 control-label">{{trans('sale.customer')}}</label>
                                        <div class="col-sm-6 no-margin no-right-padding">
                                    <select class="form-control select2" name="customer_id" required>
                                        <option value="">{{__('Select Customer')}}</option>
                                            @foreach($customers as $customer)
                                        <option value="{{$customer->id}}" {{($customer->name == App\Customer::WALKING_CUSTOMER) ? "selected" : ""}}>{{$customer->name}}</option>
                                            @endforeach
                                        </select>
                                    
                                        </div>
                                        <div class="col-sm-2 no-margin no-left-padding">
                                            <a class="btn btn-success pull-right" href="{{url('expenses')}}/#modal-id" data-toggle="modal"><i class="fa fa-plus"></i>&nbsp; {{__('Add')}}</a>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="payment_type" class="col-sm-4 control-label">{{trans('sale.payment_type')}}</label>
                                        <div class="col-sm-8">
                                        {{ Form::select(__('payment_type'), ['Cash' => __('Cash'), 'Check' => __('Check'), 'DebitCard' => __('Debit Card'), 'CreditCard' => __('Credit Card')], null, array('class' => 'form-control','placeholder'=>__('Select a payment type'),'required')) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-hover table-striped">
                                <tr>
                                    <th>{{trans('sale.item_id')}}</th>
                                    <th>{{trans('sale.item_name')}}</th>
                                    <th>{{trans('sale.price')}}</th>
                                    <th>{{trans('sale.quantity')}}</th>
                                    <th>{{trans('sale.total')}}</th>
                                    <th>&nbsp;</th>
                                </tr>
                                <tr ng-repeat="newsaletemp in saletemp">
                                    <td>@{{newsaletemp.item_id}}</td>
                                    <td>@{{newsaletemp.item.item_name}}</td>
                                    <td>{{currencySymbol()}}@{{newsaletemp.item.selling_price }}</td>
                                    <td><input type="text" style="text-align:center" autocomplete="off" name="quantity" ng-change="updateSaleTemp(newsaletemp)" ng-model="newsaletemp.quantity" size="2"></td>
                                    <td>{{currencySymbol()}}@{{newsaletemp.item.selling_price * newsaletemp.quantity }}</td>
                                    <td>
                                        <button class="btn btn-danger btn-xs" type="button" ng-click="removeSaleTemp(newsaletemp.id)">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="text-center"><a href="#" data-toggle="modal" data-target=".bs-example-modal-lg">{{__('Add Custom Product')}}</a></td>

                                </tr>

                            </table>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="total" class="col-sm-5 control-label">{{trans('sale.add_discount_flat')}}</label>
                                        <div class="col-sm-7">
                                            <div class="input-group">
                                                <div class="input-group-addon">{{currencySymbol()}}</div>
                                                <input type="number" class="form-control" name="discount" id="add_payment" ng-model="add_discount" ng-init="add_discount =0" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="total" class="col-sm-5 control-label">{{trans('sale.add_discount_percent')}}</label>
                                        <div class="col-sm-7">
                                            <div class="input-group">
                                                <div class="input-group-addon">{{currencySymbol()}}</div>
                                                <input type="number" class="form-control" name="discount_percent" id="add_payment" ng-model="add_discount_percent" ng-init="add_discount_percent =0" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="total" class="col-sm-5 control-label">{{trans('sale.add_payment')}}</label>
                                        <div class="col-sm-7">
                                            <div class="input-group">
                                                <div class="input-group-addon">{{currencySymbol()}}</div>
                                                <input type="number" class="form-control" name="payment" id="add_payment" ng-model="add_payment" ng-init="add_payment =0" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="employee" class="col-sm-5 control-label">{{trans('sale.comments')}}</label>
                                        <div class="col-sm-7">
                                        <input type="text" class="form-control" name="comments" id="comments" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="supplier_id" class="col-sm-4 control-label">{{trans('sale.sub_total')}}</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static subtotal"><b> <input type="text" name="subtotal" value="@{{sum(saletemp)}}" readonly="" class="form-control"></b></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="amount_due" class="col-sm-4 control-label">{{trans('sale.amount_discount')}}</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static"><b>{{currencySymbol()}}@{{ (sum(saletemp)*add_discount_percent /100) + add_discount }}</b></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="amount_due" class="col-sm-4 control-label">{{trans('sale.amount_payment')}}</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static"><b>{{currencySymbol()}}@{{ add_payment }}</b></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tax" class="col-sm-4 control-label">{{trans('sale.tax')}} :</label>
                                        <div class="col-sm-8">
                                        <p class="form-control-static">{{currencySymbol()}}@{{ (0*(sum(saletemp))/100)}}</p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="grand_total" class="col-sm-4 control-label">{{trans('sale.grand_dues')}}</label>
                                        <div class="col-sm-8">
                                        <p class="form-control-static">
                                            <b>{{currencySymbol()}}@{{ (sum(saletemp) - add_payment - add_discount - (sum(saletemp)*add_discount_percent /100))+ (0*(sum(saletemp))/100) }}</b>
                                        </p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success btn-block">{{trans('sale.submit')}}</button>
                                        </div>
                                        <div class="col-sm-6">
                                            <button type="button" id="holdSale" class="btn btn-warning btn-block">{{__('Hold')}}</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            {{ Form::close() }}
                            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">{{__('Custom item Details')}}</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                {{ Form::open(['url' => 'item/customcreate', 'files' => true]) }}
                                                <div class="form-inline">
                                                    <div class="col-sm-3">
                                                        <input type="text" name="item_name" class="form-control" id="item_name" placeholder="{{__('Item Name')}}" required>
                                                    </div>
                                                </div>
                                                <div class="form-inline">
                                                    <div class="col-sm-3">
                                                        <input type="number" name="selling_price" class="form-control" id="selling_price" placeholder="{{__('Selling Price')}}" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-2">
                                                    <input type="number" name="cost_price" class="form-control" id="cost_price" placeholder="{{__('Cost Price')}}" required>
                                                </div>

                                                <div class="form-group col-sm-2">
                                                    <input type="number" name="qty" class="form-control" id="qty" placeholder="{{__('Qty')}}" required>
                                                </div>
                                                <div class="col-sm-2">
                                                    <button class="btn btn-success custom-item-btn">{{trans('item.submit')}}</button>
                                                </div>
                                                {{ Form::close() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer"></div>
            </div>
        </div>
    </div>
</section>
</div>


<div class="modal fade" id="modal-id">
    <div class="modal-dialog">
        {{ Form::open(['route' => 'customers.store', 'method' => 'post']) }}
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">{{__('Add A Customer')}}</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    {{ Form::label('name', 'Name') }}
                    {{ Form::text('name', null, array('class' => 'form-control', 'required')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('phone_number', 'Phone/Mobile') }}
                    {{ Form::text('phone_number', null, array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('address', 'Address') }}
                    {{ Form::textarea('address', null, array('class' => 'form-control','rows'=>5)) }}
                </div>
                <div class="form-group">
                    {{ Form::label('type', 'Type') }}
                    {{ Form::select('type', [1=>"Permanent",2=>"General"], 2, array('class' => 'form-control', 'required')) }}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{__('Close')}}</button>
                <button type="submit" class="btn btn-success">{{__('Create')}}</button>
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>
@endsection
@section('script')
    <script type="text/javascript" src="{{asset('js/angular.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/sale.js')}}"></script>
@endsection