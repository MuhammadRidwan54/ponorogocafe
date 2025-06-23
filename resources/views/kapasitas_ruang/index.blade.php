@extends('layouts.app')

@section('title', 'Daftar Kapasitas Ruang - PonorogoCafe')
@section('header-title', 'Daftar Kapasitas Ruang')
@section('header-description', 'Kelola daftar kapasitas ruang yang tersedia di PonorogoCafe')

@section('content')
<div class="bg-white rounded-xl shadow-md">
    <div class="p-4 lg:p-6">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
            <h1 class="text-xl lg:text-2xl font-bold text-gray-800">Daftar Kapasitas Ruang</h1>
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center space-y-2 sm:space-y-0 sm:space-x-3">
                <button onclick="openModal('create')" class="bg-brown-600 hover:bg-brown-700 text-white px-4 lg:px-6 py-2 rounded-lg flex items-center justify-center space-x-2 shadow-md transition-all duration-200 text-sm lg:text-base">
                    <i class="fas fa-plus"></i>
                    <span>Tambah Kapasitas Ruang</span>
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
                        <th class="px-3 lg:px-6 py-3 lg:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kapasitas Ruang</th>
                        <th class="px-3 lg:px-6 py-3 lg:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($kapasitasruang as $index => $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-3 lg:px-6 py-3 lg:py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                        <td class="px-3 lg:px-6 py-3 lg:py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->kapasitas_ruang }}</td>
                        <td class="px-3 lg:px-6 py-3 lg:py-4 whitespace-nowrap text-sm font-medium space-x-3">
                            <button onclick="openModal('edit', {{ $item->id }}, '{{ $item->kapasitas_ruang }}')" class="text-blue-600 hover:text-blue-900 transition-colors">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('kapasitas_ruang.destroy', $item->id) }}" method="POST" style="display:inline-block;">
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
<div id="kapasitasRuangModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50 p-4">
    <div class="relative top-10 lg:top-20 mx-auto border w-full max-w-md shadow-lg rounded-xl bg-white">
        <div class="p-4 lg:p-5">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-base lg:text-lg font-medium text-gray-900" id="modalTitle">Tambah Kapasitas Ruang</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="kapasitasRuangForm" method="POST">
                @csrf
                <div id="methodContainer"></div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Kapasitas Ruang</label>
                    <input type="text" name="kapasitas_ruang" id="kapasitasRuang" 
                           class="w-full px-3 lg:px-4 py-2 lg:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent text-sm lg:text-base" 
                           placeholder="Masukkan kapasitas ruang" required>
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
    function openModal(action, id = null, kapasitas = '') {
        const modal = document.getElementById('kapasitasRuangModal');
        const title = document.getElementById('modalTitle');
        const form = document.getElementById('kapasitasRuangForm');
        const methodContainer = document.getElementById('methodContainer');
        const kapasitasInput = document.getElementById('kapasitasRuang');
        
        if (action === 'create') {
            title.textContent = 'Tambah Kapasitas Ruang';
            form.action = "{{ route('kapasitas_ruang.store') }}";
            methodContainer.innerHTML = '';
            kapasitasInput.value = '';
        } else if (action === 'edit') {
            title.textContent = 'Edit Kapasitas Ruang';
            form.action = `/kapasitas_ruang/${id}`;
            methodContainer.innerHTML = '@method("PUT")';
            kapasitasInput.value = kapasitas;
        }
        
        modal.classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('kapasitasRuangModal').classList.add('hidden');
    }
    // ...fungsi updateIconPreview, openModal, closeModal...

    // Tutup modal jika klik di luar area modalContent
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('kapasitasRuangModal');
        const modalContent = document.querySelector('#kapasitasRuangModal .relative');

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