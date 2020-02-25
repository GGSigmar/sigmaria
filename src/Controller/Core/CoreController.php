<?php

namespace App\Controller\Core;

use App\Controller\Base\BaseController;
use App\Entity\Ancestry\Ancestry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;

class CoreController extends BaseController
{
    /**
     * @Route("/", name="home")
     * @Template("core\index.html.twig")
     */
    public function indexAction()
    {
        $coreAncestries = $this->getDoctrine()->getRepository(Ancestry::class)->getCoreAncestries();

        $templateData = [
            'coreAncestries' => $coreAncestries,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_HOME));
    }
}