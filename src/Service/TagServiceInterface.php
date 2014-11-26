<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 17/11/14
 * Time: 11:08
 */

namespace Ftven\SdkTaxonomy\Service;

use Ftven\SdkTaxonomy\Entity\Tag;

interface TagServiceInterface
{
    /**
     * @param null $string
     * @param null $sort
     * @return mixed
     */
    public function autocomplete($string = null, $sort = null);

    /**
     * @param Tag $tag
     * @return mixed
     */
    public function createTag(Tag $tag);

    /**
     * @param $id
     * @return mixed
     */
    public function getTag($id);
} 