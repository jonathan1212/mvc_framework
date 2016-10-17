<?php
namespace Controllers;

use Core\View;
use Core\Controller;
use Helpers\Request;
use Helpers\Url;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request as RS;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * Sample controller showing a construct and 2 methods and their typical usage.
 */
class Sample extends Controller
{
    protected $author;

    /**
     * Call the parent construct
     */
    public function __construct()
    {
        parent::__construct();
        //$this->author = new AuthorEntity;

    }

    /**
     * Define Index page title and load template files
     */
    public function index()
    {
        //json response
        $data = array(
            'mesage' => 'ok',
            'is_successful' => true,
            'data' => array('name' => 'jonathan', 'age' => '2')
        );

        //$x = new JsonResponse($data);
        //return $x->send();


        //quering
        $request = RS::createFromGlobals();
        //$request = new RS();
        $x = $request->query->all();

        //dump($x);
        //exit;


        //redirects
        $x = new RedirectResponse('/author/add');

        $x->send();

        //$this->render('/author/index',array('author' => $this->author->find('select * from author')));
    }


}
