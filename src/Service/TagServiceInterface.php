<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 17/11/14
 * Time: 11:08
 */

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
    public function createTag(Tag &$tag);
} 