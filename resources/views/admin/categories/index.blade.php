@extends('layouts.app')

@section('content')
<div>
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">カテゴリ管理</h1>
            <p class="mt-1 text-sm text-gray-500">コースカテゴリの管理</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="mt-4 sm:mt-0 inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg px-4 py-2.5 shadow-sm transition-all duration-150 text-sm">
            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            新規作成
        </a>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">名前</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">スラッグ</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">コース数</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">操作</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($categories as $category)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $category->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500 font-mono">{{ $category->slug }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $category->courses_count }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">編集</a>
                                    <div x-data="{ confirmDelete: false }">
                                        <button @click="confirmDelete = true" class="text-sm text-red-600 hover:text-red-700 font-medium">削除</button>
                                        <div x-show="confirmDelete" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
                                            <div x-show="confirmDelete" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="confirmDelete = false" class="absolute inset-0 bg-gray-900/50 backdrop-blur-sm"></div>
                                            <div x-show="confirmDelete" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="relative bg-white rounded-2xl shadow-xl max-w-sm w-full mx-4 p-6">
                                                <h3 class="text-lg font-semibold text-gray-900 mb-2">カテゴリを削除</h3>
                                                <p class="text-sm text-gray-500 mb-6">「{{ $category->name }}」を削除しますか？</p>
                                                <div class="flex justify-end gap-3">
                                                    <button @click="confirmDelete = false" class="bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium rounded-lg px-4 py-2 text-sm transition-all duration-150">キャンセル</button>
                                                    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}">
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
</div>
@endsection
