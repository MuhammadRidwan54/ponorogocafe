@extends('layouts.app')

@section('title', 'Daftar Cafe - PonorogoCafe')
@section('header-title', 'Daftar Cafe')
@section('header-description', 'Kelola daftar cafe yang tersedia di PonorogoCafe')

@section('content')
<div class="bg-white rounded-xl shadow-md">
    <div class="p-4 lg:p-6">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
            <h1 class="text-xl lg:text-2xl font-bold text-gray-800">Daftar Cafe</h1>
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center space-y-2 sm:space-y-0 sm:space-x-3">
                <button onclick="openModal('create')" class="bg-brown-600 hover:bg-brown-700 text-white px-4 lg:px-6 py-2 rounded-lg flex items-center justify-center space-x-2 shadow-md transition-all duration-200 text-sm lg:text-base">
                    <i class="fas fa-plus"></i>
                    <span>Tambah Cafe</span>
                </button>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 lg:px-6 py-3 lg:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-3 lg:px-6 py-3 lg:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thumbnail</th>
                        <th class="px-3 lg:px-6 py-3 lg:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
                        <th class="px-3 lg:px-6 py-3 lg:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Cafe</th>
                        <th class="px-3 lg:px-6 py-3 lg:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                        <th class="px-3 lg:px-6 py-3 lg:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat URL</th>
                        <th class="px-3 lg:px-6 py-3 lg:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fasilitas</th>
                        <th class="px-3 lg:px-6 py-3 lg:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga Menu</th>
                        <th class="px-3 lg:px-6 py-3 lg:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kapasitas Ruang</th>
                        <th class="px-3 lg:px-6 py-3 lg:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tempat Parkir</th>
                        <th class="px-3 lg:px-6 py-3 lg:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jam Buka</th>
                        <th class="px-3 lg:px-6 py-3 lg:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($cafe as $index => $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-3 lg:px-6 py-3 lg:py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                        <td class="px-3 lg:px-6 py-3 lg:py-4 whitespace-nowrap">
                            <img src="{{ asset('storage/' . $item->thumbnail) }}" 
                                alt="Thumbnail {{ $item->nama_cafe }}" 
                                class="h-16 w-16 object-cover rounded-lg">
                        </td>
                        <td class="px-3 lg:px-6 py-3 lg:py-4 whitespace-nowrap">
                            <div class="flex space-x-2 overflow-x-auto">
                                @foreach(json_decode($item->gambar) ?? [] as $gambar)
                                    <img src="{{ asset('storage/' . $gambar) }}" 
                                        alt="{{ $item->nama_cafe }}" 
                                        class="h-16 w-16 object-cover rounded-lg flex-shrink-0">
                                @endforeach
                            </div>
                        </td>
                        <td class="px-3 lg:px-6 py-3 lg:py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->nama_cafe }}</td>
                        <td class="px-3 lg:px-6 py-3 lg:py-4 text-sm text-gray-500">{{ $item->alamat }}</td>
                        <td class="px-3 lg:px-6 py-3 lg:py-4 text-sm text-gray-500">
                            @if($item->alamat_url)
                                <a href="{{ $item->alamat_url }}" target="_blank" class="text-blue-600 hover:underline">{{ $item->alamat_url }}</a>
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-3 lg:px-6 py-3 lg:py-4 text-sm text-gray-500">{{ $item->fasilitas->pluck('nama_fasilitas')->implode(', ') ?: '-' }}</td>
                        <td class="px-3 lg:px-6 py-3 lg:py-4 text-sm text-gray-500">{{ $item->hargamenu->harga_menu ?? '-' }}</td>
                        <td class="px-3 lg:px-6 py-3 lg:py-4 text-sm text-gray-500">{{ $item->kapasitasruang->kapasitas_ruang ?? '-' }}</td>
                        <td class="px-3 lg:px-6 py-3 lg:py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->tempatparkir->tempat_parkir ?? '-' }}</td>  
                        <td class="px-3 lg:px-6 py-3 lg:py-4 text-sm text-gray-500">{{ $item->jambuka->jam_buka ?? '-' }}</td>
                        <td class="px-3 lg:px-6 py-3 lg:py-4 whitespace-nowrap text-sm font-medium space-x-3">
                            <button onclick="openModal('edit', {{ $item->id }})" class="text-blue-600 hover:text-blue-900 transition-colors" data-cafe='{{ json_encode([
                                "id" => $item->id,
                                "nama_cafe" => $item->nama_cafe,
                                "alamat" => $item->alamat,
                                "alamat_url" => $item->alamat_url,
                                "jambuka_id" => $item->jambuka_id,
                                "hargamenu_id" => $item->hargamenu_id,
                                "kapasitasruang_id" => $item->kapasitasruang_id,
                                "tempatparkir_id" => $item->tempatparkir_id,
                                "thumbnail" => $item->thumbnail,
                                "gambar" => $item->gambar,
                                "fasilitas" => $item->fasilitas->pluck("id")->toArray()
                            ]) }}'>
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('cafe.destroy', $item->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin hapus?')" class="text-red-600 hover:text-red-900 transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="11" class="px-3 lg:px-6 py-3 lg:py-4 text-center text-gray-500">
                            Belum ada data cafe.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Create/Edit Modal -->
<div id="cafeModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50 p-4">
    <div class="relative top-10 lg:top-20 mx-auto border w-full max-w-2xl shadow-lg rounded-xl bg-white">
        <div class="p-4 lg:p-5">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-base lg:text-lg font-medium text-gray-900" id="modalTitle">Tambah Cafe</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="cafeForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div id="modalContent">
                    <!-- Content will be loaded here -->
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 lg:px-6 py-2 rounded-lg transition-colors text-sm lg:text-base">Batal</button>
                    <button type="submit" class="bg-brown-600 hover:bg-brown-700 text-white px-4 lg:px-6 py-2 rounded-lg transition-colors text-sm lg:text-base">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Global data for dropdowns and facilities
const globalData = {
    fasilitas: @json($fasilitas),
    jambuka: @json($jambuka),
    hargamenu: @json($hargamenu),
    kapasitasruang: @json($kapasitasruang),
    tempatparkir: @json($tempatparkir)
};

function openModal(action, id = null) {
    const modal = document.getElementById('cafeModal');
    const title = document.getElementById('modalTitle');
    const form = document.getElementById('cafeForm');
    const modalContent = document.getElementById('modalContent');
    
    if (action === 'create') {
        title.textContent = 'Tambah Cafe';
        form.action = "{{ route('cafe.store') }}";
        modalContent.innerHTML = `
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Nama Cafe</label>
                    <input type="text" name="nama_cafe" class="w-full px-3 lg:px-4 py-2 lg:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Alamat</label>
                    <textarea name="alamat" rows="3" class="w-full px-3 lg:px-4 py-2 lg:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent" required></textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Alamat URL</label>
                    <input type="url" name="alamat_url"
                        class="w-full px-3 lg:px-4 py-2 lg:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent"
                        placeholder="https://maps.google.com/..." >
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Jam Buka</label>
                    <select name="jambuka_id" class="w-full px-3 lg:px-4 py-2 lg:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent" required>
                        <option value="">Pilih Jam Buka</option>
                        ${globalData.jambuka.map(jb => `<option value="${jb.id}">${jb.jam_buka}</option>`).join('')}
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Harga Menu</label>
                    <select name="hargamenu_id" class="w-full px-3 lg:px-4 py-2 lg:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent" required>
                        <option value="">Pilih Harga Menu</option>
                        ${globalData.hargamenu.map(hm => `<option value="${hm.id}">${hm.harga_menu}</option>`).join('')}
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Kapasitas Ruang</label>
                    <select name="kapasitasruang_id" class="w-full px-3 lg:px-4 py-2 lg:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent" required>
                        <option value="">Pilih Kapasitas Ruang</option>
                        ${globalData.kapasitasruang.map(kr => `<option value="${kr.id}">${kr.kapasitas_ruang}</option>`).join('')}
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Tempat Parkir</label>
                    <select name="tempatparkir_id" class="w-full px-3 lg:px-4 py-2 lg:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent" required>
                        <option value="">Pilih Tempat Parkir</option>
                        ${globalData.tempatparkir.map(tp => `<option value="${tp.id}">${tp.tempat_parkir}</option>`).join('')}
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Thumbnail</label>
                    <input type="file" name="thumbnail" accept="image/*" 
                        class="w-full px-3 lg:px-4 py-2 lg:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent" required>
                    <div id="thumbnailPreview" class="mt-2 flex space-x-2"></div>
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Gambar</label>
                    <div id="imageInputs">
                        <div class="image-input-group flex items-center space-x-2 mb-2">
                            <input type="file" name="gambar[]" accept="image/*" 
                                class="w-full px-3 lg:px-4 py-2 lg:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent">
                            <button type="button" onclick="removeImageInput(this)" class="text-red-600 hover:text-red-900">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    <div id="imagesPreview" class="mt-2 flex space-x-2 overflow-x-auto"></div>
                    <button type="button" onclick="addImageInput()" class="bg-brown-600 hover:bg-brown-700 text-white px-4 py-2 rounded-lg mt-2 text-sm">
                        Tambah Gambar Lain
                    </button>
                    <p class="text-sm text-gray-500 mt-1">Dapat memilih lebih dari satu gambar</p>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Fasilitas</label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                    ${globalData.fasilitas.map(f => `
                        <div class="flex items-center">
                            <input type="checkbox" name="fasilitas_id[]" value="${f.id}" id="fasilitas${f.id}" class="rounded border-gray-300 text-brown-600 focus:ring-brown-500">
                            <label for="fasilitas${f.id}" class="ml-2 text-sm text-gray-700">${f.nama_fasilitas}</label>
                        </div>
                    `).join('')}
                </div>
            </div>
        `;
    } else if (action === 'edit') {
        const button = event.currentTarget;
        const cafe = JSON.parse(button.getAttribute('data-cafe'));
        title.textContent = 'Edit Cafe';
        form.action = `/cafe/${id}`;
        form.innerHTML = `
            @csrf
            @method('PUT')
            <div id="modalContent">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Nama Cafe</label>
                        <input type="text" name="nama_cafe" value="${cafe.nama_cafe.replace(/"/g, '&quot;')}" class="w-full px-3 lg:px-4 py-2 lg:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Alamat</label>
                        <textarea name="alamat" rows="3" class="w-full px-3 lg:px-4 py-2 lg:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent" required>${cafe.alamat.replace(/"/g, '&quot;')}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Alamat URL</label>
                        <input type="url" name="alamat_url" value="${cafe.alamat_url ? cafe.alamat_url : ''}" 
                            class="w-full px-3 lg:px-4 py-2 lg:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent"
                            placeholder="https://maps.google.com/..." >
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Jam Buka</label>
                        <select name="jambuka_id" class="w-full px-3 lg:px-4 py-2 lg:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent" required>
                            <option value="">Pilih Jam Buka</option>
                            ${globalData.jambuka.map(jb => `<option value="${jb.id}" ${cafe.jambuka_id == jb.id ? 'selected' : ''}>${jb.jam_buka}</option>`).join('')}
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Harga Menu</label>
                        <select name="hargamenu_id" class="w-full px-3 lg:px-4 py-2 lg:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent" required>
                            <option value="">Pilih Harga Menu</option>
                            ${globalData.hargamenu.map(hm => `<option value="${hm.id}" ${cafe.hargamenu_id == hm.id ? 'selected' : ''}>${hm.harga_menu}</option>`).join('')}
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Kapasitas Ruang</label>
                        <select name="kapasitasruang_id" class="w-full px-3 lg:px-4 py-2 lg:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent" required>
                            <option value="">Pilih Kapasitas Ruang</option>
                            ${globalData.kapasitasruang.map(kr => `<option value="${kr.id}" ${cafe.kapasitasruang_id == kr.id ? 'selected' : ''}>${kr.kapasitas_ruang}</option>`).join('')}
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Tempat Parkir</label>
                        <select name="tempatparkir_id" class="w-full px-3 lg:px-4 py-2 lg:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent" required>
                            <option value="">Pilih Tempat Parkir</option>
                            ${globalData.tempatparkir.map(tp => `<option value="${tp.id}" ${cafe.tempatparkir_id == tp.id ? 'selected' : ''}>${tp.tempat_parkir}</option>`).join('')}
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Thumbnail</label>
                        <input type="file" name="thumbnail" accept="image/*" 
                            class="w-full px-3 lg:px-4 py-2 lg:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent">
                        <div id="thumbnailPreview" class="mt-2 flex space-x-2">
                            ${cafe.thumbnail ? `
                                <div class="relative">
                                    <img src="{{ asset('storage/') }}/${cafe.thumbnail}" class="h-16 w-16 object-cover rounded-lg">
                                    <p class="text-sm text-gray-500 mt-1">Thumbnail saat ini</p>
                                </div>
                            ` : ''}
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Gambar</label>
                        <div id="imageInputs">
                            ${cafe.gambar && JSON.parse(cafe.gambar).length > 0 ? 
                                JSON.parse(cafe.gambar).map(gambar => `
                                    <div class="image-input-group flex items-center space-x-2 mb-2">
                                        <input type="file" name="gambar[]" accept="image/*" 
                                            class="w-full px-3 lg:px-4 py-2 lg:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent">
                                        <button type="button" onclick="removeImageInput(this)" class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                `).join('')
                            : `
                                <div class="image-input-group flex items-center space-x-2 mb-2">
                                    <input type="file" name="gambar[]" accept="image/*" 
                                        class="w-full px-3 lg:px-4 py-2 lg:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent">
                                    <button type="button" onclick="removeImageInput(this)" class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            `}
                        </div>
                        <div id="imagesPreview" class="mt-2 flex space-x-2 overflow-x-auto">
                            ${cafe.gambar && JSON.parse(cafe.gambar).length > 0 ? 
                                JSON.parse(cafe.gambar).map(gambar => `
                                    <div class="relative">
                                        <img src="{{ asset('storage/') }}/${gambar}" class="h-16 w-16 object-cover rounded-lg">
                                        <p class="text-sm text-gray-500 mt-1">Gambar saat ini</p>
                                    </div>
                                `).join('')
                            : ''}
                        </div>
                        <button type="button" onclick="addImageInput()" class="bg-brown-600 hover:bg-brown-700 text-white px-4 py-2 rounded-lg mt-2 text-sm">
                            Tambah Gambar Lain
                        </button>
                        <p class="text-sm text-gray-500 mt-1">Dapat memilih lebih dari satu gambar</p>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Fasilitas</label>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                        ${globalData.fasilitas.map(f => `
                            <div class="flex items-center">
                                <input type="checkbox" name="fasilitas_id[]" value="${f.id}" id="fasilitas${f.id}" 
                                    class="rounded border-gray-300 text-brown-600 focus:ring-brown-500"
                                    ${cafe.fasilitas.includes(f.id) ? 'checked' : ''}>
                                <label for="fasilitas${f.id}" class="ml-2 text-sm text-gray-700">${f.nama_fasilitas}</label>
                            </div>
                        `).join('')}
                    </div>
                </div>
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 lg:px-6 py-2 rounded-lg transition-colors text-sm lg:text-base">Batal</button>
                <button type="submit" class="bg-brown-600 hover:bg-brown-700 text-white px-4 lg:px-6 py-2 rounded-lg transition-colors text-sm lg:text-base">Simpan</button>
            </div>
        `;
    }
    
    modal.classList.remove('hidden');
    initializeImageInputs();
    initializeImagePreviews();
}

function closeModal() {
    const modal = document.getElementById('cafeModal');
    modal.classList.add('hidden');
    // Clear previews when closing modal
    const thumbnailPreview = document.getElementById('thumbnailPreview');
    const imagesPreview = document.getElementById('imagesPreview');
    if (thumbnailPreview) thumbnailPreview.innerHTML = '';
    if (imagesPreview) imagesPreview.innerHTML = '';
}

function addImageInput() {
    const imageInputs = document.getElementById('imageInputs');
    const newInputGroup = document.createElement('div');
    newInputGroup.className = 'image-input-group flex items-center space-x-2 mb-2';
    newInputGroup.innerHTML = `
        <input type="file" name="gambar[]" accept="image/*" 
            class="w-full px-3 lg:px-4 py-2 lg:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent">
        <button type="button" onclick="removeImageInput(this)" class="text-red-600 hover:text-red-900">
            <i class="fas fa-trash"></i>
        </button>
    `;
    imageInputs.appendChild(newInputGroup);
    initializeImagePreviews(); // Reinitialize previews for new input
}

function removeImageInput(button) {
    const imageInputs = document.getElementById('imageInputs');
    if (imageInputs.children.length > 1) {
        const inputGroup = button.parentElement;
        const input = inputGroup.querySelector('input[type="file"]');
        if (input && input.dataset.previewId) {
            const preview = document.getElementById(input.dataset.previewId);
            if (preview) preview.remove();
        }
        inputGroup.remove();
    } else {
        alert('Minimal satu input gambar harus ada.');
    }
}

function initializeImageInputs() {
    const imageInputs = document.getElementById('imageInputs');
    if (imageInputs) {
        const inputs = imageInputs.getElementsByClassName('image-input-group');
        if (inputs.length === 0) {
            addImageInput();
        }
    }
}

function initializeImagePreviews() {
    const thumbnailInput = document.querySelector('input[name="thumbnail"]');
    const imageInputs = document.querySelectorAll('input[name="gambar[]"]');

    // Thumbnail preview
    if (thumbnailInput) {
        thumbnailInput.removeEventListener('change', handleThumbnailPreview); // Prevent multiple listeners
        thumbnailInput.addEventListener('change', handleThumbnailPreview);
    }

    // Multiple images preview
    imageInputs.forEach((input, index) => {
        input.removeEventListener('change', handleImagePreview); // Prevent multiple listeners
        input.dataset.previewId = `preview-${index}-${Date.now()}`; // Unique ID for each input
        input.addEventListener('change', handleImagePreview);
    });
}

function handleThumbnailPreview(event) {
    const input = event.target;
    const previewContainer = document.getElementById('thumbnailPreview');
    // Clear previous previews, keeping existing thumbnail if in edit mode
    previewContainer.innerHTML = previewContainer.querySelector('div.relative') ? previewContainer.innerHTML : '';
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('div');
            img.innerHTML = `
                <img src="${e.target.result}" class="h-16 w-16 object-cover rounded-lg">
                <p class="text-sm text-gray-500 mt-1">Pratinjau</p>
            `;
            previewContainer.appendChild(img);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function handleImagePreview(event) {
    const input = event.target;
    const previewContainer = document.getElementById('imagesPreview');
    const previewId = input.dataset.previewId;

    // Remove existing preview for this input
    const existingPreview = document.getElementById(previewId);
    if (existingPreview) existingPreview.remove();

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('div');
            img.id = previewId;
            img.innerHTML = `
                <img src="${e.target.result}" class="h-16 w-16 object-cover rounded-lg">
                <p class="text-sm text-gray-500 mt-1">Pratinjau</p>
            `;
            previewContainer.appendChild(img);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
  // ...fungsi modal, openModal, closeModal, dsb...

    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('cafeModal');
        const modalContent = document.querySelector('#cafeModal .relative');

        if (modal && modalContent) {
            modal.addEventListener('mousedown', function(e) {
                if (!modalContent.contains(e.target)) {
                    closeModal();
                }
            });
        }
    });
</script>
@endsection