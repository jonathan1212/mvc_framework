<?php

namespace Form;

use Zend\Form\Form as ZendForm;
use Zend\InputFilter\InputFilterProviderInterface;


class AuthorForm extends ZendForm implements InputFilterProviderInterface
{
	public function __construct()
    {
        parent::__construct('author');
    
        $this->setAttribute('method', 'post');
        $this->setAttribute('class','form-horizontal col-md-6');

        //$this->setHydrator(new DoctrineHydrator($this->entityManager));
    	
        //firstname
    	$this->add(array(
    		'type' => 'text',
            'name' => 'firstname',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),

        ));
        //lastname
        $this->add(array(
            'type' => 'text',
            'name' => 'lastname',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
        ));
        //email
        $this->add(array(
            'type' => 'text',
            'name' => 'email',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
        ));
        //passowrd
        $this->add(array(
            'type' => 'password',
            'name' => 'password',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
        ));
        //repassword
        $this->add(array(
            'type' => 'password',
            'name' => 're-password',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
        ));
    }


    public function getInputFilterSpecification()
    {
        return array(
            'firstname' => array(
                'required' => true,
                'filters' => array( 
                    array('name' => 'StripTags'), 
                    array('name' => 'StringTrim'), 
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'max' => 40,
                        ),
                    ),
                ),
            ),
            'lastname' => array(
                'required' => true,
                'filters' => array( 
                    array('name' => 'StripTags'), 
                    array('name' => 'StringTrim'), 
                ),
            ),
            'email' => array(
                'required' => true,
                'filters' => array( 
                    array('name' => 'StripTags'), 
                    array('name' => 'StringTrim'), 
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'max' => 40,
                        ),
                    ),
                    array(
                        'name' => 'EmailAddress',
                    ),
                ),
            ),

            'password' => array(
                'required' => true,
                'filters' => array( 
                    array('name' => 'StripTags'), 
                    array('name' => 'StringTrim'), 
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'max' => 40,
                        ),
                    ),
                ),
            ),

            're-password' => array(
                'required' => true,
                'filters' => array( 
                    array('name' => 'StripTags'), 
                    array('name' => 'StringTrim'), 
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'max' => 40,
                        ),
                    ),
                    array(
                        'name' => 'Identical',
                        'options' => array(
                            'token' => 'password' //I have tried $_POST['password'], but it doesnt work either
                        )
                    ),
                ),
            ),

        );
    }   

}