<x-layouts.admin>
    <x-slot:title>Tambah Pengguna</x-slot:title>
    <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
        @include('admin.users._form')
    </form>
</x-layouts.admin>
