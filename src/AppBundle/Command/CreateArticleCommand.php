<?php
namespace AppBundle\Command;

use AppBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateArticleCommand extends ContainerAwareCommand{

    protected function configure()
    {
        $this
            ->setName('udev_create-articles')
            ->setDescription ('Creates new articles')
            ->addArgument('article-nb',InputArgument::OPTIONAL,'article number',10);
    }

    protected function execute(InputInterface $input,OutputInterface $output)
    {
        $entityManager=$this->getContainer()->get('doctrine')->getManager();

        $faker=\Faker\Factory::create();
        $nbarticle=$$input->getArgument('article-nb');
        $date=new \DateTime();

        for($i=1;$si<nbarticle;$i++){


            $contenu=$faker->text(200);
            $titre=$faker->sentence(6);


            $article=new Article();

            $article->setSubject($titre);
            $article->setBody($contenu);
            $article->setDate($date);



            dump($article);

            $entityManager->persist($article);
        }

        $entityManager->flush();
    }
}

?>