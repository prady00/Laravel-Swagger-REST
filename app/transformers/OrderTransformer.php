<?php

namespace App\Transformer;

use Order;
use League\Fractal\TransformerAbstract;


class OrderTransformer extends TransformerAbstract
{
	/**
 	* Turn this item object into a generic array
 	*
 	* @return array
 	* 
 	*/
 	
 	public function transform(Order $order)
 	{
 		return [
 		'id' => (int) $order->id,
 		'user_id' => $order->user_id,
 		'items' => $this->includeOrderItems($order->items),
 		];
 	}


 	/**
     * Include Items in Order
     *
     * @param products 
     * @return \League\Fractal\Resource\Item
     */
    public function includeOrderItems($items)
    {
    	$_items = array();

        if ($items == null){
        	return null;
        }

        foreach ($items as $item) {

        	$_items[] = array( 'id' => $item->id,
        						 'name' => $item->name,
        						 'price' => $item->price,
     						 );
        }

        return $_items;
        
    }

 } 