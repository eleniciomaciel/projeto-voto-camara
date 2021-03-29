<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_projetos extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(array(
            'sess_id' => array(
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ),
            'sess_sessao' => array(
                'type'          => 'VARCHAR',
                'constraint'    => '100',
                'unique'        => TRUE,
                'null'          => TRUE,
            ),
            'sess_numero' => array(
                'type'          => 'VARCHAR',
                'constraint'    => '30',
                'unique'        => TRUE,
                'null'          => TRUE,
            ),
            'sess_titulo_projeto' => array(
                'type'          => 'VARCHAR',
                'constraint'    => '100',
                'unique'        => TRUE,
                'null'          => TRUE,
            ),
            'sess_numero_projeto' => array(
                'type'          => 'VARCHAR',
                'constraint'    => '30',
                'unique'        => TRUE,
                'null'          => TRUE,
            ),
            'us_fk_autor' => array(
                'type'          => 'INT',
                'constraint'    => 11,
                'unsigned'      => TRUE,
                'null'          => TRUE,
            ),
            'us_fk_gestor' => array(
                'type'          => 'INT',
                'constraint'    => 11,
                'unsigned'      => TRUE,
                'null'          => TRUE,
            ),
            'us_fk_camara' => array(
                'type'          => 'INT',
                'constraint'    => 11,
                'unsigned'      => TRUE,
                'null'          => TRUE,
            ),
            'sess_data_projeto'  => array(
                'type'          => 'DATETIME',
                'null'          => TRUE,
            ),
            'sess_status' => array(
                'type'              => 'ENUM("0","1")',
                'default'           => '0',
                'null'              => FALSE,
            ),
            'sess_description' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
        ));
        $this->dbforge->add_key('sess_id', TRUE);
        $this->dbforge->create_table('tbl_projetos');
        $this->db->query('ALTER TABLE `tbl_projetos` ADD FOREIGN KEY(us_fk_autor) REFERENCES tbl_usuarios(us_id) ON DELETE NO ACTION ON UPDATE CASCADE;');
        $this->db->query('ALTER TABLE `tbl_projetos` ADD FOREIGN KEY(us_fk_gestor) REFERENCES tbl_usuarios(us_id) ON DELETE NO ACTION ON UPDATE CASCADE;');
        $this->db->query('ALTER TABLE `tbl_projetos` ADD FOREIGN KEY(us_fk_camara) REFERENCES tbl_instituicao(ist_id) ON DELETE CASCADE ON UPDATE CASCADE;');
    }

    public function down()
    {
        $this->dbforge->drop_table('tbl_projetos');
    }
}
