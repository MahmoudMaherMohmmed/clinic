@extends('template')
@section('page_title')
@lang('messages.clients.clients')
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-black">
            <div class="box-title">
                <h3><i class="fa fa-table"></i> @lang('messages.clients.clients')</h3>
            </div>
            <div class="box-content">
                <div class="btn-toolbar pull-right">
                    <div class="btn-group">
                        @if (get_action_icons('client/new', 'get'))
                        <a class="btn btn-circle show-tooltip" title="" href="{{ url('client/create') }}"
                            data-original-title="Add new record"><i class="fa fa-plus"></i></a>
                        @endif
                        <?php $table_name = 'clients'; ?>
                    </div>
                </div>
                <br><br>
                <div class="table-responsive">
                    <table id="example" class="table table-striped dt-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="width:18px"><input type="checkbox" id="check_all" data-table="{{ $table_name }}"></th>
                                <th>@lang('messages.name')</th>
                                <th>@lang('messages.users.email')</th>
                                <th>@lang('messages.users.phone')</th>
                                <th class="visible-md visible-lg" style="width:130px">@lang('messages.action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $client)
                            <tr class="table-flag-blue">
                                <th><input type="checkbox" name="selected_rows[]" class="select_all_template" value="{{ $client->id }}"></th>
                                <td>{{ $client->name }}</td>
                                <td>{{ $client->email }}</td>
                                <td>{{ $client->phone }}</td>
                                <td class="visible-xs visible-sm visible-md visible-lg">
                                    <div class="btn-group">
                                        @if (get_action_icons('client/{id}/edit', 'get'))
                                        <a class="btn btn-sm show-tooltip" title=""
                                            href="{{ url('client/' . $client->id . '/edit') }}"
                                            data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                        @endif
                                        @if (get_action_icons('client/{id}/delete', 'get'))
                                        <form action="{{ route('client.destroy', $client->id) }}"
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
@stop
@section('script')
<script>
    $('#client').addClass('active');
	$('#client_index').addClass('active');
</script>
@stop
