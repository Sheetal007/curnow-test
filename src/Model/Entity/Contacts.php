<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;


 */
class Contacts extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
	 protected $_accessible = [
        "first_name"=> true,
		"last_name"=>true,
		"company"=>true,
		"address"=>true,
		"city"=>true,
		"county"=>true,
		"state_province"=>true,
		"zip"=>true,
		"phone_1"=>true,
		"phone_2"=>true,
		"email"=>true,
		"web"=>true
    ];
    
}
