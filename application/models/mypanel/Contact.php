<?php
class Contact extends CI_Model
{

    public function get_contact($limit=3)
    {
        $this->db->from('contacts');
        $this->db->where('deleted', 0);
        $this->db->order_by("contact_id", "desc");
        $this->db->limit($limit);
        return $this->db->get()->result();
    }

    public function all_total_contact()
    {
        $this->db->from('contacts');
        $this->db->where('deleted', 0);
        return $this->db->count_all_results();
    }

    public function unread_total_contact()
    {
        $this->db->from('contacts');
        $this->db->where('read', 0);
        $this->db->where('deleted', 0);
        return $this->db->count_all_results();
    }

    
}

/* Fin del archivo Contact.php */
/* Ubicación: applications/models/Contact.php */?>