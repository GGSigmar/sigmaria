<?php

namespace App\Controller\Setting\Admin;

use App\Controller\Base\BaseController;
use App\Entity\Setting\SettingFoundation;
use App\Form\Setting\SettingFoundationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class AdminSettingFoundationController extends BaseController
{
    /**
     * @Route("/admin/setting/foundation/list", name="setting_foundation_list")
     * @Template("setting/foundation/list.html.twig")
     */
    public function listSettingFoundationsAction()
    {
        $settingFoundations = $this->getDoctrine()->getRepository(SettingFoundation::class)->findAll();

        $templateData = [
            'foundations' => $settingFoundations,
            'entityName' => SettingFoundation::ENTITY_NAME,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/setting/foundation/create", name="setting_foundation_create")
     * @Template("setting/foundation/create.html.twig")
     */
    public function createSettingFoundationAction(Request $request)
    {
        $form = $this->createForm(SettingFoundationType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $settingFoundation = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($settingFoundation);
            $entityManager->flush();

            $this->addFlash('success', 'Fundament świata stworzony!');

            return $this->redirectToRoute('setting_foundation_list');
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => SettingFoundation::ENTITY_NAME,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/setting/foundation/{id}/edit", name="setting_foundation_edit")
     * @Template("setting/foundation/edit.html.twig")
     */
    public function editSettingFoundationAction(Request $request, SettingFoundation $settingFoundation)
    {
        $form = $this->createForm(SettingFoundationType::class, $settingFoundation);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $settingFoundation = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($settingFoundation);
            $entityManager->flush();

            $this->addFlash('success', 'Fundament świata zmieniony!');

            return $this->redirectToRoute('setting_foundation_list');
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => SettingFoundation::ENTITY_NAME,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/setting/foundation/{id}/kill", name="setting_foundation_kill")
     */
    public function killSettingFoundationAction(SettingFoundation $settingFoundation)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $settingFoundation->setIsActive(false);

        $entityManager->persist($settingFoundation);
        $entityManager->flush();

        $this->addFlash('warning', 'Fundament świata zabity!');

        return $this->redirectToRoute('setting_foundation_list');
    }

    /**
     * @Route("/admin/setting/foundation/{id}/revive", name="setting_foundation_revive")
     */
    public function reviveSettingFoundationAction(SettingFoundation $settingFoundation)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $settingFoundation->setIsActive(true);

        $entityManager->persist($settingFoundation);
        $entityManager->flush();

        $this->addFlash('success', 'Fundament świata wskrzeszony!');

        return $this->redirectToRoute('setting_foundation_list');
    }

    /**
     * @Route("/admin/setting/foundation/{id}/delete", name="setting_foundation_delete")
     */
    public function deleteSettingFoundationAction(SettingFoundation $settingFoundation)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($settingFoundation);
        $entityManager->flush();

        $this->addFlash('danger', 'Fundament świata usunięty!');

        return $this->redirectToRoute('setting_foundation_list');
    }
}