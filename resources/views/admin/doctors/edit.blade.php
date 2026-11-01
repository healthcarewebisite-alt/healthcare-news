<x-layouts.admin>
    <x-slot:title>Edit Dokter</x-slot:title>
    <form method="POST" action="{{ route('admin.doctors.update', $doctor) }}" enctype="multipart/form-data">
        @include('admin.doctors._form')
    </form>
</x-layouts.admin>
