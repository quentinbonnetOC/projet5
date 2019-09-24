<?php

class EquipeController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
    	$identifiant = $this->session->get('identifiant');
        $mdp = $this->session->get('mdp');
    	if(isset($identifiant)&&isset($mdp)){
	    	$this->tag->setDefault("menu", "emptyText");
	    	$equipes = Equipes::find();
			$this->view->equipes = $equipes;		
		}else{
			echo "vous devez être authentifié";
			exit();
		}
    }
    public function deleteAction()
    {
        $identifiant = $this->session->get('identifiant');
        $mdp = $this->session->get('mdp');
    	$id = $_GET['id'];
    	$delete = Equipes::findFirstById($id);
    	$delete->delete();
    	return $this->response->redirect('user'); 
    }
    public function newequipeAction()
    {
    	$equipe = new equipes();
    	$equipe->setName(htmlspecialchars($this->request->getPost('nom')));
    	$equipe->save();
    	return $this->response->redirect('user'); 
    }
}