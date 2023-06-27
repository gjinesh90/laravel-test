@extends('adminlte::page')

@section('title', 'Add Organization')

@section('content_header')
<div class="pull-left" style="float:left;">
    <h1>Add Organization</h1>
</div>
<div class="pull-right mb-2" style="float: right;">
    <a class="btn btn-primary" href="{{ route('organizations.index') }}"> Back</a>
</div>
@stop

@section('content')
    <!-- <div class="container mt-2"> -->
        <br><br>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <form action="{{ route('organizations.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <label><strong>Organization Name:</strong></label>
                        <input type="text" name="name" class="form-control" placeholder="Organization Name" value={{old('name')}}>
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </div>
        </form>
    <!-- </div> -->
@stop

@section('css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
@stop

@section('js')
    <!-- jQuery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@stop