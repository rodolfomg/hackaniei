<?php

class HomeController extends BaseController {

	function solveIt(){
		$med = $des = 0;
		$list = new NodeList;
		$data = Input::get("data");

		foreach ($data as $num) {
			$list->addNode($num);
			$med += $num;
		}

		$med /= $list->getCount();
		$des = pow($list->getCurrentData() - $med, 2);

		while($list->goBackward()){
			$des += pow($list->getCurrentData() - $med, 2);
		}

		$des /= $list->getCount() - 1;
		$des = pow($des, 0.5);

		return View::make("result", array('med' => $med, 'des' => $des, 'data' => $data));
	}
	
}

class Node {
	var $data;
	var $prev;
	var $next;

	function __construct($data, $prev, $next){
		$this->data = $data;
		$this->prev = $prev;
		$this->next = $next;
	}
}

class NodeList {
	protected $start;
	protected $current_node;
	protected $end;
	protected $count;
	const IS_EMPTY = null;

	function __construct(){
		$this->start = null;
		$this->current_node = null;
		$this->end = null;
		$this->count = 0;
	}

	function addNode($data){
		if(!$this->start){ 
			$node = new Node($data, null, null);
			$this->start = &$node;
			$this->current_node = &$node;
			$this->end = &$node;
			$this->count = 1;
		}
		else {
			if ($this->current_node->next) $node = new Node($data, $this->current_node, $this->current_node->next);
			else {
				$node = new Node($data, $this->current_node, null);
				$this->end = &$node;	
			}
			
			$this->current_node->next = &$node;
			$this->current_node = &$node;
			$this->count++;
		}
	}

	function addNodeToStart($data){
		if ($this->start) {
			$node = new Node($data, null, $this->start);
			$this->start->prev = &$node;
		}
		else {
			$node = new Node($data, null, null);
			$this->current_node = &$node;
			$this->end = &$node;
		}

		$this->start = &$node;
		$this->count++;
	}

	function addNodeToEnd($data){
		if ($this->end) {
			$node = new Node($data, $this->end, null);
			$this->end->next = &$node;
		}
		else {
			$node = new Node($data, null, null);
			$this->start = &$node;
			$this->current_node = &$node;
		}

		$this->end = &$node;
		$this->count++;
	}

	function deleteNode(){
		if(!$this->current_node)return IS_EMPTY;
		$current_node = &$this->current_node;
		$prev_node = &$current_node->prev;
		$next_node = &$current_node->next;

		if($prev_node && $next_node) {
			$prev_node->next = &$next_node;
			$next_node->prev = &$prev_node;
			$this->current_node = &$next_node;
		}
		elseif($prev_node) {
			$this->current_node = &$prev_node;
			$this->current_node->next = null;
			$this->end = &$prev_node;
		}
		elseif($next_node) {
			$this->start = &$next_node;
			$this->current_node = &$next_node;
			$this->current_node->prev = null;
		}
		else {
			$this->start = null;
			$this->current_node = null;
			$this->end = null;
		}

		unset($current_node);
		$this->count--;
	}

	function deleteFirst(){
		if(!$this->start)return IS_EMPTY;
		$current_node = &$this->start;
		$next_node = &$current_node->next;

		if($next_node) {
			$this->start = &$next_node;
			$this->current_node = &$next_node;
			$this->current_node->prev = null;
		}
		else {
			$this->start = null;
			$this->current_node = null;
			$this->end = null;
		}

		unset($current_node);
		$this->count--;
	}

	function deleteLast(){
		if(!$this->start)return IS_EMPTY;
		$current_node = &$this->end;
		$prev_node = &$current_node->prev;

		if($prev_node) {
			$this->end = &$prev_node;
			$this->current_node = &$prev_node;
			$this->current_node->next = null;
		}
		else {
			$this->start = null;
			$this->current_node = null;
			$this->end = null;
		}

		unset($current_node);
		$this->count--;
	}

	function playList(){
		if(!$this->start){
			echo "IS_EMPTY";
			return IS_EMPTY;
		}
		
		$current = &$this->start;
		while($current){
			echo "<br>".$current->data;
			$current = &$current->next;
		}
	}

	function playListR(){
		if(!$this->start){
			echo "IS_EMPTY";
			return IS_EMPTY;
		}
		
		$current = &$this->end;
		while($current){
			echo "<br>".$current->data;
			$current = &$current->prev;
		}
	}

	function goToStart(){
		$this->current_node = &$this->start;
	}

	function goForward(){
		if(!$this->start)return IS_EMPTY;
		if($this->current_node->next){ 
			$this->current_node = &$this->current_node->next;
			return 1;
		}
		return 0;
	}

	function goBackward(){
		if(!$this->start)return IS_EMPTY;
		if ($this->current_node->prev){
			$this->current_node = &$this->current_node->prev;
			return 1;
		}
		return 0;
	}

	function goToEnd(){
		$this->current_node = &$this->end;
	}

	function getCurrentData(){
		if(!$this->start)return IS_EMPTY;
		return $this->current_node->data;
	}

	function setCurrentData($data){ $this->current_node->data = $data;	}

	function getCount(){ return $this->count; }

}