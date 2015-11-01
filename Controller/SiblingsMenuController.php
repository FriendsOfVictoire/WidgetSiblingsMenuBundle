<?php

namespace Victoire\Widget\SiblingsMenuBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Victoire\Bundle\PageBundle\Entity\BasePage;

/**
 * Display a siblingsmenu for a given page.
 */
class SiblingsMenuController extends Controller
{
    /**
     * @param Page $page
     *
     * @Route("/show")
     * @Template("VictoireWidgetSiblingsMenuBundle:SiblingsMenu:show.html.twig")
     * @ParamConverter("page", class="VictoirePageBundle:BasePage")
     *
     * @return array
     */
    public function showAction(BasePage $page)
    {
        $siblingsmenu = $this->get('victoire_core.widget_siblingsmenu_builder');

        return [
            'siblingsmenu' => $siblingsmenu->build($page),
        ];
    }
}
