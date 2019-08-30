# ZWEIHÄNDER Character Maker

This software can generate [ZWEIHÄNDER](https://grimandperilous.com/)’s characters by CLI Interface, in order to play the game you'll still need the core manual and some friend to play with.

## Getting Started

To generate a character you can simply run this command:
```
docker exec -it -u dev sf4_php bin/console app:roll:character
```

### Prerequisites

You'll need [Docker](https://www.docker.com/) in order to make this work.

### Installing

After cloning this repository or downloading its ZIP version open a terminal and go into the repository directory.
Now you need to run the docker container, you can achieve this by running the following command:
```
docker-compose up -d
```

You can now install any software dependencies by running the following command:
```
docker exec -it -u dev sf4_php composer install
```

Lastly run the doctrine migrations:
```
docker exec -it -u dev sf4_php bin/console d:m:m
```

## TODO

* add cs fixer
* add tests
* allow user to apply Mercy Rule dynamically
* allow to choose "Random" choice between human or demi-human (this should be also the default option)
* add trappings
* roll cash
* allow to export character pdf sheet
* add character RESTish interface
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
