<?php

namespace App\Controller\Core;

use App\Controller\Base\BaseController;
use App\Entity\Ancestry\Ancestry;
use App\Entity\Ancestry\Heritage;
use App\Entity\Campaign\Campaign;
use App\Entity\Core\CharacterCreationStep;
use App\Entity\Core\Feat;
use App\Entity\Core\Release;
use App\Entity\Setting\Background;
use App\Entity\Setting\Culture;
use App\Entity\Setting\Language;
use App\Entity\Setting\Location;
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
        $primaryAncestries = $this->getDoctrine()->getRepository(Ancestry::class)->getAncestriesByHandles(Ancestry::PRIMARY_ANCESTRIES);
        $secondaryAncestries = $this->getDoctrine()->getRepository(Ancestry::class)->getAncestriesByHandles(Ancestry::SECONDARY_ANCESTRIES);

        $templateData = [
            'primaryAncestries' => $primaryAncestries,
            'secondaryAncestries' => $secondaryAncestries,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_HOME));
    }

    /**
     * @Route("/core/character-creation", name="character_creation")
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

        $entities = [];

        $entities[] = $doctrine->getRepository(Feat::class)->findAll();
        $entities[] = $doctrine->getRepository(Culture::class)->findAll();
        $entities[] = $doctrine->getRepository(Background::class)->findAll();
        $entities[] = $doctrine->getRepository(Language::class)->findAll();
        $entities[] = $doctrine->getRepository(Release::class)->findAll();
        $entities[] = $doctrine->getRepository(Heritage::class)->findAll();
        $entities[] = $doctrine->getRepository(Ancestry::class)->findAll();
        $entities[] = $doctrine->getRepository(Location::class)->findAll();
        $entities[] = $doctrine->getRepository(Campaign::class)->findAll();

        foreach ($entities as $entityType) {
            foreach ($entityType as $entity) {
                $entity->setSlug(null);
                $em->persist($entity);
            }

            $em->flush();
        }

        $this->addFlash('success', 'Slugs updated!');

        return $this->redirectToReferer($request);
    }

    /**
     * @Route("/css", name="css")
     * @Template("core/css.html.twig")
     */
    public function cssTest()
    {
        return $this->getTemplateData(BaseController::NAV_TAB_HOME);
    }
}