<div id="user-auth-container" class="relative">
    {{-- Guest State --}}
    <a id="guest-login-link" href="/admin/login"
        class="flex items-center space-x-2 rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700 w-fit">
        <img src="https://orcid.org/assets/vectors/orcid.logo.icon.svg" alt="ORCID" class="h-4 w-4" />
        <span>Login with ORCID</span>
    </a>

    {{-- Auth State --}}
    <div id="auth-user-menu" class="hidden">
        {{-- Desktop Dropdown Version --}}
        <div class="hidden md:block">
            <button type="button" id="user-menu-button"
                class="flex rounded-full border-2 border-transparent transition hover:border-green-200 focus:outline-none">
                <div id="user-initials"
                    class="flex h-9 w-9 items-center justify-center rounded-full bg-emerald-100 text-emerald-700 font-semibold text-sm">
                </div>
            </button>

            <div id="user-dropdown"
                class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-lg border border-gray-300 bg-white shadow-lg overflow-hidden dark:bg-black dark:border-gray-700">
                <div class="px-4 py-2 rounded-t-lg border-b border-gray-100 bg-transparent dark:border-gray-700">
                    <p id="user-name" class="text-sm font-medium text-gray-900 dark:text-white">Botanical User</p>
                    <p id="user-email" class="text-xs text-gray-500 truncate dark:text-gray-400">user@keybase.test</p>
                </div>

                <div class="py-1">
                    <a href="/admin"
                        class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 bg-transparent">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="mr-2 h-4 w-4">
                            <rect width="7" height="9" x="3" y="3" rx="1"></rect>
                            <rect width="7" height="5" x="14" y="3" rx="1"></rect>
                            <rect width="7" height="9" x="14" y="12" rx="1"></rect>
                            <rect width="7" height="5" x="3" y="16" rx="1"></rect>
                        </svg>
                        <span>Dashboard</span>
                    </a>

                    <div class="h-px bg-gray-100 dark:bg-gray-700 my-1"></div>

                    <a href="/auth/logout-redirect"
                        class="flex items-center rounded-b-lg px-4 py-2 text-sm text-red-600 bg-transparent">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="mr-2 h-4 w-4">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" x2="9" y1="12" y2="12"></line>
                        </svg>
                        <span>Log out</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- Mobile "Exploded" Version --}}
        <div class="md:hidden space-y-4">
            <div class="flex items-center space-x-3 px-2">
                <div id="user-initials-mobile"
                    class="h-10 w-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 font-bold dark:bg-emerald-900 dark:text-emerald-100">
                </div>
                <div>
                    <p id="user-name-mobile" class="text-sm font-bold text-gray-900 dark:text-white"></p>
                    <p id="user-email-mobile" class="text-xs text-gray-500 dark:text-gray-400"></p>
                </div>
            </div>
            <div class="flex flex-col space-y-1">
                <a href="/admin" class="flex items-center p-2 text-gray-600 dark:text-gray-300">
                    Dashboard
                </a>
                <a href="/auth/logout-redirect" class="flex w-full items-center p-2 text-red-500">
                    Log out
                </a>
            </div>
        </div>
    </div>
</div>
