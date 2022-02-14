@extends('template')
@section('page_title')
    @lang('messages.bank_transfers.bank_transfer_details')
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="row">

                <div class="col-md-12">
                    <div class="box box-black">
                        <div class="box-title">
                            <h3><i class="fa fa-table"></i> @lang('messages.bank_transfers.bank_transfer_details')</h3>
                            <a class="btn btn-sm btn-success show-tooltip" style="float: left" href='{{ url("reservation/$reservation->id/edit") }}' title="Show">@lang('messages.reservations.update_reservation')</a>
                        </div>
                        <div class="box-content">
                            <div class="table-responsive">
                                <table class="table table-striped dt-responsive" cellspacing="0" width="100%">
                                    <tbody>
                                        <tr>
                                            <td> @lang('messages.reservations.client_name') </td>
                                            <td> {{ $reservation->client->name }} </td>
                                        </tr>
                                        <tr>
                                            <td> @lang('messages.reservations.patient_name') </td>
                                            <td> {{ $reservation->patient_name }} </td>
                                        </tr>
                                        <tr>
                                            <td> @lang('messages.reservations.phone_number') </td>
                                            <td> {{ $reservation->phone_number }} </td>
                                        </tr>
                                        <tr>
                                            <td> @lang('messages.reservations.age') </td>
                                            <td> {{ $reservation->age }} </td>
                                        </tr>
                                        <tr>
                                            <td> @lang('messages.description') </td>
                                            <td> {{ $reservation->description }} </td>
                                        </tr>
                                        <tr>
                                            <td>@lang('messages.reservations.doctor')</td>
                                            <td> {{ $reservation->appointment->doctor->getTranslation('name', Session::get('applocale')) }} </td>
                                        </tr>
                                        <tr>
                                            <td> @lang('messages.appointments.date') </td>
                                            <td> {{ $reservation->appointment->date }} </td>
                                        </tr>
                                        <tr>
                                            <td> @lang('messages.appointments.time') </td>
                                            <td> {{ $reservation->appointment->from }} </td>
                                        </tr>
                                        <tr>
                                            <td> @lang('messages.reservations.payment_method') </td>
                                            <td>
                                                @if($reservation->payment_type == 1)
                                                    <a class="show-tooltip"
                                                        href='{{ url("bank_transfer/$reservation->id") }}'
                                                        title="Show">@lang('messages.reservations.bank_transfer')</a>
                                                @else
                                                    @lang('messages.reservations.cash')
                                                @endif 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> @lang('messages.status.status') </td>
                                            <td> 
                                            @if($reservation->status == 1)
                                                @lang('messages.status.under_review')
                                            @elseif($reservation->status == 2)
                                                @lang('messages.status.approved')
                                            @else
                                                @lang('messages.status.rejected')
                                            @endif
                                            </td>
                                        </tr>
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
        $('#reservation').addClass('active');
        $('#reservation_index').addClass('active');
    </script>
@stop
