<?php

namespace GlyphiconsBundle\Controller;

use GlyphiconsBundle\Entity\Icon;
use GlyphiconsBundle\Form\IconType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile as UploadedFile ;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{
    /**
     * @Route("/glyphicons")
     */
    public function indexAction(Request $request)
    {

        $icon = new Icon();
        $form = $this->createForm(IconType::class, $icon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $file = $icon->getFile();

            /* @var UploadedFile **/
            $fileName = $icon->getName().'.svg';

            try {
                $file->move(
                    $this->getParameter('icons_directory'),
                    $fileName
                );
            } catch (FileException $e) {
                throw new \Exception('File not moved');
            }


            $icon->setFile($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($icon);
            $em->flush();

            return $this->redirect($this->generateUrl('glyphicons_default_list'));
        }

        return $this->render('default/Glyphicons.html.twig', array(
            'form' => $form->createView(),
        ));




    }

    /**
     * @Route("/glyphicons-list")
     */
    public function listAction(Request $request)
    {

        $entityManager = $this->getDoctrine()->getManager();
        $icons = $entityManager
            ->getRepository(Icon::class)
            ->findBy([], ['id' => 'DESC'])
        ;

        return $this->render('default/Glyphicons-list.html.twig', [
            'base_dir'  => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'icons'     => $icons
        ]);
    }
}
