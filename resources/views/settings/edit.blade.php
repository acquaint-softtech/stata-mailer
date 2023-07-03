@extends('statamic::layout')
@extends('statamic::layout')
@section('title', $title)

@section('content')

    <publish-form
        title="{{ $title }}"
        action="{{ $action }}"
        :blueprint='@json($blueprint)'
        :meta='@json($meta)'
        :values='@json($values)'
    ></publish-form>

@endsection