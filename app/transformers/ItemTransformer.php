<?php

namespace App\Transformer;

use Item;
use League\Fractal\TransformerAbstract;


class ItemTransformer extends TransformerAbstract
{

    /**
 	* Turn this item object into a generic array
 	*
 	* @return array
 	* 
 	*/
 	
 	public function transform(Item $item)
 	{

 		return [
 		'id' => (int) $item->id,
 		'price' => $item->price,
 		'name' => $item->name,
 		];

 	}

 } 