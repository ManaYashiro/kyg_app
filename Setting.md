# kyg_app

kyg_appは、XAMPPを使用してLaravelで開発し、Node.jsとLaravel Breezeを活用したシンプルなウェブアプリケーションです。

## 目次
- [必要なツール](#必要なツール)
- [インストール手順](#インストール手順)
- [本番環境](#本番環境)

## 必要なツール

- **XAMPP**: [公式サイト](https://www.apachefriends.org/jp/download.html)からダウンロード
- **Composer**: [公式サイト](https://getcomposer.org/doc/00-intro.md#installation-windows)からダウンロード
- **Node.js**: [公式サイト](https://nodejs.org/en/)からダウンロード
- **PHP**: Laravelに推奨されるPHPバージョンをインストール（通常は8.x）

**※すでにインストールされている場合はインストール不要
追記がメインで進めてください**

## インストール手順

1. **XAMPPのインストール**
   - XAMPPをダウンロードし、インストールします。
   - XAMPPを起動し、ApacheとMySQLを開始します。


2. **composerインストール**

    composerをダウンロードし、インストールします。

    https://weblabo.oscasierra.net/php-composer-windows-install/ 参照


3. **node.jsインストール**
    node.jsをダウンロードし、インストールします。


4. **プロジェクトディレクトリに移動**
  ```bash
    cd C:\xampp\htdocs
    mkdir kyg_app
    cd kyg_app
    git clone https://github.com/ManaYashiro/kyg_app.git .
  ```


5. **Project Packageのインストール**
  ```bash
    composer install
    npm install
  ```


6. **依存関係のビルド**
  ```bash
    npm run dev
    cp .env.example .env
  ```


7. **ファイルの書き換え**
    DBにdetabase utf8mb4_general_ciを作成

  ```.env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=kyg
    DB_USERNAME=root
    DB_PASSWORD=
  ```


8. **マイグレーションの実行**
  ```bash
    php artisan migrate
  ```


9. **laravel app key && storage link**
  ```bash
    php artisan key:generate
    php artisan storage:link
  ```


  .envのAPP_URL変更
  ```.env
    http://.app.local
  ```


10. **apache virtualhost**
  C:\xampp\apache\conf\extraのhttpd-vhosts.confに追記
  ```httpd-vhosts.conf
    # kyg APP
    <VirtualHost *:80>
        ServerAdmin webmaster@dummy-host.example.com
        DocumentRoot "C:\xampp\htdocs\kyg_app\public"
        ServerName kyg.app.local
        <Directory "C:\xampp\htdocs\kyg_app\public">
            Options Indexes FollowSymLinks
            AllowOverride All
            Require all granted
        </Directory>
        ErrorLog "logs/kyg-error.log"
        CustomLog "logs/kyg-access.log" common
        ErrorDocument 503 /503.html
    </VirtualHost>
  ```


11. **windows hosts fileを設定**

  https://help.coreserver.jp/manual/hosts-win/　参照

  C:\windows\system32\drivers\etc\hostsを開いて追記
  ```httpd-vhosts.conf
    ### XAMPP settings
    127.0.0.1 kyg.app.local
  ```


12. **Apacheの再起動**
    仮想ホスト設定を反映させるため、Apacheを再起動します。


## 本番環境
    PHP, mysql, apache install

    version
    PHP 8.2.*
    mariadb: 10.4.32
    apache 2.4.58

手順はほぼ同じ

  ```bash
    npm run build
  ```
