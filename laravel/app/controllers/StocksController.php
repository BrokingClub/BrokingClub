<?php

class StocksController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /stocks
	 *
	 * @return Response
	 */
	public function index()
	{
		$stocks = Stock::all();

        $this->data['stocks'] = $stocks;

        $this->setTitle('Stocks');

        return $this->makeView('pages.game.stock.index');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /stocks/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /stocks
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /stocks/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $stock = Stock::findOrFail($id);

        $this->setTitle($stock->name);

        $this->data['stock'] = $stock;

        return $this->makeView('pages.game.stock.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /stocks/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /stocks/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /stocks/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}