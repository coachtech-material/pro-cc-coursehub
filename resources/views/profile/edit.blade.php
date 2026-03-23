@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">プロフィール編集</h1>
        <p class="mt-1 text-sm text-gray-500">アカウント情報を更新できます</p>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
        <form method="POST" action="{{ route('profile.update') }}" x-data="{ submitting: false }" @submit="submitting = true">
            @csrf
            @method('PUT')

            <div class="mb-5">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">名前</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                    class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 px-3 py-2.5 border">
            </div>

            <div class="mb-5">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">メールアドレス</label>
                <input type="email" id="email" value="{{ $user->email }}" disabled
                    class="w-full bg-gray-50 border-gray-200 rounded-lg shadow-sm px-3 py-2.5 border text-gray-500">
            </div>

            <div class="mb-5">
                <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">自己紹介</label>
                <textarea name="bio" id="bio" rows="4"
                    class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 px-3 py-2.5 border">{{ old('bio', $user->bio) }}</textarea>
            </div>

            <div class="mb-6">
                <label for="avatar_url" class="block text-sm font-medium text-gray-700 mb-1">アバター URL</label>
                <input type="url" name="avatar_url" id="avatar_url" value="{{ old('avatar_url', $user->avatar_url) }}"
                    class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 px-3 py-2.5 border">
            </div>

            <button type="submit" :disabled="submitting"
                :class="submitting ? 'opacity-50 cursor-not-allowed' : ''"
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg px-4 py-2.5 shadow-sm transition-all duration-150">
                <span x-show="!submitting">更新する</span>
                <span x-show="submitting" class="flex items-center">
                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                    更新中...
                </span>
            </button>
        </form>
    </div>
</div>
@endsection
