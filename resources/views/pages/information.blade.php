<x-layouts.app>
    <x-slot:title>{{ $page['title'] }} - Healthcare.id</x-slot:title>

    <article class="max-w-4xl mx-auto px-4 md:px-6 py-12 md:py-16">
        <p class="text-xs font-bold uppercase tracking-[0.2em] text-primary">Healthcare.id</p>
        <h1 class="mt-3 text-3xl md:text-4xl font-extrabold text-inkdark">{{ $page['title'] }}</h1>

        <div class="mt-8 space-y-5 text-base leading-8 text-slate-600">
            @foreach($page['paragraphs'] as $paragraph)
                <p>{{ $paragraph }}</p>
            @endforeach

            @if(!empty($page['email']))
                <p>
                    <span class="font-semibold text-inkdark">{{ $page['email_label'] ?: 'Email' }}:</span>
                    <a class="text-primary hover:underline" href="mailto:{{ $page['email'] }}">{{ $page['email'] }}</a>
                </p>
            @endif

            @if(!empty($page['address']))
                <p><span class="font-semibold text-inkdark">Alamat:</span> {{ $page['address'] }}</p>
            @endif

            @if(!empty($page['phone']))
                <p>
                    <span class="font-semibold text-inkdark">Telepon:</span>
                    <a class="text-primary hover:underline" href="tel:{{ preg_replace('/[^0-9+]/', '', $page['phone']) }}">{{ $page['phone'] }}</a>
                </p>
            @endif
        </div>
    </article>
</x-layouts.app>
