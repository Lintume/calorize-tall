<div
    x-data="diaryChat()"
    x-init="init()"
    class="fixed bottom-0 left-0 mb-4 ml-4 z-50"
    @transcription-ready.window="onTranscriptionReady($event.detail.text)"
    @transcription-error.window="onTranscriptionError($event.detail.message)"
>
    <!-- Floating Bubble (collapsed) - matches calorie counter style -->
    <button
        x-show="!open"
        @click="open = true"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-75"
        x-transition:enter-end="opacity-100 scale-100"
        class="w-20 h-20 rounded-full flex flex-col items-center justify-center text-white cursor-pointer transition-all duration-200"
        :class="{
            'animate-pulse': $wire.isProcessing,
            'bg-sky-600': true
        }"
        style="background-color: rgba(2, 132, 199, 0.75);"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
        </svg>
        <span class="text-xs font-bold mt-0.5">AI</span>
    </button>

    <!-- Chat Panel (expanded) -->
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 scale-95"
        class="w-[calc(100vw-2rem)] sm:w-96 bg-white rounded-2xl shadow-2xl border border-gray-300 flex flex-col overflow-hidden"
        style="max-height: min(70vh, 500px);"
        @click.outside="open = false"
    >
        <!-- Header -->
        <div class="px-4 py-3 bg-gradient-to-r from-amber-600 to-amber-700 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <span class="text-lg">🤖</span>
                <span class="font-medium text-white">{{ __('AI Assistant') }}</span>
            </div>
            <div class="flex items-center gap-2">
                <button
                    @click="$wire.clearChat()"
                    class="p-1.5 text-white/70 hover:text-white hover:bg-white/10 rounded-lg transition-colors"
                    title="{{ __('Clear chat') }}"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
                <button
                    @click="open = false"
                    class="p-1.5 text-white/70 hover:text-white hover:bg-white/10 rounded-lg transition-colors"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Messages -->
        <div
            x-ref="messagesContainer"
            class="flex-1 overflow-y-auto p-4 space-y-3 bg-gray-50"
            style="min-height: 200px;"
        >
            <!-- Welcome message if empty -->
            <template x-if="localMessages.length === 0">
                <div class="py-4 px-2">
                    <div class="text-center mb-4">
                        <div class="text-3xl mb-2">🤖</div>
                        <p class="text-sm font-medium text-gray-700">{{ __('AI Diary Assistant') }}</p>
                    </div>

                    <div class="space-y-2 text-xs text-gray-600">
                        <p class="font-medium text-gray-700">{{ __('I can help you:') }}</p>
                        <ul class="space-y-1.5 ml-2">
                            <li class="flex items-start gap-2">
                                <span class="text-green-500 mt-0.5">✓</span>
                                <span>{{ __('Add food to meals') }}</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-green-500 mt-0.5">✓</span>
                                <span>{{ __('Edit portions or delete items') }}</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-green-500 mt-0.5">✓</span>
                                <span>{{ __('Copy meals from other days') }}</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-green-500 mt-0.5">✓</span>
                                <span>{{ __('Search products or create new ones') }}</span>
                            </li>
                        </ul>
                    </div>

                    <div class="mt-4 p-3 bg-amber-50 rounded-xl text-xs">
                        <p class="font-medium text-amber-800 mb-2">{{ __('Examples:') }}</p>
                        <div class="space-y-1 text-amber-700">
                            <p>"{{ __('add apple to breakfast') }}"</p>
                            <p>"{{ __('200g chicken to lunch') }}"</p>
                            <p>"{{ __('copy yesterday dinner') }}"</p>
                            <p>"{{ __('add a banana to lunch') }}"</p>
                        </div>
                    </div>

                    <p class="text-center text-xs text-gray-400 mt-3">
                        🎤 {{ __('Type or use voice input') }}
                    </p>
                </div>
            </template>

            <!-- Message list -->
            <template x-for="(msg, index) in localMessages" :key="index">
                <div :class="(typeof msg !== 'undefined' && msg.role === 'user') ? 'flex justify-end' : 'flex justify-start'">
                    <!-- User message -->
                    <template x-if="typeof msg !== 'undefined' && msg.role === 'user'">
                        <div class="max-w-[85%] px-4 py-2.5 text-sm rounded-2xl rounded-br-md"
                             style="background-color: #d97706; color: white;">
                            <span class="whitespace-pre-line break-words" x-text="typeof msg !== 'undefined' ? msg.content : ''"></span>
                        </div>
                    </template>
                    <!-- Assistant message -->
                    <template x-if="typeof msg !== 'undefined' && msg.role === 'assistant'">
                        <div class="max-w-[85%] px-4 py-2.5 text-sm rounded-2xl rounded-bl-md shadow-sm border"
                             :class="(typeof msg !== 'undefined' && msg.error) ? 'border-red-200 bg-red-50 text-red-700' : 'border-gray-100 bg-white text-gray-800'">
                            <span class="whitespace-pre-line break-words" x-text="typeof msg !== 'undefined' ? msg.content : ''"></span>
                        </div>
                    </template>
                </div>
            </template>

            <!-- Processing indicator - shows during Livewire request -->
            <div wire:loading.flex wire:target="sendMessage" class="justify-start">
                <div class="bg-white text-gray-800 rounded-2xl rounded-bl-md shadow-sm border border-gray-100 px-4 py-3">
                    <div class="flex items-center gap-2">
                        <span class="text-xs text-gray-500 mr-1">{{ __('Thinking...') }}</span>
                        <div class="flex space-x-1">
                            <div class="w-2 h-2 bg-amber-500 rounded-full animate-bounce" style="animation-delay: 0ms;"></div>
                            <div class="w-2 h-2 bg-amber-500 rounded-full animate-bounce" style="animation-delay: 150ms;"></div>
                            <div class="w-2 h-2 bg-amber-500 rounded-full animate-bounce" style="animation-delay: 300ms;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Input Area -->
        <div class="p-3 bg-white border-t border-gray-100">
            <div class="flex items-center gap-2">
                <input
                    x-model="input"
                    @keydown.enter="send()"
                    type="text"
                    class="flex-1 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500"
                    :placeholder="recording ? '{{ __('Listening...') }}' : '{{ __('Type or speak...') }}'"
                    :disabled="recording || $wire.isProcessing"
                    x-ref="input"
                >

                <!-- Mic button -->
                <button
                    @click="toggleRecording()"
                    :disabled="$wire.isProcessing"
                    :class="{
                        'bg-red-500 hover:bg-red-600': recording,
                        'bg-gray-100 hover:bg-gray-200': !recording
                    }"
                    class="w-11 h-11 rounded-xl flex items-center justify-center transition-all duration-200 disabled:opacity-50"
                >
                    <template x-if="!recording">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" />
                        </svg>
                    </template>
                    <template x-if="recording">
                        <div class="flex items-center gap-0.5">
                            <div class="w-1 h-3 bg-white rounded-full animate-pulse"></div>
                            <div class="w-1 h-5 bg-white rounded-full animate-pulse" style="animation-delay: 100ms;"></div>
                            <div class="w-1 h-3 bg-white rounded-full animate-pulse" style="animation-delay: 200ms;"></div>
                        </div>
                    </template>
                </button>

                <!-- Send button -->
                <button
                    @click="send()"
                    :disabled="!input.trim() || $wire.isProcessing"
                    class="w-11 h-11 bg-amber-600 hover:bg-amber-700 rounded-xl flex items-center justify-center transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                </button>
            </div>

            <!-- Recording status -->
            <div x-show="recording" class="mt-2 text-center text-xs text-red-500 animate-pulse">
                {{ __('Recording... Tap mic to stop') }}
            </div>

            <!-- Current context hint -->
            <div class="mt-2 text-center text-xs text-gray-400">
                <span x-show="!$wire.activeMeal">{{ __('Date') }}: {{ $date }}</span>
                <span x-show="$wire.activeMeal" x-text="'{{ __('Adding to') }}: ' + $wire.activeMeal + ' ({{ $date }})'"></span>
            </div>
        </div>
    </div>
</div>

<script>
function diaryChat() {
    return {
        open: false,
        recording: false,
        input: '',
        mediaRecorder: null,
        audioChunks: [],
        localMessages: [],

        scrollToBottom() {
            this.$nextTick(() => {
                if (this.$refs.messagesContainer) {
                    this.$refs.messagesContainer.scrollTop = this.$refs.messagesContainer.scrollHeight;
                }
            });
        },

        cloneMessages(messages) {
            // Important: avoid referencing Livewire's reactive array directly,
            // otherwise optimistic pushes will mutate $wire.messages and cause duplicates.
            return JSON.parse(JSON.stringify(messages ?? []));
        },

        init() {
            // Keep a local (optimistic) copy so user messages show immediately,
            // even while the Livewire request is in-flight.
            this.localMessages = this.cloneMessages(this.$wire.messages);

            // Auto-scroll to bottom when messages change
            this.$watch('$wire.messages', (value) => {
                this.localMessages = this.cloneMessages(value);
                this.scrollToBottom();
            });

            // Focus input when panel opens
            this.$watch('open', (value) => {
                if (value) {
                    this.$nextTick(() => {
                        this.$refs.input?.focus();
                    });
                }
            });
        },

        async toggleRecording() {
            if (this.recording) {
                this.stopRecording();
            } else {
                await this.startRecording();
            }
        },

        async startRecording() {
            try {
                // getUserMedia is only available in a secure context (HTTPS or localhost)
                if (typeof window !== 'undefined' && window.isSecureContext === false) {
                    alert("Voice recording requires HTTPS (or localhost). Please open the app via https:// or on localhost.");
                    return;
                }

                if (!navigator?.mediaDevices?.getUserMedia) {
                    alert("Your browser/environment doesn't support microphone access (navigator.mediaDevices.getUserMedia is unavailable). Try Chrome/Safari and make sure you're on HTTPS (or localhost).");
                    return;
                }

                if (typeof MediaRecorder === 'undefined') {
                    alert("Your browser doesn't support audio recording (MediaRecorder API is unavailable). Try a modern browser like Chrome.");
                    return;
                }

                const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
                const preferredMimeType = 'audio/webm;codecs=opus';
                const options = (typeof MediaRecorder !== 'undefined' && MediaRecorder.isTypeSupported?.(preferredMimeType))
                    ? { mimeType: preferredMimeType }
                    : {};

                this.mediaRecorder = new MediaRecorder(stream, options);
                this.audioChunks = [];

                this.mediaRecorder.ondataavailable = (event) => {
                    if (event.data.size > 0) {
                        this.audioChunks.push(event.data);
                    }
                };

                this.mediaRecorder.onstop = async () => {
                    const audioBlob = new Blob(this.audioChunks, { type: 'audio/webm' });
                    const base64 = await this.blobToBase64(audioBlob);
                    this.$wire.processAudio(base64);

                    // Stop all tracks
                    stream.getTracks().forEach(track => track.stop());
                };

                this.mediaRecorder.start();
                this.recording = true;
            } catch (error) {
                console.error('Error starting recording:', error);
                alert("{{ __('Could not access microphone. Please check permissions.') }}");
            }
        },

        stopRecording() {
            if (this.mediaRecorder && this.recording) {
                this.mediaRecorder.stop();
                this.recording = false;
            }
        },

        blobToBase64(blob) {
            return new Promise((resolve, reject) => {
                const reader = new FileReader();
                reader.onloadend = () => {
                    const base64 = reader.result.split(',')[1];
                    resolve(base64);
                };
                reader.onerror = reject;
                reader.readAsDataURL(blob);
            });
        },

        send() {
            if (!this.input.trim() || this.$wire.isProcessing) return;

            const messageText = this.input;
            this.input = '';

            // Optimistically show the user's message immediately
            this.localMessages = this.localMessages ?? [];
            this.localMessages.push({
                role: 'user',
                content: messageText,
                timestamp: new Date().toISOString(),
            });

            // Scroll immediately so the bottom area (where "Thinking..." appears) is visible.
            // Then repeat a few times to catch Livewire's wire:loading toggle timing.
            this.scrollToBottom();

            this.$wire.sendMessage(messageText);

            setTimeout(() => this.scrollToBottom(), 0);
            setTimeout(() => this.scrollToBottom(), 50);
            setTimeout(() => this.scrollToBottom(), 150);
            setTimeout(() => this.scrollToBottom(), 300);
        },

        onTranscriptionReady(text) {
            // Put transcription in input for editing before sending
            this.input = text;
            this.$refs.input?.focus();
        },

        onTranscriptionError(message) {
            alert(message);
        }
    }
}
</script>

