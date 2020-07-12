<?php

namespace App\Controller\Admin\Setting;

use App\Controller\Base\BaseController;
use App\Entity\Setting\LocationType;
use App\Form\Setting\LocationTypeType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class AdminLocationTypeController extends BaseController
{
    /**
     * @Route("/admin/setting/location-type/list", name="location_type_list")
     * @Template("setting/location-type/list.html.twig")
     */
    public function listLocationTypesAction()
    {
        $locationTypes = $this->getDoctrine()->getRepository(LocationType::class)->findAll();

        $templateData = [
            'locationTypes' => $locationTypes,
            'entityName' => 'location_type',
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/setting/location-type/create", name="location_type_create")
     * @Template("setting/location-type/create.html.twig")
     */
    public function createLocationTypeAction(Request $request)
    {
        $form = $this->createForm(LocationTypeType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $locationType = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($locationType);
            $entityManager->flush();

            $this->addFlash('success', 'Typ lokacji stworzony!');

            return $this->redirectToRoute('location_type_list');
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => 'location_type',
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/setting/location-type/{id}/edit", name="location_type_edit")
     * @Template("setting/location-type/edit.html.twig")
     */
    public function editLocationTypeAction(Request $request, LocationType $locationType)
    {
        $form = $this->createForm(LocationTypeType::class, $locationType);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $locationType = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($locationType);
            $entityManager->flush();

            $this->addFlash('success', 'Typ lokacji zmieniony!');

            return $this->redirectToRoute('location_type_list');
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => 'location_type',
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/setting/location-type/{id}/delete", name="location_type_delete")
     */
    public function deleteLocationTypeAction(LocationType $locationType)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($locationType);
        $entityManager->flush();

        $this->addFlash('danger', 'Typ lokacji usunięty!');

        return $this->redirectToRoute('location_type_list');
    }
}