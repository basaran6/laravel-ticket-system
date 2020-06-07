@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Tickets</h1>
<a href="{{route('tickets.create')}}">Create new ticket</a>
@stop

@section('content')
<div class="col-12">
    <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link" id="custom-content-above-profile-tab" href="{{route('tickets.index')}}"
                role="tab">All</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="custom-content-above-messages-tab"
                href="{{route('tickets.index', ['type'=>'active'])}}" role="tab">Active</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="custom-content-above-settings-tab"
                href="{{route('tickets.index', ['type'=>'completed'])}}" role="tab">Completed</a>
        </li>
    </ul>
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
                        <th>Oluşturulma Tarihi</th>
                        <th>Tamamlanma Tarihi</th>
                        <th>Geçen Gün</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $ticket)
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
                        <td><a href="{{route('tickets.show', $ticket->id)}}">Görüntüle</a>
                            @if($ticket->ticket_status_id != Ticket::STATUS_COMPLETED)
                            <button type="button" class="btn btn-link btn-submit" id="{{$ticket->id}}">Tamamlandı
                                olarak işaretle</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $tickets->appends(request()->query())->links() }}
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
@stop


@section('js')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(".btn-submit").click(function(e){
        e.preventDefault();
        var ticketID = $(this).attr('id');
        $.ajax({
            type:'POST',
            url:'/complete-ticket',
            data:{id:ticketID},
            success:function(data){
                $('#ticket-status-' + ticketID).html('Kapalı');
                $('#' + ticketID).remove();
                alert('Ticket başarıyla kapatıldı!');
            }
            });
	});

</script>
@stop