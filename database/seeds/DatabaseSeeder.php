<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SchoolsTableSeeder::class);
        $this->call(DepartmentTableSeeder::class);
        $this->call(ClassesTableSeeder::class);
        $this->call(SectionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(SyllabusesTableSeeder::class);
        $this->call(NoticesTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(FeesTableSeeder::class);
        $this->call(HomeworksTableSeeder::class);
        $this->call(RoutinesTableSeeder::class);
        $this->call(NotificationsTableSeeder::class);
        $this->call(ExamsTableSeeder::class);
        $this->call(GradesystemsTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(GradesTableSeeder::class);
        $this->call(ExamForClassesTableSeeder::class);
        $this->call(AttendancesTableSeeder::class);
        $this->call(FeedbacksTableSeeder::class);
        $this->call(FormsTableSeeder::class);
        $this->call(BooksTableSeeder::class);
        $this->call(MessagesTableSeeder::class);
        $this->call(FaqsTableSeeder::class);
        $this->call(IssuedbooksTableSeeder::class);
        $this->call(AccountsTableSeeder::class);
        $this->call(AccountSectorsTableSeeder::class);
        $this->call(StudentinfosTableSeeder::class);
        $this->call(StudentboardexamsTableSeeder::class);
    }
}
