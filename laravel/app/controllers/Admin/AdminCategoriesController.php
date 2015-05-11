<?php

class AdminCategoriesController extends AdminBaseController {

	/**
	 * Store a newly created resource in storage.
	 * POST /categories
	 *
	 * @return Response
	 */
	public function store()
	{
		$category = new StockCategory;

		if(!$category->validateAndSave()){
			return Redirect::back();
		}

		return Redirect::back()->withMessage('Added category ' . $category->name);
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /categories/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$category = StockCategory::find($id);

		if(!$category){
            return;
        }

		$category->delete();

		return Redirect::back()->withMessage('Deleted category ' . $category->name);
	}

}