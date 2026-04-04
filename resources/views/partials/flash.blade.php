@if (session('status'))
    <div class="mb-5 flex items-start gap-3 rounded-2xl border border-[#d4ff3f]/25 bg-zinc-900/90 px-4 py-3.5 text-sm text-zinc-100 shadow-lg shadow-black/20 ring-1 ring-zinc-700/80" role="status">
        <span class="mt-0.5 flex size-5 shrink-0 items-center justify-center rounded-full bg-[#d4ff3f]/20 text-[#d4ff3f]" aria-hidden="true">
            <svg class="size-3" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
        </span>
        <span class="leading-relaxed">{{ session('status') }}</span>
    </div>
@endif
