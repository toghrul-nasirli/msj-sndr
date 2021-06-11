<?php

namespace Database\Seeders;

use App\Models\Credential;
use Illuminate\Database\Seeder;

class CredentialSeeder extends Seeder
{
    public function run()
    {
        Credential::create([
            'passed' => false
        ]);
    }
}
