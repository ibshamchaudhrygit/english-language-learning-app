<!doctype html>
<html lang="en" class="h-full bg-gray-900 text-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EnglishQuest</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-full bg-gray-900 text-gray-100">
<div class="min-h-full">

    <!-- Navbar -->
    <nav class="bg-black-800 border-b border-gray-700">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">

                <!-- Left side -->
                <div class="flex items-center">
                    <div class="shrink-0">
                        <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500"
                             alt="Logo" class="size-8" />
                    </div>
                    <div class="hidden md:block">
                            <div class="ml-10 flex items-baseline space-x-4">
                                @auth
                                    @if(Auth::user()->role === "admin")
                                        <x-link href="/admin" :active="request()->is('admin')"> Admin Panel </x-link>
                                    @elseif(Auth::user()->role === "user")
                                <x-link href="/lessons" :active="request()->is('lessons')"> Lessons </x-link>
                                <x-link href="/performance" :active="request()->is('performance')"> Performance </x-link>
                                    @elseif(Auth::user()->role === "teacher")
                                        <x-link href="/teacher" :active="request()->is('teacher')"> Teacher Panel </x-link>
                                    @endif
                                @endauth
                            </div>
                    </div>
                </div>

                <!-- Right side -->
                <div class="hidden md:block">
                    <div class="ml-4 flex items-center md:ml-6">
                        @guest
                            <x-link href="/login" :active="request()->is('login')">Login</x-link>
                            <x-link href="/register" :active="request()->is('register')">Register</x-link>
                        @endguest
                        @auth
                            <form method="POST" action="/logout">
                                @csrf
                                <x-form-field>
                                    <x-form-button type="submit">Logout</x-form-button>
                                </x-form-field>
                            </form>
                        @endauth
                    </div>
                </div>

                <!-- Mobile menu button -->
                <div class="-mr-2 flex md:hidden">
                    <button type="button" command="--toggle" commandfor="mobile-menu"
                            class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-300 hover:bg-gray-700 hover:text-white focus:outline-2 focus:outline-offset-2 focus:outline-indigo-500">
                        <span class="absolute -inset-0.5"></span>
                        <span class="sr-only">Open main menu</span>
                        <!-- Hamburger -->
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                             aria-hidden="true" class="size-6 in-aria-expanded:hidden">
                            <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
                                  stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <!-- Close -->
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                             aria-hidden="true" class="size-6 not-in-aria-expanded:hidden">
                            <path d="M6 18 18 6M6 6l12 12"
                                  stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <el-disclosure id="mobile-menu" hidden class="block md:hidden bg-gray-800 border-t border-gray-700">
            <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
                <a href="#" aria-current="page"
                   class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white">
                    Dashboard
                </a>
                <a href="#"
                   class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">
                    Team
                </a>
                <a href="#"
                   class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">
                    Projects
                </a>
            </div>
            <div class="border-t border-gray-700 pt-4 pb-3">
                <div class="flex items-center px-5">
                    <div class="shrink-0">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?
                ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                             alt="" class="size-10 rounded-full outline -outline-offset-1 outline-gray-600" />
                    </div>
                    <div class="ml-3">
                        <div class="text-base font-medium text-white">Tom Cook</div>
                        <div class="text-sm font-medium text-gray-400">tom@example.com</div>
                    </div>
                </div>
            </div>
        </el-disclosure>
    </nav>

    <!-- Header -->
    <header class="relative bg-gray-800 shadow-sm border-b border-gray-700">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 sm:flex sm:justify-between">
            <h1 class="text-3xl font-bold tracking-tight text-white">{{$heading}}</h1>
            @auth
                @if(Auth::user()->role === "admin")
                <x-button href="/admin/content/create">Create a new Lesson</x-button>
                @endif
            @endauth
        </div>
    </header>

    <!-- Main content -->
    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            {{ $slot }}
        </div>
    </main>
</div>
</body>
</html>
