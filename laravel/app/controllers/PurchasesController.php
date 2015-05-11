<?php

class PurchasesController extends \BaseController
{

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
        if (!$thePlayer)
            return Redirect::back()->withError('You are not logged in as a real player.');

        $stock = Stock::findOrFail(Input::get('stock_id'));

        $purchase = new Purchase();


        $mode = "falling";
        if (Input::get('betOnRise')) $mode = "rising";

        $leverage = min(500, max(100, intval(Input::get('leverage'))));

        $purchase->mode = $mode;
        $purchase->leverage = $leverage;
        $purchase->player_id = $thePlayer->id;

        $purchase->fillPurchase($stock, Input::get('amount'));

        if (!$purchase->validateAttributes())
            return Redirect::back();

        $bill = $purchase->bill();
        $charge = $thePlayer->charge($purchase->total());

        if (!$charge)
            return Redirect::back()->withError('You do not have enough money for this purchase.');

        $purchase->save();

        Event::fire('stocks.purchased', [$purchase]);

        return Redirect::back()->withMessage(
            'You have just bought ' . $purchase->amount . 'x '
            . $stock->name . ' stocks, for ' . $bill->getTotal() . '$.');


    }

    /**
     * Display the specified resource.
     * GET /purchases/{id}
     *
     * @param  int $id
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
     * @param  int $id
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
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        $purchase = Purchase::findOrFail($id);

        if (Input::get('action') == 'sell')
            return $this->sell($purchase);
    }

    public function sell($purchase)
    {
        $player = $purchase->player;
        $player->editAllowedOrFail();

        $sellOffer = $purchase->sellOffer();
        $player->balance += $sellOffer;

        $purchase->mode = "sold";

        $player->save();


        $purchase->save();

        Event::fire('stocks.sold', [$purchase]);


        return Redirect::back()->withMessage('Stocks sold for ' . Format::money($sellOffer) . '.');


    }

    /**
     * Remove the specified resource from storage.
     * DELETE /purchases/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}