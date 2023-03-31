<?php
class ConfigManager {
    public function initConfig() {
        $config = array(
            'is_installed' => '',
            'debug_mode' => false,
            'database_name' => '',
            'database_host' => '',
            'database_user' => '',
            'database_pass' => '',
            'database_port' => '',
            'website_name' => '',
            'website_description' => '',
        );
        $cf = fopen(__DIR__. "/../config.json", "w+");
        try {
            fwrite($cf, json_encode($config));
        } catch(Exception $ex) {
            if($this->getConfig()['debug_mode']) {
                throw new Exception('Error Occured while writing config file' . $ex->__toString());
            }
        }
        fclose($cf);
    }

    public function getConfig() {
        $file  = fread(fopen(__DIR__. "/../config.json", "r"), filesize(__DIR__. "/../config.json"));
        return json_decode($file, true);
    }

    public function configWrite($key, $value) {
        $file_read  = file_get_contents(__DIR__. "/../config.json");
        $file_write  = fopen(__DIR__. "/../config.json", "w+");
        $data = json_decode($file_read, true);
        $data[$key] = $value;
        fwrite($file_write, json_encode($data));
    }

    
}
