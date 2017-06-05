@extends('layouts.default')
@section('scripts')
   {!! Html::script('js/myscript.js') !!}
@endsection
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Create New stock</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('stock.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    {!! Form::open(array('route' => 'stock.store','method'=>'POST')) !!}
    <div class="row margin10">
            
        <div class="col-xs-12 col-sm-6 col-md-4">
            <div class="form-group">
                <strong>Date:</strong>
                {!! Form::text('date', date("Y-m-d"), array('placeholder' => 'Today','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-6 col-md-4">
            <div class="form-group">
                <strong>Source:</strong>
                {!! Form::text('name', null, array('placeholder' => 'Source','class' => 'form-control')) !!}
            </div>
        </div>

        
        <div class="col-md-12 row clearfix">
            <h3  class="col-md-12">Detail</h3>
            <div id="child-det-head">    
                <div class="col-md-3">
                    <div class="form-group">
                        <strong>Product:</strong>
                  
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <strong>Qty:</strong>
                  
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <strong>Price Buy:</strong>
                  
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <strong>Location:</strong>
                        
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                    
                    </div>
                </div>
            </div>
            <div id="child-det">    
                <div class="col-md-3">
                    <div class="form-group">
                        
                        {!! Form::text('product_name', null, array('placeholder' => 'Nama','class' => 'form-control', 'id' => 'searchproduk')) !!}
                        {!! Form::hidden('product_id', null, array('class' => 'form-control', 'id' => 'idproduk')) !!}
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        
                        {!! Form::text('costOfGoodSales', null, array('placeholder' => 'Nama','class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        
                        {!! Form::text('costOfGoodSales', null, array('placeholder' => 'Nama','class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        
                        {!! Form::select('locationId', $location, null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                    
                    <a href="" class="btn btn-default"><i class="fa fa-remove"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix col-md-4 text-left">
                <a href="#" class="btn btn-success" id="add-det-stock"><i class="fa fa-plus"></i> Add Detail</a>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
        </div>

    </div>
    {!! Form::close() !!}

@endsection

