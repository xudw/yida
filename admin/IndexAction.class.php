<?php
class IndexAction extends BaseAction {
    public function index() {
        $this->template->display('index');
    }

    public function home() {
        $this->template->display('home');
    }

    public function theme() {
        $this->template->display('theme');
    }
}     
?>