<?php

namespace App\Controller\Ancestry;

use App\Controller\Base\BaseController;
use App\Entity\Ancestry\AncestralFeature;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;

class AncestralFeatureController extends BaseController
{
    /**
     * @Route("/ancestry/feature/list", name="ancestral_feature_list")
     * @Template("ancestry/feature/list.html.twig")
     */
    public function listAncestralFeaturesAction()
    {
        $ancestralFeatures = $this->getDoctrine()->getRepository(AncestralFeature::class)
            ->findBy(['isActive' => true]);

        $templateData = [
            'ancestralFeatures' => $ancestralFeatures,
            'entityName' => 'ancestral_feature',
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }
}