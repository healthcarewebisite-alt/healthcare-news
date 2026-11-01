<x-layouts.admin>
    <x-slot:title>Edit Kategori</x-slot:title>
    <form method="POST" action="{{ route('admin.categories.update', $category) }}">
        @include('admin.categories._form')
    </form>
</x-layouts.admin>
