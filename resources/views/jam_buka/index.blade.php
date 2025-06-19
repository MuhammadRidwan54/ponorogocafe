@extends('layouts.app')

@section('title', 'Daftar Jam Buka - PonorogoCafe')
@section('header-title', 'Daftar Jam Buka')
@section('header-description', 'Kelola daftar jam buka yang tersedia di PonorogoCafe')

@section('content')
<div class="bg-white rounded-xl shadow-md">
    <div class="p-4 lg:p-6">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
            <h1 class="text-xl lg:text-2xl font-bold text-gray-800">Daftar Jam Buka</h1>
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center space-y-2 sm:space-y-0 sm:space-x-3">
                <button onclick="openModal('create')" class="bg-brown-600 hover:bg-brown-700 text-white px-4 lg:px-6 py-2 rounded-lg flex items-center justify-center space-x-2 shadow-md transition-all duration-200 text-sm lg:text-base">
                    <i class="fas fa-plus"></i>
                    <span>Tambah Jam Buka</span>
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
                        <th class="px-3 lg:px-6 py-3 lg:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jam Buka</th>
                        <th class="px-3 lg:px-6 py-3 lg:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu Buka</th>
                        <th class="px-3 lg:px-6 py-3 lg:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($jambuka as $index => $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-3 lg:px-6 py-3 lg:py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                        <td class="px-3 lg:px-6 py-3 lg:py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->jam_buka }}</td>
                        <td class="px-3 lg:px-6 py-3 lg:py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->waktu_buka }}</td>
                        <td class="px-3 lg:px-6 py-3 lg:py-4 whitespace-nowrap text-sm font-medium space-x-3">
                            <button onclick="openModal('edit', {{ $item->id }}, '{{ $item->jam_buka }}', '{{ $item->waktu_buka }}')" class="text-blue-600 hover:text-blue-900 transition-colors">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('jam_buka.destroy', $item->id) }}" method="POST" style="display:inline-block;">
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
<div id="jamBukaModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50 p-4">
    <div class="relative top-10 lg:top-20 mx-auto border w-full max-w-md shadow-lg rounded-xl bg-white">
        <div class="p-4 lg:p-5">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-base lg:text-lg font-medium text-gray-900" id="modalTitle">Tambah Jam Buka</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="jamBukaForm" method="POST">
                @csrf
                <div id="methodContainer"></div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Jam Buka</label>
                    <input type="text" name="jam_buka" id="jamBuka" class="w-full px-3 lg:px-4 py-2 lg:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent text-sm lg:text-base" placeholder="Masukkan jam buka" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Waktu Buka</label>
                    <select name="waktu_buka" id="waktuBuka" class="w-full px-3 lg:px-4 py-2 lg:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent text-sm lg:text-base" required>
                        <option value="">Pilih Waktu Buka</option>
                        <option value="pagi">Pagi</option>
                        <option value="siang">Siang</option>
                        <option value="sore">Sore</option>
                        <option value="24">24 Jam</option>
                    </select>
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
    }

    function closeModal() {
        document.getElementById('jamBukaModal').classList.add('hidden');
    }
</script>
@endsection