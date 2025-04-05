# お問合せフォーム
## 環境構築
### Dockerビルド
1. git clone https://github.com/ezashi/contact-form--confirmation.git
2. cd contact-form--confirmation
3. docker-compose up -d --build

※ MYSQLは、OSによって起動しない場合もあるのでそれぞれのPCに合わせてdocker-compose.ymlファイルを編集してください

### Laravel環境構築
1. docker exec -it contact-form--confirmation-php-1 bash
2. composer install(Laravelをインストール)
3. cp .env.example .env(.env.exampleファイルから.envを作成し、環境環境変数を変更)
4. php artisan key:generate(APP_KEYの値を記入するコード)
5. php artisan config:clear(.envファイルの変更を反映するコード)
6. php artisan migrate(マイグレーションの実行)

## データベースのシード機能について
既に開発・テスト用にダミーデータを自動生成する機能が実装されています。
### シードデータの内容
* カテゴリーデータ: シーダーを使用して以下の5種類のお問い合わせの種類を作成します
1. 商品のお届けについて
2. 商品の交換について
3. 商品トラブル
4. ショップへのお問い合わせ
5. その他
* ユーザーデータ: ファクトリーを使用して35件の管理者ユーザーアカウントを生成します
* お問い合わせデータ: ファクトリーを使用して35件のダミーお問い合わせデータを生成します
  - 各お問い合わせには、名前、性別、メールアドレス、電話番号、住所、お問い合わせ内容などがランダムに設定されます
  - お問い合わせの種類は、上記のカテゴリーからランダムに選択されます

### シード実行方法
以下のコマンドを実行して、データベースを初期化し、ダミーデータを生成します：php artisan migrate:fresh --seed

※ ダミーデータの内容や件数を変更したい場合は、database/seedersおよびdatabase/factoriesディレクトリ内のファイルを修正してください

## 使用技術
- PHP 8.0
- Laravel 10.0
- MYSQL 8.0

## URL
- 開発環境: http://localhost/
- phpmyadmin: http://localhost:8080/