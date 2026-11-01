@props(['size' => 'w-100 h-10'])

{{--
    Component logo Healthcare.id.
    Untuk mengganti logo: cukup timpa file /public/images/logo.png dengan logo baru Anda
    (disarankan gambar persegi/kotak, format PNG transparan, minimal 200x200px).
    Tidak perlu edit file Blade manapun setelah ini.
--}}
<span class="flex items-center justify-center {{ $size }} overflow-hidden flex-shrink-0">
    <img src="{{ asset('images/logo.png') }}" alt="Healthcare.id" class="w-full h-full object-contain">
</span>
