<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 18/11/14
 * Time: 16:01
 */

namespace Ftven\SdkTaxonomy\Service\Tag;

use Ftven\SdkTaxonomy\Entity\Tag;

class SerializerTag implements SerializerTagInterface
{
    /**
     * @param Tag $tag
     * @return array
     */
    public function getCreateSerialization(Tag $tag)
    {
        return [
            'label' => $tag->getLabel(),
            'author' => $tag->getAuthor()
        ];
    }
} 