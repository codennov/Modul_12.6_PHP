# 12.6. Практическая работа

## Описание работы
Дан Массив $persons_array


### Разбиение и объединение ФИО
Обработка строк
В вашей информационной системе ФИО пользователей хранятся в виде строк, содержащих сразу и фамилию, и имя, и отчество (именно в этом порядке). В некоторых случаях такие данные требуется разъединять.

Разработайте две функции: getPartsFromFullname и getFullnameFromParts.

getFullnameFromParts принимает как аргумент три строки — фамилию, имя и отчество. Возвращает как результат их же, но склеенные через пробел.
Пример: как аргументы принимаются три строки «Иванов», «Иван» и «Иванович», а возвращается одна строка — «Иванов Иван Иванович».

getPartsFromFullname принимает как аргумент одну строку — склеенное ФИО. Возвращает как результат массив из трёх элементов с ключами ‘name’, ‘surname’ и ‘patronomyc’.
Пример: как аргумент принимается строка «Иванов Иван Иванович», а возвращается массив [‘surname’ => ‘Иванов’ ,‘name’ => ‘Иван’, ‘patronomyc’ => ‘Иванович’].

Обратите внимание на порядок «Фамилия Имя Отчество», его требуется соблюсти.

 

### Сокращение ФИО
Обработка строк
_______________
При разработке информационной системы вы всячески стараетесь избежать распространения персональных данных. При отображении информации пользователю о других пользователях требуется сокращать фамилию и откидывать отчество.

Разработайте функцию getShortName, принимающую как аргумент строку, содержащую ФИО вида «Иванов Иван Иванович» и возвращающую строку вида «Иван И.», где сокращается фамилия и отбрасывается отчество. Для разбиения строки на составляющие используйте функцию getPartsFromFullname.

 

### Функция определения пола по ФИО
Обработка строк, космический корабль, арифметика
_________________________________________________
При разработке информационной системы вы всячески стараетесь избежать сбора персональных данных. Однако, видимо, дизайнера забыли об этом предупредить, и он разработал два вида интерфейса — “мужской” и “женский”. Получилось очень здорово, и вы решили определять пол автоматически по ФИО.

Разработайте функцию getGenderFromName, принимающую как аргумент строку, содержащую ФИО (вида «Иванов Иван Иванович»). 

Будем производить определение следующим образом:

внутри функции делим ФИО на составляющие с помощью функции getPartsFromFullname;
изначально «суммарный признак пола» считаем равным 0;
если присутствует признак мужского пола — прибавляем единицу;
если присутствует признак женского пола — отнимаем единицу.
после проверок всех признаков, если «суммарный признак пола» больше нуля — возвращаем 1 (мужской пол);
после проверок всех признаков, если «суммарный признак пола» меньше нуля — возвращаем -1 (женский пол);
после проверок всех признаков, если «суммарный признак пола» равен 0 — возвращаем 0 (неопределенный пол).
Признаки женского пола:

отчество заканчивается на «вна»;
имя заканчивается на «а»;
фамилия заканчивается на «ва»;
Признаки мужского пола:

отчество заканчивается на «ич»;
имя заканчивается на «й» или «н»;
фамилия заканчивается на «в».
 

### Определение возрастно-полового состава
Обработка массивов, арифметика, обработка строк
_______________________________________________
В админском интерфейсе требуется выводить половой состав аудитории.

Напишите функцию getGenderDescription для определения полового состава аудитории. Как аргумент в функцию передается массив, схожий по структуре с массивом $example_persons_array. Как результат функции возвращается информация в следующем виде:

Гендерный состав аудитории:
---------------------------
Мужчины - 55.5%
Женщины - 35.5%
Не удалось определить - 10.0%
Используйте для решения функцию фильтрации элементов массива, функцию подсчета элементов массива, функцию getGenderFromName, округление.

 

### Идеальный подбор пары
Обработка массивов, арифметика, обработка строк
_______________________________________________
Совсем недавно вы решили добавить в информационную систему «идеальный подбор пары». Рекламщики уже привлекли внимание, руководство ждёт большие доходы, но вот функции для подбора пары еще нет.

Напишите функцию getPerfectPartner для определения «идеальной» пары.

Как первые три аргумента в функцию передаются строки с фамилией, именем и отчеством (именно в этом порядке). При этом регистр может быть любым: ИВАНОВ ИВАН ИВАНОВИЧ, ИваНов Иван иванович.

Как четвертый аргумент в функцию передается массив, схожий по структуре с массивом $example_persons_array.

Алгоритм поиска идеальной пары:

приводим фамилию, имя, отчество (переданных первыми тремя аргументами) к привычному регистру;
склеиваем ФИО, используя функцию getFullnameFromParts;
определяем пол для ФИО с помощью функции getGenderFromName;
случайным образом выбираем любого человека в массиве;
проверяем с помощью getGenderFromName, что выбранное из Массива ФИО - противоположного пола, если нет, то возвращаемся к шагу 4, если да - возвращаем информацию.
Как результат функции возвращается информация в следующем виде:

Иван И. + Наталья С. = 
♡ Идеально на 64.43% ♡
Процент совместимости «Идеально на ...» — случайное число от 50% до 100% с точностью два знака после запятой.
