<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
        <div class="text-blue-500 text-xs font-bold uppercase">Wszystkie</div>
        <div class="text-2xl font-bold text-blue-900">{{ $total }}</div>
    </div>

    <div class="bg-green-50 p-4 rounded-lg border border-green-100">
        <div class="text-green-500 text-xs font-bold uppercase">Obejrzane</div>
        <div class="text-2xl font-bold text-green-900">{{ $finished }}</div>
    </div>

    <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-100">
        <div class="text-yellow-500 text-xs font-bold uppercase">Średnia ocena</div>
        <div class="text-2xl font-bold text-yellow-900">★ {{ $avgRating }}</div>
    </div>
</div>
