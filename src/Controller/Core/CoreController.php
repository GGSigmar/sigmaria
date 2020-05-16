<?php

namespace App\Controller\Core;

use App\Controller\Base\BaseController;
use App\Entity\Ancestry\Ancestry;
use App\Entity\Ancestry\Heritage;
use App\Entity\Core\CharacterCreationStep;
use App\Entity\Core\Feat;
use App\Entity\Core\Release;
use App\Entity\Setting\Background;
use App\Entity\Setting\Culture;
use App\Entity\Setting\Language;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CoreController extends BaseController
{
    /**
     * @Route("/", name="home")
     * @Template("core\index.html.twig")
     */
    public function indexAction()
    {
        $coreAncestries = $this->getDoctrine()->getRepository(Ancestry::class)->getCoreAncestries();

        $templateData = [
            'coreAncestries' => $coreAncestries,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_HOME));
    }

    /**
     * @Route("/character-creation", name="character_creation")
     * @Template("core\information_page\character_creation.html.twig")
     */
    public function characterCreationAction()
    {
        $steps = $this->getDoctrine()->getRepository(CharacterCreationStep::class)->getSortedActiveCharacterCreationSteps();

        $templateData = [
            'steps' => $steps,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_RULES));
    }

    /**
     * @Route("/update-slugs", name="update_slugs")
     */
    public function updateSlugsAction(Request $request)
    {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();

        $entities = $doctrine->getRepository(Feat::class)->findAll();

        foreach ($entities as $entity) {
            $entity->setSlug(null);
            $em->persist($entity);
        }

        $em->flush();

        $entities = $doctrine->getRepository(Culture::class)->findAll();

        foreach ($entities as $entity) {
            $entity->setSlug(null);
            $em->persist($entity);
        }

        $em->flush();

        $entities = $doctrine->getRepository(Background::class)->findAll();

        foreach ($entities as $entity) {
            $entity->setSlug(null);
            $em->persist($entity);
        }

        $em->flush();

        $entities = $doctrine->getRepository(Language::class)->findAll();

        foreach ($entities as $entity) {
            $entity->setSlug(null);
            $em->persist($entity);
        }

        $em->flush();

        $entities = $doctrine->getRepository(Release::class)->findAll();

        foreach ($entities as $entity) {
            $entity->setSlug(null);
            $em->persist($entity);
        }

        $em->flush();

        $entities = $doctrine->getRepository(Heritage::class)->findAll();

        foreach ($entities as $entity) {
            $entity->setSlug(null);
            $em->persist($entity);
        }

        $em->flush();

        $entities = $doctrine->getRepository(Ancestry::class)->findAll();

        foreach ($entities as $entity) {
            $entity->setSlug(null);
            $em->persist($entity);
        }

        $em->flush();

        $this->addFlash('success', 'Slugi zaktualizowane!');

        return $this->redirectToReferer($request);
    }
}