@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>{{$ticket->title}}</h1>
<h2>{{$ticket->ticketPriority->name}}</h2>
@stop

@section('content')

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="col-12">
    <div class="card card-widget">
        <div class="card-header">
            <div class="user-block">
                <span class="username"><a href="#">{{$ticket->customer->name}}</a></span>
                <span class="description">{{$ticket->created_at}}</span>
            </div>
            <!-- /.user-block -->
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Mark as read">
                    <i class="far fa-circle"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            {{$ticket->body}}
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop