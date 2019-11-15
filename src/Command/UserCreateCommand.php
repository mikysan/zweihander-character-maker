<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserCreateCommand extends Command
{
    private $entityManager;
    private $passwordEncoder;

    protected static $defaultName = 'app:user:create';

    public function __construct(EntityManagerInterface $entityManager, UserPasswordEncoderInterface $passwordEncoder, string $name = null)
    {
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this
            ->setDescription('Create User by given username')
            ->addArgument('username', InputArgument::REQUIRED, 'Desired Username');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $userRepo = $this->entityManager->getRepository(User::class);
        $username = $input->getArgument('username');
        if ($userRepo->findOneBy(['username' => $username])) {
            $io->error(sprintf('Username "%s" already exists!', $username));

            return 1;
        }

        $user = new User();
        $user->setUsername($username);
        $password = \bin2hex(\random_bytes(6));
        $user->setPassword($this->passwordEncoder->encodePassword($user, $password));
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $io->newLine();
        $io->writeln(sprintf('  You have created user "<info>%s</info>"! password <info>%s</info> (make sure to save it somewhere safe!)', $username, $password));
        $io->newLine();

        return 0;
    }
}
