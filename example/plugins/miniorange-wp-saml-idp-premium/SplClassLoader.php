<?php


namespace IDP;

final class SplClassLoader
{
    private $_fileExtension = "\56\x70\x68\160";
    private $_namespace;
    private $_includePath;
    private $_namespaceSeparator = "\x5c";
    public function __construct($wk = null, $pQ = null)
    {
        $this->_namespace = $wk;
        $this->_includePath = $pQ;
    }
    public function register()
    {
        spl_autoload_register(array($this, "\x6c\x6f\x61\144\103\154\x61\x73\x73"));
    }
    public function unregister()
    {
        spl_autoload_unregister(array($this, "\x6c\157\x61\x64\x43\x6c\x61\163\163"));
    }
    public function loadClass($li)
    {
        if (!(null === $this->_namespace || $this->_namespace . $this->_namespaceSeparator === substr($li, 0, strlen($this->_namespace . $this->_namespaceSeparator)))) {
            goto cy;
        }
        $fC = '';
        $ds = '';
        if (!(false !== ($wn = strripos($li, $this->_namespaceSeparator)))) {
            goto aM;
        }
        $ds = strtolower(substr($li, 0, $wn));
        $li = substr($li, $wn + 1);
        $fC = str_replace($this->_namespaceSeparator, DIRECTORY_SEPARATOR, $ds) . DIRECTORY_SEPARATOR;
        aM:
        $fC .= str_replace("\137", DIRECTORY_SEPARATOR, $li) . $this->_fileExtension;
        $fC = str_replace("\151\x64\x70", MSI_NAME, $fC);
        require ($this->_includePath !== null ? $this->_includePath . DIRECTORY_SEPARATOR : '') . $fC;
        cy:
    }
}
