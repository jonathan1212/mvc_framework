<?php

namespace Models\Entity;

use Core\Model;
use Zend\Hydrator\ClassMethods;
use Zend\Stdlib\Hydrator;
use Models\Entity\Author;

class Post extends Model
{
	protected $id;
    protected $author_id;
	protected $author;
	protected $title;
	protected $content;
	protected $filename;
    protected $date_created;
    protected $date_updated;
    protected $status;
    
	public function __construct()
	{
		parent::__construct();
	   
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
    
    public function find($sql, $array = array(), $fetchMode = \PDO::FETCH_OBJ, $class = '')
    {
        $all = $this->getDb()->select($sql,$array,$fetchMode,$class);        
        
        $list = array();
        $hydrator = new ClassMethods(true);

        $data = array();
        foreach ($all as $each) {
            $self = new self;
            $hydrated = $hydrator->hydrate($each, $self);

            $pos = strpos($sql, 'join author');
            if ($pos !== false) {
                //author hydrate
                $authorHydrate = $hydrator->hydrate($each, new Author);
                $self->setAuthor($authorHydrate);
            }
            $data[] = $self;
        }

        $list['records'] = $data;

        //pagination
        $calc = strpos($sql, 'SQL_CALC_FOUND_ROWS');
        if ($calc !== false) {
            $list['totalRows'] = $this->totalRows(); 
        }

        return $list;
    }

    /**
     *  Dependent on sql_calc_found_rows
     */
    public function totalRows()
    {
        $sql = "SELECT FOUND_ROWS() AS totalRows";
        $all = $this->getDb()->select($sql);  
        return $all[0]->totalRows;
    }


    public function getDb()
    {
        return $this->db;
    }
    
    public function setId($v) {
        $this->id = $v;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setAuthorId($v) {
        $this->author_id = $v;
        return $this;
    }

    public function getAuthorId()
    {
        return $this->author_id;
    }

    public function setAuthor(Author $author)
    {
        $this->author = $author;
        return $this;
    }

    public function getAuthor()
    {
        if (!$this->author) {
            $author = new Author;
            $a = $author->find('select * from author where id =:id',array('id' => $this->author_id));
            return $a[0];
        }

        return $this->author;
    }

    public function setTitle($v) {
        $this->title = $v;
        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setContent($v) {
        $this->content = $v;
        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setFilename($v) {

        if (is_array($v) && isset($v['tmp_name'])) {
            $v = end(explode('/',$v['tmp_name']));
        }
        $this->filename = $v;

        return $this;
    }

    public function getFilename()
    {
        return $this->filename;
    }

    public function setDateCreated($v) {
        $this->date_created = $v;
        return $this;
    }

    public function getDateCreated()
    {
        return $this->date_created;
    }

    public function setDateUpdated($v) {
        $this->date_updated = $v;
        return $this;
    }

    public function getDateUpdated()
    {
        return $this->date_updated;
    }

    public function setStatus($v) {
        $this->status = $v;
        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }
    
}
