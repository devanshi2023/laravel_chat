@extends('layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="chat">
        <div class="direct-chat-messages">
            @if(count($messages) > 0)
            @foreach($messages as $message)
            <div class="direct-chat-msg {{$message->sender_id == auth()->id() ? 'left' : 'right'}}">
                <div class="direct-chat-infos clearfix">
                    <span class="direct-chat-timestamp float-{{ $message->sender_id == auth()->id() ? 'right' : 'left' }}">
                        {{ $message->created_at->setTimezone('Asia/Kolkata')->format('d M Y g:i a') }}
                    </span>
                </div>
                <div class="direct-chat-text-container">
                    @if($message->sender_id == auth()->id())
                    <div class="direct-chat-img-container float-right">
                        <img class="direct-chat-img" src="{{ asset('profile/'.auth()->user()->image) }}" alt="Sender Image">
                    </div>
                    <div class="direct-chat-text bg-primary float-right">
                        {{ $message->content }}
                    </div>
                    @else
                    <div class="direct-chat-img-container float-left">
                        <img class="direct-chat-img" src="{{ asset('profile/'.$user->image) }}" alt="Receiver Image">
                    </div>
                    <div class="direct-chat-text bg-secondary float-left">
                        {{ $message->content }}
                    </div>
                    @endif
                </div>
                @if ($loop->last)
        <input type="hidden" id="message_id" name="message_id" value="{{$message->id}}">
    @endif
            </div>
            @endforeach
            @else
            <div class="direct-chat-msg">
                <div class="direct-chat-infos clearfix">
                    <span class="direct-chat-name float-left">System</span>
                </div>
                <div class="direct-chat-text">
                    Start texting!
                </div>
            </div>
            @endif
        </div>
        <div class="direct-chat-footer">
            <form id="chat-form">
                @csrf
                <div class="align">
                    <div class="col1">
                        @if(isset($user))
                        <input type="hidden" name="receiver_id" id="receiver_id" value="{{ $user->id }}">
                        @endif
                        <input type="text" name="message" id="message" placeholder="Type your message here..." class="form-control">
                    </div>
                    <div class="col2">
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#chat-form').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "/send-message",
                dataType: "json",
                processData: false,
                contentType: false,
                data: formData,
                success: function(resp) {
                    if (resp.status) {
                        $('#message').val('');
                        let html = `<div class="direct-chat-msg left">
                                    <div class="direct-chat-infos clearfix">
                                        <span class="direct-chat-timestamp float-right">
                                            ${formatTimestamp(resp.data.created_at)}
                                        </span>
                                    </div>
                                    @if(auth()->user())
                                    <div class="direct-chat-img-container float-right">
                                        <img class="direct-chat-img" src="{{ asset('profile/'.auth()->user()->image) }}" alt="Sender Image">
                                    </div>
                                    @endif
                                    <div class="direct-chat-text bg-primary float-right">
                                        ${formData.get('message')}
                                    </div>
                                </div>`;
                        $('.direct-chat-messages .direct-chat-msg:contains("Start texting!")').remove();
                        $('.direct-chat-messages').append(html);
                        scrollToBottom();
                    } else {
                        alert(resp.msg);
                    }
                }
            });
        });
        scrollToBottom();
        setInterval(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            // console.log("message", value);
            var value = $('#message_id').val();
            var userImage = "{{ asset('profile/'.$user->image) }}";
            var receiver_id = $('#receiver_id').val();
            var sender_id = <?php echo json_encode(auth()->user()->id); ?>;
            $.ajax({
                url: "{{ url('getConversations') }}",
                method: "post",
                data: {
                    id: value,
                    receiver_id: receiver_id,
                },
                success: function(resp) {
                    if (resp.status) {
                        if (value == resp.data.id) {
                            console.log("no reload");
                        } else {
                            if (sender_id == resp.data.receiver_id && receiver_id == resp.data.sender_id) {
                                window.location.reload();
                                scrollToBottom();
                            }
                        }
                    }
                }
            })
        }, 1000);


        function scrollToBottom() {
            var messagesContainer = $('.direct-chat-messages');
            messagesContainer.scrollTop(messagesContainer[0].scrollHeight);
        }

        function formatTimestamp(timestamp) {
            var date = new Date(timestamp);
            return date.toLocaleString('en-in', {
                day: '2-digit',
                month: 'short',
                year: 'numeric',
                hour: 'numeric',
                minute: 'numeric',
                hour12: true
            });
        }
    });
</script>
<!-- /.content-wrapper -->
@endsection