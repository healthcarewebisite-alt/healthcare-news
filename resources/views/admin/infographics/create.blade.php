<x-layouts.admin>
    <x-slot:title>Tambah Infografis</x-slot:title>
    <form method="POST" action="{{ route('admin.infographics.store') }}" enctype="multipart/form-data">
        @include('admin.infographics._form')
    </form>
</x-layouts.admin>
