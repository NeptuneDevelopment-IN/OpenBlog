<?php
class ThemeManager
{


    public function __construct() {
        $this->config = new ConfigManager();
    }

    //Get the themes from the "Themes" folder
    public function getThemes() {
        $dir = __DIR__ . '/../Themes/';
        $files = scandir($dir);
        $subdirs = array_filter($files, function($file) use ($dir) {
            return is_dir(strtolower($dir) . '/' . $file);
        });
        $subdirs = array_diff($subdirs, ['.', '..']);
        $subdirs = array_map('strtolower', $subdirs); // Convert to lowercase
        $subdirs = array_values($subdirs);
        return $subdirs;
    }

    //Set theme to set the theme for the website
    public function setTheme($theme_name): bool {
        try {
            $this->config->configWrite("selected_theme", strtolower($theme_name));
        } catch (Exception $ex) {
            return false;
        }
        return true;
    }


}
