@extends('template')
@section('page_title')
@lang('messages.Setting.Setting')
@stop
@section('content')
    @include('errors')
    <!-- BEGIN Content -->
    <div id="main-content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-black">
                    <div class="box-title">
                        <h3><i class="fa fa-table"></i> @lang('messages.Setting.Setting') Table</h3>
                        <div class="box-tool">
                            <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                            <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <div class="btn-toolbar pull-right">
                            <div class="btn-group">
                                @if (get_action_icons('setting/new', 'get'))

                                    <a class="btn btn-circle show-tooltip" title="" href="{{ url('setting/new') }}"
                                        data-original-title="Add new record"><i class="fa fa-plus"></i></a>
                                @endif
                                <?php $table_name = 'settings';
                                // pass table name to delete all function
                                // if the current route exists in delete all table flags it will appear in view
                                // else it'll not appear
                                ?>
                                @include('partial.delete_all')
                            </div>
                        </div>
                        <br><br>
                        <div class="table-responsive">
                            <table id="example" class="table table-striped dt-responsive" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width:18px"><input type="checkbox" id="check_all" data-table="{{ $table_name }}"></th>
                                        <th>@lang('messages.Key')</th>
                                        <th>@lang('messages.Value')</th>
                                        <th class="visible-md visible-lg" style="width:130px"> @lang('messages.action')</th>
                                    </tr>
                                </thead>
                                <tbody id="tablecontents">
                                    @foreach ($settings as $setting)
                                        <tr class="table-flag-blue">
                                            <td><input class="select_all_template" type="checkbox" name="selected_rows[]" value="{{ $setting->id }}"></td>
                                            <td>{{ $setting->key }}</td>
                                            <td>
                                                @if ($setting->type_id == 3)
                                                    <img src="{{ url($setting->value) }}" width="300" height="225">
                                                @elseif($setting->type_id == "4")
                                                    <video controls="" width="300" height="225">
                                                        <source src="{{ url($setting->value) }}" preload="none">
                                                    </video>
                                                @elseif($setting->type_id == "5")
                                                    <audio controls="">
                                                        <source src="{{ url($setting->value) }}" type="audio/mpeg"
                                                            preload="none">
                                                    </audio>
                                                @elseif($setting->type->title == 'selector')
                                                    @if ($setting->value)
                                                        True
                                                    @else
                                                        False
                                                    @endif
                                                @else
                                                    {!! $setting->value !!}
                                                @endif
                                            </td>
                                            <td class="visible-md visible-lg">
                                                <div class="btn-group">
                                                    @if (get_action_icons('setting/{id}/edit', 'get'))
                                                        <a class="btn btn-sm show-tooltip" title=""
                                                            href="{{ url('setting/' . $setting->id . '/edit') }}"
                                                            data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                                    @endif
                                                    @if (get_action_icons('setting/{id}/delete', 'get'))
                                                        <a class="btn btn-sm btn-danger show-tooltip" title=""
                                                            onclick='return ConfirmDelete()'
                                                            href="{{ url('setting/' . $setting->id . '/delete') }}"
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
    </div>

@stop
@section('script')
    <script type="text/javascript" src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        // $(function () {
        // $("#example").DataTable();
        //
        // $( "#tablecontents" ).sortable({
        //   items: "tr",
        //   cursor: 'move',
        //   opacity: 0.6,
        //   update: function() {
        //       sendOrderToServer();
        //   }
        // });
        //
        // function sendOrderToServer() {
        //   var order = [];
        //   $('tr.table-flag-blue').each(function(index,element) {
        //     order.push({
        //       id: $(this).attr('data-id'),
        //       position: index+1
        //     });
        //   });
        //
        //   $.ajax({
        //     type: "POST",
        //     dataType: "json",
        //     url: "{{ url('sortabledatatable') }}",
        //     data: {
        //       order:order,
        //       _token: '{{ csrf_token() }}'
        //     },
        //     success: function(response) {
        //         if (response.status == "success") {
        //           console.log(response);
        //         } else {
        //           console.log(response);
        //         }
        //     }
        //   });
        //
        // }
        // });

    </script>
    <script>
        $('#setting').addClass('active');
        $('#setting-index').addClass('active');

    </script>
@stop
