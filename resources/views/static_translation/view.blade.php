@extends('template')
@section('page_title')
    Static Translation
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-title">
                    <h3><i class="fa fa-file"></i> Static Translations of  {{$static_translation->key_word}}</h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-md-9 user-profile-info">
                            <ul>
                                @foreach($languages as $language)
                                    <li>{{strip_tags($static_translation->getBody($language->short_code))}}</li>
                                    <br>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script>
        $('#static').addClass('active');
        $('#static-index').addClass('active');
    </script>
@stop