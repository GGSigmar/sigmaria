<?php

namespace App\Controller\Setting\Admin;

use App\Controller\Base\BaseController;
use App\Entity\Setting\Location;
use App\Form\Setting\LocationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class AdminLocationController extends BaseController
{
    /**
     * @Route("/admin/setting/location/create", name="location_create")
     * @Template("setting/location/create.html.twig")
     */
    public function createLocationAction(Request $request)
    {
        $form = $this->createForm(LocationType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $location = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($location);
            $entityManager->flush();

            $this->addFlash('success', 'Lokacja stworzona!');

            return $this->redirectToRoute('location_list');
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => Location::ENTITY_NAME,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_RULES));
    }

    /**
     * @Route("/admin/setting/location/{id}/edit", name="location_edit")
     * @Template("setting/location/edit.html.twig")
     */
    public function editLocationAction(Request $request, Location $location)
    {
        $form = $this->createForm(LocationType::class, $location);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $location = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($location);
            $entityManager->flush();

            $this->addFlash('success', 'Lokacja zmieniona!');

            return $this->redirectToRoute('location_show', ['id' => $location->getId()]);
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => Location::ENTITY_NAME,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_RULES));
    }

    /**
     * @Route("/admin/setting/location/{id}/kill", name="location_kill")
     */
    public function killLocationAction(Location $location)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $location->setIsActive(false);

        $entityManager->persist($location);
        $entityManager->flush();

        $this->addFlash('warning', 'Lokacja zabita!');

        return $this->redirectToRoute('location_list');
    }

    /**
     * @Route("/admin/setting/location/{id}/revive", name="location_revive")
     */
    public function reviveLocationAction(Location $location)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $location->setIsActive(true);

        $entityManager->persist($location);
        $entityManager->flush();

        $this->addFlash('success', 'Lokacja wskrzeszona!');

        return $this->redirectToRoute('location_list');
    }

    /**
     * @Route("/admin/setting/location/{id}/delete", name="location_delete")
     */
    public function deleteLocationAction(Location $location)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($location);
        $entityManager->flush();

        $this->addFlash('danger', 'Lokacja usunięta!');

        return $this->redirectToRoute('location_list');
    }

    /**
     * @Route("/admin/setting/location/{id}/stage", name="location_stage")
     */
    public function stageLocationAction(Location $location)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $location->setIsToBeReleased(true);

        $entityManager->persist($location);
        $entityManager->flush();

        $this->addFlash('success', 'Lokacja oznaczona do wydania!');

        return $this->redirectToRoute('location_list');
    }

    /**
     * @Route("/admin/setting/location/{id}/unstage", name="location_unstage")
     */
    public function unstageLocationAction(Location $location)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $location->setIsToBeReleased(false);

        $entityManager->persist($location);
        $entityManager->flush();

        $this->addFlash('warning', 'Lokacja wyłączona z wydania!');

        return $this->redirectToRoute('location_list');
    }
}