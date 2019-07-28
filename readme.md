## School Management and Accounting Software
[![Build Status](https://travis-ci.org/changeweb/Unifiedtransform.svg?branch=master)](https://travis-ci.org/changeweb/Unifiedtransform)
[![Linux](https://img.shields.io/travis/changeweb/Unifiedtransform/master.svg?label=linux)](https://travis-ci.org/changeweb/Unifiedtransform)
[![Code Climate](https://codeclimate.com/github/changeweb/Unifiedtransform/badges/gpa.svg)](https://codeclimate.com/github/changeweb/Unifiedtransform)
[![MadeWithLaravel.com shield](https://madewithlaravel.com/storage/repo-shields/1362-shield.svg)](https://madewithlaravel.com/p/unifiedtransform/shield-link)
[![Join the chat at https://gitter.im/Unifiedtransform](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/Unifiedtransform?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

We like to challenge the quality of what we build to make it better. To do so, we try to make the product intuitive, beautiful, and user friendly. Innovation and hard work help to fulfill these requirements. I believe in order to innovate we need to think differently. A few months ago I discovered there was no open source free school management software that met my quality standards. I happen to know a bit of programming so I decided to make one. I also believe that working with more people can push the standard higher than working alone. So I decided to make it open source and free.

## Featured on Laravel News !!
![Screenshot_2019-04-07 Laravel News](https://user-images.githubusercontent.com/9896315/55683832-1b3c8c80-5966-11e9-8dfb-ab30a79a98ed.png)
See the news [here](https://laravel-news.com/unified-transform-open-source-school-management-platform)

## Contribute

Unifiedtransform is 100% open source and free forever!!

Community contribution can make this product better!! See [Contribution guideline](https://github.com/changeweb/Unifiedtransform/blob/master/CONTRIBUTING.md) before making any Pull request.

When you contribute to a Github project you agree with this terms of [Github Terms of Service(Contributions Under Repository License)](https://help.github.com/en/articles/github-terms-of-service#6-contributions-under-repository-license).

Since this project is under **GNU General Public License v3.0**, according to Github's Terms of Service all your contributions are also under the same license terms.
Thus you permit the user of this software to use your contribution under the terms of **GNU General Public License v3.0**.

### Contributors Hall of Fame
[![](https://sourcerer.io/fame/changeweb/changeweb/Unifiedtransform/images/0)](https://sourcerer.io/fame/changeweb/changeweb/Unifiedtransform/links/0)[![](https://sourcerer.io/fame/changeweb/changeweb/Unifiedtransform/images/1)](https://sourcerer.io/fame/changeweb/changeweb/Unifiedtransform/links/1)[![](https://sourcerer.io/fame/changeweb/changeweb/Unifiedtransform/images/2)](https://sourcerer.io/fame/changeweb/changeweb/Unifiedtransform/links/2)[![](https://sourcerer.io/fame/changeweb/changeweb/Unifiedtransform/images/3)](https://sourcerer.io/fame/changeweb/changeweb/Unifiedtransform/links/3)[![](https://sourcerer.io/fame/changeweb/changeweb/Unifiedtransform/images/4)](https://sourcerer.io/fame/changeweb/changeweb/Unifiedtransform/links/4)[![](https://sourcerer.io/fame/changeweb/changeweb/Unifiedtransform/images/5)](https://sourcerer.io/fame/changeweb/changeweb/Unifiedtransform/links/5)[![](https://sourcerer.io/fame/changeweb/changeweb/Unifiedtransform/images/6)](https://sourcerer.io/fame/changeweb/changeweb/Unifiedtransform/links/6)[![](https://sourcerer.io/fame/changeweb/changeweb/Unifiedtransform/images/7)](https://sourcerer.io/fame/changeweb/changeweb/Unifiedtransform/links/7)

## Testing

- We want testable softwares. Most parts of the software are covered by tests. You also can contribute by writing test case!
- To run Feature and Unit Tests use `./vendor/bin/phpunit`.
- To run Browser Tests copy `.env.dusk.example` to `.env.dusk.local` and set `APP_KEY` with same token to environment variable in your `.env` file and run `php artisan serve --env=dusk.local` for execute the server then run `php artisan dusk`.

## License

GNU General Public License v3.0

## Features

This software has following features:

* Roles: Master, Admin, Teacher, Student, Librarian, Accountant

   **(You can Impersonate User Roles in Development environment)** See how [Impersonation](https://github.com/changeweb/Unifiedtransform/pull/118) works. Cool !!
* **Payment**
   * **[Stripe](http://stripe.com/)** is used. See configuration below
   * Students can pay from their accounts.
   * Student can view payment receipts (history)
   * View Screenshot below
* Attendance
* Mark
* Registration
* Notice, Syllabus
* Library
* Exam
* Grade
* Accounts
* Messaging (uses CKEditor 5)
* **Export/Import** Users (Students, Teachers) from/to **Excel**
   * [Laravel Excel](https://github.com/maatwebsite/Laravel-Excel) package is used.
   * **Important:** Single sheet supported in an Excel file. So delete any extra sheet in an Excel file.
   * Following excel column  names supported for both Teachers and Students:

      * `name, email, password, address, about, phone_number, blood_group, nationality, gender`.
   * Other columns:

      * For Teachers: `department`, (`class, section`) if assigned as class teacher.
      * For Students: `class, section, session, version, group, birthday, religion, father_name, father_phone_number, father_national_id, father_occupation, father_designation, father_annual_income, mother_name, mother_phone_number, mother_national_id, mother_occupation, mother_designation, mother_annual_income`
   * For any number(e.g: phone_number) starts with zero, put (') before zero.
* Supported Languages (**English, Spanish**)

   * To set default Language and Timezone, Edit as following in `config/app.php`:

      ```php
      'timezone' => 'Asia/Dhaka',//'UTC',
      'locale' => 'en',//'es-MX' for Spanish
      ```


## Framework used

- Laravel 5.5
- Bootstrap 3.3.7

## Server Requirements

- PHP >= 7.1.0
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

## How to Start
### Using a Container:

**[Docker](https://www.docker.com/)** is now supported.

You need to change Docker configuration files according to your need.

- Change following lines in `docker-compose.yml`

      MYSQL_ROOT_PASSWORD: your password
      MYSQL_USER: root
      MYSQL_PASSWORD: your password

- To run this software in Docker containers run `sudo docker-compose up -d`.
- Then run `sudo docker container ls --all`. Copy **Nginx** Container ID.
- Then run `sudo docker exec -it <container id> bash`
- Run `cp .env.example .env` and change following lines in `.env` file
   ```sh
   DB_HOST=db
   DB_PORT=3306
   DB_DATABASE=school
   DB_USERNAME=root
   DB_PASSWORD=your password
   ```
- Run `composer install`
- Run `php artisan key:generate`
- Run `php artisan migrate:fresh --seed`
- Visit `http://localhost:80`.

### Not using a Container:

Here are some basic steps to start using this application

**Note:** Instruction on cached data for Dashboard is given in **Good to know** segment below.

- Clone the repository

```sh
git clone https://github.com/changeweb/Unifiedtransform
```

- Copy the contents of the `.env.example` file to create `.env` in the same directory

- Run `composer install` for `developer` environment and run `composer install --optimize-autoloader --no-dev` for `production` environment to install Laravel packages (Remove **Laravel Debugbar**, **Laravel Log viewer** packages from **composer.json** and 

```php
   //Provider
   Barryvdh\Debugbar\ServiceProvider,
   Logviewer Service provider,
   //Alias
   Debugbar' => Barryvdh...
```
 from `config/app.php` before running **`composer install`** in **Production Environment**)

- Generate `APP_KEY` using `php artisan key:generate`

- Edit the database connection configuration in .env file e.g.

```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=unifiedtransform
DB_USERNAME=unified
DB_PASSWORD=secret
```

> Note that this is just an example, and the values may vary depending on your database environment.

- Set the `APP_ENV` variable in your `.env` file according to your application environment (e.g. local, production) in `.env` file

- Migrate your Database with `php artisan migrate`

- Seed your Database with `php artisan db:seed`

- On localhost, serve your application with `php artisan serve`

> See **[Video Tutorial](https://vimeo.com/334331502)**.

[![Video Tutorial](https://user-images.githubusercontent.com/9896315/57624079-fbc30000-75b2-11e9-80b8-9bf92de3b1ac.png)](https://vimeo.com/334331502 "Unifiedtransform Installation")

#### (Optional)

- [Laravel Page Speed Package](https://github.com/renatomarinho/laravel-page-speed) is installed but not activated. If you want to use it to optimize your site automatically which results in a 35%+ optimization. You need to uncomment some lines from `Kernel.php` file and may need to run `php artisan vendor:publish --provider="RenatoMarinho\LaravelPageSpeed\ServiceProvider"`.

   **app/HTTP/Kernel.php**
   ```php
       //\RenatoMarinho\LaravelPageSpeed\Middleware\InlineCss::class,
       //\RenatoMarinho\LaravelPageSpeed\Middleware\ElideAttributes::class,
       //\RenatoMarinho\LaravelPageSpeed\Middleware\InsertDNSPrefetch::class,
       //\RenatoMarinho\LaravelPageSpeed\Middleware\RemoveComments::class,
       //\RenatoMarinho\LaravelPageSpeed\Middleware\TrimUrls::class,
       //\RenatoMarinho\LaravelPageSpeed\Middleware\RemoveQuotes::class,
       //\RenatoMarinho\LaravelPageSpeed\Middleware\CollapseWhitespace::class,
   ```
- To create a `Master`, go to the `database\seeds\UsersTableSeeder.php` and change the `name`, the `email` and the `password` settings to your likings. Leave the other settings (role, active, verified) unchanged!

- [Laravel Passport](https://laravel.com/docs/5.5/passport) package is included to support API. *Key* for Passport should be automatically generated by `php artisan passport:keys` from `post-install-cmd` script in `composer.json` or you have to run this manually and to remove this package just follow these steps

  - Remove it from `composer.json` require dependencies and remove command `@php artisan passport:keys` from `post-install-cmd` script
  - Run `composer update` and `composer dump-autoload`.
  - And all classes that relies on passport must be edited as well. The most common classes are:
  - `app\User.php` model, remove the `HasApiToken` trait.
  - `app\Proiders\AuthServiceProvider`, remove `Passport::routes();` in your boot method.
  - In `config/auth.php`, change your driver option for `api` from `passport` to `api` authentication.

- To create the tables, run `php artisan migrate`.

  - If you don't want to use **Passport** package then remove the **Passport Migrations** in database `migrations` table and run command `artisan migrate:refresh`
- To seed the tables with fake data, use `php artisan db:seed`.
- If you want to run the migration and the seeding together, use `php artisan migrate:refresh --seed`
- You must seed `database\seeds\UsersTableSeeder.php` at least once in order to create the **Master** account (**For Production:** Run the seed in **Development** environment and then switch to **production**). To do so, follow these steps:
  - comment all the seeders except `$this->call(UsersTableSeeder::class);` in `database\seeds\DatabaseSeeder.php`;
  - then comment `factory(App\User::class, 200)->create();` in `UsersTableSeeder.php`.

   So your files will look something like this:

   In `database\seeds\DatabaseSeeder.php`:
   ```php
   ...
   //$this->call(SectionsTableSeeder::class);
   $this->call(UsersTableSeeder::class);
   //$this->call(AttendancesTableSeeder::class);
   ...
   ```
   In `database\seeds\UsersTableSeeder.php`:
   ```php
   ...
   //factory(User::class, 10)->states('admin')->create();
   //factory(User::class, 10)->states('accountant')->create();
   //factory(User::class, 10)->states('librarian')->create();
   //factory(User::class, 30)->states('teacher')->create();
   //factory(User::class, 200)->states('student')->create();
   ```

* [Laravel 5 log viewer](https://github.com/rap2hpoutre/laravel-log-viewer) is used to view Logs using a UI at 'example.com/logs' while in development environment.

## Stripe setup

* Add `STRIPE_KEY` and `STRIPE_SECRET` in `.env` file.
* For Stripe Test uncomment following test `student_can_pay_amount` in `tests\Feature\PaymentModuleTest` after editing `.env`.

   From
   ```php
   //public function student_can_pay_amount(){
      ...
   //}
   ```
   To
   ```php
   public function student_can_pay_amount(){
      ...
   }
   ```

## Create a school and an admin

* Important: only a `master` can create a new school and its admins!
* Login at `example.com/login` using your `Master` account credentials
* Create a new `school`
* Create a new `admin` for the newly created school

## Manage a school

* Important: A `master` CANNOT manage a school's data!
* Login as `admin` at `example.com/login`
* Now add data to the school as required.

## Basic Steps by Serial

* Create Classes
* Create Sections
* Create Exam
* Add Students
* Add Teachers
* Add Courses
* Then teacher can take attendance, give marks

## Manage Exam (In exam manage page) by Admin

1. Check Notice published checkbox for an Exam after uploading Exam Notice.
2. Check Result published checkbox for an Exam after all teachers updated their courses' marks.

   * Checking result as published sets the Exam as completed.
3. Exam is set as Active by default while created. You can deactivate the exam by checking related checkbox.

## Manage GPA and Grade

1. Admin adds GPAs for respective mark ranges.
2. For giving marks, Teacher clicks on Submit Grade button and do the following:

   1. Select a GPA by name from dropdown
   2. Configure Class Test, Quiz, ...etc. count, percentage (Optional)
   3. Give marks
   4. To get Grade of students of a course for given marks, Teacher clicks the Get Total Marks button.
      (Usually this is done at the end of the semester)

## Good to know

* Setup your Mail configuration in `.env` file if you want to send email. Currently registered users are notified by invitation mail if Mail is configured properly.
* This project uses [Laravel Impersonate](https://github.com/404labfr/laravel-impersonate) in development and staging environments, so you can view the application through another user's eyes, which is useful for testing. See the guide for using [Impersonation](https://github.com/changeweb/Unifiedtransform/pull/118).
* In `.env`, turn `APP_DEBUG` to `false` for production environment.
* Remove `Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');` from `routes/web.php` while in Production Environment.
* `Cache::remember()` generates cache files. To delete expired cache files [LaravelCacheGarbageCollector](https://github.com/jdavidbakr/laravel-cache-garbage-collector) package is used. Run `php artisan cache:gc`.
* You can switch to and from maintenance mode by running `php artisan up` and `php artisan down`.
* Optimizing Route Loading `php artisan route:cache`
* Dashboard page contents(e.g. Student count, Teacher count, Notice, etc.) are cached because these are not frequently changed. If you don't want these to be cached, just remove the cache lines in `index` method in `app\Http\Controller\HomeController.php`like the following example.
So your edit would be something like this:

From:
```php
...
$classes = \Cache::remember('classes-'.$school_id, $minutes, function () use($school_id) {
   return \App\Myclass::where('school_id', $school_id)
                        ->pluck('id')
                        ->toArray();
});
...
```
To:
```php
...
$classes = \App\Myclass::where('school_id', $school_id)
                        ->pluck('id')
                        ->toArray();
...
```

You can do similar for other cache lines.

## Here are some screenshots:

Auto generated fake data were used.

![Screenshot_2019-04-11 - Ms Duane Welch(2)](https://user-images.githubusercontent.com/9896315/56895635-841dad00-6aab-11e9-9400-ec79907b0a28.png)
![Screenshot_2019-05-11 Stripe Payment - Elvis Leffler](https://user-images.githubusercontent.com/9896315/57566209-b2748400-73eb-11e9-94c0-411a8d55e732.png)
![Screenshot_2019-04-29 All Examinations - Santino Bergstrom V](https://user-images.githubusercontent.com/9896315/56895608-6ea88300-6aab-11e9-9854-07f553ecb9b8.png)
![Screenshot_2019-03-21 Account Sectors - Britney Luettgen](https://user-images.githubusercontent.com/9896315/54765196-45cadd80-4c23-11e9-81d2-c761796678c8.png)
![Screenshot_2019-03-12 Add New Book - Arvid Marquardt](https://user-images.githubusercontent.com/9896315/54187727-68991b80-44d8-11e9-972b-370a7b4a89b1.png)
![Screenshot_2019-03-12 Add Routine - Arvid Marquardt](https://user-images.githubusercontent.com/9896315/54187728-68991b80-44d8-11e9-9655-62b83fe9e4dc.png)
![Screenshot_2019-03-12 Alba Huel - Arvid Marquardt](https://user-images.githubusercontent.com/9896315/54187729-6931b200-44d8-11e9-936e-df49e1ca91e6.png)
![Screenshot_2019-03-12 All Classes and Sections - Arvid Marquardt](https://user-images.githubusercontent.com/9896315/54187730-6931b200-44d8-11e9-9b8a-f4fd1657ef7d.png)
![Screenshot_2019-03-12 All Issued Book - Arvid Marquardt](https://user-images.githubusercontent.com/9896315/54187731-69ca4880-44d8-11e9-98ec-b345a3de3691.png)
![Screenshot_2019-03-12 Attendance - Arvid Marquardt(1)](https://user-images.githubusercontent.com/9896315/54187732-69ca4880-44d8-11e9-904b-8b3a3c4cff64.png)
![Screenshot_2019-03-12 Attendance - Arvid Marquardt(2)](https://user-images.githubusercontent.com/9896315/54187733-6a62df00-44d8-11e9-8c25-4598df4d9346.png)
![Screenshot_2019-03-12 Attendance - Arvid Marquardt](https://user-images.githubusercontent.com/9896315/54187734-6a62df00-44d8-11e9-9242-78b6fb805eda.png)
![Screenshot_2019-03-12 Course - Arvid Marquardt](https://user-images.githubusercontent.com/9896315/54187735-6afb7580-44d8-11e9-99c0-6095b98f432e.png)
![Screenshot_2019-04-06 Course Students - Prof Buddy Hermann](https://user-images.githubusercontent.com/9896315/55671336-f3d7b800-58b0-11e9-984e-8ae8f635bc42.png)
![Screenshot_2019-04-06 Messages - Prof Buddy Hermann](https://user-images.githubusercontent.com/9896315/55671126-5aa7a200-58ae-11e9-82e8-60e532a08883.png)
![Screenshot_2019-03-29 Grade - Deron Ruecker DDS](https://user-images.githubusercontent.com/9896315/55222646-a4511680-5236-11e9-89f0-606df40c1a6b.png)
![Screenshot_2019-03-12 Manage Schools - Arvid Marquardt(3)](https://user-images.githubusercontent.com/9896315/54187739-6b940c00-44d8-11e9-83c0-fb06cbd3c316.png)
![Screenshot_2019-03-12 Manage Schools - Arvid Marquardt](https://user-images.githubusercontent.com/9896315/54187740-6c2ca280-44d8-11e9-93b1-a998ac1cd585.png)
![Screenshot_2019-03-12 Promote Section Students - Arvid Marquardt(1)](https://user-images.githubusercontent.com/9896315/54187741-6c2ca280-44d8-11e9-871a-51148b27c2b4.png)
![Screenshot_2019-03-12 Students - Arvid Marquardt](https://user-images.githubusercontent.com/9896315/54187744-6cc53900-44d8-11e9-9ad4-c1acc58fe6a2.png)
