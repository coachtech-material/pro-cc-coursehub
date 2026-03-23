@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('coach.courses.chapters.index', $course) }}" class="inline-flex items-center text-sm text-gray-500 hover:text-indigo-600 transition-colors">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            チャプター一覧に戻る
        </a>
    </div>

    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">小テスト管理</h1>
        <p class="mt-1 text-sm text-gray-500">{{ $lesson->title }}</p>
    </div>

    @if(!$quiz)
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
            <div class="flex flex-col items-center justify-center py-8 mb-6">
                <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <p class="text-gray-500 mb-6">この小テストはまだ作成されていません。</p>
            </div>
            <form method="POST" action="{{ route('coach.courses.lessons.quizzes.store', [$course, $lesson]) }}" x-data="{ submitting: false }" @submit="submitting = true">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-5">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">タイトル</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 px-3 py-2.5 border">
                    </div>
                    <div>
                        <label for="passing_score" class="block text-sm font-medium text-gray-700 mb-1">合格点（%）</label>
                        <input type="number" name="passing_score" id="passing_score" value="{{ old('passing_score', 70) }}" min="0" max="100" required
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 px-3 py-2.5 border">
                    </div>
                </div>
                <button type="submit" :disabled="submitting"
                    :class="submitting ? 'opacity-50 cursor-not-allowed' : ''"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg px-4 py-2.5 shadow-sm transition-all duration-150">
                    <span x-show="!submitting">小テストを作成</span>
                    <span x-show="submitting" class="flex items-center">
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                        作成中...
                    </span>
                </button>
            </form>
        </div>
    @else
        {{-- クイズ設定 --}}
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 mb-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-900">{{ $quiz->title }}</h2>
                <div x-data="{ confirmDelete: false }">
                    <button @click="confirmDelete = true" class="text-sm text-red-600 hover:text-red-700 font-medium">削除</button>
                    <div x-show="confirmDelete" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
                        <div x-show="confirmDelete" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="confirmDelete = false" class="absolute inset-0 bg-gray-900/50 backdrop-blur-sm"></div>
                        <div x-show="confirmDelete" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="relative bg-white rounded-2xl shadow-xl max-w-sm w-full mx-4 p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">小テストを削除</h3>
                            <p class="text-sm text-gray-500 mb-6">小テストとすべての問題を削除しますか？</p>
                            <div class="flex justify-end gap-3">
                                <button @click="confirmDelete = false" class="bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium rounded-lg px-4 py-2 text-sm transition-all duration-150">キャンセル</button>
                                <form method="POST" action="{{ route('coach.courses.lessons.quizzes.destroy', [$course, $lesson]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg px-4 py-2 text-sm transition-all duration-150">削除する</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('coach.courses.lessons.quizzes.update', [$course, $lesson]) }}">
                @csrf
                @method('PUT')
                <div class="flex flex-wrap gap-4 items-end">
                    <div class="flex-1 min-w-[200px]">
                        <label for="quiz_title" class="block text-sm font-medium text-gray-700 mb-1">タイトル</label>
                        <input type="text" name="title" id="quiz_title" value="{{ $quiz->title }}" required
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 px-3 py-2.5 border">
                    </div>
                    <div>
                        <label for="quiz_passing_score" class="block text-sm font-medium text-gray-700 mb-1">合格点（%）</label>
                        <input type="number" name="passing_score" id="quiz_passing_score" value="{{ $quiz->passing_score }}" min="0" max="100" required
                            class="w-32 rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 px-3 py-2.5 border">
                    </div>
                    <button type="submit" class="bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium rounded-lg px-4 py-2.5 transition-all duration-150 text-sm">更新</button>
                </div>
            </form>
        </div>

        {{-- 問題一覧 --}}
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">問題一覧（{{ $quiz->questions->count() }}問）</h3>
        </div>

        @foreach($quiz->questions->sortBy('order') as $question)
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5 mb-3">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <p class="font-medium text-gray-900">問{{ $question->order }}. {{ $question->body }}</p>
                        <ul class="mt-2 space-y-1">
                            @foreach($question->options as $option)
                                <li class="text-sm flex items-center gap-1.5 {{ $option->is_correct ? 'text-green-700 font-medium' : 'text-gray-500' }}">
                                    @if($option->is_correct)
                                        <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    @else
                                        <span class="w-4 h-4 flex-shrink-0"></span>
                                    @endif
                                    {{ $option->body }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div x-data="{ confirmDelete: false }">
                        <button @click="confirmDelete = true" class="text-sm text-red-600 hover:text-red-700 font-medium ml-4">削除</button>
                        <div x-show="confirmDelete" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
                            <div x-show="confirmDelete" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="confirmDelete = false" class="absolute inset-0 bg-gray-900/50 backdrop-blur-sm"></div>
                            <div x-show="confirmDelete" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="relative bg-white rounded-2xl shadow-xl max-w-sm w-full mx-4 p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">問題を削除</h3>
                                <p class="text-sm text-gray-500 mb-6">この問題を削除しますか？</p>
                                <div class="flex justify-end gap-3">
                                    <button @click="confirmDelete = false" class="bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium rounded-lg px-4 py-2 text-sm transition-all duration-150">キャンセル</button>
                                    <form method="POST" action="{{ route('coach.courses.lessons.quizzes.questions.destroy', [$course, $lesson, $question]) }}">
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
        @endforeach

        {{-- 問題追加フォーム --}}
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 mt-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">問題を追加</h3>
            <form method="POST" action="{{ route('coach.courses.lessons.quizzes.questions.store', [$course, $lesson]) }}" x-data="{ submitting: false }" @submit="submitting = true">
                @csrf

                <div class="mb-5">
                    <label for="body" class="block text-sm font-medium text-gray-700 mb-1">問題文</label>
                    <textarea name="body" id="body" rows="2" required
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 px-3 py-2.5 border">{{ old('body') }}</textarea>
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-2">選択肢（正解にチェック）</label>
                    @for($i = 0; $i < 4; $i++)
                        <div class="flex items-center gap-3 mb-2">
                            <input type="radio" name="correct_option" value="{{ $i }}" {{ $i === 0 ? 'checked' : '' }}
                                class="text-indigo-600 border-gray-300 focus:ring-indigo-500">
                            <input type="text" name="options[{{ $i }}][body]" value="{{ old("options.{$i}.body") }}" required
                                class="flex-1 rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 px-3 py-2.5 border" placeholder="選択肢{{ $i + 1 }}">
                        </div>
                    @endfor
                </div>

                <button type="submit" :disabled="submitting"
                    :class="submitting ? 'opacity-50 cursor-not-allowed' : ''"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg px-4 py-2.5 shadow-sm transition-all duration-150">
                    <span x-show="!submitting">追加する</span>
                    <span x-show="submitting" class="flex items-center">
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                        追加中...
                    </span>
                </button>
            </form>
        </div>
    @endif
</div>
@endsection
