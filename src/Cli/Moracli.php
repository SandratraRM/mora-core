<?php
namespace Mora\Core\Cli;


use Mora\Core\Cli\Config\Database;
use Mora\Core\Cli\Console\OutputColorMap;
use Mora\Core\Cli\Controller\ControllerManager;

class Moracli
{
    private  $argcount;
    private  $args;

    private function __construct($args = [])
    {
        $this->argcount = count($args);
        $this->args = $args;
    }

    public static function exec($args = []){
        $args = array_slice($args,1);
        $cli = new self($args);
        $cli->init();
    }
    public function init(){
        print_r($this->args);
    }
    private function determineCommand(){
      if($this->argcount == 1){
          $this->welcome();
      }else{
          if(method_exists($this,$this->args[1])){
              $com = $this->args[1];
              $this->$com();
          }
          else{
              $this->welcome();
          }
      }
    }
    public function welcome(){
        $file = file_get_contents(__DIR__ . "/Console/welcome.txt");
        printf(OutputColorMap::format($file));
        $commands = require_once __DIR__ . "/Console/commandList.php";
        foreach ($commands as $key => $value){
            printf("    %-50s%s\n",OutputColorMap::format($key),OutputColorMap::format($value));
        }
    }


    public function controller(){
        if(isset($this->args[2])){
            $actions = (isset($this->args[3]))? $this->args[3] : "";
            ControllerManager::createController($this->args[2],$actions);
        }
        else{
            ControllerManager::interactiveController();
        }
    }

    public function database(){
        if(isset($this->args[2]))
        switch ($this->args[2]){
            case "init":
                break;
        }
        Database::init();
    }
    private function listRoute(){
        $path = CONFIG."/CustomRoutes.php";
        if(file_exists($path)){
            $custom = require_once $path;
        }
        else
            $custom = [];
        if(empty($custom)){
            echo "Aucune route personnalisée définie\n";
        }
        else{
            echo "La liste des routes définies:\n";
            foreach ($custom as $k => $v){
                echo "\t$k => $v \n";
            }
        }
    }
    public function route(){

        if(isset($this->args[2]) && $this->args[2] == 'list'){
            $this->listRoute();
        }
        elseif ($this->argcount > 2){
            $routes = array_slice($this->args,2);
            $file = "<?php\nreturn [";
            $path = CONFIG."/CustomRoutes.php";
            if(file_exists($path)){
                $custom = require_once $path;
                foreach ($custom as $k => $value){
                    $file .= '"'.$k.'" => "'.$value.'",';
                }
            }
            else $custom = [];
            foreach ($routes as $route){
                $route = explode(":",$route);
                if(count($route) != 2){
                    echo count($route) ."\nIl faut que la route soit sous la forme de:à.\nEx: poule:volaille\n";
                    exit(1);
                }
                else{
                    if(array_key_exists($route[0],$custom)){
                        $file = str_replace($custom[$route[0]],$route[1],$file);
                    }else{
                        $file .= '"'.$route[0].'" => "'.$route[1].'",';
                    }
                }
            }
            $file = rtrim($file,",");
            $file .= "];";
            if (file_put_contents($path,$file)) {
                echo "Route(s) ajoutée(s) avec succès\n";
            }
        }else{
            echo "Usage : route <from:to>|list\n";
        }
    }
    private function arg($n){
        if (isset($this->args[$n]))
        return $this->args[$n];
        else return false;
    }

    public function ViewFragment(){
        if($this->arg(2)){
            $fragment = file_get_contents(__DIR__."/Skeletons/fragment.txt");
            $template = file_get_contents(__DIR__ ."/Skeletons/template.txt");
            $name = ucfirst($this->arg(2));
            $fragment = str_replace("{name}",$name,$fragment);
            if (file_put_contents(VIEW . '/Fragment/'.$name.'View.php',$fragment)
            && file_put_contents(VIEW . '/Templates/'.$name.'.html',$template))
                echo "Fragment créé avec succès\n";
        }
    }
}