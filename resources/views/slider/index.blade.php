@extends('template')
@section('page_title')
    @lang('messages.sliders.sliders')
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="row">

                <div class="col-md-12">
                    <div class="box box-black">
                        <div class="box-title">
                            <h3><i class="fa fa-table"></i> @lang('messages.sliders.sliders')</h3>
                        </div>
                        <div class="box-content">
                            <div class="btn-toolbar pull-right">
                                <div class="btn-group">
                                    @if (get_action_icons('slider/create', 'get'))
                                        <a class="btn btn-circle show-tooltip" title=""
                                            href="{{ url('slider/create') }}" data-original-title="Add new record"><i
                                                class="fa fa-plus"></i></a>
                                    @endif
                                    <?php $table_name = 'sliders';
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
                                            <th>@lang('messages.Title')</th>
                                            <th>@lang('messages.Image.Image')</th>
                                            <th>@lang('messages.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sliders as $value)
                                            <tr>
                                                <td><input type="checkbox" name="selected_rows[]" value="{{ $value->id }}" class="roles select_all_template">
                                                </td>
                                                <td>{{ $value->id }}</td>
                                                <td>
                                                    @foreach ($languages as $language)
                                                        <li> <b>{{ $language->title }} :</b>
                                                            {{ $value->getTranslation('title', $language->short_code) }}</li>
                                                    @endforeach
                                                </td>

                                                <td>
                                                    @if ($value->image)
                                                        <img class=" img-circle" width="100px" height="100px"
                                                            src="{{ $value->image }}" />
                                                    @else
                                                        <img class=" img-circle" width="100px" height="100px"
                                                            src="https://ui-avatars.com/api/?name={{ $value->title }}" />
                                                    @endif
                                                </td>
                                                <td class="visible-md visible-xs visible-sm visible-lg">
                                                    <div class="btn-group">
                                                        @if (get_action_icons('slider/{id}/edit', 'get'))

                                                            <a class="btn btn-sm show-tooltip"
                                                                href='{{ url("slider/$value->id/edit") }}'
                                                                title="Edit"><i class="fa fa-edit"></i></a>
                                                        @endif
                                                        @if (get_action_icons('slider/{id}/delete', 'get'))
                                                            <form action="{{ route('slider.destroy', $value->id) }}"
                                                                method="POST" style="display: initial;">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="submit" class="btn btn-sm btn-danger"
                                                                    style="height: 28px;"><i
                                                                        class="fa fa-trash"></i></button>
                                                            </form>
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
        $('#slider').addClass('active');
        $('#slider_index').addClass('active');
    </script>
@stop
