# Установка
* Перейти в папку проекта `cd /path/to/project/`
* Склонировать репозиторий: `git clone git@github.com:nikserg/scoring.git .`
* Установить пакеты `composer install` (предполагается, что composer есть в системе)
* Установить фронтенд-пакеты: `yarn install` (предполагается, что node.js и yarn установлены в системе)
* Собрать JS и CSS: `yarn encore production`
* Создать в корне проекта файл настроек `.env.local`. В него записать конфигурацию БД. Пример содержимого файла:
```dotenv
DATABASE_URL=mysql://root:123@127.0.0.1:3306/scoring?serverVersion=5.7
``` 
* Накатить миграции: `php bin/console doctrine:migrations:migrate`
* Сгенерировать тестовые данные их фикстур: `php bin/console doctrine:fixtures:load`
* Запустить локальный сервер: `symfony server:start` (предполагается, что symfony установлена в системе) или настроить nginx/apache для работы с проектом
* Открыть сайт, по умолчанию `http://localhost:8000`

# Использование

## Веб

Предполагается, что сайт доступен по адресу `http://localhost:8000`

Регистрация пользователя: http://localhost:8000

Просмотр списка и управление пользователями: http://localhost:8000/admin

## Консоль

Команда для пересчета скоринга: `php bin/console app:score [id]`

Пересчиать для всех: `php bin/console app:score`

Пересчитать для пользователя с ID 54: `php bin/console app:score 54`