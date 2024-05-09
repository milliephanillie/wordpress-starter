<?php


namespace IDP\Helper\Utilities;

class PluginPageDetails
{
    function __construct($Cb, $Wh, $H6, $QO, $kD)
    {
        $this->_pageTitle = $Cb;
        $this->_menuSlug = $Wh;
        $this->_menuTitle = $H6;
        $this->_tabName = $QO;
        $this->_description = $kD;
    }
    public $_pageTitle;
    public $_menuSlug;
    public $_menuTitle;
    public $_tabName;
    public $_description;
}
