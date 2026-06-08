<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyProfilesAddRequest;
use App\Http\Requests\CompanyProfilesEditRequest;
use App\Models\CompanyProfiles;
use Illuminate\Http\Request;
use Exception;
class CompanyProfilesController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.companyprofiles.list";
		$query = CompanyProfiles::query();
		$limit = $request->limit ?? 20;
		if($request->search){
			$search = trim($request->search);
			CompanyProfiles::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "company_profiles.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, CompanyProfiles::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = CompanyProfiles::query();
		$record = $query->findOrFail($rec_id, CompanyProfiles::viewFields());
		return $this->renderView("pages.companyprofiles.view", ["data" => $record]);
	}
	

	/**
     * Display Master Detail Pages
	 * @param string $rec_id //master record id
     * @return \Illuminate\View\View
     */
	function masterDetail($rec_id = null){
		return View("pages.companyprofiles.detail-pages", ["masterRecordId" => $rec_id]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.companyprofiles.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(CompanyProfilesAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save CompanyProfiles record
		$record = CompanyProfiles::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("companyprofiles", "Data berhasil ditambahkan");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(CompanyProfilesEditRequest $request, $rec_id = null){
		$query = CompanyProfiles::query();
		$record = $query->findOrFail($rec_id, CompanyProfiles::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("companyprofiles", "Data berhasil diperbaharui");
		}
		return $this->renderView("pages.companyprofiles.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = CompanyProfiles::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Data berhasil dihapus");
	}
	private function getNextRecordId($rec_id){
		$query = CompanyProfiles::query();
		$query->where('id', '>', $rec_id);
		$query->orderBy('id', 'asc');
		$record = $query->first(['id']);
		if($record){
			return $record['id'];
		}
		return null;
	}
	private function getPreviousRecordId($rec_id){
		$query = CompanyProfiles::query();
		$query->where('id', '<', $rec_id);
		$query->orderBy('id', 'desc');
		$record = $query->first(['id']);
		if($record){
			return $record['id'];
		}
		return null;
	}
}
