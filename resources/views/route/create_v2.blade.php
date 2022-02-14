@extends('template')

@section('page_title')
    Create Route V:2.0
@stop

@section('content')
    @include('errors')

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-title">
                    <h3><i class="fa fa-bars"></i>@lang('messages.create-role')</h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">
                {!! Form::open(["url"=>"routes/index_v2","class"=>"form-horizontal","method"=>"GET","id"=>"form_body"]) !!}
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label">@lang('messages.Routes.controller')</label>
                        <div class="col-sm-9 col-md-10 controls">
                            <select class="form-control chosen-rtl" onchange="get_controller_methods(this)" name="controller_name" required>
                                <option value>@lang('messages.Routes.controller')</option>
                                @foreach($controllers as $controller_name=>$item)
                                    <option value="{{$controller_name}}">{{$controller_name}}</option>
                                @endforeach
                            </select>
                        <br/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label" id="methods_word"></label>
                        <div class="col-sm-9 col-md-10 controls">
                            <ul id="methods">

                            </ul>
                        </div>
                    </div>
                {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>

@stop

@section('script')
    <script>
        function get_controller_methods(element)
        {
            // var controller_name = element.name ;
            // var frame_code = ' <div class="box-content"> '+
            //         '<div class="embed-responsive embed-responsive-16by9"> '+
            //             '<iframe class="embed-responsive-item" src="{{url("routes/index_v2?controller_name=")}} "></iframe>'+
            //         '</div>'+
            //     '</div>' ;
            // $('#routes_v2_table').append("<li><strong>"+item+"</strong></li>") ;


            $('#form_body').submit();


            // $.get('get_controller_methods?controller='+element.value,function(result){
            //     $('#methods_word').html("<strong>Methods</strong>");
            //      result.methods.forEach(function(item){
            //          if(item.length>1)
            //             $('#methods').append("<li><strong>"+item+"</strong></li>") ;
            //      });
            // });

        }


    </script>
    <script>
        $('#role').addClass('active');
        $('#route-v2-index').addClass('active');
    </script>
@stop
