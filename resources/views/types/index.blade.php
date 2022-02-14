@extends('template')
@section('page_title')
@lang('messages.Setting.Settings Types')
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-black">
                <div class="box-title">
                    <h3><i class="fa fa-table"></i> @lang('messages.Setting.Settings Types')</h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <div class="btn-toolbar pull-right">
                        <div class="btn-group">
                            @if (get_action_icons('types/create', 'get'))
                                <a class="btn btn-circle show-tooltip" title="" href="{{ url('types/create') }}"
                                    data-original-title="Add new record"><i class="fa fa-plus"></i></a>
                            @endif
                            <?php $table_name = 'types'; ?>
                            @include('partial.delete_all')
                        </div>
                    </div>
                    <br><br>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped dt-responsive" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th style="width:18px"><input type="checkbox" id="check_all" data-table="{{ $table_name }}"></th>
                                    <th>@lang('messages.Setting.Settings Types')</th>

                                    <th class="visible-md visible-lg" style="width:130px">@lang('messages.action')
                                    </th>


                                </tr>
                            </thead>
                            <tbody>
                                @if ($types != null)
                                    @foreach ($types as $type)
                                        <tr class="table-flag-blue">
                                            <th><input class="select_all_template" type="checkbox" name="selected_rows[]" value="{{ $type->id }}"></th>
                                            <td>{{ $type->title }}</td>

                                            <td class="visible-md visible-xs visible-sm visible-lg">
                                                <div class="btn-group">
                                                    @if (get_action_icons('types/{id}/edit', 'get'))
                                                        <a class="btn btn-sm show-tooltip" title=""
                                                            href="{{ url('types/' . $type->id . '/edit') }}"
                                                            data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                                    @endif
                                                    @if (get_action_icons('types/{id}/delete', 'get'))
                                                        <a class="btn btn-sm btn-danger show-tooltip" title=""
                                                            onclick="return confirm('Are you sure you want to delete this ?');"
                                                            href="{{ url('types/' . $type->id . '/delete') }}"
                                                            data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
                                                    @endif

                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                            </tbody>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop


@section('script')
    <script>
        $('#type').addClass('active');
        $('#type-index').addClass('active');

    </script>
@stop
