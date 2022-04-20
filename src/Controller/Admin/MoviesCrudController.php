<?php

namespace App\Controller\Admin;

use App\Entity\Movies;
use App\Repository\GenreRepository;
use App\Repository\MoviesRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Setup;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\VideoField;
use Symfony\Bridge\Doctrine\ManagerRegistry;

class MoviesCrudController extends AbstractCrudController
{
    private $entityManager;
    private $moviesRepo;
    private $genreRepo;

    public function __construct(EntityManagerInterface $em, MoviesRepository $mRepo, GenreRepository $gRepo) {
        $this->entityManager = $em;
        $this->moviesRepo = $mRepo;
        $this->genreRepo = $gRepo;
    }

    public static function getEntityFqcn(): string
    {
        return Movies::class;
    }



    public function configureFields(string $pageName): iterable
    {
        $repo = $this->entityManager->getRepository(Movies::class);

        $cats = $this->genreRepo->getCats();

        //dd($cats);

        $cat = array();

        foreach($cats as $c) {
            $cat[$c['title']] = $c['id'];
        }
        //dd($cat);

        return [
            IdField::new('id')->hideOnForm(),
            BooleanField::new("active"),
            TextField::new('name'),
            ChoiceField::new('genre_id', 'Gen')->setChoices($cat),
            VideoField::new('path', 'Video')->setUploadDir('public\files\video')
        ];
    }

}
