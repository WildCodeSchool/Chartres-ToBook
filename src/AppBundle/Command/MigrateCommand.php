<?php
// src/WCS/GestyBundle/Command/MigrateCommand.php

namespace AppBundle\Command;

use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;


class MigrateCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('tobook:db:migrate')
            ->setDescription('migrate database form the old one')
            ->addArgument(
                'file',
                InputArgument::REQUIRED,
                'CSV dump file to read data from'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $file = $input->getArgument('file');
        $em = $this->getContainer()->get('doctrine')->getManager();
        if (!$this->askConfirmation($input, $output, '<question>Careful, database will be purged. Do you want to continue y/N ?</question>', false)) {
            return;
        }
        $purger = new ORMPurger($em);
        $purger->setPurgeMode(ORMPurger::PURGE_MODE_DELETE);
        $executor = new ORMExecutor($em, $purger);
        $executor->setLogger(function ($message) use ($output) {
            $output->writeln(sprintf('  <comment>></comment> <info>%s</info>', $message));
        });
        $executor->purge();
        // Load users
        $stream = fopen($file, 'r');
        $userManager = $this->getUserManager();
        $userAdmin = $userManager->createUser();
        $userAdmin->setPlainPassword('admin');
        $userAdmin->setEnabled(true);
        $userAdmin->setEmail('romain@wildcodeschool.fr');
        $userAdmin->setUsername('admin');
        $userAdmin->setRoles(array('ROLE_SUPER_ADMIN'));
        $userManager->updateUser($userAdmin, true);
        $users = array('admin' => $userAdmin);
        while ($line = fgets($stream))
        {
            $data = explode(',', $line);
            $output->writeln($data[0]);
            //if ($data[0]=="\\.\n") break;
            $entity = $userManager->createUser();
            $entity->setUsername($data[4]);
            $entity->setUsernameCanonical($data[4]);
            $entity->setEmail($data[4]);
            $entity->setEmailCanonical($data[4]);
            $entity->setEnabled(true);
            $entity->setPlainPassword($data[7]);
            $userManager->updateUser($entity, true);
            $users[$data[0]] = $entity;
        }
        $em->flush();
        $output->writeln(sprintf('  <comment>></comment> <info>%s users loaded</info>', count($users)));

        fclose($stream);
        $output->writeln(sprintf('<info>done</info>'));
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     * @param string          $question
     * @param bool            $default
     *
     * @return bool
     */
    private function askConfirmation(InputInterface $input, OutputInterface $output, $question, $default)
    {
        if (!class_exists('Symfony\Component\Console\Question\ConfirmationQuestion')) {
            $dialog = $this->getHelperSet()->get('dialog');
            return $dialog->askConfirmation($output, $question, $default);
        }
        $questionHelper = $this->getHelperSet()->get('question');
        $question = new ConfirmationQuestion($question, $default);
        return $questionHelper->ask($input, $output, $question);
    }

    /**
     * @return UserManagerInterface
     */
    public function getUserManager()
    {
        return $this->getContainer()->get('fos_user.user_manager');
    }
}