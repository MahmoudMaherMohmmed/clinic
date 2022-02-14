@extends('template')
@section('page_title')
    {{ request()->filled('parent_id') ? $parentTitle : \Lang::get("messages.Category.Category") }}
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="row">

                <div class="col-md-12">
                    <div class="box box-black">
                        <div class="box-title">
                            <h3><i class="fa fa-table"></i> @lang('messages.Category.Category')</h3>
                            <div class="box-tool">
                                <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                                <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                            </div>
                        </div>
                        <div class="box-content">
                            <div class="btn-toolbar pull-right">
                                <div class="btn-group">
                                    @if (get_action_icons('category/create', 'get'))

                                        <a class="btn btn-circle show-tooltip" title="" href="{{ url('category/create') }}"
                                            data-original-title="Add new record"><i class="fa fa-plus"></i></a>
                                    @endif
                                    <?php $table_name = 'categories';
                                    // pass table name to delete all function
                                    // if the current route exists in delete all table flags it will appear in view
                                    // else it'll not appear
                                    ?>
                                    @include('partial.delete_all')
                                </div>
                            </div>
                            <br><br>
                            <div class="table-responsive">
                                <table id="dtcontent" class="table table-striped dt-responsive" cellspacing="0"
                                    width="100%">
                                    <thead>
                                        <tr>
                                            <th style="width:18px"><input type="checkbox" id="check_all" data-table="{{ $table_name }}"></th>
                                            <th>id</th>
                                            <th>@lang('messages.Title')</th>
                                            <th>@lang('messages.Image.Image')</th>
                                            <th>@lang('messages.action')</th>
                                        </tr>
                                    </thead>

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
        $('#category').addClass('active');
        $('#category_index').addClass('active');

    </script>
    <script>
        window.onload = function() {
            $('#dtcontent').DataTable({
                "processing": true,
                "serverSide": true,
                "search": {
                    "regex": true
                },
                "ajax": {
                    type: "GET",
                    "url": "{!! url('category/allData?parent_id=' . request('parent_id')) !!}",
                    "data": "{{ csrf_token() }}"
                },
                columns: [{
                        data: 'index',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'id'
                    },
                    {
                        data: 'title'
                    },
                    {
                        data: 'image'
                    },
                    {
                        data: 'action',
                        searchable: false
                    }
                ],
                "pageLength": 5
            });
        };

    </script>
@stop
