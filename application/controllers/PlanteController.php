<?php
/**
 * Description of PlanteController
 *
 * @author noelie
 */
class PlanteController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $plante = new Application_Model_Plante;
        $plantes = $plante->fetchAll();
        
        foreach ($plantes as $aPlante)
        {
        }

        $this->view->assign(array(
            'plantes' => $plantes,
        ));
    }
    
    public function addAction()
    {
        $request = $this->getRequest();
        $form = new Application_Form_Plante();
        
        if ($request->isPost())
        {
            if ($form->isValid($request->getPost()))
            {
                $plante = new Application_Model_Plante;
                $plante->assign($form->getValues());
                $plante->save();
            }
        }
        
        $this->view->assign(array(
            'form' => $form,
        ));
    }
}   

?>
