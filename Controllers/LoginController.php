<?php
require_once __DIR__.'/../core/Controller.php';
require_once __DIR__.'/../Models/LoginModel.php';
require_once __DIR__.'/../Views/LoginView.php';

class LoginController extends Controller
{
    protected function setModel() {
        $this->model = new LoginModel();
    }
    protected function setView() {
        $this->view = new LoginView();
    }
}