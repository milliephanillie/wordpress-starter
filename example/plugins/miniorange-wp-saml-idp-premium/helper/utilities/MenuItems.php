<?php


namespace IDP\Helper\Utilities;

final class MenuItems
{
    private $_callback;
    private $_menuLogo;
    private $_tabDetails;
    private $_parentSlug;
    function __construct($qc)
    {
        $this->_callback = [$qc, "\x6d\x6f\137\x73\160\137\163\145\164\x74\x69\156\147\163"];
        $this->_menuLogo = MSI_ICON;
        $Rb = TabDetails::instance();
        $this->_tabDetails = $Rb->_tabDetails;
        $this->_parentSlug = $Rb->_parentSlug;
        $this->addMainMenu();
        $this->addSubMenus();
    }
    private function addMainMenu()
    {
        add_menu_page("\x53\x41\115\114\x20\x49\x44\120", "\127\x6f\x72\144\120\x72\x65\163\x73\x20\111\x44\120", "\x6d\x61\x6e\141\147\x65\x5f\157\x70\x74\151\157\x6e\x73", $this->_parentSlug, $this->_callback, $this->_menuLogo);
    }
    private function addSubMenus()
    {
        foreach ($this->_tabDetails as $b8) {
            add_submenu_page($this->_parentSlug, $b8->_pageTitle, $b8->_menuTitle, "\x6d\141\x6e\x61\x67\x65\137\157\x70\x74\x69\157\x6e\163", $b8->_menuSlug, $this->_callback);
            n9:
        }
        XN:
    }
}
