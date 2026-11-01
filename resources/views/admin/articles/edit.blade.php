<x-layouts.admin>
    <x-slot:title>Edit Berita</x-slot:title>

    <form method="POST" action="{{ route('admin.articles.update', $article) }}" enctype="multipart/form-data">
        @include('admin.articles._form')
    </form>
</x-layouts.admin>
