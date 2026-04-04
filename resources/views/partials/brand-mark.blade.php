{{-- شعار بسيط للهوية البصرية؛ variant=welcome لصفحة الدخول (أرحب) --}}
@php
    if (($variant ?? '') === 'welcome') {
        $mark = 'أ';
        $title = 'أرحب';
    } else {
        $mark = mb_strtoupper(mb_substr(config('app.name', 'A'), 0, 1));
        $title = config('app.name', 'Azir');
    }
@endphp
<div class="mx-auto mb-8 flex flex-col items-center">
    <div class="flex size-14 items-center justify-center rounded-2xl bg-[#d4ff3f] text-xl font-bold text-zinc-950 shadow-lg shadow-[#d4ff3f]/25 ring-2 ring-zinc-700/50" aria-hidden="true">
        {{ $mark }}
    </div>
    <p class="mt-3 text-sm font-semibold tracking-tight text-zinc-100">{{ $title }}</p>
    @if (($variant ?? '') !== 'welcome')
        <p class="text-xs text-zinc-500">لوحة الموردين</p>
    @endif
</div>
