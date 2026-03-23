@extends('layouts.app')

@section('content')
<div>
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">ダッシュボード</h1>
            <p class="mt-1 text-sm text-gray-500">コースの概要と統計情報</p>
        </div>
        <div class="mt-4 sm:mt-0 flex gap-3">
            <a href="{{ route('coach.courses.index') }}" class="bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium rounded-lg px-4 py-2.5 transition-all duration-150 text-sm">コース管理へ</a>
            <a href="{{ route('coach.courses.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg px-4 py-2.5 shadow-sm transition-all duration-150 text-sm">新規コース作成</a>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
            <p class="text-sm text-gray-500 mb-1">コース数</p>
            <p class="text-3xl font-bold text-gray-900">{{ $courseCount }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
            <p class="text-sm text-gray-500 mb-1">公開中</p>
            <p class="text-3xl font-bold text-green-600">{{ $publishedCount }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
            <p class="text-sm text-gray-500 mb-1">受講生数</p>
            <p class="text-3xl font-bold text-indigo-600">{{ $totalStudents }}</p>
        </div>
    </div>
</div>
@endsection
