<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Image;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{
    /**
     *
     * /1
     *
     */

    /**
     * @Route("/10/{id}")
     */
    public function getUserById(User $user)
    {
        return $this->createUserResponse($user);
    }

    /**
     * @Route("/11/{user_id}")
     *
     * Unable to guess how to get a Doctrine instance from the request information.
     */
    public function getUserByUserId1(User $user)
    {
        return $this->createUserResponse($user);
    }

    /**
     * @Route("/12/{user_id}")
     * @ParamConverter("user", options={"id" = "user_id"})
     */
    public function getUserByUserId2(User $user)
    {
        return $this->createUserResponse($user);
    }

    /**
     *
     * /user_1
     *
     */

    /**
     * @Route("/20/{name}")
     */
    public function getUserByName(User $user)
    {
        return $this->createUserResponse($user);
    }

    /**
     * @Route("/21/{user_name}")
     * @ParamConverter("user", options={"name" = "user_name"})
     *
     * Unable to guess how to get a Doctrine instance from the request information.
     */
    public function getUserByUserName1(User $user)
    {
        return $this->createUserResponse($user);
    }

    /**
     * @Route("/22/{user_name}")
     * @ParamConverter("user", options={"mapping": {"user_name": "name"}})
     */
    public function getUserByUserName2(User $user)
    {
        return $this->createUserResponse($user);
    }

    private function createUserResponse(User $user)
    {
        return new Response(join(' / ', [$user->getId(), $user->getName()]), Response::HTTP_OK);
    }

    /**
     *
     * /user_1/images/2
     *
     */

    /**
     * @Route("/30/{name}/images/{image}")
     *
     * AppBundle\Entity\User object not found.
     * SELECT t0.id AS id_1, t0.name AS name_2, t0.image_id AS image_id_3 FROM user t0 WHERE t0.name = ? AND t0.image_id = ? LIMIT 1 ["user_1","2"] []
     */
    public function getUserImage1(User $user, Image $image)
    {
        return $this->createUserImageResponse($user, $image);
    }

    /**
     * @Route("/31/{name}/images/{image}")
     * ParamConverter("image", options={"id" = "image"})
     *
     * AppBundle\Entity\User object not found.
     *
     * SELECT t0.id AS id_1, t0.user_id AS user_id_2 FROM image t0 WHERE t0.id = ? ["2"] []
     * SELECT t0.id AS id_1, t0.name AS name_2, t0.image_id AS image_id_3 FROM user t0 WHERE t0.name = ? AND t0.image_id = ? LIMIT 1 ["user_1",2] []
     */
    public function getUserImage2(User $user, Image $image)
    {
        return $this->createUserImageResponse($user, $image);
    }

    /**
     * @Route("/32/{name}/images/{image}")
     * @ParamConverter("user", options={"mapping": {"name": "name"}})
     * @ParamConverter("image", options={"id" = "image"})
     */
    public function getUserImage3(User $user, Image $image)
    {
        return $this->createUserImageResponse($user, $image);
    }

    /**
     * @Route("/33/{name}/images/{image}")
     * @ParamConverter("user", options={"mapping": {"name": "name"}})
     */
    public function getUserImage4(User $user, Image $image)
    {
        return $this->createUserImageResponse($user, $image);
    }

    /**
     * @Route("/34/{name}/images/{image}")
     * @ParamConverter("user", options={"exclude": {"image"}})
     */
    public function getUserImage5(User $user, Image $image)
    {
        return $this->createUserImageResponse($user, $image);
    }

    private function createUserImageResponse(User $user, Image $image)
    {
        return new Response(join(' / ', [$user->getId(), $user->getName(), $image->getId()]), Response::HTTP_OK);
    }
}
