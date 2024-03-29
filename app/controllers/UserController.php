<?php
// namespace Asul;

use Phalcon\Http\Request;
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\File;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\Radio;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Element\Date;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Alpha;
use Phalcon\Validation\Validator\Date as DateValidator;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Confirmation;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\Regex as RegexValidator;

class UserController extends ControllerBase
{
  public function indexAction()
  {
    $this->assets->addCss('/'.$_SESSION['URL'].'/css/main.css');
    $this->assets->addCss('/'.$_SESSION['URL'].'/css/menu.css');
    $this->assets->addCss('/'.$_SESSION['URL'].'/css/user.css');

    $identifiant = $this->session->get('identifiant');
    $mdp = $this->session->get('mdp');
    if(isset($identifiant)&&isset($mdp)) {
      $users = Users::find();
      $this->view->users = $users;
    } else {
      echo "vous devez être authentifié";
      exit();
    }
  }
  public function deleteallAction()
  {
    $deleteall = Users::find();
    $deleteall->delete();
    return $this->response->redirect('user/index');
  }
  public function inscriptionAction()
  {
  }
  public function renouvAction()
  {
    $URL = $_SESSION['URL'];
    $this->assets->addCss(''.$URL.'public/css/main.css');
    $this->assets->addCss(''.$URL.'public/css/dropdown.css');
    $this->assets->addCss(''.$URL.'public/css/normalizes.css');
    $this->assets->addCss(''.$URL.'public/css/mainbis.css');
    $this->assets->addCss(''.$URL.'public/css/jquery.steps.css');
    $this->assets->addJs('https://code.jquery.com/jquery-3.3.1.js');
    $this->assets->addJs("https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js");
    $this->assets->addJs('https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.js');
    $this->assets->addJs(''.$URL.'public/js/validationForm.js');
    form(); //formulaire commun creation et renouvellement
    informationsLaterales(); //informations latérales
    if ($this->request->hasPost('renouvellement')) 
    {
      renouvellement(); // cas du renouvellement
    }
    else if ($this->request->getPost("creation")=="S'inscrire")
    {
      creation(); //cas de la création
    }
    if($this->request->hasPost('id')&&$this->request->getPost('id')!="creation"&& !empty($this->request->getPost('id'))) 
    {
      traitementRenouvellement(); //traitement renouvellement
    }
    elseif($this->request->hasPost('id')&&$this->request->getPost('id')=="creation") 
    {
      traitementCreation(); //Traitement creation
    }
  }
  private function form() //formulaire commun creation et renouvellement
  {
    $form = new Form();
      $nom = new text(
        'nom',
        [
          'class' => 'form-control'
        ]
      );      
      $nom->setAttribute('required', 'required');             
      $form->add($nom);

      $Prenom = new text(
        'Prenom',
        [
          'class' => 'form-control'
        ]
      );
      $Prenom->setAttribute('required', 'required');
      $form->add($Prenom);

      $Adresse = new text(
        "Adresse",
        [
          'class' => 'form-control'
        ]
      );
      $Adresse->setAttribute('required', 'required');
      $form->add($Adresse);

      $Code_postal = new numeric(
        'Code_postal',
        [
          'class' => 'form-control'
        ]
      );
      $Code_postal->setAttribute('required', 'required');
      $form->add($Code_postal);
    
      $Ville = new text(
        'Ville',
        [
          'class' => 'form-control'
        ]
      );
      $Ville->setAttribute('required', 'required');
      $form->add($Ville);
    
      $Sexe = new radio(
        'Masculin',
        [
          'class' => 'form-check-input',
          'name' => 'Sexe',
          'value' => 'Masculin'
        ]
      );
      $form->add($Sexe);
      $Sexe = new radio(
        'Feminin',
        [
          'class' => 'form-check-input',
          'name' => 'Sexe',
          'value' => 'Feminin'
        ]
      );
      $form->add($Sexe);

      $Date_de_naissance =  new date(
        'Date_de_naissance',
        [
          'class' =>'form-control'
        ]
      );
      $Date_de_naissance->setAttribute('required', 'required');
      $form->add($Date_de_naissance);
    
      $N°_de_telephone_portable = new numeric(
        'N°_de_telephone_portable',
        [
          'class' => 'form-control'
        ]
      );
      $N°_de_telephone_portable->setAttribute('required', 'required');
      $form->add($N°_de_telephone_portable);
    
      $N°_de_telephone_fixe = new numeric(
        'N°_de_telephone_fixe',
        [
          'class' => 'form-control'
        ]
      );
      $N°_de_telephone_fixe->setAttribute('required', 'required');
      $form->add($N°_de_telephone_fixe);
       
      $mail = new text(
        'mail',
        [
          'class' => 'form-control'
        ]
      );
      $mail->setAttribute('required', 'required');
      $form->add($mail);

      $Taille = new numeric(
        'Taille',
        [
          'class' => 'form-control'
        ]
      );
      $Taille->setAttribute('required', 'required');
      $form->add($Taille);
    
      $nom_medical = new text(
        'nom_medical',
        [
          'class' => 'form-control'
        ]
      );
      $nom_medical->setAttribute('required', 'required');
      $form->add($nom_medical);

      $Prenom_medical = new text(
        'Prenom_medical',
        [
          'class' => 'form-control'
        ]
      );
      $Prenom_medical->setAttribute('required', 'required');
      $form->add($Prenom_medical);

      $n°_de_telephone_medical = new numeric(
        'n°_de_telephone_medical',
        [
          'class' => 'form-control'
        ]
      );
      $n°_de_telephone_medical->setAttribute('required', 'required');
      $form->add($n°_de_telephone_medical);
    
      $qualite_medical = new text(
        'qualite_medical',
        [
          'class' => 'form-control'
        ]
      );
      $qualite_medical->setAttribute('required', 'required');
      $form->add($qualite_medical);

      $probleme_medical = new text(
        'probleme_medical',
        [
          'class' => 'form-control'
        ]
      );
      $form->add($probleme_medical);

      $NOM_pere = new text(
        'NOM_pere',
        [
          'class' => 'form-control'
        ]
      );
      $NOM_pere->setAttribute('required', 'required');
      $form->add($NOM_pere);

      $Prenom_pere = new text(
        'Prenom_pere',
        [
          'class' => 'form-control'
        ]
      );
      $Prenom_pere->setAttribute('required', 'required');
      $form->add($Prenom_pere);

      $mail_pere = new text(
        'mail_pere',
        [
          'class' => 'form-control'
        ]
      );
      $form->add($mail_pere);

      $Profession_pere = new text(
        'Profession_pere',
        [
          'class' => 'form-control'
        ]
      );
      $form->add($Profession_pere);

      $Entreprise_pere = new text(
        'Entreprise_pere',
        [
          'class' => 'form-control'
        ]
      );
      $form->add($Entreprise_pere);

      $NOM_mere = new text(
        'NOM_mere',
        [
          'class' => 'form-control'
        ]
      );
      $NOM_mere->setAttribute('required', 'required');
      $form->add($NOM_mere);

      $Prenom_mere = new text(
        'Prenom_mere',
        [
          'class' => 'form-control'
        ]
      );
      $Prenom_mere->setAttribute('required', 'required');
      $form->add($Prenom_mere);

      $mail_mere = new text(
        'mail_mere',
        [
          'class' => 'form-control'
        ]
      );
      $form->add($mail_mere);

      $Profession_mere = new text(
        'Profession_mere',
        [
          'class' => 'form-control'
        ]
      );
      $form->add($Profession_mere);

      $Entreprise_mere = new text(
        'Entreprise_mere',
        [
          'class' => 'form-control'
        ]
      );
      $form->add($Entreprise_mere);
      
      $quitter_le_gymnase = new radio(
        'quitter_le_gymnase_oui',
        [
          'class' => 'form-check-input',
          'name' => 'quitter_le_gymnase',
          'value' => 'oui'
        ]
      );
      $form->add($quitter_le_gymnase);
      
      $quitter_le_gymnase = new radio(
        'quitter_le_gymnase_non',
        [
          'class' => 'form-check-input',
          'name' => 'quitter_le_gymnase',
          'value' => 'non'
        ]
      );
      $form->add($quitter_le_gymnase);
      
      $actes_medical = new radio(
        'actes_medical_oui',
        [
          'class' => 'form-check-input',
          'name' => 'actes_medical',
          'value' => 'oui'
        ]
      );
      $form->add($actes_medical);
      
      $actes_medical = new radio(
        'actes_medical_non',
        [
          'class' => 'form-check-input',
          'name' => 'actes_medical',
          'value' => 'non'
        ]
      );
      $form->add($actes_medical);
      $certificat_medical = new file(
        'certificat_medical',
        [
          'class' => 'form-group-file'
        ]
      );
      $form->add($certificat_medical);
    
      $photo = new file(
        'photo',
        [
          'class' => 'form-group-file'
        ]
          );
      $form->add($photo);

      $id = new hidden(
        'id',
        [
          'value'=>''
        ]   
      );
      $form->add($id);
  }
  private function informationsLaterales() // information latérales
  {
    $infos = Informations::find();
    $this->view->infos = $infos;
  }
  private function renouvellement() // cas du renouvellement
  {
    $this->assets->addJs('js/removeAttribute.js');
    $imail = $this->request->getPost('email');      
    if (!empty($imail)) //récupération des données
    {
      $user = Users::find(
        [
          'conditions' => 'mail = :mail:',
          'bind'       => [
            "mail" => $imail,
          ]
        ]
      );
      if(empty($user[0])) //email invalid
      {
        $_SESSION["flashSession"] = "l'email est invalide";
        $this->flashSession->warning("l'email est invalide");
        return $this->response->redirect('/');
      }
      
      $nb = count($user);
      $this->view->nb = $nb;
      $this->view->form = $form;
      if($nb>1) //Cas de plusieurs licenciés avec la même adresse mail
      {
        $this->view->user = $user;
        $values = array();
        $e = 0;
        foreach($user as $users)
        {
          $e++;
          $medical = $users->getMedical();
          $parents = $users->getParents();
          $autorisation = $users->getAutorisation();

          $values["lastname"][$e] = $users->lastname;
          $values["firstname"][$e] = $users->firstname; 
          $values["address"][$e] = $users->address; 
          $values["postal_code"][$e] = $users->postal_code; 
          $values["city"][$e] = $users->city; 
          $values["Sexe"][$e] = $users->Sexe; 
          $values["birthdate"][$e] = $users->birthdate; 
          $values["phone_number"][$e] = $users->phone_number; 
          $values["fix_phone"][$e] = $users->fix_number;
          $values["mail"][$e] = $users->mail;
          $values["taille"][$e] = $users->taille;
          $values['medical_firstname'][$e] = $medical->firstname;
          $values["medical_lastname"][$e] = $medical->lastname;
          $values["medical_phone_number"][$e] = $medical->phone_number;
          $values["quality"][$e] = $medical->quality;
          $values["probleme"][$e] = $medical->probleme;
          $values["nom_du_pere"][$e] = $parents->nom_du_pere;
          $values["prenom_du_pere"][$e] = $parents->prenom_du_pere;
          $values["mail_du_pere"][$e] = $parents->mail_du_pere;
          $values["profession_du_pere"][$e] = $parents->profession_du_pere;
          $values["entreprise_du_pere"][$e] = $parents->entreprise_du_pere;
          $values["nom_de_la_mere"][$e] = $parents->nom_de_la_mere;
          $values["prenom_de_la_mere"][$e] = $parents->prenom_de_la_mere;
          $values["mail_de_la_mere"][$e] = $parents->mail_de_la_mere;
          $values["profession_de_la_mere"][$e] = $parents->profession_de_la_mere;
          $values["entreprise_de_la_mere"][$e] = $parents->entreprise_de_la_mere;
          $values["quitter_le_gymnase"][$e] = $autorisation->quitter_le_gymnase;
          $values["actes_medical"][$e] = $autorisation->actes_medical;
        }
        $this->view->values = $values;
      } 
      else // cas d'un seul licencié avec l'adresse mail
      {
        $nom->setDefault($user[0]->lastname);
        $nom->setAttribute('readonly', 'readonly');

        $Prenom->setDefault($user[0]->firstname);
        $Prenom->setAttribute('readonly', 'readonly');

        $Adresse->setDefault($user[0]->address);

        $Code_postal->setDefault($user[0]->postal_code);

        $Ville->setDefault($user[0]->city);
        if ($user[0]->Sexe=="Masculin")
        {
          $Sexe = new radio(
            'Masculin',
            [
              'name' => 'Sexe',
              'value' => 'Masculin',
              'checked'=>'checked',
              'class' => 'form-check-input'
            ]
          );
          $form->add($Sexe);
        }
        else
        {
          $Sexe = new radio(
            'Masculin',
            [
              'name' => 'Sexe',
              'value' => 'Masculin',
              'class' => 'form-check-input'
            ]
          );
          $form->add($Sexe);
        }
        if ($user[0]->Sexe=="Feminin") 
        {
          $Sexe = new radio(
            'Feminin',
            [
              'name' => 'Sexe',
              'value' => 'Feminin',
              'checked'=>'checked',
              'class' => 'form-check-input'

            ]
          );
          $Sexe->setAttribute('required', 'required');
          $Sexe->setAttribute('readonly', 'readonly');
          $form->add($Sexe);
        } 
        else
        {
          $Sexe = new radio(
            'Feminin',
            [
              'name' => 'Sexe',
              'value' => 'Feminin',
              'class' => 'form-check-input'
            ]
          );
          $Sexe->setAttribute('required', 'required');
          $Sexe->setAttribute('readonly', 'readonly');
          $form->add($Sexe);
        }
        $Date_de_naissance->setDefault($user[0]->birthdate);
        $Date_de_naissance->setAttribute('readonly', 'readonly');

        $N°_de_telephone_portable->setDefault($user[0]->phone_number);

        $N°_de_telephone_fixe->setDefault($user[0]->fix_number);
        
        $mail->setDefault($user[0]->mail);

        $Taille->setDefault($user[0]->taille);

        $medical = $user[0]->getMedical();

        $nom_medical->setDefault($medical->firstname);

        $Prenom_medical->setDefault($medical->lastname);

        $n°_de_telephone_medical->setDefault($medical->phone_number);

        $qualite_medical->setDefault($medical->quality);

        $probleme_medical->setDefault($medical->probleme);

        $parents = $user[0]->getParents();

        $NOM_pere->setDefault($parents->nom_du_pere);
        $NOM_pere->setAttribute('readonly', 'readonly');

        $Prenom_pere->setDefault($parents->prenom_du_pere);
        $Prenom_pere->setAttribute('readonly', 'readonly');

        $mail_pere->setDefault($parents->mail_du_pere);

        $Profession_pere->setDefault($parents->profession_du_pere);

        $Entreprise_pere->setDefault($parents->entreprise_du_pere);

        $NOM_mere->setDefault($parents->nom_de_la_mere);
        $NOM_mere->setAttribute('readonly', 'readonly');

        $Prenom_mere->setDefault($parents->prenom_de_la_mere);
        $Prenom_mere->setAttribute('readonly', 'readonly');

        $mail_mere->setDefault($parents->mail_de_la_mere);

        $Profession_mere->setDefault($parents->profession_de_la_mere);

        $Entreprise_mere->setDefault($parents->entreprise_de_la_mere);

        $autorisation = $user[0]->getAutorisation();

        if($autorisation->quitter_le_gymnase=="oui") 
        {
          $quitter_le_gymnase = new radio(
            'quitter_le_gymnase_oui',
            [
              'name' => 'quitter_le_gymnase',
              'value' => 'oui',
              'checked'=>'checked',
              'class' => 'form-check-input'
            ]
          );
          $form->add($quitter_le_gymnase);
        } 
        else 
        {
          $quitter_le_gymnase = new radio(
            'quitter_le_gymnase_oui',
            [
              'name' => 'quitter_le_gymnase',
              'value' => 'oui',
              'class' => 'form-check-input'
            ]
          );
          $form->add($quitter_le_gymnase);
        }
        if($autorisation->quitter_le_gymnase=="non") 
        {
          $quitter_le_gymnase = new radio(
            'quitter_le_gymnase_non',
            [
              'name' => 'quitter_le_gymnase',
              'value' => 'non',
              'checked'=>'checked',
              'class' => 'form-check-input'
            ]
          );
          $form->add($quitter_le_gymnase);
        } 
        else 
        {
          $quitter_le_gymnase = new radio(
            'quitter_le_gymnase_non',
            [
              'name' => 'quitter_le_gymnase',
              'value' => 'non',
              'class' => 'form-check-input'
            ]
          );
          $form->add($quitter_le_gymnase);
        }
        if($autorisation->actes_medical=="oui") 
        {
          $actes_medical = new radio(
            'actes_medical_oui',
            [
              'name' => 'actes_medical',
              'value' => 'oui',
              'checked'=>'checked',
              'class' => 'form-check-input'
            ]
          );
          $form->add($actes_medical);
        } 
        else 
        {
          $actes_medical = new radio(
            'actes_medical_oui',
            [
              'name' => 'actes_medical',
              'value' => 'oui',
              'class' => 'form-check-input'
            ]
          );
          $form->add($actes_medical);
        }
        if($autorisation->actes_medical=="non") 
        {
          $actes_medical = new radio(
            'actes_medical_non',
            [
              'name' => 'actes_medical',
              'value' => 'non',
              'checked'=>'checked',
              'class' => 'form-check-input'
            ]
          );
          $form->add($actes_medical);
        } 
        else 
        {
          $actes_medical = new radio(
            'actes_medical_non',
            [
              'name' => 'actes_medical',
              'value' => 'non',
              'class' => 'form-check-input'
            ]
          );
          $form->add($actes_medical);
        }
        $id->setDefault($user[0]->id);
        $form->add($id);
        $this->view->form = $form;
      }
    }
  }
  private function creation() // cas de la création
  {
    $this->assets->addCss(''.$URL.'public/css/renouv.css');
    $this->assets->addJs('/js/birthdate.js');

    $id->setDefault('creation');
    $form->add($id);
    $this->view->form = $form;
  }
  private function traitementRenouvellement() // traitement renouvellement
  {
    $id = $this->request->getPost('id'); 
    $user = Users::findFirstById($id);
    $user->setAddress(htmlspecialchars($this->request->getPost('Adresse')));
    $user->setPostalCode(htmlspecialchars($this->request->getPost('Code_postal')));
    $user->setCity(htmlspecialchars($this->request->getPost('Ville')));
    $user->setPhoneNumber(htmlspecialchars($this->request->getPost('N°_de_telephone_portable')));
    $user->setFixNumber(htmlspecialchars($this->request->getPost('N°_de_telephone_fixe')));
    $user->setMail(htmlspecialchars($this->request->getPost('mail')));
    $user->setTaille(htmlspecialchars($this->request->getPost('Taille')));

    $user->update();

    $user->getMedical()->update(
      [
        htmlspecialchars($this->request->getPost('nom_medical')),
        htmlspecialchars($this->request->getPost('Prenom_medical')),
        htmlspecialchars($this->request->getPost('n°_de_telephone_medical')),
        htmlspecialchars($this->request->getPost('qualité')),
        htmlspecialchars($this->request->getPost('probleme_medical'))
      ]
    );
    $user->getParents()->update(
      [
        htmlspecialchars($this->request->getPost('NOM_pere')),
        htmlspecialchars($this->request->getPost('Prenom_pere')),
        htmlspecialchars($this->request->getPost('mail_pere')),
        htmlspecialchars($this->request->getPost('Profession_pere')),
        htmlspecialchars($this->request->getPost('Entreprise_pere')),
        htmlspecialchars($this->request->getPost('NOM_mere')),
        htmlspecialchars($this->request->getPost('Prenom_mere')),
        htmlspecialchars($this->request->getPost('mail_mere')),
        htmlspecialchars($this->request->getPost('Profession_mere')),
        htmlspecialchars($this->request->getPost('Entreprise_mere'))
      ]
    );

    $user->getAutorisation()->update(
      [
        htmlspecialchars($this->request->getPost('a1')),
        htmlspecialchars($this->request->getPost('b1'))
      ]
    );
    if ($user->update()){
      var_dump("l'utilisateur est enregistre");
      return $this->response->redirect('user/inscription');
    }
  }
  private function traitementCreation() // traitement création
  {
    // validation formulaire
    $date = intval(date('Y'));
    $annee_de_naissance = intval(substr($_POST['Date_de_naissance'], 0, 4));
    
    if($date - $annee_de_naissance >= 18)
    {
      foreach ($_POST as $post) {
        if($post != "NOM_pere" && $post != "Prenom_pere" && $post != "mail_pere" && $post != "Profession_pere" && $post != "Entreprise_pere" && $post != "NOM_mere" && $post != "Prenom_mere" && $post != "mail_mere" && $post != "Profession_mere" && $post != "Entreprise_mere")
        {
          if($value == "")
          {
            $valide = false;
          }
        }
      }
    }
    else
    {
      foreach ($_POST as $post) {
        if($post === "")
        {
          $valide = false;
        }
      }
    }
    /// validation formulaire
    $user = new Users();    
      $user->setLastname(htmlspecialchars($this->request->getPost('nom')));
      $user->setFirstname(htmlspecialchars($this->request->getPost('Prenom')));
      $user->setAddress(htmlspecialchars($this->request->getPost('Adresse')));
      $user->setPostalCode(htmlspecialchars($this->request->getPost('Code_postal')));
      $user->setCity(htmlspecialchars($this->request->getPost('Ville')));
      $user->setSexe(htmlspecialchars($this->request->getPost('Sexe')));
      $user->setBirthdate(htmlspecialchars($this->request->getPost('Date_de_naissance')));
      $birthdate = htmlspecialchars(date("Y-m-d", strtotime($this->request->getPost('Date_de_naissance'))));
      $annee_de_naissance = substr($birthdate, 0, 4); 
      $cat = intval(date("Y")) - intval($annee_de_naissance);
      if($cat>19) {
        $user->setCategorie("SENIOR");
      } elseif ($this->request->getPost('Sexe')=="Féminin"&&$cat>=15&&$cat<=17) {
        $user->setCategorie("U18");
      } else {
        switch ($cat) {
          case '19':
            $user->setCategorie("U20");
            break;
          case '18':
            $user->setCategorie("U19");
            break;
          case '17':
            $user->setCategorie("U18");
            break;
          case '16':
            $user->setCategorie("U17");
            break;
          case '15':
            $user->setCategorie("U16");
            break;
          case '14':
            $user->setCategorie("U15");
            break;
          case '13':
            $user->setCategorie("U14");
            break;
          case '12':
            $user->setCategorie("U13");
            break;
          case '11':
            $user->setCategorie("U12");
            break;
          case '10':
            $user->setCategorie("U11");
            break;
          case '9':
            $user->setCategorie("U10");
            break;
          case '8':
            $user->setCategorie("U9");
            break;
          case '7':
            $user->setCategorie("U8");
            break;
          case '6':
            $user->setCategorie("U7");
            break;
          default:
            $user->setCategorie('erreur');
            break;
        }
      }
      $user->setPhoneNumber(htmlspecialchars($this->request->getPost('N°_de_telephone_portable')));
      $user->setFixNumber(htmlspecialchars($this->request->getPost('N°_de_telephone_fixe')));
      $user->setMail(htmlspecialchars($this->request->getPost('mail')));
      $user->setTaille(htmlspecialchars($this->request->getPost('Taille')));


    $user_medical = new Medical();
      $user_medical->setUserId($user->getId());
      $user_medical->setFirstname(htmlspecialchars($this->request->getPost('nom_medical')));
      $user_medical->setLastname(htmlspecialchars($this->request->getPost('Prenom_medical')));
      $user_medical->setPhoneNumber(htmlspecialchars($this->request->getPost('n°_de_telephone_medical')));
      $user_medical->setQuality(htmlspecialchars($this->request->getPost('qualite_medical')));
      $user_medical->setProbleme(htmlspecialchars($this->request->getPost('probleme_medical')));
  
    $user->Medical = $user_medical;          

    $user_parents = new Parents();
      $user_parents->setUserId($user->getId());
      $user_parents->setNomDuPere(htmlspecialchars($this->request->getPost('NOM_pere')));
      $user_parents->setPrenomDuPere(htmlspecialchars($this->request->getPost('Prenom_pere')));
      $user_parents->setMailDuPere(htmlspecialchars($this->request->getPost('mail_pere')));
      $user_parents->setProfessionDuPere(htmlspecialchars($this->request->getPost('Profession_pere')));
      $user_parents->setEntrepriseDuPere(htmlspecialchars($this->request->getPost('Entreprise_pere')));
      $user_parents->setNomDeLaMere(htmlspecialchars($this->request->getPost('NOM_mere')));
      $user_parents->setPrenomDeLaMere(htmlspecialchars($this->request->getPost('Prenom_mere')));
      $user_parents->setMailDeLaMere(htmlspecialchars($this->request->getPost('mail_mere')));
      $user_parents->setProfessionDeLaMere(htmlspecialchars($this->request->getPost('Profession_mere')));
      $user_parents->setEntrepriseDeLaMere(htmlspecialchars($this->request->getPost('Entreprise_mere')));

    $user->Parents = $user_parents;

    $user_autorisation = new Autorisation();
      $user_autorisation->setUserId($user->getId());
      $user_autorisation->setQuitterLeGymnase(htmlspecialchars($this->request->getPost('quitter_le_gymnase')));
      $user_autorisation->setActesMedical(htmlspecialchars($this->request->getPost('actes_medical')));

    $user->Autorisation = $user_autorisation;

    // if(isset($_FILES['photo']))
    // {
    //   if($_FILES['photo']['size'] <= 3000000)
    //   {
    //     $infosfichiers = pathinfo($_FILES['photo']['name']);
    //     $extension_uploads = $infosfichiers['extension'];
    //     $extensions_autoriseess = array('jpg', 'jpeg', 'png');
    //     if (in_array($extension_uploads, $extensions_autoriseess))
    //     {
    //       if(!file_exists("/var/www/html/projet5/public/uploadFiles/".$_POST['nom'].$_POST['Prenom'].""))
    //       {
    //         mkdir("/var/www/html/projet5/public/uploadFiles/".$_POST['nom'].$_POST['Prenom']."", 0777, true);
    //       }
    //       $names = "/var/www/html/projet5/public/uploadFiles/".$_POST['nom'].$_POST['Prenom']."/photo.jpg";
    //       $t = 1;
    //       while(file_exists($names))
    //       {
    //         $names = "/var/www/html/projet5/public/uploadFiles/".$_POST['nom'].$_POST['Prenom']."/photo".$t.".jpg";
    //         $t++;
    //       }
    //       move_uploaded_file($_FILES['photo']['tmp_name'], $names);
    //       $documents = new Documents();
    //       $documents->setPhoto($names);
    //     }else{
    //       exit("un problème technique est survenu");
    //     }
    //   }
    // }
    // if(isset($_FILES['certificat_medical']))
    // {
    //   if($_FILES['certificat_medical']['size'] <= 3000000)
    //   {
    //     $infosfichier = pathinfo($_FILES['certificat_medical']['name']);
    //     $extension_upload = $infosfichier['extension'];
    //     $extensions_autorisees = array('jpg', 'jpeg', 'png');
    //     if (in_array($extension_upload, $extensions_autorisees))
    //     {
    //       $name = "/var/www/html/projet5/public/uploadFiles/".$_POST['nom'].$_POST['Prenom']."/certificat_medical.jpg";
    //       $i = 1;
    //       while(file_exists($name))
    //       {
    //         $name = "/var/www/html/projet5/public/uploadFiles/".$_POST['nom'].$_POST['Prenom']."/certificat_medical".$i.".jpg";
    //         $i++;
    //       }
    //       move_uploaded_file($_FILES['certificat_medical']['tmp_name'], $name);
    //       $documents->setCertificat($name);
    //       $user->Documents = $documents;

    //     }else{
    //       exit("un problème technique est survenu");
    //     }
    //   }
    // }
    if($valide !== false){
    $user->save();
    return $this->response->redirect('mail/index?email='.$this->request->getPost('mail').'&nom='.$this->request->getPost('nom').'&prenom='.$this->request->getPost('Prenom').'');
    return $this->response->redirect('user/inscription');
    }
    elseif($valide === false){
      var_dump("erreur lors de la saisie du formulaire");die();
      //TODO redirection à faire
    }
    // $messages = $validate->validate($_POST);
    // $this->view->messages = $messages;
    
    // if(empty($messages))
    // {
    //   // if($user->save()) {
    //   //   return $this->response->redirect('mail/index?email='.$this->request->getPost('mail').'&nom='.$this->request->getPost('nom').'&prenom='.$this->request->getPost('Prenom').'');
    //   //   return $this->response->redirect('user/inscription');    
    //   // }
    // }
  }
  public function deleteAction() //suppression d'un licencié
  {
    $identifiant = $this->session->get('identifiant');
    $mdp = $this->session->get('mdp');
    if(isset($identifiant)&&isset($mdp)) {
      $id = $_GET['id'];
      $delete = Users::findById($id);
      $delete->delete();
      return $this->response->redirect('user');
    } else {
      echo "vous devez être authentifié";
      exit();
    }
  }
  public function updateAction() //formulaire modification d'un licencié et récupération des données
  {
    $this->assets->addCss(''.$request_uri.'css/renouv');
    $this->assets->addJs(''.$request_uri.'js/removeAttribute.js');
    $this->assets->addJs(''.$request_uri.'js/birthdate.js');
    $identifiant = $this->session->get('identifiant');
    $mdp = $this->session->get('mdp');
    if(isset($identifiant)&&isset($mdp)) {
      $id =  $_GET['id'];
      $user = Users::findFirstById($id);
      $this->view->nom = $user;
    
      $medical = Medical::findFirstByUserId($id);
      $this->view->medical = $medical;

      $parent = Parents::findFirstByUserId($id);
      $this->view->parent = $parent;

      $autorisation = Autorisation::findFirstByUserId($id);
      $this->view->autorisation = $autorisation;
    } else {
      echo "vous devez être authentifié";
      exit();
    }
  }
  public function updatetraitementAction() // modification d'un licencié
  {
    $identifiant = $this->session->get('identifiant');
    $mdp = $this->session->get('mdp');
    if(isset($identifiant)&&isset($mdp)) {
      $updatetraitement = Users::findFirst(
        [
          "conditions" =>  "id = :id: ",
          "bind" => [
            "id" => htmlspecialchars($this->request->getPost('id'))
          ]
        ]
      );        
      $updatetraitement->setLastname(htmlspecialchars($this->request->getPost('nom')));
      $updatetraitement->setFirstname(htmlspecialchars($this->request->getPost('Prenom')));
      $updatetraitement->setAddress(htmlspecialchars($this->request->getPost('Adresse')));
      $updatetraitement->setPostalCode(htmlspecialchars($this->request->getPost('Code_postal')));
      $updatetraitement->setCity(htmlspecialchars($this->request->getPost('Ville')));
      $updatetraitement->setSexe(htmlspecialchars($this->request->getPost('Sexe')));
      $updatetraitement->setBirthdate(htmlspecialchars($this->request->getPost('Date_de_naissance')));
      $updatetraitement->setPhoneNumber(htmlspecialchars($this->request->getPost('N°_de_telephone_portable')));
      $updatetraitement->setFixNumber(htmlspecialchars($this->request->getPost('N°_de_telephone_fixe')));
      $updatetraitement->setMail(htmlspecialchars($this->request->getPost('mail')));
      $updatetraitement->setTaille(htmlspecialchars($this->request->getPost('Taille')));

      $updatetraitement->getMedical()->update(
        [
          htmlspecialchars($this->request->getPost('nom_medical')),
          htmlspecialchars($this->request->getPost('Prenom_medical')),
          htmlspecialchars($this->request->getPost('n°_de_telephone_medical')),
          htmlspecialchars($this->request->getPost('qualité')),
          htmlspecialchars($this->request->getPost('probleme_medical'))
        ]
      );
      $updatetraitement->getParents()->update(
        [
          htmlspecialchars($this->request->getPost('NOM_pere')),
          htmlspecialchars($this->request->getPost('Prenom_pere')),
          htmlspecialchars($this->request->getPost('mail_pere')),
          htmlspecialchars($this->request->getPost('Profession_pere')),
          htmlspecialchars($this->request->getPost('Entreprise_pere')),
          htmlspecialchars($this->request->getPost('NOM_mere')),
          htmlspecialchars($this->request->getPost('Prenom_mere')),
          htmlspecialchars($this->request->getPost('mail_mere')),
          htmlspecialchars($this->request->getPost('Profession_mere')),
          htmlspecialchars($this->request->getPost('Entreprise_mere'))
        ]
      );
      $updatetraitement->getAutorisation()->update(
        [
          htmlspecialchars($this->request->getPost('a1')),
          htmlspecialchars($this->request->getPost('b1'))
        ]
      );      
      if($updatetraitement->update()){
        $this->flashSession->succes("la mise à jour du licencié a été enregistré");
        return $this->response->redirect('/user/index');
      } 
      else 
      {
        $this->flashSession->warning("Probleme lors de la mise à jour du licencié");
        return $this->response->redirect('/user/index');
      }
    } 
    else 
    {
      echo "vous devez être authentifié";
      exit();
    }
  }
  public function modifcatAction() // formulaire modification catégorie
  {
    $identifiant = $this->session->get('identifiant');
    $mdp = $this->session->get('mdp');
    if(isset($identifiant)&&isset($mdp)) {
    } 
    else 
    {
      echo "vous devez être authentifié";
      exit();
    }
  }
  public function modifcategorieAction() //modification catégorie
  {
    $identifiant = $this->session->get('identifiant');
    $mdp = $this->session->get('mdp');
    if(isset($identifiant)&&isset($mdp)) {
      $id = htmlspecialchars($this->request->getPost('id'));
      $modifcat = Users::findFirstById($id);

      if($this->request->hasPost('categorie')) {
        $categories = htmlspecialchars($this->request->getPost('categorie'));
        $categorie = implode(' / ', $categories);
        $modifcat->setCategorie($categorie);
        $modifcat->update();
        return $this->response->redirect('user');
      } 
      else 
      {
        return $this->response->redirect('user');
      }
    } 
    else 
    {
      echo "vous devez être authentifié";
      exit();
    }
  }
  public function downloadAction() 
  {
    $file = urldecode($this->request->get('file'));

    if (file_exists($file)) {
      header('Content-Description: File Transfer');
      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename="'.basename($file).'"');
      header('Expires: 0');
      header('Cache-Control: must-revalidate');
      header('Pragma: public');
      header('Content-Length: ' . filesize($file));
      readfile($file);
      exit;
    }
  }
}