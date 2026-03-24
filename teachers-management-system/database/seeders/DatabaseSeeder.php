<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Attendance;
use App\Models\Salary;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@tms.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ]);

        // Create Sample Teachers
        $teacher1 = User::create([
            'name' => 'John Doe',
            'email' => 'john@tms.com',
            'password' => bcrypt('password123'),
            'role' => 'teacher',
        ]);

        $teacher2 = User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@tms.com',
            'password' => bcrypt('password123'),
            'role' => 'teacher',
        ]);

        $teacher3 = User::create([
            'name' => 'Mike Johnson',
            'email' => 'mike@tms.com',
            'password' => bcrypt('password123'),
            'role' => 'teacher',
        ]);

        // Create Teacher Profiles
        Teacher::create([
            'user_id' => $teacher1->id,
            'phone' => '123-456-7890',
            'address' => '123 Main St, City',
            'subject' => 'Mathematics',
            'joining_date' => '2023-01-15',
            'salary' => 3500,
        ]);

        Teacher::create([
            'user_id' => $teacher2->id,
            'phone' => '234-567-8901',
            'address' => '456 Oak Ave, Town',
            'subject' => 'English',
            'joining_date' => '2023-02-20',
            'salary' => 3200,
        ]);

        Teacher::create([
            'user_id' => $teacher3->id,
            'phone' => '345-678-9012',
            'address' => '789 Pine Rd, Village',
            'subject' => 'Science',
            'joining_date' => '2023-03-10',
            'salary' => 3400,
        ]);

        // Create Subjects
        $math = Subject::create([
            'name' => 'Mathematics',
            'code' => 'MATH101',
        ]);

        $english = Subject::create([
            'name' => 'English Literature',
            'code' => 'ENG101',
        ]);

        $science = Subject::create([
            'name' => 'Science',
            'code' => 'SCI101',
        ]);

        $history = Subject::create([
            'name' => 'History',
            'code' => 'HIS101',
        ]);

        // Assign Subjects to Teachers
        Teacher::find(1)->subjects()->attach($math->id);
        Teacher::find(2)->subjects()->attach([$english->id, $history->id]);
        Teacher::find(3)->subjects()->attach($science->id);

        // Create Sample Attendance Records
        Attendance::create([
            'teacher_id' => 1,
            'date' => now()->subDays(5),
            'status' => 'present',
        ]);

        Attendance::create([
            'teacher_id' => 1,
            'date' => now()->subDays(4),
            'status' => 'present',
        ]);

        Attendance::create([
            'teacher_id' => 2,
            'date' => now()->subDays(5),
            'status' => 'absent',
        ]);

        Attendance::create([
            'teacher_id' => 2,
            'date' => now()->subDays(4),
            'status' => 'leave',
        ]);

        Attendance::create([
            'teacher_id' => 3,
            'date' => now()->subDays(5),
            'status' => 'present',
        ]);

        // Create Sample Salary Records
        Salary::create([
            'teacher_id' => 1,
            'basic_salary' => 3500,
            'bonus' => 200,
            'deduction' => 100,
            'total_salary' => 3600,
            'payment_date' => now()->subMonth(),
        ]);

        Salary::create([
            'teacher_id' => 2,
            'basic_salary' => 3200,
            'bonus' => 150,
            'deduction' => 80,
            'total_salary' => 3270,
            'payment_date' => now()->subMonth(),
        ]);

        Salary::create([
            'teacher_id' => 3,
            'basic_salary' => 3400,
            'bonus' => 175,
            'deduction' => 90,
            'total_salary' => 3485,
            'payment_date' => now()->subMonth(),
        ]);
    }
}
