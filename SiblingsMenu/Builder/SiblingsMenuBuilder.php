<?php

namespace Victoire\Widget\SiblingsMenuBundle\SiblingsMenu\Builder;

use Knp\Menu\FactoryInterface;
use Victoire\Bundle\PageBundle\Entity\BasePage;

/**
 * This class generate a siblingsmenu for a Victoire DCMS page given.
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
     * Build a siblingsmenu for a Victoire DCMS page given.
     *
     * @return MenuItem
     **/
    public function build(BasePage $page)
    {
        $siblingsmenu = $this->factory->createItem('root');

        // I. Accueil
        //     I.1 Particuliers
        //         I.1.1
        //         I.1.2
        //         I.1.3
        //     I.2 Expatries
        //         I.2.1 Conseils
        //             I.2.1.1 Préparer son départ
        //                 I.2.1.1.1 Impôts
        //                 I.2.1.1.2 Placement
        //                 I.2.1.1.3 Couverture sociale
        //             I.2.1.2 Préparer son retour
        //         I.2.2 Assurance santé

        // ________________________________________________
        // || Page                | Children    | Parent ||
        // ------------------------------------------------
        // |  Impots              |   ---       |     Oui |
        // |  Préparer son départ |   Oui       |     Oui |
        // |  Accueil             |   Oui       |     --- |

        if ($page->getParent()) {
            if (count($page->getChildren())) {
                $father = $page;
                $grandFather = $page->getParent();
            } else {
                $father = $page->getParent();
                $grandFather = $father->getParent();
            }

            //Iterates the fathers/uncles as $_level2Page to build the siblings menu architecture tree
            foreach ($grandFather->getChildren() as $key => $_level2Page) {
                $_level2PageItem = $siblingsmenu->addChild(
                    $_level2Page->getSlug(),
                    [
                        'route'           => 'victoire_core_page_show',
                        'label'           => $_level2Page->getName(),
                        'routeParameters' => [
                            'url' => $_level2Page->getUrl(),
                        ],
                    ]
                )
                //Check if this second level page is the same as the widget current page's father
                ->setCurrent($_level2Page->getId() === $father->getId());

                //Iterates the childrens/cousins as $_level3Page to build the siblings menu architecture branches
                foreach ($_level2Page->getChildren() as $_key => $_level3Page) {
                    $_level2PageItem->addChild(
                        $_level3Page->getSlug(),
                        [
                            'route'           => 'victoire_core_page_show',
                            'label'           => $_level3Page->getName(),
                            'routeParameters' => [
                                'url' => $_level3Page->getUrl(),
                            ],
                        ]
                        //Check if this third level page is the same as the widget current page
                    )->setCurrent($page->getId() === $_level3Page->getId());
                }
            }
        }

        return $siblingsmenu;
    }
}
