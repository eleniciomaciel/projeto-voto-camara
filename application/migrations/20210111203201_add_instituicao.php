<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_instituicao extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
            'ist_id' => array(
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => TRUE,
                'auto_increment'    => TRUE
            ),
            'ist_nome' => array(
                'type'              => 'VARCHAR',
                'constraint'        => '100',
                'unique'            => TRUE,
                'null'              => TRUE,
            ),
            'ist_telefone' => array(
                'type'              => 'VARCHAR',
                'constraint'        => '20',
                'unique'            => TRUE,
                'null'              => TRUE,
            ),
            'ist_cnpj' => array(
                'type'              => 'VARCHAR',
                'constraint'        => '100',
                'unique'            => TRUE,
                'null'              => TRUE,
            ),
            'ist_data_create' => array(
                'type'              => 'TIMESTAMP',
                'null'              => FALSE,
            ),
        ));
        $this->dbforge->add_key('ist_id', TRUE);
        $this->dbforge->create_table('tbl_instituicao');
    }

    public function down()
    {
        $this->dbforge->drop_table('tbl_instituicao');
    }
}
