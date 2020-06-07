@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>{{$ticket->title}}</h1>
<h2>Öncelik: <i>{{$ticket->ticketPriority->title}}</i> - Durum: <i class="ticket-status">{{$ticket->ticketStatus->title}}</i> - Agent: <i class="agent">{{$ticket->agent->name ?? 'Unassigned!'}}</i></h2>
<button type="button" class="btn btn-link btn-assign-submit" id="{{$ticket->id}}">Ticketi Üzerine
    Al!</button>
@if($ticket->ticket_status_id != Ticket::STATUS_COMPLETED)
<button type="button" class="btn btn-link btn-complete-submit" id="status-{{$ticket->id}}">Tamamlandı
    olarak işaretle</button>
@endif
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
        <h3>Yorumlar</h3>
        @forelse($ticket->comments as $comment)
        <!-- /.card-body -->
        <div class="card-footer card-comments">
            <div class="card-comment">
                <div class="comment-text">
                    <span class="username">
                        {{$comment->author->name}}
                        <span class="text-muted float-right">{{$comment->created_at}}</span>
                    </span><!-- /.username -->
                    {{$comment->body}}
                </div>
                <!-- /.comment-text -->
            </div>
        </div>
        @empty
        <p>Herhangi bir yorum bulunmamaktadır.</p>
        @endforelse
        <!-- /.card-footer -->
        <div class="card-footer">
            <form action="{{route('comments.store')}}" method="post">
                @csrf
                <input type="hidden" name="ticket_id" value="{{$ticket->id}}">
                <div class="img-push">
                    <input type="text" name="body" class="form-control form-control-sm"
                        placeholder="Press enter to ticket comment">
                </div>
                <button type="submit">Gönder</button>
            </form>
        </div>
        <!-- /.card-footer -->
    </div>
</div>
@stop


@section('js')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".btn-complete-submit").click(function(e){
        e.preventDefault();
        var ticketID = $(this).attr('id').match(/\d+/)[0];
        $.ajax({
            type:'POST',
            url:'/complete-ticket',
            data:{id:ticketID},
            success:function(data){
                $('.ticket-status').html('Kapalı');
                $('#status-' + ticketID).remove();
                alert('Ticket başarıyla kapatıldı!');
            }
            });
    });
    
    $(".btn-assign-submit").click(function(e){
        e.preventDefault();
        var ticketID = $(this).attr('id');
        $.ajax({
            type:'POST',
            url:'/assign-ticket',
            data:{id:ticketID},
            success:function(data){
                var user = {!! json_encode(Auth::user()) !!};
                $('.agent').html(user.name);
                alert('Ticket başarıyla atandı!');
            }
            });
	});

</script>
@stop