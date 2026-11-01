<x-layouts.admin>
    <x-slot:title>Edit Infografis</x-slot:title>
    <form method="POST" action="{{ route('admin.infographics.update', $infographic) }}" enctype="multipart/form-data">
        @include('admin.infographics._form')
    </form>
</x-layouts.admin>
