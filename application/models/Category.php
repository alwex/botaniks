<?php
class Application_Model_Category extends Application_Model_Abstract
{
    protected $_name = "category";
    
    public $c_label;
    
    public function getLabel()     {
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
    
    /**
     *
     * @return array(Application_Model_CategoryAttribute)
     */
    public function getCategoryAttributes()
    {
        $categoryAttribute = new Application_Model_CategoryAttribute;
        $categoryAttributes = $categoryAttribute->fetchAll("category_id = " . $this->getId());
        
        return $categoryAttributes;
    }
}
?>
