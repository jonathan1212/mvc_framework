<?php

namespace Models\Entity;

use Core\Model;
use Zend\Stdlib\Hydrator;

class Author extends Model
{
	protected $id;
	protected $firstname;
	protected $lastname;
	protected $email;
	protected $password;
		
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

        $data = array();
        
        $hydrator = new Hydrator\ClassMethods(true);

        foreach ($all as $each) {
            $hydrated = $hydrator->hydrate($each, new self);
            $data[] = $hydrated;
        }
        
        return $data;
    }


    public function getDb()
    {
        return $this->db;
    }
    /**
     * Gets the value of id.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the value of id.
     *
     * @param mixed $id the id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets the value of firstname.
     *
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Sets the value of firstname.
     *
     * @param mixed $firstname the firstname
     *
     * @return self
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Gets the value of lastname.
     *
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Sets the value of lastname.
     *
     * @param mixed $lastname the lastname
     *
     * @return self
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Gets the value of email.
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the value of email.
     *
     * @param mixed $email the email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Gets the value of password.
     *
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Sets the value of password.
     *
     * @param mixed $password the password
     *
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function getFullName()
    {
        return $this->getFirstname(). ' '. $this->getLastname();
    }
}
