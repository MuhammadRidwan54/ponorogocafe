@extends('layouts.app')

@section('title', 'Daftar Kapasitas Ruang - PonorogoCafe')
@section('header-title', 'Daftar Kapasitas Ruang')
@section('header-description', 'Kelola daftar kapasitas ruang yang tersedia di PonorogoCafe')

@section('content')
<div class="bg-white rounded-xl shadow-lg border border-gray-100">
    <div class="p-6 lg:p-8">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
            <h1 class="text-xl lg:text-2xl font-bold text-gray-900">Daftar Kapasitas Ruang</h1>
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center space-y-2 sm:space-y-0 sm:space-x-3">
                <button onclick="openModal('create')" class="bg-gray-900 hover:bg-gray-800 text-white px-5 py-2.5 rounded-lg flex items-center justify-center space-x-2 shadow-md transition-all duration-200 text-sm font-medium">
                    <i class="fas fa-plus text-xs"></i>
                    <span>Tambah Kapasitas Ruang</span>
                </button>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg relative mb-6 text-sm" role="alert">
                <span class="block sm:inline font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Table -->
        <div class="overflow-x-auto rounded-lg border border-gray-100">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 lg:px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                        <th class="px-4 lg:px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kapasitas Ruang</th>
                        <th class="px-4 lg:px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach($kapasitasruang as $index => $item)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-4 lg:px-6 py-3.5 whitespace-nowrap text-sm text-gray-800">{{ $index + 1 }}</td>
                        <td class="px-4 lg:px-6 py-3.5 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->kapasitas_ruang }}</td>
                        <td class="px-4 lg:px-6 py-3.5 whitespace-nowrap text-sm font-medium space-x-3">
                            <button onclick="openModal('edit', {{ $item->id }}, '{{ $item->kapasitas_ruang }}')" class="text-gray-600 hover:text-gray-900 transition-colors duration-200 p-1 rounded-md hover:bg-gray-100">
                                <i class="fas fa-edit text-sm"></i>
                            </button>
                            <form action="{{ route('kapasitas_ruang.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin hapus data ini?')" class="text-red-600 hover:text-red-800 transition-colors duration-200 p-1 rounded-md hover:bg-red-50">
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
<div id="kapasitasRuangModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden flex items-center justify-center p-4 z-50">
    <div class="relative bg-white w-full max-w-md rounded-xl shadow-2xl border border-gray-100 transform transition-all duration-300 scale-95 opacity-0" id="modalContent">
        <div class="p-6 lg:p-7">
            <div class="flex items-center justify-between mb-5">
                <h3 class="text-lg lg:text-xl font-semibold text-gray-900" id="modalTitle">Tambah Kapasitas Ruang</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 p-2 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
            <form id="kapasitasRuangForm" method="POST">
                @csrf
                <div id="methodContainer"></div>
                
                <div class="mb-5">
                    <label for="kapasitasRuang" class="block text-gray-700 text-sm font-medium mb-2">Kapasitas Ruang</label>
                    <input type="text" name="kapasitas_ruang" id="kapasitasRuang"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-300 focus:border-transparent text-sm text-gray-800 placeholder-gray-400 transition-colors duration-200"
                           placeholder="Masukkan kapasitas ruang" required>
                </div>
                
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center sm:justify-end space-y-3 sm:space-y-0 sm:space-x-3 mt-6">
                    <button type="button" onclick="closeModal()" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2.5 rounded-lg transition-colors text-sm font-medium">Batal</button>
                    <button type="submit" class="bg-gray-900 hover:bg-gray-800 text-white px-5 py-2.5 rounded-lg transition-colors text-sm font-medium">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openModal(action, id = null, kapasitas = '') {
        const modal = document.getElementById('kapasitasRuangModal');
        const modalContent = document.getElementById('modalContent');
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
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 50); // Small delay for transition to apply
    }

    function closeModal() {
        const modal = document.getElementById('kapasitasRuangModal');
        const modalContent = document.getElementById('modalContent');
        
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300); // Match transition duration
    }

    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('kapasitasRuangModal');
        const modalContent = document.getElementById('modalContent');
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