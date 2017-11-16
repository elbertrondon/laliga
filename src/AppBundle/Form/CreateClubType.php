<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Jugadores;

/**
 * Description of CreateClubType
 *
 * @author Elbert
 */
class CreateClubType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('nombre', TextType::class);
        $builder->add('telefono', TextType::class);
        $builder->add('borrado', CheckboxType::class, array('required' => false));
        $builder->add('jugadores', EntityType::class, array('class' => 'AppBundle\Entity\Jugadores',
                                                        'multiple' => true,
                                                        'choice_label'=>function($jugadores){
                                                    return $jugadores->getNombre(); } ), ['class'=>'chosen-select form-control']);
                                                    
     }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Club'
        ));
    }

}
