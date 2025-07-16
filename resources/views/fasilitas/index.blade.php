@extends('layouts.app')

@section('title', 'Daftar Fasilitas - PonorogoCafe')
@section('header-title', 'Daftar Fasilitas')
@section('header-description', 'Kelola daftar fasilitas yang tersedia di PonorogoCafe')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100">
    <div class="p-5 lg:p-6">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
            <h1 class="text-xl lg:text-2xl font-bold text-gray-900 tracking-tight">Daftar Fasilitas</h1>
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center space-y-2 sm:space-y-0 sm:space-x-3">
                <button onclick="openModal('create')" class="bg-gray-900 hover:bg-gray-800 text-white px-4 lg:px-5 py-2 rounded-lg flex items-center justify-center space-x-2 shadow-sm transition-all duration-200 text-sm font-medium">
                    <i class="fas fa-plus text-xs"></i>
                    <span>Tambah Fasilitas</span>
                </button>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg relative mb-6 text-sm" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Table -->
        <div class="overflow-x-auto rounded-lg border border-gray-100">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Fasilitas</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Icon</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach($fasilitas as $index => $item)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->nama_fasilitas }}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">
                            <span class="inline-block w-5 h-5 text-gray-600">{!! $item->icon_svg !!}</span>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium space-x-2">
                            <button onclick="openModal('edit', {{ $item->id }}, '{{ $item->nama_fasilitas }}')" class="text-gray-600 hover:text-gray-900 p-1 rounded-md hover:bg-gray-100 transition-colors">
                                <i class="fas fa-edit text-sm"></i>
                            </button>
                            <form action="{{ route('fasilitas.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin ingin menghapus fasilitas ini?')" class="text-red-600 hover:text-red-800 p-1 rounded-md hover:bg-red-50 transition-colors">
                                    <i class="fas fa-trash text-sm"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Create/Edit Modal -->
<div id="fasilitasModal" class="fixed inset-0 bg-gray-900 bg-opacity-60 hidden overflow-y-auto h-full w-full z-50 p-4 flex items-center justify-center">
    <div class="relative mx-auto border border-gray-100 w-full max-w-md shadow-xl rounded-xl bg-white transform transition-all duration-300 scale-95 opacity-0" id="modalContent">
        <div class="p-5 lg:p-6">
            <div class="flex items-center justify-between mb-5">
                <h3 class="text-lg lg:text-xl font-semibold text-gray-900" id="modalTitle">Tambah Fasilitas</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 p-2 rounded-lg hover:bg-gray-50 transition-colors">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
            <form id="fasilitasForm" method="POST">
                @csrf
                <div id="methodContainer"></div>
                
                <div class="mb-4">
                    <label for="namaFasilitas" class="block text-gray-700 text-sm font-medium mb-2">Nama Fasilitas</label>
                    <input type="text" name="nama_fasilitas" id="namaFasilitas" class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-300 focus:border-transparent text-sm text-gray-800 placeholder-gray-400" placeholder="Masukkan nama fasilitas" required>
                </div>
                
                <div class="mb-6">
                    <label for="iconSvg" class="block text-gray-700 text-sm font-medium mb-2">Icon SVG (Heroicons)</label>
                    <textarea name="icon_svg" id="iconSvg" rows="4"
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-300 focus:border-transparent text-sm text-gray-800 placeholder-gray-400"
                        placeholder="Tempelkan kode SVG Heroicons di sini (hanya bagian <svg>... </svg>)"
                        oninput="updateIconPreview(this.value)"
                        required></textarea>
                    <div id="iconPreview" class="mt-3 p-4 border border-gray-200 rounded-lg bg-gray-50 flex items-center justify-center min-h-[80px]">
                        <p class="text-gray-400 text-sm">Preview icon akan muncul di sini</p>
                    </div>
                </div>
                
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center sm:justify-end space-y-2 sm:space-y-0 sm:space-x-3 mt-6">
                    <button type="button" onclick="closeModal()" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 lg:px-5 py-2 rounded-lg transition-colors text-sm font-medium">Batal</button>
                    <button type="submit" class="bg-gray-900 hover:bg-gray-800 text-white px-4 lg:px-5 py-2 rounded-lg transition-colors text-sm font-medium">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function updateIconPreview(svgCode) {
        const preview = document.getElementById('iconPreview');
        if (svgCode.trim()) {
            // Basic SVG validation
            if (svgCode.includes('<svg') && svgCode.includes('</svg>')) {
                preview.innerHTML = svgCode;
                // Ensure SVG fills are consistent with the new design
                const svgElement = preview.querySelector('svg');
                if (svgElement) {
                    svgElement.setAttribute('class', 'w-6 h-6 text-gray-700'); // Apply consistent styling
                    svgElement.removeAttribute('fill'); // Remove inline fill to allow CSS to control
                    svgElement.removeAttribute('stroke'); // Remove inline stroke
                }
            } else {
                preview.innerHTML = '<p class="text-red-500 text-sm">Kode SVG tidak valid</p>';
            }
        } else {
            preview.innerHTML = '<p class="text-gray-400 text-sm">Preview icon akan muncul di sini</p>';
        }
    }

    function openModal(action, id = null, nama = '') {
        const modal = document.getElementById('fasilitasModal');
        const modalContent = document.getElementById('modalContent');
        const title = document.getElementById('modalTitle');
        const form = document.getElementById('fasilitasForm');
        const methodContainer = document.getElementById('methodContainer');
        const namaInput = document.getElementById('namaFasilitas');
        const iconInput = document.getElementById('iconSvg');

        if (action === 'create') {
            title.textContent = 'Tambah Fasilitas';
            form.action = "{{ route('fasilitas.store') }}";
            methodContainer.innerHTML = '';
            namaInput.value = '';
            iconInput.value = '';
            updateIconPreview('');
        } else if (action === 'edit') {
            title.textContent = 'Edit Fasilitas';
            form.action = "{{ route('fasilitas.update', ':id') }}".replace(':id', id);
            methodContainer.innerHTML = '@method("PUT")';
            namaInput.value = nama;
            
            // Fetch facility data
            fetch(`{{ route('fasilitas.edit', ':id') }}`.replace(':id', id), {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Gagal memuat data: ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                iconInput.value = data.icon_svg || '';
                updateIconPreview(data.icon_svg || '');
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Gagal memuat data fasilitas: ' + error.message);
            });
        }
        modal.classList.remove('hidden');
        // Animate modal in
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 50);
    }

    function closeModal() {
        const modal = document.getElementById('fasilitasModal');
        const modalContent = document.getElementById('modalContent');
        // Animate modal out
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300); // Match transition duration
    }

    // Tutup modal jika klik di luar area modalContent
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('fasilitasModal');
        const modalContent = document.getElementById('modalContent'); // Use the ID for the inner content
        if (modal && modalContent) {
            modal.addEventListener('mousedown', function(e) {
                if (!modalContent.contains(e.target) && e.target.id === 'fasilitasModal') { // Ensure click is on the overlay, not inside the modal content
                    closeModal();
                }
            });
        }
    });
</script>
@endsection 