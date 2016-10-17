<?php
namespace Multiple\Backend\Models;
use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Validation\Validator\PresenceOf;
class Users extends Model
{
	public $id;

	public $username;
	
	public function getSource()
	{
		return 'admin';
	}
	
	 public function validation()
    {
        $validator = new Validation();
		$validator->add(
            "username",
            new PresenceOf(
                [
                    "message" => "The username is required",
                ]
            )
        );
        $validator->add(
            "password",
            new PresenceOf(
                [
                    "message" => "The password is required",
                ]
            )
        );
       

        return $this->validate($validator);
        //  return !$this->validationHasFailed();
    }
}
