<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_sessao extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(array(
            'ss_id' => array(
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ),
            'ss_fk_gestor' => array(
                'type'          => 'INT',
                'constraint'    => 11,
                'unsigned'      => TRUE,
                'null'          => TRUE,
            ),
            'ss_fk_camera' => array(
                'type'          => 'INT',
                'constraint'    => 11,
                'unsigned'      => TRUE,
                'null'          => TRUE,
            ),
            'ss_nome' => array(
                'type'          => 'VARCHAR',
                'constraint'    => '150',
                'unique'        => TRUE,
                'null'          => TRUE,
            ),
            'ss_numero' => array(
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'unique'        => TRUE,
                'null'          => TRUE,
            ),
            'ss_description' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'ss_key' => array(
                'type'          => 'VARCHAR',
                'constraint'    => '255',
                'unique'        => TRUE,
                'null'          => TRUE,
            ),
            'ss_status' => array(
                'type'              => 'ENUM("0","1")',
                'default'           => '0',
                'null'              => FALSE,
            ),
            'ss_data_sessao'  => array(
                'type'              => 'DATETIME',
                'null'              => TRUE,
            ),
            'ss_data_registro'  => array(
                'type'              => 'TIMESTAMP',
                'null'              => FALSE,
            ),
        ));
        $this->dbforge->add_key('ss_id', TRUE);
        $this->dbforge->create_table('tbl_sessao_camara');
        $this->db->query('ALTER TABLE `tbl_sessao_camara` ADD FOREIGN KEY(ss_fk_gestor) REFERENCES tbl_usuarios(us_id) ON DELETE NO ACTION ON UPDATE CASCADE;');
        $this->db->query('ALTER TABLE `tbl_sessao_camara` ADD FOREIGN KEY(ss_fk_camera) REFERENCES tbl_instituicao(ist_id) ON DELETE CASCADE ON UPDATE CASCADE;');
    }

    public function down()
    {
        $this->dbforge->drop_table('tbl_sessao_camara');
    }
}
