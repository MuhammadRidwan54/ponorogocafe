<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="h-48 bg-gray-200">
        @if($cafe->gambar && count(json_decode($cafe->gambar)) > 0)
            <img src="{{ asset('storage/' . json_decode($cafe->gambar)[0]) }}" alt="{{ $cafe->nama_cafe }}" class="h-full w-full object-cover">
        @endif
    </div>
    <div class="p-4">
        <h3 class="text-lg font-bold">{{ $cafe->nama_cafe }}</h3>
        <p class="text-sm text-gray-500 mt-1"><i class="fas fa-map-marker-alt mr-1"></i> {{ $cafe->alamat }}</p>
        <div class="flex flex-wrap gap-2 mt-3">
            @foreach($cafe->fasilitas as $fasilitas)
                <span class="bg-gray-200 text-xs px-3 py-1 rounded-full">{{ $fasilitas->nama_fasilitas }}</span>
            @endforeach
        </div>
        <a href="{{ route('cafe.show', $cafe->id) }}" class="block text-sm text-right text-brown-700 hover:underline mt-3">View detail</a>
    </div>
</div>
