<x-layouts.admin>
    <x-slot:title>Tambah Berita</x-slot:title>

    <form method="POST" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data">
        @include('admin.articles._form')
    </form>
</x-layouts.admin>
