@extends('theme::default.layouts.app')

@section('content')
    <div class="md:flex md:items-center md:justify-between">
        <div class="flex-shrink-0">
            @if (isset($company['logo_url']))
                <img class="h-14 w-14 rounded-full border border border-gray-200" src="{{ $company['logo_url'] }}" alt="">
            @else
                <div class="flex justify-center items-center h-14 w-14 rounded-full bg-white border border border-gray-200">
                    <svg class="text-gray-300 group-hover:text-gray-500 flex-shrink-0 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
            @endif
        </div>
        <div class="flex-1 min-w-0 ml-4">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">{{ $company['name'] }}</h2>
            <h4 class="text-lg font-regular leading-7 text-gray-600 sm:text-xl sm:truncate">{{ $company['tagline'] }}</h4>
        </div>
    </div>
    <div class="md:flex md:items-center md:justify-between mt-6">
        <div class="rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm flex flex-col space-y-3 hover:border-gray-400 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
            <p>{{ $company['description'] }}</p>
            <ul class="m-0 p-0 space-x-3">
                <li class="inline">
                    <a href="{{ $company['website_url'] }}" class="text-sm">
                        <svg class="inline align-text-top h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                        </svg>
                        Website
                    </a>
                </li>
                @if (isset($company['linkedin_url']))
                    <li class="inline">
                        <a href="{{ $company['linkedin_url'] }}" class="text-sm">
                            <svg class="inline align-text-top h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                            </svg>
                            Linkedin
                        </a>
                    </li>
                @endif
                @if (isset($company['twitter_url']))
                    <li class="inline">
                        <a href="{{ $company['twitter_url'] }}" class="text-sm">
                            <svg class="inline align-text-top h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                            </svg>
                            Twitter
                        </a>
                    </li>
                @endif
                @if (isset($company['blog_url']))
                    <li class="inline">
                        <a href="{{ $company['blog_url'] }}" class="text-sm">
                            <svg class="inline align-text-top h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                            </svg>
                            Blog
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
    <div class="md:flex md:items-center md:justify-between mt-8">
        <div class="flex-1 min-w-0">
            <h3 class="text-lg font-bold leading-7 text-gray-900 sm:text-xl sm:truncate">Jobs at {{ $company['name'] }}</h3>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-4">
        <div class="col-span-4 flex flex-col space-y-4">
            @foreach ($company['jobs'] as $job)
                <div class="relative rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm flex items-center space-x-3 hover:border-gray-400 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                    <div class="flex-1 min-w-0">
                        <a href="{{ route('web.jobs.show', ['companyExternalId' => $company['external_id'], 'jobExternalId' => $job['external_id']]) }}" class="focus:outline-none">
                            <span class="absolute inset-0" aria-hidden="true"></span>
                            <p class="text-sm font-medium text-gray-900">{{ $job['title'] }}</p>
                            <p class="text-sm text-gray-500 truncate mt-2 space-x-3">
                                @if ($job['location'])
                                    <span>
                                        <svg class="inline align-text-top flex-shrink-0 h-4 w-4 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        {{ $job['location'] }}
                                    </span>
                                @endif
                                @if ($job['remote_ok'])
                                    <span>
                                        <svg class="inline align-text-top flex-shrink-0 h-4 w-4 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Remote
                                    </span>
                                @endif
                            </p>
                        </a>
                    </div>
                    <a href="{{ route('web.jobs.show', ['companyExternalId' => $company['external_id'], 'jobExternalId' => $job['external_id']]) }}" class="focus:outline-none">
                        View Job Opening
                        <svg class="h-5 w-5 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
