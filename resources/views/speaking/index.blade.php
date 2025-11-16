<x-layout>
    <header class="relative bg-gray-800 after:pointer-events-none after:absolute after:inset-x-0 after:inset-y-0 after:border-y after:border-white/10">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-white">Speaking Practice</h1>
        </div>
    </header>
    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8"
             x-data="speechPractice()"
             x-init="initSpeech()">
            
            <div class="bg-gray-800 shadow-md rounded-lg p-6 lg:p-8 text-gray-300">
                <div x-show="!isSupported" class="bg-red-800 border border-red-700 text-red-200 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Speech Recognition Not Supported.</strong>
                    <span class="block sm:inline">Your browser does not support the Web Speech API. Please try Google Chrome or Edge.</span>
                </div>

                <div x-show="error" class="bg-red-800 border border-red-700 text-red-200 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">An error occurred:</strong>
                    <span class="block sm:inline" x-text="error"></span>
                </div>

                @forelse ($groupedPhrases as $category => $phrases)
                    <h2 class="text-2xl font-bold text-white mt-8 mb-4 border-b border-gray-700 pb-2">{{ ucfirst($category) }}</h2>
                    <div class="space-y-6">
                        @foreach ($phrases as $phrase)
                            <div class="bg-gray-700 p-4 rounded-lg flex flex-col md:flex-row md:items-center md:justify-between">
                                <div>
                                    <p class="text-lg text-white">{{ $phrase->phrase }}</p>
                                    <div x-show="transcription === '{{ $phrase->phrase }}'" class="mt-2" x-transition>
                                        <p class="text-green-400 font-semibold">Perfect Match!</p>
                                    </div>
                                    <div x-show="transcription && transcription !== '{{ $phrase->phrase }}' && activePhraseId === {{ $phrase->id }}" class="mt-2" x-transition>
                                        <p class_="text-gray-400">You said: "<span class="text-yellow-400" x-text="transcription"></span>"</p>
                                    </div>
                                </div>
                                <button @click="startRecording({{ $phrase->id }}, '{{ $phrase->phrase }}')" 
                                        :disabled="isRecording"
                                        class="mt-3 md:mt-0 md:ml-4 px-4 py-2 rounded-md text-sm font-medium text-white transition-colors duration-200"
                                        :class="{
                                            'bg-indigo-600 hover:bg-indigo-500': !isRecording,
                                            'bg-gray-500 cursor-not-allowed': isRecording,
                                            'bg-red-600 animate-pulse': isRecording && activePhraseId === {{ $phrase->id }}
                                        }">
                                    <span x-show="isRecording && activePhraseId === {{ $phrase->id }}">
                                        <i class="fas fa-microphone-alt mr-1"></i> Listening...
                                    </span>
                                    <span x-show="!isRecording || activePhraseId !== {{ $phrase->id }}">
                                        <i class="fas fa-microphone-alt mr-1"></i> Record
                                    </span>
                                </button>
                            </div>
                        @endforeach
                    </div>
                @empty
                    <div class="text-center bg-gray-800 p-6 rounded-lg shadow-md">
                        <p class="text-gray-300">The admin has not added any speaking phrases yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </main>

    <script>
        function speechPractice() {
            return {
                isSupported: false,
                isRecording: false,
                transcription: '',
                activePhraseId: null,
                error: '',
                recognition: null,

                initSpeech() {
                    const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
                    if (SpeechRecognition) {
                        this.isSupported = true;
                        this.recognition = new SpeechRecognition();
                        this.recognition.continuous = false;
                        this.recognition.lang = 'en-US';
                        this.recognition.interimResults = false;
                        this.recognition.maxAlternatives = 1;

                        this.recognition.onstart = () => {
                            this.isRecording = true;
                            this.transcription = '';
                            this.error = '';
                        };

                        this.recognition.onresult = (event) => {
                            this.transcription = event.results[0][0].transcript;
                        };

                        this.recognition.onerror = (event) => {
                            this.error = 'Speech recognition error: ' + event.error;
                            this.isRecording = false;
                            this.activePhraseId = null;
                        };

                        this.recognition.onend = () => {
                            this.isRecording = false;
                            this.activePhraseId = null;
                        };
                    } else {
                        this.isSupported = false;
                    }
                },

                startRecording(phraseId, phraseText) {
                    if (this.isRecording) return;
                    
                    this.activePhraseId = phraseId;
                    this.recognition.start();
                }
            }
        }
    </script>
</x-layout>