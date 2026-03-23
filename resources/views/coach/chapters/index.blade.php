@extends('layouts.app')

@section('content')
<div>
    <div class="mb-6">
        <a href="{{ route('coach.courses.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-indigo-600 transition-colors">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            コース管理に戻る
        </a>
    </div>

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">チャプター管理</h1>
            <p class="mt-1 text-sm text-gray-500">{{ $course->title }}</p>
        </div>
        <a href="{{ route('coach.courses.chapters.create', $course) }}" class="mt-4 sm:mt-0 inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg px-4 py-2.5 shadow-sm transition-all duration-150 text-sm">
            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            新規チャプター
        </a>
    </div>

    @if($chapters->isEmpty())
        <div class="flex flex-col items-center justify-center py-16">
            <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            <p class="text-gray-500 mb-4">チャプターがありません。</p>
            <a href="{{ route('coach.courses.chapters.create', $course) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg px-4 py-2.5 shadow-sm transition-all duration-150 text-sm">最初のチャプターを作成</a>
        </div>
    @else
        <div class="space-y-3">
            @foreach($chapters as $chapter)
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="font-semibold text-gray-900">
                                <span class="text-indigo-600 mr-1">{{ $chapter->order }}.</span> {{ $chapter->title }}
                            </h2>
                            <p class="text-sm text-gray-500 mt-0.5">{{ $chapter->lessons->count() }} レッスン</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <a href="{{ route('coach.courses.chapters.lessons.index', [$course, $chapter]) }}" class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">レッスン管理</a>
                            <a href="{{ route('coach.courses.chapters.edit', [$course, $chapter]) }}" class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">編集</a>
                            <div x-data="{ confirmDelete: false }">
                                <button @click="confirmDelete = true" class="text-sm text-red-600 hover:text-red-700 font-medium">削除</button>
                                <div x-show="confirmDelete" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
                                    <div x-show="confirmDelete" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="confirmDelete = false" class="absolute inset-0 bg-gray-900/50 backdrop-blur-sm"></div>
                                    <div x-show="confirmDelete" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="relative bg-white rounded-2xl shadow-xl max-w-sm w-full mx-4 p-6">
                                        <h3 class="text-lg font-semibold text-gray-900 mb-2">チャプターを削除</h3>
                                        <p class="text-sm text-gray-500 mb-6">「{{ $chapter->title }}」を削除しますか？</p>
                                        <div class="flex justify-end gap-3">
                                            <button @click="confirmDelete = false" class="bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium rounded-lg px-4 py-2 text-sm transition-all duration-150">キャンセル</button>
                                            <form method="POST" action="{{ route('coach.courses.chapters.destroy', [$course, $chapter]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg px-4 py-2 text-sm transition-all duration-150">削除する</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
