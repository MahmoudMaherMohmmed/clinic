@extends('template')
@section('page_title')
    @lang('messages.role')
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-black">
                <div class="box-title">
                    <h3><i class="fa fa-table"></i> @lang('messages.role')</h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <div class="btn-toolbar pull-right">
                        <div class="btn-group">
                            @if (get_action_icons('roles/new', 'get'))

                                <a class="btn btn-circle show-tooltip" title="" href="{{ url('roles/new') }}"
                                    data-original-title="Add new record"><i class="fa fa-plus"></i></a>
                            @endif
                            <?php $table_name = 'roles'; ?>
                            @include('partial.delete_all')
                        </div>
                    </div>
                    <br><br>
                    <div class="table-responsive">
                        <table class="table table-advance">
                            <thead>
                                <tr>
                                    <th style="width:18px"><input type="checkbox" id="check_all" data-table="{{ $table_name }}"></th>
                                    <th>Role name</th>
                                    <th class="visible-md visible-lg" style="width:130px">Action</th>
                                </tr>
                            </thead>
                            @foreach ($roles as $role)
                                <tr class="table-flag-blue">
                                    <th><input type="checkbox" name="selected_rows[]" value="{{ $role->id }}" class="roles select_all_template"></th>
                                    <td>{{ $role->name }}</td>
                                    <td class="visible-md visible-xs visible-sm visible-lg">
                                        <div class="btn-group">
                                            <!-- <a class="btn btn-sm show-tooltip btn-success" data-original-title="View Access"  href="{{ url('roles/' . $role->id . '/view_access') }}">
                                                                    <i class="fa fa-eye"></i>
                                                                </a> -->
                                            @if (get_action_icons('roles/{id}/edit', 'get'))
                                                <a class="btn btn-sm show-tooltip" title=""
                                                    href="{{ url('roles/' . $role->id . '/edit') }}"
                                                    data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                            @endif
                                            @if (get_action_icons('roles/{id}/delete', 'get'))
                                                <a class="btn btn-sm btn-danger show-tooltip" title=""
                                                    onclick="return confirm('Are you sure you want to delete this ?');"
                                                    href="{{ url('roles/' . $role->id . '/delete') }}"
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
        $('#role-index').addClass('active');

    </script>
@stop
