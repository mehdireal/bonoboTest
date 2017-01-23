<?php
/**
 * Created by PhpStorm.
 * User: mehdi
 * Date: 22/01/17
 * Time: 13:55
 */

namespace Bonobo\UserBundle\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use FOS\UserBundle\Model\User;
use FOS\UserBundle\Command\CreateUserCommand as BaseCommand;

class CreateUserCommand extends BaseCommand
{
    /**
     * @see Command
     */
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('bonobo:user:create')
            ->getDefinition()->addArguments(array(
                new InputArgument('age', InputArgument::REQUIRED, 'age'),
                new InputArgument('famille', InputArgument::REQUIRED, 'family'),
                new InputArgument('race', InputArgument::REQUIRED, 'race'),
                new InputArgument('nourriture', InputArgument::REQUIRED, 'nourriture')
            ))
        ;
        $this->setHelp(<<<EOT
// L'aide qui va bien
EOT
        );
    }

    /**
     * @see Command
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $username   = $input->getArgument('username');
        $email      = $input->getArgument('email');
        $password   = $input->getArgument('password');
        $age  = $input->getArgument('age');
        $famille   = $input->getArgument('famille');
        $race  = $input->getArgument('race');
        $nourriture   = $input->getArgument('nourriture');
        $inactive   = $input->getOption('inactive');
        $superadmin = $input->getOption('super-admin');

        /** @var \FOS\UserBundle\Model\UserManager $user_manager */
        $user_manager = $this->getContainer()->get('fos_user.user_manager');

        /** @var \Acme\AcmeUserBundle\Entity\User $user */
        $user = $user_manager->createUser();
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPlainPassword($password);
        $user->setEnabled((Boolean) !$inactive);
        $user->setSuperAdmin((Boolean) $superadmin);
        $user->setAge($age);
        $user->setFamille($famille);
        $user->setRace($race);
        $user->setNourriture($nourriture);

        $user_manager->updateUser($user);

        $output->writeln(sprintf('Created user <comment>%s</comment>', $username));
    }

    /**
     * @see Command
     */
    protected function interact(InputInterface $input, OutputInterface $output)
    {
        parent::interact($input, $output);
        if (!$input->getArgument('age')) {
            $age = $this->getHelper('dialog')->askAndValidate(
                $output,
                'Please choose a age:',
                function($age) {
                    if (empty($age)) {
                        throw new \Exception('age can not be empty');
                    }

                    return $age;
                }
            );
            $input->setArgument('age', $age);
        }
        if (!$input->getArgument('famille')) {
            $famille = $this->getHelper('dialog')->askAndValidate(
                $output,
                'Please choose a family:',
                function($famille) {
                    if (empty($famille)) {
                        throw new \Exception('family can not be empty');
                    }

                    return $famille;
                }
            );
            $input->setArgument('famille', $famille);
        }
        if (!$input->getArgument('race')) {
            $race = $this->getHelper('dialog')->askAndValidate(
                $output,
                'Please choose a race:',
                function($race) {
                    if (empty($race)) {
                        throw new \Exception('race can not be empty');
                    }

                    return $race;
                }
            );
            $input->setArgument('race', $race);
        }
        if (!$input->getArgument('nourriture')) {
            $nourriture = $this->getHelper('dialog')->askAndValidate(
                $output,
                'Please choose a nourriture:',
                function($nourriture) {
                    if (empty($nourriture)) {
                        throw new \Exception('nourriture can not be empty');
                    }

                    return $nourriture;
                }
            );
            $input->setArgument('nourriture', $nourriture);
        }
    }
}