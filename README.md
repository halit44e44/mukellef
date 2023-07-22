
## DOCKER HATASI
/.docker/entrypoint.sh dosyasının yetkisi olmadığı için sunucu başlatılırken yazılma izinleri gerçekleştirilemiyor. Bunun için adım adım 

- docker-compose down
- chmod +x .docker/entrypoint.sh
- docker-compose up 

bu 3 komutu dizine geldiğinizde çalıştırdığınızda sorun ortadan kalkacaktır.
