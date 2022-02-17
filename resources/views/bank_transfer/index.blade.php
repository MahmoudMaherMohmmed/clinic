@extends('template')
@section('page_title')
    @lang('messages.bank_transfers.bank_transfers')
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="row">

                <div class="col-md-12">
                    <div class="box box-black">
                        <div class="box-title">
                            <h3><i class="fa fa-table"></i> @lang('messages.bank_transfers.bank_transfers')</h3>
                        </div>
                        <div class="box-content">
                            <div class="btn-toolbar pull-right">
                                <div class="btn-group">
                                    <?php $table_name = 'bank_transfers';
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
                                            <th>@lang('messages.reservations.client_name')</th>
                                            <th>@lang('messages.appointments.date')</th>
                                            <th>@lang('messages.bank_transfers.bank_name')</th>
                                            <th>@lang('messages.bank_transfers.bank_account_number')</th>
                                            <th>@lang('messages.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bank_transfers as $value)
                                            <tr>
                                                <td><input type="checkbox" name="selected_rows[]" value="{{ $value->id }}" class="roles select_all_template">
                                                </td>
                                                <td>{{ $value->id }}</td>
                                                <td> {{ $value->reservation->client->name }} </td>
                                                <td> {{ $value->reservation->date }} - {{ $value->reservation->from }} </td>
                                                <td> {{ $value->bank_name }} </td>
                                                <td> {{ $value->bank_account_number }} </td>

                                                <td class="visible-md visible-xs visible-sm visible-lg">
                                                    <div class="btn-group">
                                                        <a class="btn btn-sm btn-success show-tooltip"
                                                            href='{{ url("bank_transfer/$value->id") }}'
                                                            title="Show"><i class="fa fa-eye"></i></a>
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
        $('#bank_transfer').addClass('active');
        $('#bank_transfer_index').addClass('active');
    </script>
@stop
