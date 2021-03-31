<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/**login */
$route['acesso-restrito-usuarios'] = 'welcome/login';
$route['logout'] = 'welcome/logout';
/**rota admin */
$route['painel-master'] = 'master/PainelMasterController/panelMaster';
$route['adiciona-instituicao'] = 'master/PainelMasterController/addInstituicao';
$route['lista-instituicoes'] = 'master/PainelMasterController/get_INstituicoes';
$route['lista-a-instituicao/(:num)'] = 'master/PainelMasterController/listAIntituicao/$1';
$route['altera-instituicao'] = 'master/PainelMasterController/alteraDadosInstituicao';
$route['enviar-logo'] = 'master/PainelMasterController/logoInstituicao';
$route['select-instituicao'] = 'master/PainelMasterController/selectInstituicao';
$route['save-user-instituicao'] = 'master/PainelMasterController/saveUserInstituicao';
$route['get-list-usuario'] = 'master/PainelMasterController/getListusuarios';
$route['lista-um-usuarios/(:num)'] = 'master/PainelMasterController/listaumsuarios/$1';
$route['update-user-instituicao']  = 'master/PainelMasterController/updateUserInstituicao';
$route['altera-status-usuario'] = 'master/PainelMasterController/alteraStatusUsuario';
$route['deleta-usuario-instituicao/(:num)'] = 'master/PainelMasterController/deleteUsuarioInstituicao/$1';
$route['atualiza-dados-perfil-pessoal/(:num)'] = 'master/PainelMasterController/atualizacaoPerfilPessoal/$1';
$route['new-photo-perfil/(:num)'] = 'master/PainelMasterController/atualizacaoPhotoPerfilPessoal/$1';

/**ROTA DOS GESTOR TIPO SECRETARIA */
$route['atualiza-dados-perfil-pessoal-gestor/(:num)'] = 'gestor/PerfilController/alteraPerfil/$1';
$route['new-photo-gestor-perfil/(:num)'] = 'gestor/PerfilController/alteraPhotoGestorPerfil/$1';
$route['select-vereador-do-projeto/(:num)'] = 'gestor/ProjetoGestorController/selectVereadorDoProjeto/$1';
$route['add-session-gestor'] = 'gestor/ProjetoGestorController/insertSession';
$route['adiciona-verador'] = 'gestor/VereadorGestorController/addVerador';
$route['lista-vereadores-instituicao/(:num)'] = 'gestor/VereadorGestorController/get_listVereadoresInstituicao/$1';
$route['lista-vereadores-instituicao_desativos/(:num)'] = 'gestor/VereadorGestorController/get_listVereadoresInstituicaoDesativados/$1';
$route['lista-dados-verador/(:any)'] = 'gestor/VereadorGestorController/get_listDadosVer/$1';
$route['altera-verador'] = 'gestor/VereadorGestorController/alteraDadosDoVerador';
$route['inserir-imagem-vereador'] = 'gestor/VereadorGestorController/newFileVereador';
$route['altera-status-vereador'] = 'gestor/VereadorGestorController/statusVreador';
$route['lista-sessao-all/(:num)'] = 'gestor/ProjetoGestorController/get_listVereadoresGestor/$1';
$route['lista-projetos-one/(:num)'] = 'gestor/ProjetoGestorController/get_listProjetosGestor/$1';
$route['altera-projeto-session-gestor'] = 'gestor/ProjetoGestorController/alteraDadosProjetoGestor';
$route['insere-documento-pdf-projeto'] = 'gestor/ProjetoGestorController/addPdfFile';
$route['solicita-status-solicitacao-dia_gestor/(:num)'] = 'gestor/VereadorGestorController/visualizaSocitacaoVereadores/$1';
$route['recusa-solicitacao-gestor/(:num)'] = 'gestor/VereadorGestorController/recusaSolicitacaoVereador/$1';
$route['aceitacao-solicitacao-gestor/(:num)'] = 'gestor/VereadorGestorController/aceitaSolicitacaoVereador/$1';
$route['list-veradores-aceito-sessao-do-dia/(:num)'] = 'gestor/VereadorGestorController/listaVereadoresPresentesAceitoVotacao/$1';
$route['altera-status-projeto'] = 'gestor/ProjetoGestorController/alteraStatusProject';
$route['projeto-concluido-gestor/(:num)'] = 'gestor/ProjetoGestorController/votoConcluidoIndividual/$1';
$route['deleta-projeto-camara/(:num)'] = 'gestor/ProjetoGestorController/deleteProjetoCamara/$1';
/**rota para gestor realizar o voto */
$route['seleciona-vereador-voto-mesa/(:num)'] = 'gestor/VotarParaVeradorController/listaDadosVeradorVoto/$1';
$route['votacao-mesa-sim'] = 'gestor/VotarParaVeradorController/mesaVotoSim';
$route['votacao-mesa-nao'] = 'gestor/VotarParaVeradorController/mesaVotoNao';
/**voto individual */
$route['votacao-mesa-sim-individual']= 'gestor/VotarParaVeradorController/mesaVotoSimIndivisual';
$route['votacao-mesa-nao-individual']= 'gestor/VotarParaVeradorController/mesaVotoNaoIndivisual';

/**ROTA GESTOR SESSÃO NOVAS */
$route['cria-nova-sessao'] = 'gestor/SessaoGestorCamara/addNewSessao';
$route['retorno-da-sessao-da-camara/(:num)'] = 'gestor/SessaoGestorCamara/get_AllSessao/$1';
$route['eye-view-session/(:num)'] = 'gestor/SessaoGestorCamara/get_listOneSessao/$1';
$route['altera-nova-sessao'] = 'gestor/SessaoGestorCamara/alteraDadosSessaoOne';
$route['select-sessao/(:num)'] = 'gestor/SessaoGestorCamara/selectDadosSessaoCamara/$1';
$route['altera-dados-status-sessao'] = 'gestor/SessaoGestorCamara/alteraDadosSessOne';
$route['deleta-sessao/(:num)'] = 'gestor/SessaoGestorCamara/deletaSessaoCamara/$1';
/**get dados usuário pedido */
$route['aceita-pedido-e-adiciona-sessao-ao-vereador/(:num)'] = 'gestor/SessaoGestorCamara/getListSessaoActive/$1';
$route['select-sessao-pedido-aceita/(:num)'] = 'gestor/SessaoGestorCamara/selectDadosSessaoCamaraPedido/$1';

/**deleta sessao */
$route['deleta-sessao-camara/(:num)'] = 'gestor/SessaoGestorCamara/deleteSessaoCamara/$1';
/**ENVIA TEMPO VOTO*/
$route['adiciona-voto-tempo-vereador-gestor'] = 'gestor/VereadorGestorController/timeVoto';
$route['add-votacao-em-grupo'] = 'gestor/VereadorGestorController/timeVotoGrupo';
$route['start-voto-operador'] = 'gestor/startVotoController/start';


/**calendário de atividades da camara */
$route['agenda-camara/(:num)'] = 'gestor/AgendaVotacaoController/verGenda/$1';
$route['alterar-data-do-evento'] = 'gestor/AgendaVotacaoController/alterarDataEvento';
$route['visualiza-dados-do-evento-calendario/(:num)']= 'gestor/AgendaVotacaoController/visualizaAgendaModal/$1';


/**panel vereador */
$route['solicita-participacao-votacao/(:num)'] = 'vereador/SolicitacaoController/solicitaParticipacao/$1';
$route['solicita-status-solicitacao-dia/(:num)'] = 'vereador/SolicitacaoController/tipoStatus/$1';
$route['view-voto-recebe/(:num)'] = 'vereador/SolicitacaoController/showMeuVoto/$1';
$route['finaliza_voto_por_contagem_vereador'] = 'vereador/SolicitacaoController/finalizaVotoPorContagemVereador';
$route['atualiza-dados-perfil-vereador-pessola/(:num)'] = 'vereador/PerfilController/index/$1';
/**----faz voto */

/**tela de votação */
$route['create-new-screen'] = 'gestor/TelaGestorController/addTelaGestor';
$route['user-type-tela/(:num)'] = 'gestor/TelaGestorController/listaMytela/$1';
$route['lista-dados-tela-user/(:num)'] = 'gestor/TelaGestorController/listaMytelaView/$1';
$route['update-new-screen-tv'] = 'gestor/TelaGestorController/alteraMytelaView';
$route['tvstatusvotacao/(:num)'] = 'tv/TvController/tipoStatusVotoTV/$1';
$route['conclui-voto-tv-grupo/(:num)'] = 'tv/TvController/concluiVotoTvGrupo/$1';
$route['conclui-voto-tv-individual/(:num)'] = 'tv/TvController/concluiVotoTvnIdividual/$1';

/**btn votação novo */
$route['salva-voto-vereador'] = 'vereador/SolicitacaoController/fazVoto';
$route['view-btn_projetos']  = 'vereador/SolicitacaoController/listaButtonProjetosDoDia';
$route['view-carrega_painel_voto/(:num)'] = 'vereador/SolicitacaoController/carregaPageVoto/$1';


/**historico da sessão */
$route['lista-historico-sessao/(:num)'] = 'gestor/HistoricoSessaoController/index/$1';
$route['hostoricos-votos-projetos-table/(:num)'] = 'gestor/ConsultaProjetosVotosController/index/$1';
$route['lista-historicos-votos-gestor/(:num)'] = 'gestor/HistoricoSessaoController/listaSituacaoVotacao/$1';
$route['histórico-de-voto-pdf/(:num)'] = 'gestor/HistoricoSessaoController/visualizaDadosVotosPdf/$1';
