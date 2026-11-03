<x-layouts.admin>
    <x-slot:title>Edit {{ $contentPage->title }}</x-slot:title>

    <div class="admin-card max-w-4xl">
        <div class="mb-5">
            <h2 class="font-bold text-inkdark">Edit Halaman: {{ $contentPage->title }}</h2>
            <p class="mt-1 text-sm text-slate-500">URL halaman tetap /{{ $contentPage->slug }}. Pisahkan paragraf dengan satu baris kosong.</p>
        </div>
        <form method="POST" action="{{ route('admin.pages.update', $contentPage) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="admin-label">Judul halaman</label>
                <input id="title" name="title" value="{{ old('title', $contentPage->title) }}" required maxlength="150" class="admin-input">
                @error('title') <p class="mt-1 text-xs text-breaking">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="content" class="admin-label">Konten</label>
                <textarea id="content" name="content" rows="12" required maxlength="50000" class="admin-input">{{ old('content', $contentPage->content) }}</textarea>
                <p class="mt-1 text-xs text-slate-500">Teks ditampilkan sebagai paragraf biasa; HTML tidak dijalankan.</p>
                @error('content') <p class="mt-1 text-xs text-breaking">{{ $message }}</p> @enderror
            </div>

            <fieldset class="rounded-lg border border-slate-200 p-4">
                <legend class="px-1 text-sm font-semibold text-inkdark">Informasi Kontak (opsional)</legend>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label for="email_label" class="admin-label">Label email</label>
                        <input id="email_label" name="email_label" value="{{ old('email_label', $contentPage->email_label) }}" maxlength="100" class="admin-input">
                        @error('email_label') <p class="mt-1 text-xs text-breaking">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="email" class="admin-label">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email', $contentPage->email) }}" maxlength="255" class="admin-input">
                        @error('email') <p class="mt-1 text-xs text-breaking">{{ $message }}</p> @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="address" class="admin-label">Alamat</label>
                        <textarea id="address" name="address" rows="2" maxlength="1000" class="admin-input">{{ old('address', $contentPage->address) }}</textarea>
                        @error('address') <p class="mt-1 text-xs text-breaking">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="phone" class="admin-label">Telepon</label>
                        <input id="phone" name="phone" value="{{ old('phone', $contentPage->phone) }}" maxlength="50" class="admin-input">
                        @error('phone') <p class="mt-1 text-xs text-breaking">{{ $message }}</p> @enderror
                    </div>
                </div>
            </fieldset>

            <div class="flex flex-wrap gap-3">
                <button type="submit" class="admin-btn-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.pages.index') }}" class="admin-btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</x-layouts.admin>
