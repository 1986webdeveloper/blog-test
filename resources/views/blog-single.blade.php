@extends('layouts.app')

@section('content')
<section class="w-full px-5 xl:px-80 single-block font-arial">
    <div class="container mx-auto">
        <div class="w-full flex md:flex-row flex-col pt-10">
            <div class="w-full flex flex-col items-start mb-0">
                <div class="text-3xl leading-none font-bold text-black mb-3">{{$blog->title}}</div>
                    <div class="w-full mt-4 image-block-wrap relative h-48 lg:h-custom415">
                        @if($blog->image != '')
                            <img src="/storage/{{$blog->image}}" class="w-full object-cover rounded-lg h-48 lg:h-custom415" alt="{{$blog->title}}" width="873" height="415" >    
                        @else
                            <img src="/public/images/default.png" class="w-full mb-4 md:mb-0 h-40 md:h-50 rounded-lg object-cover object-center" alt="{{$blog['title']}}" >
                        @endif
                    </div>
                <div class="w-full inline-block mt-4">
                    {!! html_entity_decode($blog->body) !!}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
