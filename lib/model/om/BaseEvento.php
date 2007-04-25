<?php


abstract class BaseEvento extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $fecha_inicio;


	
	protected $fecha_fin;


	
	protected $tipo = 0;


	
	protected $frecuencia = 0;


	
	protected $frecuencia_intervalo = 0;


	
	protected $recurrencia_fin = '';


	
	protected $recurrencia_dias = 0;


	
	protected $estado = 0;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getFechaInicio($format = 'Y-m-d H:i:s')
	{

		if ($this->fecha_inicio === null || $this->fecha_inicio === '') {
			return null;
		} elseif (!is_int($this->fecha_inicio)) {
						$ts = strtotime($this->fecha_inicio);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [fecha_inicio] as date/time value: " . var_export($this->fecha_inicio, true));
			}
		} else {
			$ts = $this->fecha_inicio;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getFechaFin($format = 'Y-m-d H:i:s')
	{

		if ($this->fecha_fin === null || $this->fecha_fin === '') {
			return null;
		} elseif (!is_int($this->fecha_fin)) {
						$ts = strtotime($this->fecha_fin);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [fecha_fin] as date/time value: " . var_export($this->fecha_fin, true));
			}
		} else {
			$ts = $this->fecha_fin;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getTipo()
	{

		return $this->tipo;
	}

	
	public function getFrecuencia()
	{

		return $this->frecuencia;
	}

	
	public function getFrecuenciaIntervalo()
	{

		return $this->frecuencia_intervalo;
	}

	
	public function getRecurrenciaFin()
	{

		return $this->recurrencia_fin;
	}

	
	public function getRecurrenciaDias()
	{

		return $this->recurrencia_dias;
	}

	
	public function getEstado()
	{

		return $this->estado;
	}

	
	public function setId($v)
	{

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = EventoPeer::ID;
		}

	} 
	
	public function setFechaInicio($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [fecha_inicio] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->fecha_inicio !== $ts) {
			$this->fecha_inicio = $ts;
			$this->modifiedColumns[] = EventoPeer::FECHA_INICIO;
		}

	} 
	
	public function setFechaFin($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [fecha_fin] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->fecha_fin !== $ts) {
			$this->fecha_fin = $ts;
			$this->modifiedColumns[] = EventoPeer::FECHA_FIN;
		}

	} 
	
	public function setTipo($v)
	{

		if ($this->tipo !== $v || $v === 0) {
			$this->tipo = $v;
			$this->modifiedColumns[] = EventoPeer::TIPO;
		}

	} 
	
	public function setFrecuencia($v)
	{

		if ($this->frecuencia !== $v || $v === 0) {
			$this->frecuencia = $v;
			$this->modifiedColumns[] = EventoPeer::FRECUENCIA;
		}

	} 
	
	public function setFrecuenciaIntervalo($v)
	{

		if ($this->frecuencia_intervalo !== $v || $v === 0) {
			$this->frecuencia_intervalo = $v;
			$this->modifiedColumns[] = EventoPeer::FRECUENCIA_INTERVALO;
		}

	} 
	
	public function setRecurrenciaFin($v)
	{

		if ($this->recurrencia_fin !== $v || $v === '') {
			$this->recurrencia_fin = $v;
			$this->modifiedColumns[] = EventoPeer::RECURRENCIA_FIN;
		}

	} 
	
	public function setRecurrenciaDias($v)
	{

		if ($this->recurrencia_dias !== $v || $v === 0) {
			$this->recurrencia_dias = $v;
			$this->modifiedColumns[] = EventoPeer::RECURRENCIA_DIAS;
		}

	} 
	
	public function setEstado($v)
	{

		if ($this->estado !== $v || $v === 0) {
			$this->estado = $v;
			$this->modifiedColumns[] = EventoPeer::ESTADO;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->fecha_inicio = $rs->getTimestamp($startcol + 1, null);

			$this->fecha_fin = $rs->getTimestamp($startcol + 2, null);

			$this->tipo = $rs->getInt($startcol + 3);

			$this->frecuencia = $rs->getInt($startcol + 4);

			$this->frecuencia_intervalo = $rs->getInt($startcol + 5);

			$this->recurrencia_fin = $rs->getString($startcol + 6);

			$this->recurrencia_dias = $rs->getInt($startcol + 7);

			$this->estado = $rs->getInt($startcol + 8);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Evento object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EventoPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			EventoPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EventoPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected function doSave($con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = EventoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += EventoPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			if (($retval = EventoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EventoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getFechaInicio();
				break;
			case 2:
				return $this->getFechaFin();
				break;
			case 3:
				return $this->getTipo();
				break;
			case 4:
				return $this->getFrecuencia();
				break;
			case 5:
				return $this->getFrecuenciaIntervalo();
				break;
			case 6:
				return $this->getRecurrenciaFin();
				break;
			case 7:
				return $this->getRecurrenciaDias();
				break;
			case 8:
				return $this->getEstado();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EventoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getFechaInicio(),
			$keys[2] => $this->getFechaFin(),
			$keys[3] => $this->getTipo(),
			$keys[4] => $this->getFrecuencia(),
			$keys[5] => $this->getFrecuenciaIntervalo(),
			$keys[6] => $this->getRecurrenciaFin(),
			$keys[7] => $this->getRecurrenciaDias(),
			$keys[8] => $this->getEstado(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EventoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setFechaInicio($value);
				break;
			case 2:
				$this->setFechaFin($value);
				break;
			case 3:
				$this->setTipo($value);
				break;
			case 4:
				$this->setFrecuencia($value);
				break;
			case 5:
				$this->setFrecuenciaIntervalo($value);
				break;
			case 6:
				$this->setRecurrenciaFin($value);
				break;
			case 7:
				$this->setRecurrenciaDias($value);
				break;
			case 8:
				$this->setEstado($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EventoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setFechaInicio($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setFechaFin($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setTipo($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setFrecuencia($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setFrecuenciaIntervalo($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setRecurrenciaFin($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setRecurrenciaDias($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setEstado($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(EventoPeer::DATABASE_NAME);

		if ($this->isColumnModified(EventoPeer::ID)) $criteria->add(EventoPeer::ID, $this->id);
		if ($this->isColumnModified(EventoPeer::FECHA_INICIO)) $criteria->add(EventoPeer::FECHA_INICIO, $this->fecha_inicio);
		if ($this->isColumnModified(EventoPeer::FECHA_FIN)) $criteria->add(EventoPeer::FECHA_FIN, $this->fecha_fin);
		if ($this->isColumnModified(EventoPeer::TIPO)) $criteria->add(EventoPeer::TIPO, $this->tipo);
		if ($this->isColumnModified(EventoPeer::FRECUENCIA)) $criteria->add(EventoPeer::FRECUENCIA, $this->frecuencia);
		if ($this->isColumnModified(EventoPeer::FRECUENCIA_INTERVALO)) $criteria->add(EventoPeer::FRECUENCIA_INTERVALO, $this->frecuencia_intervalo);
		if ($this->isColumnModified(EventoPeer::RECURRENCIA_FIN)) $criteria->add(EventoPeer::RECURRENCIA_FIN, $this->recurrencia_fin);
		if ($this->isColumnModified(EventoPeer::RECURRENCIA_DIAS)) $criteria->add(EventoPeer::RECURRENCIA_DIAS, $this->recurrencia_dias);
		if ($this->isColumnModified(EventoPeer::ESTADO)) $criteria->add(EventoPeer::ESTADO, $this->estado);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(EventoPeer::DATABASE_NAME);

		$criteria->add(EventoPeer::ID, $this->id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setFechaInicio($this->fecha_inicio);

		$copyObj->setFechaFin($this->fecha_fin);

		$copyObj->setTipo($this->tipo);

		$copyObj->setFrecuencia($this->frecuencia);

		$copyObj->setFrecuenciaIntervalo($this->frecuencia_intervalo);

		$copyObj->setRecurrenciaFin($this->recurrencia_fin);

		$copyObj->setRecurrenciaDias($this->recurrencia_dias);

		$copyObj->setEstado($this->estado);


		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new EventoPeer();
		}
		return self::$peer;
	}

} 