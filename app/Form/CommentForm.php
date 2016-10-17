<?php

namespace Form;

use Zend\Form\Form as ZendForm;
use Zend\InputFilter\InputFilterProviderInterface;


class CommentForm extends ZendForm implements InputFilterProviderInterface
{
	public function __construct()
    {
        parent::__construct('author');
    
        $this->setAttribute('method', 'post');
        $this->setAttribute('class','form-horizontal col-md-6');

        //$this->setHydrator(new DoctrineHydrator($this->entityManager));
    	
        //content
        $this->add(array(
            'type' => 'Zend\Form\Element\Textarea',
            'name' => 'content',
            'attributes' => array(
                'class' => 'form-control',
            ),
        ));
        //date
        $this->add(array(
            'type' => 'Zend\Form\Element\Date',
            'name' => 'date',
            'attributes' => array(
                'class' => 'form-control',
            ),
        ));
        //author
        $this->add(array(
            'type' => 'text',
            'name' => 'author',
            'attributes' => array(
                'class' => 'form-control',
            ),
        ));
    }


    public function getInputFilterSpecification()
    {
        return array(
            'content' => array(
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
                        ),
                    ),
                ),
            ),

            'date' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'Date',
                    ),
                ),
            ),

            'author' => array(
                'required' => true,
                'filters' => array( 
                    array('name' => 'StripTags'), 
                    array('name' => 'StringTrim'), 
                ),
            ),
            


        );
    }   

}