<?php

namespace Gebs\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class GebsUserBundle extends Bundle
{
    public function getPArent()
    {
        return 'FOSUserBundle';
    }
}
