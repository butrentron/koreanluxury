	@extends('site.layouts.master')
	@section('head.title')
	<title>{!! $page->set_title ? $page->set_title : $setting->title !!}</title>
	@stop
	@section('meta')
	<meta name="keywords" content="{!! $page->meta_key ? $page->meta_key : $setting->keyword !!}">
	<meta name="description" content="{!! $page->meta_desc ? $page->meta_desc : $setting->description !!}">
	@stop

	@section('body.content')
		{!! $page->content !!}
	@stop
