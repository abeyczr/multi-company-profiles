<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\PortfolioCategoriesAddRequest;
use App\Http\Requests\PortfolioCategoriesEditRequest;
use App\Models\PortfolioCategories;
use Illuminate\Http\Request;
use Exception;
class PortfolioCategoriesController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.portfoliocategories.list";
		$query = PortfolioCategories::query();
		$limit = $request->limit ?? 20;
		if($request->search){
			$search = trim($request->search);
			PortfolioCategories::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "portfolio_categories.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, PortfolioCategories::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = PortfolioCategories::query();
		$record = $query->findOrFail($rec_id, PortfolioCategories::viewFields());
		return $this->renderView("pages.portfoliocategories.view", ["data" => $record]);
	}
	

	/**
     * Display Master Detail Pages
	 * @param string $rec_id //master record id
     * @return \Illuminate\View\View
     */
	function masterDetail($rec_id = null){
		return View("pages.portfoliocategories.detail-pages", ["masterRecordId" => $rec_id]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.portfoliocategories.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(PortfolioCategoriesAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save PortfolioCategories record
		$record = PortfolioCategories::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("portfoliocategories", "Data berhasil ditambahkan");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(PortfolioCategoriesEditRequest $request, $rec_id = null){
		$query = PortfolioCategories::query();
		$record = $query->findOrFail($rec_id, PortfolioCategories::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("portfoliocategories", "Data berhasil diperbaharui");
		}
		return $this->renderView("pages.portfoliocategories.edit", ["data" => $record, "rec_id" => $rec_id]);
	}
	

	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
	 * @param  \Illuminate\Http\Request
	 * @param string $rec_id //can be separated by comma 
     * @return \Illuminate\Http\Response
     */
	function delete(Request $request, $rec_id = null){
		$arr_id = explode(",", $rec_id);
		$query = PortfolioCategories::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Data berhasil dihapus");
	}
	private function getNextRecordId($rec_id){
		$query = PortfolioCategories::query();
		$query->where('id', '>', $rec_id);
		$query->orderBy('id', 'asc');
		$record = $query->first(['id']);
		if($record){
			return $record['id'];
		}
		return null;
	}
	private function getPreviousRecordId($rec_id){
		$query = PortfolioCategories::query();
		$query->where('id', '<', $rec_id);
		$query->orderBy('id', 'desc');
		$record = $query->first(['id']);
		if($record){
			return $record['id'];
		}
		return null;
	}
}
