<x-layout>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <span class="mx-auto text-4xl font-bold text-indigo-500 flex justify-center">EngageLearn</span>
            <h2 class="mt-6 text-center text-2xl font-bold leading-9 tracking-tight text-white">
                Sign in to your account
            </h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="/login" method="POST">
                @csrf

                <x-form-field>
                    <x-form-label for="email">Email address</x-form-label>
                    <x-form-input type="email" name="email" id="email" autocomplete="email" required />
                    <x-form-error name="email" />
                </x-form-field>

                <x-form-field>
                    <div class="flex items-center justify-between">
                        <x-form-label for="password">Password</x-form-label>
                        <!-- <div class="text-sm">
                            <a href="#" class="font-semibold text-indigo-400 hover:text-indigo-300">Forgot password?</a>
                        </div> -->
                    </div>
                    <x-form-input type="password" name="password" id="password" autocomplete="current-password" required />
                    <x-form-error name="password" />
                </x-form-field>

                <div>
                    <x-form-button class="w-full">Sign in</x-form-button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm text-gray-400">
                Not a member?
                <a href="/register" class="font-semibold leading-6 text-indigo-400 hover:text-indigo-300">
                    Register for free
                </a>
            </p>
        </div>
    </div>
</x-layout>