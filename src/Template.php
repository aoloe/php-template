<?php

/**
 * Object oriented proxy to the gitapi library to be used in Slim
 */

namespace Aoloe;

class Template {
    var $vars;

    /**
     * Constructor
     *
     * @param $file string the file name you want to load
     */
    function Template($file = null) {
        $this->file = $file;
    }

    /**
     * Set the template file
     */
    function set_template($file) {
        $this->file = $file;
    }

    /**
     * Clear the templates variables
     */
    function clear() {
        unset($this->vars);
    }

    /**
     * Set a template variable.
     */
    function set($name, $value) {
        $this->vars[$name] = $value;
    }

    /**
     * Open, parse, and return the template file.
     *
     * @param $file string the template file name
     */
    function fetch($file = null) {
        if(!$file) $file = $this->file;

        if (!empty($this->vars)) {
            extract($this->vars);      // Extract the vars to local namespace
        }
        ob_start();                    // Start output buffering
        include($file);                // Include the file
        $contents = ob_get_contents(); // Get the contents of the buffer
        ob_end_clean();                // End buffering and discard
        return $contents;              // Return the contents
    }
}
