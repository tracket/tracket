@extends('theme::default.layouts.app')

@section('content')
    <div class="md:flex md:items-center md:justify-between">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">{{ $page['title'] }}</h2>
        </div>
    </div>
    <div class="description grid grid-cols-1 md:grid-cols-3 gap-4 mt-8">
        <div class="col-span-3 flex flex-col space-y-4">
            <div class="rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm flex flex-col space-y-3">
                {!! $page['content'] !!}
            </div>
        </div>
    </div>
@endsection
