<?php
class Module extends CI_Model 
{
    function __construct()
    {
        parent::__construct();
    }
	
	public function get_module_name($module_id)
	{
		$query = $this->db->get_where('modules', array('module_id' => $module_id), 1);
		
		if($query->num_rows() == 1)
		{
			$row = $query->row();

			return $this->lang->line($row->name_lang_key);
		}
		
		return $this->lang->line('error_unknown');
	}
	
	public function get_module_desc($module_id)
	{
		$query = $this->db->get_where('modules', array('module_id' => $module_id), 1);

		if($query->num_rows() == 1)
		{
			$row = $query->row();

			return $this->lang->line($row->desc_lang_key);
		}
	
		return $this->lang->line('error_unknown');	
	}
	
	public function get_all_permissions()
	{
		$this->db->from('permissions');
		return $this->db->get();
	}
	
	public function get_all_subpermissions()
	{
		$this->db->from('permissions');
		$this->db->join('modules', 'modules.module_id = permissions.module_id');
		$this->db->where('modules.status', 0);
		// can't quote the parameters correctly when using different operators..
		$this->db->where($this->db->dbprefix('modules') . '.module_id!=', 'permission_id', FALSE);

		return $this->db->get();
	}
	
	public function get_all_modules()
	{
		$this->db->from('modules');
		$this->db->where('status', 0);
		$this->db->order_by('sort', 'asc');

		return $this->db->get();		
	}
	
	public function get_allowed_modules($person_id)
	{
		$this->db->select('m.module_id,m.module_parent,m.name_lang_key,m.module_icon');
		$this->db->from('modules as m');
		$this->db->join('permissions as p', 'p.permission_id = m.module_id');
		$this->db->join('grants as g', 'p.permission_id = g.permission_id');
		$this->db->where('person_id', $person_id);
		$this->db->where('m.status', 0);
		$this->db->order_by('m.sort', 'asc');

		return $this->db->get();		
	}

	public function get_module($module_id)
	{
		$this->db->from('modules as m');
		$this->db->join('permissions as p', 'p.permission_id = m.module_id');
		$this->db->join('grants as g', 'p.permission_id = g.permission_id');
		$this->db->where('m.module_parent', $module_id);
		$this->db->where('m.status', 0);
		$this->db->limit(1);
		$this->db->order_by('m.sort', 'asc');

		return $this->db->get()->row()->module_id;		
	}
}
?>
