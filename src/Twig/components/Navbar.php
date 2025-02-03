<?php

declare(strict_types=1);

namespace App\Twig\Components;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Navbar', template: 'components/Navbar.html.twig')]
final class Navbar extends BaseController
{
}
