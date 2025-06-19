@extends('layouts.app')

@section('title', 'Daftar Fasilitas - PonorogoCafe')
@section('header-title', 'Daftar Fasilitas')
@section('header-description', 'Kelola daftar fasilitas yang tersedia di PonorogoCafe')

@section('content')
<div class="bg-white rounded-xl shadow-md">
    <div class="p-4 lg:p-6">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
            <h1 class="text-xl lg:text-2xl font-bold text-gray-800">Daftar Fasilitas</h1>
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center space-y-2 sm:space-y-0 sm:space-x-3">
                <button onclick="openModal('create')" class="bg-brown-600 hover:bg-brown-700 text-white px-4 lg:px-6 py-2 rounded-lg flex items-center justify-center space-x-2 shadow-md transition-all duration-200 text-sm lg:text-base">
                    <i class="fas fa-plus"></i>
                    <span>Tambah Fasilitas</span>
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
                        <th class="px-3 lg:px-6 py-3 lg:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Fasilitas</th>
                        <th class="px-3 lg:px-6 py-3 lg:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Icon</th>
                        <th class="px-3 lg:px-6 py-3 lg:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($fasilitas as $index => $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-3 lg:px-6 py-3 lg:py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                        <td class="px-3 lg:px-6 py-3 lg:py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->nama_fasilitas }}</td>
                        <td class="px-3 lg:px-6 py-3 lg:py-4 whitespace-nowrap text-sm text-gray-500">{!! $item->icon_svg !!}</td>
                        <td class="px-3 lg:px-6 py-3 lg:py-4 whitespace-nowrap text-sm font-medium space-x-3">
                            <button onclick="openModal('edit', {{ $item->id }}, '{{ $item->nama_fasilitas }}')" class="text-blue-600 hover:text-blue-900 transition-colors">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('fasilitas.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin hapus?')" class="text-red-600 hover:text-red-900 transition-colors">
                                    <i class="fas fa-trash"></i>
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
<div id="fasilitasModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50 p-4">
    <div class="relative top-10 lg:top-20 mx-auto border w-full max-w-md shadow-lg rounded-xl bg-white">
        <div class="p-4 lg:p-5">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-base lg:text-lg font-medium text-gray-900" id="modalTitle">Tambah Fasilitas</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="fasilitasForm" method="POST">
                @csrf
                <div id="methodContainer"></div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Nama Fasilitas</label>
                    <input type="text" name="nama_fasilitas" id="namaFasilitas" class="w-full px-3 lg:px-4 py-2 lg:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent text-sm lg:text-base" placeholder="Masukkan nama fasilitas" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Icon SVG (Heroicons)</label>
                    <textarea name="icon_svg" id="iconSvg" rows="4"
                        class="w-full px-3 lg:px-4 py-2 lg:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent text-sm lg:text-base"
                        placeholder="Tempelkan kode SVG Heroicons di sini (hanya bagian <svg>... </svg>)" 
                        oninput="updateIconPreview(this.value)"
                        required></textarea>
                    <div id="iconPreview" class="mt-2 p-4 border rounded-lg bg-gray-50 flex items-center justify-center">
                        <p class="text-gray-400 text-sm">Preview icon akan muncul di sini</p>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center sm:justify-end space-y-2 sm:space-y-0 sm:space-x-3 mt-6">
                    <button type="button" onclick="closeModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 lg:px-6 py-2 rounded-lg transition-colors text-sm lg:text-base">Batal</button>
                    <button type="submit" class="bg-brown-600 hover:bg-brown-700 text-white px-4 lg:px-6 py-2 rounded-lg transition-colors text-sm lg:text-base">Simpan</button>
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
            } else {
                preview.innerHTML = '<p class="text-red-500 text-sm">Kode SVG tidak valid</p>';
            }
        } else {
            preview.innerHTML = '<p class="text-gray-400 text-sm">Preview icon akan muncul di sini</p>';
        }
    }

    function openModal(action, id = null, nama = '') {
        const modal = document.getElementById('fasilitasModal');
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
    }

    function closeModal() {
        document.getElementById('fasilitasModal').classList.add('hidden');
    }
</script>
@endsection 