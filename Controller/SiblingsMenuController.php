<?php

namespace Victoire\Widget\SiblingsMenuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Victoire\Bundle\PageBundle\Entity\Page;

/**
 * Display a siblingsmenu for a given page
 */
class SiblingsMenuController extends Controller
{
    /**
     * @Route("/show")
     * @Template("VictoireWidgetSiblingsMenuBundle:SiblingsMenu:show.html.twig")
     * @ParamConverter("page", class="VictoirePageBundle:Page")
     *
     * @param Page $page The page
     * @param string   $mode The mode
     *
     * @return Array The menu
     */
    public function showAction(Page $page, $mode)
    {
        $siblingsmenu = $this->get('victoire_core.widget_siblingsmenu_builder');

        return array(
            'siblingsmenu' => $siblingsmenu->build($page, $mode)
        );
    }
}
