<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_solicitavoto extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(array(
            'sv_id' => array(
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ),
            'sv_fk_vereador' => array(
                'type'          => 'INT',
                'constraint'    => 11,
                'unsigned'      => TRUE,
                'null'          => TRUE,
            ),
            'sv_fk_camera' => array(
                'type'          => 'INT',
                'constraint'    => 11,
                'unsigned'      => TRUE,
                'null'          => TRUE,
            ),
            'sv_status_solicita' => array(
                'type'              => 'ENUM("0","1")',
                'default'           => '0',
                'null'              => FALSE,
            ),
            'sv_data_solicita'  => array(
                'type'              => 'TIMESTAMP',
                'null'              => FALSE,
            ),
        ));
        $this->dbforge->add_key('sv_id', TRUE);
        $this->dbforge->create_table('tbl_solicita_participacao');
        $this->db->query('ALTER TABLE `tbl_solicita_participacao` ADD FOREIGN KEY(sv_fk_vereador) REFERENCES tbl_usuarios(us_id) ON DELETE NO ACTION ON UPDATE CASCADE;');
        $this->db->query('ALTER TABLE `tbl_solicita_participacao` ADD FOREIGN KEY(sv_fk_camera) REFERENCES tbl_instituicao(ist_id) ON DELETE CASCADE ON UPDATE CASCADE;');
    }

    public function down()
    {
        $this->dbforge->drop_table('tbl_solicita_participacao');
    }
}
