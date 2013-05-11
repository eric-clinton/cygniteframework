<?php

       /*
         *===============================================================================================
         *  An open source application development framework for PHP 5.2 or newer
         *
         * @Package                         :
         * @Filename                       :
         * @Description                   :
         * @Autho                            : Appsntech Dev Team
         * @Copyright                     : Copyright (c) 2013 - 2014,
         * @License                         : http://www.appsntech.com/license.txt
         * @Link	                          : http://appsntech.com
         * @Since	                          : Version 1.0
         * @Filesource
         * @Warning                      : Any changes in this library can cause abnormal behaviour of the framework
         * ===============================================================================================
         */
//RouteMapper::get('welcomeuser/(:all?)', 'category@view');
//RouteMapper::route('category/any','industry@index');
//RouteMapper::route('category/any','welcome@testing');

    class RouteMapper
    {
            private static $index_page = "index.php";
            public static $is_router_enabled = FALSE;
            public static $url = NULL;
            public static $route_to = NULL;



            public static function set_route($url,$routeto)
            {
                    if($url =="")
                            throw new Exception ("Empty url parameter passed on ".__METHOD__);
                    if($routeto =="")
                          throw new Exception ("Empty route_to parameter passed on ".__METHOD__);
                    static::$url = $url;
                    static::$route_to = $routeto;
            }

            public static function get_route()
            {
                    if(is_null(static::$url))
                                //  throw new Exception ("Url has not been set in ".__METHOD__);
                        if(is_null(static::$route_to))
                                 // throw new Exception ("Route to has not been set in ".__METHOD__);

                     return array(
                                            'url'=>  static::$url ,
                                            'route_to' =>static::$route_to
                                        );
            }



            public static function route($url,$routeto)
            {
                 $segment = explode('/', $url);

                 if(in_array('any', $segment) && (static::_uri_exists($segment[0], $_SERVER['REQUEST_URI']) )):
                       //echo "controll exists with any keyword ";
                                $call_route = array();
                                $call_route = explode('@', $routeto);
                                $exp = explode('/',($_SERVER['REQUEST_URI']));
                                 $index_count = array_search(self::$index_page,$exp);
                                  $index = ($index_count) ? self::$index_page : '';
                                 $route_url =    $_SERVER['SCRIPT_NAME'].'/'.$call_route[0].'/'.$call_route[1];
                                // var_dump($exp);
                                $expression = explode('/', $route_url);
                                $find_index = array_search(self::$index_page,$expression);
                                self::catch_request($expression,$find_index);
                 else:
                        if(static::_uri_exists($segment, $_SERVER['REQUEST_URI'])):
                                 $call_route = array();
                                $call_route = explode('@', $routeto);
                                $exp = explode('/',($_SERVER['REQUEST_URI']));


                                $index_count = array_search(self::$index_page,$exp);
                                $index = ($index_count) ? self::$index_page : '';
                               $route_url =    $_SERVER['SCRIPT_NAME'].'/'.$index.'/'.$call_route[0].'/'.$call_route[1];

                                $expression = explode('/', $route_url);
                                $find_index = array_search(self::$index_page,$expression);
                                self::catch_request($expression,$find_index);
                        endif;
                 endif;
            }

            private static function catch_request($expression,$find_index)
            {
                        CF_AppRegistry::import('base', 'Dispatcher',CF_BASEPATH);
                        if(class_exists('Dispatcher')):
                                    Dispatcher::response_user_request($expression,$find_index,TRUE);
                        endif;
            }

            public static function _uri_exists($var, $content, $type='any')
            {
                switch ($var):
                    case is_array($var):
                                    if(static::_uri_exists($var[0], $_SERVER['REQUEST_URI']) && static::_uri_exists($var[1], $_SERVER['REQUEST_URI']) ):
                                                return TRUE;
                                    endif;
                        break;
                    case is_string($var):
                                    return strpos(strtolower($content),
                                                            strtolower($var)) ?
                                                            TRUE : FALSE;
                        break;

                endswitch;
            }


}