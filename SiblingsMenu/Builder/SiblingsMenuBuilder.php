<?php

namespace Victoire\Widget\SiblingsMenuBundle\SiblingsMenu\Builder;

use Knp\Menu\FactoryInterface;
use Victoire\Bundle\PageBundle\Entity\BasePage;

/**
 * This class generate a siblingsmenu for a Victoire CMS page given
 **/
class SiblingsMenuBuilder
{
    private $factory;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Build a siblingsmenu for a Victoire CMS page given
     *
     * @return MenuItem
     **/
    public function build(BasePage $page, $withCousins = false)
    {
        $siblingsmenu = $this->factory->createItem('root');

        $father = $page->getParent();
        if ($father) {

            if ($withCousins) {
                $grandFather = $father->getParent();
            } else {
                $grandFather = $father;
            }

            //test variable
            if ($grandFather !== null) {

                //Iterates the fathers/uncles as $_level2Page to build the siblings menu architecture tree
                foreach ($grandFather->getChildren() as $key => $_level2Page) {
                    $_level2PageItem = $siblingsmenu->addChild(
                        $_level2Page->getSlug(),
                        array(
                            'route' => 'victoire_core_page_show',
                            'label' => $_level2Page->getTitle(),
                            'routeParameters' => array(
                                'url' => $_level2Page->getUrl()
                            )
                        )
                    )
                    //Check if this second level page is the same as the widget current page's father
                    ->setCurrent($_level2Page->getId() === $father->getId());

                    //Iterates the childrens/cousins as $_level3Page to build the siblings menu architecture branches
                    foreach ($_level2Page->getChildren() as $_key => $_level3Page) {
                        $_level2PageItem->addChild(
                            $_level3Page->getSlug(),
                            array(
                                'route' => 'victoire_core_page_show',
                                'label' => $_level3Page->getTitle(),
                                'routeParameters' => array(
                                    'url' => $_level3Page->getUrl()
                                )
                            )
                            //Check if this third level page is the same as the widget current page
                        )->setCurrent($page->getId() === $_level3Page->getId());
                    }
                }
            }
        }

        return $siblingsmenu;
    }
}
