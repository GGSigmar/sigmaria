<?php

namespace App\Controller\Core;

use App\Controller\Base\BaseController;
use App\Entity\Core\Attribute;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;

class AttributeController extends BaseController
{
    /**
     * @Route("/core/attribute/list", name="attribute_list")
     * @Template("core/attribute/list.html.twig")
     */
    public function listAttributesAction()
    {
        $attributes = $this->getDoctrine()->getRepository(Attribute::class)
            ->findBy(['isActive' => true]);

        $templateData = [
            'attributes' => $attributes,
            'entityName' => 'attribute',
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }
}