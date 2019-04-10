<?php
namespace Mora\Core\View;

interface HtmlBuilder{
    function schema($data = []);
}

abstract class Html implements HtmlBuilder
{

    
    /**
     * @var string
     */
    protected $html;
    protected $cachable = false;

    public function __construct($data = []) {
        if (!$this->cachable || !$this->hasCache()) {
            $this->html = $this->schema($data);
            if ($this->cachable) {
                $this->makeCache();
            }
        }
    }
    protected function makeCache(){
        if (!file_exists(CACHE)) {
            mkdir(CACHE);
        }
        $filename = CACHE . "/" .md5(get_class($this)) . ".php";
        return file_put_contents($filename,$this->html);
    }
    protected function clearCache(){
        if ($this->hasCache()) {
            return unlink(CACHE . "/" .md5(get_class($this)) . ".php");
        }
    }
    protected function hasCache(){
        return $this->cachable && file_exists( CACHE . "/" .md5(get_class($this)) . ".php");
    }

    protected function printCache(){
        
        require CACHE . "/" .md5(get_class($this)) . ".php";
    }

    /**
     * @param string $html
     */
    public function setHtml($html): void
    {
        $this->html = $html;
    }

    /**
     * @return string
     */
    public function getHTML(){
        if(!$this->hasCache())
            return $this->html;
        else {
            ob_start();
            require CACHE . "/" .md5(get_class($this)) . ".php";
            $content = ob_get_contents();
            ob_end_clean();
            return $content;
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->html;
    }


    /**
     *
     */
    public function printHTML(){
        if ($this->cachable && $this->hasCache()) {
            $this->printCache();
        }
        else {
            echo $this->getHTML();
        }
    }
}