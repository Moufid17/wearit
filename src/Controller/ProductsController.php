<?php

namespace App\Controller;

use App\Entity\Product;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;


class ProductsController extends AbstractController
{

    /**
     * @var RegisterRepository
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    
    /**
     * @Route("/collections", name="products")
     */
    public function index(): Response
    {
        $products = $this->em->getRepository(Product::class)->findAll();

        return $this->render('products/index.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/collection/{slug}", name="product")
     */
    public function show($slug): Response
    {
        $product = $this->em->getRepository(Product::class)->findBySlug($slug)['0'];

        if(!$product){
            return $this->redirectRoute('products');
        }

        return $this->render('products/show.html.twig', [
            'product' => $product,
        ]);
    }
}
