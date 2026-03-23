@extends('layouts.app')

@section('content')
<div>
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">コース管理</h1>
        <p class="mt-1 text-sm text-gray-500">全コースの確認と管理</p>
    </div>

    {{-- フィルター --}}
    <form method="GET" action="{{ route('admin.courses.index') }}" class="mb-8 bg-white rounded-xl border border-gray-200 shadow-sm p-5">
        <div class="flex flex-wrap gap-4 items-end">
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">ステータス</label>
                <select name="status" id="status" class="rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 px-3 py-2.5 border">
                    <option value="">すべて</option>
                    <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>下書き</option>
                    <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>公開</option>
                    <option value="archived" {{ request('status') === 'archived' ? 'selected' : '' }}>アーカイブ</option>
                </select>
            </div>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg px-4 py-2.5 shadow-sm transition-all duration-150">絞り込み</button>
        </div>
    </form>

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">タイトル</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">コーチ</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">カテゴリ</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ステータス</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">操作</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($courses as $course)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $course->title }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $course->user->name ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $course->category->name ?? '-' }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium
                                    {{ $course->status === 'published' ? 'bg-green-50 text-green-700' : ($course->status === 'draft' ? 'bg-amber-50 text-amber-700' : 'bg-gray-100 text-gray-700') }}">
                                    {{ $course->status === 'published' ? '公開' : ($course->status === 'draft' ? '下書き' : 'アーカイブ') }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div x-data="{ confirmDelete: false }">
                                    <button @click="confirmDelete = true" class="text-sm text-red-600 hover:text-red-700 font-medium">削除</button>
                                    <div x-show="confirmDelete" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
                                        <div x-show="confirmDelete" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="confirmDelete = false" class="absolute inset-0 bg-gray-900/50 backdrop-blur-sm"></div>
                                        <div x-show="confirmDelete" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="relative bg-white rounded-2xl shadow-xl max-w-sm w-full mx-4 p-6">
                                            <h3 class="text-lg font-semibold text-gray-900 mb-2">コースを削除</h3>
                                            <p class="text-sm text-gray-500 mb-6">「{{ $course->title }}」を削除しますか？</p>
                                            <div class="flex justify-end gap-3">
                                                <button @click="confirmDelete = false" class="bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium rounded-lg px-4 py-2 text-sm transition-all duration-150">キャンセル</button>
                                                <form method="POST" action="{{ route('admin.courses.destroy', $course) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg px-4 py-2 text-sm transition-all duration-150">削除する</button>
                                                </form>
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

    <div class="mt-8">
        {{ $courses->withQueryString()->links() }}
    </div>
</div>
@endsection
