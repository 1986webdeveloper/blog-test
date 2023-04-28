@extends('layouts.app')

@section('content')
    <div class="row mb-4">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left text-center">
                <h2 class="text-3xl">Add Blog</h2>
            </div>
            <div class="pull-right float-right">
                <a class="btn btn-primary" href="{{ route('blogs.index') }}"> Back</a>
            </div>
        </div>
    </div>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="javascript:void(0)" method="POST" enctype="multipart/form-data" id="blogForm">
        @csrf
        <input type="hidden" name="user_id" value="{{ Auth::id()}}">
        <input type="hidden" name="blog_id" value="">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mb-4">
                <div class="form-group">
                    <strong>Title:</strong>
                    <input type="text" name="title" id="title" class="form-control bg-white" placeholder="Title" >
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mb-4">
                <div class="form-group">
                    <strong>Body:</strong>
                    <textarea class="form-control h-40" name="body" id="body" placeholder="Body"></textarea>
                    <p class="text-[#FF0000]" id="body-error"></p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mb-4">
                <div class="form-group">
                    <input type="file" class="form-control" name="file" placeholder="image">
                    <small class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</small>
                </div>
            </div>
        
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary bg-[#0d6efd] text-white" id="submit">Submit</button>
            </div>
        </div>
    
    </form>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/uye6bc9ya2qmas1a0bnc3kyivvncbxi4eh7mzy8mpshk6nlm/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        var blogUrl = "{{ route('blogs.store') }}";
        var hasDuplicateBlogTitle = "{{ route('hasDuplicateBlogTitle') }}";
    </script>
    <script src="{{ Vite::asset('resources/js/blog.js') }}"></script>

@endsection
