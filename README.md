# Queue API (Symfony)

Этот проект — система очередей на Symfony.

## 🚀 Установка

### 1. Клонирование репозитория:

git clone https://github.com/samatabdu/queue_api.git

cd queue_api

### 2. Установка зависимостей:

composer install

### 3. Настройка .env

настроит подключение к базе

### 4. Запуск миграций

php bin/console doctrine:migrations:migrate

### 5. Запуск сервера

symfony server:start



Эндпоинты API
		

| Метод  | URL | Описание |
| ------------- | ------------- | ------------- |
| POST  | /api/enqueue   | Добавить элемент в очередь                  |
| GET   | /api/dequeue   | далить и вернуть первый элемент из очереди  |
| GET   | /api/peek	     | Получить первый элемент без удаления        |
| GET   | /api/rear      | Получить последний элемент без удаления     |
| GET   | /api/is-empty  | Проверить, пуста ли очередь                 |
| GET   | /api/size	     | Получить количество элементов в очереди     |

