<x-layout>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <span class="mx-auto text-4xl font-bold text-indigo-500 flex justify-center">EngageLearn</span>
            <h2 class="mt-6 text-center text-2xl font-bold leading-9 tracking-tight text-white">
                Create your account
            </h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="/register" method="POST">
                @csrf

                <x-form-field>
                    <x-form-label for="name">Name</x-form-label>
                    <x-form-input type="text" name="name" id="name" autocomplete="name" required />
                    <x-form-error name="name" />
                </x-form-field>

                <x-form-field>
                    <x-form-label for="email">Email address</x-form-label>
                    <x-form-input type="email" name="email" id="email" autocomplete="email" required />
                    <x-form-error name="email" />
                </x-form-field>

                <x-form-field>
                    <x-form-label for="password">Password</x-form-label>
                    <x-form-input type="password" name="password" id="password" required />
                    <x-form-error name="password" />
                </x-form-field>

                <x-form-field>
                    <x-form-label for="password_confirmation">Confirm Password</x-form-label>
                    <x-form-input type="password" name="password_confirmation" id="password_confirmation" required />
                    <x-form-error name="password_confirmation" />
                </x-form-field>
                
                <input type="hidden" name="role" value="user">

                <div>
                    <x-form-button class="w-full">Create Account</x-form-button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm text-gray-400">
                Already a member?
                <a href="/login" class="font-semibold leading-6 text-indigo-400 hover:text-indigo-300">
                    Sign in
                </a>
            </p>
        </div>
    </div>
</x-layout>