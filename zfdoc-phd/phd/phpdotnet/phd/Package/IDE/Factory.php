<?php
namespace phpdotnet\phd;
/* $Id: Factory.php 307118 2011-01-05 13:26:25Z shein $ */

class Package_IDE_Factory extends Format_Factory {
    private $formats = array(
        'xml'               => 'Package_IDE_XML',
        'funclist'          => 'Package_IDE_Funclist',
        'json'              => 'Package_IDE_JSON',
        'php'               => 'Package_IDE_PHP',
        'phpstub'           => 'Package_IDE_PHPStub'
    );

    public function __construct() {
        parent::setPackageName("IDE");
        parent::registerOutputFormats($this->formats);
    }
}

/*
* vim600: sw=4 ts=4 syntax=php et
* vim<600: sw=4 ts=4
*/

