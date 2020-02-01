<?php

namespace App\Controller\Ancestry;

use App\Controller\Base\BaseController;
use App\Entity\Ancestry\Heritage;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class HeritageController extends BaseController
{
    /**
     * @Route("/heritage/{id}/show", name="heritage_show")
     * @Template("ancestry/heritage/show.html.twig")
     */
    public function showHeritageAction(Heritage $heritage)
    {
        $this->denyAccessUnlessGranted('view', $heritage);

        $templateData = [
            'heritage' => $heritage,
            'entityName' => 'heritage',
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_RULES));
    }
}