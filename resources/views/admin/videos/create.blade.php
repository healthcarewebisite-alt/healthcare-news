<x-layouts.admin>
    <x-slot:title>Tambah Video</x-slot:title>
    <form method="POST" action="{{ route('admin.videos.store') }}" enctype="multipart/form-data">
        @include('admin.videos._form')
    </form>
</x-layouts.admin>
