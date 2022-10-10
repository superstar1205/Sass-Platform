<!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->
<div class="flex md:hidden">

    <div class="relative flex flex-col w-full bg-white overflow-x-auto">

        <div class="flex flex-row w-full">
            <a href="{{ route('admin.dashboard.index') }}"
               class="{{ 'dashboard'==$current ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'   }}  group flex items-center px-2 py-2 text-sm font-medium">
                {{ __('Dashboard') }}
            </a>

            <a href="{{ route('admin.forms.index') }}"
               class="{{ 'forms'==$current ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'   }}  group flex items-center px-2 py-2 text-sm font-medium">
                {{ __('Forms') }}
            </a>

            <a href="{{ route('admin.responses.index') }}"
               class="{{ 'responses'==$current ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'   }}  group flex items-center px-2 py-2 text-sm font-medium">
                {{ __('Responses') }}
            </a>

            <a href="{{ route('admin.integrations.index') }}"
               class="{{ 'integration'==$current ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'   }}  group flex items-center px-2 py-2 text-sm font-medium">
                <!-- Heroicon name: outline/calendar -->
                {{ __('Integrations') }}
            </a>

            @if(auth()->user()->not_admin)
                <a href="{{ route('admin.subscriptions.index') }}"
                   class="{{ 'subscriptions'==$current ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'   }}  group flex items-center px-2 py-2 text-sm font-medium">
                    <!-- Heroicon name: outline/calendar -->
                    {{ __('Subscriptions') }}
                </a>
            @endif

            <a href="{{ route('password.reset') }}"
               class="{{ 'password-reset' == $current ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'   }}  group flex items-center px-2 py-2 text-sm font-medium">
                <!-- Heroicon name: outline/calendar -->
                {{ __('Account') }}
            </a>

            @if(auth()->user()->is_admin)
                <a href="{{ route('admin.packages.index') }}"
                   class="{{ 'packages' == $current ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'   }}  group flex items-center px-2 py-2 text-sm font-medium">
                    <!-- Heroicon name: outline/calendar -->
                    {{ __('Packages') }}
                </a>

                <a href="{{ route('admin.users.index') }}"
                   class="{{ 'users' == $current ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'   }}  group flex items-center px-2 py-2 text-sm font-medium">
                    <!-- Heroicon name: outline/calendar -->
                    {{ __('Users') }}
                </a>

                <a href="{{ route('admin.invoices.index') }}"
                   class="{{ 'invoices' == $current ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'   }}  group flex items-center px-2 py-2 text-sm font-medium">
                    <!-- Heroicon name: outline/calendar -->
                    {{ __('Invoices') }}
                </a>

                <a href="{{ route('admin.envs.create') }}"
                   class="{{ 'envs' == $current ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'   }}  group flex items-center px-2 py-2 text-sm font-medium">
                    <!-- Heroicon name: outline/calendar -->
                    {{ __('Settings') }}
                </a>
            @endif

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-dropdown-link :href="route('logout')"
                                 class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 text-sm font-medium"
                                 onclick="event.preventDefault();
                                                this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
        </div>

    </div>
</div>

<!-- Static sidebar for desktop -->
<div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0">
    <!-- Sidebar component, swap this element with another sidebar if you like -->
    <div class="flex-1 flex flex-col min-h-0 border-r border-gray-200 bg-white">
        <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
            <div class="flex items-center flex-shrink-0 px-4">
                <h2 class="text-3xl font-bold">Formed</h2>
            </div>

            <nav class="mt-5 flex flex-col px-2 bg-white space-y-1">

                <!-- Current: "", Default: "" -->
                <a href="{{ route('admin.dashboard.index') }}"
                   class="{{ 'dashboard'==$current ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'   }}  group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                    <svg class="text-gray-500 mr-3 flex-shrink-0 h-6 w-6" xmlns="http://www.w3.org/2000/svg"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    {{ __('Dashboard') }}
                </a>

                <a href="{{ route('admin.forms.index') }}"
                   class="{{ 'forms'==$current ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'   }}  group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                    <!-- Heroicon name: outline/inbox -->
                    <svg class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                         aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                    {{ __('Forms') }}
                </a>

                <a href="{{ route('admin.responses.index') }}"
                   class="{{ 'responses'==$current ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'   }}  group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                    <!-- Heroicon name: outline/chart-bar -->
                    <svg class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                         aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    {{ __('Responses') }}
                </a>

                <a href="{{ route('admin.integrations.index') }}"
                   class="{{ 'integration'==$current ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'   }}  group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                    <!-- Heroicon name: outline/calendar -->
                    <svg class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                         aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    {{ __('Integrations') }}
                </a>

                @if(auth()->user()->not_admin)
                    <a href="{{ route('admin.subscriptions.index') }}"
                       class="{{ 'subscriptions'==$current ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'   }}  group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <!-- Heroicon name: outline/calendar -->
                        <svg class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                             aria-hidden="true">
                            <path d="M5 3a1 1 0 000 2c5.523 0 10 4.477 10 10a1 1 0 102 0C17 8.373 11.627 3 5 3z"/>
                            <path
                                d="M4 9a1 1 0 011-1 7 7 0 017 7 1 1 0 11-2 0 5 5 0 00-5-5 1 1 0 01-1-1zM3 15a2 2 0 114 0 2 2 0 01-4 0z"/>
                        </svg>
                        {{ __('Subscriptions') }}
                    </a>
                @endif

                <a href="{{ route('password.reset') }}"
                   class="{{ 'password-reset' == $current ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'   }}  group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                    <!-- Heroicon name: outline/calendar -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    {{ __('Account') }}
                </a>


            </nav>

            @if(auth()->user()->is_admin)
                <nav class="mt-2 pt-2 flex flex-col px-2 bg-white space-y-1 border-t border-gray-200 ">
                    <a href="{{ route('admin.packages.index') }}"
                       class="{{ 'packages'==$current ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'   }}  group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        {{ __('Packages') }}
                    </a>

                    <a href="{{ route('admin.users.index') }}"
                       class="{{ 'users'==$current ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'   }}  group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <!-- Heroicon name: outline/calendar -->
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        {{ __('Users') }}
                    </a>

                    <a href="{{ route('admin.invoices.index') }}"
                       class="{{ 'invoices'==$current ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'   }}  group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <!-- Heroicon name: outline/calendar -->
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        {{ __('Invoices') }}
                    </a>

                    <a href="{{ route('admin.envs.create') }}"
                       class="{{ 'envs' == $current ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'   }}  group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <!-- Heroicon name: outline/calendar -->
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        {{ __('Settings') }}
                    </a>

                </nav>
            @endif
        </div>

        <div class="flex-shrink-0 flex border-t border-gray-200 p-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-dropdown-link :href="route('logout')"
                                 onclick="event.preventDefault();
                                                this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
        </div>
    </div>
</div>
