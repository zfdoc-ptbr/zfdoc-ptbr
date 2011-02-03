<?php
namespace phpdotnet\phd;

class Package_Generic_ZFDocChunkedXHTML extends Package_Generic_ZFPackageChunkedXHTML
{
    private $myelementmap = array();

    public function __construct() 
    {
        parent::__construct();
        $this->registerFormatName("ZF-Doc-Chunked-XHTML");
        $this->myelementmap = array_merge(
            array(),                                         
            static::getDefaultElementMap()
        );
    }

    public function format_programlisting($open, $name, $attrs) 
    {
        if ($open) {
            $tag = '<pre class="programlisting brush:';
            if (isset($attrs[Reader::XMLNS_DOCBOOK]["language"])) {
                $this->role = $attrs[Reader::XMLNS_DOCBOOK]["language"];
                $tag .= ' ' . $this->role;
            } else {
                $this->role = false;
            }

            $tag .= '">';
            return $tag;
        }
        $this->role = false;
        return "</pre>\n";
    }

    public function CDATA($str) {    
        switch($this->role) {
        case '':
            return '<div class="cdata">'
                . htmlspecialchars($str, ENT_QUOTES, "UTF-8")
                . '</div>';
        default:
            return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
        }
    }

    public function header($id) 
    {
        $title   = $this->getLongDescription($id);
        $lang    = Config::language();
        $navData = $this->getNavData($id);
        static $cssLinks = null;
        if ($cssLinks === null) {
            $cssLinks = $this->createCSSLinks();
        }
        $pageNav = $this->createPageNavigation($navData);

        return
'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="' .$lang. '" lang="' .$lang. '">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>'.(($title != $navData['root']["ldesc"]) ? $title .= ' - Zend Framework Manual' : "Zend Framework Manual") . '</title>
'.$cssLinks.'
    <link href="../css/shCore.css" rel="stylesheet" type="text/css" />
    <link href="../css/shThemeDefault.css" rel="stylesheet" type="text/css" />
    <link href="../css/styles.css" media="all" rel="stylesheet" type="text/css" />
</head>
<body>
<h1><a href="../index.html">Zend Framework Manual</a></h1>
<table width="100%">
    <tr valign="top">
        <td width="85%">' . $pageNav . "<hr />\n";
    }

    public function getNavData($id)
    {
        $root = Format::getRootIndex();
        $prev = $next = $parent = array("href" => null, "desc" => null);

        if ($parentId = $this->getParent($id)) {
            $parent = array("href" => $this->getFilename($parentId) . $this->getExt(),
                "desc" => $this->getShortDescription($parentId));
        }
        if ($prevId = Format::getPrevious($id)) {
            $prev = array("href" => Format::getFilename($prevId) . $this->getExt(),
                "desc" => $this->getShortDescription($prevId));
        }
        if ($nextId = Format::getNext($id)) {
            $next = array("href" => Format::getFilename($nextId) . $this->getExt(),
                "desc" => $this->getShortDescription($nextId));
        }
        return array(
            'prevId'   => $prevId,
            'prev'     => $prev,
            'nextId'   => $nextId,
            'next'     => $next,
            'parentId' => $parentId,
            'parent'   => $parent,
            'root'     => $root,
        );
    }

    public function createPageNavigation(array $data)
    {
        return '
            <table width="100%">
                <tr>
                    <td width="25%" style="text-align: left;">
                    '.($data['prevId'] ? '<a href="' .$data['prev']["href"]. '">' .$data['prev']["desc"]. '</a>' : '') .'
                    </td>

                    <td width="50%" style="text-align: center;">
                        <div class="up">'.($data['parentId'] ? '<span class="up"><a href="' .$data['parent']["href"]. '">' .$data['parent']["desc"]. '</a></span><br />' : '') .'
                        <span class="home"><a href="'.$data['root']["filename"].$this->getExt().'">'.$data['root']["ldesc"].'</a></span></div>
                    </td>

                    <td width="25%" style="text-align: right;">
                        '.($data['nextId'] ? '<div class="next" style="text-align: right; float: right;"><a href="' .$data['next']["href"]. '">' .$data['next']["desc"].'</a></div>' : '') .'
                    </td>
                </tr>
            </table>
';
    }

    public function footer($id) 
    {
        $navBar  = $this->createNavBar($id);
        $navData = $this->getNavData($id);
        return "\n        <hr />\n" . $this->createPageNavigation($navData) . '</td>
        <td style="font-size: smaller;" width="15%"> ' . $navBar . ' </td>
    </tr>
</table>

<script type="text/javascript" src="../js/shCore.js"></script>
<script type="text/javascript" src="../js/shAutoloader.js"></script>
<script type="text/javascript" src="../js/main.js"></script>

</body>
</html>';
    }
}
