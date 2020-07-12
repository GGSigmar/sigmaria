<?php

namespace App\Controller\Setting;

use App\Controller\Base\BaseController;
use App\Entity\Setting\Location;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;

class LocationController extends BaseController
{
    /**
     * @Route("/setting/location/list", name="location_list")
     * @Template("setting/location/list.html.twig")
     */
    public function listLocationsAction()
    {
        $locations = $this->getDoctrine()->getRepository(Location::class)->findAll();

        $templateData = [
            'locations' => $locations,
            'entityName' => Location::ENTITY_NAME,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_SETTING));
    }

    /**
     * @Route("/setting/location/{id}/show", name="location_show")
     * @Template("setting/location/show.html.twig")
     */
    public function showLocationAction(Location $location)
    {
        $this->denyAccessUnlessGranted('view', $location);

        $templateData = [
            'location' => $location,
            'entityName' => Location::ENTITY_NAME,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_SETTING));
    }
}