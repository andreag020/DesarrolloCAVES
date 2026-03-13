<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventario extends CI_Controller {

    /*public function __construct(){
        parent::__construct();
        $this->load->model('Producto_model');
    }

    public function index(){
        $data['productos'] = $this->Producto_model->obtener();
        $this->load->view('inventario_lista',$data);
    }

    public function crear(){

        if($this->input->post()){

            $data = array(
                'nombre'=>$this->input->post('nombre'),
                'descripcion'=>$this->input->post('descripcion'),
                'cantidad'=>$this->input->post('cantidad'),
                'precio'=>$this->input->post('precio')
            );

            $this->Producto_model->guardar($data);
            redirect('inventario');
        }

        $this->load->view('inventario_crear');
    }

    public function eliminar($id){
        $this->Producto_model->eliminar($id);
        redirect('inventario');
    }*/

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('url', 'form'));
        $this->load->model('Producto_model');
    }

    public function index(){
        $data['productos'] = $this->Producto_model->obtener();
        $this->load->view('inventario_vue',$data);
    }

    public function vue() {
        $this->load->view('inventario_vue');
    }

    public function apiProductos() {
        $productos = $this->Producto_model->obtener();

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($productos));
    }

    public function apiGuardar() {
        $input = json_decode($this->input->raw_input_stream, true);

        $data = array(
            'nombre' => $input['nombre'],
            'descripcion' => $input['descripcion'],
            'cantidad' => (int)$input['cantidad'],
            'precio' => (float)$input['precio']
        );

        $state = $this->Producto_model->guardar($data);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array(
                'success' => (bool)$state,
                'message' => $state ? 'Producto guardado correctamente' : 'No se pudo guardar'
            )));
    }

    public function apiActualizar($id) {
        $input = json_decode($this->input->raw_input_stream, true);

        $data = array(
            'nombre' => $input['nombre'],
            'descripcion' => $input['descripcion'],
            'cantidad' => (int)$input['cantidad'],
            'precio' => (float)$input['precio']
        );

        $state = $this->Producto_model->actualizar($id, $data);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array(
                'success' => (bool)$state,
                'message' => $state ? 'Producto actualizado correctamente' : 'No se pudo actualizar'
            )));
    }

    public function apiEliminar($id) {
        $state = $this->Producto_model->eliminar($id);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array(
                'success' => (bool)$state,
                'message' => $state ? 'Producto eliminado correctamente' : 'No se pudo eliminar'
            )));
    }

}