<?php

class Application_Model_Node extends Application_Model_Abstract
{

    protected $_name = "node";
    public $c_label;
    public $c_category_id;

    public function getLabel()
    {
        return $this->c_label;
    }

    /**
     * @return Application_Model_Category
     */
    public function setLabel($c_label)
    {
        $this->c_label = $c_label;
        return $this;
    }

    public function getCategoryId()
    {
        return $this->c_category_id;
    }

    /**
     *
     * @param type $c_category_id
     * @return Application_Model_Node 
     */
    public function setCategoryId($c_category_id)
    {
        $this->c_category_id = $c_category_id;
        return $this;
    }

    public function getCategory()
    {
        $category = null;
        if ($this->c_category_id != null)
        {
            $category = new Application_Model_Category;
            $category->load($this->c_category_id);
        }
        
        return $category;
    }
    
    public function getNodeAttributes()
    {
        $nodeAttribute = new Application_Model_NodeAttribute;
        $nodeAttributes = $nodeAttribute->fetchAll("node_id = " . $this->getId());
        
        return $nodeAttributes;
    }
}

?>
