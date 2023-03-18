<?php
class ThemeManager
{
    //Get the themes from the themes directory
    public function getThemes()
    {
        $dir = __DIR__ . '/../Themes/';
        $files = scandir($dir);
        $subdirs = array_filter($files, function($file) use ($dir) {
            return is_dir($dir . '/' . $file);
        });
        $subdirs = array_diff($subdirs, ['.', '..']);
        $subdirs = array_values($subdirs);
        return $subdirs;
    }

    //Still need to write more stuff :) It will be commited soon I promise - COMPHACK

}
