<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Wisata extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
    }

    function index_get()
    { //get data wisata
        $id = $this->get('id');
        if ($id == '') {
            $Wisata = $this->db->get('wisata')->result();
        } else {
            $this->db->where('id', $id);
            $Wisata = $this->db->get('wisata')->result();
        }
        $this->response($Wisata, 200);
    }

    function index_post()
    { // post data wisata

        $data = array(
            'id'           => $this->post('id'),
            'name'          => $this->post('name'),
            'description'    => $this->post('description'),
            'image'    => $this->post('image'),
            'maps'    => $this->post('maps')
        );
        $insert = $this->db->insert('wisata', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_put()
    { // update data wisata
        $id = $this->put('id');
        $data = array(
            'id'            => $this->put('id'),
            'name'          => $this->put('name'),
            'description'   => $this->put('description'),
            'image'         => $this->put('image'),
            'maps'          => $this->put('maps')
        );
        $this->db->where('id', $id);
        $update = $this->db->update('wisata', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_delete()
    { // delete data wisata
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('wisata');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
