<?php

/**
 * Programme representation
 */
class Programme extends CI_Model {
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $shortSynopsis;

    /**
     * @var string
     */
    private $imageUri;

    /**
     * @var string
     */
    private $uri;

    /**
     * @return string Programme ID
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return string Programme title
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @return string Programme short synopsis
     */
    public function getShortSynopsis() {
        return $this->shortSynopsis;
    }

    /**
     * @return string Programme image URI
     */
    public function getImage() {
        return $this->imageUri;
    }

    /**
     * @return string Programme URI
     */
    public function getUri() {
        return $this->uri;
    }

    /**
     * Magic setter. Will set private variables by their set{Variable} method.
     * If method unavailable will set the variable directly.
     * 
     * @param string $name  Variable name
     * @param mixed  $value Variable value
     */
    public function __set($name, $value) {
        $methodName = 'set' . ucfirst($name);
        if (method_exists($this, $methodName)) {
            $this->$methodName($value);
        } else {
            $this->$name = $value;
        }
    }
}