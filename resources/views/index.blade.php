@extends('layouts.app')

@section('title', $page->name['ka'])

@section('content')
    <x-page-banner :image="$page->background_image" :title="$page->name['ka']" />

    @foreach($page->contents as $content)
        <x-content-card :content="$content" />
    @endforeach

{{--    @foreach($page->modules as $module)--}}
{{--        <x-module-card :module="$module" />--}}
{{--    @endforeach--}}

@endsection
