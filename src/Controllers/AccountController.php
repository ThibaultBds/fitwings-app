<?php

namespace App\Controllers;

use App\Models\UserModel;

Class AccountController extends BaseController {

    public function index() {
        $userModel = new UserModel();
        $user = $userModel->findByEmail($_SESSION['user']['email']);
        $this->render('auth/account', ['user' => $user]);
    }
}