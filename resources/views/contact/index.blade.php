<x-layout>
    <header class="relative bg-gray-800 after:pointer-events-none after:absolute after:inset-x-0 after:inset-y-0 after:border-y after:border-white/10">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-white">Contact Us</h1>
        </div>
    </header>
    <main>
        <div class="mx-auto max-w-3xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="bg-gray-800 rounded-lg shadow-md p-6">
                <p class="text-gray-300 mb-6">Have a question or feedback? We'd love to hear from you. Fill out the form below and we'll get back to you as soon as possible.</p>
                <!-- Form action is a placeholder, you'll need a controller to handle this -->
                <form action="#" method="POST" class="space-y-6">
                    @csrf
                    <x-form-field>
                        <x-form-label for="name">Your Name</x-form-label>
                        <x-form-input type="text" name="name" id="name" required />
                    </x-form-field>
                    <x-form-field>
                        <x-form-label for="email">Your Email</x-form-label>
                        <x-form-input type="email" name="email" id="email" required />
                    </x-form-field>
                    <x-form-field>
                        <x-form-label for="subject">Subject</x-form-label>
                        <x-form-input type="text" name="subject" id="subject" required />
                    </x-form-field>
                    <x-form-field>
                        <x-form-label for="message">Message</x-form-label>
                        <x-form-textarea name="message" id="message" rows="6" required></x-form-textarea>
                    </x-form-field>
                    <div class="flex justify-end">
                        <x-form-button>Send Message</x-form-button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</x-layout>