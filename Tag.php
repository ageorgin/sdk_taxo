<?php

/**
 * Class Tag
 */
class Tag
{

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

  /**
   * Gets the value of id.
   *
   * @return mixed
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Sets the value of id.
   *
   * @param mixed $id the id
   *
   * @return self
   */
  public function setId($id) {
    $this->id = $id;

    return $this;
  }

  /**
   * Gets the value of status.
   *
   * @return mixed
   */
  public function getStatus() {
    return $this->status;
  }

  /**
   * Sets the value of status.
   *
   * @param mixed $status the status
   *
   * @return self
   */
  public function setStatus($status) {
    $this->status = $status;

    return $this;
  }

  /**
   * Gets the value of type.
   *
   * @return mixed
   */
  public function getType() {
    return $this->type;
  }

  /**
   * Sets the value of type.
   *
   * @param mixed $type the type
   *
   * @return self
   */
  public function setType($type) {
    $this->type = $type;

    return $this;
  }

  /**
   * Gets the value of label.
   *
   * @return mixed
   */
  public function getLabel() {
    return $this->label;
  }

  /**
   * Sets the value of label.
   *
   * @param mixed $label the label
   *
   * @return self
   */
  public function setLabel($label) {
    $this->label = $label;

    return $this;
  }

  /**
   * Gets the value of comment.
   *
   * @return mixed
   */
  public function getComment() {
    return $this->comment;
  }

  /**
   * Sets the value of comment.
   *
   * @param mixed $comment the comment
   *
   * @return self
   */
  public function setComment($comment) {
    $this->comment = $comment;

    return $this;
  }

  /**
   * Gets the value of author.
   *
   * @return mixed
   */
  public function getAuthor() {
    return $this->author;
  }

  /**
   * Sets the value of author.
   *
   * @param mixed $author the author
   *
   * @return self
   */
  public function setAuthor($author) {
    $this->author = $author;

    return $this;
  }

  /**
   * Gets the value of product.
   *
   * @return mixed
   */
  public function getProduct() {
    return $this->product;
  }

  /**
   * Sets the value of product.
   *
   * @param mixed $product the product
   *
   * @return self
   */
  public function setProduct($product) {
    $this->product = $product;

    return $this;
  }

  /**
   * Gets the value of parents.
   *
   * @return mixed
   */
  public function getParents() {
    return $this->parents;
  }

  /**
   * Sets the value of parents.
   *
   * @param mixed $parents the parents
   *
   * @return self
   */
  public function setParents($parents) {
    $this->parents = $parents;

    return $this;
  }

  /**
   * Gets the value of preferredTag.
   *
   * @return mixed
   */
  public function getPreferredTag() {
    return $this->preferredTag;
  }

  /**
   * Sets the value of preferredTag.
   *
   * @param mixed $preferredTag the preferred tag
   *
   * @return self
   */
  public function setPreferredTag($preferredTag) {
    $this->preferredTag = $preferredTag;

    return $this;
  }

  public function tagToArray(){
    return array(
      "label" => $this->label,
      "author" => $this->author,
      );
  }
}
