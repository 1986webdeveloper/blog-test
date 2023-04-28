@extends('layouts.app')

@section('content')
    <div class="w-full">
        <div class="min-h-screen items-center justify-center">
            @if(count($blogs) != 0)
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 p-2">
                    @foreach($blogs as $blog)
                    <div class="bg-white text-black-100 text-lg font-bold text-center p-8 rounded-lg border border-current">
                        <a href="{{ route('single-page',base64_encode($blog->id)) }}/">    
                            @if($blog['image'] != '')
                                <img src="/storage/{{$blog['image']}}" class="w-full mb-4 md:mb-0 h-40 md:h-50 rounded-lg object-cover object-center" alt="{{$blog['title']}}" >
                            @else
                                <img src="/public/images/default.png" class="w-full mb-4 md:mb-0 h-40 md:h-50 rounded-lg object-cover object-center" alt="{{$blog['title']}}" >
                            @endif
                        </a>
                        <div class="flex w-full flex-col items-baseline justify-end h-auto mt-4">
                            <a href="{{ route('single-page',base64_encode($blog->id)) }}/">
                                <div class="font-display max-w-sm text-lg font-bold leading-tight blog_title">
                                    <span>
                                        {{$blog['title']}}
                                    </span>
                                </div>
                            </a>    
                            <div class="mt-2 text-tiny font-normal opacity-75 text-black mb-3">
                                @php 
                                    $body = strlen($blog['body']) > 200 ? substr($in,0,200)."..." : $blog['body'];
                                @endphp
                                {!! html_entity_decode($body) !!}
                            </div>
                            <div class="flex w-full items-center mb-3">
                                <p class="text-tiny font-normal opacity-75 text-black mr-2">
                                    {{date("F dS, Y", strtotime($blog['created_at']))}} 
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center">
                    {!! $blogs->links() !!}
                </div>
            @else
                <div>Sorry, there are currently no blog posts to display. Please check back later!</div>
            @endif
        </div>
    </div>
@endsection

