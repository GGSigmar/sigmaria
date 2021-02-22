<?php

namespace App\Controller\Setting\Admin;

use App\Controller\Base\BaseController;
use App\Entity\Core\Feat;
use App\Entity\Core\Paragraph;
use App\Entity\Setting\Culture;
use App\Form\Core\FeatType;
use App\Form\Core\ParagraphType;
use App\Form\Setting\CultureType;
use App\Service\Core\SourcableService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class AdminCultureController extends BaseController
{
    /**
     * @Route("/admin/setting/culture/create", name="culture_create")
     * @Template("setting/culture/create.html.twig")
     */
    public function createCultureAction(Request $request)
    {
        $form = $this->createForm(CultureType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $culture = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($culture);
            $entityManager->flush();

            $this->addFlash('success', 'Pochodzenie stworzone!');

            return $this->redirectToRoute('culture_list');
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => 'culture',
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_RULES));
    }

    /**
     * @Route("/admin/setting/culture/{id}/edit", name="culture_edit")
     * @Template("setting/culture/edit.html.twig")
     */
    public function editCultureAction(Request $request, Culture $culture)
    {
        $form = $this->createForm(CultureType::class, $culture);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $culture = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($culture);
            $entityManager->flush();

            $this->addFlash('success', 'Pochodzenie zmienione!');

            return $this->redirectToRoute('culture_show', ['id' => $culture->getId()]);
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => 'culture',
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_RULES));
    }

    /**
     * @Route("/admin/setting/culture/{id}/kill", name="culture_kill")
     */
    public function killCultureAction(Culture $culture)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $culture->setIsActive(false);

        $entityManager->persist($culture);
        $entityManager->flush();

        $this->addFlash('warning', 'Pochodzenie zabite!');

        return $this->redirectToRoute('culture_list');
    }

    /**
     * @Route("/admin/setting/culture/{id}/revive", name="culture_revive")
     */
    public function reviveCultureAction(Culture $culture)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $culture->setIsActive(true);

        $entityManager->persist($culture);
        $entityManager->flush();

        $this->addFlash('success', 'Pochodzenie wskrzeszone!');

        return $this->redirectToRoute('culture_list');
    }

    /**
     * @Route("/admin/setting/culture/{id}/delete", name="culture_delete")
     */
    public function deleteCultureAction(Culture $culture)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($culture);
        $entityManager->flush();

        $this->addFlash('danger', 'Pochodzenie usunięte!');

        return $this->redirectToRoute('culture_list');
    }

    /**
     * @Route("/admin/setting/culture/{id}/stage", name="culture_stage")
     */
    public function stageCultureAction(Culture $culture)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $culture->setIsToBeReleased(true);

        $entityManager->persist($culture);
        $entityManager->flush();

        $this->addFlash('success', 'Pochodzenie oznaczone do wydania!');

        return $this->redirectToRoute('culture_list');
    }

    /**
     * @Route("/admin/setting/culture/{id}/unstage", name="culture_unstage")
     */
    public function unstageCultureAction(Culture $culture)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $culture->setIsToBeReleased(false);

        $entityManager->persist($culture);
        $entityManager->flush();

        $this->addFlash('warning', 'Pochodzenie wyłączone z wydania!');

        return $this->redirectToRoute('culture_list');
    }

    /**
     * @Route("/admin/setting/culture/{id}/feat/create", name="culture_feat_create")
     * @Template("core/feat/create.html.twig")
     */
    public function createCultureFeatAction(Request $request, Culture $culture, SourcableService $sourcableService)
    {
        $form = $this->createForm(FeatType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $feat = $form->getData();

            $culture->addFeat($feat);

            $sourcableService->ensureEmptySourceNullification($feat);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($feat);
            $entityManager->persist($culture);
            $entityManager->flush();

            $this->addFlash('success', 'Atut stworzony!');

            return $this->redirectToRoute('culture_show', ['id' => $culture->getId()]);
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => Feat::ENTITY_NAME,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_RULES));
    }

    /**
     * @Route("/admin/setting/culture/{baseId}/feat/{id}/edit", name="culture_feat_edit")
     * @Template("core/feat/create.html.twig")
     */
    public function editCultureFeatAction(Request $request, int $baseId, int $id, SourcableService $sourcableService)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $feat = $entityManager->getRepository(Feat::class)->find($id);

        $form = $this->createForm(FeatType::class, $feat);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $feat = $form->getData();

            $sourcableService->ensureEmptySourceNullification($feat);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($feat);
            $entityManager->flush();

            $this->addFlash('success', 'Atut zmieniony!');

            return $this->redirectToRoute('culture_show', ['id' => $baseId]);
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => Feat::ENTITY_NAME,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_RULES));
    }

    /**
     * @Route("/admin/setting/culture/{id}/paragraph/create", name="culture_paragraph_create")
     * @Template("core/paragraph/create.html.twig")
     */
    public function createCultureParagraphAction(Request $request, Culture $culture)
    {
        $form = $this->createForm(ParagraphType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $paragraph = $form->getData();

            $culture->addParagraph($paragraph);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($paragraph);
            $entityManager->persist($culture);
            $entityManager->flush();

            $this->addFlash('success', 'Paragraf stworzony!');

            return $this->redirectToRoute('culture_show', ['id' => $culture->getId()]);
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => Paragraph::ENTITY_NAME,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_RULES));
    }

    /**
     * @Route("/admin/setting/culture/{baseId}/paragraph/{id}/edit", name="culture_paragraph_edit")
     * @Template("core/paragraph/edit.html.twig")
     * @ParamConverter("culture", class="App\Entity\Culture\Culture", options={"id"="baseId"})
     * @ParamConverter("paragraph", class="App\Entity\Core\Paragraph", options={"id"="id"})
     */
    public function editCultureParagraphAction(Request $request, Culture $culture, Paragraph $paragraph)
    {
        $form = $this->createForm(ParagraphType::class, $paragraph);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $paragraph = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($paragraph);
            $entityManager->persist($culture);
            $entityManager->flush();

            $this->addFlash('success', 'Paragraf edytowany!');

            return $this->redirectToRoute('culture_show', ['id' => $culture->getId()]);
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => Paragraph::ENTITY_NAME,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_RULES));
    }
}