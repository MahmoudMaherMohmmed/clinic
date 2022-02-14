@extends('template')
@section('page_title')
	Role-Route / {{$role->name}}
@stop
@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="box box-black">
				<div class="box-title">
					<h3><i class="fa fa-table"></i>Route Map</h3>
					<div class="box-tool">
						<a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
						<a data-action="close" href="#"><i class="fa fa-times"></i></a>
					</div>
				</div>
				<div class="box-content">
				   <div class="table-responsive">
						<ul>
							@foreach($controllers as $index=>$item)
                            		<li><h4>{{$index}} <a href="{{url('routes/create?controller_name='.$index.'&role='.$role->id)}}"><i class="btn btn-success fa fa-plus" title="Add Route"></i></a></h4></li> 
                                <ul>
                                   @foreach($methods as $method)
                                     @if($method->controller_name==$index)
                                        <li>{{$method->function_name}}</li>
                                     @endif
                                   @endforeach
                                </ul>
							 @endforeach
				        </ul>
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
