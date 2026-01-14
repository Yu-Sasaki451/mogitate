# mogitate -Seasonal products-

## 概要

・商品と季節の登録<br>
・商品の詳細確認・変更・消去<br>
・シンボリックリンクを使用して画像保存<br>
・商品名での検索、価格順でのソート機能

## 使用技術

Laravel Framework 8.83.29<br>
php:8.1-fpm<br>
nginx:1.21.1<br>
mysql:8.0.32<br>
phpMyAdmin

## 環境構築

- Docker のビルドからマイグレーション、シーディングまでを記述

### Docker 　ビルド

下記コマンドを 1 行ずつ実行してください<br>

1.git クローン

```
git clone git@github.com:Yu-Sasaki451/mogitate.git
```

2.Docker ビルド

```
cd mogitate
```

```
docker compose up -d --build
```

### Laravel 　環境構築

下記コマンドを 1 行ずつ実行してください<br>

1.PHP コンテナへ入る

```
docker compose exec php bash
```

2.composer インストール

```
composer install
```

3.　.env コピー　※環境変数は適宜変更してください

```
cp .env.example .env
```

4.アプリケーションキー作成

```
php artisan key:generate
```

5.　マイグレーション実行

```
php artisan migrate
```

6.　シーディング実行

```
php artisan db:seed
```

7.シンボリックリンク作成

```
php artisan storage:link
```

## URL

開発環境：http://localhost/products<br>
phpMyAdmin：http://localhost:8080/

## ER 図

![ER Diagram](src/public/er.svg)

```

```
