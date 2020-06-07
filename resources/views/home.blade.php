@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
@foreach($tables as $tableName => $tableValues)
<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{$tableName}}</h3>

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
                    <th>Oluşturulma Tarihi</th>
                    <th>Tamamlanma Tarihi</th>
                    <th>Geçen Gün</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tableValues as $ticket)
                <tr>
                    <td>{{$ticket->id}}</td>
                    <td><a href="{{route('tickets.show', $ticket->id)}}">{{$ticket->title}}</a></td>
                    <td>{{$ticket->customer->name}}</td>
                    <td>{{$ticket->ticketType->title}}</td>
                    <td>{{$ticket->ticketPriority->title}}</td>
                    <td id="ticket-status-{{$ticket->id}}">{{$ticket->ticketStatus->title}}</td>
                    <td>{{$ticket->agent->name ?? 'Unassigned!'}}</td>
                    <td>{{$ticket->created_at}}</td>
                    <td>{{$ticket->completed_at ?? '-'}}</td>
                    <td>{{$ticket->days_active}}</td>
                    <td><a href="{{route('tickets.show', $ticket->id)}}">Görüntüle</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
@endforeach
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop