<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

### Задание:

> Реализовать ToDo список.  
> Необходимый функционал:
> 1) Хранение списков в БД. Сохранение сделать без перезагрузки страницы (ajax)
> 2) Регистрация / авторизация пользователей для создания личных списков. Возможность редактирования сохраненных списков
> 3) Возможность прикрепить к пункту списка изображение. Для изображения должно автоматически создаваться квадратное превью размером 150x150px. При нажатие на превью - в новой вкладке открывается исходное изображение. Изображение можно заменить / удалить
> 4) Возможность тегировать пункты списка. Кол-во тегов может быть не ограниченым. Теги формируются самим пользователем, т.е. набор произвольный, не фиксированный.
> 5) Поиск по элементам списка. Фильтрация элементов списка по тегам (одному или нескольким)
> ---
> Если подытожить, то структура следующая: список = оболочка-контейнер, в котором создаются задачи Списков может быть несколько, задач в списках также может быть несколько Для списка достаточно задать наименование (остальное - по вашему усмотрению) Тегирование/изображение/поиск - всё это относится к задачам (не спискам)

### Дополнительно: (В процессе)

>1) Возможность расшарить список другому пользователю (т.е. пользователь А может дать доступ на чтение пользователю Б)
>2) Разграничение прав доступа к списку (пользователь А может только читать, пользователь Б может читать и редактировать)

### Стек:

- PHP 8.2
- Laravel 11.11
- MySQL 8.0

### Установка проекта

1. Клонируем репозиторий

```bash
git clone https://github.com/KonstantinKliman/test-task-notebook-api.git
```

2. Переходим в директорию с проектом

```bash
cd test-task-notebook-api
```

3. Устанавливаем зависимости

```bash
composer install
```

4. Делаем копию .`.env.example` и переименовываем в `.env`

5. Запускаем приложение

```bash
./vendor/bin/sail up -d
```

- Примечание:

Для того, чтобы каждый раз не писать в консоли `./vendor/bin/sail up -d` можно добавить алиасы

```bash
alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'
```

Потом можно поднимать контейнеры через команду:

```bash
sail up -d
```

6. Сгенерировать ключ приложения

```bash
sail artisan key:generate
```

7. Применяем миграции к бд
```bash
sail artisan migrate 
```

8. Создаём символическую ссылку для storage
```bash
sail artisan storage:link
```
