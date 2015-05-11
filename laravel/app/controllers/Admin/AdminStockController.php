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
        $this->data['stocks'] = Stock::all();
        $this->data['categories'] = StockCategory::lists('name', 'id');

        $this->setTitle('Manage stocks');

        return $this->makeView('pages.admin.stocks');
    }

    public function store()
    {
        $stock = new Stock;

        if(!$stock->validateAndSave()){
            return Redirect::back();
        }

        return Redirect::back()->withMessage('Created ' . $stock->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $stock = Stock::find($id);

        if(!$stock){
            return;
        }

        $stock->delete();

        return Redirect::back()->withMessage('Deleted ' . $stock->name);
    }

} 