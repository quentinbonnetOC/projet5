<?php
use Phalcon\Http\Request;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf; 


class UserController extends ControllerBase
{

  public function indexAction()
  {
      $this->assets->addCss('css/main.css');
      $this->assets->addCss('css/menu.css');
      $this->assets->addCss('css/user.css');

    $identifiant = $this->session->get('identifiant');
    $mdp = $this->session->get('mdp');
    if(isset($identifiant)&&isset($mdp))
    {
      $users = Users::find();
      $this->view->users = $users;
    }else{
      echo "vous devez être authentifié";
      exit();
    }   
  }

  public function renouvAction()
  {  

   $this->assets->addCss('css/renouv.css');

    $request = new Request();
		if ($request->isPost()){
			$email = $request->getPost('email');
			$user = Users::findFirst(
        [
          'conditions' => 'mail = :email:',
				  'bind'       => [
            "email" => $email,
          ]
			  ]
			);


			
		  if(!$user){
			 echo "l'email n'est pas valide";
			
			 exit();
		  }

      
      $this->view->lastname = $user->lastname;
  		$this->view->firstname = $user->firstname;
  		$this->view->address = $user->address;
  		$this->view->postal_code = $user->postal_code;
  		$this->view->city = $user->city;
  		$this->view->sexe = $user->sexe;
  		$this->view->birthdate = $user->birthdate;
  		$this->view->categorie = $user->categorie;
  		$this->view->phone_number = $user->phone_number;
  		$this->view->fix_number = $user->fix_number;
  		$this->view->mail = $user->mail;
  		$this->view->taille = $user->taille;
      $this->view->id = $user->id;
        



      $parents = $user->getParents();
     
      $this->view->nom_du_pere = $parents->nom_du_pere;
      $this->view->prenom_du_pere = $parents->prenom_du_pere;
      $this->view->mail_du_pere = $parents->mail_du_pere;
      $this->view->profession_du_pere = $parents->profession_du_pere;
      $this->view->entreprise_du_pere = $parents->entreprise_du_pere;
      $this->view->nom_de_la_mere = $parents->nom_de_la_mere;
      $this->view->prenom_de_la_mere = $parents->prenom_de_la_mere;
      $this->view->mail_de_la_mere = $parents->mail_de_la_mere;
      $this->view->profession_de_la_mere = $parents->profession_de_la_mere;
      $this->view->entreprise_de_la_mere = $parents->entreprise_de_la_mere;

      $medical = $user->getMedical();


      $this->view->firstname = $medical->firstname;
      $this->view->lastname = $medical->lastname;
      $this->view->phone_number = $medical->phone_number;
      $this->view->quality = $medical->quality;

      $autorisation = $user->getAutorisation();  

      $this->view->quitter_le_gymnase = $autorisation->quitter_le_gymnase;
      $this->view->actes_medical = $autorisation->actes_medical;

		}else{
      
      $this->view->readonly = $readonly ;
  		$this->view->lastname = "";
  		$this->view->firstname = "";
  		$this->view->address = "";
  		$this->view->postal_code = "";
  		$this->view->city = "";
  		$this->view->sexe = "";
  		$this->view->birthdate = "";
  		$this->view->categorie = "";
  		$this->view->phone_number = "";
  		$this->view->fix_number = "";
  		$this->view->mail = "";
  		$this->view->taille = "";
      $this->view->id = "";

      $this->view->nom_du_pere = "";
      $this->view->prenom_du_pere = "";
      $this->view->mail_du_pere = "";
      $this->view->profession_du_pere = "";
      $this->view->entreprise_du_pere = "";
      $this->view->nom_de_la_mere = "";
      $this->view->prenom_de_la_mere = "";
      $this->view->mail_de_la_mere = "";
      $this->view->profession_de_la_mere = "";
      $this->view->entreprise_de_la_mere = "";

      $this->view->firstname = "";
      $this->view->lastname = "";
      $this->view->phone_number = "";
      $this->view->quality  = "";

      $this->view->quitter_le_gymnase = "";
      $this->view->actes_medical = "";

				/*informations latérales*/
        $infos = informations::find();
        $this->view->infos = $infos;
		}
	}
  

    public function inscriptionAction()
    {
        if (/*isset($this->request->getPost('id')) &&*/ !empty($this->request->getPost('id')))
        {
          $renouvUser = Users::findFirst([
            "conditions" =>  "id = :id: ",
            "bind" => [
              "id" => $this->request->getPost('id')   ]
                ]);
          
          $renouvUser->setAddress($this->request->getPost('Adresse'));
          $renouvUser->setPostalCode($this->request->getPost('Code_postal'));
          $renouvUser->setCity($this->request->getPost('Ville'));
          $renouvUser->setPhoneNumber($this->request->getPost('N°_de_telephone_portable'));
          $renouvUser->setFixNumber($this->request->getPost('N°_de_telephone_fixe'));
          $renouvUser->setMail($this->request->getPost('mail'));
          $renouvUser->setTaille($this->request->getPost('Taille'));

          $renouvUser->update();

          $renouvUser->getMedical()->update([

          $this->request->getPost('nom_medical'),
          $this->request->getPost('Prenom_medical'),
          $this->request->getPost('n°_de_telephone_medical'),
          $this->request->getPost('qualité')
          ]);

          $renouvUser->getParents()->update([

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
          ]);

          $renouvUser->getAutorisation()->update([

          $this->request->getPost('a1'),
          $this->request->getPost('b1')
          ]);   


        }else{
      
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
          if ($cat>19) {
            $user->setCategorie("SENIOR");
          }elseif ($this->request->getPost('Sexe')=="Féminin"&&$cat>=15&&$cat<=17)
          {
            $user->setCategorie("U18");
          }else
          {
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
          $user_medical->setQuality($this->request->getPost('qualité'));

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
          $user_autorisation->setQuitterLeGymnase($this->request->getPost('a1'));
          $user_autorisation->setActesMedical($this->request->getPost('b1'));

          $user->Autorisation = $user_autorisation;

          #check if there is any file
          if($this->request->hasFiles() == true){
            $uploads = $this->request->getUploadedFiles();
            $isUploaded = false;
            #do a loop to handle each file individually
            foreach($uploads as $upload){
              #define a “unique” name and a path to where our file must go
               $path = ‘temp/’.md5(uniqid(rand(), true)).’-’.strtolower($upload->getname());
               #move the file and simultaneously check if everything was ok
              ($upload->moveTo($path)) ? $isUploaded = true : $isUploaded = false;
            }
          }
          $user->save();
        } 
    }
  public function deleteAction()
  {
    $identifiant = $this->session->get('identifiant');
    $mdp = $this->session->get('mdp');
    if(isset($identifiant)&&isset($mdp))
    {
      $id = $_GET['id'];
      $delete = Users::findById($id);
      $delete->delete();
      return $this->response->redirect('user'); 
    }else{
      echo "vous devez être authentifié";
      exit();
    }
  }
  public function updateAction()
  {
    $this->assets->addCss('css/renouv');
    $identifiant = $this->session->get('identifiant');
    $mdp = $this->session->get('mdp');
    if(isset($identifiant)&&isset($mdp))
    {
      $id =  $_GET['id'];
      $user = Users::findFirstById($id);
      $this->view->nom = $user;
      

      $medical = Medical::findFirstByUserId($id);
      $this->view->medical = $medical;


      $parent = Parents::findFirstByUserId($id);
      $this->view->parent = $parent;


      $autorisation = Autorisation::findFirstByUserId($id);
      $this->view->autorisation = $autorisation;
    }else{
      echo "vous devez être authentifié";
      exit();
    }
  }
  public function updatetraitementAction()
  {
    $identifiant = $this->session->get('identifiant');
    $mdp = $this->session->get('mdp');
    if(isset($identifiant)&&isset($mdp))
    {
      $updatetraitement = Users::findFirst([
        "conditions" =>  "id = :id: ",
        "bind" => [
          "id" => $this->request->getPost('id')   
        ]
      ]);
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

      $updatetraitement->update();
      return $this->response->redirect('user/index');
    }else{
      echo "vous devez être authentifié";
      exit();
    }

  }
  public function modifcatAction()
  {
    $identifiant = $this->session->get('identifiant');
    $mdp = $this->session->get('mdp');
    if(isset($identifiant)&&isset($mdp))
    {

    }else{
      echo "vous devez être authentifié";
      exit();
    }
    
  }
  public function modifcategorieAction()
  {
    $identifiant = $this->session->get('identifiant');
    $mdp = $this->session->get('mdp');
    if(isset($identifiant)&&isset($mdp))
    {
      $id = $this->request->getPost('id');
      $modifcat = Users::findFirstById($id);

      if (isset($_POST['categorie']))
      {
        $categories = $_POST['categorie'];
        $categorie = implode(' / ', $categories);
        $modifcat->setCategorie($categorie);
        $modifcat->update();
        return $this->response->redirect('user');
      }else{
        return $this->response->redirect('user');
      }
      

    }else
    {
      echo "vous devez être authentifié";
      exit();
    }
  }

}
