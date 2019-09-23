<?php

class Parents extends \Phalcon\Mvc\Model
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
    protected $nom_du_pere;

    /**
     *
     * @var string
     */
    protected $prenom_du_pere;

    /**
     *
     * @var string
     */
    protected $mail_du_pere;

    /**
     *
     * @var string
     */
    protected $profession_du_pere;

    /**
     *
     * @var string
     */
    protected $entreprise_du_pere;

    /**
     *
     * @var string
     */
    protected $nom_de_la_mere;

    /**
     *
     * @var string
     */
    protected $prenom_de_la_mere;

    /**
     *
     * @var string
     */
    protected $mail_de_la_mere;

    /**
     *
     * @var string
     */
    protected $profession_de_la_mere;

    /**
     *
     * @var string
     */
    protected $entreprise_de_la_mere;

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
     * Method to set the value of field nom_du_pere
     *
     * @param string $nom_du_pere
     * @return $this
     */
    public function setNomDuPere($nom_du_pere)
    {
        $this->nom_du_pere = $nom_du_pere;

        return $this;
    }

    /**
     * Method to set the value of field prenom_du_pere
     *
     * @param string $prenom_du_pere
     * @return $this
     */
    public function setPrenomDuPere($prenom_du_pere)
    {
        $this->prenom_du_pere = $prenom_du_pere;

        return $this;
    }

    /**
     * Method to set the value of field mail_du_pere
     *
     * @param string $mail_du_pere
     * @return $this
     */
    public function setMailDuPere($mail_du_pere)
    {
        $this->mail_du_pere = $mail_du_pere;

        return $this;
    }

    /**
     * Method to set the value of field profession_du_pere
     *
     * @param string $profession_du_pere
     * @return $this
     */
    public function setProfessionDuPere($profession_du_pere)
    {
        $this->profession_du_pere = $profession_du_pere;

        return $this;
    }

    /**
     * Method to set the value of field entreprise_du_pere
     *
     * @param string $entreprise_du_pere
     * @return $this
     */
    public function setEntrepriseDuPere($entreprise_du_pere)
    {
        $this->entreprise_du_pere = $entreprise_du_pere;

        return $this;
    }

    /**
     * Method to set the value of field nom_de_la_mere
     *
     * @param string $nom_de_la_mere
     * @return $this
     */
    public function setNomDeLaMere($nom_de_la_mere)
    {
        $this->nom_de_la_mere = $nom_de_la_mere;

        return $this;
    }

    /**
     * Method to set the value of field prenom_de_la_mere
     *
     * @param string $prenom_de_la_mere
     * @return $this
     */
    public function setPrenomDeLaMere($prenom_de_la_mere)
    {
        $this->prenom_de_la_mere = $prenom_de_la_mere;

        return $this;
    }

    /**
     * Method to set the value of field mail_de_la_mere
     *
     * @param string $mail_de_la_mere
     * @return $this
     */
    public function setMailDeLaMere($mail_de_la_mere)
    {
        $this->mail_de_la_mere = $mail_de_la_mere;

        return $this;
    }

    /**
     * Method to set the value of field profession_de_la_mere
     *
     * @param string $profession_de_la_mere
     * @return $this
     */
    public function setProfessionDeLaMere($profession_de_la_mere)
    {
        $this->profession_de_la_mere = $profession_de_la_mere;

        return $this;
    }

    /**
     * Method to set the value of field entreprise_de_la_mere
     *
     * @param string $entreprise_de_la_mere
     * @return $this
     */
    public function setEntrepriseDeLaMere($entreprise_de_la_mere)
    {
        $this->entreprise_de_la_mere = $entreprise_de_la_mere;

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
     * Returns the value of field nom_du_pere
     *
     * @return string
     */
    public function getNomDuPere()
    {
        return $this->nom_du_pere;
    }

    /**
     * Returns the value of field prenom_du_pere
     *
     * @return string
     */
    public function getPrenomDuPere()
    {
        return $this->prenom_du_pere;
    }

    /**
     * Returns the value of field mail_du_pere
     *
     * @return string
     */
    public function getMailDuPere()
    {
        return $this->mail_du_pere;
    }

    /**
     * Returns the value of field profession_du_pere
     *
     * @return string
     */
    public function getProfessionDuPere()
    {
        return $this->profession_du_pere;
    }

    /**
     * Returns the value of field entreprise_du_pere
     *
     * @return string
     */
    public function getEntrepriseDuPere()
    {
        return $this->entreprise_du_pere;
    }

    /**
     * Returns the value of field nom_de_la_mere
     *
     * @return string
     */
    public function getNomDeLaMere()
    {
        return $this->nom_de_la_mere;
    }

    /**
     * Returns the value of field prenom_de_la_mere
     *
     * @return string
     */
    public function getPrenomDeLaMere()
    {
        return $this->prenom_de_la_mere;
    }

    /**
     * Returns the value of field mail_de_la_mere
     *
     * @return string
     */
    public function getMailDeLaMere()
    {
        return $this->mail_de_la_mere;
    }

    /**
     * Returns the value of field profession_de_la_mere
     *
     * @return string
     */
    public function getProfessionDeLaMere()
    {
        return $this->profession_de_la_mere;
    }

    /**
     * Returns the value of field entreprise_de_la_mere
     *
     * @return string
     */
    public function getEntrepriseDeLaMere()
    {
        return $this->entreprise_de_la_mere;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("asul");
        $this->setSource("parents");
        $this->belongsTo('user_id', 'Asul\Users', 'id', ['alias' => 'Users']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'parents';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Parents[]|Parents|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Parents|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
