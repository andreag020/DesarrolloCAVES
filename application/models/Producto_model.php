<?php
class Producto_model extends CI_Model{

    private $tabla="productos";

    public function obtener(){
        return $this->db->get($this->tabla)->result();
    }

    public function guardar($data){
        return $this->db->insert($this->tabla,$data);
    }

    public function actualizar($id, $data){
    $this->db->where('id', $id);
    return $this->db->update($this->tabla, $data);
}

    public function eliminar($id){
        $this->db->where('id',$id);
        return $this->db->delete($this->tabla);
    }

}
