<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 18/11/14
 * Time: 17:29
 */

interface MapperContentInterface
{
    public function populateContent(Content $content, $data);

    public function getContents($data);
} 