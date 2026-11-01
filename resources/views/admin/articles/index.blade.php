<x-layouts.admin>
    <x-slot:title>Kelola Berita</x-slot:title>

    <div class="admin-card">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-5">
            <h2 class="font-bold text-inkdark">Daftar Berita</h2>
            <a href="{{ route('admin.articles.create') }}" class="admin-btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                Tambah Berita
            </a>
        </div>

        <form method="GET" class="flex flex-col sm:flex-row gap-3 mb-5">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul berita..." class="admin-input flex-1">
            <select name="status" class="admin-input sm:w-48">
                <option value="">Semua Status</option>
                <option value="draft" @selected(request('status')==='draft')>Draft</option>
                <option value="published" @selected(request('status')==='published')>Published</option>
                <option value="archived" @selected(request('status')==='archived')>Archived</option>
            </select>
            <select name="kategori" class="admin-input sm:w-48">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" @selected(request('kategori')==$cat->id)>{{ $cat->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="admin-btn-primary">Filter</button>
        </form>

        <div class="overflow-x-auto">
            <table class="w-full admin-table">
                <thead>
                    <tr>
                        <th>Gambar</th><th>Judul</th><th>Kategori</th><th>Status</th><th>Views</th><th>Tanggal</th><th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($articles as $article)
                    <tr>
                        <td>
                            <img src="{{ $article->featured_image_url }}" loading="lazy" class="w-14 h-10 object-cover rounded-md" alt="{{ $article->title }}">
                        </td>
                        <td class="font-medium text-inkdark max-w-xs">
                            <span class="line-clamp-1">{{ $article->title }}</span>
                            @if($article->is_headline)<span class="text-xs text-primary">&#9679; Headline</span>@endif
                            @if($article->is_breaking)<span class="text-xs text-breaking ml-1">&#9679; Breaking</span>@endif
                        </td>
                        <td>{{ $article->category->name }}</td>
                        <td>
                            <span class="px-2 py-0.5 rounded-full text-xs font-semibold
                                {{ $article->status === 'published' ? 'bg-secondary-50 text-secondary-700' : ($article->status === 'draft' ? 'bg-slate-100 text-slate-600' : 'bg-breaking-50 text-breaking-700') }}">
                                {{ ucfirst($article->status) }}
                            </span>
                        </td>
                        <td>{{ number_format($article->views_count) }}</td>
                        <td>{{ $article->created_at->translatedFormat('d M Y') }}</td>
                        <td>
                            <div class="flex gap-2">
                                <a href="{{ route('admin.articles.edit', $article) }}" class="text-primary hover:underline text-sm font-medium">Edit</a>
                                <form method="POST" action="{{ route('admin.articles.destroy', $article) }}" onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-breaking hover:underline text-sm font-medium">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center text-slate-400 py-8">Belum ada berita. Silakan tambah berita baru.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-5">{{ $articles->links() }}</div>
    </div>
</x-layouts.admin>
