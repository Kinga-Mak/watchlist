<div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
    <div class="p-6">
        {{-- Header Section: Title, Search, and Stats --}}
        <div class="flex flex-col sm:flex-row items-center justify-between mb-6 gap-4">
            <h3 class="text-lg font-bold text-gray-800">
                Moje filmy
            </h3>

            {{-- Search Input --}}
            <div class="relative w-full sm:w-64">
                <input type="text"
                    wire:model.live="search"
                    placeholder="Szukaj filmu..."
                    class="text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 w-full pl-10">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>

            <span class="text-xs font-medium px-2.5 py-0.5 rounded-full bg-indigo-100 text-indigo-800">
                Suma: {{ $movies->total() }}
            </span>
        </div>

        {{-- Movie List Section --}}
        <div class="divide-y divide-gray-100">
            @forelse ($movies as $movie)
                <div class="py-4 flex items-center justify-between hover:bg-gray-50 transition px-2 rounded-lg">
                    
                    {{-- Left Side: Title, Rating, and Date --}}
                    <div class="flex flex-col flex-grow mr-4">
                        @if ($editingMovieId === $movie->id)
                            {{-- EDIT MODE --}}
                            <div class="flex items-center space-x-2 w-full max-w-md">
                                <input type="text"
                                    wire:model="editingTitle"
                                    wire:keydown.enter="saveEdit"
                                    wire:keydown.escape="cancelEdit"
                                    class="text-sm rounded border-gray-300 p-1 w-full focus:ring-indigo-500 focus:border-indigo-500"
                                    auto-focus>
                                <button wire:click="saveEdit" class="text-green-600 hover:text-green-800 text-xs font-bold underline">Zapisz</button>
                                <button wire:click="cancelEdit" class="text-gray-400 hover:text-gray-600 text-xs underline">Anuluj</button>
                            </div>
                        @else
                            {{-- VIEW MODE --}}
                            <span 
                                wire:click="editMovie({{ $movie->id }}, '{{ addslashes($movie->title) }}')"
                                class="text-sm font-semibold text-gray-900 capitalize cursor-pointer hover:text-indigo-600 transition"
                                title="Kliknij, aby edytować tytuł">
                                {{ $movie->title }}
                            </span>
                        @endif

                        {{-- Star Rating Component --}}
                        <div class="flex items-center space-x-0.5 my-1">
                            @for ($i = 1; $i <= 5; $i++)
                                <button
                                    wire:click="setRating({{ $movie->id }}, {{ $i }})"
                                    class="text-lg focus:outline-none transition {{ $i <= $movie->rating ? 'text-yellow-400' : 'text-gray-300 hover:text-yellow-200' }}">
                                    ★
                                </button>
                            @endfor
                        </div>

                        <span class="text-xs text-gray-500 italic">
                            Dodano: {{ $movie->created_at->format('d.m.Y') }}
                        </span>
                    </div>

                    {{-- Right Side: Status Toggle and Delete --}}
                    <div class="flex items-center space-x-3">
                        @if ($movie->status === 'Finished')
                            <button wire:click="toggleStatus({{ $movie->id }})"
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 hover:bg-green-200 cursor-pointer transition">
                                Obejrzane
                            </button>
                        @else 
                            <button wire:click="toggleStatus({{ $movie->id }})"
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 hover:bg-yellow-200 cursor-pointer transition">
                                Do obejrzenia
                            </button>
                        @endif

                        {{-- Delete Button --}}
                        <button
                            wire:click="deleteMovie({{ $movie->id }})"
                            wire:confirm="Czy na pewno chcesz usunąć film?"
                            class="text-red-400 hover:text-red-600 transition p-1"
                            title="Usuń film">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            @empty
                <div class="text-center py-8">
                    <p class="text-gray-500 text-sm">Nie znaleziono filmów. Dodaj coś do swojej listy!</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination Links --}}
        <div class="mt-6 border-t border-gray-100 pt-4">
            {{ $movies->links() }}
        </div>

    </div>
</div>