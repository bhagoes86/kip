@extends('layout')
@section('title')
	Show Page
@stop

@section('content')

<div class="panel panel-primary">
  <!-- Default panel contents -->
  <div class="panel-heading">Detail Page</div>
  <div class="panel-body">
 <a href="{{ URL::route('admin.pages.index') }}" type="button" class="btn btn-default hidden-print btn-sm {{ (Route::currentRouteName()=='admin.pages.index') ? 'active' : '' }}">
  <span class="glyphicon glyphicon-th-list"></span> List Page
</a>

<br><br>

<div class="col-md-12">
    <ul class="list-group">
      <li class="list-group-item list-group-item-info"><b>Detail Page</b></li>
      <li class="list-group-item">Kategori : <b>{{{$information->category}}}</b></li>
      <li class="list-group-item"> <blockquote> <p> {{{$information->title}}} </p> <footer>{{{$information->description}}}</footer></blockquote></li>
      <li class="list-group-item">File :
      @if($information->attachment)
        <ul>
          <li>Nama File : {{{explode('/', $information->attachment)[1]}}}</li>
          <li>Ekstensi : {{{ File::extension(public_path().'/uploads/'.$information->attachment)}}}</li>
          <li>Besar File : {{{ number_format(((File::size(public_path().'/uploads/'.$information->attachment))/1024),2) }}} Kb</li>
        </ul>
          {{Form::open(array('route'=>'user-download'))}}
            {{Form::hidden('sess',Crypt::encrypt($information->id))}}
            <button class="btn btn-primary btn-sm" type="submit">Download</button>
          {{Form::close()}}
      @else
        Tidak ada
      @endif
      </li>
      <li class="list-group-item">Create : <b>{{$information->created_at}}</b></li>
      <li class="list-group-item">Update : <b>{{$information->updated_at}}</b></li>
      
    </ul>
</div>
  </div>
</div>
@stop