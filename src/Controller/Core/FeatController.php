<?php

namespace App\Controller\Core;

use App\Controller\Base\BaseController;
use App\Entity\Core\Feat;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;

class FeatController extends BaseController
{
    /**
     * @Route("/core/feat/{id}/show", name="feat_show")
     * @Template("core/feat/show.html.twig")
     */
    public function showFeatAction(Feat $feat)
    {
        $templateData = [
            'feat' => $feat,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }
}