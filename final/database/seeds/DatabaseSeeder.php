<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('job_post_status')->insert([
            [
                'id' => 0,
                'name' => 'open'
            ], [
                'id' => 1,
                'name' => 'filled'
            ], [
                'id' => 2,
                'name' => 'removed'
            ]
        ]);

        DB::disconnect();


        DB::table('application_status')->insert([
            [
                'id' => 0,
                'name' => 'being reviewed'
            ], [
                'id' => 1,
                'name' => 'accepted'
            ], [
                'id' => 2,
                'name' => 'denied'
            ]
        ]);

        DB::disconnect();

        DB::table('job_categories')->insert([
            [
                'id' => 0,
                'name' => 'Administrative Jobs'
            ],
            [
                'id' => 1,
                'name' => 'Animal Care Jobs'
            ],
            [
                'id' => 2,
                'name' => 'Art Jobs'
            ],
            [
                'id' => 3,
                'name' => 'Building Maintenance Jobs'
            ],
            [
                'id' => 4,
                'name' => 'Business Operations Jobs'
            ],
            [
                'id' => 5,
                'name' => 'Communications Jobs'
            ],
            [
                'id' => 6,
                'name' => 'Computer Jobs'
            ],
            [
                'id' => 7,
                'name' => 'Construction Jobs'
            ],
            [
                'id' => 8,
                'name' => 'Education Jobs'
            ],
            [
                'id' => 9,
                'name' => 'Engineering Jobs'
            ],
            [
                'id' => 10,
                'name' => 'Entertainment Jobs'
            ],
            [
                'id' => 11,
                'name' => 'Executive Jobs'
            ],
            [
                'id' => 12,
                'name' => 'Extraction Jobs'
            ],
            [
                'id' => 13,
                'name' => 'Farming Jobs'
            ],
            [
                'id' => 14,
                'name' => 'Finance Jobs'
            ],
            [
                'id' => 15,
                'name' => 'Food Service Jobs'
            ],
            [
                'id' => 16,
                'name' => 'Healthcare Jobs'
            ],
            [
                'id' => 17,
                'name' => 'Healthcare Support Jobs'
            ],
            [
                'id' => 18,
                'name' => 'Healthcare Technology Jobs'
            ],
            [
                'id' => 19,
                'name' => 'Legal Jobs'
            ],
            [
                'id' => 20,
                'name' => 'Library Jobs'
            ],
            [
                'id' => 21,
                'name' => 'Life Science Jobs'
            ],
            [
                'id' => 22,
                'name' => 'Maintenance Jobs'
            ],
            [
                'id' => 23,
                'name' => 'Management Jobs'
            ],
            [
                'id' => 24,
                'name' => 'Math Jobs'
            ],
            [
                'id' => 25,
                'name' => 'Media Jobs'
            ],
            [
                'id' => 26,
                'name' => 'Military Jobs'
            ],
            [
                'id' => 27,
                'name' => 'Physical Science Jobs'
            ],
            [
                'id' => 28,
                'name' => 'Production Jobs'
            ],
            [
                'id' => 29,
                'name' => 'Protective Services Jobs'
            ],
            [
                'id' => 30,
                'name' => 'Sales Jobs'
            ],
            [
                'id' => 31,
                'name' => 'Service Jobs'
            ],
            [
                'id' => 32,
                'name' => 'Social Science Jobs'
            ],
            [
                'id' => 33,
                'name' => 'Social Service Jobs'
            ],
            [
                'id' => 34,
                'name' => 'Sports Jobs'
            ],
            [
                'id' => 35,
                'name' => 'Transportation Jobs'
            ]
        ]);
    }
}

