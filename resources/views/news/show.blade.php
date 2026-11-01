<x-layouts.app>
    <x-slot:title>{{ $article->meta_title ?: $article->title }}</x-slot:title>
    <x-slot:description>{{ $article->meta_description ?: $article->excerpt }}</x-slot:description>
    <x-slot:image>{{ $article->featured_image_url }}</x-slot:image>
    <x-slot:type>article</x-slot:type>

    <div class="max-w-7xl mx-auto px-4 md:px-6 py-6 grid grid-cols-1 lg:grid-cols-12 gap-8">
        {{-- Konten utama --}}
        <article class="lg:col-span-8">
            <nav class="text-xs text-slate-400 mb-3">
                <a href="{{ route('home') }}" class="hover:text-primary">Home</a> /
                <a href="{{ route('news.category', $article->category->slug) }}" class="hover:text-primary">{{ $article->category->name }}</a>
            </nav>

            <span class="badge-category">{{ $article->category->icon }} {{ $article->category->name }}</span>
            <h1 class="mt-3 text-2xl md:text-3xl font-extrabold text-inkdark leading-tight">{{ $article->title }}</h1>

            <div class="mt-3 flex items-center gap-3 text-sm text-slate-500">
                <span class="font-medium text-inkdark">{{ $article->author->name }}</span>
                <span>&bull;</span>
                <span>{{ $article->published_at?->translatedFormat('d F Y, H:i') }}</span>
                <span>&bull;</span>
                <span>{{ $article->reading_time }} menit baca</span>
                <span>&bull;</span>
                <span>{{ number_format($article->views_count) }} views</span>
            </div>

            <div class="mt-5 rounded-card overflow-hidden">
                <img src="{{ $article->featured_image_url }}" alt="{{ $article->featured_image_alt ?? $article->title }}"
                     loading="eager" fetchpriority="high" class="w-full h-auto object-cover">
            </div>

            {{-- Konten dari Trix editor - HTML sudah aman karena hanya admin/editor yang bisa menulis --}}
            <div class="article-content mt-6">
                {!! $article->content !!}
            </div>

            @if($article->tags->count())
            <div class="mt-6 flex flex-wrap gap-2">
                @foreach($article->tags as $tag)
                    <span class="text-xs bg-slate-100 text-slate-600 px-3 py-1 rounded-full">#{{ $tag->name }}</span>
                @endforeach
            </div>
            @endif

            {{-- Komentar --}}
            <section class="mt-10 pt-8 border-t border-slate-200">
                <h2 class="font-bold text-lg text-inkdark mb-5">Komentar ({{ $article->approvedComments->count() }})</h2>

                @if(session('success'))
                    <p class="mb-4 text-sm bg-secondary-50 text-secondary-700 rounded-lg px-4 py-2.5">{{ session('success') }}</p>
                @endif

                <form method="POST" action="{{ route('news.comment.store', $article) }}" class="mb-8 flex flex-col gap-3">
                    @csrf
                    @guest
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <input type="text" name="guest_name" placeholder="Nama Anda" required class="admin-input">
                        <input type="email" name="guest_email" placeholder="Email Anda" required class="admin-input">
                    </div>
                    @endguest
                    <textarea name="body" rows="3" required minlength="3" placeholder="Tulis komentar Anda..." class="admin-input"></textarea>
                    <button type="submit" class="btn-primary w-fit">Kirim Komentar</button>
                </form>

                <div class="flex flex-col gap-5">
                    @forelse($article->approvedComments as $comment)
                    <div class="flex gap-3">
                        <div class="w-9 h-9 rounded-full bg-primary-100 text-primary-700 flex items-center justify-center font-bold text-sm flex-shrink-0">
                            {{ strtoupper(substr($comment->author_name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-inkdark">{{ $comment->author_name }}</p>
                            <p class="text-xs text-slate-400">{{ $comment->created_at->diffForHumans() }}</p>
                            <p class="text-sm text-slate-600 mt-1">{{ $comment->body }}</p>
                        </div>
                    </div>
                    @empty
                    <p class="text-sm text-slate-400">Jadilah yang pertama berkomentar.</p>
                    @endforelse
                </div>
            </section>
        </article>

        {{-- Sidebar --}}
        <aside class="lg:col-span-4 flex flex-col gap-6">
            <div>
                <h2 class="section-title mb-4">Berita Terkait</h2>
                <div class="flex flex-col gap-4">
                    @foreach($relatedArticles as $related)
                        <a href="{{ route('news.show', $related->slug) }}" class="flex gap-3 group">
                            <img src="{{ $related->featured_image_url }}" alt="{{ $related->title }}" loading="lazy"
                                 class="w-20 h-16 object-cover rounded-lg flex-shrink-0">
                            <p class="text-sm font-semibold text-inkdark line-clamp-2 group-hover:text-primary transition-colors">{{ $related->title }}</p>
                        </a>
                    @endforeach
                </div>
            </div>

            <div>
                <h2 class="section-title mb-4">Populer</h2>
                <div class="flex flex-col gap-3">
                    @foreach($popularArticles as $i => $pop)
                        <a href="{{ route('news.show', $pop->slug) }}" class="flex gap-3 items-start">
                            <span class="w-6 h-6 rounded-full bg-primary-50 text-primary-700 font-bold text-xs flex items-center justify-center flex-shrink-0">{{ $i + 1 }}</span>
                            <p class="text-sm font-medium text-inkdark line-clamp-2">{{ $pop->title }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        </aside>
    </div>
</x-layouts.app>
