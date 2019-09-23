<?php
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
    $this->assets->addCss('css/main.css');
    $this->assets->addCss('css/menu.css');
    $this->assets->addCss('css/user.css');

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
    $this->assets->addCss('css/renouv.css');
    $this->assets->addCss('css/main.css');
    $this->assets->addCss('css/dropdown.css');
    $this->assets->addCss('css/normalizes.css');
    $this->assets->addCss('css/mainbis.css');
    $this->assets->addCss('css/jquery.steps.css');
    $this->assets->addJs('https://code.jquery.com/jquery-3.3.1.js');
    $this->assets->addJs("https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js");
    $this->assets->addJs('https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.js');
      
    //formulaire commun creation et renouvellement
    $form = new Form();
      $nom = new text(
        'nom'
      );
      $nom->setAttribute('required', 'required');             
      $form->add($nom);

      $Prenom = new text(
        'Prenom'
      );
      $Prenom->setAttribute('required', 'required');
      $form->add($Prenom);

      $Adresse = new text(
        "Adresse"
      );
      $Adresse->setAttribute('required', 'required');
      $form->add($Adresse);

      $Code_postal = new numeric(
        'Code_postal'
      );
      $Code_postal->setAttribute('required', 'required');
      $form->add($Code_postal);
    
      $Ville = new text(
        'Ville'
      );
      $Ville->setAttribute('required', 'required');
      $form->add($Ville);
    
      $Sexe = new radio(
        'Masculin',
        [
          'name' => 'Sexe',
          'value' => 'Masculin'
        ]
      );
      $form->add($Sexe);
      $Sexe = new radio(
        'Feminin',
        [
          'name' => 'Sexe',
          'value' => 'Feminin'
        ]
      );
      $form->add($Sexe);

      $Date_de_naissance =  new date(
        'Date_de_naissance'
      );
      $Date_de_naissance->setAttribute('required', 'required');
      $form->add($Date_de_naissance);
    
      $N°_de_telephone_portable = new numeric(
        'N°_de_telephone_portable'
      );
      $N°_de_telephone_portable->setAttribute('required', 'required');
      $form->add($N°_de_telephone_portable);
    
      $N°_de_telephone_fixe = new numeric(
        'N°_de_telephone_fixe'
      );
      $N°_de_telephone_fixe->setAttribute('required', 'required');
      $form->add($N°_de_telephone_fixe);
       
      $mail = new text(
        'mail'
      );
      $mail->setAttribute('required', 'required');
      $form->add($mail);

      $Taille = new numeric(
        'Taille'
      );
      $Taille->setAttribute('required', 'required');
      $form->add($Taille);
    
      $nom_medical = new text(
        'nom_medical'
      );
      $nom_medical->setAttribute('required', 'required');
      $form->add($nom_medical);

      $Prenom_medical = new text(
        'Prenom_medical'
      );
      $Prenom_medical->setAttribute('required', 'required');
      $form->add($Prenom_medical);

      $n°_de_telephone_medical = new numeric(
        'n°_de_telephone_medical'
      );
      $n°_de_telephone_medical->setAttribute('required', 'required');
      $form->add($n°_de_telephone_medical);
    
      $qualite_medical = new text(
        'qualite_medical'
      );
      $qualite_medical->setAttribute('required', 'required');
      $form->add($qualite_medical);

      $probleme_medical = new text(
        'probleme_medical'
      );
      $form->add($probleme_medical);

      $NOM_pere = new text(
        'NOM_pere'
      );
      $NOM_pere->setAttribute('required', 'required');
      $form->add($NOM_pere);

      $Prenom_pere = new text(
        'Prenom_pere'
      );
      $Prenom_pere->setAttribute('required', 'required');
      $form->add($Prenom_pere);

      $mail_pere = new text(
        'mail_pere'
      );
      $form->add($mail_pere);

      $Profession_pere = new text(
        'Profession_pere'
      );
      $form->add($Profession_pere);

      $Entreprise_pere = new text(
        'Entreprise_pere'
      );
      $form->add($Entreprise_pere);

      $NOM_mere = new text(
        'NOM_mere'
      );
      $NOM_mere->setAttribute('required', 'required');
      $form->add($NOM_mere);

      $Prenom_mere = new text(
        'Prenom_mere'
      );
      $Prenom_mere->setAttribute('required', 'required');
      $form->add($Prenom_mere);

      $mail_mere = new text(
        'mail_mere'
      );
      $form->add($mail_mere);

      $Profession_mere = new text(
        'Profession_mere'
      );
      $form->add($Profession_mere);

      $Entreprise_mere = new text(
        'Entreprise_mere'
      );
      $form->add($Entreprise_mere);
      
      $quitter_le_gymnase = new radio(
        'quitter_le_gymnase_oui',
        [
          'name' => 'quitter_le_gymnase',
          'value' => 'oui'
        ]
      );
      $form->add($quitter_le_gymnase);
      
      $quitter_le_gymnase = new radio(
        'quitter_le_gymnase_non',
        [
          'name' => 'quitter_le_gymnase',
          'value' => 'non'
        ]
      );
      $form->add($quitter_le_gymnase);
      
      $actes_medical = new radio(
        'actes_medical_oui',
        [
          'name' => 'actes_medical',
          'value' => 'oui'
        ]
      );
      $form->add($actes_medical);
      
      $actes_medical = new radio(
        'actes_medical_non',
        [
          'name' => 'actes_medical',
          'value' => 'non'
        ]
      );
      $form->add($actes_medical);
      $certificat_medical = new file(
        'certificat_medical'
      );
      $form->add($certificat_medical);
    
      $photo = new file(
        'photo'
          );
      $form->add($photo);

      $id = new hidden(
        'id',
        [
          'value'=>''
        ]   
      );
      $form->add($id);
      //  
      //envoie du formulaire à la vue
      $this->view->form = $form;
      //
      //informations latérales
      $infos = informations::find();
      $this->view->infos = $infos;
      //
      // Cas du renouvellement
      if ($this->request->hasPost('renouvellement')) {
        $this->assets->addJs('js/removeAttribute.js');
        $imail = $this->request->getPost('email');
            
        //récupération des données
        if (!empty($imail)) {
          $user = Users::find(
            [
              'conditions' => 'mail = :mail:',
              'bind'       => [
                "mail" => $imail,
              ]
            ]
          );
          if(empty($user[0])) { 
            $this->flashSession->warning("l'email est invalid");
            return $this->response->redirect('/');
          }
          $nb = count($user);
          $this->view->nb = $nb;
          //Cas de plusieurs licenciés avec la même adresse mail
          if(count($user)>1) {
            $this->assets->addCss('css/manyrenouv.css');
            $this->assets->addJs('js/manyrenouv.js');

            foreach($user as $users){
              $nom->setDefault($users->lastname);
              $Prenom->setDefault($users->firstname);
              $Adresse->setDefault($users->address);
              $Code_postal->setDefault($users->postal_code);
              $Ville->setDefault($users->city);
              if($user[0]->Sexe=="Masculin") {
                $Sexe = new radio(
                  'Masculin',
                  [
                    'name' => 'Sexe',
                    'value' => 'Masculin',
                    'checked'=>'checked'
                  ]
                );
                $form->add($Sexe);
              } else {
                $Sexe = new radio(
                  'Masculin',
                  [
                    'name' => 'Sexe',
                    'value' => 'Masculin'
                  ]
                );
                $form->add($Sexe);
              }
              if($user[0]->Sexe=="Féminin") {
                $Sexe = new radio(
                  'Feminin',
                  [
                    'name' => 'Sexe',
                    'value' => 'Feminin',
                    'checked'=>'checked'
                  ]
                );
                $Sexe->setAttribute('required', 'required');
                $Sexe->setAttribute('readonly', 'readonly');
                $form->add($Sexe);
              } else {
                $Sexe = new radio(
                  'Feminin',
                  [
                    'name' => 'Sexe',
                    'value' => 'Feminin'
                  ]
                );
                $Sexe->setAttribute('required', 'required');
                $Sexe->setAttribute('readonly', 'readonly');
                $form->add($Sexe);
              }
                    
              $Date_de_naissance->setDefault($users->birthdate);
              $N°_de_telephone_portable->setDefault($users->phone_number);
              $N°_de_telephone_fixe->setDefault($users->fix_number);
              $mail->setDefault($users->mail);
              $Taille->setDefault($users->taille);
              $medical = $users->getMedical();
              $nom_medical->setDefault($medical->firstname);
              $Prenom_medical->setDefault($medical->lastname);
              $n°_de_telephone_medical->setDefault($medical->phone_number);
              $qualite_medical->setDefault($medical->quality);
              $probleme_medical->setDefault($medical->probleme);
            }
            $this->view->user = $user;    
            //
          } else {
            $nom->setDefault($user[0]->lastname);
            $nom->setAttribute('readonly', 'readonly');

            $Prenom->setDefault($user[0]->firstname);
            $Prenom->setAttribute('readonly', 'readonly');

            $Adresse->setDefault($user[0]->address);

            $Code_postal->setDefault($user[0]->postal_code);

            $Ville->setDefault($user[0]->city);
            if ($user[0]->Sexe=="Masculin") {
              $Sexe = new radio(
                'Masculin',
                [
                  'name' => 'Sexe',
                  'value' => 'Masculin',
                  'checked'=>'checked'
                ]
              );
              $form->add($Sexe);
            } else {
              $Sexe = new radio(
                'Masculin',
                [
                  'name' => 'Sexe',
                  'value' => 'Masculin'
                ]
              );
              $form->add($Sexe);
            }
            if ($user[0]->Sexe=="Féminin") {
              $Sexe = new radio(
                'Feminin',
                [
                  'name' => 'Sexe',
                  'value' => 'Feminin',
                  'checked'=>'checked'
                ]
              );
              $Sexe->setAttribute('required', 'required');
              $Sexe->setAttribute('readonly', 'readonly');
              $form->add($Sexe);
            } else {
              $Sexe = new radio(
                'Feminin',
                [
                  'name' => 'Sexe',
                  'value' => 'Feminin'
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

            if($autorisation->quitter_le_gymnase=="oui") {
              $quitter_le_gymnase = new radio(
                'quitter_le_gymnase_oui',
                [
                  'name' => 'quitter_le_gymnase',
                  'value' => 'oui',
                  'checked'=>'checked'
                ]
              );
              $form->add($quitter_le_gymnase);
            } else {
              $quitter_le_gymnase = new radio(
                'quitter_le_gymnase_oui',
                [
                  'name' => 'quitter_le_gymnase',
                  'value' => 'oui'
                ]
              );
              $form->add($quitter_le_gymnase);
            }
            if($autorisation->quitter_le_gymnase=="non") {
              $quitter_le_gymnase = new radio(
                'quitter_le_gymnase_non',
                [
                  'name' => 'quitter_le_gymnase',
                  'value' => 'non',
                  'checked'=>'checked'
                ]
              );
              $form->add($quitter_le_gymnase);
            } else {
              $quitter_le_gymnase = new radio(
                'quitter_le_gymnase_non',
                [
                  'name' => 'quitter_le_gymnase',
                  'value' => 'non'
                ]
              );
              $form->add($quitter_le_gymnase);
            }
            if($autorisation->actes_medical=="oui") {
              $actes_medical = new radio(
                'actes_medical_oui',
                [
                  'name' => 'actes_medical',
                  'value' => 'oui',
                  'checked'=>'checked'
                ]
              );
              $form->add($actes_medical);
            } else {
              $actes_medical = new radio(
                'actes_medical_oui',
                [
                  'name' => 'actes_medical',
                  'value' => 'oui'
                ]
              );
              $form->add($actes_medical);
            }
            if($autorisation->actes_medical=="non") {
              $actes_medical = new radio(
                'actes_medical_non',
                [
                  'name' => 'actes_medical',
                  'value' => 'non',
                  'checked'=>'checked'
                ]
              );
              $form->add($actes_medical);
            } else {
              $actes_medical = new radio(
                'actes_medical_non',
                [
                  'name' => 'actes_medical',
                  'value' => 'non'
                ]
              );
              $form->add($actes_medical);
            }
            $id->setDefault($user[0]->id);
            $form->add($id);
            $this->view->form = $form;
          }
        }
      }else if ($this->request->getPost("creation")=="S'inscrire"){
        $this->assets->addJs('/js/birthdate.js');
    
        $id->setDefault('creation');
        $form->add($id);
        $this->view->form = $form;
      }
      //traitement renouvellement
      if($this->request->hasPost('id')&&$this->request->getPost('id')!="creation") {
        $id = $this->request->getPost('id');
            
        $user = Users::findFirstById($id);
        $user->setAddress($this->request->getPost('Adresse'));
        $user->setPostalCode($this->request->getPost('Code_postal'));
        $user->setCity($this->request->getPost('Ville'));
        $user->setPhoneNumber($this->request->getPost('N°_de_telephone_portable'));
        $user->setFixNumber($this->request->getPost('N°_de_telephone_fixe'));
        $user->setMail($this->request->getPost('mail'));
        $user->setTaille($this->request->getPost('Taille'));

        $user->update();

        $user->getMedical()->update(
          [
            $this->request->getPost('nom_medical'),
            $this->request->getPost('Prenom_medical'),
            $this->request->getPost('n°_de_telephone_medical'),
            $this->request->getPost('qualité'),
            $this->request->getPost('probleme_medical')
          ]
        );
        $user->getParents()->update(
          [
            $this->request->getPost('NOM_pere'),
            $this->request->getPost('Prenom_pere'),
            $this->request->getPost('mail_pere'),
            $this->request->getPost('Profession_pere'),
            $this->request->getPost('Entreprise_pere'),
            $this->request->getPost('NOM_mere'),
            $this->request->getPost('Prenom_mere'),
            $this->request->getPost('mail_mere'),
            $this->request->getPost('Profession_mere'),
            $this->request->getPost('Entreprise_mere')
          ]
        );

        $user->getAutorisation()->update(
          [
            $this->request->getPost('a1'),
            $this->request->getPost('b1')
          ]
        );
        if ($user->update()){
          var_dump("l'utilisateur est enregistre");
          return $this->response->redirect('user/inscription');
        }
      }
      //Traitement creation
      if($this->request->hasPost('id')&&$this->request->getPost('id')=="creation") {
        $user = new Users();
            
        $user->setLastname($this->request->getPost('nom'));
        $user->setFirstname($this->request->getPost('Prenom'));
        $user->setAddress($this->request->getPost('Adresse'));
        $user->setPostalCode($this->request->getPost('Code_postal'));
        $user->setCity($this->request->getPost('Ville'));
        $user->setSexe($this->request->getPost('Sexe'));
        $user->setBirthdate($this->request->getPost('Date_de_naissance'));
        $birthdate = $this->request->getPost('Date_de_naissance');
        $annee_de_naissance = substr($birthdate, 0, 4);
        $cat = date("Y") - $annee_de_naissance;
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
        $user->setPhoneNumber($this->request->getPost('N°_de_telephone_portable'));
        $user->setFixNumber($this->request->getPost('N°_de_telephone_fixe'));
        $user->setMail($this->request->getPost('mail'));
        $user->setTaille($this->request->getPost('Taille'));
    
        $user_medical = new Medical();
    
          $user_medical->setUserId($user->getId());
          $user_medical->setFirstname($this->request->getPost('nom_medical'));
          $user_medical->setLastname($this->request->getPost('Prenom_medical'));
          $user_medical->setPhoneNumber($this->request->getPost('n°_de_telephone_medical'));
          $user_medical->setQuality($this->request->getPost('qualite_medical'));
          $user_medical->setProbleme($this->request->getPost('probleme_medical'));
     
        $user->Medical = $user_medical;          
    
        $user_parents = new Parents();
          $user_parents->setUserId($user->getId());
          $user_parents->setNomDuPere($this->request->getPost('NOM_pere'));
          $user_parents->setPrenomDuPere($this->request->getPost('Prenom_pere'));
          $user_parents->setMailDuPere($this->request->getPost('mail_pere'));
          $user_parents->setProfessionDuPere($this->request->getPost('Profession_pere'));
          $user_parents->setEntrepriseDuPere($this->request->getPost('Entreprise_pere'));
          $user_parents->setNomDeLaMere($this->request->getPost('NOM_mere'));
          $user_parents->setPrenomDeLaMere($this->request->getPost('Prenom_mere'));
          $user_parents->setMailDeLaMere($this->request->getPost('mail_mere'));
          $user_parents->setProfessionDeLaMere($this->request->getPost('Profession_mere'));
          $user_parents->setEntrepriseDeLaMere($this->request->getPost('Entreprise_mere'));
    
        $user->Parents = $user_parents;
    
        $user_autorisation = new Autorisation();
    
          $user_autorisation->setUserId($user->getId());
          $user_autorisation->setQuitterLeGymnase($this->request->getPost('quitter_le_gymnase'));
          $user_autorisation->setActesMedical($this->request->getPost('actes_medical'));

          $user->Autorisation = $user_autorisation;
    
          #check if there is any file
          if($this->request->hasFiles() == true) {
            $uploads = $this->request->getUploadedFiles();
            $isUploaded = false;
            #do a loop to handle each file individually
            foreach ($uploads as $upload){
              #define a “unique” name and a path to where our file must go
              $path = ‘temp/’.md5(uniqid(rand(), true)).’-’.strtolower($upload->getname());
              #move the file and simultaneously check if everything was ok
              ($upload->moveTo($path)) ? $isUploaded = true : $isUploaded = false;
            }
          }
          $this->view->user = $user;
          $user->save();
          if($user->save()) {
            var_dump("l'utilisateur est enregistre");
            return $this->response->redirect('mail/index?email='.$this->request->getPost('mail').'&nom='.$this->request->getPost('nom').'&prenom='.$this->request->getPost('Prenom').'');
          }
          /* $this->flashSession->success('Your information was stored correctly!');*/
          //return $this->response->redirect('user/inscription');
      }
    ///formulaire commun creation et renouvellement
  }
  public function deleteAction()
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
  public function updateAction()
  {
    $this->assets->addCss('css/renouv');
    $this->assets->addJs('js/removeAttribute.js');
    $this->assets->addJs('js/birthdate.js');
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
  public function updatetraitementAction()
  {
    $identifiant = $this->session->get('identifiant');
    $mdp = $this->session->get('mdp');
    if(isset($identifiant)&&isset($mdp)) {
      $updatetraitement = Users::findFirst(
        [
          "conditions" =>  "id = :id: ",
          "bind" => [
            "id" => $this->request->getPost('id')
          ]
        ]
      );        
      $updatetraitement->setLastname($this->request->getPost('nom'));
      $updatetraitement->setFirstname($this->request->getPost('Prenom'));
      $updatetraitement->setAddress($this->request->getPost('Adresse'));
      $updatetraitement->setPostalCode($this->request->getPost('Code_postal'));
      $updatetraitement->setCity($this->request->getPost('Ville'));
      $updatetraitement->setSexe($this->request->getPost('Sexe'));
      $updatetraitement->setBirthdate($this->request->getPost('Date_de_naissance'));
      $updatetraitement->setPhoneNumber($this->request->getPost('N°_de_telephone_portable'));
      $updatetraitement->setFixNumber($this->request->getPost('N°_de_telephone_fixe'));
      $updatetraitement->setMail($this->request->getPost('mail'));
      $updatetraitement->setTaille($this->request->getPost('Taille'));

      $updatetraitement->getMedical()->update(
        [
          $this->request->getPost('nom_medical'),
          $this->request->getPost('Prenom_medical'),
          $this->request->getPost('n°_de_telephone_medical'),
          $this->request->getPost('qualité'),
          $this->request->getPost('probleme_medical')
        ]
      );
      $updatetraitement->getParents()->update(
        [
          $this->request->getPost('NOM_pere'),
          $this->request->getPost('Prenom_pere'),
          $this->request->getPost('mail_pere'),
          $this->request->getPost('Profession_pere'),
          $this->request->getPost('Entreprise_pere'),
          $this->request->getPost('NOM_mere'),
          $this->request->getPost('Prenom_mere'),
          $this->request->getPost('mail_mere'),
          $this->request->getPost('Profession_mere'),
          $this->request->getPost('Entreprise_mere')
        ]
      );
      $updatetraitement->getAutorisation()->update(
        [
          $this->request->getPost('a1'),
          $this->request->getPost('b1')
        ]
      );      
      if($updatetraitement->update()){
        $this->flashSession->succes("la mise à jour du licencié a été enregistré");
        return $this->response->redirect('/user/index');
      } else {
        $this->flashSession->warning("Probleme lors de la mise à jour du licencié");
        return $this->response->redirect('/user/index');
      }
    } else {
      echo "vous devez être authentifié";
      exit();
    }
  }
  public function modifcatAction()
  {
    $identifiant = $this->session->get('identifiant');
    $mdp = $this->session->get('mdp');
    if(isset($identifiant)&&isset($mdp)) {
    } else {
      echo "vous devez être authentifié";
      exit();
    }
  }
  public function modifcategorieAction()
  {
    $identifiant = $this->session->get('identifiant');
    $mdp = $this->session->get('mdp');
    if(isset($identifiant)&&isset($mdp)) {
      $id = $this->request->getPost('id');
      $modifcat = Users::findFirstById($id);

      if($this->request->hasPost('categorie')) {
        $categories = $this->request->getPost('categorie');
        $categorie = implode(' / ', $categories);
        $modifcat->setCategorie($categorie);
        $modifcat->update();
        return $this->response->redirect('user');
      } else {
        return $this->response->redirect('user');
      }
    } else {
      echo "vous devez être authentifié";
      exit();
    }
  }
}
