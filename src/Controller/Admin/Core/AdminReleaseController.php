<?php

namespace App\Controller\Admin\Core;

use App\Controller\Base\BaseController;
use App\Entity\Core\Feat;
use App\Entity\Core\Release;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class AdminReleaseController extends BaseController
{
    /**
     * @Route("/admin/core/release/list", name="release_list")
     * @Template("core/release/list.html.twig")
     */
    public function listAttributesAction()
    {
        $releases = $this->getDoctrine()->getRepository(Release::class)->findAll();

        $templateData = [
            'releases' => $releases,
            'entityName' => 'release',
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admincore/release/{id}/show", name="release_show")
     * @Template("core/release/show.html.twig")
     */
    public function showFeatAction(Release $release)
    {
        $templateData = [
            'release' => $release,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }
}