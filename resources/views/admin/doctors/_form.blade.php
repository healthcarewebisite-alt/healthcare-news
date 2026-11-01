@csrf
@if(isset($doctor)) @method('PUT') @endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
    <div class="lg:col-span-2 admin-card">
        <label class="admin-label">Nama Dokter</label>
        <input type="text" name="name" value="{{ old('name', $doctor->name ?? '') }}" required class="admin-input" placeholder="dr. Nama Lengkap, Sp.PD">
        @error('name') <p class="text-xs text-breaking mt-1">{{ $message }}</p> @enderror

        <div class="grid grid-cols-2 gap-4 mt-4">
            <div>
                <label class="admin-label">Spesialisasi</label>
                <input type="text" name="specialty" value="{{ old('specialty', $doctor->specialty ?? '') }}" required class="admin-input" placeholder="Jantung, Anak, dll">
            </div>
            <div>
                <label class="admin-label">Rumah Sakit</label>
                <select name="hospital_id" class="admin-input">
                    <option value="">Pilih rumah sakit</option>
                    @foreach($hospitals as $h)
                        <option value="{{ $h->id }}" @selected(old('hospital_id', $doctor->hospital_id ?? '')==$h->id)>{{ $h->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mt-4">
            <div>
                <label class="admin-label">No. STR</label>
                <input type="text" name="str_number" value="{{ old('str_number', $doctor->str_number ?? '') }}" class="admin-input">
            </div>
            <div>
                <label class="admin-label">Lama Pengalaman (tahun)</label>
                <input type="number" name="years_experience" value="{{ old('years_experience', $doctor->years_experience ?? '') }}" min="0" class="admin-input">
            </div>
        </div>

        <label class="admin-label mt-4">Biografi</label>
        <textarea name="bio" rows="4" class="admin-input">{{ old('bio', $doctor->bio ?? '') }}</textarea>
    </div>

    <div class="flex flex-col gap-5">
        <div class="admin-card">
            <label class="admin-label">Foto</label>
            @if(isset($doctor) && $doctor->photo)
                <img src="{{ $doctor->photo_url }}" class="w-24 h-24 object-cover rounded-full mb-2">
            @endif
            <input type="file" name="photo" accept="image/*" class="admin-input">
            <p class="text-xs text-slate-400 mt-1">Otomatis dikonversi ke WebP.</p>
        </div>

        <div class="admin-card">
            <label class="flex items-center gap-2 text-sm text-slate-700">
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $doctor->is_active ?? true)) class="rounded border-slate-300 text-primary focus:ring-primary">
                Aktifkan (tampilkan di direktori)
            </label>
            <button type="submit" class="admin-btn-primary w-full justify-center mt-5">
                {{ isset($doctor) ? 'Simpan Perubahan' : 'Tambah Dokter' }}
            </button>
        </div>
    </div>
</div>
