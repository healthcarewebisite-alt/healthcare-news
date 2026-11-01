<x-layouts.admin>
    <x-slot:title>Tambah Kategori</x-slot:title>
    <form method="POST" action="{{ route('admin.categories.store') }}">
        @include('admin.categories._form')
    </form>
</x-layouts.admin>
