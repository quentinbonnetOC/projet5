<?php

class InformationController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
        $this->assets->addCss('css/informations.css');
        $this->assets->addCss('css/menu.css');
    	$view = Informations::find();
    	$this->view->view = $view;
    }
    public function traitementAction()
    {
    	/*$text = $this->request->getPost('text');
    	if (isset($text)) {*/
    	$informations = new Informations();
    	$informations->setText($this->request->getPost('text'));
    	$informations->save();
        return $this->response->redirect('information/index');
    	/*}*/
    
    }
    public function deleteAction()
    {
        $id = $_GET['id'];
        $delete = Informations::findFirstById($id);
        $delete->delete();
        return $this->response->redirect('information/index');

    }
}

?>