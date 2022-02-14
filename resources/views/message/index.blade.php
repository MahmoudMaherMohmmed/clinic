@extends('template')
@section('page_title')
    @lang('messages.messages.messages')
@stop

<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" /> -->

<style>
    body {
    background-color: #74EBD5;
    background-image: linear-gradient(90deg, #74EBD5 0%, #9FACE6 100%);

    min-height: 100vh;
    }

    ::-webkit-scrollbar {
    width: 5px;
    }

    ::-webkit-scrollbar-track {
    width: 5px;
    background: #f5f5f5;
    }

    ::-webkit-scrollbar-thumb {
    width: 1em;
    background-color: #ddd;
    outline: 1px solid slategrey;
    border-radius: 1rem;
    }

    .text-small {
    font-size: 0.9rem;
    }

    .messages-box,
    .chat-box {
    height: 500px;
    overflow-y: scroll;
    }

    .rounded-lg {
    border-radius: 0.5rem;
    }

    
    element.style {
    }
    .messages-box, .chat-box {
        height: 500px;
        overflow-y: scroll;
    }
    .pb-5, .py-5 {
        padding-bottom: 3rem!important;
    }
    .pt-5, .py-5 {
        padding-top: 3rem!important;
    }
    .pl-4, .px-4 {
        padding-left: 1.5rem!important;
    }
    .pr-4, .px-4 {
        padding-right: 1.5rem!important;
    }
    .bg-white {
        background-color: #fff!important;
    }
    .pb-1, .py-1 {
    padding-bottom: 0.25rem!important;
    }
    .pt-1, .py-1 {
        padding-top: 0.25rem!important;
    }
    .mb-0, .my-0 {
        margin-bottom: 0!important;
    }
    .pr-4, .px-4 {
        padding-right: 1.5rem!important;
    }
    .pb-2, .py-2 {
        padding-bottom: 0.5rem!important;
    }
    .pt-2, .py-2 {
        padding-top: 0.5rem!important;
    }
    .bg-light {
        background-color: #f8f9fa!important;
    }
    .text-small {
        font-size: 0.9rem;
    }
    .font-italic {
        font-style: italic!important;
    }
    .mb-0, .my-0 {
        margin-bottom: 0!important;
    }
    .font-weight-bold {
        font-weight: 700!important;
    }
    .mb-1, .my-1 {
    margin-bottom: 0.25rem!important;
    }
    .align-items-center {
        -ms-flex-align: center!important;
        align-items: center!important;
    }
    .justify-content-between {
        -ms-flex-pack: justify!important;
        justify-content: space-between!important;
    }
    .d-flex {
        display: -ms-flexbox!important;
        display: flex!important;
    }
    .media {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: start;
        align-items: flex-start;
    }
    .ml-4, .mx-4 {
        margin-left: 1.5rem!important;
        margin-right: 1.5rem!important;
    }
    .pl-0, .px-0 {
        padding-left: 0!important;
    }

    .pr-0, .px-0 {
        padding-right: 0!important;
    }

    .ml-3, .mx-3 {
        margin-left: 1rem!important;
    }
    input::placeholder {
    font-size: 0.9rem;
    color: #999;
    }

    .pt-2, .py-2 {
        padding-top: 0.5rem!important;
    }
    .pb-2, .py-2 {
        padding-bottom: 0.5rem!important;
    }
    .pl-3, .px-3 {
        padding-left: 1rem!important;
    }
    .pr-3, .px-3 {
        padding-right: 1rem!important;
    }
    .pb-2, .py-2 {
        padding-bottom: 0.5rem!important;
    }
    .pt-2, .py-2 {
        padding-top: 0.5rem!important;
    }
    .mb-2, .my-2 {
        margin-bottom: 0.5rem!important;
    }
    .rounded {
        border-radius: 0.25rem!important;
    }

    .media-body, .media-left, .media-right {
        display: table-cell; 
        /vertical-align: top;
    }
    .media-body {
        width: 10000px; 
    }
    .media, .media-body {
        overflow: hidden; 
        zoom: 1; 
    }
    .media-body, .media-left, .media-right {
        display: table-cell; 
        vertical-align: top; 
    }
    .media-body {
        width: 10000px; 
    }
    .media, .media-body {
        overflow: hidden; 
        zoom: 1; 
    }
    .ml-3, .mx-3 {
        margin-left: 1rem!important;
    }
    .media-body {
        -ms-flex: 1;
        flex: 1;
    }

    .ml-auto, .mx-auto {
        margin-left: auto!important;
    }

    .w-50 {
        width: 50%!important;
    }

    .input-group-append {
        margin-left: -1px;
    }

    .input-group-append, .input-group-prepend {
        display: -ms-flexbox;
        display: flex;
    }

    .input-group .form-control, .input-group-addon, .input-group-btn {
        display: table-cell;
    }

    .input-group .form-control {
        position: relative;
        z-index: 2;
        float: left;
        width: 100%;
        margin-bottom: 0;
    }

    .pb-4, .py-4 {
        padding-bottom: 1.5rem!important;
    }
    .pt-4, .py-4 {
        padding-top: 1.5rem!important;
    }
    .rounded-0 {
        border-radius: 0!important;
    }
    .border-0 {
        border: 0!important;
    }
    .rounded-circle{
        width: 50px;
        height: 50px;
        border-radius: 50%;
    }

</style>
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-black">
                    
                        <div class="container px-4">
                            <div class="row rounded-lg overflow-hidden shadow">
                                <!-- Users box-->
                                <div class="col-md-5 px-0">
                                <div class="bg-white">

                                    <div class="bg-gray px-4 py-2 bg-light">
                                    <p class="h5 mb-0 py-1">@lang('messages.messages.recent')</p>
                                    </div>

                                    <div class="messages-box">
                                        <div class="list-group rounded-0" id="clients_list">
                                            @if(isset($clients) && $clients!=null && count($clients)>0)
                                            @foreach($clients as $client)
                                                <a onClick="clientMessages({{$client['client_id']}})" id="client_{{$client['client_id']}}" class="list-group-item list-group-item-action rounded-0">
                                                    <div class="media"><img src="{{isset($client['client_image'])&&$client['client_image']!=null ? url($client['client_image']) : 'https://bootstrapious.com/i/snippets/sn-chat/avatar.svg'}}" alt="user" width="50" class="rounded-circle">
                                                        <div class="media-body ml-4">
                                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                                            <h6 class="mb-0">{{$client['client_name']}}</h6><small class="small font-weight-bold">{{$client['date']}}</small>
                                                        </div>
                                                        <p class="font-italic mb-0 text-small">{{$client['message']}}</p>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <!-- Chat Box-->
                                <div class="col-md-7 px-0" style="direction: ltr;">
                                <div class="px-4 py-5 chat-box bg-white" id="client_messages">
                                
                                </div>

                                <!-- Typing area -->
                                <form action="#" class="bg-light" id="message_form" style="padding-bottom: 6px;">
                                    <div class="input-group" style="width: 100%;">
                                        <div class="input-group-append">
                                            <input type="text" name="message" id="message_text" placeholder="Type a message" aria-describedby="button-addon2" class="form-control rounded-0 border-0 py-4 bg-light">
                                            <button id="button-addon2" type="submit" class="btn btn-link"> <i class="fa fa-paper-plane"></i></button>
                                        </div>
                                    </div>
                                </form>
                                
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script>
        $('#messages').addClass('active');
        $('#messages_index').addClass('active');
    </script>

    <script>
        current_client_id = null;

        $(document).ready(function() {
            @if(isset($clients) && count($clients)>0)
                client_id = "{{$clients[0]['client_id']}}";

                clientMessages(client_id);
            @endif
        });

        $('#message_form').on('submit',function(e){
            e.preventDefault();

            $.ajax({
                url: "{{url('/message')}}",
                type:"POST",
                data:{
                    "_token": "{{ csrf_token() }}",
                    message: $('#message_text').val(),
                    client_id: current_client_id,
                },
                success:function(response){
                    clientMessages(current_client_id);
                    $('#message_text').val("");
                },
                error: function(response) {
                    console.log(response);
                },
            });
        });

        function clientMessages(client_id){
            $.ajax({
                type: "GET",
                url: "{{url('admin/get_client_messages')}}/" + client_id,
                success: function (data) {
                    updateChatStyle(client_id);
                    $("#client_messages").html(data);
                    current_client_id = client_id;
                },
                error: function() { 
                    console.log(data);
                }
            });
        }

        function updateChatStyle(client_id){
            $('#clients_list').children().removeClass('active text-white list-group-item-light');
            $('#clients_list').children(':not(#client_'+client_id+')').addClass('list-group-item-light')
            $('#client_'+client_id).addClass('active text-white');
        }
    </script>
@stop
