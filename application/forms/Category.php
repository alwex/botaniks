<?php

class Application_Form_Category extends Zend_Form
{
    public function init()
    {
        $this->setMethod('post');
        $this->addElement('text', 'label', array(
            'label' => 'nom de la catégorie',
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
