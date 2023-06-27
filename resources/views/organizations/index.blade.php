@extends('adminlte::page')

@section('title', 'Organizations Listing')

@section('content_header')
<div class="pull-left" style="float:left;">
    <h1>Organizations Listing</h1>
</div>
<div class="pull-right mb-2" style="float: right;">
    <a class="btn btn-success" href="{{ route('organizations.create') }}"> Add Organization</a>
</div>
@stop

@section('content')
    <!-- <div class="container mt-2"> -->
        <br><br>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <table id='org_table' width='100%' class="table table-bordered" border="1" style='border-collapse: collapse;'>
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Organization Name</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    <!-- </div> -->
@stop

@section('css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
    <style type="text/css">
        #org_table_length{float: left;margin: 10px 0px;}
        #org_table_filter{float: right;margin: 10px 0px;}
    </style>
@stop

@section('js')
    <!-- jQuery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Datatables JS CDN -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
         $(document).ready(function(){

          // DataTable
          $('#org_table').DataTable({
             processing: true,
             serverSide: true,
             ajax: "{{route('organizations.getall')}}",
             columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'action' },
             ]
          });
        });
    </script>    
@stop

<?php /*
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Organizations Listing</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <!-- jQuery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Datatables JS CDN -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
</head>
<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Organizations Listing</h2>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('organizations.create') }}"> Add Organization</a>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <table id='org_table' width='100%' class="table table-bordered" border="1" style='border-collapse: collapse;'>
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Organization Name</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <script type="text/javascript">
         $(document).ready(function(){

          // DataTable
          $('#org_table').DataTable({
             processing: true,
             serverSide: true,
             ajax: "{{route('organizations.getall')}}",
             columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'action' },
             ]
          });
        });
    </script>
</body>
</html>*/?>