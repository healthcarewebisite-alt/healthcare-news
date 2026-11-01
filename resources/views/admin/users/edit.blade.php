<x-layouts.admin>
    <x-slot:title>Edit Pengguna</x-slot:title>
    <form method="POST" action="{{ route('admin.users.update', $user) }}" enctype="multipart/form-data">
        @include('admin.users._form')
    </form>
</x-layouts.admin>
