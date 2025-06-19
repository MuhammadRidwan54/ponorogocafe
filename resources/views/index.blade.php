
<div class="max-w-4xl mx-auto py-10" x-data="dropdownFilter()">
    <h1 class="text-3xl font-bold mb-4">Rekomendasi Cafe untuk Anda</h1>
    <p class="mb-6">Cari rekomendasi cafe sesuai kriteria</p>

    <form action="{{ route('home.hasil') }}" method="GET" class="relative bg-yellow-800 text-white p-6 rounded-lg shadow">
        <div class="mb-4">
            <label class="block mb-1 font-bold">Kriteria</label>
            <div class="relative">
                <input 
                    type="text" 
                    x-model="selectedText" 
                    readonly 
                    @click="showDropdown = !showDropdown"
                    placeholder="Pilih kriteria..." 
                    class="w-full p-3 rounded text-black cursor-pointer"
                />
                <div class="absolute top-full left-0 w-full bg-white shadow rounded mt-2 z-10"
                     x-show="showDropdown"
                     @click.away="showDropdown = false"
                     x-transition>
                    <div class="p-4 space-y-4 text-black">
                        <!-- Harga Menu -->
                        <div>
                            <p class="font-semibold mb-1">Harga Menu</p>
                            @foreach ($hargamenu as $item)
                                <label class="block">
                                    <input type="radio" name="harga_menu" value="{{ $item->id }}"
                                           @click="selectSingle('Harga: {{ $item->harga_menu }}')">
                                    <span class="ml-1">{{ $item->harga_menu }}</span>
                                </label>
                            @endforeach
                        </div>

                        <!-- Kapasitas Ruang -->
                        <div>
                            <p class="font-semibold mb-1">Kapasitas Ruang</p>
                            @foreach ($kapasitasruang as $item)
                                <label class="block">
                                    <input type="radio" name="kapasitas_ruang" value="{{ $item->id }}"
                                           @click="selectSingle('Kapasitas: {{ $item->kapasitas_ruang }}')">
                                    <span class="ml-1">{{ $item->kapasitas_ruang }}</span>
                                </label>
                            @endforeach
                        </div>

                        <!-- Tempat Parkir -->
                        <div>
                            <p class="font-semibold mb-1">Tempat Parkir</p>
                            @foreach ($tempatParkir as $item)
                                <label class="block">
                                    <input type="radio" name="tempat_parkir" value="{{ $item->id }}"
                                           @click="selectSingle('Parkir: {{ $item->tempat_parkir }}')">
                                    <span class="ml-1">{{ $item->tempat_parkir }}</span>
                                </label>
                            @endforeach
                        </div>

                        <!-- Fasilitas -->
                        <div>
                            <p class="font-semibold mb-1">Fasilitas</p>
                            @foreach ($fasilitas as $item)
                                <label class="block">
                                    <input type="checkbox" name="fasilitas[]" value="{{ $item->id }}"
                                           @click="toggleFasilitas('{{ $item->nama_fasilitas }}')">
                                    <span class="ml-1">{{ $item->nama_fasilitas }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="bg-white text-yellow-800 font-bold px-6 py-2 rounded hover:bg-gray-100 mt-4">
            🔍 Cari
        </button>
    </form>
</div>


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
function dropdownFilter() {
    return {
        showDropdown: false,
        selectedText: '',
        fasilitasList: [],
        selectSingle(text) {
            this.selectedText = text;
            this.showDropdown = false;
        },
        toggleFasilitas(name) {
            if (this.fasilitasList.includes(name)) {
                this.fasilitasList = this.fasilitasList.filter(item => item !== name);
            } else {
                this.fasilitasList.push(name);
            }
            this.selectedText = this.fasilitasList.join(', ');
        }
    }
}
</script>
@endpush
