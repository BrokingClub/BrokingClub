<?php

class BaseController extends Controller
{

    protected $data = array();

    public function __construct()
    {

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
        //TODO: Outsource this to the config file
        $projectName = "Broking Club";

        if(!isset($this->data['title'])){
            $this->data['title'] =  'Welcome';
        }

        if(!isset($this->data['headTitle'])){
            $this->data['headTitle'] =  $this->data['title'] . ' | ' . $projectName;
        }

    }



}
