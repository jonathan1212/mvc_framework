<?php
namespace Controllers;

use Core\View;
use Core\Controller;
use Helpers\Request;
use Helpers\Url;

use Models\Entity\Author as AuthorEntity;
use Form\AuthorForm;

use Zend\Form\Form;

/**
 * Sample controller showing a construct and 2 methods and their typical usage.
 */
class Author extends Controller
{
    protected $author;

    /**
     * Call the parent construct
     */
    public function __construct()
    {
        parent::__construct();
        $this->author = new AuthorEntity;

    }

    /**
     * Define Index page title and load template files
     */
    public function index()
    {
        $this->render('/author/index',array('author' => $this->author->find('select * from author')));
    }

    public function add()
    {
        $form = new AuthorForm();

        if (Request::isPost()) {
            $form->setData($_POST);

            if ($form->isValid()) {
                
                $this->processForm($_POST);

                Url::redirect('author');
            }

        } 

        $this->render('author/add',array('form' => $form));
    }

    public function edit()
    {
        $form = new AuthorForm();
        $id = Url::getLastSegment();
        
        $author = $this->author->find('select * from author where id = :id', array('id' => $id ));
        
        if (Request::isPost()) {
            
            $form->setData($_POST);

            if ($form->isValid()) {
                
                $this->processEditForm($_POST,$id);

                Url::redirect('author');
            }

        } else {
            $form->bind($author[0]); 
        }

        $this->render('author/edit',array('form' => $form));

    }

    protected function processForm($params)
    {
        $this->author->getDb()->insert('author',array(
            'firstname' => $params['firstname'],
            'lastname' => $params['lastname'],
            'email' => $params['email'],
            'password' => $params['password']
        ));
    }

    protected function processEditForm($params,$id)
    {
        $this->author->getDb()->update('author',array(
            'firstname' => $params['firstname'],
            'lastname' => $params['lastname'],
            'email' => $params['email'],
            'password' => $params['password']
        ), array('id'=> $id));
    }

    /**
     * Define Subpage page title and load template files
     */

    protected function render($path,$params)
    {

        $data['title'] = $this->language->get('subpage_text');
        $data['welcome_message'] = $this->language->get('subpage_message');

        View::renderTemplate('header', $data);
        View::render($path, $params);
        View::renderTemplate('footer', $data);
    }
}
