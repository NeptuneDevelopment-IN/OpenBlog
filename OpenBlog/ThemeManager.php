<?php
class ThemeManager
{


    public function __construct() {
        $this->config = new ConfigManager();
    }


    public function getThemes() {
        $dir = __DIR__ . '/../Themes/';
        $files = scandir($dir);
        $subdirs = array_filter($files, function($file) use ($dir) {
            return is_dir($dir . '/' . $file);
        });
        $subdirs = array_diff($subdirs, ['.', '..']);
        $subdirs = array_values($subdirs);
        return $subdirs;
    }

    public function setTheme() {

    }
}
