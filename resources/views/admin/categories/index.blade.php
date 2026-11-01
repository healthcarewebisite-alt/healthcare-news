<x-layouts.admin>
    <x-slot:title>Kelola Kategori</x-slot:title>

    <div class="admin-card">
        <div class="flex items-center justify-between mb-5">
            <h2 class="font-bold text-inkdark">Daftar Kategori</h2>
            <a href="{{ route('admin.categories.create') }}" class="admin-btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                Tambah Kategori
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full admin-table">
                <thead>
                    <tr><th>Icon</th><th>Nama</th><th>Slug</th><th>Jumlah Berita</th><th>Status</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($categories as $cat)
                    <tr>
                        <td class="text-2xl">{{ $cat->icon }}</td>
                        <td class="font-medium text-inkdark">{{ $cat->name }}</td>
                        <td class="text-slate-400">{{ $cat->slug }}</td>
                        <td>{{ $cat->articles_count }}</td>
                        <td>
                            <span class="px-2 py-0.5 rounded-full text-xs font-semibold {{ $cat->is_active ? 'bg-secondary-50 text-secondary-700' : 'bg-slate-100 text-slate-500' }}">
                                {{ $cat->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td>
                            <div class="flex gap-2">
                                <a href="{{ route('admin.categories.edit', $cat) }}" class="text-primary hover:underline text-sm font-medium">Edit</a>
                                <form method="POST" action="{{ route('admin.categories.destroy', $cat) }}" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-breaking hover:underline text-sm font-medium">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center text-slate-400 py-8">Belum ada kategori.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-5">{{ $categories->links() }}</div>
    </div>
</x-layouts.admin>
