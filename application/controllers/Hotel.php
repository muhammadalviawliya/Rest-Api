<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Hotel extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
    }

    function index_get()
    { //get data transportasi
        $id = $this->get('id');
        if ($id == '') {
            $Wisata = $this->db->get('hotel')->result();
        } else {
            $this->db->where('id', $id);
            $Wisata = $this->db->get('hotel')->result();
        }
        $this->response($Wisata, 200);
    }

    function index_post()
    { // post data transportasi

        $data = array(
            'id'           => $this->post('id'),
            'name'          => $this->post('name'),
            'desc'    => $this->post('desc'),
            'harga'    => $this->post('harga'),
            'foto'    => $this->post('foto'),
            'telp'    => $this->post('telp'),
            'map'    => $this->post('map')
        );
        $insert = $this->db->insert('hotel', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_put()
    { // update data transportasi
        $id = $this->put('id');
        $data = array(
            'id'            => $this->put('id'),
            'name'          => $this->put('name'),
            'desc'   => $this->put('desc'),
            'harga'         => $this->put('harga'),
            'foto'         => $this->put('foto'),
            'telp'         => $this->put('telp'),
            'map'          => $this->put('map')
        );
        $this->db->where('id', $id);
        $update = $this->db->update('hotel', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_delete()
    { // delete data transportasi
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('hotel');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
