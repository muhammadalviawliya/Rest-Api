<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Berita extends REST_Controller
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
            $Wisata = $this->db->get('berita')->result();
        } else {
            $this->db->where('id', $id);
            $Wisata = $this->db->get('berita')->result();
        }
        $this->response($Wisata, 200);
    }

    function index_post()
    { // post data transportasi

        $data = array(
            'id'           => $this->post('id'),
            'judul'          => $this->post('judul'),
            'isi'    => $this->post('isi'),
            'tanggal'    => $this->post('tanggal'),
            'gambar'    => $this->post('gambar')
        );
        $insert = $this->db->insert('berita', $data);
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
            'judul'          => $this->put('judul'),
            'isi'   => $this->put('isi'),
            'tanggal'         => $this->put('tanggal'),
            'gambar'         => $this->put('gambar')
        );
        $this->db->where('id', $id);
        $update = $this->db->update('berita', $data);
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
        $delete = $this->db->delete('berita');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
