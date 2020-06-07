<?php

namespace App\Campaign\Controller;

use App\Controller\Base\BaseController;

use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class HexmapController extends BaseController
{
    /**
     * @Route("/campaign/hexmap", name="hexmap_test")
     * @Template("campaign/hexmap/index.html.twig")
     */
    public function hexmapIndex()
    {

    }
}