<?php

namespace Victoire\Widget\SiblingsMenuBundle\Widget\Manager;


use Victoire\Widget\SiblingsMenuBundle\Form\WidgetSiblingsMenuType;
use Victoire\Widget\SiblingsMenuBundle\Entity\WidgetSiblingsMenu;

class WidgetSiblingsMenuManager
{
protected $container;

    /**
     * constructor
     *
     * @param ServiceContainer $container
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    /**
     * create a new WidgetSiblingsMenu
     * @param Page   $page
     * @param string $slot
     *
     * @return $widget
     */
    public function newWidget($page, $slot)
    {
        $widget = new WidgetSiblingsMenu();
        $widget->setPage($page);
        $widget->setslot($slot);

        return $widget;
    }
    /**
     * render the WidgetSiblingsMenu
     * @param Widget $widget
     *
     * @return widget show
     */
    public function render($widget)
    {
        return $this->container->get('victoire_templating')->render(
            "VictoireWidgetSiblingsMenuBundle::show.html.twig",
            array(
                "widget" => $widget
            )
        );
    }

    /**
     * render WidgetSiblingsMenu form
     * @param Form           $form
     * @param WidgetSiblingsMenu $widget
     * @param BusinessEntity $entity
     * @return form
     */
    public function renderForm($form, $widget, $entity = null)
    {

        return $this->container->get('victoire_templating')->render(
            "VictoireWidgetSiblingsMenuBundle::edit.html.twig",
            array(
                "widget" => $widget,
                'form'   => $form->createView(),
                'id'     => $widget->getId(),
                'entity' => $entity
            )
        );
    }

    /**
     * create a form with given widget
     * @param WidgetSiblingsMenu $widget
     * @param string         $entityName
     * @param string         $namespace
     * @return $form
     */
    public function buildForm($widget, $entityName = null, $namespace = null)
    {
        $form = $this->container->get('form.factory')->create(new WidgetSiblingsMenuType($entityName, $namespace), $widget);

        return $form;
    }

    /**
     * create form new for WidgetSiblingsMenu
     * @param Form           $form
     * @param WidgetSiblingsMenu $widget
     * @param string         $slot
     * @param Page           $page
     * @param string         $entity
     *
     * @return new form
     */
    public function renderNewForm($form, $widget, $slot, $page, $entity = null)
    {

        return $this->container->get('victoire_templating')->render(
            "VictoireWidgetSiblingsMenuBundle::new.html.twig",
            array(
                "widget"          => $widget,
                'form'            => $form->createView(),
                "slot"            => $slot,
                "entity"          => $entity,
                "renderContainer" => true,
                "page"            => $page
            )
        );
    }
}
