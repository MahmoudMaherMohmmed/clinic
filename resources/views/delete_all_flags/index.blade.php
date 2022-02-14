@extends('template')

@section('page_title')
@lang('messages.Delete All Flag.All Flag')
@stop

@section('content')
    @include('errors')

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-title">
                    <h3><i class="fa fa-table"></i>@lang('messages.Delete All Flag.All Flag')</h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover fill-head">
                            <thead>
                                <tr>
                                    <th>@lang('messages.Routes.controller')</th>
                                    <th>@lang('messages.Routes.route')</th>
                                    <th>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" onchange="check_all()"/>
                                            @lang('messages.Delete All Flag.All Flag')
                                        </label>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            {!! Form::open(["url"=>"delete_all","class"=>"form-horizontal"]) !!}
                                @foreach($routes as $route)
                                <tr>
                                    <td>
                                        {{$route->controller_name}}
                                    </td>
                                    <td>
                                        {{$route->function_name}}
                                    </td>
                                    <td>
                                        <input class="delete_all_class" type="checkbox" name="delete_alls[{{$route->id}}]"
                                            @foreach($delete_alls as $item)
                                                @if($route->controller_name == $item->route_ref->controller_name && $route->route == $item->route_ref->route)
                                                    checked
                                                @endif
                                            @endforeach />
                                    </td>
                                </tr>
                                @endforeach
                                <div class="btn-group">
                                    <input type="submit" class="btn btn-primary btn-success" value="Save Changes">
                                </div>
                                <br><br>
                            {!! Form::close() !!}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop
@section('script')
    <script>
        var checked = false ;
        function check_all()
        {
            checked = !checked ;
            $('.delete_all_class').prop('checked',checked);
        }
    </script>
    <script>
        $('#delete-all').addClass('active');
        $('#delete-all-index').addClass('active');
    </script>
@stop
