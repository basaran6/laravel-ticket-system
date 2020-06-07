@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Tickets</h1>
@stop

@section('content')
<a href="{{route('tickets.create')}}">Create new ticket</a>
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Latest Tickets</h3>

            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Customer</th>
                        <th>Ticket Type</th>
                        <th>Ticket Priority</th>
                        <th>Ticket Status</th>
                        <th>Agent</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $ticket)
                    <tr>
                        <td>{{$ticket->id}}</td>
                        <td>{{$ticket->title}}</td>
                        <td>{{$ticket->customer->name}}</td>
                        <td>{{$ticket->ticketType->title}}</td>
                        <td>{{$ticket->ticketPriority->title}}</td>
                        <td>{{$ticket->ticketStatus->title}}</td>
                        <td>{{$ticket->agent->name ?? 'Unassigned!'}}</td>
                        <td></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
@stop