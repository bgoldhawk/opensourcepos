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
				'costraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'name' => [
				'type' => 'nvarchar',
				'constraint' => '255',
			],
			'status' => [
				'type' => 'tinyint',
				'constraint' => '1'
			],
		];
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('tab_id', TRUE);
		$this->dbforge->create_table('tabs', TRUE);

		$this->modify_sales_table();

		$this->db->insert('app_config', array( 'key' => 'enable_tabs', 'value' => TRUE));
	
	}

	public function down()
	{
		$this->db->query("delete from ospos_app_config where key = 'enable_tabs'");
		$this->dbforge->drop_table('tabs', TRUE);
	}

	private function modify_sales_table(){

		$this->dbforge->add_column('sales', array('tab_id' => array('type' => 'int','costraint' => 11, 'unsigned' => TRUE)));

		$add_new_tab_index = "ALTER TABLE `ospos`.`ospos_sales` ADD INDEX `fk_ospos_sales_tab_idx` (`tab_id` ASC) VISIBLE";
		$this->db->simple_query($add_new_tab_index);

		$add_tabs_fk = 'ALTER TABLE `ospos`.`ospos_sales` ADD CONSTRAINT `fk_ospos_sales_tab`  FOREIGN KEY (`tab_id`)  REFERENCES `ospos`.`ospos_tabs` (`tab_id`)  ON DELETE SET NULL  ON UPDATE NO ACTION';
		$this->db->simple_query($add_tabs_fk);
	}
}
?>
