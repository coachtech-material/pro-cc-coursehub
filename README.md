# CourseHub

オンライン学習プラットフォーム。コーチがコースを作成し、受講生が学習・進捗管理できるシステム。

## 環境構築

### 前提条件

- Docker Desktop がインストールされていること

### セットアップ手順

1. リポジトリをクローン

```bash
git clone https://github.com/coachtech-material/pro-cc-coursehub.git
cd pro-cc-coursehub
```

2. `.env` ファイルを作成

```bash
cp .env.example .env
```

3. `.env` の設定例

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password
```

4. Docker を起動

```bash
docker compose up -d
```

5. マイグレーション・シーディング

```bash
php artisan migrate --seed
```

6. アプリケーションキーの生成

```bash
php artisan key:generate
```

### キュー設定

本番環境では Redis を使用します。`.env` に以下を設定:

```
QUEUE_CONNECTION=redis
```

### アクセス

- アプリケーション: http://localhost
- phpMyAdmin: http://localhost:8080

## テスト

```bash
php artisan test
```

## 技術スタック

- PHP 8.2
- Laravel 10
- MySQL 8.0
- Tailwind CSS
