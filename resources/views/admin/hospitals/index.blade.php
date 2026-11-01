<x-layouts.admin>
    <x-slot:title>Kelola Rumah Sakit</x-slot:title>

    <div class="admin-card">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-5">
            <h2 class="font-bold text-inkdark">Direktori Rumah Sakit</h2>
            <a href="{{ route('admin.hospitals.create') }}" class="admin-btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                Tambah Rumah Sakit
            </a>
        </div>

        <form method="GET" class="mb-5">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama rumah sakit..." class="admin-input max-w-sm">
        </form>

        <div class="overflow-x-auto">
            <table class="w-full admin-table">
                <thead>
                    <tr><th>Logo</th><th>Nama</th><th>Kota</th><th>Tipe</th><th>Rating</th><th>BPJS</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($hospitals as $hospital)
                    <tr>
                        <td><img src="{{ $hospital->logo_url }}" loading="lazy" class="w-10 h-10 object-contain rounded-lg bg-slate-50" alt="{{ $hospital->name }}"></td>
                        <td class="font-medium text-inkdark">{{ $hospital->name }}</td>
                        <td>{{ $hospital->city }}</td>
                        <td>{{ $hospital->type }}</td>
                        <td>&#9733; {{ $hospital->rating }}</td>
                        <td>{{ $hospital->is_bpjs ? 'Ya' : 'Tidak' }}</td>
                        <td>
                            <div class="flex gap-2">
                                <a href="{{ route('admin.hospitals.edit', $hospital) }}" class="text-primary hover:underline text-sm font-medium">Edit</a>
                                <form method="POST" action="{{ route('admin.hospitals.destroy', $hospital) }}" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-breaking hover:underline text-sm font-medium">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center text-slate-400 py-8">Belum ada data rumah sakit.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-5">{{ $hospitals->links() }}</div>
    </div>
</x-layouts.admin>
