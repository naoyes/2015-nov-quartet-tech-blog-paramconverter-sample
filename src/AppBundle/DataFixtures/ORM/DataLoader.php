<?php

namespace AppBundle\DataFixtures\ORM;

use Hautelook\AliceBundle\Doctrine\DataFixtures\AbstractLoader;

class DataLoader extends AbstractLoader
{
    /**
     * {@inheritDoc}
     */
    public function getFixtures()
    {
        return [
            '@AppBundle/DataFixtures/ORM/fixtures.yml',
        ];
    }
}
