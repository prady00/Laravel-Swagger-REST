<?php
use App\Transformer\ItemTransformer;
use Symfony\Component\HttpKernel\Exception as SException;

use Swagger\Annotations as SWG;

/**
 * @package
 * @category
 *
 * @SWG\Resource(
 *   apiVersion="1.0.0",
 *   swaggerVersion="1.2",
 *   basePath="/",
 *   resourcePath="/items",
 *   description="Items APIs",
 *   @SWG\Produces("application/json")
 * )
 */

class ItemController extends ApiController
{

	 /**
     * @SWG\Api(path="/api/items",
     *   @SWG\Operation(
     *     method="GET",
     *     summary="list of items available",
     *     notes="",
     *     type="string",
     *     nickname="get-items",
     *     authorizations={},
     *     @SWG\ResponseMessage(code=200,message="Success"),
     *     @SWG\ResponseMessage(code=400,message="Bad Request"),
     *   )
     * )
     */
    
    /**
     * Orderts list
     *
     * @return JSON
     */

    public function lists() {
        
        $items = Item::all();

        return $this->respondWithCollection($items, new ItemTransformer());
        
    }
    
}
