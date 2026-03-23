@extends('layouts.app')

@section('content')
<div>
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">コース管理</h1>
            <p class="mt-1 text-sm text-gray-500">作成したコースの管理・編集</p>
        </div>
        <a href="{{ route('coach.courses.create') }}" class="mt-4 sm:mt-0 inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg px-4 py-2.5 shadow-sm transition-all duration-150 text-sm">
            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            新規作成
        </a>
    </div>

    @if($courses->isEmpty())
        <div class="flex flex-col items-center justify-center py-16">
            <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            <p class="text-gray-500 mb-4">まだコースがありません。</p>
            <a href="{{ route('coach.courses.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg px-4 py-2.5 shadow-sm transition-all duration-150 text-sm">最初のコースを作成</a>
        </div>
    @else
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">タイトル</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ステータス</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">チャプター数</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">受講者数</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">操作</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($courses as $course)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $course->title }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium
                                        {{ $course->status === 'published' ? 'bg-green-50 text-green-700' : ($course->status === 'draft' ? 'bg-amber-50 text-amber-700' : 'bg-gray-100 text-gray-700') }}">
                                        {{ $course->status === 'published' ? '公開' : ($course->status === 'draft' ? '下書き' : 'アーカイブ') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $course->chapters_count }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $course->enrollments_count }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <a href="{{ route('coach.courses.edit', $course) }}" class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">編集</a>
                                        <a href="{{ route('coach.courses.chapters.index', $course) }}" class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">チャプター</a>
                                        <a href="{{ route('coach.courses.students.index', $course) }}" class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">受講者</a>
                                        <div x-data="{ confirmDelete: false }">
                                            <button @click="confirmDelete = true" class="text-sm text-red-600 hover:text-red-700 font-medium">削除</button>
                                            {{-- 削除確認モーダル --}}
                                            <div x-show="confirmDelete" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
                                                <div x-show="confirmDelete" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="confirmDelete = false" class="absolute inset-0 bg-gray-900/50 backdrop-blur-sm"></div>
                                                <div x-show="confirmDelete" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="relative bg-white rounded-2xl shadow-xl max-w-sm w-full mx-4 p-6">
                                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">コースを削除</h3>
                                                    <p class="text-sm text-gray-500 mb-6">「{{ $course->title }}」を削除しますか？この操作は取り消せません。</p>
                                                    <div class="flex justify-end gap-3">
                                                        <button @click="confirmDelete = false" class="bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium rounded-lg px-4 py-2 text-sm transition-all duration-150">キャンセル</button>
                                                        <form method="POST" action="{{ route('coach.courses.destroy', $course) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg px-4 py-2 text-sm transition-all duration-150">削除する</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection
