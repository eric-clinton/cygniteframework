<?php if ( ! defined('CF_SYSTEM')) exit('External script access not allowed');

    class HomeAppsController extends CF_BaseController
    {
      /**
        * --------------------------------------------------------------------------
        * The Default Controller
        *--------------------------------------------------------------------------
        *  This controller respond to uri begining with welcomeuser and also
        *  respond to root url like "home/index"
        *
        * Your GET request of "home/form" will repond like below -
        *
        *      public function action_form()
        *     {
        *            echo "Cygnite : Hellow ! World ";
        *     }
        * Note: By default cygnite doesn't allow you to pass query string in url, which
        * consider as bad url format.
        *
        * You can also pass parameters into the function as below-
        * Your request to  "home/form/2134" will pass to
        *
        *      public function action_form($id = ")
        *      {
        *             echo "Cygnite : Your user Id is $id";
        *      }
        * In case if you are not able to access parameters passed into method
        * directly as above, you can also get the uri segment
        *  echo Url::segment(3);
        *
        * That's it you are ready to start your awesome application with Cygnite Framework.
        *
        */
        private $author = 'Sanjoy Dey';

        private $country = 'India';

         /*
         * Your constructor.
         * @access public
         *
         */
        public function __construct()
        {
              parent::__construct();
        }
        /*
         * Default method for your controller. Render welcome page to user.
         * @access public
         *
         */
        public function action_index()
        {
                Cygnite::import('packages>cygnite>helpers>CF_Assets');
               $this->render("welcome")->with(array(
                                                                                     'author'=>$this->author,
                                                                                    'email'=>'sanjoy09@hotmail.com',
                                                                                    'messege' => 'Welcome to Cygnite Framework',
                                                                                    'country'=> $this->country
                                                                                  ));
        }

        public function action_test($param1,$param2,$param3)
        {
                echo "This test $param1,$param2,$param3";
        }

        public function action_testing()
        {
                echo "This testing ";
        }

        public function action_runcrons($param ="")
        { echo $param;
                echo "This is cron test ";exit;
        }


    } // End of your home controller