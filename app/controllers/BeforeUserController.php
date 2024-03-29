<?php
use Phalcon\Http\Request;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf; 


class UserController extends ControllerBase
{
  public function indexAction()
  {
    $this->assets->addCss(''.$_SESSION['URL'].'/public/css/main.css');
    $this->assets->addCss(''.$_SESSION['URL'].'/public/css/menu.css');
    $this->assets->addCss(''.$_SESSION['URL'].'/public/css/user.css');

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
    $this->assets->addCss(''.$_SESSION['URL'].'/public/css/renouv.css');

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
          "id" => htmlspecialchars($this->request->getPost('id'))
        ]
      ]);
      
      $renouvUser->setAddress(htmlspecialchars($this->request->getPost('Adresse')));
      $renouvUser->setPostalCode(htmlspecialchars($this->request->getPost('Code_postal')));
      $renouvUser->setCity(htmlspecialchars($this->request->getPost('Ville')));
      $renouvUser->setPhoneNumber(htmlspecialchars($this->request->getPost('N°_de_telephone_portable')));
      $renouvUser->setFixNumber(htmlspecialchars($this->request->getPost('N°_de_telephone_fixe')));
      $renouvUser->setMail(htmlspecialchars($this->request->getPost('mail')));
      $renouvUser->setTaille(htmlspecialchars($this->request->getPost('Taille')));

      $renouvUser->update();

      $renouvUser->getMedical()->update([
        htmlspecialchars($this->request->getPost('nom_medical')),
        htmlspecialchars($this->request->getPost('Prenom_medical')),
        htmlspecialchars($this->request->getPost('n°_de_telephone_medical')),
        htmlspecialchars($this->request->getPost('qualité'))
      ]);

      $renouvUser->getParents()->update([
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
      ]);

      $renouvUser->getAutorisation()->update([
        htmlspecialchars($this->request->getPost('a1')),
        htmlspecialchars($this->request->getPost('b1'))
      ]);   
    }else{
      $user = new Users();
  
      $user->setLastname(htmlspecialchars($this->request->getPost('nom')));
      $user->setFirstname(htmlspecialchars($this->request->getPost('Prenom')));
      $user->setAddress(htmlspecialchars($this->request->getPost('Adresse')));
      $user->setPostalCode(htmlspecialchars($this->request->getPost('Code_postal')));
      $user->setCity(htmlspecialchars($this->request->getPost('Ville')));
      $user->setSexe(htmlspecialchars($this->request->getPost('Sexe')));
      $user->setBirthdate(htmlspecialchars($this->request->getPost('Date_de_naissance')));
      $birthdate = htmlspecialchars($this->request->getPost('Date_de_naissance'));
      $annee_de_naissance = substr($birthdate, 0, 4);
      $cat = date("Y") - $annee_de_naissance;
      if ($cat>19)
      {
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
      $user->setPhoneNumber(htmlspecialchars($this->request->getPost('N°_de_telephone_portable')));
      $user->setFixNumber(htmlspecialchars($this->request->getPost('N°_de_telephone_fixe')));
      $user->setMail(htmlspecialchars($this->request->getPost('mail')));
      $user->setTaille(htmlspecialchars($this->request->getPost('Taille')));

      $user_medical = new Medical();

      $user_medical->setUserId($user->getId());
      $user_medical->setFirstname(htmlspecialchars($this->request->getPost('nom_medical')));
      $user_medical->setLastname(htmlspecialchars($this->request->getPost('Prenom_medical')));
      $user_medical->setPhoneNumber(htmlspecialchars($this->request->getPost('n°_de_telephone_medical')));
      $user_medical->setQuality(htmlspecialchars($this->request->getPost('qualité')));

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
      $user_autorisation->setQuitterLeGymnase(htmlspecialchars($this->request->getPost('a1')));
      $user_autorisation->setActesMedical(htmlspecialchars($this->request->getPost('b1')));

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
    $this->assets->addCss(''.$_SESSION['URL'].'/public/css/renouv');
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
          "id" => htmlspecialchars($this->request->getPost('id'))  
        ]
      ]);
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

      $updatetraitement->update();
      return $this->response->redirect(''.$_SESSION['URL'].'/user/index');
    }else{
      echo "vous devez être authentifié";
      exit();
    }
  }
  public function modifcatAction()
  {
    $identifiant = $this->session->get('identifiant');
    $mdp = $this->session->get('mdp');
    if(!isset($identifiant)&& if(!isset($mdp))
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
      $id = htmlspecialchars($this->request->getPost('id'));
      $modifcat = Users::findFirstById($id);

      if (isset($_POST['categorie']))
      {
        $categories = $_POST['categorie'];
        $categorie = implode(' / ', $categories);
        $modifcat->setCategorie($categorie);
        $modifcat->update();
        return $this->response->redirect(''.$_SESSION['URL'].'/user');
      }else{
        return $this->response->redirect(''.$_SESSION['URL'].'/user');
      }
    }else
    {
      echo "vous devez être authentifié";
      exit();
    }
  }
}
