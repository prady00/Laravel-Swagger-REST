<?php

namespace App\Transformer;

use Variant;
use League\Fractal\TransformerAbstract;


class VariantTransformer extends TransformerAbstract
{
	 /**
 	* Turn this item object into a generic array
 	*
 	* @return array
 	* 
 	*/
 	
 	public function transform(Variant $variant)
 	{
 		return [
 		'id' => (int) $variant->id,
 		'mrp' => $variant->mrp,
 		'quantity' => $variant->quantity,
 		'show_mrp' => $variant->show_mrp,
 		'sku_id' => $variant->sku_id,
 		'quantity_unit_name' => $variant->quantity_unit_name,
 		'image_url_original' => $variant->image_url_original,
 		'image_url_thumb' => $variant->image_url_thumb,
 		'image_url_small' => $variant->image_url_small,
 		'image_url_medium' => $variant->image_url_medium,
 		];
 	}

 } 