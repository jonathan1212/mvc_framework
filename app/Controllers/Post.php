<?php
namespace Controllers;

use Core\View;
use Core\Controller;
use Helpers\Request;
use Helpers\Url;
use Helpers\Paginator;

use Models\Entity\Post as PostEntity;
use Models\Entity\Comment as CommentEntity;

use Form\PostForm;
use Form\CommentForm;

use Zend\Form\Form;

/**
 * Sample controller showing a construct and 2 methods and their typical usage.
 */
class Post extends Controller
{
    protected $post;

    /**
     * Call the parent construct
     */
    public function __construct()
    {
        parent::__construct();
        $this->post = new PostEntity;

    }

    /**
     * Define Index page title and load template files
     */
    public function index()
    {
        $this->criteria();
        $sql = "select SQL_CALC_FOUND_ROWS * from post limit $this->offset, $this->limit "; //left join author a on post.author_id = a.id
        //$sql = "select * from post";
        $data = $this->post->find($sql);

        $pages = new Paginator($this->limit, 'p');
        $pages->setTotal($data['totalRows']);

        //var_dump($pages);
        //echo $pages->pageLinks();
        //exit;

        $this->render('/post/index',array('post' => $data['records'], 'pages' => $pages )); 
    }

    public function add()
    {
        $form = new PostForm();

        if (Request::isPost()) {
            
            $post = array_merge_recursive(
                $_POST, $_FILES
            );
            
            $form->setData($post);

            if ($form->isValid()) {
                
                $filter = new \Zend\Filter\File\RenameUpload(array(
                    "target"    => "app/templates/default/images",
                    //"randomize" => true,
                    'use_upload_name' => true,
                    'use_upload_extension' => true
                ));

                $filter->filter($post['filename']);

                $this->processForm($post);

                Url::redirect('post');
            }

        } 

        $this->render('post/add',array('form' => $form));
    }

    public function edit()
    {
        $form = new PostForm();
        $id = Url::getLastSegment();
        
        $post = $this->post->find('select * from post where id = :id', array('id' => $id ));
        
        if (Request::isPost()) {
            
            $postParams = array_merge_recursive(
                $_POST, $_FILES
            );

            $form->setData($postParams);

            if ($form->isValid()) {
                
                $filter = new \Zend\Filter\File\RenameUpload(array(
                    "target"    => "app/templates/default/images",
                    //"randomize" => true,
                    'use_upload_name' => true,
                    'use_upload_extension' => true
                ));

                $filter->filter($postParams['filename']);


                $this->processEditForm($postParams,$id);

                Url::redirect('post');
            }

        } else {
            $form->bind($post[0]); 
        }

        $this->render('post/edit',array('form' => $form));

    }

    public function delete()
    {
        $id = Url::getLastSegment();
        
        $post = $this->post->getDb()->delete('post',array('id'=>$id));
        Url::redirect('post');
    }


    public function comment()
    {
        header('Content-Type: application/json');
        
        $id = Url::getLastSegment();
        
        $form = new CommentForm;
        $isSuccess = false;    
        if (Request::isPost()) {
            
            $post = array_merge_recursive(
                $_POST, $_FILES
            );
            $form->setData($post);

            if ($form->isValid()) {
                $comment = new CommentEntity;
                $comment->getDb()->insert('comment',array(
                    'post_id' => $id,
                    'content' => $post['content'],
                    'date'  => $post['date'],
                    'author' => $post['author'], 
                ));

                $isSuccess = true;
                //Url::redirect('post');
            }

        }

        $html = View::get_partial('post/comment', array('form' => $form));
           
        $data = array('form' => $html,'isSuccess' => $isSuccess);

        echo json_encode($data);
        exit;
    }
    protected function processForm($params)
    {
        $this->post->getDb()->insert('post',array(
            'author_id' => $params['author_id'],
            'title' => $params['title'],
            'content' => $params['content'],
            'filename' => $params['filename']['name'],
            'date_created' => date('Y-m-d H:i:s'),
            'date_updated' => $params['date_updated'],
            'status' => $params['status']
        ));
    }

    protected function processEditForm($params,$id)
    {
        $data = array(
            'author_id' => $params['author_id'],
            'title' => $params['title'],
            'content' => $params['content'],
            //'date_created' => date('Y-m-d H:i:s'),
            'date_updated' => $params['date_updated'],
            'status' => $params['status']
        );

            
        if (isset($params['filename']['name'])) {
            $data['filename'] = $params['filename']['name'];
        }

        $this->post->getDb()->update('post',$data, array('id'=> $id));
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


    protected function criteria()
    {
        $this->page = isset($_GET['p']) ? $_GET['p'] : 1;
        $this->limit = 5;
        $this->offset = ($this->page == 0) ? 0 : ($this->page - 1) * $this->limit;
    }
}
