{{-- <div>
    <input type="hidden" name="_method" value="PUT">
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Nama Cafe</label>
            <input type="text" name="nama_cafe" value="{{ $cafe->nama_cafe }}" class="w-full px-3 lg:px-4 py-2 lg:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Alamat</label>
            <textarea name="alamat" rows="3" class="w-full px-3 lg:px-4 py-2 lg:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent" required>{{ $cafe->alamat }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Jam Buka</label>
            <select name="jambuka_id" class="w-full px-3 lg:px-4 py-2 lg:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent" required>
                <option value="">Pilih Jam Buka</option>
                @foreach($jambuka as $jb)
                    <option value="{{ $jb->id }}" {{ $cafe->jambuka_id == $jb->id ? 'selected' : '' }}>{{ $jb->jam_buka }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Harga Menu</label>
            <select name="hargamenu_id" class="w-full px-3 lg:px-4 py-2 lg:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent" required>
                <option value="">Pilih Harga Menu</option>
                @foreach($hargamenu as $hm)
                    <option value="{{ $hm->id }}" {{ $cafe->hargamenu_id == $hm->id ? 'selected' : '' }}>{{ $hm->harga_menu }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Kapasitas Ruang</label>
            <select name="kapasitasruang_id" class="w-full px-3 lg:px-4 py-2 lg:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent" required>
                <option value="">Pilih Kapasitas Ruang</option>
                @foreach($kapasitasruang as $kr)
                    <option value="{{ $kr->id }}" {{ $cafe->kapasitasruang_id == $kr->id ? 'selected' : '' }}>{{ $kr->kapasitas_ruang }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Tempat Parkir</label>
            <select name="tempatparkir_id" class="w-full px-3 lg:px-4 py-2 lg:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent" required>
                <option value="">Pilih Tempat Parkir</option>
                @foreach($tempatparkir as $tp)
                    <option value="{{ $tp->id }}" {{ $cafe->tempatparkir_id == $tp->id ? 'selected' : '' }}>{{ $tp->tempat_parkir }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Thumbnail</label>
            <input type="file" name="thumbnail" 
                class="w-full px-3 lg:px-4 py-2 lg:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent" 
                accept="image/*">
            @if($cafe->thumbnail)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $cafe->thumbnail) }}" class="h-16 w-16 object-cover rounded-lg">
                    <p class="text-sm text-gray-500 mt-1">Thumbnail saat ini</p>
                </div>
            @endif
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Gambar</label>
            <div id="imageInputs">
                @if($cafe->gambar)
                    @foreach(json_decode($cafe->gambar) as $index => $gambar)
                        <div class="image-input-group flex items-center space-x-2 mb-2">
                            <img src="{{ asset('storage/' . $gambar) }}" class="h-16 w-16 object-cover rounded-lg">
                            <input type="file" name="gambar[]" 
                                class="w-full px-3 lg:px-4 py-2 lg:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent" 
                                accept="image/*">
                            <button type="button" onclick="removeImageInput(this)" class="text-red-600 hover:text-red-900">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    @endforeach
                @else
                    <div class="image-input-group flex items-center space-x-2 mb-2">
                        <input type="file" name="gambar[]" 
                            class="w-full px-3 lg:px-4 py-2 lg:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent" 
                            accept="image/*">
                        <button type="button" onclick="removeImageInput(this)" class="text-red-600 hover:text-red-900">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                @endif
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
            @foreach($fasilitas as $f)
                <div class="flex items-center">
                    <input type="checkbox" name="fasilitas_id[]" value="{{ $f->id }}" id="fasilitas{{ $f->id }}" 
                        class="rounded border-gray-300 text-brown-600 focus:ring-brown-500"
                        {{ $cafe->fasilitas->contains($f->id) ? 'checked' : '' }}>
                    <label for="fasilitas{{ $f->id }}" class="ml-2 text-sm text-gray-700">{{ $f->nama_fasilitas }}</label>
                </div>
            @endforeach
        </div>
    </div>
</div> --}}