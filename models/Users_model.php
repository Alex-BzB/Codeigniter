<?
class Users_model extends CI_Model{

  public function __construct(){
    $this->load->database();
  }

  public function getUsers($name = FALSE){
    if($name === FALSE){
      $query = $this->db->get('users');
      return $query->result_array();
    }
    $query = $this->db->get_where('users', array('name' => $name));
    return $query->row_array();
  }
}
