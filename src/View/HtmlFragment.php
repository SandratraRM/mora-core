<?php
namespace Mora\Core\View;


class HtmlFragment extends Html
{
    protected $data = [];
    protected $filename;
    
    public function setData(array $data)
    {
        $this->data = $data;
        $this->commit();
    }

    public function __construct()
    {
        $class = explode("\\",get_class($this));
        $fraglkey = array_search("Fragment",$class);
        $filename = array_slice($class,$fraglkey + 1);
        $filename[count($filename) - 1] = str_replace("View","",$filename[count($filename) - 1]);
        $filename = implode("/",$filename);
        $this->filename = $filename;
        $this->html = self::include($this->filename);

    }
    private function commit(){
        $this->html = self::include($this->filename,$this->data);
    }
}