<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initDoctype()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_STRICT');
    }

    protected function _initZFDebug()
    {
        // Setup autoloader with namespace
        $autoloader = Zend_Loader_Autoloader::getInstance();
        $autoloader->registerNamespace('ZFDebug');

        // Ensure the front controller is initialized
        $this->bootstrap('FrontController');

        // Retrieve the front controller from the bootstrap registry
        $front = $this->getResource('FrontController');

        $db = $this->getPluginResource('db')->getDbAdapter();
        // Only enable zfdebug if options have been specified for it
        if ($this->hasOption('zfdebug'))
        {
            // Create ZFDebug instance
            $zfdebug = new ZFDebug_Controller_Plugin_Debug($this->getOption('zfdebug'));
            $zfdebug->registerPlugin(new ZFDebug_Controller_Plugin_Debug_Plugin_Database(array('adapter' => $db)));
            // Register ZFDebug with the front controller
            $front->registerPlugin($zfdebug);
        }
    }

}

