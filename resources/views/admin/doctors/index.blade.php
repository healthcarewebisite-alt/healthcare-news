<x-layouts.admin>
    <x-slot:title>Kelola Dokter</x-slot:title>

    <div class="admin-card">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-5">
            <h2 class="font-bold text-inkdark">Direktori Dokter</h2>
            <a href="{{ route('admin.doctors.create') }}" class="admin-btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                Tambah Dokter
            </a>
        </div>

        <form method="GET" class="mb-5">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama dokter..." class="admin-input max-w-sm">
        </form>

        <div class="overflow-x-auto">
            <table class="w-full admin-table">
                <thead>
                    <tr><th>Foto</th><th>Nama</th><th>Spesialis</th><th>Rumah Sakit</th><th>Pengalaman</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($doctors as $doctor)
                    <tr>
                        <td><img src="{{ $doctor->photo_url }}" loading="lazy" class="w-10 h-10 object-cover rounded-full" alt="{{ $doctor->name }}"></td>
                        <td class="font-medium text-inkdark">{{ $doctor->name }}</td>
                        <td>{{ $doctor->specialty }}</td>
                        <td>{{ $doctor->hospital?->name ?? '-' }}</td>
                        <td>{{ $doctor->years_experience ? $doctor->years_experience . ' tahun' : '-' }}</td>
                        <td>
                            <div class="flex gap-2">
                                <a href="{{ route('admin.doctors.edit', $doctor) }}" class="text-primary hover:underline text-sm font-medium">Edit</a>
                                <form method="POST" action="{{ route('admin.doctors.destroy', $doctor) }}" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-breaking hover:underline text-sm font-medium">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center text-slate-400 py-8">Belum ada data dokter.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-5">{{ $doctors->links() }}</div>
    </div>
</x-layouts.admin>
