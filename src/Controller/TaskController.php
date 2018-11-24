<?php
/**
 * Created by PhpStorm.
 * User: abdullah-ehab
 * Date: 11/24/18
 * Time: 1:33 PM
 */

namespace App\Controller;
use App\Entity\Tags;
use App\Entity\Task;

use App\Form\Type\TaskType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;



class TaskController extends AbstractController
{

    public function new(Request $request){
        $task = new Task();
        $task->getTags();
        // dummy code - this is here just so that the Task has some tags
        // otherwise, this isn't an interesting example
        $tag1 = new Tags();
        $tag1->setName('tag1');
        $task->addTagsTask($tag1);
        $tag2 = new Tags();
        $tag2->setName('tag2');
        $task->addTagsTask($tag2);
        // end dummy code

        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // ... maybe do some form processing, like saving the Task and Tag objects
        }

        return $this->render('task/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}