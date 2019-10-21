# ZWEIHÄNDER Character Maker

This software can generate [ZWEIHÄNDER](https://grimandperilous.com/)’s characters by CLI Interface, in order to play the game you'll still need the core manual and some friend to play with.

## Getting Started

You can use the following endpoints:

| *Mehtod*   | *Endpoint*             | *Description*                                                                                                                                                                                                                                                                                             |
|------------|------------------------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| ```GET```  | `/characters`          | Return an Index of saved characters.                                                                                                                                                                                                                                                                      |
| ```GET```  | `/characters/{id}`     | Return detail of a specific character.                                                                                                                                                                                                                                                                    |
| ```GET```  | `/characters/roll-new` | Return detail of a random generated character, send also a custom header 'X-Character-Token' which is required to save the new character. You can optionally pass any combination of these three query parameter to affect character generation: `roll-drawback`, `roll-ancestry` and `unlink-alignment`. |
| ```POST``` | `/characters/save`     | Save a random generated character, you have to set a name in the body payload (it can be json encode or form encoded based on the Content-Type) and sent back the 'X-Character-Token' header.                                                                                                             |

Alternately to generate a character you can simply run this command:
```
docker exec -it -u dev sf4_php bin/console app:roll:character
```
> You can add several flag to the command, use the `--help` to learn more about those.

You can generate and save into the DB 1000 character by run 
```
docker exec -it -u dev sf4_php bin/console app:roll:character-batch
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

## Coding Standard

In order to check if the code is healthy and compliant with adopted standards run `easy-coding-standard` and `phpstan`
```shell script
docker exec -it -u dev sf4_php vendor/bin/ecs check src/
docker exec -it -u dev sf4_php vendor/bin/ecs check tests/
```
```shell script
docker exec -it -u dev sf4_php vendor/bin/phpstan analyse src tests
```

## TODO

* hateoas with willdurand/hateoas-bundle
* add build pipeline with ecs check
* add build pipeline with phpstan
* add tests
* add cache (?)
* support the "Mercy Rule"
* allow to choose "Random" choice between human or demi-human (this should be also the default option)
* add roll character cash
* add export character pdf sheet
* add consider talent, trait or magick modifier to secondary attribute
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
