<?php

namespace App\Transformer;

use User;
use League\Fractal\TransformerAbstract;


class UserTransformer extends TransformerAbstract
{

	/**
     * List of resources to automatically include
     *
     * @var array
     */
    
    /**
 	* Turn this item object into a generic array
 	*
 	* @return array
 	* 
 	*/
 	
 	public function transform(User $user)
 	{

 		return [
 		'id' => (int) $user->id,
 		'email' => $user->email,
 		'first_name' => $user->first_name,
 		'last_name' => $user->last_name,
 		'contact' => $user->contact,
 		'address' => $user->address,
 		];

 	}

 } 