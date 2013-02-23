<?php

class Application_Form_NodeEdit extends Zend_Form
{

    public $category_id;
    public $node_id;
    
    public function Application_Form_NodeEdit ($categoryId=null, $nodeId=null)
    {
        $this->node_id = $nodeId;
        $this->category_id = $categoryId;
        
        parent::__construct();
    }
    
    public function init()
    {
        $category = new Application_Model_Category;
        $category->load($this->category_id);
        
        $node = new Application_Model_Node;
        $node->load($this->node_id);
        
        $categoryAttributes = $category->getCategoryAttributes();
        
        $this->setMethod('post');
        
        foreach ($categoryAttributes as $categoryAttribute)
        {
            $nodeAttribute = new Application_Model_NodeAttribute();
            $where = "node_id = " . $this->node_id
                    . " AND category_attribute_id = " . $categoryAttribute->getId();
            
            $nodeAttribute = $nodeAttribute->fetchSingle($where);
            
            $value = "";
            if ($nodeAttribute != null)
            {
                $value = $nodeAttribute->getValue();
            }
            
            $this->addElement('text', $categoryAttribute->getId(), array(
                'label' => $categoryAttribute->getLabel(),
                'value' => $value,
                'required' => true,
                'filters' => array('StringTrim'),
                'validators' => array('NotEmpty'),
            ));
        }

        $this->addElement('submit', 'submit', array(
            'ignore' => true,
            'label' => 'confirmer',
            'class' => 'btn btn-primary'
        ));
    }
}

?>
