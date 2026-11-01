@csrf
@if(isset($user)) @method('PUT') @endif

<div class="admin-card max-w-2xl">
    <label class="admin-label">Nama Lengkap</label>
    <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" required class="admin-input">
    @error('name') <p class="text-xs text-breaking mt-1">{{ $message }}</p> @enderror

    <label class="admin-label mt-4">Email</label>
    <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" required class="admin-input">
    @error('email') <p class="text-xs text-breaking mt-1">{{ $message }}</p> @enderror

    <label class="admin-label mt-4">{{ isset($user) ? 'Kata Sandi Baru (kosongkan jika tidak diubah)' : 'Kata Sandi' }}</label>
    <input type="password" name="password" class="admin-input" {{ isset($user) ? '' : 'required' }} minlength="8">
    @error('password') <p class="text-xs text-breaking mt-1">{{ $message }}</p> @enderror

    <label class="admin-label mt-4">Role</label>
    <select name="role" required class="admin-input">
        <option value="member" @selected(old('role', $user->role ?? '')==='member')>Member</option>
        <option value="author" @selected(old('role', $user->role ?? '')==='author')>Author (dapat menulis berita sendiri)</option>
        <option value="editor" @selected(old('role', $user->role ?? '')==='editor')>Editor (kelola semua konten)</option>
        <option value="super_admin" @selected(old('role', $user->role ?? '')==='super_admin')>Super Admin (akses penuh)</option>
    </select>

    <label class="admin-label mt-4">Bio</label>
    <textarea name="bio" rows="3" class="admin-input">{{ old('bio', $user->bio ?? '') }}</textarea>

    <label class="admin-label mt-4">Avatar</label>
    @if(isset($user) && $user->avatar)
        <img src="{{ $user->avatar_url }}" class="w-16 h-16 object-cover rounded-full mb-2">
    @endif
    <input type="file" name="avatar" accept="image/*" class="admin-input">
    <p class="text-xs text-slate-400 mt-1">Otomatis dikonversi ke WebP.</p>

    <label class="flex items-center gap-2 mt-4 text-sm text-slate-700">
        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $user->is_active ?? true)) class="rounded border-slate-300 text-primary focus:ring-primary">
        Akun aktif
    </label>

    <button type="submit" class="admin-btn-primary mt-5">
        {{ isset($user) ? 'Simpan Perubahan' : 'Tambah Pengguna' }}
    </button>
</div>
