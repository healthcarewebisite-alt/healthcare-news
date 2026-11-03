<x-layouts.admin>
    <x-slot:title>Dashboard</x-slot:title>

    {{-- Stat Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 {{ auth()->user()->isEditor() ? 'lg:grid-cols-4' : 'lg:grid-cols-2' }} gap-5">
        <div class="admin-stat-card">
            <div>
                <p class="text-sm text-slate-500">Total Berita</p>
                <p class="text-2xl font-bold text-inkdark mt-1">{{ number_format($stats['total_articles']) }}</p>
                <p class="text-xs text-secondary-600 mt-1">
                    {{ $stats['published_articles'] }} terbit ·
                    @if(auth()->user()->isEditor())
                        <a href="{{ route('admin.articles.index', ['status' => 'in_review']) }}" class="hover:underline">{{ $stats['in_review_articles'] }} menunggu review</a>
                    @else
                        {{ $stats['in_review_articles'] }} menunggu review
                    @endif
                </p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-primary-50 flex items-center justify-center text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m6.75 12h-9m9 3h-9m3-6h-3m9-9v3.375c0 .621.504 1.125 1.125 1.125h3.375M4.5 3.75h5.379a2.25 2.25 0 0 1 1.591.659l5.121 5.121a2.25 2.25 0 0 1 .659 1.59V19.5a2.25 2.25 0 0 1-2.25 2.25H4.5a2.25 2.25 0 0 1-2.25-2.25V6a2.25 2.25 0 0 1 2.25-2.25Z" /></svg>
            </div>
        </div>

        <div class="admin-stat-card">
            <div>
                <p class="text-sm text-slate-500">Total Views</p>
                <p class="text-2xl font-bold text-inkdark mt-1">{{ number_format($stats['total_views']) }}</p>
                <p class="text-xs text-slate-400 mt-1">seluruh artikel</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-secondary-50 flex items-center justify-center text-secondary-600">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
            </div>
        </div>

        @if(auth()->user()->isEditor())
        <div class="admin-stat-card">
            <div>
                <p class="text-sm text-slate-500">Rumah Sakit &amp; Dokter</p>
                <p class="text-2xl font-bold text-inkdark mt-1">{{ $stats['total_hospitals'] }} / {{ $stats['total_doctors'] }}</p>
                <p class="text-xs text-slate-400 mt-1">terdaftar di direktori</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center text-amber-500">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15" /></svg>
            </div>
        </div>
        <div class="admin-stat-card">
            <div>
                <p class="text-sm text-slate-500">Komentar Pending</p>
                <p class="text-2xl font-bold text-inkdark mt-1">{{ $stats['pending_comments'] }}</p>
                <p class="text-xs text-slate-400 mt-1">{{ $stats['total_subscribers'] }} subscriber newsletter</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-breaking-50 flex items-center justify-center text-breaking">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" /></svg>
            </div>
        </div>
        @endif
    </div>

    @if(auth()->user()->isEditor())
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-5 mt-5">
        <section class="admin-card">
            <div class="mb-4 flex items-center justify-between gap-3">
                <div>
                    <h2 class="font-bold text-inkdark">Antrean Review Artikel</h2>
                    <p class="text-xs text-slate-500">{{ $stats['in_review_articles'] }} artikel menunggu keputusan</p>
                </div>
                <a href="{{ route('admin.articles.index', ['status' => 'in_review']) }}" class="text-sm font-medium text-primary hover:underline">Buka antrean</a>
            </div>
            <div class="flex flex-col divide-y divide-slate-100">
                @forelse($reviewQueue as $article)
                    <div class="flex flex-wrap items-center justify-between gap-3 py-3 first:pt-0 last:pb-0">
                        <div class="min-w-0">
                            <p class="truncate text-sm font-semibold text-inkdark">{{ $article->title }}</p>
                            <p class="mt-1 text-xs text-slate-500">{{ $article->author->name }} · {{ $article->submitted_for_review_at?->diffForHumans() ?? 'Menunggu review' }}</p>
                        </div>
                        <a href="{{ route('admin.articles.edit', $article) }}" class="shrink-0 text-sm font-medium text-primary hover:underline">Tinjau</a>
                    </div>
                @empty
                    <p class="py-4 text-sm text-slate-500">Tidak ada artikel yang menunggu review.</p>
                @endforelse
            </div>
        </section>

        <section class="admin-card">
            <div class="mb-4 flex items-center justify-between gap-3">
                <div>
                    <h2 class="font-bold text-inkdark">Komentar Menunggu Moderasi</h2>
                    <p class="text-xs text-slate-500">{{ $stats['pending_comments'] }} komentar pending</p>
                </div>
                <a href="{{ route('admin.comments.index', ['status' => 'pending']) }}" class="text-sm font-medium text-primary hover:underline">Moderasi komentar</a>
            </div>
            <div class="flex flex-col divide-y divide-slate-100">
                @forelse($pendingComments as $comment)
                    <div class="py-3 first:pt-0 last:pb-0">
                        <p class="text-sm font-semibold text-inkdark">{{ $comment->author_name }}</p>
                        <p class="mt-1 line-clamp-2 text-sm text-slate-600">{{ $comment->body }}</p>
                        <p class="mt-1 text-xs text-slate-500">pada "{{ $comment->article->title }}"</p>
                    </div>
                @empty
                    <p class="py-4 text-sm text-slate-500">Tidak ada komentar yang menunggu moderasi.</p>
                @endforelse
            </div>
        </section>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mt-5">
        {{-- Berita terbaru --}}
        <div class="lg:col-span-2 admin-card">
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-bold text-inkdark">Berita Terbaru</h2>
                <a href="{{ route('admin.articles.index') }}" class="text-sm text-primary font-medium hover:underline">Lihat Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full admin-table">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Penulis</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentArticles as $article)
                        <tr>
                            <td class="font-medium text-inkdark max-w-xs truncate">{{ $article->title }}</td>
                            <td>{{ $article->category->name }}</td>
                            <td>
                                <span class="px-2 py-0.5 rounded-full text-xs font-semibold
                                    {{ $article->status === 'published' ? 'bg-secondary-50 text-secondary-700' : (in_array($article->status, ['draft', 'scheduled'], true) ? 'bg-slate-100 text-slate-600' : 'bg-breaking-50 text-breaking-700') }}">
                                    {{ ['draft' => 'Draft', 'in_review' => 'Review', 'scheduled' => 'Terjadwal', 'published' => 'Terbit', 'rejected' => 'Revisi', 'archived' => 'Arsip'][$article->status] ?? ucfirst($article->status) }}
                                </span>
                            </td>
                            <td>{{ $article->author->name }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center text-slate-400 py-6">Belum ada berita.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    {{-- Artikel populer --}}
    <div class="admin-card mt-5">
        <h2 class="font-bold text-inkdark mb-4">Artikel Terpopuler</h2>
        <div class="overflow-x-auto">
            <table class="w-full admin-table">
                <thead>
                    <tr><th>#</th><th>Judul</th><th>Views</th></tr>
                </thead>
                <tbody>
                    @forelse($popularArticles as $i => $article)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td class="font-medium text-inkdark">{{ $article->title }}</td>
                        <td>{{ number_format($article->views_count) }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="text-center text-slate-400 py-6">Belum ada data.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.admin>
