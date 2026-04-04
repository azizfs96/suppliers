@extends('layouts.app')

@section('title', 'قائمة الوكلاء')

@section('body')
<div class="app-shell pb-24">
    <header class="ui-top-shelf ui-top-shelf--dense">
        <div class="ui-top-shelf__top">
            <div class="flex min-w-0 items-center gap-3">
                <a href="{{ route('dashboard') }}" class="ui-btn-secondary min-h-10 shrink-0 rounded-full px-3 py-2 text-xs" title="الرئيسية">
                    <span class="flex items-center gap-1.5">
                        <svg class="size-4 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" /></svg>
                        رجوع
                    </span>
                </a>
                <div class="min-w-0">
                    <p class="ui-kicker">الشبكة</p>
                    <h1 class="ui-page-title truncate">الوكلاء</h1>
                </div>
            </div>
            <a href="{{ route('agents.create') }}" class="ui-btn-accent shrink-0 px-4 py-2.5 text-xs shadow-lg shadow-[#d4ff3f]/15">
                + إضافة
            </a>
        </div>
        @include('partials.top-shelf-ayah')
    </header>

    @include('partials.flash')

    <div class="ui-agent-export" role="group" aria-label="تصدير قائمة الوكلاء">
        <span class="ui-agent-export__label">تصدير</span>
        <a href="{{ route('agents.export.csv') }}" class="ui-agent-export__btn">CSV</a>
        <a href="{{ route('agents.export.xlsx') }}" class="ui-agent-export__btn">Excel</a>
    </div>

    @if ($agents->isEmpty())
        <div class="ui-agent-empty">
            <div class="ui-agent-empty__icon" aria-hidden="true">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" /></svg>
            </div>
            <p class="ui-agent-empty__title">لا يوجد وكلاء بعد</p>
            <p class="ui-agent-empty__hint">ابدأ بإضافة أول وكيل لتظهر بياناته هنا.</p>
            <a href="{{ route('agents.create') }}" class="ui-btn-primary">أضف أول وكيل</a>
        </div>
    @else
        <ul class="ui-agent-list">
            @foreach ($agents as $agent)
                @php
                    $phoneForTel = preg_replace('/\s+/', '', (string) $agent->phone);
                    $digitsOnly = preg_replace('/\D/', '', $phoneForTel);
                    $waUrl = null;
                    if ($digitsOnly !== '') {
                        if (str_starts_with($digitsOnly, '966')) {
                            $waDigits = $digitsOnly;
                        } elseif (str_starts_with($digitsOnly, '0')) {
                            $waDigits = '966' . substr($digitsOnly, 1);
                        } else {
                            $waDigits = '966' . $digitsOnly;
                        }
                        $waUrl = 'https://wa.me/' . $waDigits;
                    }
                @endphp
                <li class="ui-agent-card">
                    <div class="ui-agent-card__inner">
                        <div class="ui-agent-card__accent" aria-hidden="true"></div>
                        <div class="ui-agent-card__body">
                            <div class="ui-agent-card__main">
                                <h2 class="ui-agent-card__title">{{ $agent->name }}</h2>

                                @if (is_array($agent->brands) && count($agent->brands) > 0)
                                    <div class="ui-agent-card__block">
                                        <p class="ui-agent-card__label">الماركات</p>
                                        <div class="ui-agent-card__chips">
                                            @foreach ($agent->brands as $brandName)
                                                <span class="ui-agent-card__chip">{{ $brandName }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                @if ($agent->sales_rep_name)
                                    <p class="ui-agent-card__meta">
                                        <strong>مندوب المبيعات</strong>
                                        <span class="ui-agent-card__meta-sep"> — </span>{{ $agent->sales_rep_name }}
                                    </p>
                                @endif

                                @if ($agent->phone)
                                    <div class="ui-agent-card__phone-row">
                                        <a href="tel:{{ $phoneForTel }}" class="ui-agent-card__phone-link">
                                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" /></svg>
                                            {{ $agent->phone }}
                                        </a>
                                        @if ($waUrl)
                                            <a href="{{ $waUrl }}" class="ui-agent-card__wa" target="_blank" rel="noopener noreferrer" title="واتساب" aria-label="فتح واتساب">
                                                <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" /></svg>
                                            </a>
                                        @endif
                                    </div>
                                @endif

                                @if ($agent->location)
                                    <p class="ui-agent-card__location">{{ $agent->location }}</p>
                                @endif
                            </div>
                            <div class="ui-agent-card__actions">
                                <a href="{{ route('agents.edit', $agent) }}" class="ui-btn-edit">تعديل</a>
                                <form method="post" action="{{ route('agents.destroy', $agent) }}" onsubmit="return confirm('حذف هذا الوكيل؟ لا يمكن التراجع.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="ui-btn-danger">حذف</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
