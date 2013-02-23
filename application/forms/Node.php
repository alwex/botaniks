<?php

class Application_Form_Node extends Zend_Form
{

    public function init()
    {
        $category = new Application_Model_Category;
        $categories = $category->fetchAll();
        $categoriesMultiOptions  = array();
        foreach ($categories as $category)
        {
            $categoriesMultiOptions[$category->getId()] = $category->getLabel();
        }
        
        $this->setMethod('post');
        $this->addElement('select', 'category_id', array(
            'label' => 'catégorie du noeud',
            'multiOptions' => $categoriesMultiOptions,
            'required' => true,
            'filters' => array('StringTrim'),
            'validators' => array('NotEmpty', 'Int'),
        ));

        $this->addElement('text', 'label', array(
            'label' => 'nom du noeud',
            'required' => true,
            'filters' => array('StringTrim'),
            'validators' => array('NotEmpty'),
        ));


        $this->addElement('submit', 'submit', array(
            'ignore' => true,
            'label' => 'ajouter',
            'class' => 'btn btn-primary'
        ));
    }

}

?>
