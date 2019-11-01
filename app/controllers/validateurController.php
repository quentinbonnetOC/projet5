<?php
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;

class Validateur
{
    public function initialize()
    {
        $validation = new Validateur();

        $validation->add(
            '',
            new PresenceOf(
                [
                    'message' => ''
                ]
            )
        )
    }
}