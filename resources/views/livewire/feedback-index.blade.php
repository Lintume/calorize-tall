<div x-data="{
    showForm: @entangle('showForm'),
    viewingIssue: @entangle('viewingIssue'),
    closeIssue() {
        // Instant close via Alpine, then sync with Livewire
        this.viewingIssue = null;
        $wire.closeIssueView();
    }
}" class="py-8 sm:py-10 lg:py-12 bg-stone-50" x-cloak>

    @section('title', __('feedback.title'))

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        {{-- Success message --}}
        @if($successMessage)
            <div x-data="{ show: true }"
                 x-show="show"
                 x-init="setTimeout(() => { show = false; $wire.clearSuccess() }, 5000)"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="bg-emerald-600 text-white p-4 rounded-xl shadow-lg flex items-center gap-3">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                <span>{{ $successMessage }}</span>
            </div>
        @endif

    <div class="space-y-6">

        {{-- Header Card --}}
        <div class="relative overflow-hidden rounded-[1.5rem] border border-stone-200 bg-white shadow-xl shadow-stone-900/5">
            <div class="absolute inset-0 bg-[radial-gradient(900px_circle_at_10%_-20%,rgba(245,158,11,0.12),transparent_55%),radial-gradient(600px_circle_at_90%_-10%,rgba(14,165,233,0.12),transparent_55%)]"></div>
            <div class="relative p-6 sm:p-7 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-start gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center text-white shadow-lg shadow-amber-600/25">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                        </svg>
                    </div>
                    <div class="space-y-1">
                        <h1 class="text-xl sm:text-2xl font-extrabold text-stone-900">{{ __('feedback.title') }}</h1>
                        <p class="text-sm text-stone-600">{{ __('feedback.subtitle') }}</p>
                    </div>
                </div>
                <button @click="showForm = true"
                        class="inline-flex items-center justify-center gap-2 h-11 px-5 rounded-xl bg-gradient-to-r from-amber-600 to-amber-700 text-sm font-semibold text-white shadow-lg shadow-amber-700/20 hover:from-amber-700 hover:to-amber-800 active:scale-[0.99] transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    {{ __('feedback.new_request') }}
                </button>
            </div>
        </div>

        {{-- How it works (compact) --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 sm:gap-4">
            <div class="rounded-[1.25rem] border border-stone-200 bg-white/90 backdrop-blur p-5 shadow-sm">
                <div class="flex items-start gap-3">
                    <div class="h-10 w-10 rounded-2xl bg-amber-500/10 text-amber-700 border border-amber-200 grid place-items-center shrink-0">
                        <i class="fas fa-pen-to-square text-sm"></i>
                    </div>
                    <div>
                        <div class="text-sm font-extrabold text-stone-900">{{ __('feedback.how_1_title') }}</div>
                        <div class="mt-1 text-sm text-stone-600">{{ __('feedback.how_1_text') }}</div>
                    </div>
                </div>
            </div>
            <div class="rounded-[1.25rem] border border-stone-200 bg-white/90 backdrop-blur p-5 shadow-sm">
                <div class="flex items-start gap-3">
                    <div class="h-10 w-10 rounded-2xl bg-sky-500/10 text-sky-700 border border-sky-200 grid place-items-center shrink-0">
                        <i class="fas fa-inbox text-sm"></i>
                    </div>
                    <div>
                        <div class="text-sm font-extrabold text-stone-900">{{ __('feedback.how_2_title') }}</div>
                        <div class="mt-1 text-sm text-stone-600">{{ __('feedback.how_2_text') }}</div>
                    </div>
                </div>
            </div>
            <div class="rounded-[1.25rem] border border-stone-200 bg-white/90 backdrop-blur p-5 shadow-sm">
                <div class="flex items-start gap-3">
                    <div class="h-10 w-10 rounded-2xl bg-emerald-500/10 text-emerald-700 border border-emerald-200 grid place-items-center shrink-0">
                        <i class="fas fa-check text-sm"></i>
                    </div>
                    <div>
                        <div class="text-sm font-extrabold text-stone-900">{{ __('feedback.how_3_title') }}</div>
                        <div class="mt-1 text-sm text-stone-600">{{ __('feedback.how_3_text') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-2 text-[11px] font-semibold text-stone-700">
            <span class="inline-flex items-center gap-2 rounded-xl border border-stone-200 bg-white/80 px-3 py-1.5">
                <i class="fas fa-shield-halved text-stone-500"></i>{{ __('feedback.note_privacy') }}
            </span>
            <span class="inline-flex items-center gap-2 rounded-xl border border-stone-200 bg-white/80 px-3 py-1.5">
                <i class="fas fa-clock text-stone-500"></i>{{ __('feedback.note_time') }}
            </span>
        </div>

        {{-- Not Configured Warning --}}
        @if(!$isConfigured)
            <div class="bg-amber-50 border border-amber-200 rounded-2xl p-6">
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-medium text-amber-800">{{ __('feedback.not_configured_title') }}</h3>
                        <p class="text-sm text-amber-700 mt-1">{{ __('feedback.not_configured_description') }}</p>
                    </div>
                </div>
            </div>
        @endif

        {{-- Issues List --}}
        <div class="bg-white rounded-[1.5rem] border border-stone-200 shadow-lg shadow-stone-900/5 overflow-hidden" @if(!$isConfigured) style="opacity: 0.5; pointer-events: none;" @endif>
            <div class="px-5 py-4 border-b border-stone-100 bg-white/80 backdrop-blur">
                <div class="flex items-center gap-2">
                    <div class="w-9 h-9 rounded-xl bg-stone-100 flex items-center justify-center">
                        <svg class="w-4.5 h-4.5 text-stone-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <h2 class="font-semibold text-stone-800">{{ __('feedback.my_requests') }}</h2>
                    @if($issues['total'] > 0)
                        <span class="ml-2 px-2.5 py-0.5 text-xs font-medium bg-stone-200 text-stone-700 rounded-full">
                            {{ $issues['total'] }}
                        </span>
                    @endif
                </div>
            </div>

            <div class="divide-y divide-stone-100">
                {{-- Loading state --}}
                @if($loadingIssues)
                    <div class="p-12 text-center">
                        <svg class="animate-spin h-8 w-8 mx-auto text-amber-500" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                @else
                @forelse($issues['issues'] as $issue)
                    <div wire:click="viewIssue({{ $issue['number'] }})"
                         class="p-5 hover:bg-stone-50/80 cursor-pointer transition-colors group">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-1">
                                    {{-- Type badge --}}
                                    @if($issue['type'] === 'bug')
                                        <span class="px-2 py-0.5 text-xs font-medium bg-red-100 text-red-700 rounded-full">
                                            {{ __('feedback.type_bug') }}
                                        </span>
                                    @elseif($issue['type'] === 'feature')
                                        <span class="px-2 py-0.5 text-xs font-medium bg-purple-100 text-purple-700 rounded-full">
                                            {{ __('feedback.type_feature') }}
                                        </span>
                                    @else
                                        <span class="px-2 py-0.5 text-xs font-medium bg-blue-100 text-blue-700 rounded-full">
                                            {{ __('feedback.type_question') }}
                                        </span>
                                    @endif

                                    {{-- Status badge --}}
                                    @if($issue['state'] === 'closed' || $issue['status'] === 'closed')
                                        <span class="px-2 py-0.5 text-xs font-medium bg-emerald-100 text-emerald-700 rounded-full">
                                            {{ $issue['project_status'] ?? __('feedback.status_closed') }}
                                        </span>
                                    @elseif($issue['status'] === 'in_progress')
                                        <span class="px-2 py-0.5 text-xs font-medium bg-amber-100 text-amber-700 rounded-full">
                                            {{ $issue['project_status'] ?? __('feedback.status_in_progress') }}
                                        </span>
                                    @else
                                        <span class="px-2 py-0.5 text-xs font-medium bg-stone-100 text-stone-600 rounded-full">
                                            {{ $issue['project_status'] ?? __('feedback.status_open') }}
                                        </span>
                                    @endif
                                </div>

                                <h3 class="font-medium text-stone-800 truncate">#{{ $issue['number'] }}: {{ $issue['title'] }}</h3>

                                <p class="text-sm text-stone-500 mt-1 line-clamp-2">{{ Str::limit($issue['body'], 150) }}</p>

                                <div class="flex items-center gap-4 mt-2 text-xs text-stone-400">
                                    <span>{{ \Carbon\Carbon::parse($issue['created_at'])->diffForHumans() }}</span>
                                    @if($issue['comments_count'] > 0)
                                        <span class="flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                            </svg>
                                            {{ $issue['comments_count'] }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{-- Loading spinner when clicking --}}
                            <svg wire:loading wire:target="viewIssue({{ $issue['number'] }})" class="animate-spin w-5 h-5 text-amber-500 flex-shrink-0" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <svg wire:loading.remove wire:target="viewIssue({{ $issue['number'] }})" class="w-5 h-5 text-stone-300 flex-shrink-0 group-hover:text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </div>
                @empty
                    <div class="p-12 text-center">
                        <div class="w-16 h-16 mx-auto rounded-full bg-stone-100 flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                            </svg>
                        </div>
                        <h3 class="font-medium text-stone-700 mb-1">{{ __('feedback.no_requests') }}</h3>
                        <p class="text-sm text-stone-500 mb-4">{{ __('feedback.no_requests_hint') }}</p>
                        <button @click="showForm = true"
                                class="px-4 py-2 text-sm font-medium text-amber-600 hover:text-amber-700 hover:bg-amber-50 rounded-lg transition-colors">
                            {{ __('feedback.create_first') }}
                        </button>
                    </div>
                @endforelse
                @endif
            </div>
        </div>

    </div>

    {{-- Create Form Modal --}}
    <div x-show="showForm"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 overflow-y-auto"
         style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-stone-500/75" @click="showForm = false"></div>

            <div x-show="showForm"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="relative z-10 w-full max-w-lg p-6 mx-auto bg-white rounded-2xl shadow-xl">

                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-semibold text-stone-800">{{ __('feedback.new_request') }}</h2>
                    <button @click="showForm = false" class="p-1 text-stone-400 hover:text-stone-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                @if($errorMessage)
                    <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm">
                        {{ $errorMessage }}
                    </div>
                @endif

                <form wire:submit="submit" class="space-y-4">
                    {{-- Type Selection --}}
                    <div>
                        <label class="block text-sm font-medium text-stone-700 mb-2">{{ __('feedback.type') }}</label>
                        <div class="grid grid-cols-3 gap-2">
                            <label class="cursor-pointer">
                                <input type="radio" wire:model="type" value="bug" class="sr-only peer">
                                <div class="p-3 text-center rounded-xl border-2 transition-all peer-checked:border-red-500 peer-checked:bg-red-50 border-stone-200 hover:border-stone-300">
                                    <div class="text-lg mb-1">🐛</div>
                                    <div class="text-xs font-medium text-stone-600">{{ __('feedback.type_bug') }}</div>
                                </div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" wire:model="type" value="feature" class="sr-only peer">
                                <div class="p-3 text-center rounded-xl border-2 transition-all peer-checked:border-purple-500 peer-checked:bg-purple-50 border-stone-200 hover:border-stone-300">
                                    <div class="text-lg mb-1">💡</div>
                                    <div class="text-xs font-medium text-stone-600">{{ __('feedback.type_feature') }}</div>
                                </div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" wire:model="type" value="question" class="sr-only peer">
                                <div class="p-3 text-center rounded-xl border-2 transition-all peer-checked:border-blue-500 peer-checked:bg-blue-50 border-stone-200 hover:border-stone-300">
                                    <div class="text-lg mb-1">❓</div>
                                    <div class="text-xs font-medium text-stone-600">{{ __('feedback.type_question') }}</div>
                                </div>
                            </label>
                        </div>
                    </div>

                    {{-- Title --}}
                    <div>
                        <label for="title" class="block text-sm font-medium text-stone-700 mb-1">{{ __('Title') }}</label>
                        <input type="text"
                               id="title"
                               wire:model="title"
                               placeholder="{{ __('feedback.title_placeholder') }}"
                               class="w-full rounded-xl border-stone-200 text-sm py-2.5 px-4 focus:border-amber-500 focus:ring-amber-500">
                        @error('title')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div>
                        <label for="description" class="block text-sm font-medium text-stone-700 mb-1">{{ __('feedback.description') }}</label>
                        <textarea id="description"
                                  wire:model="description"
                                  rows="5"
                                  placeholder="{{ __('feedback.description_placeholder') }}"
                                  class="w-full rounded-xl border-stone-200 text-sm py-2.5 px-4 focus:border-amber-500 focus:ring-amber-500 resize-none"></textarea>
                        @error('description')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Actions --}}
                    <div class="flex justify-end gap-3 pt-2">
                        <button type="button"
                                @click="showForm = false"
                                class="px-4 py-2.5 text-sm font-medium text-stone-600 hover:text-stone-800 hover:bg-stone-100 rounded-xl transition-colors">
                            {{ __('Cancel') }}
                        </button>
                        <button type="submit"
                                wire:loading.attr="disabled"
                                wire:loading.class="opacity-50 cursor-not-allowed"
                                class="px-5 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 rounded-xl shadow-lg hover:shadow-xl transition-all flex items-center gap-2">
                            <span wire:loading.remove wire:target="submit">{{ __('Submit') }}</span>
                            <span wire:loading wire:target="submit" class="flex items-center gap-2">
                                <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                {{ __('feedback.submitting') }}
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Issue Details Modal --}}
    <div x-show="viewingIssue"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 overflow-y-auto"
         style="display: none;">
        <div class="flex items-start justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-stone-500/75" @click="closeIssue()"></div>

            <div x-show="viewingIssue"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="relative z-10 w-full max-w-2xl my-8 mx-auto bg-white rounded-2xl shadow-xl overflow-hidden">

                @if($issueDetails)
                    {{-- Header --}}
                    <div class="px-6 py-4 border-b border-stone-100 bg-stone-50/50">
                        <div class="flex items-start justify-between">
                            <div class="flex-1 min-w-0 pr-4">
                                <div class="flex items-center gap-2 mb-1">
                                    @if($issueDetails['type'] === 'bug')
                                        <span class="px-2 py-0.5 text-xs font-medium bg-red-100 text-red-700 rounded-full">
                                            {{ __('feedback.type_bug') }}
                                        </span>
                                    @elseif($issueDetails['type'] === 'feature')
                                        <span class="px-2 py-0.5 text-xs font-medium bg-purple-100 text-purple-700 rounded-full">
                                            {{ __('feedback.type_feature') }}
                                        </span>
                                    @else
                                        <span class="px-2 py-0.5 text-xs font-medium bg-blue-100 text-blue-700 rounded-full">
                                            {{ __('feedback.type_question') }}
                                        </span>
                                    @endif

                                    @if($issueDetails['state'] === 'closed' || $issueDetails['status'] === 'closed')
                                        <span class="px-2 py-0.5 text-xs font-medium bg-emerald-100 text-emerald-700 rounded-full">
                                            {{ $issueDetails['project_status'] ?? __('feedback.status_closed') }}
                                        </span>
                                    @elseif($issueDetails['status'] === 'in_progress')
                                        <span class="px-2 py-0.5 text-xs font-medium bg-amber-100 text-amber-700 rounded-full">
                                            {{ $issueDetails['project_status'] ?? __('feedback.status_in_progress') }}
                                        </span>
                                    @else
                                        <span class="px-2 py-0.5 text-xs font-medium bg-stone-100 text-stone-600 rounded-full">
                                            {{ $issueDetails['project_status'] ?? __('feedback.status_open') }}
                                        </span>
                                    @endif
                                </div>
                                <h2 class="text-lg font-semibold text-stone-800">#{{ $issueDetails['number'] }}: {{ $issueDetails['title'] }}</h2>
                                <p class="text-xs text-stone-400 mt-1">
                                    {{ __('feedback.created') }} {{ \Carbon\Carbon::parse($issueDetails['created_at'])->diffForHumans() }}
                                </p>
                            </div>
                            <button @click="closeIssue()" class="p-1 text-stone-400 hover:text-stone-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Body --}}
                    <div class="p-6">
                        <div class="prose prose-sm prose-stone max-w-none">
                            <p class="whitespace-pre-wrap text-stone-700">{{ $issueDetails['body'] }}</p>
                        </div>
                    </div>

                    {{-- Comments --}}
                    @if(count($issueComments) > 0)
                        <div class="px-6 pb-4">
                            <h3 class="text-sm font-medium text-stone-700 mb-3">{{ __('feedback.comments') }} ({{ count($issueComments) }})</h3>
                            <div class="space-y-3">
                                @foreach($issueComments as $comment)
                                    <div class="p-3 bg-stone-50 rounded-xl">
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="text-xs font-medium text-stone-600">{{ $comment['author'] }}</span>
                                            <span class="text-xs text-stone-400">{{ \Carbon\Carbon::parse($comment['created_at'])->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-sm text-stone-700 whitespace-pre-wrap">{{ $comment['body'] }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Add Comment --}}
                    <div class="px-6 pb-6">
                        <div class="border-t border-stone-100 pt-4">
                            <label class="block text-sm font-medium text-stone-700 mb-2">{{ __('feedback.add_comment') }}</label>
                            <textarea wire:model="newComment"
                                      rows="3"
                                      placeholder="{{ __('feedback.comment_placeholder') }}"
                                      class="w-full rounded-xl border-stone-200 text-sm py-2.5 px-4 focus:border-amber-500 focus:ring-amber-500 resize-none"></textarea>
                            <div class="flex justify-end mt-2">
                                <button wire:click="addComment"
                                        wire:loading.attr="disabled"
                                        class="px-4 py-2 text-sm font-medium text-white bg-amber-500 hover:bg-amber-600 rounded-xl transition-colors disabled:opacity-50">
                                    {{ __('feedback.send_comment') }}
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>
