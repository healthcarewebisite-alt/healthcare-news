<x-layouts.admin>
    <x-slot:title>Tambah Rumah Sakit</x-slot:title>
    <form method="POST" action="{{ route('admin.hospitals.store') }}" enctype="multipart/form-data">
        @include('admin.hospitals._form')
    </form>
</x-layouts.admin>
