<x-layouts.admin>
    <x-slot:title>Kelola Video</x-slot:title>

    <div class="admin-card">
        <div class="mb-5 flex flex-col justify-between gap-3 sm:flex-row sm:items-center">
            <div>
                <h2 class="font-bold text-inkdark">Video Healthcare</h2>
                <p class="mt-1 text-sm text-slate-500">Video aktif tampil pada halaman Video dan beranda.</p>
            </div>
            <a href="{{ route('admin.videos.create') }}" class="admin-btn-primary">Tambah Video</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full admin-table">
                <thead><tr><th>Thumbnail</th><th>Judul</th><th>YouTube ID</th><th>Status</th><th>Aksi</th></tr></thead>
                <tbody>
                    @forelse($videos as $video)
                        <tr>
                            <td><img src="{{ $video->thumbnail_url }}" alt="" class="h-14 w-24 rounded object-cover"></td>
                            <td class="font-medium text-inkdark">{{ $video->title }}</td>
                            <td>{{ $video->youtube_id }}</td>
                            <td>{{ $video->is_active ? 'Aktif' : 'Nonaktif' }}</td>
                            <td>
                                <div class="flex gap-3">
                                    <a href="{{ route('admin.videos.edit', $video) }}" class="text-primary hover:underline">Edit</a>
                                    <form method="POST" action="{{ route('admin.videos.destroy', $video) }}" onsubmit="return confirm('Hapus video ini?')">
                                        @csrf @method('DELETE')
                                        <button class="text-breaking hover:underline">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="py-8 text-center text-slate-500">Belum ada video.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-5">{{ $videos->links() }}</div>
    </div>
</x-layouts.admin>
