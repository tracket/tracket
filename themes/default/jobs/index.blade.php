@extends('theme::default.layouts.app')

@section('content')
    <div class="md:flex md:items-center md:justify-between">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">Jobs</h2>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-8">
        <div class="col-span-4 flex flex-col space-y-4">
            @if (count($jobs))
                @foreach ($jobs as $job)
                    <div class="relative rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm flex items-start space-x-3 hover:border-gray-400 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
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
                            <a href="{{ route('web.jobs.show', ['companyExternalId' => $job['company']['external_id'], 'jobExternalId' => $job['external_id']]) }}" class="focus:outline-none">
                                <span class="absolute inset-0" aria-hidden="true"></span>
                                <p class="text-sm font-medium text-gray-900">{{ $job['company']['name'] }}</p>
                                <p class="text-sm font-medium text-gray-900">{{ $job['title'] }}</p>
                                <p class="text-sm text-gray-500 truncate">{{ $job['location'] }}</p>
                            </a>
                        </div>
                        <a href="{{ route('web.jobs.show', ['companyExternalId' => $job['company']['external_id'], 'jobExternalId' => $job['external_id']]) }}">
                            View Job Opening
                            <svg class="h-5 w-5 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                    </div>
                @endforeach
            @else
                <div class="relative rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm flex items-start space-x-3 hover:border-gray-400 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                    No jobs are available to display.
                </div>
            @endif
        </div>
    </div>
@endsection
