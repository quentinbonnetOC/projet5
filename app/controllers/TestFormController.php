<?php
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\File;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;

class TestFormController extends Form
{

    public function indexAction()
    {
        $form = new Form();

$name = new Text(
        'name'
    );
$name->addValidator(
    new PresenceOf(
        [
            'message' => 'The name is required',
        ]
    )
);
$form->add($name);

$form->add(
    new Text(
        'telephone'
    )
);

$form->add(
    new Select(
        'telephoneType',
        [
            'H' => 'Home',
            'C' => 'Cell',
        ]
    )
);

$this->view->form = $form;

    }

}

