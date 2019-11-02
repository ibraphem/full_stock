@php
$avatar = '/dist/img/avatar5.png';
if (trim($customer->avatar) != 'no-foto.png') {
    $avatar = $customer->avatar;
}
@endphp
@extends('layouts.admin')
@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    {{__('Customer Profile')}}
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> {{__('Home')}}</a></li>
    <li><a href="#">{{__('User')}}</a></li>
    <li class="active">{{__('profile')}}</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
@include('partials.flash')
  <div class="row">
    <div class="col-md-3">

      <!-- Profile Image -->
      <div class="box box-success">
        <div class="box-body box-profile">
          <img class="profile-user-img img-responsive img-circle" src="{{asset($avatar)}}" alt="User profile picture">

          <h3 class="profile-username text-center">{{$customer->name}}</h3>
          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <b>{{__('Balance')}} </b> <a class="pull-right">{{$customer->prev_balance}}</a>
            </li>
            <li class="list-group-item hidden-print">
              <b>{{__('Total Sales')}} </b> <a class="pull-right">{{number_format($total_sales,2)}}</a>
            </li>
          </ul>
          <a class="btn btn-success btn-block hidden-print" href="#" data-toggle="modal" data-target="#myModal"><b>{{__('Add Payment')}}</b></a>
            <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">{{__('Add Payment')}}</h4>
                </div>
                <div class="modal-body">
                  {{ Form::open(['route'=>'customerpayments.store']) }}
                    <div class="form-group">
                        {{ Form::select('payment_type', ['Cash' => 'Cash', 'Check' => 'Check', 'DebitCard' => 'Debit Card', 'CreditCard' => 'Credit Card'], null, array('class' => 'form-control','placeholder'=>'Select a payment type','required')) }}
                    </div>
                  <div class="form-group">
                    {{ Form::hidden('customer_id', $customer->id, ['class'=>'form-control']) }}
                    {{ Form::number('payment', null, ['class'=>'form-control', 'placeholder'=>'Amount', 'required']) }}
                  </div>
                    <div class="form-group">
                        {{ Form::text('comments', null, ['class'=>'form-control','placeholder'=>'Comments']) }}
                    </div>
                  <div class="form-group">
                    {{ Form::submit('Add Payment', ['class'=>'btn btn-success']) }}
                  </div>
                  {{ Form::close() }}
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-success" data-dismiss="modal">{{__('Close')}}</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
      
     <!-- About Me Box -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">{{__('Payment History')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-hover table-striped">
            <thead>
              <tr>
                <th>{{__('Date')}}</th>
                <th>{{__('Payment')}}</th>
                <th>{{__('Received')}}</th>
              </tr>
            </thead>
            <tbody>
              @foreach($customer_payments as $customer_payment)
              <tr>
                <td>{{$customer_payment->created_at}}</td>
                <td>{{$customer_payment->payment}}</td>
                <td>{{$customer_payment->user->name}}</td>
              </tr>
              @endforeach
              <tr>
                <td colspan="3" style="background: #00a65a;padding: 2px;"></td>
              </tr>
              @foreach($sale_payments as $sale_payment)
              <tr>
                <td>{{$sale_payment->created_at}}</td>
                <td>{{$sale_payment->payment}}</td>
                <td>{{$sale_payment->user->name}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#saledues" data-toggle="tab">{{__('Sales With Dues')}}</a></li>
          <li><a href="#salescompleted" data-toggle="tab">{{__('Sales completed')}}</a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="saledues">
           @include('customer.partials.sale_table', ['salereport'=>$saleReport_dues, 'type'=>'dues'])
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="salescompleted">
              @include('customer.partials.sale_table', ['salereport'=>$saleReport_completed, 'type'=>'completed'])
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
</div>
@endsection
