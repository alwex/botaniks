<?php

class NodeController extends Zend_Controller_Action
{

    public function indexAction()
    {
        $node = new Application_Model_Node;
        $nodes = $node->fetchAll();

        $this->view->assign(array(
            'nodes' => $nodes,
            'url' => Zend_Controller_Front::getInstance()->getRequest()->getRequestUri(),
        ));
    }

    public function addAction()
    {
        $request = $this->getRequest();
        $form = new Application_Form_Node();

        if ($request->isPost())
        {
            if ($form->isValid($request->getPost()))
            {
                $node = new Application_Model_Node();
                $node->assign($form->getValues());
                $node->save();
            }
        }

        $this->view->assign(array(
            'form' => $form,
        ));
    }

    public function editAction()
    {
        $id = $this->getRequest()->getParam('id', null);
        $request = $this->getRequest();
        $node = new Application_Model_Node;
        $node->load($id);

        $form = new Application_Form_NodeEdit($node->getCategoryId(), $node->getId());

        if ($request->isPost())
        {
            if ($form->isValid($request->getPost()))
            {
                $nodeAttributes = $form->getValues();
                foreach ($nodeAttributes as $id => $value)
                {
                    $categoryAttribute = new Application_Model_CategoryAttribute;
                    $categoryAttribute->load($id);

                    // on charge l'attribut
                    $nodeAttribute = new Application_Model_NodeAttribute;
                    $where = "category_attribute_id = " . $id
                            . " AND node_id = " . $node->getId();

                    $nodeAttribute = $nodeAttribute->fetchSingle($where);

                    // l'attribut n'existe pas on le créé
                    if ($nodeAttribute == null)
                    {
                        $nodeAttribute = new Application_Model_NodeAttribute;
                        $nodeAttribute->setNode($node)
                                ->setLabel($categoryAttribute->getLabel())
                                ->setCategoryAttributeId($categoryAttribute->getId());
                    }

                    $nodeAttribute->setValue($value);
                    $nodeAttribute->save();
                }
            }
        }

        $this->view->assign(array(
            'node' => $node,
            'form' => $form,
        ));
    }

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
            $node = new Application_Model_Node;
            $node->delete('id = ' . $id);
        }

        $this->redirect($url);
    }

    public function editOldAction()
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
