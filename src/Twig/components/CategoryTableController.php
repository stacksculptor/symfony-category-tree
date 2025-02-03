<?php

declare(strict_types=1);

namespace App\Twig\Components;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use App\Entity\Category;

#[AsTwigComponent(name: 'CategoryTable', template: 'components/CategoryTable.html.twig')]
final class CategoryTable extends AbstractController
{
    public ?Category $child = null;
}
