<?php

namespace Form;

use Zend\Form\Form as ZendForm;
use Zend\InputFilter\InputFilterProviderInterface;
use Models\Entity\Post;
use Zend\Validator\File;

class PostForm extends ZendForm implements InputFilterProviderInterface
{
    protected $isNew = false;

	public function __construct()
    {
        parent::__construct('post');
    
        $this->setAttribute('method', 'post');
        $this->setAttribute('class','form-horizontal col-md-6');

        //$this->setHydrator(new DoctrineHydrator($this->entityManager));
    	
        //author
    	$this->add(array(
    		'type' => 'Zend\Form\Element\Select',
            'name' => 'author_id',
            'options' => array(
                'label' => 'Select Author',
                'empty_option' => 'Please choose the author',
                'value_options' => $this->getAuthor()
             )
        ));

        //title
        $this->add(array(
            'type' => 'text',
            'name' => 'title',
            'attributes' => array(
                'class' => 'form-control',
            ),
        ));
        //content
        $this->add(array(
            'type' => 'Zend\Form\Element\Textarea',
            'name' => 'content',
            'attributes' => array(
                'class' => 'form-control',
            ),
        ));
        //filename
        $this->add(array(
            'type' => 'Zend\Form\Element\File',
            'name' => 'filename',
            'attributes' => array(
                'class' => 'form-control',
            ),
        ));
        /*//datecreated
        $this->add(array(
            'type' => 'Zend\Form\Element\Date',
            'name' => 'date_created',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
        ));*/

        //dateupdated
        $this->add(array(
            'type' => 'Zend\Form\Element\Date',
            'name' => 'date_updated',
            'attributes' => array(
                'class' => 'form-control',
            ),
        ));

        //status
        $this->add(array(
            'type' => 'Zend\Form\Element\Radio',
            'name' => 'status',
            'attributes' => array(
                'class' => 'form-control',
                'value' => '0',
            ),
            'options' => array( 
                'label' => 'Radio Label', 
                'value_options' => array(
                    '0' => 'In Active', 
                    '1' => 'Active', 
                ),
            ),
        ));

    }


    public function getInputFilterSpecification()
    {
        return array(
            'title' => array(
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
            ),

            'content' => array(
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
            ),

            'date_updated' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'Date',
                    ),
                ),
            ),

            'filename' => array(
                'required' => false,
                //'allowEmpty' => true,
                'type'       => 'Zend\InputFilter\FileInput',
                /*'filters' => array(
                    array(
                        'name' => "Zend\Filter\File\RenameUpload",
                        'options' => array('target' => "app/templates/default/images" , 'randomize' => true, 'use_upload_name' => true, 'use_upload_extension' => true )
                    ),
                    //array('name' => 'filelowercase'),
                ),*/
                'validators' => array(
                    /*array('name' => 'filesize', 'options' => array(
                        'min' => 4000, 'max' => 5000,
                    )),*/
                    //array('name' => 'fileupload'),

                    //array('name' => 'File\IsImage'),
                    //array('name' => 'File\UploadFile'),
                ),
            ),



        );
    }


    protected function getAuthor()
    {
        $post = new Post;
        $author = $post->getDb()->select('select * from author');

        $data = array();

        foreach ($author as $key => $a) {
            $data[$a->id] = $a->firstname . ' ' . $a->lastname; 
        }

        return $data;
    }

    protected function setIsNew($v)
    {
        $this->isNew = $v;
    }   

}