<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

//        $this->call('UserTableSeeder');
//        $this->call('ConsumerTableSeeder');
//        $this->call('TokenTableSeeder');
//        $this->call('ProvinceTableSeeder');
//        $this->call('DistrictTableSeeder');
//        $this->call('NeighborhoodTableSeeder');
        $this->call('SuburbTableSeeder');

        Model::reguard();
    }
}

class UserTableSeeder extends Seeder
{
    public function run()
    {
        \App\User::create(
            [
                'name' => 'Burak Bolat',
                'email' => 'burak@burakbolat.com',
                'password' => bcrypt('password'),
            ]
        );
    }
}

class ConsumerTableSeeder extends Seeder
{
    public function run()
    {
        $user = \App\User::findOrNew(1);

        $consumer = new \App\Consumer();
        $consumer->name = 'Fusce commodo aliquam arcu';
        $consumer->description = 'In hac habitasse platea dictumst. Phasellus ullamcorper ipsum rutrum nunc. Nullam sagittis.';
        $consumer->website = 'http://wwww.domain.tld';
        $consumer->api_key = 'NBlJDwLpgdfRV6SYMtggI467u';
        $consumer->api_secret = '90jEZxel60MPtdrh51ZSMaN2C9JwzNDZl5UU7txS9C68Ss3iJ8';

        $user->consumers()->save($consumer);
    }
}

class TokenTableSeeder extends Seeder
{
    public function run()
    {
        $consumer = \App\Consumer::findOrNew(1);

        $token = new \App\Token();

        $token->access_key = 'r5CqL1RGPVSAXkgFKHT5MCyJUNB5FuNxND7tQEIW';
        $token->access_secret = 'ZDTAQfGQSmODZie4QkjOzvRR0rcpBktFEDdq2nbh';
        $token->expired_at = \Carbon\Carbon::now()->addMinutes(\App\Token::TOKEN_EXPIRED);

        $consumer->token()->save($token);
    }
}

class ProvinceTableSeeder extends Seeder
{
    public function run()
    {
        exec("mysql -u root -p postcode < ".storage_path('app/postcode_provinces_data.sql'));
    }
}

class DistrictTableSeeder extends Seeder
{
    public function run()
    {
        exec("mysql -u root -p postcode < ".storage_path('app/postcode_districts_data.sql'));
    }
}

class NeighborhoodTableSeeder extends Seeder
{
    public function run()
    {
        exec("mysql -u root -p postcode < ".storage_path('app/postcode_neighborhoods_data.sql'));
    }
}

class SuburbTableSeeder extends Seeder
{
    public function run()
    {
        exec("mysql -u root -p postcode < ".storage_path('app/postcode_suburbs_data.sql'));
    }
}
