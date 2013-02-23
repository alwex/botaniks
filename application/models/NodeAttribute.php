<?php

class Application_Model_NodeAttribute extends Application_Model_Abstract
{
    // tablename
    protected $_name = "node_attribute";
    // columns
    public $c_label;
    public $c_value;
    public $c_node_id;
    public $c_category_attribute_id;

    public function getLabel()
    {
        return $this->c_label;
    }

    /**
     * @return Application_Model_NodeAttribute
     */
    public function setLabel($c_label)
    {
        $this->c_label = $c_label;
        return $this;
    }

    /**
     * @return Application_Model_NodeAttribute
     */
    public function setValue($c_value)
    {
        $this->c_value = $c_value;
        return $this;
    }
    
    public function getValue()
    {
        return $this->c_value;
    }
    
    /**
     * @return Application_Model_NodeAttribute
     */
    public function setCategoryAttributeId($categoryAttributeId)
    {
        $this->c_category_attribute_id = $categoryAttributeId;
        return $this;
    }
    
    public function getCategoryAttributeId()
    {
        return $this->c_category_attribute_id;
    }
    
    public function getNode()
    {
        $node = null;
        if ($this->node_id != null)
        {
            $node = new Application_Model_Node;
            $node->load($this->c_node_id);
        }

        return $node;
    }

    /**
     * @return Application_Model_NodeAttribute
     */
    public function setNode(Application_Model_Node $node)
    {
        $this->c_node_id = $node->getId();
        return $this;
    }

}

?>
