<?php
namespace Mora\Core\cli\Console\Lang;

use Mora\Core\cli\Console\CliConfig;
use Mora\Core\cli\Console\Output;
use Mora\Core\cli\Console\CliStrings;
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
        }
        print $table->getTable();
        print("\r\n");
    }
}