@extends('layouts.app')

@section('title', 'إضافة وكيل')

@section('body')
<div class="app-shell pb-24">
    <header class="ui-top-shelf ui-top-shelf--dense">
        <div class="ui-top-shelf__top">
            <div class="flex min-w-0 items-center gap-3">
                <a href="{{ route('agents.index') }}" class="ui-btn-secondary min-h-10 rounded-full px-3 py-2 text-xs">
                    <span class="flex items-center gap-1.5">
                        <svg class="size-4 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" /></svg>
                        رجوع
                    </span>
                </a>
                <div class="min-w-0">
                    <p class="ui-kicker">جديد</p>
                    <h1 class="ui-page-title">إضافة وكيل</h1>
                </div>
            </div>
        </div>
        @include('partials.top-shelf-ayah')
    </header>

    <form method="post" action="{{ route('agents.store') }}" class="ui-card space-y-5">
        @csrf
        @include('agents._form', ['submit' => 'حفظ الوكيل'])
    </form>
</div>
@endsection
