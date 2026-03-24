<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CourseHub - オンライン学習プラットフォーム</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 antialiased">
    {{-- ヘッダー --}}
    <header class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">
            <span class="text-xl font-bold text-gray-900 tracking-tight">CourseHub</span>
            <div class="flex items-center space-x-3">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-500 hover:text-indigo-600 transition-colors">ダッシュボード</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-500 hover:text-indigo-600 transition-colors">ログイン</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg px-4 py-2.5 shadow-sm transition-all duration-150">会員登録</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </header>

    {{-- ヒーロー --}}
    <main>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 sm:py-32">
            <div class="text-center max-w-2xl mx-auto">
                <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 tracking-tight leading-tight">
                    学びを、もっとシンプルに
                </h1>
                <p class="mt-6 text-lg text-gray-500 leading-relaxed">
                    CourseHubは、コーチと受講生をつなぐオンライン学習プラットフォームです。<br class="hidden sm:inline">
                    コースの作成・受講・進捗管理をひとつの場所で。
                </p>
                <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg px-6 py-3 shadow-sm transition-all duration-150">ダッシュボードへ</a>
                    @else
                        <a href="{{ route('register') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg px-6 py-3 shadow-sm transition-all duration-150">無料で始める</a>
                        <a href="{{ route('login') }}" class="bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium rounded-lg px-6 py-3 transition-all duration-150">ログイン</a>
                    @endauth
                </div>
            </div>
        </div>

        {{-- 特徴セクション --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
                    <div class="w-10 h-10 rounded-lg bg-indigo-50 flex items-center justify-center mb-4">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">コース作成</h3>
                    <p class="text-sm text-gray-500">チャプター・レッスン・小テストを自由に組み合わせて、体系的なコースを構築できます。</p>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
                    <div class="w-10 h-10 rounded-lg bg-green-50 flex items-center justify-center mb-4">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">進捗管理</h3>
                    <p class="text-sm text-gray-500">レッスンの完了状況やクイズの結果をリアルタイムで確認。学習の進み具合が一目でわかります。</p>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
                    <div class="w-10 h-10 rounded-lg bg-amber-50 flex items-center justify-center mb-4">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">ロール管理</h3>
                    <p class="text-sm text-gray-500">管理者・コーチ・受講生の3つのロールで、それぞれに最適化された体験を提供します。</p>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
