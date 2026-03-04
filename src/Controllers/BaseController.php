<?php 

namespace App\Controllers;

class BaseController {

protected function render(string $view, array $data = []) {
    extract($data);
    require __DIR__ . '/../../src/Views/' . $view . '.php';
}

protected function redirect(string $url) {
    header('Location: ' . $url);
    exit;
}
}