<?php
namespace Multiple\Frontend\Models;
use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Validation\Validator\PresenceOf;
class Users extends Model
{
	public $id;

	public $name;

	public $email;
	
	 public function validation()
    {
        $validator = new Validation();
		$validator->add(
            "name",
            new PresenceOf(
                [
                    "message" => "The name is required",
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
        $validator->add(
            "email",
            new PresenceOf(
                [
                    "message" => "The email is required",
                ]
            )
        );
        $validator->add(
            'email', 
            new EmailValidator([
                'model' => $this,
                'message' => 'Please enter a correct email address'
            ])
        );

        $validator->add(
            'email',
            new UniquenessValidator([
                'model' => $this,
                'message' => 'Sorry, That email is already taken',
            ])
        );

        return $this->validate($validator);
        //  return !$this->validationHasFailed();
    }
}
