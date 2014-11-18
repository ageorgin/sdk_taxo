<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 18/11/14
 * Time: 11:06
 */

class MapperTag implements MapperTagInterface
{
    public function getTags($data)
    {
        $tags = [];
        foreach($data as $d) {
            $tmp = new Tag($d['id']);
            $tmp->setAuthor($d['author']);
            $tmp->setComment($d['comment']);
            $tmp->setLabel($d['label']);
            $tmp->setParents($d['parent_tags']);
            $tmp->setPreferredTag($d['preferred_tag']);
            $tmp->setProduct($d['product']);
            $tmp->setStatus($d['status']);
            $tmp->setType($d['type']);
            $tags[] = $tmp;
            unset($tmp);
        }

        return $tags;
    }
} 