<div class="relative flex items-center">
    <input
        type="text"
        class="w-full border border-gray-300 p-2 rounded-l-lg text-gray-800 focus:ring focus:ring-indigo-400"
        placeholder="Search products..."
        wire:model="query"
    />
    
    <button
        class="bg-indigo-600 text-white px-4 py-2 rounded-r-lg hover:bg-indigo-700 flex items-center justify-center"
        wire:click="search"
    >
        <i class="fas fa-search"></i> <!-- FontAwesome magnifying glass -->
    </button>

    @if ($suggestions)
        <ul class="absolute bg-white border mt-2 w-full rounded-lg shadow-lg">
            @foreach ($suggestions as $suggestion)
                <li
                    class="px-4 py-2 hover:bg-gray-200 cursor-pointer"
                    wire:click="$set('query', '{{ $suggestion }}')"
                >
                    {{ $suggestion }}
                </li>
            @endforeach
        </ul>
    @endif
</div>
