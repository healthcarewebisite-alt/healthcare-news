{{-- Beri padding bottom ekstra di mobile agar tidak tertutup bottom nav --}}
<footer class="bg-inkdark text-slate-300 pb-20 md:pb-0">
    <div class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-2 md:grid-cols-4 gap-8">
        <div class="col-span-2">
            <div class="flex items-center gap-2 mb-3">
                <x-logo/>
            </div>
            <p class="text-sm text-slate-400 max-w-sm">
                Healthcare &amp; Lifestyle. Menyajikan karya jurnalistik untuk ekosistem kesehatan Indonesia.
            </p>
            <p class="mt-3 text-sm font-semibold text-white">Health First</p>
        </div>

        <div>
            <h4 class="text-white font-semibold mb-3 text-sm">Healthcare.id</h4>
            <ul class="space-y-2 text-sm text-slate-400">
                <li><a href="{{ route('pages.about') }}" class="hover:text-white">About Us</a></li>
                <li><a href="{{ route('pages.advertise') }}" class="hover:text-white">Advertise</a></li>
                <li><a href="{{ route('pages.magazine') }}" class="hover:text-white">Magazine</a></li>
                <li><a href="{{ route('pages.contact') }}" class="hover:text-white">Contact Us</a></li>
                <li><a href="{{ route('pages.privacy') }}" class="hover:text-white">Privacy Policy</a></li>
                <li><a href="{{ route('pages.events') }}" class="hover:text-white">Event &amp; Promotion</a></li>
            </ul>
        </div>

        <div>
            <h4 class="text-white font-semibold mb-3 text-sm">Hubungi Redaksi</h4>
            <a href="mailto:redaksi@healthcare.id" class="break-all text-sm text-slate-400 hover:text-white sm:break-normal">redaksi@healthcare.id</a>
            <p class="mt-2 text-sm text-slate-400">+62 812-8906-2919</p>
        </div>
    </div>

    <div class="border-t border-white/10 py-4">
        <p class="text-center text-xs text-slate-500">
            &copy; {{ date('Y') }} Healthcare.id. Seluruh hak cipta dilindungi.
        </p>
    </div>
</footer>
