<?php

require_once __DIR__ . '/vendor/autoload.php';


use Cbatista8a\Tris\Infrastructure\Controllers\NewGameController;
use Cbatista8a\Tris\Infrastructure\Controllers\PlayGameController;
use Cbatista8a\Tris\Infrastructure\InMemoryRepository;

session_start();
$repository = new InMemoryRepository();
$response = [];

$action = $_GET['action'] ?? null;
$controller = null;
switch ($action) {
    case 'new_game':
        $controller = new NewGameController($repository);
        break;
    case 'play':
        $controller = new PlayGameController($repository);
        break;
}

if ($controller) {
    $response = $controller();
}

$response['help'] = 'Use the following parameters: action=new_game to start a new game | action=play&player_id=1&game_id=1&position=1 to play a game.';
echo json_encode($response);
exit();
