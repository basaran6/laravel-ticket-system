@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Create new ticket</h1>
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
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Ticket Details</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" action="{{route('tickets.store')}}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputTitle">Title</label>
                    <input type="text" class="form-control" name="title" id="exampleInputEmail1"
                        placeholder="Başlıkgiriniz">
                </div>
                <div class="form-group">
                    <label>Body</label>
                    <textarea class="form-control" rows="3" name="body" placeholder="Enter ..."></textarea>
                </div>
                <div class="form-group">
                    <label>Ticket Type</label>
                    <select class="form-control" name="ticket_type_id">
                        @foreach ($ticketTypes as $ticketType)
                        <option value="{{$ticketType->id}}">{{$ticketType->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Ticket Priority</label>
                    <select class="form-control" name="ticket_priority_id">
                        @foreach ($ticketPriorities as $ticketPriority)
                        <option value="{{$ticketPriority->id}}">{{$ticketPriority->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    <!-- /.card -->
</div>
@stop
