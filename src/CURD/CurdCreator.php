<?php

namespace Helilabs\HDH\CURD;

use Illuminate\Http\Request;

abstract Class CurdCreator{
	
	public $args;

	public $model;

	public $request;

	public $interface;

	public function __construct(Request $request, array $args = array(), $interface = 'web' ){

		$this->args = array_merge($this->defaultArgs(), $args );

		$this->request = $request;

		$this->interface = $interface;
	}

	public function defaultArgs(){
		return [
			'action' => 'new',
			'id' => null,
		];
	}

	public function setInterface( $interface ){
		$this->interface = $interface;
		return $this;
	}

	public function getModel(){
		return $this->model;
	}

	public function getModelErrors(){
		if( $this->interface == 'api' ){
			return json_encode( $this->model->getErrorsAsArray() );
		}
		
		return $this->model->getErrors();
	}

	abstract function doAction();

	public abstract function doTheRest();

}