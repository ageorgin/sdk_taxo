<?php

/**
 * Class Content
 */
class Content
{

  private $id = null;
  private $uri = null;
  private $type = null;
  private $tags = array();
  private $author = null;
  private $product = null;
  private $fromSynonym = false;
  private $fromChild = false;

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
   * Gets the value of uri.
   *
   * @return mixed
   */
  public function getUri() {
    return $this->uri;
  }

  /**
   * Sets the value of uri.
   *
   * @param mixed $uri the uri
   *
   * @return self
   */
  public function setUri($uri) {
    $this->uri = $uri;

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
   * Gets the value of tags.
   *
   * @return mixed
   */
  public function getTags() {
    return $this->tags;
  }

  /**
   * Sets the value of tags.
   *
   * @param mixed $tags the tags
   *
   * @return self
   */
  public function setTags($tags) {
    $this->tags = $tags;

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
   * Gets the value of fromSynonym.
   *
   * @return mixed
   */
  public function getFromSynonym() {
    return $this->fromSynonym;
  }

  /**
   * Sets the value of fromSynonym.
   *
   * @param mixed $fromSynonym the from synonym
   *
   * @return self
   */
  public function setFromSynonym($fromSynonym) {
    $this->fromSynonym = $fromSynonym;

    return $this;
  }

  /**
   * Gets the value of fromChild.
   *
   * @return mixed
   */
  public function getFromChild() {
    return $this->fromChild;
  }

  /**
   * Sets the value of fromChild.
   *
   * @param mixed $fromChild the from child
   *
   * @return self
   */
  public function setFromChild($fromChild) {
    $this->fromChild = $fromChild;

    return $this;
  }

  public function contentToArray(){
    return array(
      "uri" => $this->uri,
      "type" => $this->type,
      "tags" => $this->tags,
      "author" => $this->author,
      );
  }
}