<?php

use BrokingClub\View\Injector;
use BrokingClub\Purchase\Bank;

class BaseController extends Controller
{
    /**
     * @var Injector
     */
    protected $viewInjector;

    protected $data = array();


    public function __construct()
    {
        $this->viewInjector = App::make('ViewInjector');
    }

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

    protected function makeView($viewKey){
        $this->beforeView();

        View::share($this->data);

        return View::make($viewKey);
    }

    protected function setTitle($title){
        $this->data['title'] = $title;
    }

    private function beforeView(){
        $projectName = Config::get('brokingclub.name');

        if(!isset($this->data['title'])){
            $this->data['title'] =  'Welcome';
        }

        if(!isset($this->data['headTitle'])){
            $this->data['headTitle'] =  $this->data['title'] . ' | ' . $projectName;
        }


        $this->viewInjection();

    }

    private function viewInjection(){
        $this->data = $this->viewInjector->inject($this->data);
    }





}
