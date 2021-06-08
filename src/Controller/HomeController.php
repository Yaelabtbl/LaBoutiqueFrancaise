<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\Header;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $products = $this->entityManager->getRepository(Product::class)->findByIsBest(1);
        $headers = $this->entityManager->getRepository(Header::class)->findAll();

        return $this->render('home/index.html.twig', [
            'products' =>$products,
            'headers' => $headers

        ]);

    }
    /**
     * @Route("/ajax/IsBest", name="ajaxIsBest")
     */
    public function ajaxIsBest(): Response
    {
        $products = $this->entityManager->getRepository(Product::class)->findByIsBest(1);
        $productencode = [];

        foreach ($products as $key => $product)
        {
            $productencode[$key] = json_encode([
                'slug'=>$product->getSlug(),
                'illustration'=>$product->getIllustration(),
                'name'=>$product->getName(),
                'subtitle'=>$product->getSubtitle(),
                'price'=>$product->getPrice()
            ]);
        }

        return new JsonResponse($productencode);
    }

}
