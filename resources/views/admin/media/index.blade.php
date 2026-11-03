<x-layouts.admin>
    <x-slot:title>Media Library</x-slot:title>

    <div class="admin-card">
        <div class="mb-6">
            <h2 class="font-bold text-inkdark">Media Library</h2>
            <p class="mt-1 text-sm text-slate-500">Gambar WebP dari artikel, editor, direktori, dan infografis. Gambar yang masih dipakai dilindungi dari penghapusan.</p>
        </div>

        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6">
            @forelse($media as $item)
                <article class="overflow-hidden rounded-lg border border-slate-200 bg-white">
                    <img src="{{ $item['url'] }}" alt="" loading="lazy" class="aspect-square w-full object-cover">
                    <div class="p-3">
                        <p class="truncate text-xs font-medium text-inkdark" title="{{ $item['path'] }}">{{ basename($item['path']) }}</p>
                        <p class="mt-1 text-xs text-slate-500">{{ number_format($item['size'] / 1024, 1) }} KB</p>
                        @if($selectionMode)
                            <button type="button" class="mt-2 text-xs font-semibold text-primary hover:underline" data-media-url="{{ $item['url'] }}" onclick="window.opener?.postMessage({ type: 'healthcare-media-select', url: this.dataset.mediaUrl }, window.location.origin); window.close();">Sisipkan ke artikel</button>
                        @elseif($item['used'])
                            <span class="mt-2 inline-block rounded-full bg-secondary-50 px-2 py-1 text-xs font-semibold text-secondary-700">Sedang digunakan</span>
                        @else
                            <form method="POST" action="{{ route('admin.media.destroy', ['path' => $item['path']]) }}" class="mt-2" onsubmit="return confirm('Hapus media ini secara permanen?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs font-semibold text-breaking hover:underline">Hapus media</button>
                            </form>
                        @endif
                    </div>
                </article>
            @empty
                <p class="col-span-full py-10 text-center text-sm text-slate-500">Belum ada media editorial.</p>
            @endforelse
        </div>

        <div class="mt-6">{{ $media->links() }}</div>
    </div>
</x-layouts.admin>
