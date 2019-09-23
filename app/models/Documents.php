<?php

class Documents extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var integer
     */
    protected $user_id;

    /**
     *
     * @var integer
     */
    protected $certificat ;

    /**
     *
     * @var integer
     */
    protected $photo;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field user_id
     *
     * @param integer $user_id
     * @return $this
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Method to set the value of field certificat 
     *
     * @param integer $certificat 
     * @return $this
     */
    public function setCertificat ($certificat )
    {
        $this->certificat  = $certificat ;

        return $this;
    }

    /**
     * Method to set the value of field photo
     *
     * @param integer $photo
     * @return $this
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field user_id
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Returns the value of field certificat 
     *
     * @return integer
     */
    public function getCertificat ()
    {
        return $this->certificat ;
    }

    /**
     * Returns the value of field photo
     *
     * @return integer
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("asul");
        $this->setSource("documents");
        $this->belongsTo('user_id', 'Asul\Users', 'id', ['alias' => 'Users']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'documents';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Documents[]|Documents|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Documents|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
