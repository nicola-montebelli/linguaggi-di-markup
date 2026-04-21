<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $students = [
            [
                'name' => 'Mario',
                'surname' => 'Rossi',
                'mobile' => '1234567890',
                'email' => 'mario.rossi@example.com',
                'birth_date' => '2000-01-01',
            ],
            [
                'name' => 'Luigi',
                'surname' => 'Verdi',
                'mobile' => '0987654321',
                'email' => 'luigi.verdi@example.com',
                'birth_date' => '2001-02-02',
            ],
            [
                'name' => 'Giulia',
                'surname' => 'Bianchi',
                'mobile' => '5555555555',
                'email' => 'giulia.bianchi@example.com',
                'birth_date' => '2002-03-03',
            ],
            [
                'name' => 'Francesca',
                'surname' => 'Neri',
                'mobile' => '4444444444',
                'email' => 'francesca.neri@example.com',
                'birth_date' => '2003-04-04',
            ],
            [
                'name' => 'Alessandro',
                'surname' => 'Gialli',
                'mobile' => '3333333333',
                'email' => 'alessandro.gialli@example.com',
                'birth_date' => '2004-05-05',
            ],
        ];

        foreach ($students as $student) {
            DB::table('students')->insert($student);
        }
    }
}
