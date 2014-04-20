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

    /**
     * @var string
     *
     * @ORM\Column(name="with_cousins", type="boolean", nullable=true)
     */
    private $withCousins;

    /**
     * Get withCousins
     *
     * @return string
     */
    public function getWithCousins()
    {
        return $this->withCousins;
    }

    /**
     * Set withCousins
     *
     * @param string $withCousins
     * @return $this
     */
    public function setWithCousins($withCousins)
    {
        $this->withCousins = $withCousins;
        return $this;
    }
}
