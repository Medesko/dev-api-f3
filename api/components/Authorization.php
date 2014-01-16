<?php 

Class Authorization{
  public static function authorized($access){
        if(!in_array(0, $access) && count($access) >= 1) 
        {
                $token = isset($_REQUEST['token_access']) ? $_REQUEST['token_access'] : '';
                $user = new ORMUsers();
                if(!$user->find(array('token' => $token))){
                        Api::response(401, array(), 'Invalid Token');
                        exit();
                } elseif(!in_array($user->status, $access)){
                        Api::response(401, array(), 'No permission to access this user');
                        exit();                                
                }
        }
  }

}
