Тестовое задание
================================

```
Необходимо реализовать пользовательский механизм обработки сессии PHP (версия 7.x)

Требования:
1. Реализовать класс, имплементирующий интерфейсы SessionHandlerInterface и SessionIdInterface
2. Чтение/запись из/в хранилищие реализовать в виде класса, реализующий интерфейс взаимодействия с хранлищем данных сессии (интерфейс разработать самостоятельно)
Реализовать версию данного интерфейса для хранилища на базе СУБД MySQL. Экземпляр данного класса передавать в конструктор класс из п.1
3. Написать код инициализации сессии PHP с использование класса из п.1 Данный код будет использоваться для подключения реализованного механизма обработки сессии к движку системы (движок будет на базе Yii2)
4. Написать код для запуска механизма сборки мусора сессии, работающий как в контексте CGI, так и в контексте CLI, для вызова данного кода через cron
5. Первичный ключ записи в хранилище составной:
SERVER_ID - VARCHAR(16)
SESSION_ID - VARCHAR(32)
6. Реализовать запись и чтение данных сессии без блокировок.
```
Screenshot
------

http://joxi.ru/nAyKvLZCgL3djm

Links
------
```
http://test.work/sessionDb/
```

Installation
------
~~~
git clone
cd project
composer install
~~~

Init an environment:

~~~
php init
~~~

Fill your DB connection information in `config/common-local.php` and execute migrations:

~~~
php yii migrate
~~~

Sign up on site or create your first user manually:

~~~
php yii user/users/create
~~~

Init RBAC roles:

~~~
php yii rbac/init
~~~

Assign `admin` role to your user:

~~~
php yii roles/assign
~~~
