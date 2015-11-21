<?php

class Programmable {
    
    private $id;
    private $isSection=false;
    public $start;
    public $end;
    private $newCron;
    private $newRule = false;
    public function __construct(){
        $this->start = '#php rules';
        $this->end = '#end rules managed by php';
    }
    
    function removeScript($id){
        $oldCrontab = Array();                          /* pour chaque cellule une ligne du crontab actuel */

        $newCrontab = Array();                          /* pour chaque cellule une ligne du nouveau crontab */

        $isSection = false;
        
        exec('crontab -l', $oldCrontab);
        
        foreach($oldCrontab as $rule) {
          
          if($this->isSection == true) {
              $words = explode(' ',$rule);
              
              if($words[0] == "#" && $words[1] != $this->id){
                  
                  $newCrontab[] = $rule;
              }
              
          } 
          else {
                  $newCrontab[] = $ligne;  
              }
           if ($rule == $this>start) { $this->isSection = true; }
        }
        $this->newCron = $newCrontab
        return $this->newCron
    }
    
    function addScript($min , $hour, $day,$month, $week, $cmd, $comm) {
   
    
    $oldCron = array();
    $newCrontab = array();

    $isSection = false;
    $maxNb =0 ;
    exec('sudo crontab -l', $oldCron);

    foreach($oldCron as $job=>$row) {
       
        if($this->isSection == true){
            $word = explode(' ',$row);
		var_dump($word);
            if($word[0] == '#' && $word[1]>$maxNb){
                $maxNb = $word[1];
            }
        }
        if ($row == $this->start) { $this->isSection = true; }

        if ($row == $end) {
            $id = $maxNb+1;
            if($id >2){
                //remove cron for lights sunset
                $this->id = $id;
                $this->removeScript($this->id);
                $this->newCron[]='#'.$id.' '.$comm;
                $this->newCron[]= $min.' '.$hour.' '.$day.' '.$week.' '.$month.' '.$cmd;
                $this->newRule == true;
            }
            else {
                $newCrontab []='#'.$id.' '.$comm;

                $newCrontab []= $min.' '.$hour.' '.$day.' '.$week.' '.$month.' '.$cmd;
            }
            
        }
        $newCrontab[] = $row;



    }

    if($this->isSection == false) {
        $id = 1;
        $newCrontab[]='#'.$id.' '.$comm;
        $newCrontab []= $min.' '.$hour.' '.$day.' '.$week.' '.$month.' '.$cmd;
        $newCrontab[] = $end;
    }
    $f = fopen('/tmp/cron', 'w');
    if($this->newRule == true){
         fwrite($f, implode("\n", $this>newCron));
    }
    else {
          fwrite($f, implode("\n", $newCrontab));
 
    }
    fclose($f);

   exec('sudo crontab /tmp/cron');
   exec('sudo /etc/init.d/cron reload');
  
    return $id;
}

    
}


?>
