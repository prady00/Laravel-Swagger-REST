<?php
use Swagger\Annotations as SWG;

/**
 * @package
 * @category
 * @subpackage
 *
 * @SWG\Model(id="Variant")
 */

class Variant extends Eloquent  {

	//protected $table = 'product_variant';

	/**
     * @SWG\Property(
     *   name="name",
     *   type="string"
     * )
     */

    public function product() {
        return $this->belongsTo('Product');
    }
}