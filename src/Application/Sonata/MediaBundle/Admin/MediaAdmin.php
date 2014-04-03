<?php

/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Sonata\MediaBundle\Admin;

use Sonata\MediaBundle\Admin\ORM\MediaAdmin as Admin;
use Sonata\AdminBundle\Form\FormMapper;

class MediaAdmin extends Admin
{
    public function configureFormFields(FormMapper $formMapper)
    {
        self::configureFormFields($formMapper);

        $formMapper->add('summary');
    }
}
