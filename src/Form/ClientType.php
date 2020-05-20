<?php


namespace App\Form;


use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $client = new Client();
        $builder->add('title',null)
            ->add('description',null)
        ->add('date',DateType::class)
            ->getForm();

    }

}