@extends('layouts.app')

@section('body-class', 'app-body--auth')

@section('title', 'إنشاء حساب')

@section('body')
<div class="app-shell flex flex-1 flex-col justify-center py-10">
    @include('partials.brand-mark')

    <div class="ui-card">
        <h1 class="text-center text-xl font-bold tracking-tight text-white">إنشاء حساب</h1>
        <p class="mt-1 text-center text-sm text-zinc-400">خطوة واحدة للوصول إلى جميع الأدوات</p>

        <form method="post" action="{{ route('register') }}" class="mt-8 space-y-5">
            @csrf
            <div>
                <label for="name" class="ui-label">الاسم</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus autocomplete="name"
                    class="ui-input ui-input--muted">
                @error('name')
                    <p class="mt-2 text-sm font-medium text-rose-400">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="email" class="ui-label">البريد الإلكتروني</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="username"
                    class="ui-input ui-input--muted" placeholder="name@example.com">
                @error('email')
                    <p class="mt-2 text-sm font-medium text-rose-400">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="password" class="ui-label">كلمة المرور</label>
                <input id="password" name="password" type="password" required autocomplete="new-password"
                    class="ui-input ui-input--muted" placeholder="••••••••">
                @error('password')
                    <p class="mt-2 text-sm font-medium text-rose-400">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="password_confirmation" class="ui-label">تأكيد كلمة المرور</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
                    class="ui-input ui-input--muted" placeholder="••••••••">
            </div>
            <button type="submit" class="ui-btn-primary">تسجيل</button>
        </form>

        <p class="mt-8 text-center text-sm text-zinc-400">
            لديك حساب بالفعل؟
            <a href="{{ route('login') }}" class="ui-link">تسجيل الدخول</a>
        </p>
    </div>
</div>
@endsection
