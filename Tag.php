<?php

/**
 * Class Tag
 */
class Tag {

  private $id = null;
  private $status = null;
  private $type = null;
  private $label = null;
  private $comment = null;
  private $author = null;
  private $product = null;
  private $parents = array();
  private $preferredTag = null;

  public function __construct($id = null) {
    $this->id = $id;
  }

  public function getId() {
    return $this->id;
  }

  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  public function getStatus() {
    return $this->status;
  }

  public function setStatus($status) {
    $this->status = $status;
    return $this;
  }

  public function getType() {
    return $this->type;
  }

  public function setType($type) {
    $this->type = $type;
    return $this;
  }

  public function getLabel() {
    return $this->label;
  }

  public function setLabel($label) {
    $this->label = $label;
    return $this;
  }

  public function getComment() {
    return $this->comment;
  }

  public function setComment($comment) {
    $this->comment = $comment;
    return $this;
  }

  public function getAuthor() {
    return $this->author;
  }

  public function setAuthor($author) {
    $this->author = $author;
    return $this;
  }

  public function getProduct() {
    return $this->product;
  }

  public function setProduct($product) {
    $this->product = $product;
    return $this;
  }

  public function getParents() {
    return $this->parents;
  }

  public function addParent($parent) {
    $this->parents[] = $parent;
    return $this;
  }

  public function setParents($parents) {
    $this->parents = $parents;
    return $this;
  }

  public function getPreferredTag() {
    return $this->preferredTag;
  }

  public function setPreferredTag($preferredTag) {
    $this->preferredTag = $preferredTag;
    return $this;
  }

}
