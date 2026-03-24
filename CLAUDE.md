# CourseHub

オンライン学習プラットフォーム。

## 技術スタック

- Laravel 10
- MySQL
- Blade + Tailwind CSS

## 開発環境

Docker Compose で起動:

```bash
docker compose up -d
```

マイグレーション:

```bash
php artisan migrate
```

シーディング:

```bash
php artisan db:seed
```

## ユーザーロール

- admin: 管理者
- coach: コーチ（コース作成）
- student: 受講生

## テスト

```bash
php artisan test
```
