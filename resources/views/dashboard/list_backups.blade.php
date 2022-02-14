@extends('template')
@section('page_title')
@lang('messages.Setting.Database Backups')
@stop
@section('content')

<div class="row">
        <div class="col-md-12">
            <div class="box box-black">
                <div class="box-title">
                    <h3><i class="fa fa-table"></i>@lang('messages.Setting.Database Backups')</h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <div class="btn-toolbar pull-right">
                        <div class="btn-group">
                            <a class="btn btn-circle show-tooltip" title="" href="{{url('export_DB')}}" data-original-title="Export current DB"><i class="fa fa-download"></i></a>
                        </div>
                    </div>
                    <br><br>
					<div class="table-responsive">
					    <table class="table table-advance">
					        <thead>
					            <tr>
					                <th>@lang('messages.Setting.Database Backups')</th>
					                <th class="visible-md visible-lg" style="width:130px">@lang('messages.action')</th>
					            </tr>
					        </thead>
					        <tbody>
                                @foreach($databases as $database)
                                    <tr>
                                        <td>{{$database}}</td>
                                        <td>
                                            <!-- <a class="btn btn-circle show-tooltip" title="Import This DB" href="{{url('import_DB?path='.$database)}}"><i class="fa fa-upload"></i></a> -->
                                            <a class="btn btn-circle show-tooltip btn-danger" href="{{url('delete_backup?path='.$database)}}" onclick="return confirm('Are you sure you want to delete this backup ?');" title="Delete This DB"><i class="fa fa-trash"></i></a>
                                            <a class="btn btn-circle show-tooltip btn-success" target="_blank" href="{{url('download_backup?path='.$database)}}"  title="Download This Backup"><i class="fa fa-save"></i></a>
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
        $('#setting').addClass('active');
        $('#setting-import-DB').addClass('active');
    </script>
@stop
