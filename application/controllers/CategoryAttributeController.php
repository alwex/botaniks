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

	public function editAction()
	{
		$id = $this->getRequest()->getParam('id', null);
		$url = $this->getRequest()->getParam('url', '/');

		if ($url != null)
		{
			$url = base64_decode($url);
		}

		$categoryAttribute = new Application_Model_CategoryAttribute;
		if ($id != null)
		{
			$categoryAttribute->load($id);
		}

		$request = $this->getRequest();
		$form = new Application_Form_CategoryAttribute();
		$form->setDefaults($categoryAttribute->__toArray());

		if($request->isPost())
		{
			if ($form->isValid($request->getPost()))
			{
				$categoryAttribute->assign($form->getValues());
				$categoryAttribute->save();
			}
		}

		$this->view->assign(array(
				'categoryAttribute' => $categoryAttribute,
				'form' => $form,
				'url' => $url,
		));
	}
}
?>
