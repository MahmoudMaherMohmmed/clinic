@if(isset($messages) && $messages!=null && count($messages)>0)
    @foreach($messages as $message)
        @if($message->action == 0)
            <!-- Sender Message-->
            <div class="media w-50 mb-3"><img src="{{isset($message->client->image) && $message->client->image!=null ? url($message->client->image) : 'https://bootstrapious.com/i/snippets/sn-chat/avatar.svg'}}" alt="user" width="50" class="rounded-circle">
                <div class="media-body ml-3">
                    <div class="bg-light rounded py-2 px-3 mb-2">
                    <p class="text-small mb-0 text-muted">{{$message->message}}</p>
                    </div>
                    <p class="small text-muted">{{$message->created_at->format('H:i A')}} | {{$message->created_at->format('M d')}}</p>
                </div>
            </div>
        @else
            <!-- Reciever Message-->
            <div class="media w-50 ml-auto mb-3">
                <div class="media-body">
                    <div class="bg-primary rounded py-2 px-3 mb-2">
                    <p class="text-small mb-0 text-white">{{$message->message}}</p>
                    </div>
                    <p class="small text-muted">{{$message->created_at->format('H:i A')}} | {{$message->created_at->format('M d')}}</p>
                </div>
            </div>
        @endif
    @endforeach
@endif