<?php

namespace App\Controller\Admin\Setting;

use App\Controller\Base\BaseController;
use App\Entity\Setting\SettingKeystone;
use App\Form\Setting\SettingKeystoneType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class AdminSettingKeystoneController extends BaseController
{
    /**
     * @Route("/admin/setting/keystone/list", name="setting_keystone_list")
     * @Template("setting/keystone/list.html.twig")
     */
    public function listSettingKeystonesAction()
    {
        $settingKeystones = $this->getDoctrine()->getRepository(SettingKeystone::class)->findAll();

        $templateData = [
            'keystones' => $settingKeystones,
            'entityName' => SettingKeystone::ENTITY_NAME,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/setting/keystone/create", name="setting_keystone_create")
     * @Template("setting/keystone/create.html.twig")
     */
    public function createSettingKeystoneAction(Request $request)
    {
        $form = $this->createForm(SettingKeystoneType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $settingKeystone = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($settingKeystone);
            $entityManager->flush();

            $this->addFlash('success', 'Fundament świata stworzony!');

            return $this->redirectToRoute('setting_keystone_list');
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => SettingKeystone::ENTITY_NAME,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/setting/keystone/{id}/edit", name="setting_keystone_edit")
     * @Template("setting/keystone/edit.html.twig")
     */
    public function editSettingKeystoneAction(Request $request, SettingKeystone $settingKeystone)
    {
        $form = $this->createForm(SettingKeystoneType::class, $settingKeystone);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $settingKeystone = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($settingKeystone);
            $entityManager->flush();

            $this->addFlash('success', 'Fundament świata zmieniony!');

            return $this->redirectToRoute('setting_keystone_list');
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => SettingKeystone::ENTITY_NAME,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/setting/keystone/{id}/kill", name="setting_keystone_kill")
     */
    public function killSettingKeystoneAction(SettingKeystone $settingKeystone)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $settingKeystone->setIsActive(false);

        $entityManager->persist($settingKeystone);
        $entityManager->flush();

        $this->addFlash('warning', 'Fundament świata zabity!');

        return $this->redirectToRoute('setting_keystone_list');
    }

    /**
     * @Route("/admin/setting/keystone/{id}/revive", name="setting_keystone_revive")
     */
    public function reviveSettingKeystoneAction(SettingKeystone $settingKeystone)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $settingKeystone->setIsActive(true);

        $entityManager->persist($settingKeystone);
        $entityManager->flush();

        $this->addFlash('success', 'Fundament świata wskrzeszony!');

        return $this->redirectToRoute('setting_keystone_list');
    }

    /**
     * @Route("/admin/setting/keystone/{id}/delete", name="setting_keystone_delete")
     */
    public function deleteSettingKeystoneAction(SettingKeystone $settingKeystone)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($settingKeystone);
        $entityManager->flush();

        $this->addFlash('danger', 'Fundament świata usunięty!');

        return $this->redirectToRoute('setting_keystone_list');
    }
}