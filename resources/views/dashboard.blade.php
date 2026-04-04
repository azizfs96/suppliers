@extends('layouts.app')

@section('title', 'الرئيسية')

@section('body')
<div class="app-shell pb-28">
    <header class="ui-top-shelf">
        <div class="ui-top-shelf__top">
            <div class="min-w-0">
                <p class="ui-kicker">لوحة التحكم</p>
                <h1 class="mt-1 truncate text-2xl font-bold tracking-tight text-white">مرحباً، {{ auth()->user()->name }}</h1>
                <p class="mt-1 text-sm text-zinc-400">نظرة سريعة على نشاطك</p>
            </div>
            <form method="post" action="{{ route('logout') }}" class="shrink-0">
                @csrf
                <button type="submit" class="ui-btn-secondary min-h-10 rounded-full px-3.5 py-2 text-xs font-semibold text-zinc-200">
                    خروج
                </button>
            </form>
        </div>
        @include('partials.top-shelf-ayah')
    </header>

    @include('partials.flash')

    <div class="ui-stats-row">
        <a href="{{ route('agents.index') }}" class="ui-stat-tile">
            <span class="ui-stat-tile__label">
                <span class="ui-stat-tile__dot" aria-hidden="true"></span>
                الوكلاء
            </span>
            <p class="ui-stat-tile__value">{{ $agentsCount }}</p>
        </a>
        <a href="{{ route('agents.index') }}" class="ui-stat-tile" title="الماركات مرتبطة بالوكلاء">
            <span class="ui-stat-tile__label">
                <span class="ui-stat-tile__dot" aria-hidden="true"></span>
                الماركات
            </span>
            <p class="ui-stat-tile__value">{{ $brandsCount }}</p>
        </a>
        <a href="{{ route('sku-gen') }}" class="ui-stat-tile">
            <span class="ui-stat-tile__label">
                <span class="ui-stat-tile__dot" aria-hidden="true"></span>
                SKU
            </span>
            <p class="ui-stat-tile__value">{{ $skuCount }}</p>
        </a>
    </div>

    <div class="ui-dash-list">
        <a href="{{ route('agents.index') }}" class="ui-dash-tile">
            <span class="ui-dash-tile__edge" aria-hidden="true"></span>
            <span class="ui-dash-tile__icon" aria-hidden="true">
                <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" /></svg>
            </span>
            <div class="ui-dash-tile__body">
                <h2 class="ui-dash-tile__title">قائمة الوكلاء</h2>
                <p class="ui-dash-tile__desc">إدارة الوكلاء، الماركات، ومندوبي المبيعات</p>
            </div>
            <span class="ui-dash-tile__chevron" aria-hidden="true">
                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="transform: rotate(180deg)"><path stroke-linecap="round" stroke-linejoin="round" d="m15 19-7-7 7-7" /></svg>
            </span>
        </a>

        <a href="{{ route('sku-gen') }}" class="ui-dash-tile">
            <span class="ui-dash-tile__edge" aria-hidden="true"></span>
            <span class="ui-dash-tile__icon" aria-hidden="true">
                <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M7.875 14.063 6 18l3.937-.875L7.875 14.063ZM12 9c-1.243 0-2.25 1.007-2.25 2.25S10.757 13.5 12 13.5s2.25-1.007 2.25-2.25S13.243 9 12 9Zm0-6.75C6.615 2.25 2.25 6.615 2.25 12S6.615 21.75 12 21.75 21.75 17.385 21.75 12 17.385 2.25 12 2.25Z" /></svg>
            </span>
            <div class="ui-dash-tile__body">
                <h2 class="ui-dash-tile__title">SKU-GEN</h2>
                <p class="ui-dash-tile__desc">مولّد رموز المنتجات — قريباً</p>
            </div>
            <span class="ui-dash-tile__chevron" aria-hidden="true">
                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="transform: rotate(180deg)"><path stroke-linecap="round" stroke-linejoin="round" d="m15 19-7-7 7-7" /></svg>
            </span>
        </a>
    </div>
</div>
@endsection
