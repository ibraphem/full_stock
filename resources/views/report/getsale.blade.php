@extends('layouts.sale')

@section('content')
<div class="content-wrapper" ng-app="tutapos">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>{{__('Sales/Invoices')}}</h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <nav class="multineed navbar navbar-default menu-export" role="navigation">
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-mail-forward"></i> {{__('Export')}} <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#" id="excel" class="excel"><i class="fa fa-file-excel-o"></i> {{__('To Excel')}}</a></li>
                                    <li><a href="#" class="word"><i class="fa fa-file-word-o"></i> {{__('To Word')}}</a></li>
                                    <li><a href="#" class="pdf"><i class="fa fa-file-pdf-o"></i> {{__('To PDF')}}</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                    <div class="panel-heading" style="padding-top: 6px;">{{trans('report-sale.reports')}} - {{trans('report-sale.sales_report')}}</div>

                    <div class="panel-body">
                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label >{{__('From')}}</label>
                                    <input type="text" name="StartDate" id="StartDate" class="form-control" required />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="EndDate">{{__('To')}}</label>
                                    <input type="text" name="EndDate" id="EndDate" class="form-control" required />
                                </div>
                            </div>
                        </div>

                        <div id="list-of-sale"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection