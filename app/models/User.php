<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Swagger\Annotations as SWG;

/**
 * @package
 * @category
 * @subpackage
 *
 * @SWG\Model(id="User")
 */

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
     * @SWG\Property(
     *   name="email",
     *   type="string"
     * )
     */

	/**
     * @SWG\Property(
     *   name="password",
     *   type="string"
     * )
     */

	/**
     * @SWG\Property(
     *   name="first_name",
     *   type="string"
     * )
     */

	/**
     * @SWG\Property(
     *   name="last_name",
     *   type="string",
     *   defaultValue="love"
     * )
     */

     
     /**
     * @SWG\Property(
     *   name="contact",
     *   type="string"
     * )
     */

     /**
     * @SWG\Property(
     *   name="address",
     *   type="string"
     * )
     */

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');
	
	
	
}







