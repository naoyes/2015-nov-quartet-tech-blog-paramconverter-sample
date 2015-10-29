<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Address;
use AppBundle\Entity\Image;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
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
     * @Route("/0/{id}")
     * @Method("GET")
     * @ParamConverter("user", class="AppBundle:User")
     *
     * SELECT t0.id AS id_1, t0.name AS name_2, t0.address_id AS address_id_3, t0.image_id AS image_id_4 FROM user t0 WHERE t0.id = ? ["1"] []

     */
    public function getUserAction($user)
    {
        return $this->createUserResponse($user);
    }

    /**
     * @Route("/10/{id}")
     * @Method("GET")
     *
     * SELECT t0.id AS id_1, t0.name AS name_2, t0.address_id AS address_id_3, t0.image_id AS image_id_4 FROM user t0 WHERE t0.id = ? ["1"] []
     */
    public function getUserById(User $user)
    {
        return $this->createUserResponse($user);
    }

    /**
     * @Route("/11/{user_id}")
     * @Method("GET")
     *
     * Unable to guess how to get a Doctrine instance from the request information.
     */
    public function getUserByUserId1(User $user)
    {
        return $this->createUserResponse($user);
    }

    /**
     * @Route("/12/{user_id}")
     * @Method("GET")
     * @ParamConverter("user", options={"id" = "user_id"})
     *
     * SELECT t0.id AS id_1, t0.name AS name_2, t0.address_id AS address_id_3, t0.image_id AS image_id_4 FROM user t0 WHERE t0.id = ? ["1"] []
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
     * @Method("GET")
     *
     * SELECT t0.id AS id_1, t0.name AS name_2, t0.address_id AS address_id_3, t0.image_id AS image_id_4 FROM user t0 WHERE t0.name = ? LIMIT 1 ["user_1"] []
     */
    public function getUserByName(User $user)
    {
        return $this->createUserResponse($user);
    }

    /**
     * @Route("/21/{user_name}")
     * @Method("GET")
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
     * @Method("GET")
     * @ParamConverter("user", options={"mapping": {"user_name": "name"}})
     *
     * SELECT t0.id AS id_1, t0.name AS name_2, t0.address_id AS address_id_3, t0.image_id AS image_id_4 FROM user t0 WHERE t0.name = ? LIMIT 1 ["user_1"] []

     */
    public function getUserByUserName2(User $user)
    {
        return $this->createUserResponse($user);
    }

    /**
     * @Route("/23/{address}")
     * @Method("GET")
     *
     * SELECT t0.id AS id_1, t0.name AS name_2, t0.address_id AS address_id_3, t0.image_id AS image_id_4 FROM user t0 WHERE t0.address_id = ? LIMIT 1 ["1"] []
     */
    public function getUserByAddress(User $user)
    {
        return $this->createUserResponse($user);
    }

    private function createUserResponse(User $user)
    {
        return new Response(join(' / ', [$user->getId(), $user->getName()]), Response::HTTP_OK);
    }

    /**
     *
     * /users/user_1/images/2
     *
     */

    /**
     * @Route("/30/users/{name}/images/{image}")
     * @Method("GET")
     *
     * AppBundle\Entity\User object not found.
     *
     * SELECT t0.id AS id_1, t0.name AS name_2, t0.address_id AS address_id_3, t0.image_id AS image_id_4 FROM user t0 WHERE t0.name = ? AND t0.image_id = ? LIMIT 1 ["user_1","2"] []

     */
    public function getUserImage1(User $user, Image $image)
    {
        return $this->createUserImageResponse($user, $image);
    }

    /**
     * @Route("/31/users/{name}/images/{image}")
     * @Method("GET")
     * ParamConverter("image", options={"id" = "image"})
     *
     * AppBundle\Entity\User object not found.
     *
     * SELECT t0.id AS id_1, t0.name AS name_2, t0.address_id AS address_id_3, t0.image_id AS image_id_4 FROM user t0 WHERE t0.name = ? AND t0.image_id = ? LIMIT 1 ["user_1","2"] []
     */
    public function getUserImage2(User $user, Image $image)
    {
        return $this->createUserImageResponse($user, $image);
    }

    /**
     * @Route("/32/users/{name}/images/{image}")
     * @Method("GET")
     * @ParamConverter("user", options={"mapping": {"name": "name"}})
     * @ParamConverter("image", options={"id" = "image"})
     *
     * SELECT t0.id AS id_1, t0.name AS name_2, t0.address_id AS address_id_3, t0.image_id AS image_id_4 FROM user t0 WHERE t0.name = ? LIMIT 1 ["user_1"] []
     * SELECT t0.id AS id_1, t0.user_id AS user_id_2 FROM image t0 WHERE t0.id = ? ["2"] []
     */
    public function getUserImage3(User $user, Image $image)
    {
        return $this->createUserImageResponse($user, $image);
    }

    /**
     * @Route("/33/users/{name}/images/{image}")
     * @Method("GET")
     * @ParamConverter("user", options={"mapping": {"name": "name"}})
     *
     * SELECT t0.id AS id_1, t0.name AS name_2, t0.address_id AS address_id_3, t0.image_id AS image_id_4 FROM user t0 WHERE t0.name = ? LIMIT 1 ["user_1"] []
     * SELECT t0.id AS id_1, t0.user_id AS user_id_2 FROM image t0 WHERE t0.id = ? ["2"] []
     */
    public function getUserImage4(User $user, Image $image)
    {
        return $this->createUserImageResponse($user, $image);
    }

    /**
     * @Route("/34/users/{name}/images/{image}")
     * @Method("GET")
     * @ParamConverter("user", options={"exclude": {"image"}})
     *
     * SELECT t0.id AS id_1, t0.name AS name_2, t0.address_id AS address_id_3, t0.image_id AS image_id_4 FROM user t0 WHERE t0.name = ? LIMIT 1 ["user_1"] []
     * SELECT t0.id AS id_1, t0.user_id AS user_id_2 FROM image t0 WHERE t0.id = ? ["2"] []
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
