<?php
namespace Mora\Core\View;


class Html
{

    
    /**
     * @var string
     */
    protected $html;
    
    
    /**
     * @param string $html
     */
    public function setHtml($html): void
    {
        $this->html = $html;
    }
    private static function param_include($name,$params = []){
        $mainhtml = self::include($name);
        $search = [];
        $replace = [];
        foreach ($params as $k => $v){
            if(is_array($v)){
                preg_match('/\$'.$k."{{([^}]*)}}/",$mainhtml,$m);
                $search [] = $m[0];
                $subhtml = $m[1];
                $html = '';
                foreach ($v as $subarray){
                    $subsearch = $subreplace = [];
                    foreach ($subarray as $subkey => $subvalue){
                        $subsearch []= '$'."$subkey" ;
                        $subreplace []= $subvalue;
                    }
                    $html .= str_replace($subsearch,$subreplace,$subhtml);
                }
                $replace [] = (empty($v))? "": $html;
            }else{
                $search [] = '$'.$k;
                $replace [] = $v;
            }
        }
        return  str_replace($search,$replace,$mainhtml);
    }
    public static function include($name,$params = []){
        $html = file_get_contents(VIEW . "/Templates/$name".".html");

        $included = [];
        while(preg_match_all('/@include\(([^\(\)]+)\)/',$html,$matches)){
            for($i = 0; $i<count($matches[0]);$i++){
                if(!in_array($matches[1][$i],$included)){
                    $included [] = $matches[1][$i];
                    $path = VIEW . "/Templates/".$matches[1][$i].".html";
                    if(file_exists($path))
                        $content = file_get_contents($path);
                    else
                        $content = "<span style='vertical-align:middle;font-weight: 400;font-size: 11px'>(include $path impossible) </span>";
                    $html = str_replace($matches[0][$i],$content,$html);

                }
                else{
                    echo '<h4 style="padding: 5px;background: #c3000a;color: white">@include(parent) Vous ne pouvez pas inclure un fichier parent dans un fichier enfant</h4>';
                    exit();
                }

            }
        }
        if(!empty($params))
            $html = self::param_include($name,$params);
        return $html;
    }
    /**
     * @return string
     */
    public function getHTML(){
        return $this->html;
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
        echo $this->html;
    }
}