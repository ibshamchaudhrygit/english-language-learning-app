<x-layout>
    <x-slot:heading>
        Register a User
    </x-slot:heading>

    <form method="POST" action="/register">
        @csrf
        <div class="space-y-12">
            <div class="border-b border-gray-700 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-100">Register New User</h2>

                <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                    <!-- Firstname -->
                    <x-form-field class="sm:col-span-3">
                        <x-form-label for="name">Name</x-form-label>
                        <div class="mt-2">
                            <x-form-input placeholder="Enter your Name"
                                          required id="name" name="name" />
                            <x-form-error name="name"/>
                        </div>
                    </x-form-field>

                    <!-- Email -->
                    <x-form-field class="sm:col-span-6">
                        <x-form-label for="email">Email</x-form-label>
                        <div class="mt-2">
                            <x-form-input placeholder="Enter Your Email"
                                          type="email" required id="email" name="email" />
                            <x-form-error name="email"/>
                        </div>
                    </x-form-field>

                    <!-- Password -->
                    <x-form-field class="sm:col-span-3">
                        <x-form-label for="password">Password</x-form-label>
                        <div class="mt-2">
                            <x-form-input type="password" required id="password"
                                          name="password"
                                          placeholder="Enter a secure password"/>
                            <x-form-error name="password"/>
                        </div>
                    </x-form-field>

                    <!-- Confirm Password -->
                    <x-form-field class="sm:col-span-3">
                        <x-form-label for="password_confirmation">Confirm Password</x-form-label>
                        <div class="mt-2">
                            <x-form-input type="password" required id="password_confirmation"
                                          name="password_confirmation"
                                          placeholder="Confirm your password"/>
                            <x-form-error name="password_confirmation"/>
                        </div>
                    </x-form-field>

                    <!-- Role -->
                    <x-form-field class="sm:col-span-6">
                        <x-form-label for="role">Role</x-form-label>
                        <div class="mt-2">
                            <select id="role" name="role"
                                    class="block w-full rounded-md border-0 bg-gray-800 text-gray-100 shadow-sm ring-1 ring-inset ring-gray-600 focus:ring-2 focus:ring-indigo-500 sm:text-sm/6">
                                <option value="user">User</option>
                                <option value="teacher">Teacher</option>
                                <option value="admin">Admin</option>
                            </select>
                            <x-form-error name="role"/>
                        </div>
                    </x-form-field>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="mt-6 flex items-center justify-end gap-x-6">
            <x-form-button type="submit">Register</x-form-button>
        </div>
    </form>
</x-layout>
