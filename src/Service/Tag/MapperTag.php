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
            $tmp = new Tag();
            $this->populateTag($tmp, $d);
            $tags[] = $tmp;
            unset($tmp);
        }

        return $tags;
    }

    public function populateTag(Tag $tag, $data)
    {
        $tag->setId($data['id']);
        $tag->setAuthor($data['author']);
        $tag->setComment($data['comment']);
        $tag->setLabel($data['label']);
        $tag->setParents($data['parent_tags']);
        $tag->setPreferredTag($data['preferred_tag']);
        $tag->setProduct($data['product']);
        $tag->setStatus($data['status']);
        $tag->setType($data['type']);
    }


} 