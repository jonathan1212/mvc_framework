<?php

namespace Models\Entity;

use Core\Model;
use Zend\Stdlib\Hydrator;

class Comment extends Model
{
		
	public function __construct()
	{
		parent::__construct();
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
    

    public function getDb()
    {
        return $this->db;
    }
    
    
}
