<?php
use Phalcon\Forms\form;
class IndexController extends ControllerBase
{
	public function indexAction()
	{
		/*Ceci charge la page d'acceueil (view/index/index) */
		$this->assets->addCss('css/accueil.css');
		$lastId = Dateinsc::maximum(
            [
                "column" => "id"
            ]);
    	$date1 = Dateinsc::findFirstById($lastId-1);
    	if ($date1!=false){	
			$date1 = explode("-", $date1->date);
			$dateFr1=$date1[2].'-'.$date1[1].'-'.$date1[0];
			$this->view->date1 = $dateFr1;
    	}else{
    		$this->view->date1 = "";
    	}
    	$date2 = Dateinsc::findFirstById($lastId);
    	if($date2!=false){
			$date2 = explode("-", $date2->date);
			$dateFr2=$date2[2].'-'.$date2[1].'-'.$date2[0];
    		$this->view->date2 = $dateFr2;
    	}else{
    		$this->view->date2 = "";
		}
				
	}
}
