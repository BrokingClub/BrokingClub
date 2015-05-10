<?php

/**
 * Project: BrokingClub | AdminStockController.php
 * Author: Simon - www.triggerdesign.de
 * Date: 06.05.2015
 * Time: 13:49
 */
class AdminStockController extends AdminBaseController
{
    public function index(){
        $stocks = Stock::all();
        $this->data['stocks'] = $stocks;

        $this->setTitle('Manage stocks');

        return $this->makeView('pages.admin.stocks');
    }

    public function create()
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function delete($id)
    {
        $stock = Stock::find($id);

        $stock->delete();

        return Redirect::back()->withMessage('Deleted ' . $stock->name);
    }
} 