<?php


namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CommandeType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $from = $builder->add('numberProduct',null)
            ->add('description',null)
            ->add('date',null)
        ->getForm();
    }
}