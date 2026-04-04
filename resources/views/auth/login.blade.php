@extends('layouts.app')

@section('body-class', 'app-body--auth')

@section('title', 'تسجيل الدخول')

@section('body')
<div class="app-shell flex flex-1 flex-col justify-center py-10">
    @include('partials.brand-mark', ['variant' => 'welcome'])

    <div class="ui-card">
        <h1 class="text-center text-xl font-bold tracking-tight text-white">تسجيل الدخول</h1>
        <p class="mt-1 text-center text-sm text-zinc-400">أدخل بياناتك للمتابعة إلى لوحة التحكم</p>

        <form method="post" action="{{ route('login') }}" class="mt-8 space-y-5">
            @csrf
            <div>
                <label for="email" class="ui-label">البريد الإلكتروني</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                    class="ui-input ui-input--muted" placeholder="name@example.com">
                @error('email')
                    <p class="mt-2 text-sm font-medium text-rose-400">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="password" class="ui-label">كلمة المرور</label>
                <input id="password" name="password" type="password" required autocomplete="current-password"
                    class="ui-input ui-input--muted" placeholder="••••••••">
            </div>
            <label class="flex cursor-pointer items-center gap-3 text-sm text-zinc-400">
                <input type="checkbox" name="remember" value="1" class="size-4 rounded-md border-zinc-600 bg-zinc-800 text-[#d4ff3f] focus:ring-[#d4ff3f]/30">
                تذكرني على هذا الجهاز
            </label>
            <button type="submit" class="ui-btn-primary">دخول</button>
        </form>

        <p class="mt-8 text-center text-sm text-zinc-400">
            ليس لديك حساب؟
            <a href="{{ route('register') }}" class="ui-link">إنشاء حساب</a>
        </p>
    </div>
</div>
@endsection
