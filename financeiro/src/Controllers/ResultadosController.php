<?php
namespace src\Controllers\ResultadosController;

use MF\Controller\Controller;
use src\Models\Movimentos\MovimentosDAO;

class ResultadosController extends Controller {
    public function index() {
        $ano_filtro = $_GET['anoFiltro'];
        $mes_filtro = $_GET['mesFiltro'];

        $model_movimentos = new MovimentosDAO();
        $ret = $model_movimentos->getResultado($ano_filtro, $mes_filtro);

        $data = [];
        $prop = [];
        if ($ret) {
            foreach ($ret as $val) {
                if ($val['tipo'] == 'R') {
                    if (strpos($val['categoria'], 'Resgate') !== false) {
                        if (isset($total_resgate[$val['idProprietario']])) {
                            $total_resgate[$val['idProprietario']] += $val['total'];
                        } else {
                            $total_resgate[$val['idProprietario']] = $val['total'];
                        }

                        if (isset($data[$val['idProprietario']]['Resgate'])) {
                            $data[$val['idProprietario']]['Resgate'] += $val['total'];
                        } else {
                            $data[$val['idProprietario']]['Resgate'] = $val['total'];
                        }
                    } else {
                        if (isset($total_receita[$val['idProprietario']])) {
                            $total_receita[$val['idProprietario']] += $val['total'];
                        } else {
                            $total_receita[$val['idProprietario']] = $val['total'];
                        }

                        if (isset($data[$val['idProprietario']]['Receitas'])) {
                            $data[$val['idProprietario']]['Receitas'] += $val['total'];
                        } else {
                            $data[$val['idProprietario']]['Receitas'] = $val['total'];
                        }
                    }
                } elseif ($val['tipo'] == 'D') {
                    if (isset($total_despesa[$val['idProprietario']])) {
                        $total_despesa[$val['idProprietario']] += $val['total'];
                    } else {
                        $total_despesa[$val['idProprietario']] = $val['total'];
                    }

                    if (isset($data[$val['idProprietario']]['Despesas'])) {
                        $data[$val['idProprietario']]['Despesas'] += $val['total'];
                    } else {
                        $data[$val['idProprietario']]['Despesas'] = $val['total'];
                    }
                } elseif ($val['tipo'] == 'A') {
                    if (isset($total_aplicacao[$val['idProprietario']])) {
                        $total_aplicacao[$val['idProprietario']] += $val['total'];
                    } else {
                        $total_aplicacao[$val['idProprietario']] = $val['total'];
                    }

                    if (isset($data[$val['idProprietario']]['Aplicação'])) {
                        $data[$val['idProprietario']]['Aplicação'] += $val['total'];
                    } else {
                        $data[$val['idProprietario']]['Aplicação'] = $val['total'];
                    }
                }
            }
        }
        
        $this->view->data['data'] = $data;
        $this->view->data['total_resgate'] = $total_resgate ?? 0;
        $this->view->data['total_receita'] = $total_receita;
        $this->view->data['total_despesa'] = $total_despesa;
        $this->view->data['total_aplicacao'] = $total_aplicacao;

        $this->renderInModal(
            titulo: 'Demonstrativo', 
            conteudo: 'exibir_resultado'
        );
    }
}