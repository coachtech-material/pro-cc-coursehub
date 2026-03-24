@extends('layouts.app')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-900">アカウントを作成</h1>
            <p class="mt-2 text-sm text-gray-500">CourseHubで学習を始めましょう</p>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
            <form method="POST" action="{{ route('register') }}" x-data="{ submitting: false }" @submit="submitting = true">
                @csrf

                <div class="mb-5">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">名前</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 px-3 py-2.5 border">
                </div>

                <div class="mb-5">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">メールアドレス</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 px-3 py-2.5 border">
                </div>

                <div class="mb-5">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">パスワード</label>
                    <input type="password" name="password" id="password" required
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 px-3 py-2.5 border">
                </div>

                <div class="mb-5">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">パスワード（確認）</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 px-3 py-2.5 border">
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">ロール</label>
                    <div class="flex gap-6">
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="role" value="student" {{ old('role', 'student') === 'student' ? 'checked' : '' }}
                                class="text-indigo-600 border-gray-300 focus:ring-indigo-500">
                            <span class="ml-2 text-sm text-gray-700">受講生</span>
                        </label>
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="role" value="coach" {{ old('role') === 'coach' ? 'checked' : '' }}
                                class="text-indigo-600 border-gray-300 focus:ring-indigo-500">
                            <span class="ml-2 text-sm text-gray-700">コーチ</span>
                        </label>
                    </div>
                </div>

                <button type="submit" :disabled="submitting"
                    :class="submitting ? 'opacity-50 cursor-not-allowed' : ''"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg px-4 py-2.5 shadow-sm transition-all duration-150">
                    <span x-show="!submitting">登録する</span>
                    <span x-show="submitting" class="flex items-center justify-center">
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                        登録中...
                    </span>
                </button>
            </form>

            <p class="mt-6 text-center text-sm text-gray-500">
                既にアカウントをお持ちの方は <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-700 font-medium">ログイン</a>
            </p>
        </div>
    </div>
</div>
@endsection
