<?php
class CategoryAttributeController extends Zend_Controller_Action
{
    public function deleteAction()
    {
        $id = $this->getRequest()->getParam('id', null);
        $url = $this->getRequest()->getParam('url', '/');
        if ($url != null)
        {
            $url = base64_decode($url);
        }
        if ($id != null)
        {
            $categoryAttribute = new Application_Model_CategoryAttribute;
            $categoryAttribute->delete('id = ' . $id);
        }
        
        $this->redirect($url);
    }
}
?>
