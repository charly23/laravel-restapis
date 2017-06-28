<?php 
namespace App\library 
{
    class menu 
    {
            
        public static function data () 
        {
            $menu[] = array(
                    'label' => 'Home',
                    'href' => url('/'),
                    'class' => 'home-menu',
                    'id' => 'home',
                    'name' => 'home-page'
                );

            return $menu;
        }

        public static function pages ( $current=null ) 
        {
            $html = null;
            $urli = explode( '/', url()->current() );

            $is_page = $current == 'auth' ? end( $urli ) : $current; 

            $menu = static::data(); 
            foreach( $menu as $keys => $results ) :
                $html .= '<li class="'.$results['class'].'">';

                $is_current = $results['id'] == $is_page ? 'current-menu' : null;

                $html .= '<a href="'.$results['href'].'" class="'.$results['class'].' '.$is_current.'" id="'.$results['id'].'" name="'.$results['name'].'">';
                $html .= $results['label'];
                $html .= '</a>';

                $html .= '</li>';
            endforeach;
            
            return $html;
        }

        // END
    }
}