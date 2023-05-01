<?php
class ConfigManager {
    private $filename;
    private $config;

    public function __construct() {
        $this->filename = 'config.php';

        if (file_exists($this->filename)) {
            $this->config = include $this->filename;
        } else {
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
            file_put_contents($this->filename, $phpContent);
        }
    }

    public function getConfig() {
        return $this->config;
    }

    public function configWrite($key, $value) {
        $this->config[$key] = $value;
        $phpContent = "<?php\nreturn " . var_export($this->config, true) . ";";
        file_put_contents($this->filename, $phpContent);
    }
}
