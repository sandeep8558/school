<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Branch;
use App\Models\Designation;

class SchoolBootstrapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. Default Main Branch
        Branch::updateOrCreate(
            ['email' => 'mainbranch@schoolmanager.com'],
            [
                'name'       => 'Main Branch',
                'address'    => 'Plot No. 1, Education Hub, Andheri East',
                'city'       => 'Mumbai',
                'pincode'    => '400069',
                'state'      => 'Maharashtra',
                'country'    => 'India',
                'lat'        => 19.1136,
                'lng'        => 72.8697,
                'phone'      => '9664588677',
                'curriculum' => 'CBSE',
            ]
        );

        // 2. Staff Designations
        $designations = [
            'Principal',
            'Vice Principal',
            'Head Mistress',
            'Academic Coordinator',
            'Senior Teacher',
            'Assistant Teacher',
            'Sports Coach',
            'Librarian',
            'Lab Assistant',
            'Accountant',
            'Admin Executive',
            'Counselor',
        ];

        foreach ($designations as $designation) {
            Designation::updateOrCreate(
                ['designation' => $designation],
                ['designation' => $designation]
            );
        }
    }
}
