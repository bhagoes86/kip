@extends('layout')
@section('title')
	List Request
@stop

@section('content')

<div class="panel panel-primary">
  <!-- Default panel contents -->
  <div class="panel-heading">Request List</div>
  <div class="panel-body">

<a href="{{ URL::to('admin/requests') }}" type="button" class="btn btn-default hidden-print btn-sm {{ Request::is('admin/requests') ? 'active' : '' }}">
  <span class="glyphicon glyphicon-th-list"></span> List Request
</a>

    {{ Form::open(array('url'=>'admin/requests', 'method'=>'get', 'class'=>'navbar-form navbar-right', 'role'=>'form')) }}
    <div class="form-group">
	    {{ Form::text('search', (isset($keyword)) ? $keyword : '', array('class'=>'form-control input-sm', 'placeholder'=>'Search...','autofocus'))}}
	    <a href="{{ URL::to('admin/requests') }}" type="button" class="btn hidden-print btn-default btn-sm">
		  <span class="glyphicon glyphicon-refresh"></span> Reset
		</a>
    </div>
    {{ Form::close() }}
  </div>
	@if (Session::has('message'))
		<div class="alert alert-info alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			{{ Session::get('message') }}
		</div>
	@endif

	<table class="table table-condensed table-bordered table-hover">
		<thead>
			<tr>
				<th>No</th>
				<th>Name</th>
				<th>Subject</th>
				<th>Description</th>
				<th>Status</th>
				<th class="hidden-print">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=$requests->getFrom(); ?>
			@foreach($requests as $key => $value)
				<tr>
					<td>{{ $i }}</td>
					<td>{{ $value->name }}</td>
					<td>{{ $value->title }}</td>
					<td>{{ Str::limit($value->description,20)}} </td>
					<td>
						@if ($value->status == '0') Pending
						@elseif ($value->status == '1') Accept
						@elseif ($value->status == '2') Reject
						@else Unknown
						@endif
					</td>
					<td class="hidden-print">
						{{ Form::open(array('url' => 'admin/requests/'.$value->id, 'style' => 'margin-bottom:0')) }}
							<a class="btn btn-xs btn-success" href="{{ URL::to('admin/requests/' . $value->id) }}">
								<span class="glyphicon glyphicon-eye-open"></span>View
							</a>
							{{ Form::hidden('_method', 'DELETE') }}
							<button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Delete this data?');">
								<span class="glyphicon glyphicon-trash"></span> Delete
							</button>
						{{ Form::close() }}
					</td>
				</tr>
				<?php $i++; ?>
			@endforeach
		</tbody>
	</table>
	<center class="hidden-print">
	@if(isset($keyword))
	{{ $requests->appends(array('search' => $keyword))->links() }}
	@else
	{{ $requests->links() }}
	@endif
	</center>
</div>

@stop