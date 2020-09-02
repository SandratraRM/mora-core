<?php
namespace Mora\Core\Cli\Console\Lang;

use Mora\Core\Cli\Console\CliConfig;
use Mora\Core\Cli\Console\Output;
use Mora\Core\Cli\Console\CliStrings;
use Mora\Core\config\JsonConfigManager;

class Lang{
    public static function changeLang($lang){
        CliConfig::setConfig('lang',$lang);
        Output::print("<green>",CliStrings::get("lang_changed_success"),"<nc>\r\n");
    }
    public static function listLangs(){
        Output::printWarning("",CliStrings::get("lang_list"),"");
        $conf = new JsonConfigManager(__DIR__ . "/LangList.json");
        $langs = $conf->getConfigsArray();
        $table = new \Console_Table(CONSOLE_TABLE_ALIGN_CENTER,CONSOLE_TABLE_BORDER_ASCII,2,null,true);
        $table->setHeaders(
            [
                Output::style("<green>".ucfirst(CliStrings::get('name'))."<nc>"),
                Output::style("<green>".ucfirst(CliStrings::get('code'))."<nc>")
            ]
        );
        foreach ($langs as $code => $name) {
            $table->addRow(
                [$name,$code]
            );
            if ($code != array_keys($langs)[count($langs) -1]) {
                $table->addSeparator();
            }
        }
        print $table->getTable();
        print("\r\n");
    }
}