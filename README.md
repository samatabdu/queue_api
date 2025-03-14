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
Метод	URL	Описание

POST	/api/enqueue	Добавить элемент в очередь
GET	    /api/dequeue	Извлечь первый элемент
GET	    /api/peek	    Посмотреть первый элемент
GET	    /api/rear	    Посмотреть последний элемент
GET	    /api/size	    Получить размер очереди
GET	    /api/isEmpty	Проверить, пуста ли очередь
