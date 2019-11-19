<?php
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\File;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\Radio;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Element\Date;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Email;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\PresenceOf; 
use Phalcon\Validation\Validator\Alpha;
use Phalcon\Validation\Validator\Date as DateValidator;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Confirmation;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\Regex as RegexValidator;

class AdminController extends ControllerBase
{
    public function indexAction()
    {  
    	$this->assets->addCss(''.$_SESSION['URL'].'public/css/admin.css');
		$this->assets->addCss(''.$_SESSION['URL'].'public/css/menu.css');
		//ceci est la page d'identification administrateur
        if ($this->request->isPost()) {
			if(empty($this->request->getPost('identifiant'))||empty($this->request->getPost('motdepasse'))){
				$_SESSION["flashSession"] = "Veuillez saisir un identifiant et un mot de passe";
				$this->flashSession->warning("Veuillez saisir un identifiant et un mot de passe");
				return $this->response->redirect(''.$_SESSION['URL'].'');				
			}
			else
			{
				//Récupération de l'admin depuis la bdd en fonction de l'identifiant renseigné dans le formulaire
				$admin = Admin::findFirst([
					"conditions" =>  "identifiant = :identifiant:",
					"bind" => [
						"identifiant" => htmlspecialchars($this->request->getPost('identifiant')),
					]
				]);
				$password = $this->request->getPost('motdepasse');
				if ($admin) {
					// Vérifiaction du mot de passe 
					if ($this->security->checkHash($password, $admin->mdp)) {
						$this->session->set('identifiant', htmlspecialchars($this->request->getPost('identifiant')));
						$this->session->set('mdp', htmlspecialchars($this->request->getPost('motdepasse')));
						$this->session->set('name', $admin->getNom());
						$this->session->set('fonction', $admin->getFonction());
						$identifiant = $this->session->get('identifiant');
						$mdp = $this->session->get('mdp');
						$fonction = $this->session->get('fonction');	
						admin(); // on accede à la page admin

					} 
					else 
					{
						$this->security->hash(rand());
						$_SESSION['flashSession'] = "Erreur de mot de passe";  
						$this->flashSession->error("Erreur de mot de passe");
						return $this->response->redirect('/'.$_SESSION['URL'].'');
					}	
				} 
				else 
				{
					$this->security->hash(rand());
					$_SESSION['flashSession'] = "Erreur d'identifiant";  
					$this->flashSession->error("Erreur d'identifiant");
					return $this->response->redirect('/'.$_SESSION['URL'].'');
				}
			}
		}
	}
	private function admin()
	{
		$identifiant = $this->session->get('identifiant');
		$mdp = $this->session->get('mdp');
		$name = $this->session->get('name');
		$this->view->name = $name;
		$users = Users::find();
		$categories = array();
		foreach ($users as $user) 
		{
			if (!array_key_exists($user->categorie, $categories)) 
			{
				$categories[$user->categorie] = 1;
			} 
			else 
			{
				$categories[$user->categorie] += 1;
			}
		}
		$this->view->categories = $categories;
	}
	public function utilisateursAction()
	{
		$this->assets->addCss('/'.$_SESSION['URL'].'/public/css/utilisateurs.css');
		$this->assets->addCss('/'.$_SESSION['URL'].'/public/css/menu.css');
				
		$identifiant = $this->session->get('identifiant');
		$mdp = $this->session->get('mdp');
		$fonction = $this->session->get('fonction');
		if(isset($identifiant)&&isset($mdp)){
			if ($fonction=="super-admin") 
			{
                $utilisateurs = Admin::find();
                $this->view->utilisateurs = $utilisateurs;
			}
			else
			{ 
				$this->flashSession->warning("Vous n'avez pas acces à cette page");
				return $this->response->redirect('/'.$_SESSION['URL'].'/admin/index');
			}
		}
		else
		{
			$this->flashSession->warning("Veuillez vous authentifiez");
			return $this->response->redirect('/'.$_SESSION['URL'].'');
		}

	}
	public function modifierAction()
	{
		$id = $_GET['id'];
		$modifier = Admin::findFirstById($id);
		$this->view->modifier = $modifier;
	}
	public function modificationAction()
	{
		$id = $_POST['id'];
		$modification = Admin::findFirstById($id);
		$modification->setNom(htmlspecialchars($this->request->getPost("nom")));
		$modification->setPrenom(htmlspecialchars($this->request->getPost("prenom")));
		$modification->setIdentifiant(htmlspecialchars($this->request->getPost("identifiant")));
		$password = htmlspecialchars($this->request->getPost("mdp"));
		$modification->setMdp($this->security->hash($password));

		$modification->update();
		return $this->response->redirect('/'.$_SESSION['URL'].'/admin/utilisateurs');
	}
	public function deleteAction()
	{
		$id = $_GET['id'];
		$delete = Admin::findFirstById($id);
		$delete->delete();
		return $this->response->redirect('/'.$_SESSION['URL'].'/admin/utilisateurs');
	}

	public function addAction()
	{
	}
	public function ajouterAction()
	{
		$ajouter = new Admin();
		$ajouter->setIdentifiant(htmlspecialchars($this->request->getPost('identifiant')));
		$ajouter->setNom(htmlspecialchars($this->request->getPost('nom')));
		$ajouter->setPrenom(htmlspecialchars($this->request->getPost('prenom')));
	
		$password = $this->request->getPost('mdp');
		$ajouter->setMdp(htmlspecialchars($this->security->hash($password)));
		$ajouter->setFonction(htmlspecialchars($this->request->getPost('fonction')));
		$ajouter->setEmail(htmlspecialchars($this->request->getPost('email')));
		$ajouter->setPhoneNumber(htmlspecialchars($this->request->getPost('phone_number')));

		$ajouter->save();
		return $this->response->redirect('/'.$_SESSION['URL'].'/admin/utilisateurs');
	}
	public function mdp_forgetAction()
	{
		$form = new form();

		$adresse_email = new email(
			'email'
		);
		$adresse_email->setAttribute('required', 'required');
		$form->add($adresse_email);

		$this->view->form = $form;

		if($_POST['envoyer'])
		{
			$mdp_forget = Admin::findFirst([
				"conditions" =>  "email = :email:",
				"bind" => [
					"email" => $this->request->getPost('email'),
				]
			]);
			if($mdp_forget)
			{
				$this->flashSession->succes("Vous aller recevoir un email afin de réinitialiser votre mot de passe");
				return $this->response->redirect(''.$_SESSION['URL'].'/');
				$this->session->set('mail', $mdp_forget->email);
				$this->session->set('nb', rand());
				//Variables du formulaire
				$mail = $mdp_forget->email;
				$nom = $mdp_forget->nom;
				/*$prenom = "quentin";
				$email = "quentin42.bonnet@laposte.net";
				$phone = "0652557816";
				$date = "11/10/2018";
				$message = "bonjour quentin bonnet c'est moi";*/
				
				// Mail
				$objet = utf8_decode('Réinitialisation du mot de passe' ); 
				$contenu = '
				<html>
				<head>
				<title>Réinitialisation du mot de passe</title>
				</head>
				<body>
				<p>Bonjour Mr/Mmme '.$nom.'</p>
				<p>Vous avez demandé la réinitialisation du mot de passe</p>
				<a href="asul.local/admin/mdp_forget_traitement?email='.$this->session->get('mail').'&id='.$this->session->get('nb').'">cliquez ici</a>
				
				</body>
				</html>';
				$entetes = 'Content-type: text/html; charset=\"ISO-8859-1\"' . "\r\n" .
				'From: quentin42.bo@laposte.net' . "\r\n" .
				'Reply-To: quentin42.bo@laposte.net' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();
										
				//Envoi du mail
				mail($mail, $objet, $contenu, $entetes);
				exit();
			}
			else
			{
				$this->flashSession->warning("l'adresse mail n'existe pas");
				return $this->response->redirect(''.$_SESSION['URL'].'/');
			}
		}
	}
	public function mdp_forget_traitementAction()
	{
		if($this->session->has('mail')&&$_GET['id']==$this->session->get('nb'))
		{
			$form = new form;

			$nouveau_mdp = new password(
				'password'
			);
			$nouveau_mdp->setAttribute('required', 'required');
			$form->add($nouveau_mdp);

			$confim_nouveau_mdp = new password(
				'confirm_nouveau_mdp'
			);
			$confim_nouveau_mdp->setAttribute('required', 'required');
			$form->add($confim_nouveau_mdp);

			$this->view->form = $form;

			if(isset($_POST['envoyer']))
			{
				$new_Mdp = $this->request->getPost('password');
				$confirm_New_Mdp = $this->request->getPost('confirm_nouveau_mdp');
				//$mail = $this->session->get('mail');
				$mail = $_GET['email'];
				
				if($new_Mdp==$confirm_New_Mdp){	
					$new_password = Admin::findFirst(
						[
							'conditions' => "email LIKE :mail:",
							'bind' =>[
								'mail' => $mail,
							],
						]
						);
					$new_password->setMdp($this->security->hash(htmlspecialchars($this->request->getPost('password')))); 
					$new_password->update();
					if($new_password->update())
					{
						$this->flashSession->succes("Votre mot de passe a bien été modifié");
						return $this->response->redirect(''.$_SESSION['URL'].'/');	
						$this->session->destroy();
						exit();						
					}
					else
					{ 
						$this->flashSession->warning("Un problème technique a empecher la création d'un nouveau mot de passe");
						return $this->response->redirect(''.$_SESSION['URL'].'/');
					}
				}
				else
				{
					$this->flashSession->warning("les mots de passe ne sont pas identiques");
					return $this->response->redirect(''.$_SESSION['URL'].'/');
				}		
			}
		}
		else
		{ ?>
			<script> alert("ALERTE !!! Une tentative intrusion a été détecté. Votre adresse IP a été enregistré.");</script>
			<?php exit();

		}
	}	
	public function change_mdpAction()
	{
		$form = new form();

		$old_Mdp = new password(
			'old_Mdp'
		);
		$old_Mdp->setAttribute('required', 'required');
		$form->add($old_Mdp);

		$new_Mdp = new password(
			'new_Mdp'
		);
		$new_Mdp->setAttribute('required', 'required');
		$form->add($new_Mdp);

		$confirm_New_Mdp = new password(
			'confirm_New_Mdp'
		);
		$confirm_New_Mdp->setAttribute('required', 'required');
		$form->add($confirm_New_Mdp);

		$this->view->form = $form; 

		if(isset($_POST['envoyer']))
		{
			$identifiants = $this->session->get('identifiant');
			$mdp_saisi = $this->request->getPost('old_Mdp');
			$new_Mdp = $this->request->getPost('new_Mdp');
			$confirm_New_Mdp = $this->request->getPost('confirm_New_Mdp');
			if($new_Mdp == $confirm_New_Mdp)
			{	
				$modif_mdp = Admin::findFirst(
					[
						'conditions' => "identifiant LIKE :identifiants:",
						'bind' =>[
							'identifiants' => $identifiants,
						],
					]
					);
				if ($this->security->checkHash($mdp_saisi, $modif_mdp->getMdp())) 
				{
					$modif_mdp->setMdp($this->security->hash(htmlspecialchars($this->request->getPost('new_Mdp')))); 
					$modif_mdp->update();
					if($modif_mdp->update())
					{
						$this->flashSession->succes("Votre mot de passe a bien été modifié");
						return $this->response->redirect(''.$_SESSION['URL'].'/admin/index');			
					}
					else
					{
						$this->flashSession->warning("Le mot de passe est incorrect");
						return $this->response->redirect(''.$_SESSION['URL'].'/admin/index');	
					}
				} 
				$this->flashSession->warning("les mots de passe ne sont pas identiques");
				return $this->response->redirect(''.$_SESSION['URL'].'/admin/index');
			}
		}
	}
	public function changeProfilAction()
	{
		$identifiants = $this->session->get('identifiant');
		$profil = Admin::findFirst(
			[
				'conditions' => "identifiant LIKE :identifiants:",
				'bind' =>[
					'identifiants' => $identifiants,
				],
			]
			);

		$form = new form();

		$identifiant = new text(
			'identifiant'
		);
		$identifiant->setDefault($profil->getIdentifiant());
		$identifiant->setAttribute('required', 'required');
		$form->add($identifiant);

		$lastname = new text(
			'lastname'
		);
		$lastname->setDefault($profil->getNom());
		$lastname->setAttribute('readonly', 'readonly');
		$form->add($lastname);

		$firstname = new text(
			'firstname'
		);
		$firstname->setDefault($profil->getPrenom());
		$firstname->setAttribute('readonly', 'readonly');
		$form->add($firstname);

		$password = new password(
			'password'
		);
		$password->setDefault('****');
		$password->setAttribute('readonly', 'readonly');
		$form->add($password);

		$fonction = new text(
			'fonction'
		);
		$fonction->setDefault($profil->getFonction());
		$fonction->setAttribute('readonly', 'readonly');
		$form->add($fonction);

		$email = new email(
			'email'
		);
		$email->setDefault($profil->getEmail());
		$email->setAttribute('required', 'required');
		$form->add($email);
		$phone_number = new text(
			'phone_number'
		);
		$phone_number->setDefault($profil->getPhoneNumber());
		$phone_number->setAttribute('required', 'required');
		$form->add($phone_number);
		$this->view->form = $form;
		if ($_POST['envoyer']) 
		{
            $profil->setIdentifiant($this->request->getPost('identifiant'));
            $profil->setNom($this->request->getPost('lastname'));
            $profil->setPrenom($this->request->getPost('firstname'));
            $profil->setEmail($this->request->getPost('email'));
			$profil->setPhoneNumber($this->request->getPost('phone_number'));
			$profil->update();
			if($profil->update())
			{
				$this->flashSession->succes("Votre profil a bien été modifié");
				return $this->response->redirect(''.$_SESSION['URL'].'/admin/index');
				$this->session->set('identifiant', $this->request->getPost('identifiant'));
				exit();
			}
        }	
	}
	public function delete_sessionAction()
	{
		$this->session->destroy();
		$this->flashSession->succes("vous avez bien été déconnecté");
		return $this->response->redirect(''.$_SESSION['URL'].'/');		
	}
}
