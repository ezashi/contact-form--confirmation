# お問合せフォーム
## 環境構築
### Dockerビルド
1. git clone https://github.com/ezashi/contact-form--confirmation.git
2. cd contact-form--confirmation
3. docker-compose up -d --build
※MYSQLは、OSによって起動しない場合もあるのでそれぞれのPCに合わせてdocker-compose.ymlファイルを編集してください

### Laravel環境構築
1. docker exec -it contact-form--confirmation-php-1 bash
2. composer install(Laravelをインストール)
3. cp .env.example .env(.env.exampleファイルから.envを作成し、環境環境変数を変更)
4. php artisan key:generate(APP_KEYの値を記入するコード)
5. php artisan config:clear(.envファイルの変更を反映するコード)
6. php artisan migrate(マイグレーションの実行)

## 使用技術
- PHP 8.0
- Laravel 10.0
- MYSQL 8.0

## URL
- 開発環境: http://localhost/
- phpmyadmin: http://localhost:8080/