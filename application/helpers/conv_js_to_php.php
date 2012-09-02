<?php


class ConvJsToPhp{
    public static function jsDateToPhp($jsonDateObj){
        return
          date(
              "Y-m-d H:i:s"
            , mktime(
                $jsonDateObj->HH
              , $jsonDateObj->mm
              , $jsonDateObj->ss
              , $jsonDateObj->MM
              , $jsonDateObj->dd
              , $jsonDateObj->yyyy)
          );
    }    
}



?>
