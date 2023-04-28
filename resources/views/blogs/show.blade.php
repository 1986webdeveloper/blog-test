@extends('layouts.app')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left text-center">
                <h2 class="text-3xl"> Show Blog</h2>
            </div>
            <div class="pull-right" style="float:right;">
                <a class="btn btn-primary" href="{{ route('blogs.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
            <div class="form-group">
                <strong>Title:</strong>
                {{ $blog->title }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
            <div class="form-group">
                <strong>Body:</strong>
                {!! html_entity_decode($blog->body) !!}
            </div>
        </div>
        @if($blog->image != '')
            <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                <div class="form-group">
                    <strong>Image:</strong>
                    <img class="mt-4" src="/storage/{{$blog->image}}" width="100px">
                </div>
            </div>
        @endif
    </div>
@endsection