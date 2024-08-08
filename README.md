# Laravel зміст

1. [Встановлення](#Етап-1-Встановлення)
2. [.htaccess та Конфігурації](#Етап-2-htaccess-та-Конфігурації)
    - [Різниця між `local` та `production`](#Різниця-між-local-та-production)
3. [Service Container, Provider, Facades](#етап-3-service-container-provider-facades)
4. [Routing](#етап-4-routing)
5. [Controllers](#етап-5-controllers)

## Етап 1 Встановлення

-   Перед встановленянм Laravel, слід перевірити, або оновити версію Composer, це слід робити командою `composer self-update`
-   Тут все просто, ідем на сайт оф документації [Laravel](https://laravel.com/docs/11.x/installation), та слідуємо інструкції
-   ПІсля установки, можна перевірити версію Laravel, командою `php artisan -V`. А команда `php artisan` надасть доступ до всіх команд
    -   **Artisan** — це інтерфейс командного рядка, який постачається разом з Laravel. Він надає ряд корисних команд для розробки та управління додатком Laravel. Artisan значно спрощує виконання багатьох задач, таких як створення міграцій, генерація коду та виконання тестів.
-   Якщо раптом нам потрібно зрозуміти які вимоги до того, чи іншої версії Laravel, це слід перевірити в розділі [Server Requirements](https://laravel.com/docs/11.x/deployment#server-requirements)

## Етап 2 .htaccess та Конфігурації

1.  Налашутвання файлу `.htaccess` схоже на налштування цього ж файлу для звичайного MVC патерну, який я робив в [проєкт](https://github.com/Slobozhancky/blog). Тобто головною метою, є те, щоб створити **едину точку входу**, який буде направляти всі запити у папку `public`

-   Дуже ![простий приклад](https://i.imgur.com/ZL9PM7M.png), щоб запити з кореня, йшли в папку public, яка вже і так має свій файл `.htaccess`, щоб прийнти запит

2. Протестувати роботу конфігурацій, можна у файлі `lara.go.loc\routes\web.php`, просто тут маршрути будуть вести на головну сторінку, а нам слід лише виводи інформацію, щоб побачити результат

-   Всі наші конфігурації знаходяться в папці `lara.go.loc\config`
-   якщо ми хочемо отримати доступ до конфігурації, мо мижемо використовувати [функції хелпери](https://laravel.com/docs/11.x/helpers) - їх досить багато, але основні, що нас будуть цікавити це [config](https://laravel.com/docs/11.x/helpers#method-config)
-   `dump`, `dd` - ці дві функції, вони використовуються просто для виводу інформації
-   Стосвно того, щоб вивести нам інформацію якоїсь з конфігурацій, використовуємо функцію хелпер `config()` - вона приймає строку, у форматі `config('app.name')` - томущо,Ю якщо ми підекмо у файл `config/app` - томи побачимо повернуння значень у вигляди `ключ => значення` а запис `config('app.name')` дозволить нам, отримати імя ghjtrne ![приклад](https://i.imgur.com/DfinyBd.png)
-   Дані в конфігурації, ми отримуємо з `змінних навколишнього середовища проекту`, тобто з файлу `lara.go.loc\.env` - в цьому файлі, зберігаються всі налашутванян нашого проекту, які нам слід буде задавати для наших цілей

-   Ми можемо і налаштовувати наші конфігурації, наприклад у файлу ![.env створимо змінні](https://i.imgur.com/Z0uMWHv.png), потім у файлі `config/app` створимо конфігурацію, та з файлу .env [передамо ці змінні](https://i.imgur.com/hcQ28fL.png), ну і у файлі `routes/web` ![виведемо інформацію](https://i.imgur.com/pkfT0RH.png)

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

## Етап 3 Service Container, Provider, Facades

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

1.  Тож почнемо. Звертатись до **Service Container** можна через змінну `$app`, через `фасад App`, або за допомогою `хелперів app()`
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

## Етап 4 Routing

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

## Етап 5 Controllers

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
  - Наприклад така команда як: `php artisan make:controller <ControllerName> --resource` - допоможе створити контролер зі всіма CRUD `actions`. [Приклад](https://i.imgur.com/RdRHmgX.png)
- Щоб не лупити всі контролери в одну папку, то ми можемо їх створювати таким чином: `php artisan make:controller <dirName>/<ControllerName>`
- З цим [посиланням](https://laravel.com/docs/11.x/controllers#shallow-nesting), ми можемо знайти, як будувати шляхи, для наших роутів в залежності від їх `actions`
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
- Та [приклад такого застосування](https://i.imgur.com/getjPa6.png)
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
- 
