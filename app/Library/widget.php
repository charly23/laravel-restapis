<?php 
namespace App\library 
{
    class widget 
    {
        
        public static function columns ( $id=null ) 
        {
            $html = null;
            switch ( $id ) :
                case 1:
                    $html .= static::inner( $id );
                break;
                case 2:
                    $html .= static::inner( $id );
                break;
                case 3:
                    $html .= static::inner( $id );
                break;
                default:
                    $html .= null;
                break;
            endswitch;
            return $html;
        }

        public static function inner ( $id=null ) 
        {
            $html = null;
            $html .= 'Widget ' . $id;
            return $html;        
        }

        // END
    }
}