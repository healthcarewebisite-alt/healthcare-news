<x-layouts.admin>
    <x-slot:title>Kelola Infografis</x-slot:title>

    <div class="admin-card">
        <div class="flex items-center justify-between mb-5">
            <h2 class="font-bold text-inkdark">Daftar Infografis</h2>
            <a href="{{ route('admin.infographics.create') }}" class="admin-btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                Tambah Infografis
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full admin-table">
                <thead>
                    <tr><th>Gambar</th><th>Judul</th><th>Kategori</th><th>Status</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($infographics as $info)
                    <tr>
                        <td><img src="{{ $info->image_url }}" loading="lazy" class="w-14 h-14 object-cover rounded-lg" alt="{{ $info->title }}"></td>
                        <td class="font-medium text-inkdark max-w-xs truncate">{{ $info->title }}</td>
                        <td>{{ $info->category?->name ?? '-' }}</td>
                        <td>
                            <span class="px-2 py-0.5 rounded-full text-xs font-semibold {{ $info->is_active ? 'bg-secondary-50 text-secondary-700' : 'bg-slate-100 text-slate-500' }}">
                                {{ $info->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td>
                            <div class="flex gap-2">
                                <a href="{{ route('admin.infographics.edit', $info) }}" class="text-primary hover:underline text-sm font-medium">Edit</a>
                                <form method="POST" action="{{ route('admin.infographics.destroy', $info) }}" onsubmit="return confirm('Yakin ingin menghapus infografis ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-breaking hover:underline text-sm font-medium">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center text-slate-400 py-8">Belum ada infografis.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-5">{{ $infographics->links() }}</div>
    </div>
</x-layouts.admin>
