@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-4">
        Hasil Rekomendasi Cafe
        @if(request('jam') || $kriteria)
            <span class="text-gray-500 text-base font-normal">
                ({{ ucfirst(request('jam')) }}{{ $kriteria ? ' | ' . implode(', ', (array) $kriteria) : '' }})
            </span>
        @endif
    </h2>

    <!-- Form filter jam buka -->
    <form action="{{ route('home.hasil') }}" method="GET" class="flex flex-wrap gap-2 items-center mb-6">
        @foreach((array) request()->except('jam') as $key => $value)
            @if(is_array($value))
                @foreach($value as $v)
                    <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                @endforeach
            @else
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endif
        @endforeach

        <label for="jam" class="font-semibold">Filter Jam Buka:</label>
        <select name="jam" id="jam" class="border p-2 rounded">
            <option value="">-- Semua --</option>
            <option value="pagi" {{ request('jam') == 'pagi' ? 'selected' : '' }}>Pagi</option>
            <option value="siang" {{ request('jam') == 'siang' ? 'selected' : '' }}>Siang</option>
            <option value="sore" {{ request('jam') == 'sore' ? 'selected' : '' }}>Sore</option>
            <option value="24" {{ request('jam') == '24' ? 'selected' : '' }}>24 Jam</option>
        </select>
        <button type="submit" class="bg-yellow-800 text-white px-4 py-2 rounded">Filter</button>
    </form>

    <!-- Hasil Cafe -->
    @if($cafes->count())
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach ($cafes as $cafe)
                <div class="border rounded-lg shadow p-4 bg-white">
                    @if($cafe->gambar && count($cafe->gambar))
                        <img src="{{ asset('storage/' . $cafe->gambar[0]) }}"
                            class="h-40 w-full object-cover rounded mb-3"
                            alt="Gambar {{ $cafe->nama_cafe }}">
                    @endif

                    <h3 class="text-xl font-bold mb-1">{{ $cafe->nama_cafe }}</h3>
                    <p class="mb-1 text-gray-700 text-sm">{{ $cafe->alamat }}</p>
                    <p class="mb-1 text-sm"><strong>Jam Buka:</strong> {{ $cafe->jambuka->jam_buka ?? '-' }}</p>
                    <p class="mb-2 text-sm"><strong>Skor SAW:</strong> {{ number_format($cafe->score, 3) }}</p>
                    <a href="{{ route('home.cafe', $cafe->id) }}"
                    class="inline-block mt-2 text-blue-600 hover:underline font-semibold text-sm">
                        Lihat Detail
                    </a>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center text-gray-500 mt-10">
            <p>Tidak ada cafe yang cocok dengan filter yang dipilih.</p>
        </div>
    @endif
</div>
@endsection
