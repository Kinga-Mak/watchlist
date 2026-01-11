<div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
    <form wire:submit.prevent="save" class="space-y-5">
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Tytuł Filmu</label>
            <input type="text" wire:model="title" placeholder="Tytuł filmu"
            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            @error('title')>
            <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Status</label>
            <select wire:model="status" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="To watch">Do obejrzenia</option>
                <option value="Finished">Obejrzane</option>
            </select>
        </div>

        <button type="submit"
        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-offset-2 focus:ring-indigo-500 transition duration-150">
            Zapisz na liście
        </button>

        @if (session()->has('message'))
            <div class="p-3 bg-green-50 border border-green-200 rounded-lg text-sm text-green-700 flex items-center">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                {{ session('message') }}
            </div>
        @endif
    </form>
</div>
