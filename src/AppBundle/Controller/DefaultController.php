<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Club;
use AppBundle\Entity\Jugadores;
use AppBundle\Form\CreateClubType;
use AppBundle\Form\CreateJugadorType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller {

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request) {
        
        return $this->render('default/index.html.twig');
    }
    
    /**
     * @Route("/createClub", name="createClub")
     */
    public function createClubAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $club = new Club();

        $form = $this->createForm(CreateClubType::class, $club);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            try {
                $em->persist($club);
                $em->flush();
                $this->addFlash('notice', 'Club creado con éxito!');
            } catch (\Doctrine\DBAL\DBALException $e) {
                $this->addFlash('noticeError', 'Error, el jugador ya se encuentra inscrito en otro equipo');
            }
            
            return $this->redirectToRoute('createClub');
        }

        return $this->render('default/createClub.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/showClubs", name="showClubs")
     */
    public function showClubsAction() {

        $clubs = $this->getDoctrine()->getRepository('AppBundle:Club')->findAll();

        return $this->render('default/showClubs.html.twig', array('clubs' => $clubs));
    }

    /**
     * @Route("/editClub/{id}", name="editClub")
     */
    public function editClubAction(Request $request, Club $club) {

        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(CreateClubType::class, $club);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->flush();
            $this->addFlash('notice', 'Club editado con éxito!');
            return $this->redirectToRoute('editClub', array('id' => $club->getId()));
        }

        return $this->render('default/createClub.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/ajax/removeClub", name="removeClub")
     * @Method({"POST"})
     */
    function removeClub(Request $request) {

        if ($request->isXmlHttpRequest()) {
            $clubId = $request->request->get('club');

            $em = $this->getDoctrine()->getManager();
            $club = $em->getRepository('AppBundle:Club')->find($clubId);

            $em->remove($club);
            $em->flush();
            return new Response(json_encode(array('valid' => 'true')));
        }
    }

    /**
     * @Route("/createJugador", name="createJugador")
     */
    public function createJugadorAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $jugador = new Jugadores();

        $form = $this->createForm(CreateJugadorType::class, $jugador);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $em->persist($jugador);
            $em->flush();

            $this->addFlash('notice', 'Jugador creado con éxito!');
            return $this->redirectToRoute('createJugador');
        }

        return $this->render('default/createJugador.html.twig', array('form' => $form->createView()));
    }

}
