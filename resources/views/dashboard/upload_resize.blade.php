
 @extends('template')
@section('page_title')
@lang('messages.Image.Upload/Resize Image')
@stop
@section('content')
    @include('errors')


    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-title">
                    <h3><i class="fa fa-bars"></i>@lang('messages.Image.Upload/Resize Image')</h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <div id="resizable" class="ui-widget-content" style="display:none;">
                      <img id="image" src="#" class="main_resizing"/>
                    </div><br>
                    <input id="image_file" type='file' onchange="readURL(this);" />
                    <br>
                    <input id="inpWidth" placeholder="Width" style="display:none;"><br><br>
                    <input id="inpHeight" placeholder="Height" style="display:none;">
                    <br><br>
                    <div class="form-group" style="display: none;" id="save_btn">
                        <input type="submit" class="btn btn-primary" value="@lang('messages.save')" onclick="save_image()">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@stop

@section('script')
   <script>
    var width = "250px" ;
    var height = "300px" ;
    var checker = false ;
    $('#resizable').on('resize',function(){
        if(this.style.width || this.style.height)
        {
            width = this.style.width  ;
            height = this.style.height  ;
            if(!checker)
                assing_w_h() ;
            checker = false ;
        }
    });

    function readURL(input) {
           if (input.files && input.files[0]) {
               var reader = new FileReader();
               reader.onload = function (e) {
                    $('#image')
                       .attr('src', e.target.result)
                       .width(250)
                       .height(300);
                    $('#resizable').css({
                                        'minWidth':250,
                                        'minHeight':300,
                                        'display':'block'
                                        }) ;
                    $('#save_btn').css('display','block');
                    $('#inpWidth').css('display','block') ;
                    $('#inpHeight').css('display','block') ;
               };
               reader.readAsDataURL(input.files[0]);
            }
        assing_w_h() ;
    }

    $('#inpWidth').keyup(function(){
        width = parseInt(this.value) ;
        $('#image').width(width) ;
        $('#resizable').width(width) ;
        checker = true ;
    });
    $('#inpHeight').keyup(function(){
        height = parseInt(this.value) ;
        $('#image').height(height) ;
        $('#resizable').height(height) ;
        checker = true ;
    });
    function assing_w_h()
    {
        if(parseInt(width) >= 250)
        {
            $('#inpWidth').val(width) ;
        }
        else
        {
            $('#inpWidth').val("250px") ;
            width = "250px" ;
        }
        if(parseInt(height) >= 300)
        {
            $('#inpHeight').val(height) ;
        }
        else
        {
            $('#inpHeight').val("300px") ;
            height = "300px";
        }
    }

    function save_image()
    {
        var theImage = $('#image_file').prop('files')[0] ;
        var form_data = new FormData();
        form_data.append('width',parseInt(width));
        form_data.append('height',parseInt(height)) ;
        form_data.append('image',theImage) ;
        $.ajaxSetup({
            headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:"POST" ,
            url : "save_image",
            data:  form_data ,
            cache       : false,
            contentType : false,
            processData : false,
            success : function(result){

                if(result=="true")
                {
                   alert('Image saved with new dimensions')    ;
                }
                else{
                    alert('Error while saving image') ;
                }
                location.reload() ;
            }
        });
    }
    </script>
    <script>
        $('#images').addClass('active');
        $('#upload_resize').addClass('active');
    </script>
@stop






















