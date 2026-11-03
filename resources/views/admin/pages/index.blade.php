<x-layouts.admin>
    <x-slot:title>Halaman Informasi</x-slot:title>

    <div class="admin-card">
        <div class="mb-5">
            <h2 class="font-bold text-inkdark">Halaman Informasi</h2>
            <p class="mt-1 text-sm text-slate-500">Kelola konten halaman yang ditautkan pada situs publik.</p>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full admin-table">
                <thead>
                    <tr><th>Judul</th><th>URL</th><th>Kontak</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @foreach($pages as $page)
                        <tr>
                            <td class="font-medium text-inkdark">{{ $page->title }}</td>
                            <td><a href="{{ route('pages.show', $page->slug) }}" class="text-primary hover:underline">/{{ $page->slug }}</a></td>
                            <td>{{ $page->email ?: '—' }}</td>
                            <td><a href="{{ route('admin.pages.edit', $page) }}" class="font-medium text-primary hover:underline">Edit</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.admin>
