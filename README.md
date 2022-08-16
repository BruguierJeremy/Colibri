# Colibri

# Installation of the project (DEV)

- ```git checkout develop``` (go on the branch where I've code)
- ```composer install```    (dependencies installation)
- create a file named : ```.env.local```
- edit it with : ```DATABASE_URL="mysql://Colibri:password@127.0.0.1:3306/Colibri?serverVersion=mariadb-10.3.32&charset=utf8mb4"```
- be careful about the version of mariadb
- create Database (Colibri) and user with same name (Colibri) and password (password), give the user all permissions on database with same name ( you can do it with : ```bin/console doctrine:database:create``` but create the user first)
- ```bin/console do:mi:mi``` (DB table creation)
- ```bin/console do:fi:lo``` (FakeData)
- ```php -S 0.0.0.0:8000 -tpublic``` (server)