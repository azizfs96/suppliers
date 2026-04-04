@extends('layouts.app')

@section('title', 'SKU-GEN')

@section('body')
<div class="app-shell pb-24">
    <header class="ui-top-shelf ui-top-shelf--dense">
        <div class="ui-top-shelf__top">
            <div class="flex min-w-0 items-center gap-3">
                <a href="{{ route('dashboard') }}" class="ui-btn-secondary min-h-10 rounded-full px-3 py-2 text-xs">
                    <span class="flex items-center gap-1.5">
                        <svg class="size-4 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" /></svg>
                        رجوع
                    </span>
                </a>
                <div class="min-w-0">
                    <p class="ui-kicker">قريباً</p>
                    <h1 class="ui-page-title">SKU-GEN</h1>
                </div>
            </div>
        </div>
        @include('partials.top-shelf-ayah')
    </header>

    <div class="ui-card--soft flex flex-col items-center py-16 text-center">
        <div class="mb-5 flex size-20 items-center justify-center rounded-3xl bg-zinc-800 text-[#d4ff3f] ring-1 ring-zinc-600/80">
            <svg class="size-10" fill="none" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" /></svg>
        </div>
        <h2 class="text-lg font-bold text-white">جاري التجهيز</h2>
        <p class="mt-2 max-w-sm text-sm leading-relaxed text-zinc-400">هذه المساحة مخصصة لمولّد رموز SKU. سنفعّلها في تحديث قادم.</p>
    </div>
</div>
@endsection
