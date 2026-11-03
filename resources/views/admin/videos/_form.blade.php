@csrf
@if(isset($video)) @method('PUT') @endif

<div class="admin-card max-w-2xl">
    <label for="video-title" class="admin-label">Judul Video</label>
    <input id="video-title" name="title" value="{{ old('title', $video->title ?? '') }}" required maxlength="255" class="admin-input">
    @error('title') <p class="mt-1 text-xs text-breaking">{{ $message }}</p> @enderror

    <label for="youtube-id" class="admin-label mt-4">YouTube Video ID</label>
    <input id="youtube-id" name="youtube_id" value="{{ old('youtube_id', $video->youtube_id ?? '') }}" required pattern="[A-Za-z0-9_-]{11}" maxlength="11" class="admin-input" placeholder="11 karakter, bukan URL">
    @error('youtube_id') <p class="mt-1 text-xs text-breaking">{{ $message }}</p> @enderror

    <label for="video-description" class="admin-label mt-4">Deskripsi</label>
    <textarea id="video-description" name="description" rows="4" maxlength="5000" class="admin-input">{{ old('description', $video->description ?? '') }}</textarea>

    <label for="video-thumbnail" class="admin-label mt-4">Thumbnail khusus (Opsional)</label>
    @if(isset($video))
        <img src="{{ $video->thumbnail_url }}" alt="Pratinjau thumbnail video" class="mb-3 aspect-video w-full rounded-lg object-cover">
    @endif
    <input id="video-thumbnail" type="file" name="thumbnail" accept="image/jpeg,image/png,image/webp" class="admin-input">
    <p class="mt-1 text-xs text-slate-500">Jika dikosongkan, thumbnail YouTube digunakan. Maksimum 5 MB.</p>
    @error('thumbnail') <p class="mt-1 text-xs text-breaking">{{ $message }}</p> @enderror

    <label class="mt-4 flex items-center gap-2 text-sm text-slate-700">
        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $video->is_active ?? true))>
        Aktifkan dan tampilkan di portal
    </label>

    <button type="submit" class="admin-btn-primary mt-5">{{ isset($video) ? 'Simpan Perubahan' : 'Tambah Video' }}</button>
</div>
