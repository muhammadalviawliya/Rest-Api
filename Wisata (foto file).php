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
        $flag = $this->post('flag');

        if ($flag == "INSERT") {
            $config['upload_path'] = './assets/files/wisata/';
            $config['allowed_types'] = 'png|jpg';
            $config['max_size'] = '20480';
            $image = $_FILES['image']['name'];
            $path = "./assets/files/wisata/";
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image')) {
                $this->response(array('status' => 'fail', 502));
            } else {
                $data = array(
                    'id'            => $this->post('id'),
                    'name'          => $this->post('name'),
                    'description'   => $this->post('description'),
                    'image'         => $image,
                    'maps'          => $this->post('maps')
                );
                $this->db->insert('wisata', $data);
                $this->response($data, 200);
            }
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
