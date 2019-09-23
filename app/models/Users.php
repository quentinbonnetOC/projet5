<?php

class Users extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var string
     */
    protected $lastname;

    /**
     *
     * @var string
     */
    protected $firstname;

    /**
     *
     * @var string
     */
    protected $address;

    /**
     *
     * @var integer
     */
    protected $postal_code;

    /**
     *
     * @var string
     */
    protected $city;

    /**
     *
     * @var string
     */
    protected $sexe;

    /**
     *
     * @var string
     */
    protected $birthdate;

    /**
     *
     * @var string
     */
    protected $categorie;

    /**
     *
     * @var string
     */
    protected $phone_number;

    /**
     *
     * @var string
     */
    protected $fix_number;

    /**
     *
     * @var string
     */
    protected $mail;

    /**
     *
     * @var integer
     */
    protected $taille;

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
     * Method to set the value of field lastname
     *
     * @param string $lastname
     * @return $this
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Method to set the value of field firstname
     *
     * @param string $firstname
     * @return $this
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Method to set the value of field address
     *
     * @param string $address
     * @return $this
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Method to set the value of field postal_code
     *
     * @param integer $postal_code
     * @return $this
     */
    public function setPostalCode($postal_code)
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    /**
     * Method to set the value of field city
     *
     * @param string $city
     * @return $this
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Method to set the value of field sexe
     *
     * @param string $sexe
     * @return $this
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Method to set the value of field birthdate
     *
     * @param string $birthdate
     * @return $this
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Method to set the value of field categorie
     *
     * @param string $categorie
     * @return $this
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Method to set the value of field phone_number
     *
     * @param string $phone_number
     * @return $this
     */
    public function setPhoneNumber($phone_number)
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    /**
     * Method to set the value of field fix_number
     *
     * @param string $fix_number
     * @return $this
     */
    public function setFixNumber($fix_number)
    {
        $this->fix_number = $fix_number;

        return $this;
    }

    /**
     * Method to set the value of field mail
     *
     * @param string $mail
     * @return $this
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Method to set the value of field taille
     *
     * @param integer $taille
     * @return $this
     */
    public function setTaille($taille)
    {
        $this->taille = $taille;

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
     * Returns the value of field lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Returns the value of field firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Returns the value of field address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Returns the value of field postal_code
     *
     * @return integer
     */
    public function getPostalCode()
    {
        return $this->postal_code;
    }

    /**
     * Returns the value of field city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Returns the value of field sexe
     *
     * @return string
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Returns the value of field birthdate
     *
     * @return string
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Returns the value of field categorie
     *
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Returns the value of field phone_number
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    /**
     * Returns the value of field fix_number
     *
     * @return string
     */
    public function getFixNumber()
    {
        return $this->fix_number;
    }

    /**
     * Returns the value of field mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Returns the value of field taille
     *
     * @return integer
     */
    public function getTaille()
    {
        return $this->taille;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("asul");
        $this->setSource("users");
        $this->hasOne('id', 'Autorisation', 'user_id', ['alias' => 'Autorisation']);
        $this->hasOne('id', 'Documents', 'user_id', ['alias' => 'Documents']);
        $this->hasOne('id', 'Medical', 'user_id', ['alias' => 'Medical']);
        $this->hasOne('id', 'Parents', 'user_id', ['alias' => 'Parents']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'users';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users[]|Users|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
