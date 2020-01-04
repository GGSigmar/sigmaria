<?php

namespace App\Controller\Admin\Setting;

use App\Controller\Base\BaseController;
use App\Entity\Setting\Language;
use App\Form\Setting\LanguageType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class AdminLanguageController extends BaseController
{
    /**
     * @Route("/admin/setting/language/create", name="language_create")
     * @Template("setting/language/form.html.twig")
     */
    public function createLanguageAction(Request $request)
    {
        $form = $this->createForm(LanguageType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $language = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($language);
            $entityManager->flush();

            $this->addFlash('success', 'Język stworzony!');

            return $this->redirectToRoute('language_list');
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => 'language',
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_RULES));
    }

    /**
     * @Route("/admin/setting/language/{id}/edit", name="language_edit")
     * @Template("setting/language/form.html.twig")
     */
    public function editLanguageAction(Request $request, Language $language)
    {
        $form = $this->createForm(LanguageType::class, $language);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $language = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($language);
            $entityManager->flush();

            $this->addFlash('success', 'Język zmieniony!');

            return $this->redirectToRoute('language_show', ['id' => $language->getId()]);
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => 'language',
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_RULES));
    }

    /**
     * @Route("/admin/setting/language/{id}/kill", name="language_kill")
     */
    public function killLanguageAction(Language $language)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $language->setIsActive(false);

        $entityManager->persist($language);
        $entityManager->flush();

        $this->addFlash('warning', 'Język zabity!');

        return $this->redirectToRoute('language_list');
    }

    /**
     * @Route("/admin/setting/language/{id}/revive", name="language_revive")
     */
    public function reviveLanguageAction(Language $language)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $language->setIsActive(true);

        $entityManager->persist($language);
        $entityManager->flush();

        $this->addFlash('success', 'Język wskrzeszony!');

        return $this->redirectToRoute('language_list');
    }

    /**
     * @Route("/admin/setting/language/{id}/delete", name="language_delete")
     */
    public function deleteLanguageAction(Language $language)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($language);
        $entityManager->flush();

        $this->addFlash('danger', 'Język usunięty!');

        return $this->redirectToRoute('language_list');
    }

    /**
     * @Route("/admin/setting/language/{id}/stage", name="language_stage")
     */
    public function stageLanguageAction(Language $language)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $language->setIsToBeReleased(true);

        $entityManager->persist($language);
        $entityManager->flush();

        $this->addFlash('success', 'Język oznaczony do wydania!');

        return $this->redirectToRoute('language_list');
    }

    /**
     * @Route("/admin/setting/language/{id}/unstage", name="language_unstage")
     */
    public function unstageLanguageAction(Language $language)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $language->setIsToBeReleased(false);

        $entityManager->persist($language);
        $entityManager->flush();

        $this->addFlash('warning', 'Język wyłączony z wydania!');

        return $this->redirectToRoute('language_list');
    }
}