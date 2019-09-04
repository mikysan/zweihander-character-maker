# ZWEIHÄNDER Character Maker

This software can generate [ZWEIHÄNDER](https://grimandperilous.com/)’s characters by CLI Interface, in order to play the game you'll still need the core manual and some friend to play with.

## Getting Started

To generate a character you can simply run this command:
```
docker exec -it -u dev sf4_php bin/console app:roll:character
```
You can add several flag to the command, use the `--help` to learn about those.

Alternately you can use the endpoints:
- get an Index of saved characters
```http request
GET /character
```
- get detail of a specific character
```http request
GET /character/{id}
```
- get detail of a random generated character
```http request
GET /character/roll-new
```
- _(coming soon)_ Save a character
```http request
POST /character
```

### Prerequisites

You'll need [Docker](https://www.docker.com/) in order to make this work.

### Installing

After cloning this repository or downloading its ZIP version open a terminal and go into the repository directory.
Firstly create the needed docker configuration
```shell script
cp docker-compose.override.yml.dist docker-compose.override.yml 
```
_(optionally adjust the configuration as you like)_

Now you need to run the docker container, you can achieve this by running the following command:
```shell script
docker-compose up -d
```

You can now install any software dependencies by running the following command:
```shell script
docker exec -it -u dev sf4_php composer install
```

Lastly run the doctrine migrations:
```shell script
docker exec -it -u dev sf4_php bin/console d:m:m
```
> You may need to run `docker exec -it -u dev sf4_php php bin/console d:m:m` with the explicitly use of *php* binary, if so you will need to do so any time you will use the `bin/console` commands.

## TODO

* add cs fixer
* add tests
* allow user to apply Mercy Rule by CLI
* allow to choose "Random" choice between human or demi-human (this should be also the default option) by CLI
* add REST POST Endpoint to save character
* add trappings
* add roll character cash
* add consider talent, trait or magick modifier to secondary attribute
* add armor’s Damage Threshold Modifier
* add export character pdf sheet
* add switch from metric system to imperial system (?)
* add multilanguage (?)

## Built With

* [Symfony](https://symfony.com/)
* [Composer](https://getcomposer.org/)
* [Docker](https://www.docker.com/)

## Authors

* **Michele Sangalli** - *Initial work* - [mikysan](https://github.com/mikysan)

See also the list of [contributors](https://github.com/your/project/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
