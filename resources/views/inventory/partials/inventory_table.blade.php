<div class="box box-success">
    <div class="box-header"><div class="box-title">{{__($title)}}</div></div>
    <div class="box-body">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td>{{trans('item.inventory_data_tracking')}}</td>
                    <td>{{trans('item.employee')}}</td>
                    <td>{{trans('item.in_out_qty')}}</td>
                    <td>{{trans('item.remarks')}}</td>
                </tr>
            </thead>
            <tbody>
                <?php $total = 0 ?>
            @foreach($inventory as $value)
                <tr>
                    <td>{{ $value->created_at }}</td>
                    <td>{{ $value->user->name }}</td>
                    <td>{{ $value->in_out_qty }}</td>
                    <?php $total = $total + ($value->in_out_qty); ?>
                    <td>{{ $value->remarks }}</td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td><b>{{__('Total')}}</b></td>
                    <td> <b>{{$total}}</b></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>