<?php

class ParametresController extends \Phalcon\Mvc\Controller
{
    public function indexAction()
    {
        $this->assets->addCss('css/menu.css');
        $this->assets->addCss('css/parametres.css');
        $idmax = Dateinsc::maximum(
        [
            "column" => "id"
        ]);   
    	$date1 = Dateinsc::findFirstById($idmax-1);
    	if ($date1!=false){
    		$this->view->date1 = $date1->getDate();
    	}else{
    		$this->view->date1 = "";
    	}
    	$date2 = Dateinsc::findFirstById($idmax);
    	if($date2!=false){
    		$this->view->date2 = $date2->getDate();
    	}else{
    		$this->view->date2 = "";
    	}
    }
    public function traitementdateinscAction()
    {
    	$dateinsc1 = new Dateinsc();
    	$dateinsc1->setDate(htmlspecialchars($this->request->getPost("date1")));
    	$dateinsc1->save();
    	$dateinsc2 = new Dateinsc();
    	$dateinsc2->setDate(htmlspecialchars($this->request->getPost("date2")));
		$dateinsc2->save();
		$this->flashSession->succes("La modification des dates a été prise en compte");
		return $this->response->redirect('/admin');
	
    }
}
