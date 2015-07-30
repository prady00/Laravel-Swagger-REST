<?php
use App\Transformer\OrderTransformer;
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
 *   resourcePath="/orders",
 *   description="Orders APIs",
 *   @SWG\Produces("application/json")
 * )
 */

class OrderController extends ApiController
{

    /**
     * @SWG\Api(path="/api/orders",
     *   @SWG\Operation(
     *     method="POST",
     *     summary="add a order",
     *     notes="",
     *     type="body",
     *     nickname="post-orders",
     *     authorizations={},
     *     @SWG\Parameter(
     *       name="body",
     *       description="order object that needs to be added",
     *       required=true,
     *       type="Order",
     *       paramType="body",
     *       allowMultiple=false
     *     ),
     *
     *     @SWG\ResponseMessage(code=201,message="Created"),
     *     @SWG\ResponseMessage(code=400,message="Bad Request")
     *   )
     * )
     */
    
    /**
     * Create new order
     *
     * @return JSON
     */
    public function add() {
        
        if (null == Input::json('user_id')) {
            throw new SException\BadRequestHttpException('USER_ID_REQUIRED');
        }

        $user = User::where('id', '=', Input::json('user_id'))->first();

        if($user == null){
            throw new SException\BadRequestHttpException('USER_DOES_NOT_EXISTS');
        }
          
        $order = new Order();

        $order->user_id = Input::json('user_id');
       
        $order->save();

        foreach (Input::json('items') as $key => $item) {
            $order->items()->attach($item['id']);
        }

        $response = Response::make(null, 201);
        $response->header('Location', '/api/orders/'.$order->id);
        return $response;

    }
    
    /**
     * @SWG\Api(path="/api/orders/{id}",
     *   @SWG\Operation(
     *     method="GET",
     *     summary="details of a order",
     *     notes="",
     *     type="string",
     *     nickname="get-order",
     *     authorizations={},
     *     @SWG\Parameter(
     *       name="id",
     *       description="id of order",
     *       required=true,
     *       type="string",
     *       paramType="path",
     *       allowMultiple=false
     *     ),
     *
     *     @SWG\ResponseMessage(code=200,message="Success"),
     *     @SWG\ResponseMessage(code=400,message="Bad Request")
     *   )
     * )
     */
    
    /**
     * Details of a order
     *
     * @return JSON
     */
    public function detail($id) {
        
        $order = Order::where('id', '=', $id)->first();
        if($order == null){
            return Response::make(null, 404);
        }
        return $this->respondWithItem($order, new OrderTransformer());
        
    }

    
    /**
     * @SWG\Api(path="/api/orders/{id}",
     *   @SWG\Operation(
     *     method="PUT",
     *     summary="update a order",
     *     notes="Send a PUT request along with required form parameters",
     *     type="string",
     *     nickname="put-orders",
     *     authorizations={},
     *     @SWG\Parameter(
     *       name="body",
     *       description="order object that needs to be update",
     *       required=true,
     *       type="Order",
     *       paramType="body",
     *       allowMultiple=false
     *     ),
     *     @SWG\Parameter(
     *       name="id",
     *       description="id of order",
     *       required=true,
     *       type="string",
     *       paramType="path",
     *       allowMultiple=false
     *     ),
     *
     *     @SWG\ResponseMessage(code=200,message="Success"),
     *     @SWG\ResponseMessage(code=400,message="Bad Request")
     *   )
     * )
     */
    
    /**
     * Update a order
     *
     * @return JSON
     */
    public function update($id) {

        if (null == Input::json('user_id')) {
            throw new SException\BadRequestHttpException('USER_ID_REQUIRED');
        }

        $user = User::where('id', '=', Input::json('user_id'))->first();

        if($user == null){
            throw new SException\BadRequestHttpException('USER_DOES_NOT_EXISTS');
        }

        $order = Order::where('id', '=', $id)->first();

        if($order == null){
            return Response::make(null, 404);
        }

        $order->items()->detach();

        foreach (Input::json('items') as $key => $item) {
            $order->items()->attach($item['id']);
        }

        return $this->respondWithItem($order, new orderTransformer());
        
    }

    /**
     * @SWG\Api(path="/api/orders/{id}",
     *   @SWG\Operation(
     *     method="DELETE",
     *     summary="delete a order",
     *     notes="Send a DELETE request along with required parameters",
     *     type="string",
     *     nickname="delete-orders",
     *     authorizations={},
     *     @SWG\Parameter(
     *       name="id",
     *       description="id of order",
     *       required=true,
     *       type="string",
     *       paramType="path",
     *       allowMultiple=false
     *     ),
     *
     *     @SWG\ResponseMessage(code=202,message="Accepted"),
     *     @SWG\ResponseMessage(code=400,message="Bad Request")
     *   )
     * )
     */

    /**
     * Delete order
     *
     * @return json
     */
    public function delete($id) {
        
        $order = Order::where('id', '=', $id)->first();

        if($order == null){
            return Response::make(null, 404);
        }

        order::destroy($id);

        return Response::make(null, 202);
    }
    
}
