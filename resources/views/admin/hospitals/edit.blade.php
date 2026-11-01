<x-layouts.admin>
    <x-slot:title>Edit Rumah Sakit</x-slot:title>
    <form method="POST" action="{{ route('admin.hospitals.update', $hospital) }}" enctype="multipart/form-data">
        @include('admin.hospitals._form')
    </form>
</x-layouts.admin>
