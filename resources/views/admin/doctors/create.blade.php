<x-layouts.admin>
    <x-slot:title>Tambah Dokter</x-slot:title>
    <form method="POST" action="{{ route('admin.doctors.store') }}" enctype="multipart/form-data">
        @include('admin.doctors._form')
    </form>
</x-layouts.admin>
