@extends('template')
@section('page_title')
    @lang('messages.massara.massara_about')
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="row">

                <div class="col-md-12">
                    <div class="box box-black">
                        <div class="box-title">
                            <h3><i class="fa fa-table"></i> @lang('messages.massara.massara_about')</h3>
                        </div>
                        <div class="box-content">
                            <div class="btn-toolbar pull-right">
                                <div class="btn-group">
                                    @if (get_action_icons('massara/create', 'get') && count($massaras) < 1)
                                        <a class="btn btn-circle show-tooltip" title=""
                                            href="{{ url('massara/create') }}" data-original-title="Add new record"><i
                                                class="fa fa-plus"></i></a>
                                    @endif
                                    <?php $table_name = 'massaras';
                                    // pass table name to delete all function
                                    // if the current route exists in delete all table flags it will appear in view
                                    // else it'll not appear
                                    ?>
                                </div>
                            </div>
                            <br><br>
                            <div class="table-responsive">
                                <table id="example" class="table table-striped dt-responsive" cellspacing="0" width="100%">

                                    <thead>
                                        <tr>
                                            <th style="width:18px"><input type="checkbox" id="check_all" data-table="{{ $table_name }}"></th>
                                            <th>id</th>
                                            <th>@lang('messages.description')</th>
                                            <th>@lang('messages.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($massaras as $value)
                                            <tr>
                                                <td><input type="checkbox" name="selected_rows[]" value="{{ $value->id }}" class="roles select_all_template">
                                                </td>
                                                <td>{{ $value->id }}</td>
                                                <td>
                                                    @foreach ($languages as $language)
                                                        <li> <b>{{ $language->title }} :</b>
                                                            {{ $value->getTranslation('description', $language->short_code) }}</li>
                                                    @endforeach
                                                </td>

                                                <td class="visible-md visible-xs visible-sm visible-lg">
                                                    <div class="btn-group">
                                                        @if (get_action_icons('massara/{id}/edit', 'get'))

                                                            <a class="btn btn-sm show-tooltip"
                                                                href='{{ url("massara/$value->id/edit") }}'
                                                                title="Edit"><i class="fa fa-edit"></i></a>
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
        </div>

    </div>

@stop

@section('script')
    <script>
        $('#center').addClass('active');
        $('#massara_index').addClass('active');
    </script>
@stop
