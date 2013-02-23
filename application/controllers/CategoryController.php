<?php
class CategoryController extends Zend_Controller_Action
{

    public function indexAction()
    {
        $category = new Application_Model_Category;
        $categories = $category->fetchAll();

        $this->view->assign(array(
            'categories' => $categories,
        ));
    }

    public function addAction()
    {
        $request = $this->getRequest();
        $form = new Application_Form_Category();

        if ($request->isPost())
        {
            if ($form->isValid($request->getPost()))
            {
                $plante = new Application_Model_Category();
                $plante->assign($form->getValues());
                $plante->save();
            }
        }

        $this->view->assign(array(
            'form' => $form,
        ));
    }

    public function editAction()
    {
        $id = $this->getRequest()->getParam('id', null);
        $category = new Application_Model_Category;
        $category->load($id);

        $request = $this->getRequest();
        $form = new Application_Form_CategoryAttribute();
        $form->getElement('category_id')->setValue($category->getId());

        if ($request->isPost())
        {
            if ($form->isValid($request->getPost()))
            {
                $categoryAttribute = new Application_Model_CategoryAttribute;
                $categoryAttribute->assign($form->getValues());
                $categoryAttribute->save();
            }
        }

        $categoryAttribute = new Application_Model_CategoryAttribute;
        $categoryAttributes = $categoryAttribute->fetchAll('category_id = ' . $category->getId());

        $this->view->assign(array(
            'category' => $category,
            'categoryAttributes' => $categoryAttributes,
            'url' => Zend_Controller_Front::getInstance()->getRequest()->getRequestUri(),
            'form' => $form,
        ));
    }

}

?>
