# Tris Game Backend Documentation

__Overview__

This project is a simple implementation of the game Tic Tac Toe (also known as Tris) using PHP. The game allows two players to play against each other. The game state is managed on the server-side.

### Project Structure

The project is structured into three main directories:  
- `app`: This directory contains the main application code, divided into src/Application, src/Domain, and src/Infrastructure.
- `tests`: This directory contains the automatic test cases.
- `vendor`: This directory contains the dependencies installed via Composer.

### Key Files

- `app/index.php`: This is the entry point of the application. It handles the routing based on the action parameter in the GET request. It uses the `NewGameController` and the `PlayGameController` to handle the game.  
- `app/src/Infrastructure/Controllers/NewGameController.php`: This file contains the controller for starting a new game. It creates a new game instance and return the game id.
- `app/src/Infrastructure/Controllers/PlayGameController.php`: This file contains the controller for playing the game. It receives the game id, the player id, and the position of the move. It returns the updated game state.

### Running the Project

- If you have Docker installed on your machine run: `docker-compose up -d` to start the server.
- If you don't have Docker installed, you can run the project using PHP's built-in server. Run `php -S localhost:8000 -t app` to start the server.
- You must install composer dependencies before running the project. Run `composer install` to install the dependencies.

### How to Play

- To start a new game, use the following parameters: `action=new_game`. This will create a new game and return the game ID.
- To play a game, use the following parameters: `action=play&player_id=1&game_id=1&position=1`. This will make a move in the specified game at the specified position for the specified player.

### Example Curl Commands

- To start a new game: `curl -c cookie.txt -X GET "http://localhost:8080/?action=new_game"`
- To play a game: `curl -b cookie.txt -X GET "http://localhost:8080/?action=play&player_id=1&game_id=1&position=1"`

### Running the Tests

- To run the tests, if you are using Docker you can use the following command: `docker exec -it tris -u www-data bash` to enter the container and then run `composer run test` to run the tests.
- If you are not using Docker, you can run `composer run test` to run the tests.