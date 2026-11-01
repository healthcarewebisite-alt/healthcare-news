@csrf
@if(isset($hospital)) @method('PUT') @endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
    <div class="lg:col-span-2 admin-card">
        <label class="admin-label">Nama Rumah Sakit</label>
        <input type="text" name="name" value="{{ old('name', $hospital->name ?? '') }}" required class="admin-input">
        @error('name') <p class="text-xs text-breaking mt-1">{{ $message }}</p> @enderror

        <div class="grid grid-cols-2 gap-4 mt-4">
            <div>
                <label class="admin-label">Tipe</label>
                <input type="text" name="type" value="{{ old('type', $hospital->type ?? '') }}" class="admin-input" placeholder="RS Umum, RS Khusus, Klinik">
            </div>
            <div>
                <label class="admin-label">Kota</label>
                <input type="text" name="city" value="{{ old('city', $hospital->city ?? '') }}" required class="admin-input">
            </div>
        </div>

        <label class="admin-label mt-4">Provinsi</label>
        <input type="text" name="province" value="{{ old('province', $hospital->province ?? '') }}" required class="admin-input">

        <label class="admin-label mt-4">Alamat Lengkap</label>
        <textarea name="address" rows="2" required class="admin-input">{{ old('address', $hospital->address ?? '') }}</textarea>

        <div class="grid grid-cols-2 gap-4 mt-4">
            <div>
                <label class="admin-label">Telepon</label>
                <input type="text" name="phone" value="{{ old('phone', $hospital->phone ?? '') }}" class="admin-input">
            </div>
            <div>
                <label class="admin-label">Email</label>
                <input type="email" name="email" value="{{ old('email', $hospital->email ?? '') }}" class="admin-input">
            </div>
        </div>

        <label class="admin-label mt-4">Website</label>
        <input type="url" name="website" value="{{ old('website', $hospital->website ?? '') }}" class="admin-input" placeholder="https://">

        <div class="grid grid-cols-2 gap-4 mt-4">
            <div>
                <label class="admin-label">Latitude</label>
                <input type="text" name="latitude" value="{{ old('latitude', $hospital->latitude ?? '') }}" class="admin-input">
            </div>
            <div>
                <label class="admin-label">Longitude</label>
                <input type="text" name="longitude" value="{{ old('longitude', $hospital->longitude ?? '') }}" class="admin-input">
            </div>
        </div>

        <label class="admin-label mt-4">Fasilitas (pisahkan dengan koma)</label>
        <input type="text" name="facilities" value="{{ old('facilities', isset($hospital) ? implode(', ', $hospital->facilities ?? []) : '') }}" class="admin-input" placeholder="IGD 24 Jam, ICU, Laboratorium">

        <label class="admin-label mt-4">Deskripsi</label>
        <textarea name="description" rows="4" class="admin-input">{{ old('description', $hospital->description ?? '') }}</textarea>
    </div>

    <div class="flex flex-col gap-5">
        <div class="admin-card">
            <label class="admin-label">Logo</label>
            @if(isset($hospital) && $hospital->logo)
                <img src="{{ $hospital->logo_url }}" class="w-20 h-20 object-contain rounded-lg bg-slate-50 mb-2">
            @endif
            <input type="file" name="logo" accept="image/*" class="admin-input">
            <p class="text-xs text-slate-400 mt-1">Otomatis dikonversi ke WebP.</p>

            <label class="admin-label mt-4">Gambar Sampul</label>
            @if(isset($hospital) && $hospital->cover_image)
                <img src="{{ $hospital->cover_image_url ?? '' }}" class="w-full aspect-video object-cover rounded-lg mb-2">
            @endif
            <input type="file" name="cover_image" accept="image/*" class="admin-input">
        </div>

        <div class="admin-card">
            <label class="flex items-center gap-2 mb-3 text-sm text-slate-700">
                <input type="checkbox" name="is_bpjs" value="1" @checked(old('is_bpjs', $hospital->is_bpjs ?? false)) class="rounded border-slate-300 text-primary focus:ring-primary">
                Menerima BPJS Kesehatan
            </label>
            <label class="flex items-center gap-2 text-sm text-slate-700">
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $hospital->is_active ?? true)) class="rounded border-slate-300 text-primary focus:ring-primary">
                Aktifkan (tampilkan di direktori)
            </label>
            <button type="submit" class="admin-btn-primary w-full justify-center mt-5">
                {{ isset($hospital) ? 'Simpan Perubahan' : 'Tambah Rumah Sakit' }}
            </button>
        </div>
    </div>
</div>
