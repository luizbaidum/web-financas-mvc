<?php

namespace src\Models\Movimentos;

use MF\Model\Model;
use MF\Model\SQLActions;

class MovimentosDAO extends Model {
    public function indexTable($pesquisa, $year = '', $month = '')
    {
        $where = 'WHERE (DATE_FORMAT(movimentos.dataMovimento, "%Y%m") = DATE_FORMAT(CURRENT_DATE(), "%Y%m"))';

        if ($month != '' && $month == 'Todos') {
            $where = 'WHERE movimentos.dataMovimento IS NOT NULL';
        } elseif ($month != '' && $month != 'Todos') {
            $where = "WHERE DATE_FORMAT(movimentos.dataMovimento, '%Y%b') = '$year$month'";
        }

        if ($pesquisa != '') {
            $where .= ' AND (categorias.categoria LIKE "%' . $pesquisa . '%" OR movimentos.nomeMovimento LIKE "%' . $pesquisa . '%")';
        }

        $query = "SELECT movimentos.*, categorias.categoria, categorias.tipo FROM movimentos INNER JOIN categorias ON categorias.idCategoria = movimentos.idCategoria $where ORDER BY dataMovimento DESC";

        $new_sql = new SQLActions();
		$result = $new_sql->executarQuery($query);

        return $result;
    }

    public function getSaldoPassado(int $times = 2)
    {
        $mes_atual = date('m');
        $where = 'MONTH(movimentos.dataMovimento) BETWEEN "'. ($mes_atual - $times).'" AND "'. ($mes_atual - 1).'"';

        $query = "SELECT SUM(movimentos.valor) AS valor, MONTH(movimentos.dataMovimento) AS MES
                    FROM movimentos 
                    WHERE $where
                    GROUP BY MES";

        $new_sql = new SQLActions();
        $result = $new_sql->executarQuery($query);

        return $result;
    }

    public function indicadores($year = '', $month = '')
    {
        $where = 'WHERE (DATE_FORMAT(movimentos.dataMovimento, "%Y%m") = DATE_FORMAT(CURRENT_DATE(), "%Y%m"))';
        if (!empty($month)) {
            if ($month == 'Todos') {
                $where = 'WHERE movimentos.dataMovimento IS NOT NULL';
            } else {
                $where = "WHERE DATE_FORMAT(movimentos.dataMovimento, '%Y%b') = '$year$month'";
            }
        }

        $query = "SELECT SUM(movimentos.valor) AS total, categorias.idCategoria, categorias.categoria, categorias.tipo
                    FROM movimentos 
                    INNER JOIN categorias ON categorias.idCategoria = movimentos.idCategoria
                    $where
                    GROUP BY movimentos.idCategoria
                    ORDER BY total DESC";

        $new_sql = new SQLActions();
        $result = $new_sql->executarQuery($query);

        $ret = [];
        foreach ($result as $val) {
            $ret[$val['idCategoria']] = $val;
        }

        return $ret;
    }

    public function getResultado($year = '', $month = '')
    {
        $where = '(DATE_FORMAT(movimentos.dataMovimento, "%Y%m") = DATE_FORMAT(CURRENT_DATE(), "%Y%m"))';
        if (!empty($month)) {
            $where = "DATE_FORMAT(movimentos.dataMovimento, '%Y%b') = '$year$month'";
        }

        $query = "SELECT SUM(movimentos.valor) AS total, movimentos.proprietario, categorias.tipo, categorias.categoria FROM movimentos INNER JOIN categorias ON movimentos.idCategoria = categorias.idCategoria WHERE categorias.tipo != 'A' AND categorias.idCategoria != 10 AND $where GROUP BY movimentos.proprietario, categorias.idCategoria";

        $new_sql = new SQLActions();
        $result = $new_sql->executarQuery($query);

        if (count($result) > 0) {
            return $result;
        }

        return false;
    }
}