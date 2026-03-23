@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    {{-- パンくず --}}
    <div class="mb-6">
        <a href="{{ route('courses.show', $course) }}" class="inline-flex items-center text-sm text-gray-500 hover:text-indigo-600 transition-colors">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            {{ $course->title }} に戻る
        </a>
    </div>

    <div class="lg:grid lg:grid-cols-3 lg:gap-8">
        {{-- メインコンテンツ --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 mb-6">
                <h1 class="text-2xl font-bold text-gray-900 mb-6">{{ $lesson->title }}</h1>
                <div class="prose max-w-none text-gray-700">
                    {!! nl2br(e($lesson->body)) !!}
                </div>
            </div>

            @if(auth()->user()->isStudent())
                <div class="flex items-center justify-between bg-white rounded-xl border border-gray-200 shadow-sm p-5">
                    <div class="flex items-center gap-2">
                        @if($progress && $progress->status === 'completed')
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span class="text-green-700 font-medium text-sm">完了済み</span>
                        @else
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span class="text-gray-500 text-sm">未完了</span>
                        @endif
                    </div>

                    @if(!$progress || $progress->status !== 'completed')
                        <form method="POST" action="{{ route('courses.lessons.complete', [$course, $lesson]) }}">
                            @csrf
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg px-4 py-2.5 shadow-sm transition-all duration-150 text-sm">レッスンを完了する</button>
                        </form>
                    @endif
                </div>
            @endif
        </div>

        {{-- サイドバー --}}
        <div class="mt-6 lg:mt-0">
            @if($lesson->quiz)
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5 mb-4">
                    <h3 class="font-semibold text-gray-900 mb-2">小テスト</h3>
                    <p class="text-sm text-gray-500 mb-3">{{ $lesson->quiz->title }}</p>
                    <a href="{{ route('courses.quizzes.show', [$course, $lesson->quiz]) }}" class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg px-4 py-2 shadow-sm transition-all duration-150 text-sm">受験する</a>
                </div>
            @endif

            {{-- ナビゲーション --}}
            @php
                $allLessons = $course->chapters->sortBy('order')->flatMap(fn($c) => $c->lessons->where('is_published', true)->sortBy('order'));
                $currentIndex = $allLessons->search(fn($l) => $l->id === $lesson->id);
                $prevLesson = $currentIndex > 0 ? $allLessons->values()[$currentIndex - 1] : null;
                $nextLesson = $currentIndex < $allLessons->count() - 1 ? $allLessons->values()[$currentIndex + 1] : null;
            @endphp

            <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5 space-y-3">
                <h3 class="font-semibold text-gray-900 text-sm">レッスンナビ</h3>
                @if($prevLesson)
                    <a href="{{ route('courses.lessons.show', [$course, $prevLesson]) }}" class="flex items-center text-sm text-gray-500 hover:text-indigo-600 transition-colors">
                        <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        <span class="truncate">{{ $prevLesson->title }}</span>
                    </a>
                @endif
                @if($nextLesson)
                    <a href="{{ route('courses.lessons.show', [$course, $nextLesson]) }}" class="flex items-center text-sm text-indigo-600 hover:text-indigo-700 font-medium transition-colors">
                        <span class="truncate">{{ $nextLesson->title }}</span>
                        <svg class="w-4 h-4 ml-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
