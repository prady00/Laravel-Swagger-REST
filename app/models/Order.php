<?php

/**
 * @package
 * @category
 * @subpackage
 *
 * @SWG\Model(id="Order")
 */

class Order extends Eloquent {


    /**
     * @SWG\Property(
     *   name="user_id",
     *   type="integer",
     *   format="int64"
     * )
     */

    /**
     * @SWG\Property(
     *   name="items",
     *   type="array",
     *   @SWG\Items("Item")
     * )
     */

	public function items()
    {
    	return $this->belongsToMany('Item', 'orders_items');
    }
	
}


/**
 * @package
 * @category
 * @subpackage
 *
 * @SWG\Model(id="Item")
 */

class Item extends Eloquent {


    /**
     * @SWG\Property(
     *   name="id",
     *   type="integer",
     *   format="int64"
     * )
     */

    /**
     * @SWG\Property(
     *   name="name",
     *   type="string"
     * )
     */

    /**
     * @SWG\Property(
     *   name="price",
     *   type="string"
     * )
     */

}





