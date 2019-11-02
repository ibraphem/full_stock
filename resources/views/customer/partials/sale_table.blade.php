 <!-- Post -->
 @if(count($salereport))
 <table class="table table-striped table-bordered" id="myTable1">
     <thead>
     <tr>
         <th>{{trans('report-sale.date')}}</th>
         <th>{{trans('report-sale.items_purchased')}}</th>
         <th class="hidden-xs">{{trans('report-sale.sold_by')}}</th>
         @if($type == 'all' || $type == 'datefilter')
         <th class="hidden-xs">{{trans('report-sale.sold_to')}}</th>
         @endif
         <th>{{trans('report-sale.total')}}</th>
         <th class="hidden-xs">{{trans('report-sale.payment')}}</th>
         <th class="hidden-xs">{{trans('report-sale.dues')}}</th>
         <th class="hidden-xs">{{trans('report-sale.payment_type')}}</th>
         <th>{{__('Status')}}</th>
         <th width="60" class="hidden-print">&nbsp;</th>
     </tr>
     </thead>

     <tbody class="list-sale-report">

     @foreach($salereport as $value)
         <tr>
             <td>{{ $value->created_at->format('d M Y') }}</td>
             <td>{{count($value->saleItems)}}</td>
             <td class="hidden-xs">{{ $value->user->name }}</td>
             @if($type == 'all' || $type == 'datefilter')
             <td class="hidden-xs">{{ $value->customer->name }}</td>
             @endif
             <td>{{currencySymbol().$value->grand_total}}</td>
             <td class="hidden-xs">{{currencySymbol().$value->payment}} </td>
             <td class="hidden-xs">{{currencySymbol().$value->dues}}</td>
             <td class="hidden-xs">{{ $value->payment_type }}</td>
             <td>{!! $value->getStatus() !!}</td>
             <td class="hidden-print">
               <div class="btn-group">
                   <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                     <i class="fa fa-list"></i><span class="caret"></span>
                     <span class="sr-only">Toggle Dropdown</span>
                   </button>
                   <ul class="dropdown-menu" role="menu">
                       <li><a data-toggle="collapse" href="#detailedSales{{ $value->id }}" aria-expanded="false" aria-controls="detailedReceivings"><i class="fa fa-eye"></i> 
                       {{trans('report-sale.detail')}}</a>
                     </li>
                     @if(auth()->user()->hasPermissionTo('sale.edit'))
                     <li><a href="{{route('sale.edit', $value->id)}}" ><i class="fa fa-pencil"></i> 
                       {{__('Edit')}}</a>
                     </li>
                     @endif
                     @if($value->status == \App\Sale::DUE)
                     <li><a href="#" data-toggle="modal" data-target="#myModal{{$value->id}}"><i class="fa fa-money"></i>  {{__('Payment')}}</a>
                     @endif
                   </ul>
                   <div class="modal fade" id="myModal{{$value->id}}" role="dialog">
                     <div class="modal-dialog modal-sm">
                       <div class="modal-content">
                         <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal">&times;</button>
                           <h4 class="modal-title">{{__('Add Payment')}}</h4>
                         </div>
                         <div class="modal-body">
                           {{ Form::open(['route'=>'salepayments.store']) }}
                           <div class="form-group">
                           {{ Form::select('payment_type', ['Cash' => 'Cash', 'Check' => 'Check', 'DebitCard' => 'Debit Card', 'CreditCard' => 'Credit Card'], null, array('class' => 'form-control','placeholder'=>'Select a payment type','required')) }}
                           </div>
                           <div class="form-group">
                             {{ Form::hidden('sale_id', $value->id, ['class'=>'form-control']) }}
                             {{ Form::number('payment', null, ['class'=>'form-control', 'placeholder'=>'Amount', 'min'=>0, 'required']) }}
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
             </td>
         </tr>

         <tr class="collapse" id="detailedSales{{ $value->id }}">
             <td colspan="10">
                 <table class="table">
                     <tr>
                         <td>{{trans('report-sale.item_id')}}</td>
                         <td>{{trans('report-sale.item_name')}}</td>
                         <td>{{trans('report-sale.quantity_purchase')}}</td>
                         <td>{{trans('report-sale.total')}}</td>
                         <td>{{trans('report-sale.profit')}}</td>
                     </tr>
                     @foreach($value->saleItems as $SaleDetailed)
                         <tr>
                             <td>{{ $SaleDetailed->item_id }}</td>
                             <td>{{ $SaleDetailed->item->item_name }}</td>
                             <td>{{ $SaleDetailed->quantity }}</td>
                             <td>{{currencySymbol()}}{{ $SaleDetailed->selling_price * $SaleDetailed->quantity}}</td>
                             <td>{{currencySymbol()}}{{ ($SaleDetailed->quantity * $SaleDetailed->selling_price) - ($SaleDetailed->quantity * $SaleDetailed->cost_price)}}</td>
                         </tr>
                     @endforeach
                 </table>
             </td>
         </tr>
        @endforeach

     </tbody>
 </table>
 @endif
<!-- /.post -->
@if($type != 'datefilter')
<div class="paginations hidden-print">
   {{ $salereport->render() }}
</div>
@endif