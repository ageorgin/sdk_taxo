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
     * @param int $page
     * @param int $limit
     * @return mixed
     */
    public function autocomplete($string = null, $sort = null, $page = 1, $limit = 1000);

    /**
     * @param Tag $tag
     * @return mixed
     */
    public function createTag(Tag &$tag);
} 