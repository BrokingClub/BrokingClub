<?php

class PurchasesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /purchases
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /purchases/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /purchases
	 *
	 * @return Response
	 */
	public function store()
	{
        $thePlayer = Player::auth();
        if(!$thePlayer)
            return Redirect::back()->withError('You are not logged in as a real player.');

        $stock = Stock::findOrFail(Input::get('stock_id'));

        $purchase = new Purchase();

        $mode = "falling";
        if(Input::get('betOnRise'))
            $mode = "rising";

        $purchase->amount = Input::get('amount');
        $purchase->mode = $mode;
        $purchase->stock_id = $stock->id;
        $purchase->player_id = $thePlayer->id;

        $bill = $purchase->calculateBill();
        $purchase->paid = $bill['perStock'];

        $charge = $thePlayer->charge($bill['total']);

        if(!$charge)
            return Redirect::back()->withError('You do not have enough money for this purchase.');
        else{
            $purchase->save();
            return Redirect::back()->withMessage('You have just bought '. $purchase->amount . 'x '
                . $stock->name . ' stocks, for ' . $bill['total'] . '$.'  );

        }

	}

	/**
	 * Display the specified resource.
	 * GET /purchases/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /purchases/{id}/edit
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
	 * PUT /purchases/{id}
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
	 * DELETE /purchases/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}