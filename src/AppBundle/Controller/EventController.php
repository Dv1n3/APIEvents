<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\EventType;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Event;
use FOS\RestBundle\Controller\Annotations as Rest;
use AppBundle\Repository\EventRepository;

/**
 * Created by PhpStorm.
 * User: dvine
 * Date: 20/04/2018
 * Time: 18:27
 */

class EventController extends Controller
{
    /**
     * @Rest\View()
     * @Rest\Get("/api/events")
     */
    public function getEventsAction(Request $request){

        $events = $this->getDoctrine()
            ->getRepository('AppBundle:Event')
            ->findAll();
        if (empty($events)){
            return View::create(['message' => 'Event not found'], Response::HTTP_NOT_FOUND);
        }
        return $events;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/api/events/{id}")
     */
    public function getEventAction(Request $request){


        $event = $this->getDoctrine()
            ->getRepository('AppBundle:Event')
            ->findBy($request->get('id'));

        if (empty($event)){
            return View::create(['message' => 'Event not found'], Response::HTTP_NOT_FOUND);
        }
        return $event;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/api/events")
     */
    public  function postEventAction(Request $request){
        $event = new Event();

        $form = $this->createForm(EventType::class, $event);

        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();
            return $event;
        } else {
            return $form;
        }
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/api/events/{id}")
     */
    public function removeEventAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('AppBundle:Event')
            ->find($request->get('id'));

        if ($event) {
            $em->remove($event);
            $em->flush();
        }
        else {
            return View::create(['message' => 'Event not found'], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @Rest\View(statusCode = 201)
     * @Rest\Put("/api/events/{id}")
     */
    public function updateEventAction(Request $request)
    {
        return $this->updateEvent($request, true);
    }

    /**
     * @Rest\View(statusCode = 201)
     * @Rest\Patch("/api/events/{id}")
     */
    public function patchEventAction(Request $request)
    {
        return $this->updateEvent($request, false);
    }

    private function updateEvent(Request $request, $clearMissing)
    {
        $event = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle:Event')
            ->find($request->get('id')); // L'identifiant en tant que paramètre n'est plus nécessaire

        if (empty($event)) {
            return View::create(['message' => 'Event not found'], Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(EventType::class, $event);

        $form->submit($request->request->all(), $clearMissing);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();
            return $event;
        } else {
            return $form;
        }
    }

    public function getEventsByNameAction(Request $request){

    }

    /**
     * @Rest\View()
     * @Rest\Get("/api/dashboard")
     */
    public function getNbOfEventsAction()
    {
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Event');
    $nbOfEvents = $repository->getNbOfEvents();
    return $nbOfEvents;
    }
}