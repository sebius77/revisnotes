<?php

namespace RN\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class RNUserBundle extends Bundle
{
    public function getPArent()
    {
        return 'FOSUserBundle';
    }
}
