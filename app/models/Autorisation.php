<?php

class Autorisation extends \Phalcon\Mvc\Model
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
     * @var string
     */
    protected $quitter_le_gymnase;

    /**
     *
     * @var string
     */
    protected $actes_medical;

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
     * Method to set the value of field quitter_le_gymnase
     *
     * @param string $quitter_le_gymnase
     * @return $this
     */
    public function setQuitterLeGymnase($quitter_le_gymnase)
    {
        $this->quitter_le_gymnase = $quitter_le_gymnase;

        return $this;
    }

    /**
     * Method to set the value of field actes_medical
     *
     * @param string $actes_medical
     * @return $this
     */
    public function setActesMedical($actes_medical)
    {
        $this->actes_medical = $actes_medical;

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
     * Returns the value of field quitter_le_gymnase
     *
     * @return string
     */
    public function getQuitterLeGymnase()
    {
        return $this->quitter_le_gymnase;
    }

    /**
     * Returns the value of field actes_medical
     *
     * @return string
     */
    public function getActesMedical()
    {
        return $this->actes_medical;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("asul");
        $this->setSource("autorisation");
        $this->belongsTo('user_id', 'Asul\Users', 'id', ['alias' => 'Users']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'autorisation';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Autorisation[]|Autorisation|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Autorisation|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
