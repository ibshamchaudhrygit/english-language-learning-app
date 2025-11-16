<x-layout>
    <header class="relative bg-gray-800 after:pointer-events-none after:absolute after:inset-x-0 after:inset-y-0 after:border-y after:border-white/10">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-white">Chat with {{ $recipient->name }}</h1>
        </div>
    </header>
    <main>
        <div class="mx-auto max-w-3xl px-4 py-6 sm:px-6 lg:px-8"
             x-data="chat({{ $recipient->id }})"
             x-init="init();">
            
            <!-- Chat Messages Window -->
            <div class="bg-gray-800 shadow-md rounded-lg p-6 h-[60vh] flex flex-col space-y-4 overflow-y-auto" x-ref="messages">
                @forelse ($messages as $message)
                    <div class="flex {{ $message->sender_id == Auth::id() ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-xs lg:max-w-md p-3 rounded-lg {{ $message->sender_id == Auth::id() ? 'bg-indigo-600 text-white' : 'bg-gray-700 text-gray-200' }}">
                            <p>{{ $message->message }}</p>
                            <span class="text-xs {{ $message->sender_id == Auth::id() ? 'text-indigo-200' : 'text-gray-400' }} mt-1 block text-right">{{ $message->created_at->format('h:i A') }}</span>
                        </div>
                    </div>
                @empty
                    <div class="flex justify-center items-center h-full">
                        <p class="text-gray-400">No messages yet. Say hello!</p>
                    </div>
                @endforelse
            </div>

            <!-- Message Input Form -->
            <form method="POST" action="/chat/{{ $recipient->id }}" class="mt-4">
                @csrf
                <div class="flex space-x-2">
                    <input type="text" name="message" class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Type your message..." required>
                    <x-form-button class="h-full">Send</x-form-button>
                </div>
            </form>
        </div>
    </main>

    <script>
        function chat(recipientId) {
            return {
                recipientId: recipientId,
                
                init() {
                    this.scrollToBottom();
                    
                    // Poll for new messages every 5 seconds
                    setInterval(() => {
                        this.fetchNewMessages();
                    }, 5000);
                },

                scrollToBottom() {
                    this.$refs.messages.scrollTop = this.$refs.messages.scrollHeight;
                },

                fetchNewMessages() {
                    fetch(`/api/chat/${this.recipientId}/fetch`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.messages && data.messages.length > 0) {
                                data.messages.forEach(message => {
                                    this.appendMessage(message);
                                });
                                this.scrollToBottom();
                            }
                        })
                        .catch(error => console.error('Error fetching messages:', error));
                },

                appendMessage(message) {
                    const messageEl = document.createElement('div');
                    messageEl.classList.add('flex', 'justify-start'); // New messages are always from receiver
                    
                    const messageBox = document.createElement('div');
                    messageBox.classList.add('max-w-xs', 'lg:max-w-md', 'p-3', 'rounded-lg', 'bg-gray-700', 'text-gray-200');
                    
                    const textEl = document.createElement('p');
                    textEl.textContent = message.message;
                    
                    const timeEl = document.createElement('span');
                    timeEl.classList.add('text-xs', 'text-gray-400', 'mt-1', 'block', 'text-right');
                    timeEl.textContent = new Date(message.created_at).toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true });

                    messageBox.appendChild(textEl);
                    messageBox.appendChild(timeEl);
                    messageEl.appendChild(messageBox);
                    
                    this.$refs.messages.appendChild(messageEl);
                }
            }
        }
    </script>
</x-layout>