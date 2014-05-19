<?php

namespace Victoire\Widget\SiblingsMenuBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Victoire\Bundle\CoreBundle\Form\EntityProxyFormType;
use Victoire\Bundle\CoreBundle\Form\WidgetType;

/**
 * WidgetSiblingsMenu form type
 */
class WidgetSiblingsMenuType extends WidgetType
{

    /**
     * define form fields
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //choose form mode
        if ($this->entity_name === null) {
            //if no entity is given, we generate the static form
            $builder->add(
                'withCousins',
                null,
                array(
                    'label' => "form.withCousins.label"
                )
            );

        } else {
            //else, WidgetType class will embed a EntityProxyType for given entity
            parent::buildForm($builder, $options);
        }


    }


    /**
     * bind form to WidgetSiblingsMenu entity
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class'         => 'Victoire\Widget\SiblingsMenuBundle\Entity\WidgetSiblingsMenu',
                'widget'             => 'siblingsmenu',
                'translation_domain' => 'victoire'
            )
        );
    }


    /**
     * get form name
     */
    public function getName()
    {
        return 'appventus_victoirecorebundle_widgetsiblingsmenutype';
    }
}
