<?php
namespace Food\Form;

use Zend\Form\Form;

class UserForm extends Form
{
	public function __construct($name = null)
	{
		parent::__construct('user');
		$this->setAttribute('method', 'post');
		$this->add(array(
			'name'=>'id',
			'type'=>'Hidden',
		));
		$this->add(array(
			'name'=> 'username',
			'type' => 'Text',
			'options'=>array(
				'label'=> 'Username:',
			),
		));
		$this->add(array(
			'name'=> 'password',
			'type' => 'Password',
			'options'=>array(
				'label'=> 'Password: ',
			),
		));
		$this->add(array(
			'name'=>'submit',
			'type'=>'submit',
			'attributes'=>array(
				'value'=>'Go',
				'id'=>'submitbutton',
			),
		));

	}
}
