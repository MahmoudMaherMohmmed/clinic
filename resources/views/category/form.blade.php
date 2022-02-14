@extends('template')
@section('page_title')
@lang('messages.Category.Category')
@stop
@section('content')
<style>
.grid-custom img {
        margin-bottom: 3px;
        border-radius: 4px;
    }

    .grid-custom {
        background: #d59a878c;
        border-radius: 7px;
        border: 3px solid #eee;
        padding: 5px;
    }

    .remove-image{
      position: absolute;
      cursor: pointer;
      background-color: #e40b0b;
      color: white;
      top: -1px;
      right: 15px;
      padding: 0 3px;
      font-size: 13px;
      -webkit-border-radius: 5px;
      -moz-border-radius: 5px;
      border-radius: 5px;
    }
</style>
    @include('errors')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-title">
                    <h3><i class="fa fa-bars"></i>@lang('messages.Category.Category')</h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    @if($category)
                    {!! Form::model($category,["url"=>"category/$category->id","class"=>"form-horizontal","method"=>"patch","files"=>"True"]) !!}
                    @include('category.input',['buttonAction'=>''.\Lang::get("messages.Edit").'','required'=>'  (optional)'])
                    @else
                    {!! Form::open(["url"=>"category","class"=>"form-horizontal","method"=>"POST","files"=>"True"]) !!}
                    @include('category.input',['buttonAction'=>''.\Lang::get("messages.save").'','required'=>'  *'])
                    @endif
                    {!! Form::close() !!}
                </div>
            </div>

        </div>

    </div>

@stop
@section('script')
    <script>
        $('#category').addClass('active');
        $('#category_create').addClass('active');

    </script>
@stop
