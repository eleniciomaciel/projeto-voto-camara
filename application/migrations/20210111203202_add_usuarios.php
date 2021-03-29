<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_usuarios extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
            'us_id' => array(
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => TRUE,
                'auto_increment'    => TRUE
            ),
            'us_fk_instituicao' => array(
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => TRUE,
            ),
            'us_nome' => array(
                'type'              => 'VARCHAR',
                'constraint'        => '100',
                'unique'            => TRUE,
                'null'              => TRUE,
            ),
            'us_email' => array(
                'type'              => 'VARCHAR',
                'constraint'        => '100',
                'unique'            => TRUE,
                'null'              => TRUE,
            ),
            'us_senha' => array(
                'type'              => 'VARCHAR',
                'constraint'        => '255',
                'null'              => TRUE,
            ),
            'us_telefone' => array(
                'type'              => 'VARCHAR',
                'constraint'        => '20',
                'unique'            => TRUE,
                'null'              => TRUE,
            ),
            'us_status' => array(
                'type'              => 'ENUM("0","1")',
                'default'           => '0',
                'null'              => FALSE,
            ),
            'us_nivel' => array(
                'type'              => 'ENUM("0", "Gestor","Admin","Vereador")',
                'default'           => '0',
                'null'              => FALSE,
            ),
            'us_apelido' => array(
                'type'              => 'VARCHAR',
                'constraint'        => '60',
                'unique'            => TRUE,
                'null'              => TRUE,
            ),
            'us_partido' => array(
                'type'              => 'VARCHAR',
                'constraint'        => '20',
                'null'              => TRUE,
            ),
            'us_cargo' => array(
                'type'              => 'VARCHAR',
                'constraint'        => '60',
                'null'              => TRUE,
            ),
            'us_data_create' => array(
                'type'              => 'TIMESTAMP',
                'null'              => FALSE,
            ),
        ));
        $this->dbforge->add_key('us_id', TRUE);
        $this->dbforge->create_table('tbl_usuarios');
        $this->db->query('ALTER TABLE `tbl_usuarios` ADD FOREIGN KEY(us_fk_instituicao) REFERENCES tbl_instituicao(ist_id) ON DELETE CASCADE ON UPDATE CASCADE;');
    }

    public function down()
    {
        $this->dbforge->drop_table('tbl_usuarios');
    }
}
