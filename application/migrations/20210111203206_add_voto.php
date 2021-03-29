<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_voto extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(array(
            'vt_id' => array(
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ),
            'vt_fk_vereador' => array(
                'type'          => 'INT',
                'constraint'    => 11,
                'unsigned'      => TRUE,
                'null'          => TRUE,
            ),
            'vt_fk_camera' => array(
                'type'          => 'INT',
                'constraint'    => 11,
                'unsigned'      => TRUE,
                'null'          => TRUE,
            ),
            'vt_fk_sessao' => array(
                'type'          => 'INT',
                'constraint'    => 11,
                'unsigned'      => TRUE,
                'null'          => TRUE,
            ),
            'vt_fk_projeto' => array(
                'type'          => 'INT',
                'constraint'    => 11,
                'unsigned'      => TRUE,
                'null'          => TRUE,
            ),
            'vt_voto' => array(
                'type'              => 'ENUM("Sim","Não", "Abstinência")',
                'default'           => 'Abstinência',
                'null'              => FALSE,
            ),
            'vt_time_voto' => array(
                'type'              => 'TIME',
                'null'              => TRUE,
            ),
            'vt_liberar_voto' => array(
                'type'              => 'ENUM("0","1")',
                'default'           => '0',
                'null'              => FALSE,
            ),
            'vt_data_registro'  => array(
                'type'              => 'TIMESTAMP',
                'null'              => FALSE,
            ),
        ));
        $this->dbforge->add_key('vt_id', TRUE);
        $this->dbforge->create_table('tbl_voto_projeto_sessao');
        $this->db->query('ALTER TABLE `tbl_voto_projeto_sessao` ADD FOREIGN KEY(vt_fk_vereador) REFERENCES tbl_usuarios(us_id) ON DELETE NO ACTION ON UPDATE CASCADE;');
        $this->db->query('ALTER TABLE `tbl_voto_projeto_sessao` ADD FOREIGN KEY(vt_fk_camera) REFERENCES tbl_instituicao(ist_id) ON DELETE CASCADE ON UPDATE CASCADE;');
        $this->db->query('ALTER TABLE `tbl_voto_projeto_sessao` ADD FOREIGN KEY(vt_fk_sessao) REFERENCES tbl_sessao_camara(ss_id) ON DELETE CASCADE ON UPDATE CASCADE;');
        $this->db->query('ALTER TABLE `tbl_voto_projeto_sessao` ADD FOREIGN KEY(vt_fk_projeto) REFERENCES tbl_projetos(sess_id) ON DELETE CASCADE ON UPDATE CASCADE;');
    }

    public function down()
    {
        $this->dbforge->drop_table('tbl_voto_projeto_sessao');
    }
}
