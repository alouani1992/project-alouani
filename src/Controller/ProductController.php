<?php

namespace App\Controller;


use App\Entity\Client;
use App\Entity\Commande;
use App\Form\CommandeType;
use App\Repository\ClientRepository;
use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\DateTime;
use App\Service\MessageGenerator;
use App\Form\ClientType;
use App\Form\ProductType;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="product")
     */
    public function index(ClientRepository $rep)
    {
        $clients = $rep->findAll();
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
           'clients'=>$clients
        ]);
    }

    /**
     * @Route("/newProduct",name="new_product")
     */
    public function clientCreate(Request $request, EntityManagerInterface $em)
    {
        $client = new Product();
        $client->setTitle('1st product');
        $client->setDescription('1st description');
        $client->setDate(new \DateTime('tomorrow'));
        $form = $this->createForm(ClientType::class,$client);
     /*   $form = $this->createFormBuilder($client)->add('title',null)
            ->add('description',null)
            ->add('date',DateType::class)
        ->getForm();*/
        $form->handleRequest($request);
if($form->isSubmitted() && $form->isValid()){

    $em->persist($form->getData());
    $em->flush();
    dd($form->getData());

}
        return $this->render('product/new_product.html.twig',[
            'controller_name' => 'ProductController',
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/addClient")
     */

    public function addClients()
    {
        $em = $this->getDoctrine()->getManager();
        $client = new Client();
        $p = new Product();
        $p->setDescription("alouani");
        $p->setTitle("alouaniiaaa a ");
       // $p->setDate(new \DateTime());
        $client->setTitle("testt");
        $client->setDescription("desciption");
        $client->setDate(  new \DateTime());
        $em->persist($client);
        $em->persist($p);
        $em->flush();
    }

    /**
     * @param $id
     * @Route("show/{id}",name="show")
     */
    public function show($id, ClientRepository $repository){
        $client =  $repository->find($id);
        dd($client);
    }
    /**
     * @Route("new",name="new")
     */
    public function new(MessageGenerator $message){
        $msg = $message->getHappyMessage();
        dd($msg);
    }

    /**
     * @return Response
     * @Route("/test")
     */
    public function newProduct(Request $request, EntityManagerInterface $manager){
        $p= new Product();
        $p->setCreationDate(new \DateTime('tomorrow'));
        $p->setDescription('description Product');
        $p->setTitle('title product');
        $form = $this->createForm(ProductType::class,$p);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($p);
            $manager->flush();
            dd($p);
        }
        return $this->render('product\nouveau_produit.html.twig',['form'=>$form->createView(),'controller_name'=>'']);
    }


    /**
     * @param EntityManagerInterface $em
     * @param Request $request
     * @Route("/cmdAction")
     */
    public function commandeAction(EntityManagerInterface $em,Request $request){
        $cmd  = new Commande();
        $from = $this->createForm(CommandeType::class,$cmd);
        $from = $from ->createView();
        return $this->render('Commande\cmd.html.twig',['form'=>$from]);
        dd($from);

    }
    /**
     * @Route("/addCmd")
     */
    public function addCommande(CommandeRepository $commandeRepository, EntityManagerInterface $em,Request $req){
        $cmd = $commandeRepository->find(1);
        //dd($cmd);
        $form = $this->createForm(CommandeType::class,$cmd);
        $form->handleRequest($req);
        if($form->isSubmitted()){
            $em->persist($cmd);
            $em->flush();
            dd($cmd);
        }
        return $this->render('Commande\cmd.html.twig',['form'=>$form->createView()]);
       /* $cmd =  new Commande();
        $cmd->setDescription("description1");
        $cmd->setDate(new \DateTime('tomorrow'));
        $cmd->setNumberProduct(10);*/
        //dd($cmd);
        //$em->persist($cmd);
        //$em->flush();


    }
}
