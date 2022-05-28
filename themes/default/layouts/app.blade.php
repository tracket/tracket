<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('default/images/favicon.svg') }}">
    <link rel="icon" type="image/png" href="{{ asset('default/images/favicon.png') }}">
    <title>{{ config('app.name', 'Tracket') }}</title>
    <link rel="stylesheet" href="{{ asset('default/app.css') }}">
    <style>
        .description ul,
        .description ol {
            margin-left: 1.5rem;
            list-style-type: disc;
        }
    </style>
    <script src="{{ asset('default/app.js') }}" defer></script>
</head>
<body class="h-full">
    <div>
        <div class="relative bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6">
                <div class="flex justify-between items-center border-b-2 border-gray-100 py-4 md:justify-start md:space-x-10">
                    <div class="flex justify-start lg:w-0 lg:flex-1">
                        <a href="/">
                            <span class="sr-only">Tracket</span>
                            <img class="h-8" src="{{ asset('default/logo.svg') }}" />
                        </a>
                    </div>
                    <div class="-mr-2 -my-2 md:hidden">
                        <button type="button" class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" aria-expanded="false">
                            <span class="sr-only">Open menu</span>
                            <!-- Heroicon name: outline/menu -->
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                    <nav class="hidden md:flex space-x-10">
                        <a href="{{ route('web.jobs.index') }}" class="text-base font-medium text-gray-500 hover:text-gray-900">Jobs</a>
                        <a href="{{ route('web.companies.index') }}" class="text-base font-medium text-gray-500 hover:text-gray-900">Companies</a>
                        <a href="{{ pageLink('about')->getUrl() }}" class="text-base font-medium text-gray-500 hover:text-gray-900">{{ pageLink('about')->getTitle() }}</a>
                    </nav>
                    @auth
                        <div class="hidden md:flex items-center justify-end md:flex-1 lg:w-0">
                            @permission('admin.portal.view')
                            <a href="{{ route('admin.dashboard') }}" class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900">Dashboard</a>
                            @endpermission
                            <form method="POST" action="{{ route('web.logout') }}">
                                @csrf
                                <a href="{{ route('web.logout') }}"
                                   class="ml-8 whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900"
                                   onclick="event.preventDefault();this.closest('form').submit();">
                                    Sign out
                                </a>
                            </form>
                        </div>
                    @else
                        <div class="hidden md:flex items-center justify-end md:flex-1 lg:w-0">
                            @if ($settings->get('allow_developer_accounts') || $settings->get('allow_hiring_manager_accounts'))
                                <a href="{{ route('web.login') }}" class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900"> Sign in </a>
                                <a href="{{ route('web.register') }}" class="ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700"> Sign up </a>
                            @endif
                        </div>
                    @endauth
                </div>
            </div>

            <!--
              Mobile menu, show/hide based on mobile menu state.

              Entering: "duration-200 ease-out"
                From: "opacity-0 scale-95"
                To: "opacity-100 scale-100"
              Leaving: "duration-100 ease-in"
                From: "opacity-100 scale-100"
                To: "opacity-0 scale-95"
            -->
            <div class="absolute top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden hidden">
                <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 bg-white divide-y-2 divide-gray-50">
                    <div class="pt-5 pb-6 px-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" alt="Workflow">
                            </div>
                            <div class="-mr-2">
                                <button type="button" class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                                    <span class="sr-only">Close menu</span>
                                    <!-- Heroicon name: outline/x -->
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="mt-6">
                            <nav class="grid gap-y-8">
                                <a href="{{ route('web.jobs.index') }}" class="-m-3 p-3 flex items-center rounded-md hover:bg-gray-50">
                                    <svg class="flex-shrink-0 h-5 w-5 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <span class="ml-3 text-base font-medium text-gray-900">Jobs</span>
                                </a>

                                <a href="{{ route('web.companies.index') }}" class="-m-3 p-3 flex items-center rounded-md hover:bg-gray-50">
                                    <svg class="flex-shrink-0 h-6 w-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                    <span class="ml-3 text-base font-medium text-gray-900">Companies</span>
                                </a>
                            </nav>
                        </div>
                    </div>
                    <div class="py-6 px-5 space-y-6">
                        <div class="grid grid-cols-2 gap-y-4 gap-x-8">
                            <a href="#" class="text-base font-medium text-gray-900 hover:text-gray-700">Open Source</a>

                            <a href="#" class="text-base font-medium text-gray-900 hover:text-gray-700"> Help Center </a>

                            <a href="#" class="text-base font-medium text-gray-900 hover:text-gray-700"> Terms of Service </a>

                            <a href="#" class="text-base font-medium text-gray-900 hover:text-gray-700"> Privacy Policy </a>
                        </div>
                        <div>
                            <a href="#" class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700"> Sign up </a>
                            <p class="mt-6 text-center text-base font-medium text-gray-500">
                                Have an account?
                                <a href="#" class="text-indigo-600 hover:text-indigo-500"> Sign in </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <main class="flex-1">
            <div class="pt-6 pb-10">
                <div class="max-w-5xl mx-auto px-4 sm:px-6 md:px-8">
                    @yield('content')
                </div>
            </div>
        </main>
        <footer class="bg-gray-100">
            <div class="max-w-7xl mx-auto py-12 px-4 overflow-hidden sm:px-6 lg:px-8">
                <nav class="-mx-5 -my-2 flex flex-wrap justify-center" aria-label="Footer">
                    <div class="px-5 py-2">
                        <a href="{{ route('web.jobs.index') }}" class="text-base text-gray-500 hover:text-gray-900">Jobs</a>
                    </div>
                    <div class="px-5 py-2">
                        <a href="{{ route('web.companies.index') }}" class="text-base text-gray-500 hover:text-gray-900">Companies</a>
                    </div>
                    <div class="px-5 py-2">
                        <a href="{{ pageLink('about')->getUrl() }}" class="text-base text-gray-500 hover:text-gray-900">{{ pageLink('about')->getTitle() }}</a>
                    </div>
                    <div class="px-5 py-2">
                        <a href="{{ route('web.legal.terms') }}" class="text-base text-gray-500 hover:text-gray-900">Terms</a>
                    </div>
                    <div class="px-5 py-2">
                        <a href="{{ route('web.legal.privacy') }}" class="text-base text-gray-500 hover:text-gray-900">Privacy</a>
                    </div>
                </nav>
                <p class="mt-8 text-center text-base text-gray-400">&copy; 2022 Tracket, Inc. All rights reserved. Powered by <a href="https://github.com/tracket/tracket" class="text-base text-indigo-600 font-medium text-gray-900">tracket</a></p>
            </div>
        </footer>
    </div>
</body>
</html>
