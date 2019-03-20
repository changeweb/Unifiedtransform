## School Management and Accounting Software

We like to challenge the quality of what we build to make it better. To do so, we try to make the product intuitive, beautiful, and user friendly. Innovation and hard work help to fulfill these requirements. I believe in order to innovate we need to think differently. A few months ago I discovered there was no open source free school management software that met my quality standards. I happen to know a bit of programming so I decided to make one. I also believe that working with more people can push the standard higher than working alone. So I decided to make it open source and free.

## Contribute

Community contribution can make this product better!!
 
## License

GNU General Public License v3.0

## Features

This software has following features:
- Roles: Master, Admin, Teacher, Student, Librarian, Accountant
- Attendance
- Mark
- Registration
- Notice, Syllabus
- Library
- Exam
- Grade
- Accounts
- Messaging

## Framework used

- Laravel 5.5
- Bootstrap 3.3.7

## How to Start
Here are some basic steps to start using this application

- Run `php composer.phar install` to install Laravel packages
- Create `.env` file from `.env.example` and generate `APP_KEY` using `php artisan key:generate`
- Set the database connection configuration in `.env` file
- To create a `Master`, go to the `database\seeds\UsersTableSeeder.php` and change the `name`, the `email` and the `password` settings to your likings. Leave the other settings (role, active, veerfied) unchanged!
- To create the tables, run `php artisan migrate`.
- To seed the tables with fake data, use `php artisan db:seed`.
- If you want to run the migration and the seeding together, use `php artisan migrate:refresh --seed`
- You must seed `database\seeds\UsersTableSeeder.php` at least once in order to create the **Master** account. To do so, follow these steps:
-- comment all the seeders except `$this->call(UsersTableSeeder::class);` in `database\seeds\DatabaseSeeder.php`;
-- then comment `factory(App\User::class, 200)->create();` in `UsersTableSeeder.php`.

So your files will look something like this:

In `database\seeds\DatabaseSeeder.php`:

    ...
    //$this->call(SectionsTableSeeder::class);
    $this->call(UsersTableSeeder::class);
    //$this->call(AttendancesTableSeeder::class);
    ...

In `database\seeds\UsersTableSeeder.php`:

    ...
    //factory(App\User::class, 200)->create();

- Create School and admin from `Master` account. Login page: `Your example.com\login`
- Turn `APP_DEBUG` to `false` in `.env` for Production environment
- You can keep maintenance mode by running `php artisan up` and `php artisan down`

## Create School and Admin

- First login with your `Master` account
- Create a **School**
- Create `Admins` for that School
- Manage that School using these `Admin` accounts

## Here are some screenshots:

Auto generated fake data were used.

![Screenshot_2019-03-12 - Arvid Marquardt](https://user-images.githubusercontent.com/9896315/54187724-68008500-44d8-11e9-9ed1-880bcef0fa06.png)
![Screenshot_2019-03-12 Account Sectors - Arvid Marquardt](https://user-images.githubusercontent.com/9896315/54187725-68991b80-44d8-11e9-9121-bc113047e1d0.png)
![Screenshot_2019-03-12 Add New Book - Arvid Marquardt](https://user-images.githubusercontent.com/9896315/54187727-68991b80-44d8-11e9-972b-370a7b4a89b1.png)
![Screenshot_2019-03-12 Add Routine - Arvid Marquardt](https://user-images.githubusercontent.com/9896315/54187728-68991b80-44d8-11e9-9655-62b83fe9e4dc.png)
![Screenshot_2019-03-12 Alba Huel - Arvid Marquardt](https://user-images.githubusercontent.com/9896315/54187729-6931b200-44d8-11e9-936e-df49e1ca91e6.png)
![Screenshot_2019-03-12 All Classes and Sections - Arvid Marquardt](https://user-images.githubusercontent.com/9896315/54187730-6931b200-44d8-11e9-9b8a-f4fd1657ef7d.png)
![Screenshot_2019-03-12 All Issued Book - Arvid Marquardt](https://user-images.githubusercontent.com/9896315/54187731-69ca4880-44d8-11e9-98ec-b345a3de3691.png)
![Screenshot_2019-03-12 Attendance - Arvid Marquardt(1)](https://user-images.githubusercontent.com/9896315/54187732-69ca4880-44d8-11e9-904b-8b3a3c4cff64.png)
![Screenshot_2019-03-12 Attendance - Arvid Marquardt(2)](https://user-images.githubusercontent.com/9896315/54187733-6a62df00-44d8-11e9-8c25-4598df4d9346.png)
![Screenshot_2019-03-12 Attendance - Arvid Marquardt](https://user-images.githubusercontent.com/9896315/54187734-6a62df00-44d8-11e9-9242-78b6fb805eda.png)
![Screenshot_2019-03-12 Course - Arvid Marquardt](https://user-images.githubusercontent.com/9896315/54187735-6afb7580-44d8-11e9-99c0-6095b98f432e.png)
![Screenshot_2019-03-12 Course Students - Arvid Marquardt(1)](https://user-images.githubusercontent.com/9896315/54187737-6afb7580-44d8-11e9-9bc1-def5aee46e57.png)
![Screenshot_2019-03-12 Grade - Arvid Marquardt(1)](https://user-images.githubusercontent.com/9896315/54187738-6b940c00-44d8-11e9-9228-b6d044105650.png)
![Screenshot_2019-03-12 Manage Schools - Arvid Marquardt(3)](https://user-images.githubusercontent.com/9896315/54187739-6b940c00-44d8-11e9-83c0-fb06cbd3c316.png)
![Screenshot_2019-03-12 Manage Schools - Arvid Marquardt](https://user-images.githubusercontent.com/9896315/54187740-6c2ca280-44d8-11e9-93b1-a998ac1cd585.png)
![Screenshot_2019-03-12 Promote Section Students - Arvid Marquardt(1)](https://user-images.githubusercontent.com/9896315/54187741-6c2ca280-44d8-11e9-871a-51148b27c2b4.png)
![Screenshot_2019-03-12 Students - Arvid Marquardt](https://user-images.githubusercontent.com/9896315/54187744-6cc53900-44d8-11e9-9ad4-c1acc58fe6a2.png)
