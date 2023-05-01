<?php
class ConfigManager
{
    private $configFile;

    public function __construct()
    {
        $this->configFile = 'config.php';
        if(!file_exists($this->configFile)) {
            $this->config = array(
                'is_installed' => false,
                'selected_theme' => '',
                'debug_mode' => false,
                'website_name' => 'Open Blog',
                'website_description' => '',
                'database_name' => '',
                'database_host' => '',
                'database_port' => '',
                'database_user'=> '',
                'database_pass' => ''
            );
            $phpContent = "<?php\nreturn " . var_export($this->config, true) . ";";
            file_put_contents($this->configFile, $phpContent);
        }
    }

    public function configWrite($key, $value) {
        $config = include $this->configFile;
        $config[$key] = $value;
        $content = "<?php\nreturn " . $this->exportConfig($config) . ";\n";
        file_put_contents($this->configFile, $content);
    }

    private function exportConfig($config) {
        $export = var_export($config, true);
        $export = preg_replace("/^(\s*)([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)\s*=>/", "$1'$2' =>", $export);
        $export = preg_replace('/=>\s*([a-zA-Z]+::[A-Z_]+(?:\|\d)*)\b/', "=> '$1'", $export);
        $export = preg_replace('/=> (\b(true|false)\b)/i', "=> '$1'", $export);
        $export = str_replace("  ", "\t", $export);
        $export = str_replace("\narray (", "array(", $export);
        $export = str_replace("),\n", "),\n\t", $export);
        $export = str_replace("array(\n\t\t\t\n\t\t)", "array()", $export);
        return $export;
    }




    public function getConfig($key = null)
    {
        if (!file_exists($this->configFile)) {
            // Create an empty config file if it doesn't exist
            file_put_contents($this->configFile, "<?php\nreturn array();\n");
        }

        $config = include $this->configFile;

        if ($key === null) {
            return $config;
        } else {
            return array_key_exists($key, $config) ? $config[$key] : null;
        }
    }
}