<?php
namespace phpdotnet\phd;
/* $Id: Factory.php 303138 2010-09-07 15:34:29Z moacir $ */

class Package_PHP_Factory extends Format_Factory {
    private $formats = array(
        'xhtml'         => 'Package_PHP_ChunkedXHTML',
        'bigxhtml'      => 'Package_PHP_BigXHTML',
        'php'           => 'Package_PHP_Web',
        'howto'         => 'Package_PHP_HowTo',
        'manpage'       => 'Package_PHP_Manpage',
        'pdf'           => 'Package_PHP_PDF',
        'bigpdf'        => 'Package_PHP_BigPDF',
        'kdevelop'      => 'Package_PHP_KDevelop',
        'chm'           => 'Package_PHP_CHM',
        'tocfeed'       => 'Package_PHP_TocFeed',
        'epub'          => 'Package_PHP_Epub',
    );
    
    public function __construct() {
        parent::setPackageName("PHP");
        parent::registerOutputFormats($this->formats);
    }
}

/*
* vim600: sw=4 ts=4 syntax=php et
* vim<600: sw=4 ts=4
*/

