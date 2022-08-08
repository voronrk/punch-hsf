# Hawking School. Курсовая работа по направлению Backend

За основу взят реальный рабочий проект - каталог вырубных штампов для полиграфической продукции. В рамках данной работы он воссоздан с нуля по шагам с использованием (по возможности) правильных подходов.

Разработка ведётся в ветке репозитория master. Для каждого нового блока логики создаётся отдельная ветка, которая потом сливается в основную.

## Создание моделей и миграций (ветка database)

Основной объект, описываемый в данном проекте, - вырубной штамп (модель Punch). Штамп используется для изготовления одного или нескольких видов продукции (модель Product, обратная связь с моделью Punch "многие-ко-многим") из одного или нескольких видов материалов (модель Material, обратная связь с моделью Punch "многие-ко-многим") и может использоваться на одном или нескольких станках (модель Machines, обратная связь с моделью Punch "многие-ко-многим"). Все вышеупомянутые модели связаны через связующие модели (MachinePunch, MaterialPunch, ProductPunch). Кроме того, с каждым штампом связаны одно или несколько изображений (фото готовой продукции, крой и т.п; модель Pic, обратная связь с моделью Punch "многие-к-одному"). 

Модели созданы командой Artisan make:model (папка app/Models).

Для создания таблиц в БД используются миграции (команда make:migration, папка database/migrations). Таблицы свойств (products, machines, materials) имеют общую структуру (колонки id и value). Таблица pics помимо этого содержит колонку punch_id, связанную с колонкой id таблицы punches. Связующие таблицы содержат ключи, связанные с таблицей punches и соответствующей таблицей свойств. Таблица punches содержит колонки для свойств, которые характеризуют конкретный штамп, поэтому их нерационально выносить в отдельные таблицы.

Для таблиц свойств созданы заполнители (команда make:seeder, папка database/seeders), чтобы не было необходимости заполнять их после установки приложения.

## Создание контроллеров (ветка controllers)

Для каждой модели свойств и для главной модели Punch создаются ресурсные контроллеры (команда make:controller с ключом --resource).

Поскольку контроллеры для моделей свойств абсолютно идентичны и отличаются только используемой моделью, весь их функционал вынесен в абстрактный класс PropertyController, от которого наследуются контроллеры конкретных свойств (в них остался только конструктор, записывающий нужную модель в экземпляр контроллера).

## Создание валидаторов (ветка validation)

Для моделей свойств создан валидатор PropertyRequest - один для всех методов. В методе rules задаются правила для валидации полей id и value, а также производится проверка используемого метода для применения соответствующих правил (чтобы не плодить отдельные классы для каждого метода). Заданы понятные сообщения для ошибок валидации, а также переопределён метод failedValidation для возвращения текста ошибки вместо перенаправления.

Для модели Punch создан аналогичный валидатор PunchRequest. Основное отличие его от предыдущего - в правилах валидации для полей (их больше и они разнообразнее) и их модификации под разные методы.

Также в этой ветке создан контроллер PunchController: созданы методы index, show, update, destroy, create. Метод update пока не обновляет привязку к свойствам (продукты, машины, материалы) и картинки (доделаю, если успею).

