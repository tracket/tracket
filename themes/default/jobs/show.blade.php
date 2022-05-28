@extends('theme::default.layouts.app')

@section('content')
    <div class="md:flex md:items-center md:justify-between">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">{{ $job['title'] }}</h2>
            <h4 class="text-lg font-regular leading-7 text-gray-600 sm:text-xl sm:truncate">{{ $job['company']['name'] }}</h4>
        </div>
        <div class="mt-4 flex md:mt-0 md:ml-4">
            <a href="{{ $job['application_url'] }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Apply for this position</a>
        </div>
    </div>
    <div class="description grid grid-cols-1 md:grid-cols-3 gap-4 mt-8">
        <div class="col-span-2 flex flex-col space-y-4">
            <div class="rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm flex flex-col space-y-3">
                {!! $job['description'] !!}

                <!-- This example requires Tailwind CSS v2.0+ -->
                <div class="relative py-2">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                </div>
                <div class="mt-4 flex">
                    <a href="{{ $job['application_url'] }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Apply for this position</a>
                </div>
            </div>
        </div>
        <div class="col-span-1">
            <div class="relative rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm flex items-start space-x-3">
                <div class="flex-shrink-0">
                    @if (isset($job['company']['logo_url']))
                        <img class="h-10 w-10 rounded-full border border-gray-200" src="{{ $job['company']['logo_url'] }}" alt="">
                    @else
                        <div class="flex justify-center items-center h-10 w-10 rounded-full border border border-gray-200">
                            <svg class="text-gray-300 group-hover:text-gray-500 flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <a href="{{ route('web.companies.show', ['externalId' => $job['company']['external_id']]) }}" class="focus:outline-none">
                        <span class="absolute inset-0" aria-hidden="true"></span>
                        <p class="text-sm font-medium text-gray-900">{{ $job['company']['name'] }}</p>
                        <p class="text-sm text-gray-500">{{ $job['company']['tagline'] }}</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
