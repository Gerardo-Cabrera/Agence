<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Consultor extends Model {
    protected $table = 'cao_usuario';

    public static function getConsultores() {
    	$consultores = Consultor::select('cao_usuario.co_usuario', 'no_usuario', 'ds_senha')
                                ->leftJoin('permissao_sistema', 'cao_usuario.co_usuario', 
                                           'permissao_sistema.co_usuario')
                                ->where([['permissao_sistema.co_sistema', 1], ['permissao_sistema.in_ativo', 'S']])
                                ->whereIn('permissao_sistema.co_tipo_usuario', [0, 1, 2])
                                ->get()->toArray();

        return $consultores;
    }

    public static function getYears() {
    	$fecha = DB::table('cao_fatura')->selectRaw('EXTRACT(YEAR FROM data_emissao) as year')->get()->toArray();
    	$years = [];

    	foreach ($fecha as $key => $value) {
    		if (!in_array($value->year, $years)) {
    			array_push($years, $value->year);
    		}
    	}

    	return $years;
    }

    public static function getMonths() {
    	$months = [];

    	for($m=1; $m<=12; ++$m){
    		$month = date('F', mktime(0, 0, 0, $m, 1));

    		if (!in_array($month, $months)) {
    			array_push($months, $month);
    		}
		}

		foreach ($months as $key => $value) {
			$months[$key] = [];
			$months[$key]['name'] = $value;
			$numberMonth = date_parse($value);
			$months[$key]['number'] = $numberMonth['month'];
		}
    	
    	return $months;
    }

    public function getGanancias($data) {
    	$dataConsultores = [];

    	foreach ($data['listadoConsultores'] as $key => $value) {
    		$dataConsultores[$value] = [];
    		$dataConsultores[$value]['meses'] = [];
			for ($i=$data['monthsFrom']; $i <= $data['monthsTo'] ; $i++) {
				$monthName = date('F', mktime(0, 0, 0, $i, 1));
		    	$infoMes = DB::table('cao_fatura')->select('cao_fatura.co_os', 'total', 'valor', 'data_emissao', 
		    		'comissao_cn', 'total_imp_inc', 'cao_os.co_usuario', 'cao_usuario.no_usuario')
		    									 ->leftJoin('cao_os', 'cao_fatura.co_os', 'cao_os.co_os')
		    									 ->leftJoin('cao_usuario', 'cao_os.co_usuario', 
		    									 			'cao_usuario.co_usuario')
		    									 ->where('cao_os.co_usuario', $value)
		    									 ->whereMonth('cao_fatura.data_emissao', $i)
		    									 ->get()->toArray();
				$dataConsultores[$value]['meses'][$monthName] = $infoMes;

		    	if (!in_array($infoMes, $dataConsultores[$value]['meses'])) {
		    		array_push($dataConsultores[$value]['meses'], $infoMes);
		    	}
	    	}
    	}

    	return $dataConsultores;
    }

    public function getTotalMes($data) {
    	foreach ($data as $key => $value) {
    		if (isset($value['salario'])) {
    			$salario = $value['salario'];
    		}

    		foreach ($value['meses'] as $clave => $valor) {
    			$totalMes = 0;
    			$comisionMes = 0;
    			foreach ($valor as $i => $dato) {
    				$impuesto = ($dato->valor * $dato->total_imp_inc) / 100;
    				$totalFactura = $dato->valor - $impuesto;
    				$totalMes += $totalFactura;
    				$comisionFactura = ($totalFactura * $dato->comissao_cn) / 100;
    				$comisionMes += $comisionFactura;
    				$lucro = $totalMes - $salario - $comisionMes;
    				$data[$key]['meses'][$clave]['totalMes'] = $totalMes;
    				$data[$key]['meses'][$clave]['comisionMes'] = $comisionMes;
    				$data[$key]['meses'][$clave]['lucro'] = $lucro;
    			}
    		}
    	}

    	return $data;
    }

    public function getSalario($data) {
    	foreach ($data as $key => $value) {
    		$salario = DB::table('cao_salario')->select('brut_salario')->where('co_usuario', $key)->get();
    		if (isset($salario[0]->brut_salario)) {
    			$data[$key]['salario'] = $salario[0]->brut_salario;
    		}
    	}

    	return $data;
    }

    public function getConsultor($data) {
    	foreach ($data as $key => $value) {
    		$consultor = DB::table('cao_usuario')->select('no_usuario')->where('co_usuario', $key)->get();
    			$data[$key]['consultor'] = $consultor[0]->no_usuario;
    	}

    	return $data;
    }

    public function getTotales($datos) {
    	$data = $this->getGanancias($datos);
    	$data = $this->getSalario($data);
    	$data = $this->getTotalMes($data);
    	$data = $this->getConsultor($data);

    	return $data;
    }

}
