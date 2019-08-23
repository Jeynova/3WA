<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class HtmlExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('figure', [$this, 'figureFilter']),new TwigFilter('wiki', [$this, 'wikiFilter'])
        ];
    }

    public function figureFilter($image, $description)
    {

        $link="<img src='".$image."''><br><p>".$description."</p>";

        return $link;
    }
    public function wikiFilter($nom,$desc,$lien)
    {
        $link="<tr><th>Nom : </th><td> ".$nom."</td></tr><tr><th>Description : </th><td> ".$desc."</td></tr><tr><th>Lien : </th><td><a href='".$lien."'>".$lien."</a></td></tr>";


        return $link;
    }

}
