<?php

namespace Victoire\Widget\SiblingsMenuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Victoire\PageBundle\Entity\BasePage;

/**
 * Display a siblingsmenu for a given page
 */
class SiblingsMenuController extends Controller
{
    /**
     * @Route("/show")
     * @Template("VictoireWidgetSiblingsMenuBundle:SiblingsMenu:show.html.twig")
     * @ParamConverter("page", class="VictoirePageBundle:BasePage")
     */
    public function showAction(BasePage $page)
    {
        $siblingsmenu = $this->get('victoire_cms.widget_siblingsmenu_builder');

        return array(
            'siblingsmenu' => $siblingsmenu->build($page)
        );
    }

}
