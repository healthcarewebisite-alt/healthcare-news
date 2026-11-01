<x-layouts.admin>
    <x-slot:title>Moderasi Komentar</x-slot:title>

    <div class="admin-card">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-5">
            <h2 class="font-bold text-inkdark">Daftar Komentar</h2>
            <form method="GET" class="flex gap-2">
                <select name="status" onchange="this.form.submit()" class="admin-input">
                    <option value="">Semua Status</option>
                    <option value="pending" @selected(request('status')==='pending')>Pending</option>
                    <option value="approved" @selected(request('status')==='approved')>Approved</option>
                    <option value="spam" @selected(request('status')==='spam')>Spam</option>
                </select>
            </form>
        </div>

        <div class="flex flex-col gap-3">
            @forelse($comments as $comment)
            <div class="border border-slate-100 rounded-lg p-4">
                <div class="flex items-start justify-between gap-3">
                    <div class="min-w-0">
                        <p class="text-sm font-semibold text-inkdark">{{ $comment->author_name }}</p>
                        <p class="text-xs text-slate-400">pada "{{ $comment->article->title }}" &bull; {{ $comment->created_at->diffForHumans() }}</p>
                        <p class="text-sm text-slate-600 mt-2">{{ $comment->body }}</p>
                    </div>
                    <span class="flex-shrink-0 px-2 py-0.5 rounded-full text-xs font-semibold
                        {{ $comment->status === 'approved' ? 'bg-secondary-50 text-secondary-700' : ($comment->status === 'pending' ? 'bg-amber-50 text-amber-600' : 'bg-breaking-50 text-breaking-700') }}">
                        {{ ucfirst($comment->status) }}
                    </span>
                </div>
                <div class="flex gap-3 mt-3">
                    @if($comment->status !== 'approved')
                    <form method="POST" action="{{ route('admin.comments.update-status', $comment) }}">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status" value="approved">
                        <button type="submit" class="text-secondary-600 hover:underline text-xs font-semibold">Setujui</button>
                    </form>
                    @endif
                    @if($comment->status !== 'spam')
                    <form method="POST" action="{{ route('admin.comments.update-status', $comment) }}">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status" value="spam">
                        <button type="submit" class="text-amber-600 hover:underline text-xs font-semibold">Tandai Spam</button>
                    </form>
                    @endif
                    <form method="POST" action="{{ route('admin.comments.destroy', $comment) }}" onsubmit="return confirm('Hapus komentar ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-breaking hover:underline text-xs font-semibold">Hapus</button>
                    </form>
                </div>
            </div>
            @empty
            <p class="text-center text-slate-400 py-8">Belum ada komentar.</p>
            @endforelse
        </div>
        <div class="mt-5">{{ $comments->links() }}</div>
    </div>
</x-layouts.admin>
