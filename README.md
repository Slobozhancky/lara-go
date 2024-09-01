# Laravel зміст

1. [Встановлення](#Встановлення)
2. [.htaccess та Конфігурації](#htaccess-та-Конфігурації)
    - [Різниця між `local` та `production`](#Різниця-між-local-та-production)
3. [Service Container, Provider, Facades](#service-container-provider-facades)
4. [Routing](#routing)
5. [Controllers](#controllers)
6. [Views](#Views)
7. [Blade](#Blade)
8. [Використання шаблонів Blade](#Використання-шаблонів-Blade)
9. [Директиви Blade](#Директиви-Blade)
10. [Збірка проекту за допомогою Vite](#Збірка-проекту-Vite)
11. [Міграції](#Міграції)
12. [Database](#Database)
13. [Query builder](#Query-builder)
14. [Eloquent ORM](#Eloquent-ORM)
15. [Collection](#Collection)
16. [One to One](#One-to-One)

## Встановлення

-   Перед встановленянм Laravel, слід перевірити, або оновити версію Composer, це слід робити командою `composer self-update`
-   Тут все просто, ідем на сайт оф документації [Laravel](https://laravel.com/docs/11.x/installation), та слідуємо інструкції
-   ПІсля установки, можна перевірити версію Laravel, командою `php artisan -V`. А команда `php artisan` надасть доступ до всіх команд
    -   **Artisan** — це інтерфейс командного рядка, який постачається разом з Laravel. Він надає ряд корисних команд для розробки та управління додатком Laravel. Artisan значно спрощує виконання багатьох задач, таких як створення міграцій, генерація коду та виконання тестів.
-   Якщо раптом нам потрібно зрозуміти які вимоги до того, чи іншої версії Laravel, це слід перевірити в розділі [Server Requirements](https://laravel.com/docs/11.x/deployment#server-requirements)

## .htaccess та Конфігурації

1.  Налашутвання файлу `.htaccess` схоже на налштування цього ж файлу для звичайного MVC патерну, який я робив в [проєкт](https://github.com/Slobozhancky/blog). Тобто головною метою, є те, щоб створити **едину точку входу**, який буде направляти всі запити у папку `public`

-   Дуже [простий приклад](https://i.imgur.com/ZL9PM7M.png), щоб запити з кореня, йшли в папку public, яка вже і так має свій файл `.htaccess`, щоб прийнти запит

2. Протестувати роботу конфігурацій, можна у файлі `lara.go.loc\routes\web.php`, просто тут маршрути будуть вести на головну сторінку, а нам слід лише виводи інформацію, щоб побачити результат

-   Всі наші конфігурації знаходяться в папці `lara.go.loc\config`
-   якщо ми хочемо отримати доступ до конфігурації, мо мижемо використовувати [функції хелпери](https://laravel.com/docs/11.x/helpers) - їх досить багато, але основні, що нас будуть цікавити це [config](https://laravel.com/docs/11.x/helpers#method-config)
-   `dump`, `dd` - ці дві функції, вони використовуються просто для виводу інформації
-   Стосвно того, щоб вивести нам інформацію якоїсь з конфігурацій, використовуємо функцію хелпер `config()` - вона приймає строку, у форматі `config('app.name')` - томущо,Ю якщо ми підекмо у файл `config/app` - томи побачимо повернуння значень у вигляди `ключ => значення` а запис `config('app.name')` дозволить нам, отримати імя ghjtrne [приклад](https://i.imgur.com/DfinyBd.png)
-   Дані в конфігурації, ми отримуємо з `змінних навколишнього середовища проекту`, тобто з файлу `lara.go.loc\.env` - в цьому файлі, зберігаються всі налашутванян нашого проекту, які нам слід буде задавати для наших цілей

-   Ми можемо і налаштовувати наші конфігурації, наприклад у файлу [.env створимо змінні](https://i.imgur.com/Z0uMWHv.png), потім у файлі `config/app` створимо конфігурацію, та з файлу .env [передамо ці змінні](https://i.imgur.com/hcQ28fL.png), ну і у файлі `routes/web` [виведемо інформацію](https://i.imgur.com/pkfT0RH.png)

-   Ну і звісно, ми можемо створювати наші файли конфігурацій [приклад](https://i.imgur.com/mgiiefq.png)

## Різниця між local та production

В змінній `APP_ENV` файла `.env` - ми вказуємо, чи буде ми працювати `local`, чи `production`, та різниця тут в тому, що:

### 1. Конфігурації середовища

**Local:**

-   Використовується файл `.env` з налаштуваннями, специфічними для локального середовища, такими як база даних, поштові налаштування тощо.
-   Значення змінних `APP_ENV` встановлено на `local`, `APP_DEBUG` на `true`.
-   Можливе використання менш потужних баз даних та серверів.

**Production:**

-   Використовується файл `.env` з налаштуваннями, специфічними для продуктивного середовища.
-   Значення змінних `APP_ENV` встановлено на `production`, `APP_DEBUG` на `false`.
-   Використовуються високопродуктивні бази даних та сервери, оптимізовані для великих навантажень.

### 2. Налагодження (Debugging)

**Local:**

-   Налагодження увімкнене (`APP_DEBUG=true`), що дозволяє бачити детальні повідомлення про помилки.
-   Використання інструментів для налагодження, таких як Laravel Debugbar.

**Production:**

-   Налагодження вимкнене (`APP_DEBUG=false`), щоб уникнути витоку чутливої інформації.
-   Логування налаштовано на запис у файли або зовнішні системи моніторингу.

### 3. Безпека

**Local:**

-   Можуть використовуватись менш суворі налаштування безпеки.
-   Доступ до середовища обмежений лише розробниками.

**Production:**

-   Строгі налаштування безпеки, такі як використання HTTPS, захист від SQL-ін'єкцій, CSRF-токенів, тощо.
-   Обмежений доступ до сервера, використання брандмауерів та інших засобів захисту.

### 4. Оптимізація продуктивності

**Local:**

-   Мінімальна оптимізація для швидкості розробки.
-   Відсутність або мінімальна кешування, конфігурацій та маршрутів.

**Production:**

-   Використання кешування для конфігурацій, маршрутів, переглядів тощо.
-   Виконання команд для оптимізації, таких як `php artisan config:cache`, `php artisan route:cache`, `php artisan view:cache`.

### 5. Тестування

**Local:**

-   Часто використовуються вбудовані сервери для тестування та розробки.
-   Тестування нових функцій, фіксів і змін.

**Production:**

-   Ретельне тестування на тестовому середовищі перед розгортанням на продуктивному сервері.
-   Використання CI/CD інструментів для автоматизації розгортання та тестування.

### 6. Інструменти та сервіси

**Local:**

-   Використання локальних інструментів для розробки, таких як Homestead, Valet, або XAMPP/MAMP.
-   Використання локальних баз даних та серверів.

**Production:**

-   Використання хмарних інфраструктур або спеціалізованих серверів для розгортання.
-   Інтеграція з сервісами моніторингу та логування, такими як New Relic, Sentry.

## Service Container, Provider, Facades

### Що таке Service Container?

Уяви, що Laravel — це велика будівля, в якій є багато різних кімнат, і кожна з них має своє призначення. Наприклад, одна кімната може бути для збереження даних, інша — для відправки електронної пошти, третя — для обробки платежів.

**Service Container** у Laravel — це як менеджер цієї будівлі, який знає, де знаходиться кожна кімната і що в ній робиться. Коли тобі потрібно виконати якусь дію, наприклад, відправити електронний лист, ти запитуєш у менеджера (Service Container), і він тобі надає доступ до потрібної кімнати.

### Що таке Service Provider?

Тепер уяви, що в цій будівлі з'являються нові кімнати або змінюються існуючі. **Service Provider** — це як працівники, які створюють ці нові кімнати і налаштовують їх. Вони кажуть менеджеру (Service Container), де знаходиться нова кімната і як її використовувати.

### Як вони між собою пов'язані?

1. **Service Provider** створює та налаштовує нові сервіси (кімнати).
2. **Service Provider** реєструє ці сервіси у **Service Container**.
3. **Service Container** зберігає всі сервіси і надає доступ до них, коли це потрібно.

### Простий приклад:

1. У тебе є кімната для відправки електронної пошти.
2. **Service Provider** налаштовує цю кімнату, наприклад, вказує, які налаштування потрібні для відправки пошти (SMTP сервер, порт тощо).
3. **Service Provider** реєструє цю кімнату у **Service Container**.
4. Коли тобі потрібно відправити листа, ти запитуєш **Service Container**, і він надає тобі доступ до налаштованої кімнати для відправки пошти.

Таким чином, **Service Container** та **Service Provider** працюють разом, щоб забезпечити доступ до різних частин твоєї програми легко і зручно.

### Як працювати з **Service Container** та **Service Provider**

1.  Тож почнемо. Звертатись до **Service Container** можна через змінну $app, через фасад App, або за допомогою хелперів app()
2.  Якщо говорити про змінну `$app` вона знаходиться в `lara.go.loc\public\index.php`, та вона до себе підключає такий файл як `lara.go.loc\bootstrap\app.php`.

    -   А вже в самому файлі `app.php` - відбуваються підключення нашого проекту
    -   Якщо пробувати роздрукувати змінну `$app` - то ми зможемо побачити всі наші контейнери. [Приклад](https://i.imgur.com/9CfcULu.png)

3.  Щоб отримати доступ до якогось класу, нам слід викликати метод `make` від змінної (або фасаду, або хелпера) `$app`. А щоб розуміти, які класи ми можемо викликати, можна [глянути в доку ](https://laravel.com/docs/11.x/facades#facade-class-reference)

    -   [Приклад як це використати](https://i.imgur.com/FYBHFoV.png). Але схоже, що такий виклик трохи не коректний, бо і [так, буде вірно працювати ]()
    -   А взагалі, для чого це нам корисно. Щоб мати змогу, присвоїти наприклад змінній контейнер класу, а потім з цієї змінної викликати методи, цього класу
    -   [Це в принципі той самий приклад, але з викликом методу відповідного класу](https://i.imgur.com/u4o0kEW.png) - тут ми в кеш кладемо значення по ключу і потім його по цьомуж ключу забираемо

        Добре, спробую пояснити на простому прикладі.

### Що таке Facades?

Уяви, що ти маєш багато різних інструментів для виконання різних завдань: молоток для забивання цвяхів, викрутка для вкручування гвинтів і так далі. Кожен інструмент — це окремий об'єкт з певною функціональністю.

**Facades** в Laravel — це як універсальний інструмент, який дозволяє тобі легко використовувати ці різні інструменти, не турбуючись про те, де вони знаходяться або як їх правильно використовувати.

### Як це працює?

1. **Facades** забезпечують простий і зручний спосіб доступу до різних класів у Laravel. Замість того, щоб створювати об'єкти цих класів і викликати методи безпосередньо, ти використовуєш **Facades**.
2. **Facades** представляють статичний інтерфейс до об'єктів у **Service Container**.

### Приклад:

Уяви, що тобі потрібно зберегти якесь повідомлення в лог (журнал) твого додатка.

**Без Facades:**

```php
use Illuminate\Support\Facades\Log;

$log = new Log();
$log->info('Це повідомлення зберігається у лог.');
```

**З Facades:**

```php
use Log;

Log::info('Це повідомлення зберігається у лог.');
```

### Чому це корисно?

1. **Спрощує код:** Використання **Facades** робить код більш читабельним і компактним, бо ти не маєш створювати об'єкти вручну.
2. **Легкий доступ:** **Facades** надають легкий доступ до служб у **Service Container**, не турбуючись про їхню реєстрацію або налаштування.
3. **Зручність:** Замість того, щоб пам'ятати, як створювати і налаштовувати кожен об'єкт, ти просто використовуєш **Facades** і вони роблять це за тебе.

### Приклад застосування на [прикладі кешування](https://i.imgur.com/6QGOYvB.png)

```php
Route::get('/', function () {
    $cache = app('cache');
    $cache->put('test', 'Hello world!!!');
    dd(Cache::get('test'));
});
```

## Routing

1. Більше інформації, про Routing, можна отримати в [документації](https://laravel.com/docs/11.x/routing)
2. Якщо в нас виникне потреба, побачити всі шляхи маршрутів, слід скористватись командою: `php artisan route:list`
3. Щоб викликати роутінг, слід скористуватись методом `get`, для фасаду класу `Route`
   - Перший параметр методу `get` має прийняти `шлях` до сторінки
   - Другим, це `callback` функцію яка повинна нам щось повернути
    ```php
    Route::get('/', function () {
    return 'Hello world!!!';
    });
    ```
4. Для того щоб, повернути якийсь певний вид `view` нам слід використовувати фінкцію хелпер `view()`. Вона своєю чергою, може приймати:
   - `$view` - вид до якого ми намагаємось отримати доступи. А самі види, в нас будуть знаходитись в папці `lara.go.loc/resources/views`
   - `$data = []` - можемо прийняти дані у вигляді масиву, або просто змінною
   - `$mergeData = []` - Він дозволяє передавати додаткові дані до шаблону, які будуть об'єднані з основними даними.
   -  [Приклад](https://i.imgur.com/SsSOR4k.png) - використання такого роуту з використанням функції `view()`
   - А тут [приклад того](https://i.imgur.com/QtAb99V.png), як я виведу інформацію, за зі змінної `$data = []` у нашому виді
   
5. Також є спосіб, більш коротко виводити наші види, але якщо нам не потрібно використовувати `controllers`. Це може бути корисно, якщо ми маємо просто [статичну сторінку](https://i.imgur.com/9C1qVNx.png)
```php
    Route::view('/static-page', 'static-page', ['title'  => "Тестова сторінка"]);
```

6. Якщо в нас є потреба, достукатись до якогось певного (поста, продукта і тд.) нам потрібно використовувати його `ID`, або `slug`, тому в маршрутах, ми можемо вказати це наступним чином:
```php
Route::get('posts/{id}', function ($id = 1){
    return "Post: {$id}";
});
``` 
- Тут суть в тому, що ми передаємо наш get параметр нашого (`ID`, або `slug`) параметром в `callback` функцію, щоб потім повернути [цей параметр](https://i.imgur.com/BePpjln.png)
- 
7. Параметр, може бути не один, їх може бути скільки нам треба, але і не треба їх пихати дуже багато. [Приклад](https://i.imgur.com/Lo3Ova9.png)

```php
Route::get('posts/{id}/comment/{comment_id}', function ($id = 1, $comment_id){
    return "Post: {$id}, comment ID: {$comment_id}";
});
```

8. Також ми можемо робити перевірки, наших параметрів, в маршрутах, за допомогою регулярних виразів
```php
Route::get('posts/{id}', function ($id){
    return "Post: {$id}";
})->where(['id' => '[\d]+']);
``` 

- Або ще, ми можемо Глобально, вказувати патерни у файлі `lara.go.loc/app/Providers/RouteServiceProvider.php` для перевірки параметрів URL адреси. [Приклад](https://i.imgur.com/R3fhNzh.png). Та таким чином, нам не потрібно буде робити, окремо перевірку, на кожен роут окремо

9. Також при роботі з роутами, ми можемо відправляти запити, різними методами. [Основні методи](https://laravel.com/docs/11.x/routing#available-router-methods): get, post, put, patch, delete
- І в наступному прикладі, коли ми маємо одну сторінку: `https://lara.go.loc/posts` - але відпрацьовувати вона буде по різному для різних методів
- Для методу GET ми отримаємо стоірнку в [браузері](https://i.imgur.com/t78VTj1.png)
- Для методу POST ми можемо скористатись POSTMAN, щоб там побачити дані. НУ або попізже, ми для цього, будемо юзати `controllers`
> Але ми зіштовнемось в POSTMAN з [помилкою 419](https://i.imgur.com/mqXN3dx.png) - яка буде вказувати нам, що дані методом POST були відправлені як незахищені. 
> CSRF (Cross-Site Request Forgery) — це вид атаки на веб-додатки, коли зловмисник змушує користувача виконати небажані дії на веб-сайті, на якому користувач автентифікований. Це може призвести до небажаних змін або крадіжки даних.
> ### Як працює CSRF атака?
> 1. **Користувач автентифікується на веб-сайті (наприклад, вхід у систему).**
> 2. **Зловмисник створює підроблену форму або посилання, яке містить запит до цього веб-сайту.**
> 3. **Користувач, будучи автентифікованим, натискає на це посилання або заповнює форму на іншому сайті, не підозрюючи про небезпеку.**
> 4. **Запит виконується від імені користувача, бо браузер автоматично додає автентифікаційні кукі, і веб-сайт виконує небажану дію.**
> 
> ### Захист від CSRF в Laravel
> 
> Laravel має вбудований захист від CSRF атак. Основний метод захисту — використання CSRF токенів.
> 
> #### Як це працює:
> 
> 1. **CSRF токен генерується сервером і вбудовується в кожну форму, яка відправляє дані через POST, PUT, PATCH або DELETE запити.**
> 2. **Коли форма відправляється, токен включається в запит.**
> 3. **Сервер перевіряє, чи CSRF токен, що надійшов із запитом, відповідає токену, збереженому у сесії користувача.**
> 4. **Якщо токени не співпадають, запит відхиляється.**
> 
> #### Приклад у Laravel:
> 
> У шаблоні Blade для включення CSRF токену в форму використовується хелпер `@csrf`:
> 
> ```html
> <form method="POST" action="/some-endpoint">
>     @csrf
>     <!-- інші поля форми -->
>     <button type="submit">Відправити</button>
> </form>
> ```
> 
> Це додає приховане поле в форму з CSRF токеном:
> 
> ```html
> <input type="hidden" name="_token" value="CSRF_TOKEN_HERE">
> ```

- Тому першим способом вимкнути CSRF захист, для певних маршрутів це піти у файл `lara.go.loc/app/Http/Middleware/VerifyCsrfToken.php` і там [вказати маршрут](https://i.imgur.com/PHGvwmr.png), для якого цей захист буде вимкнено. І тоді [запит через POSTMAN](https://i.imgur.com/bel9u18.png) піде вдало
- Другим способом є те, щоб використати метод `withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class)` на самому маршруті 
```php
Route::post('posts', function (){
    return "Hello this is method POST, of posts page";
})->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
```
10. Також ми можемо об'єднувати методи, для отримання маршруту за допомогою методу `match` класу `Route`. [приклад](https://i.imgur.com/eVZTdbY.png). Але не забуваємо використовувати захист від CSRF атак, або його тимчасово вимикати
```php
Route::match(['get', 'post'],'get-posts', function (){
    return "Hello this is method GET|POST, of posts page";
})->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
```

11. Якщо нам потрібно отримувати сторінку, будь-яким методом, тут слід використати метод `any` класу `Route`. [Приклад](https://i.imgur.com/PvLPX43.png). Але не забуваємо використовувати захист від CSRF атак, або його тимчасово вимикати
```php
Route::any('get-posts', function (){
    return "Hello this is method ANY, of posts page";
})->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
```

12. Можливо нам знадобиться використати `redirect`, то для цього можемо використати метод `redirect` класу `Route`
```php
Route::redirect('here', 'get-posts', 302); // тут відбудеться те, якщо ми запросимо сторінку https://lara.go.loc/here, але нас перекине на сторінку https://lara.go.loc/get-posts
```
13. Наступне, що нам може бути корисне, це групування маршрутів. Як мінімум це корисно, для лаконічності, гарнішого коду, об'єднання маршрутів для однієї сутності, якщо, наприклад, потрібно використати один контролер, для однієї групи
- Таке використання можливе за допомогою методу `prefix` класу `Route`, та методу `group` для `prefix`
```php
Route::prefix('admin')->group(function (){
    Route::get('/', function () {
        return "Admin main page";
    });

    Route::get('/posts', function () {
        return "Admin page, for all posts";
    });

    Route::get('/posts/{id}', function ($id) {
        return "Admin post {$id}";
    });
});
```
14. Якщо ми не хочемо при відсутності сторінки, віддавати сторінку з `404` помилкою, можна використати метод `fallback` класу `Route`.
> Але слід розуміти, що цей маршрут слід ставити останім, бо він буде тим заключним маршрутом, який спрацює, при відсутності збігів
```php
Route::fallback(function (){
  return "Fallback page";
});
```
- І тут же, ми можемо використати функцію хелпер `response()` - яка може передати: **текст помилки, код відповіді від серверу, та додаткові заголовки**
```php
Route::fallback(function (){
  response('fallback done', 200)
  return "Fallback page";
});
```
- А якщо це `APIшка`, то відповідь, треба повертати у форматі `JSON`. [Як це буде виглядати](https://i.imgur.com/otum9SY.png)
```php
Route::fallback(function (){
    return response()->json(['title' => 'this is Fallback page'], 404);
});
```

- Ще корисною функцією для наших цілей, може бути функція `abort()`. Вона приймає: повідомлення, яке слід вивести, та код помилки. Аще, плюс цієї функції в тому, що можна у папці `lara.go.loc/resources/views` створити папку `errors` і там створити сторінку, з тим кодом помилки, яку ми будемо передавати у функцію `abort()`. Бо функція може нас, редірекнути на цю стоірнку. [Приклад](https://i.imgur.com/csrKqb6.png)
> Але тут є нюанс, що для того, щоб нам отримати другий параметр (тобто повідомлення, яке вона повертає) функції `abort()`, нам слід достукатись до змінної `$exception` і його методу `getMessage()`. [Приклад](https://i.imgur.com/Ox2rwM7.png)
```php
Route::fallback(function (){
    abort(404, "This is 404 page");
});
```
15. Ну і тут розглянемо якусь базу, з `controllers`.
- Всі наші контролери, які ми будемо створювати, повинні наслідувати базовий контролер `lara.go.loc/app/Http/Controllers/Controller.php`
- Створимо тестовий перший контролер `lara.go.loc/app/Http/Controllers/TestController.php`
- Кожен контролер, повинен мати `actions`. Першим actions створимо `index` та він буде в нас запускати вид у `routes`
```php
class TestController extends Controller
{
    public function index(){
        return view('test', ['title' => 'Title page'] );
    }
}

```
- А потім в роутах, будемо викликати цей контролер і обов'язково вкажемо action який має бути запущено 
```php
Route::get('test', [\App\Http\Controllers\TestController::class,  'index']);
```

## Controllers

1. **Приклад базового контролеру**

- Якихось певних потреб до іменування контролерів немає. Лише те, що вони мають бути в **однині**
- Всі контролери, повинні наслідуватись від `lara.go.loc/app/Http/Controllers/Controller.php`
- `Action` - в номенклатурі фреймворків, це `методи класів`. Всі `action` мають бути публічні
- Ну і приклад самого простого контролера, який виконає запуск визначеної сторінки
```php
// lara.go.loc/app/Http/Controllers/HomeController.php
class HomeController extends Controller
{
    public function index() : string
    {
        return "Home controller";
    }
}

// lara.go.loc/routes/web.php
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);
```

2. **Single Action Controllers** - контролери з однією дією
   - Простота і читабельність: Якщо тобі потрібен контролер для виконання лише однієї конкретної дії, Single Action Controller може зробити код більш зрозумілим і організованим.
   - Легке тестування: Оскільки такі контролери виконують лише одну дію, їх легше тестувати та підтримувати.
   - Зручність: Вони зручні для виконання невеликих задач, наприклад, відправки електронних листів, обробки форм, виконання редиректів тощо.
- Як створити командою: `php artisan make:controller SendEmailController --invokable`
- Приклад: 
```php
// lara.go.loc/app/Http/Controllers/InvocableController.php
class InvocableController
{
    public function __invoke ()
    {
        return "Return invoke action";
    }
}

// lara.go.loc/routes/web.php
Route::get('/invoke-page', \App\Http\Controllers\InvocableController::class);
```

3. Створення контролерів, за допомогою команди
- Для цього слід використовувати команду: `php artisan make:controller <ControllerName>`
- Якщо нам потрібно дізнатись додаткові команди для контролерів, то слід скористуватись командою: `php artisan make:controller -help`
  - Наприклад така команда як: `php artisan make:controller <ControllerName> --resource` - допоможе створити контролер зі всіма CRUD `actions`. ![Приклад](https://i.imgur.com/RdRHmgX.png)
- Щоб не лупити всі контролери в одну папку, то ми можемо їх створювати таким чином: `php artisan make:controller <dirName>/<ControllerName>`
- З цим ![посиланням](https://laravel.com/docs/11.x/controllers#shallow-nesting), ми можемо знайти, як будувати шляхи, для наших роутів в залежності від їх `actions`
- Приклад, створення контролеру, який відпрацює, на всі CRUD операції
```php
// lara.go.loc/app/Http/Controllers/Admin/PostController.php

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return 'Admin all posts action';
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return 'Admin CREATE post action';
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return 'Admin STORE post action';
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return "Admin SHOW post - {$id}";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return "Admin page. I want edit post with id - {$id}";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return "Admin page. I want UPDATE post with id - {$id}, when was i get with action EDIT";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return "Admin page. I want DELETE post with id - {$id}";
    }
}

// lara.go.loc/routes/web.php
Route::prefix('admin')->group(function(){
   Route::get('/posts', [PostController::class, 'index']);
   Route::get('/posts/create', [\App\Http\Controllers\Admin\PostController::class, 'create']);
   Route::post('/posts', [\App\Http\Controllers\Admin\PostController::class, 'store'])->withoutMiddleware
   (\App\Http\Middleware\VerifyCsrfToken::class);
   Route::get('/posts/{id_post}', [\App\Http\Controllers\Admin\PostController::class, 'show']);
   Route::get('/posts/{id_post}/edit', [\App\Http\Controllers\Admin\PostController::class, 'edit']);
   Route::put('/posts/{id_post}', [\App\Http\Controllers\Admin\PostController::class, 'update'])->withoutMiddleware
   (\App\Http\Middleware\VerifyCsrfToken::class);
   Route::delete('/posts/{id_post}', [\App\Http\Controllers\Admin\PostController::class, 'destroy'])->withoutMiddleware
   (\App\Http\Middleware\VerifyCsrfToken::class);
});
```

4. А також нашим роутам, слід вказувати метод `name` куди ми будемо передавати параметром посилання на нашу сторінку. Це буде корисно, для використання такого методу як `route(<path>)` в наших видах, щоб будувати лінки між сторінками
- Та ![приклад такого застосування](https://i.imgur.com/getjPa6.png)
```php
Route::prefix('admin')->group(function(){
    Route::get('/', function (){
        return 'Admin page';
    })->name('admin');

   Route::get('/posts', [\App\Http\Controllers\Admin\PostController::class, 'index'])->name('admin.posts.index');
   Route::get('/posts/create', [\App\Http\Controllers\Admin\PostController::class, 'create'])->name('admin.posts.create');

});
```
5. Ще ми можемо всі наші шляхи для CRUD, обєднати за допомогою одного методу `resource`. На прикладі нижче, ми отримаємо дуже короткий запис, аніж той що вище. Проте, тут є свої недоліки 
#### Переваги: 
- **Простота і зручність:** `Route::resource` автоматично створює всі необхідні маршрути для `CRUD (Create, Read, Update, Delete)` операцій, що знижує ймовірність помилок та економить час.
- **Конвенції:** Дотримання конвенцій робить код більш стандартизованим і зрозумілим для інших розробників, які знайомі з Laravel.
#### Недоліки:
- **Менша гнучкість:** Коли ти використовуєш Route::resource, у тебе менше контролю над кожним окремим маршрутом. Якщо тобі потрібно змінити назву або метод маршруту, тобі доведеться налаштовувати його окремо.
- **Часткове налаштування:** У деяких випадках ти можеш не потребувати всіх маршрутів CRUD. Наприклад, якщо тобі потрібно лише index і show, ти все одно отримаєш всі маршрути, що може призвести до неочікуваних помилок або проблем з безпекою, якщо не налаштувати їх правильно.
```php
Route::prefix('admin')->group(function(){
    Route::resource('posts', PostController::class);
});
```

- Але ми можемо вказувати і певні обмеження. Наприклад:
```php
Route::resource('posts', PostController::class)->only('index', 'create'); // запис застосує тільки actions index та create
Route::resource('posts', PostController::class)->except('index', 'create'); // запис застосує всі окрім actions index та create
```
## Views

1. Створити види можна в ручну, або за допомогою команди: `php artisan make:view <viewName>`, або якщо в папці, або папках `php artisan make:view <dirName>/<viewName>`
2. Зазвичай папка для видів, в який вони будуть зберігатись, повинна мати назву контролеру, це звісно не обовязково, але гарний тон, та зручість компонування. Тобто, якщо в нас контролер `ProductController`, то папка для видів, повинна мати назву `views/product`
3. Слід ще зважати на назву файлів, для самих видів. Тобто це я за те, що для кожного виду, ми маємо свої `actions` які створювали в контролерах, які відповідають кожнії з операцій `CRUD`. Тобто, якщо в нас в контролері будуть actions такі як: `index, create, edit`. То і види повинні мати назви: `index.blade.php, create.blade.php, edit.blade.php`. [Приклад](https://i.imgur.com/kEHlu7Q.png)
4. До видів ми можемо звертатись через фасад `View::make("<dirName/viewName>")`, або за допомогою функції хелпера `view("<dirName/viewName>")`. 
   ![Приклад](https://i.imgur.com/y6Z2mrT.png)
5. Як хелпер `view()` так і метод `make` фасаду `View`, можуть приймати аргументом масив з даними, які ми можемо передавати у вигляді пари `"Ключ" => "Значення"`. 
   ![Приклад](https://i.imgur.com/EMOTudU.png)
- Є ще один спосіб передавати значення, з використанням методу `with` і ця ціпочка з `with` може бути нескінечно великою
  ```php
   public function create()
   {
   return View::make("post/create")->with(['title' => 'Create post page'])->with(['name' => 'bob']);
   }
   ```
6. Тут знову повернемось до такого поняття як `іменування маршрутів`, для цього використовується такий метод як `name` і тут ми повинні вказувати параметром шлях, до нашої сторінки з `action`. А методом `route()` у шалоні `blade` вже викличемо наші маршрути
```php
Route::get('/post', [PostController::class, 'index'])->name('post.index');
Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
```

```html
<li><a href="{{ route('post.index') }}">Index page post</a></li>
<li><a href="{{ route('post.create') }}">Create page post</a></li>
```
7. Якщо раптом виникне потреба, передати дані у вид зі змінних, ми можемо скористуватись такою функцією як `compact()` тільки слід звернути як саме слід передвати ці змінні, тобто як строкове значення
    ![example](https://i.imgur.com/BL4PAiu.png)
8. Функція `abort()` - приймає аргументом код помилки, та буде повертати нам сторінку, звідповідною помилкою
    ![example](https://i.imgur.com/Yyn0yjh.png)
    
9.  Є таке поняття як `Sharing Data With All Views` - якщо коротко, то можемо розшарити дані, відразу для всіх виділ, тобто щоб змінні були доступні не більки в якомусь певному виді, а відразу для всіх. Щоб це зробити слід піти у файл `app/Providers/AppServiceProvider.php` та в методі `boot()` використати метод `share` і в прикладі нижче, змінна буде достпна у всіх видах `site_title`
    ![example](https://i.imgur.com/CAthnyM.png)

### View Composers

View Composers в Laravel дозволяють тобі підготувати дані для відображення у вигляді перед тим, як цей вигляд буде рендеритися. Це дуже зручно для організації коду, особливо коли тобі потрібно передати однакові дані до багатьох виглядів або частин виглядів.

### Навіщо вони потрібні?

1. **Повторне використання коду**: Замість того щоб писати одну і ту ж логіку в кожному контролері для передачі певних даних у вигляд, ти можеш використати View Composer, щоб один раз визначити ці дані і автоматично передавати їх у всі потрібні вигляди.

2. **Чистота контролерів**: Вони дозволяють зменшити кількість коду в контролерах, що робить код більш організованим і чистим. Контролери займаються тільки логікою бізнесу, а не підготовкою даних для відображення.

3. **Глобальні дані**: Якщо є певні дані, які потрібні на всіх сторінках (наприклад, меню, налаштування сайту), View Composer дозволяє автоматично передавати ці дані у всі вигляди без необхідності робити це вручну кожного разу.

### Як це працює?

- Уяви, що ти хочеш показати на кожній сторінці категорії товарів. Замість того щоб викликати їх у кожному контролері, ти можеш створити View Composer, який підготує ці категорії один раз і передасть їх у всі вигляди, де вони потрібні.

### Приклад:

```php
View::composer('*', function ($view) {
    $categories = Category::all();
    $view->with('categories', $categories);
});
```

Цей код автоматично додає змінну `categories` у всі вигляди, і тобі не потрібно робити це вручну кожного разу.

### Приклади

1. Створимо перший композер, для шерінгу даних `app/Views/Composers/TestComposer.php` [example](https://i.imgur.com/1N7lhzq.png)
2. Потім, ці дані мовинні, через файл `app/Providers/AppServiceProvider.php` передаватись на вьюшки. На Вьюшку, вони мають будти передані з методу composer(), де ми можемо зірочкою вказати, що ці дані будуть предані на всі види, або вказати кожену вьюшку почергово, та також слід обовязково вказати, з якого композера буде шерінг даних [example](https://i.imgur.com/mbbDCv3.png)
3. Або ще один спосіб, шарити дані за допомогою `View Composers`, але з використанням хелперв `view`, та на прикладі можна побачити, що будемо шарити дна зі змінної `data`, у види **home, та create** ![example](https://i.imgur.com/pRECVmW.png)

4. Прикладмабуть несамого кращого виокристання View Composer, це передавати менешкю тачим чином у всі потрібні нам види [example](https://i.imgur.com/z759T6f.png)
5. Це в шаблонізаторі Blade, є такий прикол, що він екранує HTML, щоб цього не було, одним зі способім є те, що можна використати, такий синтаксис {!! $menu !!}, як [тут](https://i.imgur.com/0kRXiqW.png)

## Blade

Привіт! Blade — це шаблонний двигун, який використовується в Laravel для створення динамічних HTML-сторінок. Він забезпечує зручний спосіб включення логіки в шаблони, дозволяючи розробникам легко створювати гнучкі й багаторазові компоненти інтерфейсу користувача.

### Основні особливості Blade:

1. **Розширення `.blade.php`**: Всі файли шаблонів Blade мають розширення `.blade.php`. Наприклад, `welcome.blade.php`.

2. **Вставка змінних**:
   - Щоб відобразити значення змінної у шаблоні, використовуються подвійні фігурні дужки `{{ }}`.
   - Blade автоматично екранує будь-який вивід, що запобігає XSS-атакам.

   ```php
   <h1>{{ $title }}</h1>
   ```

3. **Розширення шаблонів (Layout)**:
   - Blade дозволяє створювати базові шаблони, які можуть бути розширені іншими шаблонами.

   Базовий шаблон (`layouts/app.blade.php`):
   ```php
   <!DOCTYPE html>
   <html lang="en">
   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>@yield('title')</title>
   </head>
   <body>
       @yield('content')
   </body>
   </html>
   ```

   Шаблон, що розширює базовий шаблон:
   ```php
   @extends('layouts.app')

   @section('title', 'Welcome Page')

   @section('content')
       <h1>Welcome to Laravel</h1>
   @endsection
   ```

4. **Умовні конструкції**:
   - Blade підтримує стандартні умовні конструкції `if`, `elseif`, `else`, а також спеціальну конструкцію `@unless`.

   ```php
   @if ($user->isAdmin())
       <p>Welcome, Admin!</p>
   @else
       <p>Welcome, User!</p>
   @endif
   ```

5. **Цикли**:
   - Blade підтримує всі стандартні цикли, такі як `for`, `foreach`, `while`, `forelse`.

   ```php
   @foreach ($users as $user)
       <p>{{ $user->name }}</p>
   @endforeach
   ```

6. **Включення інших шаблонів**:
   - Ви можете включати інші шаблони в свій шаблон за допомогою директиви `@include`.

   ```php
   @include('partials.header')
   ```

7. **Компоненти та слоти**:
   - Blade дозволяє створювати компоненти для повторного використання частин коду з використанням слотів.

   ```php
   <!-- components/alert.blade.php -->
   <div class="alert alert-{{ $type }}">
       {{ $slot }}
   </div>
   ```

   Використання компоненту:
   ```php
   @component('components.alert', ['type' => 'danger'])
       This is an error message.
   @endcomponent
   ```

8. **Швидка вставка PHP**:
   - Якщо потрібно виконати трохи PHP-коду, можна використати директиву `@php` або старий добрий спосіб відкриття PHP-тега.

   ```php
   @php
       $value = 1 + 1;
   @endphp
   ```

9. **Коментарі**:
   - Коментарі у Blade можуть бути додані за допомогою `{{-- коментар --}}`. Вони не будуть відображені в згенерованому HTML.

   ```php
   {{-- Це коментар, який не буде виведений в HTML --}}
   ```

10. Щоб уникнути екранування HTML-коду в шаблонах Blade і дозволити відображення сирого HTML, можна використовувати подвійні фігурні дужки з додатковим знаком оклику `{!! !!}`. Цей синтаксис вказує Blade, що HTML-код всередині не повинен бути екранованим.

```php
{!! $htmlContent !!}
```

11. Так, у Blade можна використовувати методи всередині шаблону. Це дозволяє виконувати різні дії безпосередньо в шаблоні, такі як виклик методів моделей, функцій або обробка даних.

### Виклик методів у Blade:

- **Методи моделей або об'єктів**:
   Якщо у вас є об'єкт, ви можете викликати його методи прямо у шаблоні Blade.

   ```php
   <p>{{ $user->name }}</p>
   <p>{{ $user->getFullName() }}</p>
   ```

- **Глобальні функції PHP**:
   Можна використовувати стандартні PHP-функції.

   ```php
   <p>{{ strtoupper($string) }}</p>
   <p>{{ date('Y-m-d') }}</p>
   ```

-  **Користувацькі функції**:
   Якщо у вас є якась користувацька функція, ви також можете викликати її у шаблоні.

   ```php
   <p>{{ myCustomFunction($data) }}</p>
   ```

- **Ланцюжкові виклики**:
   Ви можете викликати методи по ланцюжку, якщо кожен метод повертає об'єкт, на якому викликається наступний метод.

   ```php
   <p>{{ $user->posts()->latest()->first()->title }}</p>
   ```

- **Обробка даних у шаблоні**:
   Ви можете робити просту обробку даних, наприклад, додавати значення або проводити інші операції.

   ```php
   <p>{{ $user->posts->count() + 5 }}</p>

12. У Blade можна легко інтегрувати JavaScript-бібліотеки так само, як і в звичайних HTML-документах. Laravel Blade не накладає жодних обмежень на використання JavaScript, тому ви можете додавати скрипти, підключати бібліотеки, і виконувати інші дії з JavaScript прямо в шаблонах.

### Основні способи використання JavaScript бібліотек у Blade:

- **Підключення JavaScript бібліотек через CDN**:
   Найпростіший спосіб підключити бібліотеку — це використати CDN (Content Delivery Network).

   ```blade
   <!DOCTYPE html>
   <html lang="en">
   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Document</title>
       <!-- Підключення jQuery з CDN -->
       <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   </head>
   <body>
       <h1>Hello, world!</h1>
       <script>
           $(document).ready(function() {
               alert('jQuery is working!');
           });
       </script>
   </body>
   </html>
   ```

- **Підключення JavaScript файлів з локального сховища**:
   Якщо у вас є власні JavaScript файли, ви можете підключати їх за допомогою `asset()` функції або використовуючи стандартний шлях до файлу.

   ```blade
   <!DOCTYPE html>
   <html lang="en">
   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Document</title>
       <!-- Підключення власного скрипта -->
       <script src="{{ asset('js/custom.js') }}"></script>
   </head>
   <body>
       <h1>Hello, world!</h1>
   </body>
   </html>
   ```

- **Вставка JavaScript коду безпосередньо у шаблон**:
   Ви також можете написати JavaScript прямо в шаблоні, що корисно для простих скриптів.

   ```blade
   <script>
       document.addEventListener('DOMContentLoaded', function() {
           console.log('Page is loaded');
       });
   </script>
   ```

- **Використання Blade директив для умовного додавання скриптів**:
   Blade дозволяє умовно додавати JavaScript код на основі певних умов. Це корисно, якщо ви хочете підключати скрипти тільки для певних сторінок або частин додатку.

   ```blade
   @if($user->isAdmin())
       <script>
           alert('Admin access granted');
       </script>
   @endif
   ```

- **Використання секцій та стеків**:
   Blade надає спеціальні директиви для роботи з секціями та стеком скриптів, що робить код більш організованим, особливо коли йдеться про великі проекти.

   **Секції**:
   ```blade
   @section('scripts')
       <script src="{{ asset('js/some-library.js') }}"></script>
   @endsection
   ```

   Використовуйте `@yield('scripts')` або `@stack('scripts')` в основному шаблоні для вставки скриптів:

   ```blade
   <head>
       <title>My Laravel App</title>
       @yield('scripts')
   </head>
   ```

   **Стек**:
   ```blade
   @push('scripts')
       <script src="{{ asset('js/additional-library.js') }}"></script>
   @endpush
   ```

   І знову використовуйте `@stack('scripts')` для відображення всіх підключених скриптів у певній частині шаблону:

   ```blade
   <body>
       <h1>Page Content</h1>
       @stack('scripts')
   </body>
   ```

У Blade є директива `@verbatim`, яка дозволяє писати блоки коду без обробки Blade-шаблонізатором. Це особливо корисно, коли ви працюєте з JavaScript-фреймворками, які використовують схожий синтаксис з подвійними фігурними дужками (наприклад, Vue.js).

### Як працює директива `@verbatim`:

Все, що знаходиться між директивами `@verbatim` та `@endverbatim`, буде ігноруватися Blade і залишатиметься у сирому вигляді в кінцевому HTML.

### Приклад використання:

```blade
@verbatim
    <div id="app">
        <p>{{ message }}</p>
    </div>

    <script>
        new Vue({
            el: '#app',
            data: {
                message: 'Hello Vue!'
            }
        });
    </script>
@endverbatim
```

У цьому прикладі Blade не буде намагатися інтерпретувати `{{ message }}`, і Vue.js зможе нормально працювати з цим синтаксисом.


## Використання шаблонів Blade

### Виведення сторінок зв допоогою шаблонізатора
1. Спочатку ми створимо шаблон, або як говорили в курсі "фоторамку", яка і буде тими частинами, які внас будуть статичними. В моєму випадку, та частина яка буде статичною, я для неї створив окремий файл `resources/views/layouts/main.blade.php`
[example](https://i.imgur.com/5YZ3nyv.png)
2. Далі, почнемо з файлу `resources/views/home/index.blade.php`. В ньому ми маємо спочатку показати, який будемо наслідувати шаблон, для цього використовуємо диревктиву `@extends()` куди параметром, передаємо файл який будемо наслідувати 
3. Потім ми маємо таку директиву як `@section()` в яку параметром, ми маємо вказати назву цієї секції і ця секція, має бути обовязково закрита `@endsection`
[example](https://i.imgur.com/0lyH6SR.png)
4. І далі, коли в нас буде створена секція, ми маємо піти в наш шаблон `resources/views/layouts/main.blade.php` і там за допомогою директиви `@yeld` вказати, на якому місці, має бути наша секція
[example](https://i.imgur.com/ipUdRuG.png)

### Виведення змінних за допоогою директиви `@yeild()`

1. Тут все досить просто, просто в директиву `@yeild()` передаємо параметр з назвою нашої змінної, також можна передати і другий параметр, який буде підтвлений, якщо немає змінної вказаної нами, або її значення відсутнє

- Але зновуж таки, з файлу, з якого ми передаємо нашу змінну, повинен мати, визначену секцію, щоб потім преедати змінну в директиву `@yeild`: [example](https://i.imgur.com/MOAZfjl.png)
- Ну і потім ми її передаємо у наш шаблон: [example](https://i.imgur.com/aNdGw8q.png)

2. Може бути і так, що нам потрібно передати змінну з нашого контролера. То для цього, нам потрібно передавати дані у директиву `@section`: [example](https://i.imgur.com/ybLDQFp.png) Тут на прикладі, буде видно, як саме це має бути в синтаксісі, ну і контролер, з якого передаватимуться дані

### директива `@isset()`

- `@isset()` - аргументом приймає змінну, яку слід перевірити, чи уснує вона, якщо існує, то виведе її значення: [example](https://i.imgur.com/4UAB1IZ.png)

### Обмеження перегляду секцій

- На прикладі `navbar` ми можесмо зробити так, щоб обмежувати перегляд секцій. Для цього, можемо в самому шаблоні `resources/views/layouts/main.blade.php`, наш `navbar` помістити в секці. Таким чином, як на прикладі: [example](https://i.imgur.com/xJYigrj.png), ми обмежуємо перегляд цієї секції, для всих виділ які наслідують шаблон

- Увімкнути відображення, можна увімкнувши в директиви `@section()` таку директиву як `show`: [example](https://i.imgur.com/dA3UiXI.png)

- В якщо нам треба, в якомусь конкретному виді, вимкнути цей наш `navbar`, то тут вже:
    - Спочатку в шаблоні `navbar` заключаємо в секцію, встановлюємо до директиви `@section()` таку директиву як `show`
    - Потім ідемо у вид в якому хочемо вимкнути відображення цієї секції. І створюємо секцію, з тією ж назвою, з якою створили її в шаблоні, але лишаємо пустою: [example](https://i.imgur.com/llSuzzB.png). І все, нашого `navbar` у виді, для якого ми це зробили, видно не буде

    - А якщо раптом потрібно його увімнктути, то слід використати директиву `@parent` що дозволить наслідувати цей `navbar` з шаблону [example](https://i.imgur.com/PTrG4Zd.png)

### Директива `@include()`

- Вона дозволяє, включати певні частини видів в шаблон, або на сторінку
- Такі частити, зазвичай, зберігаються в окремій папці, в моєму випадку поміщу їх у папку `resources/views/layouts/components/footer.blade.php`: [example](https://i.imgur.com/AXuSFsY.png)
- А далі, директивою `@include()` - можемо визвати цю частину в нашому шаблонові: ![examp](https://i.imgur.com/ooz2Aix.png)
- Якщо в нас є потреба передавати дані в цю частину. То тут слід передавати:
    - Або з контролера, який відноситьсядо цієї частини
    - Або можна передати другим параметром, з директиви `@include()`: ![examp](https://i.imgur.com/6EtcHG7.png)

## Директиви Blade

1. Почнемо цю тему з того, що ми з зовнішнього джерела, підключено масив юзерів. Для цього, скористуємось сайтом "JSONPlaceholder" з якого візьмемо, [масив юзерів](https://jsonplaceholder.typicode.com/users)
2. Отримати юзерів, можна функцією: `file_get_content()`, а функцією `json_decode()` - ми перетворимо отримані дані в масив: [examp](https://i.imgur.com/5XUx2LO.png)
3. Також, отримати JSON файл, можна і за допомогою фасаду `Http::get("https://jsonplaceholder.typicode.com/users")->json();`: [examp](https://i.imgur.com/9PY11T9.png)
4. І далі передаємо дані у функцію `compact()` - щоб потім отримати, та вивести ці дані з потрібної нам вьюшки

5. Після цього, ми можемо використати директиву `@foreach @endforeach` для виведення даних в розмітку: [examp](https://i.imgur.com/XCsncdY.png)
6. Якщо раптом нам треба зробити перерку на певну умову, це можна зробити за допомогою директиви `@if @endif`. Приклад, який допоможе нам вивести юзерів, в яких ID не є парним: [examp](https://i.imgur.com/h7HNW0M.png)

### Використання директиви @loop

1. Більше детально, які саме є методи директиви @loop можна ознайомитись в [документації](https://laravel.com/docs/11.x/blade#the-loop-variable)
![loop](https://i.imgur.com/YOa4Qlb.png)
2. Але якщо в загальному, то ця директива, буде виводити число ітерації циклу 
Приклад, як вивести перший, та останій елементи:
![examp](https://i.imgur.com/R3s2cOJ.png)

### Директива @class

1. Ця директива, допомагає, гнучко працювати з класами тегів. Більше [тут](https://laravel.com/docs/11.x/blade#conditional-classes)
2. Відразу приклад, взаємодії директиви @loop та @class 
Приклад: Зробимо так, щоб парні були зеленого кольору, а не парні червоного
![examp](https://i.imgur.com/HNw6vgV.png)


## Збірка проекту Vite

- Перед цією темою, хочу додати, що в Laravel, підключати стилі, або скрипти, можна за допомогою методу `asset()`. Цей метод відразу буде нас вести у папку `public`, тобто в корінь проекту [examp](https://i.imgur.com/wVam2W3.png)
- І якщо ми подивимось код нашої сторінки, ми побачимо коректний шлях до нашого файлу: [examp](https://i.imgur.com/cHyIafB.png)
- Таким самим чином, можна підключати стилі і скрипти `bootstrap`, якщо вони знаходяться в нашому проекті локально [examp](https://i.imgur.com/bK112Ot.png). І якщо ми підемо в браузер, то зможемо побачити, що ці файли підєднались, локально: [examp](https://i.imgur.com/NsFZDUr.png)

> Як завжди, більше інформації, можна отримати в [документації](https://laravel.com/docs/11.x/vite#main-content)
 
> Починаючи з Laravel 9, Vite використовується як інструмент для збірки фронтенд-ресурсів замість попереднього інструменту Laravel Mix. 
> Vite забезпечує швидшу збірку та покращений досвід розробки завдяки вбудованому HMR (Hot Module Replacement).

### Підключення і збірка проекту, за допомогою Vite

1. Всі ресурси, мають знаходитись в папці `resources`, і вже потім коли ми будемо білдити проект, дані будуть переноситись в нашу точку входу, тобто в папку `public`: [examp](https://i.imgur.com/IYQ11JZ.png)
2. Потрібно перевірити, щоб була встановлена остання, або стабільна віерсія Node. Версію, можна перевірити командою: `node -v`
   - Якщо раптом буде потреба, щоб її оновити, для цього є команда: `nvm install <node version>`
   - Щоб застосувати оновлену версію: `nvm use <node version>`
   - Або ящо немає Node, її можна скачати [тут](https://nodejs.org/en/)
    > І це слід робити не в консолі OpenServer, а наприклад в PowerShell, до в оперсервера, там свій простір, яка не підійд для Node
   - Останнім пунктом підготовки буде те, щоб запустити установку пакетів, які у нас вказані у файлі `package.json`, це можна зробити командою: `npm install`: [examp](https://i.imgur.com/f2ubEET.png)
3. Далі ідемо у файлик `vite.config.js` і там у влативість `input` передаємо наші файлики, які повинні публікуватись у папку `public`: [examp](https://i.imgur.com/JnWlREr.png)
4. Потім, за допомогою директиви `@vite()` нам потрібно зробити підключення в нашому шаблоні `resources/views/layouts/main.blade.php`: [examp](https://i.imgur.com/U3lZZ5i.png)
5. Після того, як ми зробили ці налаштування, нам потрібно запустити зборку проекту. Для цього є дві команди:
   - `npm run build` - це зробить нам, мініфіковану збірку, для продакшина. Та ми побачимо, що в папці `public` створиться папка `build` куди будуть перенесені ті дані, які ми вносили у файлі `vite.config.js` та `resources/views/layouts/main.blade.php`
   - `npm run dev` - це зробить нам, збірку проекту, запустить віртуальний Node сервер, який буде слідкувати за змінами на боці Frontend-у, та відразу вносити зміни на фронт частині
   > Якщо ми зробили налаштування, але не запустили збірку проекту, то отримаємо помилку `Vite manifest not found`, тому не забуваємо запустити
6. Момент з застосуванням картинок, для наших стилів, або взагалі файлів. Якщо ми маємо збирати файли, через зборщик Vite, то нам слід такі файли, помістити у папку `resources` і коли будемо вказувати шляхи, вони не мають бути абсолютними, а повинні бути відносними
Приклад, з урахуванням `відносних шляхів`: [examp](https://i.imgur.com/KMDSPBG.png)

### Абсолютний шлях:
- **Опис**: Абсолютний шлях вказує на конкретне місцезнаходження файлу чи папки, починаючи з кореневої директорії файлової системи або домену на вебсайті.
- **Приклад у файловій системі**: `/var/www/html/index.html` (вказує на файл `index.html`, починаючи з кореневої директорії `/`).
- **Приклад у вебсайті**: `https://example.com/images/logo.png` (вказує на ресурс на вебсайті, починаючи з протоколу `https://` і домену `example.com`).

### Відносний шлях:
- **Опис**: Відносний шлях вказує на місцезнаходження файлу чи папки відносно поточної директорії або сторінки. Він не починається з кореня, а залежить від місця, де ви зараз знаходитесь.
- **Приклад у файловій системі**: `images/logo.png` (вказує на файл `logo.png`, який знаходиться у папці `images` відносно поточної директорії).
- **Приклад у вебсайті**: `../styles/main.css` (вказує на файл `main.css`, який знаходиться в директорії на рівень вище від поточної сторінки).

### Основні відмінності:
- **Абсолютний шлях** завжди однаковий незалежно від того, де ви знаходитесь в системі чи на сайті.
- **Відносний шлях** залежить від поточного місцезнаходження, і може змінюватися залежно від того, з якої директорії або сторінки ви починаєте.

Приклад, з урахуванням `відносних шляхів`: [examp](https://i.imgur.com/KMDSPBG.png)

## Міграції

> Спочатку пройдемось по нашому проекту. А нижче будуть вже теоретичні знання по міграціям

1. Спочатку слід налаштувати зєднання з базою даних. Як у самому файлі .env так і створити зєднання в самій СУБД. Так як в мене це локальна база даних через OpenServe, то тут наче не складно:
   - Спочатку перевіряємо щоб був запущений потрібний нам модуль БД: [examp](https://i.imgur.com/6MqRnS3.png)
   - Потім створюємо потрібну нам БД, у моєму випадку: [examp](https://i.imgur.com/25Iu35T.png)
   - Потім у файлику `.env` вказуємо нашу БД і хост для нашого зєднання: [examp](https://i.imgur.com/mm01DPu.png)
2. Після цього, пробуємо запустити нашу міграцію, командою: `php artisan migrate`:
   - Ця команда запустить базові міграції, які вже є у файлі `database/migrations`
   - Якщо все ок, то ми побачимо, успішний статус запуску міграцій: [examp](https://i.imgur.com/3kw1Rnu.png)
   - Ну і в самій БД, ми побачимо, створені таблиці: [examp](https://i.imgur.com/JPGJdN8.png)
3. Далі, щодо міграцій, які створені, ми будемо бачити таку таблицю, як `migrations`:
   - В цій таблиці, ми будемо бачити які були запущені міграції 
   - Й таку колонку як `batch`. Це поле, буде вказувати на номер партії, це мається на увазі, ми будемо бачити, які саме міграції, були запущені останіми і вже від цього значення, відбуватись `rollback` тобто від останього номеру партії
4. Якщо раптом, ми захочемо відкотити міграцію, використовуємо команду: `php artisan migrate:rollback`
5. Тепер спробуємо створити свій файл, для міграції. Це робиться командою: `php artisan make:migration create_users_table`
6. Потім у файлі, який ми створили: `database/migrations/create_users_table`, ми можемо побачити два методи:
   - `up()` - метод, в якому ми будемо створювати структуру, для створення нашої таблиці при виконанні міграції
   - `down()` - це вже готовий метод, яки відповідатиме, за відкат міграції 
7. В методі `up()` - ми можемо відразу побачити два базові методи `$table->id()` and `$table->timestamp()`
   - `id()` - відноситься до типу даних bigInteger - `8байт`, діапазон значень `От −9 223 372 036 854 775 808 до 9 223 372 036 854 775 807`, довжина до 20 символів, та за рахунок того, що діапазон беззнаковий, то можна вписувати дані в два рази більше 
   - а от метод `timestamp()`, він виконає [дві команди](https://i.imgur.com/kPMknaB.png): 
     - `create_at` - час створення
     - `updated_at` - час оновлення 
8. Окрім значення `$table->id()` ми можемо використати `$table->increments()` - цей метод, також буде відповідати за те, щоб поле була типу 'Primary Key', та також було 'AUTO INCREMENT', але місця буде займати на `4байт` і довжина його буде `10`: [приклад](https://i.imgur.com/Ax5WCmk.png)
9. Також, слід звенути увагу на такі методи як:
   - `unsigned()` - метод, який вкаже на те, щоб не було значення мінусовим 
   - `unique()` - робить значення в базі унікальним 
   - `nullable()` - цей метод, дозволить робити значення поля таким, щоб воно могло бути рівним `NULL` 
   - `useCurrent()` - цей метод, дозволить вставляти текущу дату сервера, при оновленні цього поля
   - `useCurrentOnUpdate` - він слугує вже саме для оновлення і працює у звязці з `useCurrent()`: [examp](https://i.imgur.com/QTEZhje.png)
10. Якщо нам потрібно відкотити і накатити міграцію, то слід використати команд: `php artisan migrate:refresh`: [приклад](https://i.imgur.com/YrRsbU8.png)

### Попрактикуємось

1. Створимо два файли міграції `categories` and `posts`: `php artisat make:migration create_categories_table`, `php artisat make:migration create_posts_table`: [examp](https://i.imgur.com/yMZbmXY.png)
2. Заповнимо файли, деякими даними, які будуть створені в таблиці: [examp]()
    - Тут ще хочу звернути увагну на такий цікавий момент, як тип даних, який є у Laravel, це `boolean()` - такого типу даних в загалом, в SQL немає, але в Laravel, в це поле, можна збергіати два значення `0 або 1`: [examp](https://i.imgur.com/GN1Qkqk.png)
3. Після того, як ми запустили, створення таблиць в базі: `php artisan migrate` - ми помітили, що в нас в `categories` немає `slug` і тому, нам доведеться зробити певні модифікації в цій таблиці. І тут є декілька варіантів:
   - Це відкатити міграцію, редагувати файлик з міграцією яка створює цю табличку
   - Це зробити спеціальну міграцію, яка буде модифіковувати таблицю.
### Модифікації в таблиці

1. Як це робити:
 - Створюємо новий файл і він повинен бути в форматі: `php artisan make:migration add_<що додаємо>_to_categories_table`, в нашому випадку, слід додати `slug`, тому це буде так `php artisan make:migration add_slug_field_to_categories_table`
 - І тут слід звернути увагу, то буде створено новий файл, але з методом, який буде редагувати існуючу таблицю: [examp](https://i.imgur.com/D5UIfs1.png)
 - Також, ми можемо вказати, куди саме ми хочемо додати нове поле, бо по замовчуванню, поле буде додано в кінець, у нашому випадку, вми хочемо щоб було додано після поля `title`. Тому використовуємо метод `after()`: [examp](https://i.imgur.com/OxJSFs6.png)
 - А ще у такому випадку, тобто у випадку модицікації, наш метод `down()` який відповідає за відкат таблиці буде пустий, тому йому слід вказати, що саме буде відкочено, у випадку команд `rollback`. І на прикладі, можна побачити, що ми вкажемо це так, що відкат буде тільки однієї вастивості `slug`, проте, якщо властивостей буде більше, ми зможмо в масиві перелічити всі поля, для відкату: [examp](https://i.imgur.com/T4GZ8o5.png)
 - І запускаємо міграцію. Та після цього ми побачимо в таблиці `migration` запущену міграцію для модицікації: [examp](https://i.imgur.com/PjIpwVC.png), а у таблиці `categories` додане поле `slug`: [examp](https://i.imgur.com/KJBv3cW.png)
2. Як внести зміни в таблиці:
 - Тут слід використати іншу команду: `php artisan make:migration alter_field_username_to_user_table` - тобто тут вкажемо, що будемо вносити правки в таблиці `users`, в полі `name` - але знову таки, в поле `name` взагалі вказувати не обовязково
 - І тут обов'язково слід використати метод `change()`, бо в іншому випадку Laravel, буде намагатись цю колонку створити, а не змінити її параметри: [examp](https://i.imgur.com/P1xcrpC.png),але так як вона створена, то просто отримаємо помилку
 - А як будемо робити відкат, тут слід вказати значення поля, або полів, до того, як ми в нього внесемо зміни: [examp](https://i.imgur.com/EonGCC6.png)

### Звязок між таблицями

1. Попрактикуємось на нашому прикладі, щоб звязати таблицю `categories` з таблицею `posts`
2. Першим, що слід зробити, це додати `FOREIGN KEY` в таблицю `posts`. Але перед тим як це зробити, потрібно щоб ключ в таблиці `categories` та `FOREIGN KEY` в таблиці `posts` були одного типу даних
    - Тут краще поглянути спочатку на [приклад](https://i.imgur.com/6MeH16Q.png) - тут спочатку видно, що ми створюємо поле `category_id`, того самого типу даних що і для ID таблиці categories, а вже потім ми встановлюємо звязок, цього поля з таблицею `category`
    - А в методі down() - ми повинні спочатку відвязати звязок вторинного ключа, від поля `category_id` і потім вже видалити колонку `category_id`
    - І вже можна запускатиміграцію, щоб побачити, ось такий [результат](https://i.imgur.com/loOi8Mt.png) 
3. Це звязок, між таблицями забезпечує цілісність даних. До прикладу, якщо ми спробуємо Створити [пару категорій](https://i.imgur.com/QSaDnK3.png), та пробую наприклад в цей же час, додати категорію в пост таблички `posts`, то мені дозволить обрати, тільки [існуючі категорії](https://i.imgur.com/MQ6hTcd.png), але не створити нову
4. Проте, при налаштуванні такого звязку, за замовчуванням, ми не будемо мати доступ до редагування, вторинного ключа при [update або delete](https://i.imgur.com/TyLxCwC.png). Тому, тут потрібно буде вказати відповідні для того методи. Але вказувати ми їх будемо в новоствореній міграції, хоча краще це все робити в момент проектування бази, щоб робити як можна меньше правок
   - Створими спочатку відповідну міграцію, щоб розширити наш `FOREIGN KEY`
   - Потім, в методі `up()` - ми видаляємо звязок з `FOREIGN KEY` і відразу створюємо новий звязок, але додаємо метод `cascadeOnUpdate()` - це дозволить нам, надати досутуп, для оновлення вторинного ключа методом `UPDATE`
   - Ну а в `down()` просто повертаємо на поперені значення полів 
   - [example](https://i.imgur.com/ngRQ2WP.png). Та отримаємо такий результат, з дозволом на редагування: [examp](https://i.imgur.com/bw5Pkd6.png)

Міграції в Laravel — це потужний інструмент, який допомагає керувати базою даних у проекті, створюючи й змінюючи її структуру за допомогою PHP-коду. Вони дозволяють легко версійно контролювати схему бази даних і ділитися змінами з іншими розробниками.

### Основні моменти про міграції в Laravel:

1. **Що таке міграції?**
    - Міграції — це своєрідний контроль версій для бази даних. Вони дозволяють описувати зміни в схемі бази даних у вигляді класів PHP, які потім можна застосувати до бази даних за допомогою команд Artisan.
    - Вони зберігаються у папці `database/migrations`.

2. **Створення міграцій:**
    - Для створення міграції використовується команда Artisan:
      ```bash
      php artisan make:migration create_users_table
      ```
    - Ця команда створює новий файл у папці `database/migrations` з унікальною позначкою часу в імені файлу.
    - Таблички в базі, при створенні їх з міграції, слід називати в множині
    - За конвенціями, таблиці, слід називати починаючи зі слова `create` і закінчувати словом `table` а між цими словами, має бути назва самої таблиці. Приклад: `create_users_table`, `create_categories_table`, `create_countries_table`
    - 

3. **Структура міграції:**
    - Кожна міграція складається з двох основних методів:
        - `up()`: Використовується для визначення змін, які потрібно застосувати до бази даних (наприклад, створення таблиці або додавання колонок).
        - `down()`: Використовується для відкату змін, зроблених у методі `up()` (наприклад, видалення таблиці або колонок).

      Приклад:
      ```php
      public function up()
      {
          Schema::create('users', function (Blueprint $table) {
              $table->id();
              $table->string('name');
              $table->string('email')->unique();
              $table->timestamps();
          });
      }
 
      public function down()
      {
          Schema::dropIfExists('users');
      }
      ```

4. **Виконання міграцій:**
    - Щоб застосувати міграції до бази даних, використовується команда:
      ```bash
      php artisan migrate
      ```
    - Ця команда виконає всі міграції, які ще не були застосовані.

5. **Откат міграцій:**
    - Якщо потрібно скасувати останню або кілька міграцій, можна використати команду:
      ```bash
      php artisan migrate:rollback
      ```
    - Для скасування всіх міграцій можна використати:
      ```bash
      php artisan migrate:reset
      ```

6. **Міграції з налаштуваннями:**
    - Можна створити міграцію з параметрами, як, наприклад, створення таблиці:
      ```bash
      php artisan make:migration create_posts_table --create=posts
      ```
    - Це автоматично створить метод `up()` із заготовкою для створення таблиці `posts`.

7. **Seeders та міграції:**
    - Seeders використовуються для заповнення таблиць даними після виконання міграцій. Наприклад, ви можете створити базові дані для таблиць після їх створення.

8. **Мігрування бази даних у тестовому середовищі:**
    - Під час тестування або розробки можна використовувати команду `migrate:fresh`, яка видаляє всі таблиці та виконує всі міграції з нуля:
      ```bash
      php artisan migrate:fresh
      ```

9. **Переносна база даних:**
    - Використовуючи міграції, ви можете легко відновити структуру бази даних на новому середовищі або поділитися схемою з іншими розробниками.

10. **Міграції та контроль версій:**
    - Міграції допомагають організовувати роботу з базою даних у команді, де кожен розробник може додавати свої зміни до схеми бази даних, а потім застосовувати ці зміни на своєму середовищі.

### Ключові команди для роботи з міграціями:

- **Створення міграції:**
  ```bash
  php artisan make:migration name_of_migration
  ```

- **Запуск міграцій:**
  ```bash
  php artisan migrate
  ```

- **Відкат міграцій:**
  ```bash
  php artisan migrate:rollback
  ```

- **Оновлення схеми бази даних з нуля:**
  ```bash
  php artisan migrate:fresh
  ```

### Основні типи даних у міграціях Laravel
> Більше інформації в [документації](https://laravel.com/docs/11.x/migrations#available-column-types) 

1. **Цілі числа та інші числові типи:**
    - `increments()`: Автоматично зростаюче поле (звичайно використовується для первинних ключів). Створює стовпець `UNSIGNED INT`.
    - `integer('column')`: Ціле число (`INT`).
    - `bigIncrements()`: Велике автоматично зростаюче поле (звичайно використовується для первинних ключів). Створює стовпець `UNSIGNED BIGINT`.
    - `bigInteger('column')`: Велике ціле число (`BIGINT`).
    - `tinyInteger('column')`: Маленьке ціле число (`TINYINT`).
    - `smallInteger('column')`: Маленьке ціле число (`SMALLINT`).
    - `mediumInteger('column')`: Середнє ціле число (`MEDIUMINT`).
    - `unsignedInteger('column')`: Беззнакове ціле число.
    - `decimal('column', $precision, $scale)`: Число з фіксованою точністю (`DECIMAL`). Наприклад, `decimal('amount', 8, 2)` створить число з 8 цифрами, з яких 2 після коми.

2. **Рядкові типи:**
    - `string('column', $length)`: Рядок з обмеженою кількістю символів (за замовчуванням 255).
    - `char('column', $length)`: Фіксована кількість символів.
    - `text('column')`: Текстове поле (`TEXT`).
    - `mediumText('column')`: Текстове поле середнього розміру (`MEDIUMTEXT`).
    - `longText('column')`: Текстове поле великого розміру (`LONGTEXT`).

3. **Дати та час:**
    - `date('column')`: Дата (`DATE`).
    - `dateTime('column', $precision = 0)`: Дата та час (`DATETIME`).
    - `time('column', $precision = 0)`: Час (`TIME`).
    - `timestamp('column', $precision = 0)`: Мітка часу (`TIMESTAMP`).
    - `softDeletes()`: Додає стовпець `deleted_at` для м'якого видалення записів (`TIMESTAMP`).
    - `year('column')`: Рік (`YEAR`).

4. **Булеві типи:**
    - `boolean('column')`: Булевий тип (`BOOLEAN`).

5. **Типи для зберігання IP-адрес та JSON:**
    - `ipAddress('column')`: IP-адреса (`VARCHAR`).
    - `json('column')`: JSON (`JSON`).
    - `jsonb('column')`: JSONB (`JSONB` — оптимізований для PostgreSQL).

6. **Бінарні типи:**
    - `binary('column')`: Бінарні дані (`BLOB`).

7. **Перерахування (Enum):**
    - `enum('column', ['option1', 'option2'])`: Перерахування (`ENUM`).

8. **UUID:**
    - `uuid('column')`: Поле для зберігання UUID (`UUID`).

9. **Географічні типи:**
    - `point('column')`: Точка (координати).
    - `geometry('column')`: Геометрія.

### Приклади використання типів даних у міграціях:

```php
public function up()
{
    Schema::create('users', function (Blueprint $table) {
        $table->bigIncrements('id'); // Автоматично зростаючий первинний ключ
        $table->string('name', 100); // Рядок з максимальним розміром 100 символів
        $table->boolean('is_active')->default(true); // Булеве значення з дефолтним значенням true
        $table->decimal('balance', 8, 2); // Десяткове число, де 8 загальна кількість цифр, з яких 2 після коми
        $table->timestamps(); // Додає стовпці created_at та updated_at
    });
}
```

## Database

### Підключення до бази даних через фасад DB

1. Більше інформації, про цей спосіб, можна отримати за [посиланням](https://laravel.com/docs/11.x/database#running-queries)
2. Робимо отримання вибірки даних. Це слід робити наступним чином. Але не забуваємо імпортувати фасад DB: `$users = DB::select('select * from users');`
3. Також, тут слід враховувати, що використовується для отримання даних і повернення масиву цих даних через `stdClass`, це я до того, що значення властивостей слід викликати через стрілку. Ось як тут: [examp](https://i.imgur.com/oguiaVr.png)

### Запобігання SQL інєкціям

1. Для цього використовуються так звані `bindings`, тобто ми можемо в наших вибірках, вказати певні дані для пошуку, або вставки, але не вказувати їх на пряму в самому запиті. [Приклад тут](https://i.imgur.com/LodAvs4.png)
   - От на прикладі запиту вище, ми можемо побічити, як саме відбувається підставлення значень, тобто в самому запиті ми підсталяємо знаки питань "?", в вже другим аргуметом, передаємо `bindings`
2. Також, окрім такого варіанту, ми можемо використовувати `іменовані плейсхолдери`. [Ось як це виглядає](https://i.imgur.com/GrbAWw3.png)
3. Є ще один спосіб передавати `іменовані плейсхолдери`, це створити окремий масив, і туди вказати відповідні властивості з їх значеннями, які і будуть цими плейсхолдерами в запиті і сам масив передавати аргементом в `bindings`: [приклад](https://i.imgur.com/2pONNFy.png)

### Laravel debugbar

1. Назва говорить самка за себе - [документація](https://github.com/barryvdh/laravel-debugbar)
2. Установка: `composer require barryvdh/laravel-debugbar --dev`
3. Ідемо у файлик `.env` та первіряємо, щоб властивість `APP_DEBUG` була зі значенням `true`, бо `Laravel debugbar` працює тільки в режимі розробки 
4. І що він нам дає. Дає ось таку, [гарну панельку](https://i.imgur.com/OeXPPXG.png), де ми можемо мати доступ, до різного роду фінкціоналу. У нашому випадку, ми будемо дивитись, які виконуються запити в базу і з бази

### Вставка даних в таблицю

1. Це слід робити за допомогою метода `insert`, і будемо мати такий запис: `DB::insert('insert into users('user_name', 'age', 'phone') values('Kenny', 30, '+380665554433'));`.  [Приклад створення покупця](https://i.imgur.com/07EGKD4.png)
   - І до речі, повертає метод `insert` булеве значення `true або false`.

### Оновлення даних

1. Робимо це за допомогою методу `update`. При успішному виконанні запиту, буде кількість рядків в яких відбулись зміни
2. [Приклад запиту](https://i.imgur.com/XfLKWZ4.png)
3. А тут як раз, можна побачити, кількість змінених записів: [приклад](https://i.imgur.com/CQEWuLt.png)

### Видалення даних

1. Тут все досить просто, головне вказати, який саме ми хочемо видалити запис, щоб не видалити все 
2. Приклад: `DB::delete('delete from users where user_id=?', [15])`
3. Також повертає кількість [затронутих рядків](https://i.imgur.com/KJ9xEPH.png) в таблиці

### Виконання транзакції

> Транзакція в SQL — це набір операцій з базою даних, які виконуються як єдине ціле. Це означає, що всі операції всередині транзакції повинні бути виконані успішно, або жодна з них не повинна бути виконана. Якщо щось йде не так, всі зміни, зроблені під час транзакції, можуть бути скасовані, щоб база даних залишилася в консистентному стані.

1. Щоб нам виконати транзакцію в SQL, ми повинні використати відповідний метод: `transaction`
2. Щоб досягнути потрібного нам результату, ми спробуємо виконати два запити `insert` з однаковими даними.
   - Спочатку робимо БЕЗ `transaction`, [приклад](https://i.imgur.com/8vUrKDW.png) - тут буде виконано два запити, один з яких виконається, а другий поверну помилку, що намагаємось встати дублі номерів телефону. Але один запис все одно буде вставлено в базу, що в принципі не є допустимим при виконанні транзакції
   - Тепер, же повторимо цю операцію, але через `transaction`. Проте, транзакцію, слід використовувати в блоці `try catch`. [Приклад](https://i.imgur.com/ZMUdzuY.png)
   - Та при виконанні, ми побачимо, що транзакція, не була виконана, відбувся відкаж транзакції і ми отримали наш Exception: [Приклад](https://i.imgur.com/kJaROg3.png)
3. Також, транзакцію, можна запустити в ручну, для цього слід задіяти три методи:, які між собою працюють у звязці: [приклад](https://i.imgur.com/TwIzPu1.png). Резльтат, буде такий самий, як і з автоматичною транзакцією: [результат](https://i.imgur.com/CFNx1hK.png)
   - `DB::beginTransaction();` - стартує транзакцію
   - `DB::commit();` - фіксує дані цієї транзакції
   - `DB::rollBack();` - робить відкат, у випадку, неуспішної транзакції
   
## Query builder

Query Builder у Laravel — це потужний інструмент для створення та виконання SQL-запитів у вашій базі даних без необхідності писати сирий SQL-код. Він дозволяє будувати запити за допомогою простого і зручного синтаксису в PHP, а також підтримує різні бази даних, такі як MySQL, PostgreSQL, SQLite і SQL Server.

### Основні можливості Query Builder:

1. **Створення запитів:**
   Query Builder дозволяє створювати запити до бази даних за допомогою методів, що відповідають SQL-операціям. Наприклад, ви можете використовувати методи `select()`, `where()`, `join()`, `orderBy()`, `groupBy()`, тощо, для побудови запитів.

2. **Безпечність:**
   Використання Query Builder автоматично захищає ваші запити від SQL-ін'єкцій завдяки автоматичному ескейпу даних.

3. **Гнучкість:**
   Ви можете комбінувати методи для створення складних запитів без необхідності писати SQL-код вручну.

4. **Сумісність:**
   Query Builder працює з різними базами даних однаково, тому вам не потрібно змінювати код при зміні бази даних.

### Приклади застосування

1. `$users = DB::table('users')->get('*');` - команда, яка дасть нам отримати всі записи з таблиці `users`
2. `$users = DB::table('users')->get(['user_name', 'user_id', 'phone']);` - також, ми можемо казати конкретні колонки з яких хочемо отримати дані
> ПС: за допомогою встановленого модуля "Laravel debugbar", ми можемо побачити, що нам буде повертати Query Builder. [Приклад](https://i.imgur.com/HJhWUnm.png) - тобто на виході будуть запити, у звичайному для нас представленні
3. `$countries = DB::table('country')->first();` - цей запис, дозволить отримати перший елемент таблиці
4. `$countries = DB::table('city')->where('CountryCode',  '=', 'AFG')->get(['Name']);` - приклад використання запиту з оператором `WHERE`, який допоможе фільтирувати результат за вказаною умовою. Проте, слід звернути увагу, що спочатку ми вказуємо метод `where()` а вже після вказуємо метод `get()` з полями, за якими хочемо отримати вибірку
5. `$countries = DB::table('country')->orderBy('Population', 'desc')->get(['Name', 'Population']);` - приклад використання методу, для сортування `ORDER BY`
6. `$countries = DB::table('city')->find('22', ['name', 'CountryCode']);` - метод `find()` дозволяє шукати запис за його `ID`, але тут є нюанс, якщо в нас колонка буде називатись наприклад `user_id`, то такого резулаьтату не знайде, бо у методі `find()` строкго вказано назву колонки як`id`
7. `$countries = DB::table('city')->pluck('Name', 'CountryCode');` - досить зручний метод `pluck` якщо нам потрібноповернути дані, у вигляді асоціативного масиву, де одна колонка буде значенням, а інша його ключами. В прикладі, який я тут навів ключами буде колонка `CountryCode` а його значеннями `Name`. Проте, тут є такий нюанс, що ключі можуть бути тільки унікальними, тобто значення колонки `CountryCode` в таблиці можуть належати декільком значенням колонки `Name`, але результатом метод `pluck` поверне лише один його варіант, тому слід на це звернути увагу. Або, якщо не вказувати взагалі `key`, а цей ключ, це другий аргумент методу `pluck` - то ключами такого масиву, будеть слугувати порядкові номери, тобто від 0...n
8. `$cities = DB::table('city')->limit('10')->get('*');` - запит який допоможе отримати ліміт `LIMIT` полів для відображення виконаного запиту
9. `$cities = DB::table('city')->select('name', 'countrycode')->limit('10')->get();` - а це більш зрозумілий нам запит, який використовує метод `SELECT` де параметрами, ми можемо вказати назви колонок, за якими бажаємо отримати відповідь
10. `DB::table('city')->where('ID', '>=', 3)->where('ID', '<=', 10)->get(['id', 'name', 'countrycode']);` - а це вже запит, який дозволить нам, застосувати декілька умов `WHERE` для отримання потрібного нам результату/ [example](https://i.imgur.com/evP4rfP.png) в такій звязці використовується за замовчуванням логічне `AND`, щоб використовувати логічне `OR`, треба використовувати метод `orWhere`, приклад нижче
11. Ось такий довжилезний запит, з застосуванням логічного `OR`. [examp](https://i.imgur.com/8IjzFMR.png)
```php
DB::table('city')
->where('ID', '>=', 3)
->where('ID', '<=', 10)
->orWhere('ID', '>=', 20)
->where('ID', '<=', 40 )
->get(['id', 'name', 'countrycode']);
```
12. Щоб зменшити запис, та зробити його більш зрозумілим, ми можемо використати такий метод як `whereRaw` - сутьо в тому, що в тілі методу, ми можемо вказати потрібний нам SQL запит, та щей застосувати `bindings`, для запобігання SQL інєкціям. [examp](https://i.imgur.com/0IWglx6.png)
```php
    DB::table('city')
    ->whereRaw('(ID >= ? and ID <= ?) or (ID >= ? and ID <= ?)', [10, 20, 30, 40])
    ->get(['ID', 'Name']);
```

13. `DB::table('country')->whereIn('Continent', ['Asia', 'Europe'])->get(['Name', 'Continent']);` - Використання оператора `IN` який допоможе перевірити наявність у списку, за вказаними параметрами
14. `DB::table('country')->where('Name', 'like', 'A%a')->get();` - приклад використання оператора `LIKE` 
15. `DB::table('users')->whereDate('create_at', '>', '2024-08-01')->get();` - приклад використання фукції `date()` з SQL
16. Приклад використання оператора `INNER JOIN`, який обєдная дві таблички за повним співпадінням
    ```php
        $join = DB::table('city')
            ->join('country', 'city.CountryCode', '=', 'country.Code')
            ->select('country.Name as count_n', 'city.name as city_n', 'city.population')->limit(10)
            ->get();

        foreach ($join as $row) {
            echo $row->count_n . ' - ' . $row->city_n . ' - ' . $row->population . '<br>';
        }
    ```
17. Приклад використання оператора `LEFT JOIN`, який обєднує дві таблички
    ```php
    $leftJoin = DB::table('country')
    ->leftJoin('city', 'city.CountryCode', '=', 'country.Code')
    ->select('city.Name as city_n', 'country.Name as country_n', 'country.region as r', 'city.population as p')
    ->limit(20)
    ->get();
    ```
18. 

### Метод chunk()

> Метод chunk() в Laravel's Query Builder використовується для обробки великих наборів даних, розбиваючи їх на менші частини (чанки), які легше обробляти. Це дозволяє уникнути перевантаження пам'яті, коли ви працюєте з великою кількістю записів.
> Перед тим, як застосувати метод chunk, слід спочатку відсортувати дані за відповідною колонкою

- Приклад застосування: 
```mysql
        $countries = DB::table('city')->orderBy('id')->chunk(50, function (Collection $cities){
            foreach($cities as $city){
                // Щось робити з цими даними
            }   
        });
```

### Aggregates functions

- Приклади:
1. В цьому прикладі, ми застосовуємо агрегатну функцію `max()`, для отримання країни з найбільшою популяцією населення, а потім цей же результат застосуємо, щоб отримати дані про цю країну
   ```mysql
        $max_populations = DB::table('country')->max('population');
        $country = DB::table('country')->where('population', '=', $max_populations)->get();
    ```
2. `$count = DB::table('city')->count('ID');` - а цей метод `count()`, дасть нам результат, про кількість рядків в таблиці city, за колонкою `ID`

## Eloquent ORM
> Eloquent ORM (Object-Relational Mapping) — це ORM-бібліотека, вбудована в Laravel, яка дозволяє працювати з базою даних, використовуючи об'єктно-орієнтований підхід. Це означає, що ви можете взаємодіяти з таблицями бази даних, як з об'єктами, що значно спрощує роботу з даними, роблячи її інтуїтивною та зручною.

### Порядок дій

1. Спочатку слід створити `Model`, її слід створювати в однині: User, Post, Image... Це можна зробити командою: `php artisan make:model Post`
   1. Також слід звернути увагу, що при створенні моделі, ми можемо вказувати різні опцій, з опціями, ми можемо ознайомитись за [посиланням](https://laravel.com/docs/11.x/eloquent#generating-model-classes)
   2. У моєму випадку, я створю модель і відразу для неї створю міграцію: `php artisan make:model Post --migration`. Міграція, буде створена з назвою у МНОЖИНІ
   3. Тут можнапобачити, які нам файли створять виконані команди: [examp](`php artisan make:model Post`)
   4. І ще такий момент, слід врахувати, чи вже не створена відповідна міграція. Бо наприклад, коли я запустив команду для ствоерння моделі і міграції, в мене вже табличка `posts` була створена
2. Потім ми йдемо у потрібний нам контролер, де ми хочемо звернутись до моделі і скористуватись `Eloquent`, та у потрібному нам екшині звертаємось до моделі. [Приклад](https://i.imgur.com/VJzKxH0.png)
   - Таким чином у нас автоматично, відбудеться звернення, до нашої таблички, які відповідає назві моделі. Тобто в мене модель `Post`, та від неї мала створитись міграція в множині [`posts`](https://i.imgur.com/NU8rfYa.png), та таким чином модель і табличка будуть між собою звязані
   - Також ,ми застосували для моделі метод `all` який поверне нам всі записи з бази і саму у властивості `attributes` будуть потрібні нам дані з бази [examp](https://i.imgur.com/MvFNmTF.png)
   - Щоб нам, записи відобразити в коректному нам вигляді, слід використати метод `toArray()` - `$posts = Post::all()->toArray();` - [examp](https://i.imgur.com/Epgr1JY.png)
   - А якщо нам треба отримати дані у форматі JSON, то й використати можнаметод `toJson()` - `$posts = Post::all()->toJson();` - [examp](https://i.imgur.com/8cF4sBp.png)
Приклади команд:
   - `$posts = Post::all(['title', 'content'])->toArray();` - в метод all, параметрами ми можемо передати ті колонки, які хочемо бачити при вібірці з бази
   - З використанням такого методу як `query()` - ми зможемо застосовувати різні інші методи, для вибрки з бази. Наприклад: `$posts = Post::query()->find(61, ['title', 'content'])->toArray();` - дозволить нам, отримати конкретний запис по його ID з бази
   - Або запис: `$posts = Post::query()->first()->toArray();` - дозволить отримати перший запис
### Конвенції, для моделей Laravel
- Тут річ про те, що як ми створюємо модель, то вона повинна буди в однині: Post, User, City... Та при умові використання Eloquent ORM, є таке правило, як створення табличок в МНОЖИНІ. Наявіть якщо ми скористаємось командою: `php artisan make:model Post --migration` то табличка буде створена, з назвою `posts`, тобто в множині
- Але ці конвенції(домовленності), не є строго вказаними і від них можна відійти. А це треба для того, що наприклад в нас табличка в базі, не завжди може відповідати назві в МНОЖИНІ. І як відійти від цієї конвенції:
  1. Це ми можемо піти в БАТЬКІВСЬКУ МОДЕЛЬ `vendor/laravel/framework/src/Illuminate/Database/Eloquent/Model.php` та взагалі подивитись які там є модифікатори
  2. Потім ми ідемо в потрібно нам модель і вказуємо назву таблиці в рчну, з якою буде відбуватись зєднання . [Приклад з моделі](https://i.imgur.com/rWogrL0.png) і те як буде виглядати [запит](https://i.imgur.com/hyetvWX.png) - обто, яку скажемо табличку в моделі, до тієї і буде відбуватись конект

### Призначення Первинного ключа(Primary Key)

- Тут річ про те, що в моделі можна модифікувати параметр, який буде відповідати за первинний ключ
- А саме те, що наприклад первинний ключ, може бути не тільки з типом даних [`int`](https://i.imgur.com/w8NQzWz.png), а щей за замовчуванням Primary Key, в моделі рахується колонка з назвою `id`, а наприклад строкове значення, як це у нас наприкладів в табличці `country`, там первинним ключем виступає колонка `Code`, значення якої є строкою [адривіатури](https://i.imgur.com/EP0eXaK.png) назви цих країн
- Тому в моделі `Country`, ми можемо [явно задати Primary Key](https://i.imgur.com/VVuDjVh.png)

### Як повернути дані у форматі JSON

- Якщо ми просто захочемо отримати дані у вигляді JSON формату. Ми можемо це зробити таким чином: `Country::query()->get()->toJson();` - але цей спосіб, має мінус, та він в тому, що в headers е поверне того, що дані у форматі JSON.
- Щоб повернути дані і віддати коректні headers, слід скористуватись таким записом: 
```php
    $countries = Country::query()->get()->toJson();
    return response()->json($countries);
```
- Та як ми можемо зрозуміти, що такий результат, буде повернено саме для запитів по API, бо на VIEW таким чином дані не відправити
- А якщо ми будемо робити запит з файла `routes/api` то при поверненні результату, ми будемо відразху отримувати відповідь у вигляді JSON [examp](https://i.imgur.com/zlZHZB7.png)

### Приховування даних в моделях

- В моделях, ми можемо приховати дані, для користувача
- А саме, в самій моделі, можна скористуватись властивістю `hidden`, та передати масивм ті параметри, які ми будемо приховувати
- Але це, буде працювати у тому випадку, якщо ми для даних, які отримуємо через Eloquent ORM, будемо засосовувати методи `toArray`, `toJson`
- [Приклад моделі](https://i.imgur.com/jlBykQj.png), [приклад контролера, де буде видно вивід інфомрації](https://i.imgur.com/XQEx3Up.png), ну і сам [вивід інфо](https://i.imgur.com/gcR5mE5.png), де буде видно, ще не буде властивостей `SurfaceArea, IndepYear`, але тільки там, де застосовано метод `toArray()`

### Функції агрегатори в Eloquent ORM

```php
    dump(Country::query()->count());
    dump(Country::query()->max('Population'));
    dump(Country::query()->min('Population'));
    dump(Country::query()->avg('Population'));
```

### Редірект на 404 при за умови пустого значення при вибірці з бази

- От наприклад, ми шукаємо якийсь запис в базі і його немає. Якщо спробувати задампити результат пошуку, ми побачимо значення NULL. [Приклад](https://i.imgur.com/5mn3OmY.png)
- І щоб цьому запобігти, можна використати два варіанти.
  - Перший, це викликати функцію [`abort()`](https://i.imgur.com/XGktEPu.png)
  - Та другий, більш короткий метод, це використати метод [`findOrFail`](https://i.imgur.com/h9SXgdZ.png)

### CRUD операції в Eloquent ORM

- Якщо по простому, то концепцією Eloquent ORM, є те, що кожен запис в базі, є обєктом
- Тому щоб щось записати в базу, слід зробити наступні дії:
  1. Створити екземпляр класу нашої моделі в його контролері
  2. І далі для екземпляру класа, вказувати відповідні властивості, які слід зберегти в базу
  3. скористуватись методом `safe()`, щоб дані зберегти

[Приклад:](https://i.imgur.com/HZC5wBO.png)

```php
    $post = new Post();
    $post->title = 'new title Eloquent ORM';
    $post->slug = 'new title slug Eloquent ORM';
    $post->content = 'new title content Eloquent ORM';
    $post->category_id = rand(1,2);

    dump($post->save());
```

- Але, найбільш частіше використовують метод [`create`](https://i.imgur.com/diOIu6I.png) для моделі, з якої слід записати дані в базу

```php
    Post::query()->create([
        'title' => 'new title 2 Eloquent ORM',
        'slug' => 'new title slug 3 Eloquent ORM',
        'content' => 'new title content Eloquent ORM',
        'category_id' => rand(1,2)
    ]);
```

- Проте, з використанням такого запису, ми зіштовхнемось з помилкою: '`Add [title] to fillable property to allow mass assignment on [App\Models\Post].`' - вона буде говорити про те, що ми в ручну намагаємось записати дані, що не є безпечним, і щоб нам цього позбутись і зробити все правильно, слід вказати, які ми будемо передавати поля до бази
- Щоб це виправити, ми маємо це вказати в наші моделі, а саме, вказати, які саме поля передаваємі в базу, будуть дозволені для масового заповлення. Ці дані, слід передати в масив властивості [`$fillable`](https://i.imgur.com/OM1CrLR.png)
- А якщо хочемо заборонити якісь поля, ці властивості слід передавати в масив `$guarded`

### Створення даних, які прийдуть з API, або з Форми, методом POST

- Перше що нам треба, це налаштувати відповідні роути, щоб дані відправлялись методом POST [приклад](https://i.imgur.com/lvw57xm.png)
- Потім ми йдемо в Postman, та пробуємо відправити запит на нашу адресу, яку налаштували в роутах [examp](https://i.imgur.com/ZhLR79m.png)
- Далі ідемо в наш контролер, де ми будемо відловлювати ці дані і пробуємо спочатку [задампити](https://i.imgur.com/LmkKEJg.png) результат, який приходить з Postman. Для цього в Laravel є метод `Request`, яки буде нам повертати всі дані яки прийшли з запиту. Та якщо з Postman відправимо запит, з [можемо побачити їх відразу в програмкі](https://i.imgur.com/YLGa7aL.png)
- Наступною ціллю буде покласти ці дані в базу, тобто ті дані які прийдуть з Postman і тут є декілька варіанті
  1. Перший варіант, з використанням методу $request та викликати на ньому ті властивості які приходять з запиту. [приклад](https://i.imgur.com/PZA6WIs.png)
  2. Другий з використанням метода `all()` [приклад](https://i.imgur.com/TN9NltR.png)
> Зіштовнувся з одним приколом, виявляється `content` є зарезервованим, тому якщо в нас колонка в базі зарезервована, ми можемо використати метод input() і в нього передати потрібну нам колонку [приклад](https://i.imgur.com/iGQWjHE.png)
- А щоб повернути відповідь того що ми відправили, ми можемо використати наступний запит [$request_all()](https://i.imgur.com/TBQTSsq.png)

### Приклад оновлення даних UPDATE Eloquent ORM

- Перше, це [налаштовуємо роути](https://i.imgur.com/6uxYwfz.png) - вони мають бути з відповідним методом у моєму випадку це метод PUT, хотя є ще метод PATCH
- Потім у відповідному екшині нашого контролеру слід знайти наш запис який хочемо редагувати, пошук будемо робити методом find по його id
- І далі ми будемо вказувати які поля будемо перезаписувати і далі перезапис будемо робити тими даними які прийдуть з методу request
- [Приклад](https://i.imgur.com/Fwotc42.png)

- Або ми можемо робити [масове присвоєння](https://i.imgur.com/AveU8sO.png) 
- Також прикольний спосіб, робити це за допомогою умов `Post::query()->where('id', $id)->update($request->all());` [приклад](https://i.imgur.com/wreDEG8.png) 

### Приклад видалення даних DELETE and DESTROY

- Налаштовуємо роутер з відповідним етодом та налаштовуємо контролем з його екшином
- Ну потім, шукаємо методом `find()` відповідний `id`
- А далі методом delete() його видаляємо
- [приклад](https://i.imgur.com/GNc3TKn.png)

- Ще можна видаляти методом destroy() - різниця в тому, що в цей метод відразу можна передавати декілька id елементів які бажаємо видалити
- [приклад](https://i.imgur.com/ISPEhfb.png)

## Collection

Колекції в Laravel — це зручний інструмент для роботи з масивами даних. Вони надають об'єктно-орієнтовані методи для маніпуляції даними, що робить код чистішим і легшим для розуміння.

- З колекціями, можна ознайомитись за [посиланням](https://laravel.com/docs/11.x/collections)
- Окремо є Eloqument collection, більше інформації [тут](https://laravel.com/docs/11.x/eloquent-collections)

### Основні поняття про колекції:

1. **Що таке колекції?**
    - Колекція — це об'єкт, який інкапсулює масив і надає багато методів для роботи з ним.
    - Колекції Laravel засновані на класі `Illuminate\Support\Collection` і містять безліч корисних методів для роботи з даними.

2. **Чому колекції зручні?**
    - Колекції дозволяють ланцюгове викликати методи (методи колекцій можуть викликатися один за одним).
    - Вони надають зручний синтаксис для роботи з масивами, що зменшує кількість коду, який потрібно писати вручну.

3. **Як створюються колекції?**
    - Ви можете створити колекцію з масиву, просто передавши його в метод `collect()`:

   ```php
   $collection = collect([1, 2, 3, 4, 5]);
   ```

    - Якщо ви працюєте з Eloquent і отримуєте дані з бази, то колекція створюється автоматично:

   ```php
   $users = User::all(); // $users — це колекція
   ```

4. **Основні методи колекцій:**
    - **`map`:** Пробігає по кожному елементу і застосовує функцію зворотного виклику (callback).
    - **`filter`:** Фільтрує колекцію за умовою.
    - **`pluck`:** Витягує значення певного ключа з кожного елементу колекції.
    - **`first`:** Повертає перший елемент колекції.
    - **`sortBy`:** Сортує колекцію за певним ключем.
    - **`sum`:** Підсумовує значення колекції.
    - **`reduce`:** Агрегує колекцію до одного значення.

   Приклад:

   ```php
   $users = collect([
       ['name' => 'John', 'age' => 25],
       ['name' => 'Jane', 'age' => 30],
       ['name' => 'Doe', 'age' => 20],
   ]);

   $ages = $users->pluck('age'); // [25, 30, 20]
   $sorted = $users->sortBy('age'); // Сортує за віком
   $filtered = $users->filter(function ($user) {
       return $user['age'] > 20;
   });
   ```

5. **Ланцюжковий виклик методів:**
    - Колекції дозволяють ланцюжкове викликання методів для створення потужних виразів.
    - Наприклад:

   ```php
   $result = $users->filter(function ($user) {
       return $user['age'] > 20;
   })->pluck('name')->sort()->values();
   ```

   Цей код спочатку відфільтровує користувачів за віком більше 20, витягує їхні імена, сортує їх і повертає значення.

6. **Перетворення результатів:**
    - В кінці, після виконання всіх операцій, ви можете перетворити колекцію назад у масив або JSON:

   ```php
   $array = $collection->toArray();
   $json = $collection->toJson();
   ```

> Наприкладі даних з бази, ми можемо побачити різні варіанти повернення даних, та от на прикладі нижче, ми можемо побачити, що вони відносяться до різних типів колекцій. Точніше перший варіант, він просто повертає масив з даними. А от дава наступні вони повертають колекції
> Про тут є нюанс, [між цими колекціями](https://i.imgur.com/ezh5Yqq.png), та ця різниця, буде описана нижче
```php
        $cities = DB::select("select * from `city` limit 5 ");
        dump($cities);

        $cities = DB::table('city')->limit(5)->get('*');
        dump($cities); // QueryBuilder

        $cities = City::query()->limit(5)->get();
        dump($cities); // Eloquent collection
```

### Різниця між колекціями: 

Існують дві основні колекції в Laravel:

1. **`Illuminate\Support\Collection`**
2. **`Illuminate\Database\Eloquent\Collection`**

Хоча обидва ці класи працюють з колекціями даних, вони мають різне призначення і деякі ключові відмінності.

### 1. `Illuminate\Support\Collection`

- **Загальне використання:** Це базовий клас колекцій Laravel, який використовується для роботи з будь-яким масивом даних. Він надає великий набір методів для маніпуляції даними, такими як фільтрація, сортування, зведення, пошук тощо.

- **Джерело даних:** Ви можете створити колекцію з будь-якого масиву або з іншого джерела, не пов'язаного з базою даних.

- **Методи:** Всі загальні методи колекцій (наприклад, `map`, `filter`, `pluck`, `reduce` тощо) доступні в цьому класі.

- **Приклад:**

    ```php
    $collection = collect([1, 2, 3, 4, 5]);
    $filtered = $collection->filter(function ($value) {
        return $value > 2;
    });
    ```

### 2. `Illuminate\Database\Eloquent\Collection`

- **Специфічне використання:** Це клас колекцій, спеціально створений для роботи з Eloquent моделями. Він є підкласом `Illuminate\Support\Collection` і надає додаткові можливості, специфічні для роботи з базою даних і моделями.

- **Джерело даних:** Використовується переважно, коли ви отримуєте дані з бази через Eloquent ORM. Наприклад, коли ви викликаєте метод `all()` або `get()` на моделі, ви отримуєте об'єкт `Illuminate\Database\Eloquent\Collection`.

- **Додаткові методи:** Окрім загальних методів колекцій, `Eloquent\Collection` надає спеціалізовані методи для роботи з моделями, такі як:
    - **`load`**: Підвантаження відношень (lazy eager loading).
    - **`find`**: Пошук конкретного елемента за первинним ключем.
    - **`contains`**: Перевірка, чи містить колекція модель з певним ключем або значенням.
    - **`firstWhere`**: Повертає перший елемент, що відповідає певній умові.

- **Автоматичне завантаження відношень:** Коли ви працюєте з колекцією моделей, ви можете підвантажити відношення всіх моделей одним запитом, що значно покращує продуктивність.

- **Приклад:**

    ```php
    $users = User::all(); // Повертає Illuminate\Database\Eloquent\Collection
    
    $firstUser = $users->first(); // Повертає першу модель User
    $userNames = $users->pluck('name'); // Повертає колекцію імен користувачів
    ```

### Основні відмінності:

1. **Призначення:**
    - `Illuminate\Support\Collection` призначений для роботи з будь-якими масивами.
    - `Illuminate\Database\Eloquent\Collection` використовується для роботи з колекціями Eloquent моделей.

2. **Джерело даних:**
    - `Illuminate\Support\Collection` може бути створений з будь-якого масиву або колекції даних.
    - `Illuminate\Database\Eloquent\Collection` створюється автоматично при отриманні даних з бази через Eloquent ORM.

3. **Методи:**
    - `Eloquent\Collection` успадковує всі методи з `Support\Collection`, але додає додаткові методи, специфічні для роботи з моделями та відношеннями.

Таким чином, `Illuminate\Database\Eloquent\Collection` є розширеною версією `Illuminate\Support\Collection`, оптимізованою для роботи з Eloquent моделями та базою даних.

### Парочка прикладів

```php
    $cities = (City::query()->limit(50)->get())->filter(function ($city, $key){
      return $city['Population'] > 1_000_000;
    });
```

## One to One

Щоб організувати зв'язок "один до одного" в Laravel, дотримуйтесь таких кроків:

> Також не забуваємо за [документацію](https://laravel.com/docs/11.x/eloquent-relationships#one-to-one)
> Ще хочу зазначити, що такий звязок one-to-one передбачає тільки те, що ЛИШЕ один запис таблиці А, може відповідати ЛИШЕ одному запису таблиці B
> Ось приклади таблиць зі зв'язком "один до одного" у форматі `table1 -> table2`:

1. **user -> profile**
    - Користувач має один профіль.

2. **product -> warranty_certificate**
    - Товар має один гарантійний сертифікат.

3. **order -> shipping_detail**
    - Замовлення має одну відповідну доставку.

4. **car -> registration_number**
    - Автомобіль має один реєстраційний номер.

5. **book -> barcode**
    - Книга має один унікальний штрих-код.

6. **employee -> workstation**
    - Співробітник має одне робоче місце.

### Порядок створення зв'язку

1. **Створіть моделі**:
    - Визначте дві моделі, між якими буде встановлений зв'язок "один до одного". Наприклад, якщо у вас є моделі `User` і `Profile`, кожен користувач буде мати один профіль.
    - Це можна зробити командою `php artisan make:model <Model>` - її слід створювати в однині

2. **Створіть міграції**:
    - Створіть таблиці для кожної моделі. Таблиця, яка містить зв'язок, повинна мати зовнішній ключ, що посилається на первинний ключ іншої таблиці.
    - Виберіть, в якій таблиці буде зберігатися зовнішній ключ. Це буде залежати від того, яка модель є власником відносин.
    - Або можна створити відразу і модель і міграцію: `php artisan make:model <Model> -m`

3. **Додайте методи відносин в моделі**:
    - У моделі, яка має зовнішній ключ, додайте метод для встановлення зв'язку з іншою моделлю. Цей метод використовує функцію `belongsTo` або `hasOne`, залежно від того, яка модель є "власником".
    - Якщо по простому, то метод 'hasOne' **слід додати в модель, яка має foreingkey**
    - А `belongTo` в модель, яка звязує таблиці по foreingkey

4. **Налаштуйте міграції**:
    - Вкажіть зовнішній ключ у відповідній міграції. Він повинен посилатися на первинний ключ іншої таблиці. Налаштуйте поведінку при видаленні або оновленні запису, використовуючи `onDelete` або `onUpdate`.

5. **Використовуйте відносини в коді**:
    - Після налаштування зв'язку, ви можете використовувати його для отримання відповідного запису з іншої моделі, наприклад, для отримання профілю користувача або навпаки.

Ці кроки дозволяють налаштувати зв'язок "один до одного" між двома моделями у Laravel, забезпечуючи правильну структуру бази даних і доступ до пов'язаних даних.
