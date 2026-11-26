<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            // Branding & School Profile
            'School Name'           => 'School Manager Academy',
            'Tag Line'              => 'Excellence in Education',
            'Logo'                  => '/ppsd.png',
            'Favicon'               => '/ppsd.png',

            // Contact Details
            'Address'               => 'Plot No. 1, Education Hub, Andheri East',
            'City'                  => 'Mumbai',
            'Pincode'               => '400069',
            'State'                 => 'Maharashtra',
            'Country'               => 'India',
            'Latitude'              => '19.1136',
            'Longitude'             => '72.8697',
            'Email Address'         => 'sandeep198558@gmail.com',
            'Phone Number'          => '9664588677',

            // Email API
            'Mail Domain'           => env('MAILGUN_DOMAIN', 'cvleena.com'),
            'Mail Secret'           => env('MAILGUN_SECRET', ''),
            'Mail From Name'        => env('MAIL_FROM_NAME', 'School Manager'),
            'Mail From Address'     => env('MAIL_FROM_ADDRESS', 'vainkho.com@gmail.com'),

            // Razorpay API
            'Razorpay Kay Id'       => env('RAZORPAY_KEY_ID', ''),
            'Razorpay Kay Secret'   => env('RAZORPAY_KEY_SECRET', ''),

            // General Settings
            'Is Admission Open'     => 'Yes',

            // Admission Evaluation Ratings (Rating 1 .. Rating 12)
            'Rating 1'              => 'Student Interaction',
            'Rating 2'              => 'Parent Interaction',
            'Rating 3'              => 'Academic Readiness',
            'Rating 4'              => 'Communication Skills',
            'Rating 5'              => 'General Awareness',
            'Rating 6'              => 'Proximity to School',
            'Rating 7'              => 'Sibling in School',
            'Rating 8'              => 'Alumni Ward',
            'Rating 9'              => 'Co-Curricular Interest',
            'Rating 10'             => 'Document Verification',
            'Rating 11'             => 'Special Consideration',
            'Rating 12'             => 'Principal Remark Score',
        ];

        foreach ($settings as $key => $val) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['val' => $val]
            );
        }
    }
}
