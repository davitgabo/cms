@extends('layouts.app')

@section('title', $page->name['ka'])

@section('content')
{{--    @php--}}
{{--        $video = \App\Models\VideoGallery::whereNotNull('video')->first();--}}
{{--    @endphp--}}
    @if(!$page->contents->isEmpty())
    <x-page-banner :image="$page->background_image" :title="$page->name['ka']" />
    @endif

    @foreach($page->contents as $content)
        <x-content-card :content="$content" />
    @endforeach

    @if($page->has('modules'))
        @foreach($page->modules as $module)
            <section class="Container1 other-content">
                <div class="content">
                    <div class="product-grid">
                        <x-module-card :module="$module->title" />
                    </div>
                </div>
            </section>
        @endforeach
    @endif
{{--    <section class="Container1 other-content">--}}
{{--        <x-video-card :video="$video"/>--}}
{{--    </section>--}}
@endsection
