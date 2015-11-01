<?php

namespace Victoire\Widget\SiblingsMenuBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Victoire\Bundle\CoreBundle\Form\WidgetType;

/**
 * WidgetSiblingsMenu form type.
 */
class WidgetSiblingsMenuType extends WidgetType
{
    /**
     * define form fields.
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     *
     * @throws Exception
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $namespace = $options['namespace'];
        $entityName = $options['entityName'];

        if ($entityName !== null) {
            if ($namespace === null) {
                throw new \Exception('The namespace is mandatory if the entity_name is given.');
            }
        }

        //choose form mode
        if ($entityName === null) {
            //if no entity is given, we generate the static form
            $builder->add(
                'withCousins',
                null,
                [
                    'label' => 'form.withCousins.label',
                ]
            );
        }

        parent::buildForm($builder, $options);
    }

    /**
     * bind form to WidgetSiblingsMenu entity.
     *
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setDefaults(
            [
                'data_class'         => 'Victoire\Widget\SiblingsMenuBundle\Entity\WidgetSiblingsMenu',
                'widget'             => 'siblingsmenu',
                'translation_domain' => 'victoire',
            ]
        );
    }

    /**
     * get form name.
     *
     * @return string The name of the form
     */
    public function getName()
    {
        return 'victoire_widget_form_siblingsmenu';
    }
}
