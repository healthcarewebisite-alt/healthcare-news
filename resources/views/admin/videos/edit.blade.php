<x-layouts.admin>
    <x-slot:title>Edit Video</x-slot:title>
    <form method="POST" action="{{ route('admin.videos.update', $video) }}" enctype="multipart/form-data">
        @include('admin.videos._form')
    </form>
</x-layouts.admin>
