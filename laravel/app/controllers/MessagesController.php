<?php

use BrokingClub\Repositories\ConversationRepository;
use Triggerdesign\Hermes\Models\Conversation;

class MessagesController extends \BaseController {

    /**
     * @var ConversationRepository
     */
    private $conversationRepository;

    public function __construct(ConversationRepository $conversationRepository){
        parent::__construct();

        $this->conversationRepository = $conversationRepository;
    }

	/**
	 * Display a listing of the resource.
	 * GET /messages
	 *
	 * @return Response
	 */
	public function index()
	{
		$conversations = Auth::user()->conversations;


        if($conversations->count() == 0)
            return Redirect::route('dashboard')->withNotice('No conversations yet.');

        return Redirect::route('messages.show', ['id' => $conversations->last()->id]);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /messages/create
	 *
	 * @return Response
	 */
	public function create()
	{
        $receiverId = intval(Input::get('receiver'));

        $receivingUser = User::findOrFail($receiverId);
        $sendingUser = Auth::user();

        if($receivingUser->id == $sendingUser->id) {
            return Redirect::route('players.show', ['id' => $receivingUser->id])->withError('You cannot write to yourself');
        }

        $conversation = Messaging::startConversation([$sendingUser->id, $receivingUser->id]);
        return Redirect::route('messages.show', ['id' => $conversation->id]);

	}

	/**
	 * Store a newly created resource in storage.
	 * POST /messages
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /messages/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $conversation = $this->conversationRepository->findById($id, true);

        $this->shareToView('conversations', Auth::user()->conversations);
        $this->shareToView('conversation', $conversation);
        $this->shareToView('messageGroups', $conversation->buildGroups());

        $this->setTitle('Conversation with ' . $conversation->otherUsers()->first()->name());

        $conversation->doRead();

        return $this->makeView('pages.game.message.show');
	}


	/**
	 * Show the form for editing the specified resource.
	 * GET /messages/{id}/edit
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
	 * PUT /messages/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $conversation = Conversation::findOrFail($id);

        $conversation->addMessage(Input::get('message'));

        return Redirect::route('messages.show', ['id' => $conversation->id]);


    }

	/**
	 * Remove the specified resource from storage.
	 * DELETE /messages/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}