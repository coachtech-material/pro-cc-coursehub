@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('coach.courses.chapters.lessons.index', [$course, $chapter]) }}" class="inline-flex items-center text-sm text-gray-500 hover:text-indigo-600 transition-colors">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            レッスン一覧に戻る
        </a>
    </div>

    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">レッスン編集</h1>
        <p class="mt-1 text-sm text-gray-500">{{ $lesson->title }}</p>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
        <form method="POST" action="{{ route('coach.courses.chapters.lessons.update', [$course, $chapter, $lesson]) }}" x-data="{ submitting: false }" @submit="submitting = true">
            @csrf
            @method('PUT')

            <div class="mb-5">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">タイトル</label>
                <input type="text" name="title" id="title" value="{{ old('title', $lesson->title) }}" required
                    class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 px-3 py-2.5 border">
            </div>

            <div class="mb-5">
                <label for="body" class="block text-sm font-medium text-gray-700 mb-1">内容（Markdown）</label>
                <textarea name="body" id="body" rows="10" required
                    class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 px-3 py-2.5 border font-mono text-sm">{{ old('body', $lesson->body) }}</textarea>
            </div>

            <div class="mb-6">
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published', $lesson->is_published) ? 'checked' : '' }}
                        class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <span class="ml-2 text-sm text-gray-700">公開する</span>
                </label>
            </div>

            <div class="flex gap-3">
                <button type="submit" :disabled="submitting"
                    :class="submitting ? 'opacity-50 cursor-not-allowed' : ''"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg px-4 py-2.5 shadow-sm transition-all duration-150">
                    <span x-show="!submitting">更新する</span>
                    <span x-show="submitting" class="flex items-center">
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                        更新中...
                    </span>
                </button>
                <a href="{{ route('coach.courses.chapters.lessons.index', [$course, $chapter]) }}" class="bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium rounded-lg px-4 py-2.5 transition-all duration-150">キャンセル</a>
            </div>
        </form>
    </div>
</div>
@endsection
