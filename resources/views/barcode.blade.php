@extends('app')
@section('content')
    <div class="container-fluid">
    <div class="row">
        <form class="form-inline" action="{{url('/processbarcode')}}" method="post">
        {{  csrf_field() }}
            <div class="col-md-3 col-md-offset-4">
                <label>{{__('Enter Barcode No')}} : </label>
                <input type="text" name="barcode" class="form-control">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">{{__('Get Barcode')}}</button>
            </div>
            
        </form>
        
    </div>
        <div class="row">
        @if(!empty($barcode))
            <div class="col-md-6 col-md-offset-4">
                <div class="barcode">{{ DNS1D::getBarcodeHTML($barcode, 'C128A') }}</div>
                <h3 class="barcode-no">{{ $barcode }}</h3>
            </div>
        @endif
        </div>
    </div>
@endsection