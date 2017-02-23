<?php
 

 class CurrentUserComposer {

 	protected $auth;

 }
 public function compose(View $view) 
 {

 	$view->with('current(array)');
 }