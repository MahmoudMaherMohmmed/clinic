@extends('template')
@section('page_title')
@lang('messages.File Manager.uiFile Manager')
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-title">
                    <h3><i class="fa fa-bars"></i>@lang('messages.File Manager.uiFile Manager')</h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <form name="form_id" id="form_id" class="form-horizontal" action="javascript:void(0);" enctype="multipart/form-data" >
                      {{ csrf_field() }}
                        <div class="col-md-12">
                            <fieldset><legend> Items </legend>


                                <div class="form-group  " >
                                    <label for="Artist" class=" control-label col-md-5 text-left"> Item <span class="asterix"> * </span></label>
                                    <div class="col-md-4">
                                        <input type="file" name="vasplus_multiple_files" id="vasplus_multiple_files" multiple="multiple" style="padding:5px;" required />
                                    </div><br><br>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="0"
                                             aria-valuemin="0" aria-valuemax="100" style="width:0%">
                                            0%
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>




                        <div style="clear:both"></div>


                        <div class="form-group">
                            <label class="col-sm-5 text-right">&nbsp;</label>
                            <div class="col-sm-6">
                                <button type="submit" name="submit" class="btn btn-success btn-sm" ><i class="fa  fa-save "></i> Save</button>
                                <button type="button" onclick="location.href='{{url('upload_items')}}' " class="btn btn-danger btn-sm "><i class="fa  fa-arrow-circle-left "></i>Cancel</button>
                            </div>

                        </div>
                    </form>
                    {{-- {!! Form::close() !!} --}}
                    <center>

                        <table class="table table-striped table-bordered" style="width:60%;" id="add_files">
                            <thead>
                            <tr>
                                <th style="color:blue; text-align:center;">Number</th>
                                <th style="color:blue; text-align:center;">File Name</th>
                                <th style="color:blue; text-align:center;">Status</th>
                                <th style="color:blue; text-align:center;">File Size</th>
                                <th style="color:blue; text-align:center;">Action</th>
                            <tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </center>
                    <!-- Modal -->


                    <div id="myModal" class="modal fade" role="dialog" style="padding-top: 10%">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Items</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h1 style="text-align: center;color: green;">Items Uploaded Successfully</h1>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script type="text/javascript" src="{{url('js/vpb_uploader.js')}}"></script>
    <script type='text/javascript'>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
        $(document).ready(function()
        {
            // Call the main function
            new vpb_multiple_file_uploader
            ({
                vpb_form_id: "form_id", // Form ID
                autoSubmit: true,
                vpb_server_url: "{{url('save_items')}}"
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.removeCurrentFiles').on('click',function(){
                var removeUrl = $(this).attr('href');
                $.get(removeUrl,function(response){});
                $(this).parent('div').empty();
                return false;
            });

        });
    </script>
    <script>
        $('#file_manager').addClass('active');
        $('#uploader').addClass('active');
    </script>
@stop
