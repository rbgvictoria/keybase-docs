<aside class="lg:col-span-1 h-full">
    {{-- Mobile Toggle for Sidebar --}}
    <button id="sidebar-toggle" class="flex items-center justify-between w-full px-4 py-3 mb-2 bg-white border border-gray-200 rounded-xl lg:hidden dark:bg-black dark:border-gray-700">
        <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">Documentation Menu</span>
        <svg id="sidebar-arrow" class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
    </button>

    {{-- The Sidebar Content --}}
    <nav id="sidebar-menu" class="hidden lg:block sticky top-20 pt-1.75"> {{-- Adds stickiness below the header --}}
        <div class="bg-white border border-gray-200 rounded-xl p-6 pt-8 dark:border-gray-700 dark:bg-black">
            <div class="mb-8">
              @include('_nav.sidebar-links')
            </div>

        </div>
    </nav>
</aside>
