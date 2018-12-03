<?php

namespace GlyphiconsBundle\Form;

use Doctrine\ORM\EntityRepository;
use GlyphiconsBundle\Entity\Icon;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


/**
 *
 */
class IconType extends AbstractType
{



    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', FileType::class, array(
                'required'  => true,
                'label' => 'image SVG'
            ))
            ->add('name', TextType::class, array(
                'required'  => true,
                'label'     => 'icone'
            ))
            ->add('save', SubmitType::class, array(
                'attr' => array('class' => 'save'),
            ));
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Icon::class
        ));
    }



    public function getName()
    {
        return 'glyphicons_icon';
    }

}
