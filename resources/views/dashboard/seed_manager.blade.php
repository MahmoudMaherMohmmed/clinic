@extends('template')

@section('page_title')
@lang('messages.Setting.Create Seed Files')
@stop

@section('content')
    @include('errors')

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-title">
                    <h3><i class="fa fa-table"></i> @lang('messages.Setting.Create Seed Files')</h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover fill-head">
                            <thead>
                                <tr>
                                    <th>Table</th>
                                    <th>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" onchange="check_all()"/>
                                            @lang('messages.Setting.Create Seed Files')
                                        </label>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            {!! Form::open(["url"=>"admin/seed_tables","class"=>"form-horizontal"]) !!}
                                @foreach($tables as $value)
                                <tr>
                                    <td>
                                        {{$value}}
                                    </td>
                                    <td>
                                        <input class="seed_class" type="checkbox" name="tables[]" value="{{$value}}" />
                                    </td>
                                </tr>
                                @endforeach
                                <div class="btn-group">
                                    <input type="submit" class="btn btn-primary btn-success" value="Seed Tables">
                                </div>
                                <br><br>
                            {!! Form::close() !!}
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
        var checked = false ;
        function check_all()
        {
            checked = !checked ;
            $('.seed_class').prop('checked',checked);
        }
    </script>
    <script>
        $('#setting').addClass('active');
        $('#setting-seed').addClass('active');
    </script>
@stop
