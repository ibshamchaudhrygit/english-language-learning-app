<!DOCTYPE html>
<!-- UPDATED: Added h-full and bg-gray-900 -->
<html lang="en" class="h-full bg-gray-900">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>English Learning App</title>
    
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <!-- ADDED: Included the @tailwindplus/elements script you were using -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<!-- UPDATED: Added h-full and bg-gray-900 -->
<body class="h-full bg-gray-900 font-sans">
<div class="min-h-full">
    <!-- UPDATED: Changed to dark mode navbar -->
    <nav class="bg-gray-800" x-data="{ open: false }">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <div class="flex items-center">
                    <div class="shrink-0">
                        <a href="/">
                            <!-- UPDATED: Logo text color -->
                            <span class="text-2xl font-bold text-indigo-500">EngageLearn</span>
                        </a>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            <!-- Links are now handled by the updated x-link component -->
                            <x-link href="/lessons" :active="request()->is('lessons')">Lessons</x-link>
                            <x-link href="/messages" :active="request()->is('messages*')">Forum</x-link>
                            <x-link href="/leaderboard" :active="request()->is('leaderboard')">Leaderboard</x-link>
                            
                            @auth
                            <x-link href="/performance" :active="request()->is('performance')">Performance</x-link>
                            <x-link href="/my-badges" :active="request()->is('my-badges')">My Badges</x-link>
                            <x-link href="/certificates" :active="request()->is('certificates*')">My Certificates</x-link>
                            @endauth

                            <x-link href="/contact" :active="request()->is('contact')">Contact</x-link>
                        </div>
                    </div>
                </div>

                <!-- Right Side Of Navbar -->
                <div class="hidden md:flex md:items-center md:ml-6">
                    @guest
                        <div class="flex items-baseline space-x-4">
                            <x-link href="/login" :active="request()->is('login')">Login</x-link>
                            <x-link href="/register" :active="request()->is('register')">Register</x-link>
                        </div>
                    @else
                        <!-- Logged in user dropdown -->
                        <div x-data="{ dropdownOpen: false }" class="relative ml-3">
                            <button @click="dropdownOpen = !dropdownOpen" class="flex max-w-xs items-center rounded-full bg-gray-800 text-sm text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                                <span class="sr-only">Open user menu</span>
                                <!-- TODO: Add user avatar field -->
                                <img class="h-8 w-8 rounded-full" src="https://placehold.co/256x256/E0E7FF/4F46E5?text={{ substr(Auth::user()->name, 0, 1) }}" alt="">
                            </button>

                            <!-- Dropdown Menu -->
                            <div x-show="dropdownOpen" 
                                 @click.away="dropdownOpen = false"
                                 class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                 x-transition>
                                
                                <!-- UPDATED: Dropdown links text color to gray-700 -->
                                @if(Auth::user()->role == 'admin')
                                    <a href="/admin" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Admin Panel</a>
                                @endif
                                @if(Auth::user()->role == 'teacher')
                                    <a href="/teacher" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Teacher Panel</a>
                                @endif

                                <form method="POST" action="/logout">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Log Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>

                <!-- Hamburger -->
                <div class="-mr-2 flex md:hidden">
                    <button @click="open = ! open" class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="absolute -inset-0.5"></span>
                        <span class="sr-only">Open main menu</span>
                        <svg :class="{'hidden': open, 'block': ! open }" class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        <svg :class="{'hidden': ! open, 'block': open }" class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div x-show="open" class="md:hidden" id="mobile-menu">
            <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
                <x-link href="/lessons" :active="request()->is('lessons')" :responsive="true">Lessons</x-link>
                <x-link href="/messages" :active="request()->is('messages*')" :responsive="true">Forum</x-link>
                <x-link href="/leaderboard" :active="request()->is('leaderboard')" :responsive="true">Leaderboard</x-link>
                @auth
                    <x-link href="/performance" :active="request()->is('performance')" :responsive="true">Performance</x-link>
                    <x-link href="/my-badges" :active="request()->is('my-badges')" :responsive="true">My Badges</x-link>
                    <x-link href="/certificates" :active="request()->is('certificates*')" :responsive="true">My Certificates</x-link>
                @endauth
                <x-link href="/contact" :active="request()->is('contact')" :responsive="true">Contact</x-link>
            </div>

            <!-- Responsive Settings Options -->
            <div class="border-t border-gray-700 pt-4 pb-3">
                @guest
                    <div class="space-y-1 px-2">
                        <x-link href="/login" :active="request()->is('login')" :responsive="true">Login</x-link>
                        <x-link href="/register" :active="request()->is('register')" :responsive="true">Register</x-link>
                    </div>
                @else
                    <div class="flex items-center px-5">
                        <div class="shrink-0">
                            <img class="h-10 w-10 rounded-full" src="https://placehold.co/256x256/E0E7FF/4F46E5?text={{ substr(Auth::user()->name, 0, 1) }}" alt="">
                        </div>
                        <div class="ml-3">
                            <div class="text-base font-medium text-white">{{ Auth::user()->name }}</div>
                            <div class="text-sm font-medium text-gray-400">{{ Auth::user()->email }}</div>
                        </div>
                    </div>
                    <div class="mt-3 space-y-1 px-2">
                        @if(Auth::user()->role == 'admin')
                            <x-link href="/admin" :responsive="true">Admin Panel</x-link>
                        @endif
                        @if(Auth::user()->role == 'teacher')
                             <x-link href="/teacher" :responsive="true">Teacher Panel</x-link>
                        @endif
                        
                        <!-- Authentication -->
                        <form method="POST" action="/logout">
                            @csrf
                            <a href="/logout"
                               onclick="event.preventDefault(); this.closest('form').submit();"
                               class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white"
                            >
                                Log Out
                            </a>
                        </form>
                    </div>
                @endguest
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="min-h-screen">
        <!-- UPDATED: Removed bg-gray-100, content will sit on bg-gray-900 -->
        {{ $slot }}
    </main>

    <!-- UPDATED: Footer for dark mode -->
    <footer class="bg-gray-800 shadow-inner mt-16 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-gray-400">
            &copy; {{ date('Y') }} EngageLearn. All rights reserved.
        </div>
    </footer>

    <!-- Flash Message -->
    @if (session('success'))
        <div x-data="{ show: true }"
             x-init="setTimeout(() => show = false, 4000)"
             x-show="show"
             x-transition
             class="fixed bottom-5 right-5 bg-indigo-600 text-white py-2 px-4 rounded-lg shadow-lg z-50">
            <p>{{ session('success') }}</p>
        </div>
    @endif
</div> <!-- End min-h-full -->
</body>
</html>