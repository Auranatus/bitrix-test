## Первоначальная настройка

* Скачать архив с ядром Битрикс и дамп базы данных в папку dump/ в корне проекта  
  <br>
  [Архив с ядром](https://drive.google.com/file/d/1GLVp1zeaNTjzlo-UeFO1O3ab_1Y_KODm/view)  
  [Дамп бд](https://drive.google.com/file/d/1dYxPu4YXWdlQT79U68QlT119me7Z6son/view)  
  <br>
* Перейти в корень проекта и запустить контейнеры  
```bash
docker-compose up -d
```
* Запустить файл init
```bash
./init
```
**Контейнеры обязательно долны быть запущены, иначе дамп базы не накатится**

## Запуск и остановка

Запуск контейнеров  
```bash
docker-compose up -d
```
Остановка контейнеров
```bash
docker-compose down
```

### Адрес сайта: localhost

### Доступы к административной части
Логин: admin  
Пароль: administrator