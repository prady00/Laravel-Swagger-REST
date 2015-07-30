<?php
use App\Transformer\UserTransformer;
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
 *   resourcePath="/users",
 *   description="Users APIs",
 *   @SWG\Produces("application/json")
 * )
 */
class UserController extends ApiController
{
    
    /**
     * @SWG\Api(path="/api/users",
     *   @SWG\Operation(
     *     method="POST",
     *     summary="add a user",
     *     notes="",
     *     type="body",
     *     nickname="post-users",
     *     authorizations={},
     *     @SWG\Parameter(
     *       name="body",
     *       description="User object that needs to be added",
     *       required=true,
     *       type="User",
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
     * Create new user
     *
     * @return JSON
     */
    public function add() {
        
        if (null == Input::json('first_name')) {
            throw new SException\BadRequestHttpException('FIRST_NAME_REQUIRED');
        }

        if (null == Input::json('last_name')) {
            throw new SException\BadRequestHttpException('LAST_NAME_REQUIRED');
        }
        
        if (null == Input::json('email')) {
            throw new SException\BadRequestHttpException('EMAIL_REQUIRED');
        }
        
        if (null == Input::json('password')) {
            throw new SException\BadRequestHttpException('PASSWORD_REQUIRED');
        }

        if (null == Input::json('contact')) {
            throw new SException\BadRequestHttpException('CONTACT_REQUIRED');
        }

        if (null == Input::json('address')) {
            throw new SException\BadRequestHttpException('ADDRESS_REQUIRED');
        }

        if(User::where('email', '=', Input::get('email'))->exists()){
           throw new SException\ConflictHttpException('EMAIL_ALREADY_EXISTS');
        }
          
        $user = new User();

        $user->first_name = Input::json('first_name');
        $user->last_name  = Input::json('last_name');
        $user->email      = Input::json('email');
        $user->password   = Input::json('password');
        $user->contact    = Input::json('contact');
        $user->address    = Input::json('address');
        
        $user->save();

        $response = Response::make(null, 201);
        $response->header('Location', '/api/users/'.$user->id);
        return $response;

    }
    
    /**
     * @SWG\Api(path="/api/users/{id}",
     *   @SWG\Operation(
     *     method="GET",
     *     summary="details of a user",
     *     notes="",
     *     type="string",
     *     nickname="get-user",
     *     authorizations={},
     *     @SWG\Parameter(
     *       name="id",
     *       description="id of user",
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
     * Details of a user
     *
     * @return JSON
     */
    public function detail($id) {
        
        $user = User::where('id', '=', $id)->first();
        if($user == null){
            return Response::make(null, 404);
        }
        return $this->respondWithItem($user, new UserTransformer());
        
    }
    
    /**
     * @SWG\Api(path="/api/users/{id}",
     *   @SWG\Operation(
     *     method="PUT",
     *     summary="update a user",
     *     notes="Send a PUT request along with required form parameters",
     *     type="string",
     *     nickname="put-users",
     *     authorizations={},
     *     @SWG\Parameter(
     *       name="body",
     *       description="User object that needs to be update",
     *       required=true,
     *       type="User",
     *       paramType="body",
     *       allowMultiple=false
     *     ),
     *     @SWG\Parameter(
     *       name="id",
     *       description="id of user",
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
     * Update a user
     *
     * @return JSON
     */
    public function update($id) {

        if (null == Input::json('first_name')) {
            throw new SException\BadRequestHttpException('FIRST_NAME_REQUIRED');
        }

        if (null == Input::json('last_name')) {
            throw new SException\BadRequestHttpException('LAST_NAME_REQUIRED');
        }
        
        if (null == Input::json('email')) {
            throw new SException\BadRequestHttpException('EMAIL_REQUIRED');
        }
        
        if (null == Input::json('password')) {
            throw new SException\BadRequestHttpException('PASSWORD_REQUIRED');
        }

        if (null == Input::json('contact')) {
            throw new SException\BadRequestHttpException('CONTACT_REQUIRED');
        }

        if (null == Input::json('address')) {
            throw new SException\BadRequestHttpException('ADDRESS_REQUIRED');
        }

        $user = User::where('id', '=', $id)->first();

        if($user == null){
            return Response::make(null, 404);
        }

        $user->email = Input::json('email');
        $user->password = Input::json('password');
        $user->first_name = Input::json('first_name');
        $user->last_name = Input::json('last_name');
        $user->contact = Input::json('contact');
        $user->address = Input::json('address');

        $user->save();

        return $this->respondWithItem($user, new UserTransformer());
        
    }

    /**
     * @SWG\Api(path="/api/users/{id}",
     *   @SWG\Operation(
     *     method="DELETE",
     *     summary="delete a user",
     *     notes="Send a DELETE request along with required parameters",
     *     type="string",
     *     nickname="delete-users",
     *     authorizations={},
     *     @SWG\Parameter(
     *       name="id",
     *       description="id of user",
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
     * Delete user
     *
     * @return json
     */
    public function delete($id) {
        
        $user = User::where('id', '=', $id)->first();

        if($user == null){
            return Response::make(null, 404);
        }

        User::destroy($id);

        return Response::make(null, 202);
    }
    
}
