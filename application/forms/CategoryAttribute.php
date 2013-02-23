<?php

class Application_Form_CategoryAttribute extends Zend_Form
{
    public function init()
    {
        $this->setMethod('post');
        $this->addElement('text', 'label', array(
            'label' => 'nom de l\'attribut',
            'required' => true,
            'filters' => array('StringTrim'),
            'validators' => array('NotEmpty'),
        ));
        
        $this->addElement('hidden', 'category_id', array(
            'required' => true,
            'filters' => array('StringTrim'),
            'validators' => array('Int'),
        ));

        $this->addElement('submit', 'submit', array(
            'ignore' => true,
            'label' => 'ajouter',
            'class' => 'btn btn-primary'
        ));
    }
}

?>
