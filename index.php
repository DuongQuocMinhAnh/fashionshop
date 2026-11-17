<?php

if (session_status() === PHP_SESSION_NONE) {
    @session_start();
}

require_once __DIR__ . '/controllers/ProductController.php';

$controller = new ProductController();
$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'index':
        $controller->index();
        break;
    case 'create':
        $controller->create();
        break;
    case 'store':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->store();
        } else {
            header('Location: index.php?action=create');
        }
        break;
    case 'edit':
        $controller->edit();
        break;
    case 'update':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->update();
        } else {
            header('Location: index.php');
        }
        break;
    case 'delete':
        $controller->delete();
        break;
    default:
        $controller->index();
        break;
}
