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

1.git クローン<br>
```git clone git@github.com:Yu-Sasaki451/contact-form.git```<br>
2.Docker ビルド<br>
```docker compose up -d --build```

### Laravel 　環境構築

「contact-form」ディレクトリにチェンジディレクトリし、下記コマンドを 1 行ずつ実行してください<br>

1.　 docker compose exec php bash<br> 2.　 composer install<br> 3.　 cp .env.example .env 　※環境変数は適宜変更してください<br> 4.　 php artisan key:generate<br> 5.　 php artisan migrate<br> 6.　 php artisan db:seed

## URL

開発環境：http://localhost/<br>
phpMyAdmin：http://localhost:8080/

## ER 図

![ER Diagram](src/public/er.svg)
