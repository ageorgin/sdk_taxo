<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 18/11/14
 * Time: 17:30
 */

namespace Ftven\SdkTaxonomy\Service\Content;

use Ftven\SdkTaxonomy\Entity\Content;

class MapperContent implements MapperContentInterface
{
    public function populateContent(Content $content, $data)
    {
        $content->setId($data['id']);
        $content->setUri($data['uri']);
        $content->setType($data['type']);
        $content->setProduct($data['product']);
        $content->setTags($data['tags']);
        $content->setAuthor($data['author']);
        $content->setActive($data['active']);
        $content->setDate(new \DateTime($data['date']));
    }

    public function getContents($data)
    {
        $contents = [];
        foreach ($data as $d) {
            $tmp = new Content();
            $this->populateContent($tmp, $d);
            $contents[] = $tmp;
            unset($tmp);
        }

        return $contents;
    }


}