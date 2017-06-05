@extends('layouts.default')
 
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Location</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('location.create') }}"><i class="fa fa-plus"></i> Create New</a>
                <a class="btn btn-success" href="{{ url('') }}"><i class="fa fa-home"></i> Home</a>
            </div>
        </div>

        

    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12 row">
            
                {!! Form::open(array('route' => 'location.index','method'=>'GET')) !!}
                <div class="col-md-4">
                    {!! Form::text('title', null, array('placeholder' => 'Search by Title','class' => 'form-control')) !!}
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Submit</button>
                </div>
                {!! Form::close() !!}
            
        </div>
    </div>
    <br>
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Title</th>
            <th>Address</th>
            <th>Status</th>
            <th width="280px">Action</th>
        </tr>
    @foreach ($location as $key => $item)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $item->title }}</td>
        <td>{{ $item->address }}</td>
        <td>{{ $item->status == "1" ? "Aktif" : "Nonaktif" }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('location.show',$item->id) }}"><i class="fa fa-external-link"></i></a>
            <a class="btn btn-primary" href="{{ route('location.edit',$item->id) }}"><i class="fa fa-edit"></i></a>
            {!! Form::open(['method' => 'DELETE','route' => ['location.destroy', $item->id],'style'=>'display:inline']) !!}
            <button class="btn btn-danger" type="submit" name="Delete" value="Delete"><i class="fa fa-trash" ></i></button>
            
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>

    {!! $location->render() !!}

@endsection