@extends('templates.app')

@section('content')
    <div id="root" class="flex" style="flex-grow: 1; margin: 1rem">
        @vite('resources/js/Components/Manager/index.jsx')
    </div>
@endsection
