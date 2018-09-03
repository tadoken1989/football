<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_leagues extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'status' => array(
                'type' => 'TINYINT',
                'default' => 1,
            ),
        ));

        $this->dbforge->create_table('leagues');
    }

    public function down()
    {
        $this->dbforge->drop_table('leagues');
    }
}