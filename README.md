<h2 align="center">
  Mukellef.co Project
</h2>
<br> 

## 🚀 Teknolojiler

- [PHP 8.1.3](https://php.net)
- [Laravel 10](https://php.net)
- [Xdebug 3](https://xdebug.org/)
- [Nginx](https://nginx.com/)
- [MySQL](https://mysql.com)
- [Docker](https://docker.com)
- [Redis](https://redis.io/)

## ⚙️ Setup & Run
- Repoyu klonlayın.
- docker komutunu terminalden çalıştırın.
```
Bu komut gerekli tüm ortamı hazırlayacaktır. Db'i oluşturup migrate edecektir.
# docker-compose up -d
```  
- API URI http://localhost:8000
- Redis 127.0.0.1:6489
- phpMyAdmin http://localhost:9090
- Sunucu: db
- user: root
- password: root

##  Schedule & Command
- Manuel olarak elle çalıştırmak isterseniz eğer. Lütfen adım adım aşağıdakileri uygulayın.

1- Projenin olduğu dizine girin.
```
- Bu komut çalışan kontainer listeleyecektir.
# docker ps
```
2- Çalışan Kontainerlar içerisinde app olarak listelenen kontainer id'sini kopyalayın. Ve ardından sunucuya girmek için aşağıdaki kodu uygulayın.
```
- Bu komut sizi sanal sunucunun içerisine girmenizi sağlayacaktır.
# docker exec -it <APP_ID> bash
```
3- Ardından gerekli schedule komutlarını çalştırabilirsiniz.
```
- Subscription kontrol edip gerekli yenileme işlemlerini yapacaktır.
# php artisan subscription:check
```

<h2 align="center">
  ÖNEMLİ LÜTFEN OKUYUN
</h2>



## Açıklamalar
- XAMPP vs MAMP gibi web sunucuları kurmaya vakit harcamanızı istemediğim için. Docker Container ile tüm işleri tek satıra düşürdüm.
- Çok kısa bir kurulum ve anlaşılır bir şekilde yapmaya çalıştım.
- Umarım Projemi Beğenirsiz 



## 💻 SUNUCU ERROR (APP HTTP 304)
/.docker/entrypoint.sh dosyasının yetkisi olmadığı için sunucu başlatılırken yazılma izinleri gerçekleştirilemiyor. Bunun için adım adım
bu 3 komutu dizine geldiğinizde çalıştırdığınızda sorun ortadan kalkacaktır.<br>
(UYARI) Lütfen projenin olduğu dizinde olun.
```
- docker-compose down
- chmod +x .docker/entrypoint.sh
- docker-compose up || docker-dompose up -d 
```
