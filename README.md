Тестовое задание
================================

```
Разработать веб-форму для получения информации о сотрудниках предприятия.
Существует два сервера:
• На первом расположенабаза данных, где хранится информацияоб отделах и сотрудниках
предприятия. У каждого сотрудникаесть личная информация: ПИН, ФИО, контактные
данные (email, телефон, адрес), статус (назначен, освобожден).Напрямую в базу сервера
обращаться нельзя, можно только посредствам веб-сервиса.
• На втором веб-сервере есть веб-форма, которая позволяет получить информацию с
первого сервера.По средствам веб-формыможно получить такую информацию как:
o список всех сотрудников по отделам(список отделов тоже необходимо получать
по веб-сервису);
o личную информацию о сотруднике (отдел, ФИО, контактная информация) по ПИН.

Сервера должны обмениваться информациеймежду собойпо RESTful.
```
Screenshot
------
![alt tag](http://joxi.ru/Vm6ZVlxHxPgJqm)
![alt tag](http://joxi.ru/52agVEzfG5VJQr)
![alt tag](http://joxi.ru/8AnEjOouqeZdM2)
Files change
------
![alt tags](http://joxi.ru/DmB8vqLiNDVDjA)
```

http://test.work/admin/

-----ADD data in admin-----
http://test.work/admin/employee/employee
http://test.work/admin/employee/department
---------------------------
http://test.work/remote/employees
```


Enter admin
------
```
http://localhost/admin
login: root
pass: developer
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