<?php
namespace Victoire\Widget\SiblingsMenuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Victoire\CmsBundle\Entity\Widget;

/**
 * WidgetSiblingsMenu
 *
 * @ORM\Table("cms_widget_siblingsmenu")
 * @ORM\Entity
 */
class WidgetSiblingsMenu extends Widget
{
    use \Victoire\CmsBundle\Entity\Traits\WidgetTrait;

}
