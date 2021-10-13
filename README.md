<p align="center"><img src="https://user-images.githubusercontent.com/85182147/136333695-8a8f9dfe-3507-4527-8807-232f5a8f08db.png" height="400px" width="60%" margin="auto">
</p>

# Rese

企業のグループ会社の飲食店予約サービス


# 必要なもの

PHP 8.0.9

Composer version 2.1.3

Laravel Framework 8.61.0

# インストール方法


## Composerのインストール

[Mac](https://getcomposer.org/download/)

↑こちらのページ下部にある Manual Download から2.○.○.の最新バージョンのリンクをクリックしてください。


ターミナルで Download ディレクトリに移動し以下のコマンドを実行します。


```
$ sudo mv composer.phar /usr/local/bin/composer
```
```
$ chmod a+x /usr/local/bin/composer
```

[Windows](https://getcomposer.org/doc/00-intro.md#installation-windows)

↑こちらのページの「Installation – WindowsのUsing the Installer」の文章中に「Composer-Setup.exe」というリンクがあるのでインストーラをダウンロードしてください。


ダウンロードしたインストーラを起動します。

Composer Setup「Installation Options」

起動すると画面に「Developer mode」というチェックボックスが表示された画面が現れるのでOFFのまま「Next」をクリックします。


Composer Setup 「Settings Check」

「C:¥xampp¥php¥php.exe」を選択し「Next」をクリックします。

インストール画面まで「Next」を選択し、インストール画面では「Install」を選択します。

その後「Finish」ボタンを押したらインストール完了です。



## cloneする

```
$ cd /Applications/MAMP/htdocs/
```

```
$ git clone https://github.com/kadukimochida/Rese-20210918mochida
```

```
$ cd Rese-20210918mochida
```

```
$ composer install
```

```
$ cp .env.example .env
```

```
$ php artisan key:generate
```

```
$ php artisan config:clear
```

```
$ cd
```

```
$ mysql -u root -p
```

パスワードの入力を求められるのでrootと入力する。

```
$ create database rese;
```


.envの修正

APP_ENV=local

APP_URL=http://localhost:8000

DB_HOST=127.0.0.1

DB_DATABASE=rese

DB_USERNAME=root

DB_PASSWORD=root


```
$ php artisan migrate
```

```
$ php artisan db:seed
```

```
$ php artisan serve
```

ブラウザで http://127.0.0.1:8000 を開く。

# Author

* Kazuki Mochida
* COACHTECH
* kaduki.mochida@gmail.com