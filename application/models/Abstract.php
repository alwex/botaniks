<?php

class Application_Model_Abstract extends Zend_Db_Table_Abstract
{
    // un id pour toutes
    // les tables
    public $c_id;

    private function setId($id)
    {
        $this->c_id = $id;
    }

    public function getId()
    {
        return $this->c_id;
    }

    public function __toString()
    {
        $array = $this->__toArray();
        $toString = '<pre>' . var_export($array, 1) . '</pre>';

        return $toString;
    }

    public function assign($data=array())
    {
        foreach ($data as $attribute => $value)
        {
            $attr = 'c_' . $attribute;
            $this->$attr = $data[$attribute];
        }
    }

    public function __toArray()
    {
    	$array = array();
    	foreach ($this as $attribute => $value)
    	{
    		if (preg_match('/^c_/', $attribute))
    		{
    			$col = substr($attribute, 2);
    			$array[$col] = $value;
    		}
    	}

    	return $array;
    }

    public function save()
    {
        $data = array();
        foreach ($this as $column => $value)
        {
            // tout attribut débutant par
            // c_ est considéré comme une colonne
            if (preg_match("/^c_/", $column))
            {
                $data[substr($column, 2)] = $value;
            }
        }

        // insert ou update ?
        if ($data['id'] === null)
        {
            unset($data['id']);
            $primaryKey = $this->insert($data);
            $this->setId($primaryKey);
        }
        else
        {
            $id = $data['id'];
            $this->update($data, array('id = ' . $id));
        }
    }

    /**
     * charge l'objet par sa clé primaire
     *
     * @param type $id
     */
    public function load($id)
    {
        $row = $this->fetchRow('id = ' . $id);
        $model = null;
        if ($row !== null)
        {
            foreach ($this as $attribute => $value)
            {
                if (preg_match('/^c_/', $attribute))
                {
                    $col = substr($attribute, 2);
                    $this->$attribute = $row->$col;
                }
            }
        }
    }

    public function fetchAll($where = null, $order = null, $count = null, $offset = null)
    {
        $models = array();
        $class = get_class($this);
        $rows = parent::fetchAll($where, $order, $count, $offset);
        if (!empty($rows))
        {
            foreach ($rows as $row)
            {
                $model = new $class;
                foreach ($this as $attribute => $value)
                {
                    if (preg_match('/^c_/', $attribute))
                    {
                        $col = substr($attribute, 2);
                        $model->$attribute = $row->$col;
                    }
                }

                $models[] = $model;
            }
        }

        return $models;
    }

    public function fetchSingle($where = null, $order = null, $count = null, $offset = null)
    {
        $model = null;
        $models = $this->fetchAll($where, $order, $count, $offset);

        if (count($models) > 0)
        {
            $model = array_shift($models);
        }

        return $model;
    }
}

?>
