<?php

namespace App\Controller\Core;

use App\Controller\Base\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;

class CoreController extends BaseController
{
    /**
     * @Route("/", name="home")
     * @Template("base\base.html.twig")
     */
    public function indexAction()
    {
        return $this->getTemplateData(BaseController::NAV_TAB_HOME);
    }
}