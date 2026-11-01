{{-- Beri padding bottom ekstra di mobile agar tidak tertutup bottom nav --}}
<footer class="bg-inkdark text-slate-300 pb-20 md:pb-0">
    <div class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-2 md:grid-cols-4 gap-8">
        <div class="col-span-2">
            <div class="flex items-center gap-2 mb-3">
                <x-logo/>
            </div>
            <p class="text-sm text-slate-400 max-w-sm">
                Media digital kesehatan nasional yang menyajikan informasi, edukasi, riset, inovasi, rumah sakit, teknologi kesehatan, dan kebijakan kesehatan.
            </p>
        </div>

        <div>
            <h4 class="text-white font-semibold mb-3 text-sm">Tentang</h4>
            <ul class="space-y-2 text-sm text-slate-400">
                <li><a href="#" class="hover:text-white">Tentang Kami</a></li>
                <li><a href="#" class="hover:text-white">Redaksi</a></li>
                <li><a href="#" class="hover:text-white">Pedoman Media Siber</a></li>
                <li><a href="#" class="hover:text-white">Disclaimer</a></li>
                <li><a href="#" class="hover:text-white">Privacy Policy</a></li>
                <li><a href="#" class="hover:text-white">Kontak</a></li>
            </ul>
        </div>

        <div>
            <h4 class="text-white font-semibold mb-3 text-sm">Media Sosial</h4>
            <div class="flex gap-3">
                <a href="#" class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center hover:bg-primary transition-colors" aria-label="Facebook">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><path d="M22 12a10 10 0 1 0-11.6 9.9v-7H7.9V12h2.5V9.8c0-2.5 1.5-3.9 3.8-3.9 1.1 0 2.2.2 2.2.2v2.4h-1.3c-1.2 0-1.6.8-1.6 1.6V12h2.8l-.4 2.9h-2.4v7A10 10 0 0 0 22 12z"/></svg>
                </a>
                <a href="#" class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center hover:bg-primary transition-colors" aria-label="Instagram">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><path d="M12 2c2.7 0 3.1 0 4.1.1 1 0 1.7.2 2.3.5.6.2 1.1.6 1.6 1.1.5.5.8.9 1.1 1.6.3.6.4 1.3.5 2.3 0 1 .1 1.4.1 4.1s0 3.1-.1 4.1c0 1-.2 1.7-.5 2.3-.2.6-.6 1.1-1.1 1.6-.5.5-.9.8-1.6 1.1-.6.3-1.3.4-2.3.5-1 0-1.4.1-4.1.1s-3.1 0-4.1-.1c-1 0-1.7-.2-2.3-.5-.6-.2-1.1-.6-1.6-1.1-.5-.5-.8-.9-1.1-1.6-.3-.6-.4-1.3-.5-2.3 0-1-.1-1.4-.1-4.1s0-3.1.1-4.1c0-1 .2-1.7.5-2.3.2-.6.6-1.1 1.1-1.6.5-.5.9-.8 1.6-1.1.6-.3 1.3-.4 2.3-.5C8.9 2 9.3 2 12 2zm0 5a5 5 0 1 0 0 10 5 5 0 0 0 0-10zm0 8.2a3.2 3.2 0 1 1 0-6.4 3.2 3.2 0 0 1 0 6.4zm5.2-8.4a1.2 1.2 0 1 1-2.4 0 1.2 1.2 0 0 1 2.4 0z"/></svg>
                </a>
                <a href="#" class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center hover:bg-primary transition-colors" aria-label="YouTube">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><path d="M23 12s0-3.6-.5-5.2c-.3-1-1-1.7-2-2C18.9 4.3 12 4.3 12 4.3s-6.9 0-8.5.5c-1 .3-1.7 1-2 2C1 8.4 1 12 1 12s0 3.6.5 5.2c.3 1 1 1.7 2 2 1.6.5 8.5.5 8.5.5s6.9 0 8.5-.5c1-.3 1.7-1 2-2 .5-1.6.5-5.2.5-5.2zM9.8 15.3V8.7l5.8 3.3-5.8 3.3z"/></svg>
                </a>
            </div>
        </div>
    </div>

    <div class="border-t border-white/10 py-4">
        <p class="text-center text-xs text-slate-500">
            &copy; {{ date('Y') }} Healthcare.id. Seluruh hak cipta dilindungi.
        </p>
    </div>
</footer>
