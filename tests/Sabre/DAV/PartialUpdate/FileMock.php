<?php

namespace Sabre\DAV\PartialUpdate;

use
    Sabre\DAV,
    Sabre\DAV\Request;

class FileMock implements IFile {

    protected $data = '';

    function put($str) {

        if (is_resource($str)) {
            $str = stream_get_contents($str);
        }
        $this->data = $str;

    }

    function putRange($str,$start) {

        if (is_resource($str)) {
            $str = stream_get_contents($str);
        }
        $this->data = substr($this->data, 0, $start) . $str . substr($this->data, $start + strlen($str));



    }

    /**
     * Returns the data
     *
     * This method may either return a string or a readable stream resource
     *
     * @param Request\Get $request
     * @return mixed
     */
    public function get(Request\Get $request) {

        return $this->data;

    }

    function getContentType() {

        return 'text/plain';

    }

    function getSize() {

        return strlen($this->data);

    }

    function getETag() {

        return '"' . $this->data . '"';

    }

    function delete() {

        throw new DAV\Exception\MethodNotAllowed();

    }

    function setName($name) {

        throw new DAV\Exception\MethodNotAllowed();

    }

    function getName() {

        return 'partial';

    }

    function getLastModified() {

        return null;

    }


}
