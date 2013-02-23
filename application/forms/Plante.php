<?php

/**
 * Description of Application_Form_Plante
 *
 * @author noelie
 */
class Application_Form_Plante extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');
        $this->addElement('text', 'nom', array(
            'label' => 'nom de la plante',
            'required' => true,
            'filters' => array('StringTrim'),
            'validators' => array('NotEmpty'),
        ));

        $this->addElement('textarea', 'description', array());

        $this->addElement('submit', 'submit', array(
            'ignore' => true,
            'label' => 'ajouter',
            'class' => 'btn btn-primary'
        ));
    }

}

?>
