@extends('template')
@section('page_title')
@lang('messages.Routes.Routes')
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-black">
                <div class="box-title">
                    <h3><i class="fa fa-table"></i>@lang('messages.Routes.Routes')</h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <div class="btn-toolbar pull-right">
                        <div class="btn-group">
                            <a style="position: relative;left: -10px;" class="btn btn-default btn-sm"
                                title="Download Routes" href="{{ url('buildroutes') }}" data-original-title=""><i
                                    class="glyphicon glyphicon-download-alt"></i> </a>
                            <?php $table_name = 'routes'; ?>
                            @include('partial.delete_all')
                        </div>
                    </div>
                    <br><br>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped dt-responsive" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th style="width:18px"><input type="checkbox" id="check_all" data-table="{{ $table_name }}"></th>
                                    <th>@lang('messages.Routes.method')</th>
                                    <th>@lang('messages.Routes.route')</th>
                                    <th>@lang('messages.Routes.controller')</th>
                                    <th>@lang('messages.Routes.method')</th>
                                    <th>@lang('messages.Routes.Roles Assigned')</th>
                                    <th class="visible-md visible-lg" style="width:130px">@lang('messages.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($routes as $route)
                                    <tr class="table-flag-blue">
                                        <th><input class="select_all_template" type="checkbox" name="selected_rows[]" value="{{ $route->id }}"></th>
                                        <td>{{ $route->method }}</td>
                                        <td>{{ $route->route }}</td>
                                        <td>{{ $route->controller_name }}</td>
                                        <td>{{ $route->function_name }}</td>
                                        <td>
                                            @foreach ($route->roles_routes as $item)
                                                - {{ $item->role->name }}<br>
                                            @endforeach
                                        </td>
                                        <td class="visible-md visible-xs visible-sm visible-lg">
                                            <div class="btn-group">
                                                @if (get_action_icons('all_routes/{id}/edit', 'get'))

                                                    <a class="btn btn-sm show-tooltip" title=""
                                                        href="{{ url('all_routes/' . $route->id . '/edit') }}"
                                                        data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                                @endif
                                                @if (get_action_icons('all_routes/{id}/delete', 'get'))

                                                    <a class="btn btn-sm btn-danger show-tooltip" title=""
                                                        onclick="return confirm('Are you sure you want to delete this ?');"
                                                        href="{{ url('all_routes/' . $route->id . '/delete') }}"
                                                        data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
                                                @endif

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
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
        $('#role').addClass('active');
        $('#route-index').addClass('active');

    </script>
@stop
