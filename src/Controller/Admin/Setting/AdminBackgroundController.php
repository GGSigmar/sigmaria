<?php

namespace App\Controller\Admin\Setting;

use App\Controller\Base\BaseController;
use App\Entity\Setting\Background;
use App\Form\Setting\BackgroundType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class AdminBackgroundController extends BaseController
{
    /**
     * @Route("/admin/setting/background/create", name="background_create")
     * @Template("setting/background/create.html.twig")
     */
    public function createBackgroundAction(Request $request)
    {
        $form = $this->createForm(BackgroundType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $background = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($background);
            $entityManager->flush();

            $this->addFlash('success', 'Pochodzenie stworzone!');

            return $this->redirectToRoute('background_list');
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => 'background',
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_RULES));
    }

    /**
     * @Route("/admin/setting/background/{id}/edit", name="background_edit")
     * @Template("setting/background/edit.html.twig")
     */
    public function editBackgroundAction(Request $request, Background $background)
    {
        $form = $this->createForm(BackgroundType::class, $background);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $background = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($background);
            $entityManager->flush();

            $this->addFlash('success', 'Pochodzenie zmienione!');

            return $this->redirectToRoute('background_show', ['id' => $background->getId()]);
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => 'background',
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_RULES));
    }

    /**
     * @Route("/admin/setting/background/{id}/kill", name="background_kill")
     */
    public function killBackgroundAction(Background $background)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $background->setIsActive(false);

        $entityManager->persist($background);
        $entityManager->flush();

        $this->addFlash('warning', 'Pochodzenie zabite!');

        return $this->redirectToRoute('background_list');
    }

    /**
     * @Route("/admin/setting/background/{id}/revive", name="background_revive")
     */
    public function reviveBackgroundAction(Background $background)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $background->setIsActive(true);

        $entityManager->persist($background);
        $entityManager->flush();

        $this->addFlash('success', 'Pochodzenie wskrzeszone!');

        return $this->redirectToRoute('background_list');
    }

    /**
     * @Route("/admin/setting/background/{id}/delete", name="background_delete")
     */
    public function deleteBackgroundAction(Background $background)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($background);
        $entityManager->flush();

        $this->addFlash('danger', 'Pochodzenie usunięte!');

        return $this->redirectToRoute('background_list');
    }

    /**
     * @Route("/admin/setting/background/{id}/stage", name="background_stage")
     */
    public function stageBackgroundAction(Background $background)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $background->setIsToBeReleased(true);

        $entityManager->persist($background);
        $entityManager->flush();

        $this->addFlash('success', 'Pochodzenie oznaczone do wydania!');

        return $this->redirectToRoute('background_list');
    }

    /**
     * @Route("/admin/setting/background/{id}/unstage", name="background_unstage")
     */
    public function unstageBackgroundAction(Background $background)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $background->setIsToBeReleased(false);

        $entityManager->persist($background);
        $entityManager->flush();

        $this->addFlash('warning', 'Pochodzenie wyłączone z wydania!');

        return $this->redirectToRoute('background_list');
    }
}