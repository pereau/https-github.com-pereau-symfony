<?php
namespace AppBundle\Command;

use AppBundle\Entity\user;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateUserCommand extends ContainerAwareCommand{

    protected function configure()
    {
        $this
            ->setName('udev_create-users')
            ->setDescription ('Creates new users')
            ->addArgument('user-nb',InputArgument::OPTIONAL,'user number',100);
    }

    protected function execute(InputInterface $input,OutputInterface $output)
    {
        $entityManager=$this->getContainer()->get('doctrine')->getManager();

        $faker= \Faker\Factory::create();
        $nbuser=$input->getArgument('user-nb');
        $date=new \DateTime();

        for($i=1;$i<$nbuser;$i++){

            $username=$faker->userName;
            $email=$faker->email;
            $password=$faker->password;

            $user=new User();

            $user->setUsername($username);
            $user->setEmail($email);
            $user->setDate($date);
            $user->setPassword($password);


            $output->writeln($user->getUsername());
            dump($user);

            $entityManager->persist($user);
        }

        $entityManager->flush();
    }
}

?>