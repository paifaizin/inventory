@extends('layouts.default')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Create New Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('product.index') }}"> Back</a>
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
    
    {!! Form::open(array('route' => 'product.store','method'=>'POST')) !!}
    <div class="row margin10">
        <div class="col-md-8 clearfix">
            <h3>Informasi Dasar</h3>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Kode:</strong>
                    {!! Form::text('code', null, array('placeholder' => 'Kode','class' => 'form-control')) !!}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama:</strong>
                    {!! Form::text('name', null, array('placeholder' => 'Nama','class' => 'form-control')) !!}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Type:</strong>
                    {!! Form::select('type', array("1" => "Barang", "2" => "Jasa"), null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Kategori:</strong>
                    {!! Form::select('productCategoryId', $categori, null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Satuan:</strong>
                    {!! Form::select('productUnitId', $unit, null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>

        <div class="col-md-6 clearfix">
            <h3>Harga Pokok Penjualan</h3>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Metode:</strong>
                    
                    {!! Form::select('costOfGoodSalesMethod', $salesmetode, null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="form-group">
                    <strong>HPP:</strong>
                    <!-- {!! Form::select('status', array('1' => 'Aktif', '0' => 'Nonaktif'), '1',array('class' => 'form-control')) !!} -->
                    {!! Form::text('costOfGoodSales', null, array('placeholder' => 'Nama','class' => 'form-control')) !!}
                </div>
            </div>
        </div>

        <div class="col-md-6 clearfix">
            <h3>Informasi Penjualan</h3>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Metode:</strong>
                    {!! Form::select('sellingMethod', array('0' => 'Otomatis', '1' => "Manual"), '1',array('class' => 'form-control')) !!}
                </div>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="form-group">
                    <strong>Harga Jual:</strong>
                    {!! Form::text('sellingManualPrice', null, array('placeholder' => 'Nama','class' => 'form-control')) !!}
                    <!-- {!! Form::select('status', array('1' => 'Aktif', '0' => 'Nonaktif'), '1',array('class' => 'form-control')) !!} -->
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Lokasi</th>
                        <th class="text-right">Qty</th>
                        <th class="text-right">Stock Min</th>
                        <th class="text-right">Stock Max</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-right">Jumlah</th>
                        <th class="text-right">0</th>
                    </tr>
                </tfoot>
            </table>

        </div>

        <div class="clearfix"></div>
        <div class="clearfix col-md-4 text-left">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </div>
    {!! Form::close() !!}

@endsection