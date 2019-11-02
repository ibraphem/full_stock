@extends('layouts.admin')

@section('content')
<div class="content-wrapper" ng-app="tutapos">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>{{__('Recevings')}}</h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-success">
                    <div class="box-header"><h3 class="box-title">{{trans('report-receiving.reports')}} - {{trans('report-receiving.receivings_report')}}</h3>
                    @if(auth()->user()->hasPermissionTo('sales.create'))
                <a class="btn btn-small btn-success pull-right" href="{{ URL::to('receivings/create') }}"><i class="fa fa-plus"></i>&nbsp; {{__('Add Recevings')}}</a>
                @endif
                </div>
                </div>
                <div class="box box-success">
                    <div class="box-body">
                        
                        @include('supplier.partials.receiving_table', ['receivingreport'=>$receivingReport, 'type'=>'all'])
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
