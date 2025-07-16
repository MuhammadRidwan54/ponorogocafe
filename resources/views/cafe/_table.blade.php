@forelse($cafe as $index => $item)
@php
    // Prepare cafe data for JavaScript
    $cafeData = [
        'id' => $item->id,
        'nama_cafe' => $item->nama_cafe,
        'alamat' => $item->alamat,
        'alamat_url' => $item->alamat_url,
        'keterangan_motor' => $item->keterangan_motor,
        'keterangan_mobil' => $item->keterangan_mobil,
        'keterangan_mushola' => $item->keterangan_mushola,
        'keterangan_toilet' => $item->keterangan_toilet,
        'instagram_url' => $item->instagram_url,
        'harga_menu' => $item->hargamenu->harga_menu ?? '',
        'kapasitas_ruang' => $item->kapasitasruang->kapasitas_ruang ?? '',
        'tempat_parkir' => $item->tempatparkir->tempat_parkir ?? '',
        'jam_buka' => $item->jambuka->jam_buka ?? '',
        'thumbnail' => $item->thumbnail,
        'gambar' => is_array($item->gambar) ? $item->gambar : (json_decode($item->gambar) ?: []),
        'fasilitas' => $item->fasilitas->map(function($f) { 
            return ['nama' => $f->nama_fasilitas]; 
        })->toArray(),
        'labels' => $item->labels->map(function($l) { 
            return ['nama' => $l->nama_label]; 
        })->toArray()
    ];
    
    // Prepare gallery images data
    $galleryImages = json_decode($item->gambar) ?: [];
    $galleryCount = count($galleryImages);
    
    // Prepare edit data
    $editData = [
        'id' => $item->id,
        'nama_cafe' => $item->nama_cafe,
        'alamat' => $item->alamat,
        'alamat_url' => $item->alamat_url,
        'keterangan_motor' => $item->keterangan_motor,
        'keterangan_mobil' => $item->keterangan_mobil,
        'keterangan_mushola' => $item->keterangan_mushola,
        'keterangan_toilet' => $item->keterangan_toilet,
        'instagram_url' => $item->instagram_url,
        'jambuka_id' => $item->jambuka_id,
        'hargamenu_id' => $item->hargamenu_id,
        'kapasitasruang_id' => $item->kapasitasruang_id,
        'tempatparkir_id' => $item->tempatparkir_id,
        'thumbnail' => $item->thumbnail,
        'gambar' => $item->gambar,
        'fasilitas' => $item->fasilitas->pluck('id')->toArray(),
        'labels' => $item->labels->pluck('id')->toArray()
    ];
@endphp

<tr class="hover:bg-gray-50 group cursor-pointer transition-colors" onclick="showCafeDetail({{ json_encode($cafeData) }})">
    
    <!-- Number & Thumbnail Combined -->
    <td class="px-3 lg:px-6 py-3 lg:py-4 whitespace-nowrap">
        <div class="flex items-center space-x-3">
            <span class="text-sm text-gray-500 font-medium w-6">{{ $index + 1 }}</span>
            <div class="relative">
                <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="Thumbnail {{ $item->nama_cafe }}"
                    class="h-12 w-12 lg:h-14 lg:w-14 object-cover rounded-lg shadow-sm cursor-pointer hover:shadow-md transition-shadow"
                    onclick="event.stopPropagation(); showImagePreview('{{ asset('storage/' . $item->thumbnail) }}', '{{ addslashes($item->nama_cafe) }}')">
                <!-- Gallery indicator -->
                @if ($galleryCount > 0)
                    <div class="absolute -top-1 -right-1 bg-gray-700 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-medium cursor-pointer hover:bg-gray-800 transition-colors"
                        onclick="event.stopPropagation(); showGallery({{ json_encode($galleryImages) }}, '{{ addslashes($item->nama_cafe) }}')"
                        title="Lihat {{ $galleryCount }} foto lainnya">
                        {{ $galleryCount }}
                    </div>
                @endif
            </div>
        </div>
    </td>

    <!-- Cafe Info (Name + Address) -->
    <td class="px-3 lg:px-6 py-3 lg:py-4">
        <div class="space-y-1">
            <div class="text-sm font-semibold text-gray-900 truncate max-w-xs" title="{{ $item->nama_cafe }}">
                {{ $item->nama_cafe }}
            </div>
            <div class="text-xs text-gray-600 truncate max-w-xs" title="{{ $item->alamat }}">
                <svg class="w-3 h-3 mr-1 text-gray-500 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                {{ $item->alamat }}
            </div>
            @if ($item->alamat_url)
                <a href="{{ $item->alamat_url }}" target="_blank" rel="noopener noreferrer"
                    class="text-xs text-gray-700 hover:text-gray-900 inline-flex items-center transition-colors"
                    onclick="event.stopPropagation()">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                    Lihat Maps
                </a>
            @endif
        </div>
    </td>

    <!-- Facilities & Labels -->
    <td class="px-3 lg:px-6 py-3 lg:py-4">
        <div class="space-y-2">
            <!-- Facilities -->
            @if ($item->fasilitas && $item->fasilitas->count() > 0)
                <div class="flex flex-wrap gap-1">
                    @foreach ($item->fasilitas->take(2) as $fasilitas)
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-gray-100 text-gray-700 border border-gray-200">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            {{ $fasilitas->nama_fasilitas }}
                        </span>
                    @endforeach
                    @if ($item->fasilitas->count() > 2)
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-gray-100 text-gray-600 cursor-pointer hover:bg-gray-200 transition-colors"
                            title="{{ $item->fasilitas->skip(2)->pluck('nama_fasilitas')->implode(', ') }}"
                            onclick="event.stopPropagation()">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            {{ $item->fasilitas->count() - 2 }}
                        </span>
                    @endif
                </div>
            @endif

            <!-- Labels -->
            @if ($item->labels && $item->labels->count() > 0)
                <div class="flex flex-wrap gap-1">
                    @foreach ($item->labels->take(2) as $label)
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-gray-200 text-gray-700 border border-gray-300">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            {{ $label->nama_label }}
                        </span>
                    @endforeach
                    @if ($item->labels->count() > 2)
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-gray-100 text-gray-600 cursor-pointer hover:bg-gray-200 transition-colors"
                            title="{{ $item->labels->skip(2)->pluck('nama_label')->implode(', ') }}"
                            onclick="event.stopPropagation()">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            {{ $item->labels->count() - 2 }}
                        </span>
                    @endif
                </div>
            @endif

            @if ((!$item->fasilitas || $item->fasilitas->count() == 0) && (!$item->labels || $item->labels->count() == 0))
                <span class="text-xs text-gray-400 flex items-center">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                    </svg>
                    Tidak ada data
                </span>
            @endif
        </div>
    </td>

    <!-- Details (Price, Capacity, Parking, Hours) -->
    <td class="px-3 lg:px-6 py-3 lg:py-4">
        <div class="space-y-1 text-xs">
            <div class="flex items-center text-gray-600">
                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                </svg>
                <span class="font-medium">{{ $item->hargamenu->harga_menu ?? 'Tidak ada data' }}</span>
            </div>
            <div class="flex items-center text-gray-600">
                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <span>{{ $item->kapasitasruang->kapasitas_ruang ?? 'Tidak ada data' }}</span>
            </div>
            <div class="flex items-center text-gray-600">
                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                <span>{{ $item->tempatparkir->tempat_parkir ?? 'Tidak ada data' }}</span>
            </div>
            <div class="flex items-center text-gray-600">
                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ $item->jambuka->jam_buka ?? 'Tidak ada data' }}</span>
            </div>
        </div>
    </td>

    <!-- Actions -->
    <td class="px-3 lg:px-6 py-3 lg:py-4 whitespace-nowrap">
        <div class="flex items-center space-x-2">
            <!-- Gallery Button -->
            @if ($galleryCount > 0)
                <button onclick="event.stopPropagation(); showGallery({{ json_encode($galleryImages) }}, '{{ addslashes($item->nama_cafe) }}')"
                    class="text-gray-600 hover:text-gray-900 transition-colors p-1 rounded hover:bg-gray-100"
                    title="Lihat Galeri ({{ $galleryCount }} foto)">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </button>
            @endif

            <!-- Edit Button -->
            <button onclick="event.stopPropagation(); openModal('edit', {{ $item->id }}, this)"
                class="text-gray-600 hover:text-gray-900 transition-colors p-1 rounded hover:bg-gray-100"
                title="Edit Cafe"
                data-cafe='@json($editData)'>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
            </button>
            
            <!-- Delete Button -->
            <form action="{{ route('cafe.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus cafe {{ addslashes($item->nama_cafe) }}?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                    onclick="event.stopPropagation()"
                    class="text-gray-600 hover:text-red-600 transition-colors p-1 rounded hover:bg-red-50"
                    title="Hapus Cafe">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            </form>
        </div>
    </td>
</tr>


@empty
<tr>
    <td colspan="5" class="px-3 lg:px-6 py-8 text-center">
        <div class="flex flex-col items-center justify-center text-gray-500">
            <i class="fas fa-coffee text-4xl mb-3 text-gray-300"></i>
            <p class="text-lg font-medium">Belum ada data cafe</p>
            <p class="text-sm">Tambahkan cafe pertama Anda</p>
        </div>
    </td>
</tr>
@endforelse
