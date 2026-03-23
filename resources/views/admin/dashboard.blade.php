@extends('layouts.app')

@section('content')
<div>
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">管理者ダッシュボード</h1>
        <p class="mt-1 text-sm text-gray-500">プラットフォーム全体の統計情報</p>
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
            <p class="text-sm text-gray-500 mb-1">総ユーザー数</p>
            <p class="text-3xl font-bold text-gray-900">{{ $totalUsers }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
            <p class="text-sm text-gray-500 mb-1">受講生数</p>
            <p class="text-3xl font-bold text-green-600">{{ $totalStudents }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
            <p class="text-sm text-gray-500 mb-1">コーチ数</p>
            <p class="text-3xl font-bold text-indigo-600">{{ $totalCoaches }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
            <p class="text-sm text-gray-500 mb-1">総コース数</p>
            <p class="text-3xl font-bold text-gray-900">{{ $totalCourses }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
            <p class="text-sm text-gray-500 mb-1">公開コース</p>
            <p class="text-3xl font-bold text-green-600">{{ $publishedCourses }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
            <p class="text-sm text-gray-500 mb-1">総受講登録数</p>
            <p class="text-3xl font-bold text-indigo-600">{{ $totalEnrollments }}</p>
        </div>
    </div>
</div>
@endsection
