@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>{{__('Settings')}}</h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
            <!-- /.box-header -->
          <!-- /.box -->
            @include('partials.flash')
            <div class="box box-success">
            	<div class="box-header">
		            <h3 class="box-title">{{__('Application Settings')}}</h3>
            	</div>
            </div>
          <div class="box box-success">
            
            <!-- /.box-header -->
            <div class="">
                <div class="box-header">
                    <div class="box-title"></div>
                  </div>
                <div class="box-body">
                    @if(!empty($flexiblepossetting))
                    {{ Form::model($flexiblepossetting, array('route' => array('flexiblepossetting.update', $flexiblepossetting->id), 'method' => 'PUT', 'files' => true)) }}
                  @else
                    {{ Form::open(array('route' => 'flexiblepossetting.store', 'files' => true,)) }}
                  @endif
      				<div class="col-md-6">
                <div class="form-group row">
                  {{ Form::label('language', __('Language'), ['class'=>'col-sm-3']) }}
                  <div class="col-sm-8"> 
                  {{ Form::select('language', array('en' => 'English', 'id' => 'Indonesia', 'es' => 'Spanish'), null, array('class' => 'form-control', 'required')) }}
                  </div>
               </div>
               @if(!empty($currencies))
               <div class="form-group row">
                  {{ Form::label('currency_code', __('Currency'), ['class'=>'col-sm-3']) }}
                  <div class="col-sm-8"> 
                  
                  <select name="currency_code" class="form-control" required>
                    @foreach($currencies as $currency)
                  <option value="{{$currency->code}}" {{(!empty($currency_code) && ($currency_code == $currency->code)) ? 'selected' : ''}}>{{$currency->code. '('.$currency->symbol.')'}}</option>
                    @endforeach
                  </select>
                  </div>
              </div>
             @endif
                
                <div class="form-group row">
                  {{ Form::label('company_name', __('Company Name'), ['class'=>'col-sm-3']) }}
                  <div class="col-sm-8"> 
                  {{ Form::text('company_name', null, array('class' => 'form-control', 'required')) }}
                  </div>
                </div>
                <div class="form-group row">
                    {{ Form::label('starting_balance', __('Starting Balance'), ['class'=>'col-sm-3']) }}
                    <div class="col-sm-8"> 
                    {{ Form::number('starting_balance', null, array('class' => 'form-control', 'required')) }}
                    </div>
                </div>
  				</div>
              
              <div class="col-md-6">
                  <div class="form-group row">
                    {{ Form::label('company_address', __('Company Address'), ['class'=>'col-sm-3']) }}
                        <div class="col-sm-8"> 
                    {{ Form::textarea('company_address', null, array('class' => 'form-control', 'rows'=>3, 'required')) }}
                  </div>
                  </div>
                  <div class="form-group row">
                      {{ Form::label('logo_path', __('Company Logo'), ['class'=>'col-sm-3']) }}
                      <div class="col-sm-4"> 
                      {{ Form::file('logo_path', null, array('class' => 'form-control')) }}
                      </div>
                      @if(!empty($flexiblepossetting->logo_path))
                      <div class="col-sm-5">
                        <img src="{{asset($flexiblepossetting->logo_path)}}" alt="" height="40px">
                      </div>
                      @endif
                  </div>
                  <div class="form-group row">
                      {{ Form::label('fevicon_path', __('Fevicon/small logo'), ['class'=>'col-sm-3']) }}
                      <div class="col-sm-4"> 
                      {{ Form::file('fevicon_path', null, array('class' => 'form-control')) }}
                      </div>
                      @if(!empty($flexiblepossetting->fevicon_path))
                      <div class="col-sm-5">
                        <img src="{{asset($flexiblepossetting->fevicon_path)}}" alt="" height="30px">
                      </div>
                      @endif
                  </div>
                  <div class="row">
                      <div class="col-sm-12 text-right">
                          {{ Form::submit(__('Submit'), array('class' => 'btn btn-success btn-sp')) }}
                      </div>
                  </div>
              </div>
              {{ Form::close() }}
      			</div>
      		</div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
@endsection