@extends('layouts.app')

@section('title', 'Daftar Jam Buka - PonorogoCafe')
@section('header-title', 'Daftar Jam Buka')
@section('header-description', 'Kelola daftar jam buka yang tersedia di PonorogoCafe')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100">
    <div class="p-6">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
            <h1 class="text-xl lg:text-2xl font-bold text-gray-900 tracking-tight">Daftar Jam Buka</h1>
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center space-y-2 sm:space-y-0 sm:space-x-3">
                <button onclick="openModal('create')" class="inline-flex items-center justify-center px-4 py-2.5 rounded-lg text-sm font-medium text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2 shadow-sm transition-all duration-200">
                    <i class="fas fa-plus mr-2 text-xs"></i>
                    <span>Tambah Jam Buka</span>
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
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Jam Buka</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Waktu Buka</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach($jambuka as $index => $item)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->jam_buka }}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->waktu_buka }}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium space-x-2">
                            <button onclick="openModal('edit', {{ $item->id }}, '{{ $item->jam_buka }}', '{{ $item->waktu_buka }}')" class="inline-flex items-center justify-center w-8 h-8 rounded-full text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition-colors duration-200" title="Edit">
                                <i class="fas fa-edit text-xs"></i>
                            </button>
                            <form action="{{ route('jam_buka.destroy', $item->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin hapus data ini?')" class="inline-flex items-center justify-center w-8 h-8 rounded-full text-red-600 hover:bg-red-50 hover:text-red-700 transition-colors duration-200" title="Hapus">
                                    <i class="fas fa-trash text-xs"></i>
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
<div id="jamBukaModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden flex items-center justify-center p-4 z-50">
    <div class="relative bg-white rounded-xl shadow-xl w-full max-w-md overflow-hidden transform transition-all sm:my-8 sm:w-full">
        <div class="p-6">
            <div class="flex items-center justify-between mb-5">
                <h3 class="text-lg font-semibold text-gray-900" id="modalTitle">Tambah Jam Buka</h3>
                <button onclick="closeModal()" class="p-2 rounded-lg text-gray-400 hover:text-gray-600 hover:bg-gray-50 transition-colors duration-200">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
            <form id="jamBukaForm" method="POST">
                @csrf
                <div id="methodContainer"></div>
                
                <div class="mb-4">
                    <label for="jamBuka" class="block text-gray-700 text-sm font-medium mb-2">Jam Buka</label>
                    <input type="text" name="jam_buka" id="jamBuka" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent text-sm text-gray-800 placeholder-gray-400 transition-colors duration-200" placeholder="Contoh: 08:00 - 17:00" required>
                </div>
                
                <div class="mb-6">
                    <label for="waktuBuka" class="block text-gray-700 text-sm font-medium mb-2">Waktu Buka</label>
                    <select name="waktu_buka" id="waktuBuka" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent text-sm text-gray-800 transition-colors duration-200" required>
                        <option value="">Pilih Waktu Buka</option>
                        <option value="pagi">Pagi</option>
                        <option value="siang">Siang</option>
                        <option value="sore">Sore</option>
                        <option value="24">24 Jam</option>
                    </select>
                </div>
                
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center sm:justify-end space-y-3 sm:space-y-0 sm:space-x-3 mt-6">
                    <button type="button" onclick="closeModal()" class="inline-flex items-center justify-center px-4 py-2.5 rounded-lg text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-200 focus:ring-offset-2 transition-all duration-200">Batal</button>
                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2.5 rounded-lg text-sm font-medium text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2 shadow-sm transition-all duration-200">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openModal(action, id = null, jam = '', waktu = '') {
        const modal = document.getElementById('jamBukaModal');
        const title = document.getElementById('modalTitle');
        const form = document.getElementById('jamBukaForm');
        const methodContainer = document.getElementById('methodContainer');
        const jamInput = document.getElementById('jamBuka');
        const waktuInput = document.getElementById('waktuBuka');
        
        if (action === 'create') {
            title.textContent = 'Tambah Jam Buka';
            form.action = "{{ route('jam_buka.store') }}";
            methodContainer.innerHTML = '';
            jamInput.value = '';
            waktuInput.value = '';
        } else if (action === 'edit') {
            title.textContent = 'Edit Jam Buka';
            form.action = `/jam_buka/${id}`;
            methodContainer.innerHTML = '@method("PUT")';
            jamInput.value = jam;
            waktuInput.value = waktu;
        }
        
        modal.classList.remove('hidden');
        modal.classList.add('flex'); // Use flex to center the modal
    }

    function closeModal() {
        const modal = document.getElementById('jamBukaModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex'); // Remove flex when hidden
    }

    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('jamBukaModal');
        if (modal) {
            modal.addEventListener('mousedown', function(e) {
                // Check if the click is directly on the modal background, not its content
                if (e.target === modal) {
                    closeModal();
                }
            });
        }
    });
</script>
@endsection