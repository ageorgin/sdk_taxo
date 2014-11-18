<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 18/11/14
 * Time: 10:00
 */

class TagService implements TagServiceInterface
{
    /**
     * @var AutocompleteTagInterface
     */
    private $autocompleteSvc = null;

    /**
     * @param null $string
     * @param null $sort
     * @return mixed
     */
    public function autocomplete($string = null, $sort = null)
    {
        return $this->getAutocompleteSvc()->execute($string, $sort);
    }

    /**
     * @param Tag $tag
     * @return mixed
     */
    public function createTag(Tag &$tag)
    {
        // TODO: Implement createTag() method.
    }

    /**
     * @param \AutocompleteTagInterface $autocompleteSvc
     */
    public function setAutocompleteSvc($autocompleteSvc)
    {
        $this->autocompleteSvc = $autocompleteSvc;
    }

    /**
     * @return \AutocompleteTagInterface
     */
    public function getAutocompleteSvc()
    {
        if (null === $this->autocompleteSvc) {
            $this->autocompleteSvc = new AutocompleteTag();
        }
        return $this->autocompleteSvc;
    }
} 