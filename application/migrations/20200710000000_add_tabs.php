<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_add_tabs extends CI_Migration
{
	public function __construct()
	{
		parent::__construct();
		$this->load->dbforge();
		
	}

	public function up()
	{
		
		$fields = [
			'tab_id' => [
				'type' => 'int', 
				'costraint' => 9,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'name' => [
				'type' => 'nvarchar',
				'constraint' => '255',
			],
		];
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('tab_id', TRUE);
		$this->dbforge->create_table('tabs', TRUE);

		$this->db->insert('app_config', array( 'key' => 'enable_tabs', 'value' => TRUE));
	
	}

	public function down()
	{
		$this->db->query("delete from ospos_app_config where key = 'enable_tabs'");
		$this->dbforge->drop_table('tabs', TRUE);
	}
}
?>
