@extends('layouts.default')
 
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Satuan</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('unit.index') }}"><i class="fa fa-history"></i> Back</a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Title:</strong>
                {{ $unit->title }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Status:</strong>
                {{ $unit->status == "1" ? "Aktif" : "Nonaktif" }}
            </div>
        </div>

    </div>

@endsection