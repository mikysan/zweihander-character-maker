<?php

namespace App\Command;

use App\Entity\Character;
use App\Service\CharacterService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class RollCharacterBatchCommand extends Command
{
    protected static $defaultName = 'app:roll:character-batch';

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var CharacterService
     */
    private $characterService;

    const RECORD_QTY = 1000;

    protected function configure()
    {
        $this
            ->setDescription('Create a bunch of character randomly.');
    }

    public function __construct(EntityManagerInterface $entityManager, CharacterService $characterService, string $name = null)
    {
        parent::__construct($name);
        $this->entityManager = $entityManager;
        $this->characterService = $characterService;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $fake = \Faker\Factory::create();

        $io->progressStart(self::RECORD_QTY);
        $batchSize = 20;
        for ($i = 1; $i <= self::RECORD_QTY; ++$i) {
            $character = $this->characterService->rollNew(0 === mt_rand(1, 2) % 2, 0 === mt_rand(1, 2) % 2);
            $character->setName($fake->name(strtolower(Character::GENDERS[$character->getSex()])));
            $this->entityManager->persist($character);
            if (0 === ($i % $batchSize)) {
                $this->entityManager->flush();
                $this->entityManager->clear(Character::class); // Detaches all character objects from Doctrine!
            }
            $io->progressAdvance();
        }
        $this->entityManager->flush(); //Flush objects that did not make up an entire batch
        $io->progressFinish();

        $io->success('Done.');
    }
}
