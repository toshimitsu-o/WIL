<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attributes = [
            [
                'id' => 1,
                'name' => 'Software Developer',
                'attributetype' => 'role',
            ],
            [
                'id' => 2,
                'name' => 'Project Manager',
                'attributetype' => 'role',
            ],
            [
                'id' => 3,
                'name' => 'Business Analyst',
                'attributetype' => 'role',
            ],
            [
                'id' => 4,
                'name' => 'Tester',
                'attributetype' => 'role',
            ],
            [
                'id' => 5,
                'name' => 'Client Liaison',
                'attributetype' => 'role',
            ],
            [
                'id' => 6,
                'name' => 'Software',
                'attributetype' => 'industry',
            ],
            [
                'id' => 7,
                'name' => 'Telecommunication',
                'attributetype' => 'industry',
            ],
            [
                'id' => 8,
                'name' => 'Healthcare',
                'attributetype' => 'industry',
            ],
            [
                'id' => 9,
                'name' => 'Entertainment',
                'attributetype' => 'industry',
            ],
            [
                'id' => 10,
                'name' => 'Education',
                'attributetype' => 'industry',
            ],
            [
                'id' => 11,
                'name' => 'JavaScript',
                'attributetype' => 'skill',
            ],
            [
                'id' => 12,
                'name' => 'PHP',
                'attributetype' => 'skill',
            ],
            [
                'id' => 13,
                'name' => 'Python',
                'attributetype' => 'skill',
            ],
            [
                'id' => 14,
                'name' => 'Agile Methodologies',
                'attributetype' => 'skill',
            ],
            [
                'id' => 15,
                'name' => 'Data Analysis',
                'attributetype' => 'skill',
            ],
            [
                'id' => 16,
                'name' => 'Risk Analysis',
                'attributetype' => 'skill',
            ],
        ];
        DB::table('attributes')->insert($attributes);
    }
}
