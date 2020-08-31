<?php
declare(strict_types=1);

use Migrations\AbstractSeed;
use Phinx\Migration\AbstractMigration;
use Faker\Factory as Faker;

/**
 * Contacts seed.
 */
class ContactsSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run()
    {
		
		$faker = Faker::create();
		for($i =0 ; $i< 5000; $i++){ 
        $data[] = [
		"first_name"=> $faker->firstName,
		"last_name"=>$faker->lastName,
		"company"=>$faker->company,
		"address"=>$faker->address,
		"city"=>$faker->city,
		"county"=>$faker->country,
		"state_province"=>$faker->state,
		"zip"=>$faker->postcode,
		"phone_1"=>$faker->phoneNumber,
		"phone_2"=>$faker->phoneNumber,
		"email"=>$faker->email,
		"web"=>$faker->domainName,
		];
		
		}

        $table = $this->table('contacts');
        $table->insert($data)->save();
    }
}
