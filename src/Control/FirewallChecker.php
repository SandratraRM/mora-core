<?php
namespace Mora\Core\Control;

use Mora\Core\Config\JsonConfigManager;


class FirewallChecker
{
    private static $path = CONFIG ."/Firewalls.json";

    private static function getFirewalls(){
        $conf = new JsonConfigManager(self::$path);
        return $conf->getConfigsArray();
    }
    public static function passedAll($controller){
        if(!empty(self::getFirewalls())){
            $succes = true;
            $firewalls = self::getFirewalls();
            foreach ($firewalls as $firewall => $controllers){
                array_walk($controllers,['Mora\\Core\\Control\\FirewallChecker','formatControllers']);
                /**
                 * @var Firewall $firewall
                 */
                if(in_array($controller,$controllers)){
                    $firewall = PROJECT_NAME . "\Firewall\\".ucfirst(strtolower($firewall))."Firewall";
                    if(!$firewall::check()){
                        $firewall::onFailed();
                        $succes = false;
                    }
                }
            }
            return $succes;
        }
        else{
            return true;
        }

    }

    public static function formatControllers(&$values,$keys){
        $values = ucfirst(strtolower($values));
    }
}