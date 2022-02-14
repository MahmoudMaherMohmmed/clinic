@extends('template')
@section('page_title')
@lang('messages.Static Translations.Static Translations')
@stop
@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="box box-black">
				<div class="box-title">
					<h3><i class="fa fa-table"></i>@lang('messages.Static Translations.Static Translations')</h3>
					<div class="box-tool">
						<a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
						<a data-action="close" href="#"><i class="fa fa-times"></i></a>
					</div>
				</div>
				<div class="box-content">
				<div class="btn-toolbar pull-right">
                        <div class="btn-group">
                            <a class="btn btn-circle show-tooltip" title="" href="{{url('static_translation/create')}}" data-original-title="Add new record"><i class="fa fa-plus"></i></a>
							<?php
								$table_name = "static_translations" ;
							?>
							@include('partial.delete_all')
                        </div>
                    </div>
                    <br><br>
					<div class="table-responsive">
						<table id="example" class="table table-striped dt-responsive" cellspacing="0" width="100%">
							<thead>
							<tr>
                                <th style="width:18px"><input type="checkbox" id="check_all" data-table="{{ $table_name }}"></th>
							<th>@lang('messages.Key')</th>
								<th>@lang('messages.Translation')</th>
								<th class="visible-md visible-lg" style="width:130px">@lang('messages.action')</th>
							</tr>
							</thead>
							<tbody>
							@foreach($static_translations as $static_translation)
								<tr class="table-flag-blue">
								<th><input class="select_all_template" type="checkbox" name="selected_rows[]" value="{{$static_translation->id}}" class="roles" onclick="collect_selected(this)"></th>
									<td>{{$static_translation->key_word}}</td>
									<td>
										@if(strlen($static_translation->getBody()) < 50)
											<ul>
			                                    @foreach($languages as $language)
													<li>
			                                        	{!!$static_translation->getBody($language->short_code)!!}
													</li>
			                                    @endforeach
											</ul>
										@else
											<a href="{{url('static_translation/'.$static_translation->id)}}" title="View Translation">View Translation</a>
										@endif
									</td>
									<td class="visible-md visible-xs visible-sm visible-lg">
										<div class="btn-group">
											<a class="btn btn-sm show-tooltip" title="" href="{{url('static_translation/'.$static_translation->id.'/edit')}}" data-original-title="Edit"><i class="fa fa-edit"></i></a>
											<a class="btn btn-sm btn-danger show-tooltip" title="" onclick="return confirm('Are you sure you want to delete this ?');" href="{{url('static_translation/'.$static_translation->id.'/delete')}}" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
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
		$('#static').addClass('active');
		$('#static-index').addClass('active');
	</script>
@stop
