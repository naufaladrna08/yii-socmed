# Yii 2


##### Pengantar
1. Yii (Dibaca Yi, sering juga dianggap sebagai singkatan dari 
"Yes it is!") 2 adalah salah satu framework PHP.
2. Mengimplementasikan arsitektur Model, View dan Controller.
3. Kudu make PHP versi 5.4 kaluhur.

##### Instalasi

Untuk memulai, pastikan punya composer. Kalau nggak, download dulu.

```bash
composer create-project --prefer-dist yiisoft/yii2-app-basic basic
```

Untuk menjalankan Yii,

```bash
php yii serve
```

Kalau mau pake port lain selain 8080,

```bash
php yii serve --port=portbaru
```

Jika ingin deploy ke server, pastikan dokumen root-nya di folder ``web``.



##### Starter

```
basic/                  path aplikasi dasar
    config/             berisi konfigurasi aplikasi dan yang lain
        console.php     konfigurasi aplikasi konsole
        web.php         konfigurasi aplikasi web
    commands/           contains console command classes
    controllers/        contains controller classes
    models/             contains model classes
    runtime/            isinya file yg dihasilkan saat runtoime
    vendor/             contains the installed Composer packages, including the Yii framework itself
    views/              contains view files
    web/                application Web root, contains Web accessible files
        assets/         contains published asset files (javascript and css) by Yii
        index.php       the entry (or bootstrap) script for the application
    yii                 the Yii console command execution script
```



##### Workflow (Diambil dari dokumentasi)

![Request Lifecycle](https://www.yiiframework.com/doc/guide/2.0/id/images/request-lifecycle.png)

1. Pengguna membuat permintaan ke [skrip entri](https://www.yiiframework.com/doc/guide/2.0/id/structure-entry-scripts) `web/index.php`.
2. Naskah entri memuat [konfigurasi](https://www.yiiframework.com/doc/guide/2.0/id/concept-configurations) aplikasi dan menciptakan  [aplikasi](https://www.yiiframework.com/doc/guide/2.0/id/structure-applications) untuk menangani permintaan.
3. Aplikasi menyelesaikan [route](https://www.yiiframework.com/doc/guide/2.0/id/runtime-routing) yang diminta dengan bantuan  komponen [request](https://www.yiiframework.com/doc/guide/2.0/id/runtime-requests) aplikasi.
4. Aplikasi ini menciptakan [kontroler](https://www.yiiframework.com/doc/guide/2.0/id/structure-controllers) untuk menangani permintaan.
5. Controller menciptakan [action](https://www.yiiframework.com/doc/guide/2.0/id/structure-controllers) dan melakukan filter untuk action.
6. Jika filter gagal, aksi dibatalkan.
7. Jika semua filter lulus, aksi dieksekusi.
8. Action memuat model data, mungkin dari database.
9. Aksi meyiapkan view, menyediakannya dengan model data.
10. Hasilnya diberikan dikembalikan ke komponen aplikasi [respon](https://www.yiiframework.com/doc/guide/2.0/id/runtime-responses).
11. Komponen respon mengirimkan hasil yang diberikan ke browser pengguna.
