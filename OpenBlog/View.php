<?php 
class View {
    protected $template;
    protected $data = array();

    public function __construct($template) {
        $this->template = $template;
    }

    public function setData($key, $value) {
        $this->data[$key] = $value;
    }

    public function render() {
        extract($this->data);
        include($this->template);
    }
}
