@php
    $avatar = '/dist/img/avatar5.png';
    if (trim($supplier->avatar) != 'no-foto.png') {
        $avatar = $supplier->avatar;
    }
@endphp
@extends('layouts.admin')
@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    {{__('Supplier Profile')}}
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> {{__('Home')}}</a></li>
    <li><a href="#">{{__('Supplier')}}</a></li>
    <li class="active"> {{__('profile')}}</li>
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

          <h3 class="profile-username text-center">{{$supplier->name}}</h3>

          <p class="text-muted text-center"> {{__('supplier Info')}}</p>

          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <b>Balance </b> <a class="pull-right">{{$supplier->prev_balance}}</a>
            </li>
            <li class="list-group-item">
              <b>Total Receivings </b> <a class="pull-right">{{number_format($total_receivings,2)}}</a>
            </li>
          </ul>
          <a class="btn btn-success btn-block" href="#" data-toggle="modal" data-target="#myModal"><b>{{__('Add Payment')}}</b></a>
            <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">{{__('Add Payment')}}</h4>
                </div>
                <div class="modal-body">
                  {{ Form::open(['route'=>'supplierpayments.store']) }}
                  <div class="form-group">
                    {{ Form::select('payment_type', ['Cash' => 'Cash', 'Check' => 'Check', 'DebitCard' => 'Debit Card', 'CreditCard' => 'Credit Card'], null, array('class' => 'form-control','placeholder'=>'Select a payment type','required')) }}
                  </div>
                  <div class="form-group">
                    {{ Form::hidden('supplier_id', $supplier->id, ['class'=>'form-control','required']) }}
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
                <th class="hidden-md">{{__('Received')}}</th>
              </tr>
            </thead>
            <tbody>
              @foreach($supplier_payments as $supplier_payment)
              <tr>
                <td>{{$supplier_payment->created_at}}</td>
                <td>{{$supplier_payment->payment}}</td>
                <td class="hidden-md">{{$supplier_payment->user->name}}</td>
              </tr>
              @endforeach
              <tr>
                <td colspan="3" class="border-2x"></td>
              </tr>
              @foreach($receiving_payments as $receiving_payment)
              <tr>
                <td>{{$receiving_payment->created_at}}</td>
                <td>{{$receiving_payment->payment}}</td>
                <td class="hidden-md">{{$receiving_payment->user->name}}</td>
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
          <li class="active"><a href="#saledues" data-toggle="tab">{{__('Receivings Dues')}}</a></li>
          <li><a href="#salescompleted" data-toggle="tab">{{__('Receivings Completed')}}</a></li>
          <!-- <li><a href="#settings" data-toggle="tab">Receivings</a></li> -->
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="saledues">
           @include('supplier.partials.receiving_table', ['receivingreport'=>$receivingReport_dues, 'type'=>'dues'])
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="salescompleted">
            <!-- The timeline -->
          @include('supplier.partials.receiving_table', ['receivingreport'=>$receivingReport_completed, 'type'=>'completed'])
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
