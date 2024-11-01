<?php

/**
 * Abstract for main plugin class
 */
class AbstractFrameworkClass {
    
    /**
     * wpelements
     * @var wpelements 
     */
    protected $_wpelements;
    
    public function __construct() { 
        $this->_wpelements = new WP_elements();
    }
    
}