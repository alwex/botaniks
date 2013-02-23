<?php
class Application_Model_CategoryAttribute extends Application_Model_Abstract
{
    protected $_name = "category_attribute";
    
    public $c_label;
    public $c_category_id;
            
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
    
    public function getCategory()
    {
        $category = null;
        if ($this->category_id != null)
        {
            $category = new Application_Model_Category;
            $category->load($this->c_category_id);
        }
        
        return $category;
    }
    
    public function setCategory(Application_Model_Category $category)
    {
        $this->c_category_id = $category->getId();
    }
}
?>
