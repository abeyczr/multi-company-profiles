<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\SocialMediasAddRequest;
use App\Http\Requests\SocialMediasEditRequest;
use App\Models\SocialMedias;
use Illuminate\Http\Request;
use Exception;
class SocialMediasController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.socialmedias.list";
		$query = SocialMedias::query();
		$limit = $request->limit ?? 20;
		if($request->search){
			$search = trim($request->search);
			SocialMedias::search($query, $search); // search table records
		}
		$query->join("company_profiles", "social_medias.company_id", "=", "company_profiles.id");
		$orderby = $request->orderby ?? "social_medias.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, SocialMedias::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = SocialMedias::query();
		$record = $query->findOrFail($rec_id, SocialMedias::viewFields());
		return $this->renderView("pages.socialmedias.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.socialmedias.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(SocialMediasAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save SocialMedias record
		$record = SocialMedias::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("socialmedias", "Data berhasil ditambahkan");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(SocialMediasEditRequest $request, $rec_id = null){
		$query = SocialMedias::query();
		$record = $query->findOrFail($rec_id, SocialMedias::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("socialmedias", "Data berhasil diperbaharui");
		}
		return $this->renderView("pages.socialmedias.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = SocialMedias::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Data berhasil dihapus");
	}
	private function getNextRecordId($rec_id){
		$query = SocialMedias::query();
		$query->where('id', '>', $rec_id);
		$query->orderBy('id', 'asc');
		$record = $query->first(['id']);
		if($record){
			return $record['id'];
		}
		return null;
	}
	private function getPreviousRecordId($rec_id){
		$query = SocialMedias::query();
		$query->where('id', '<', $rec_id);
		$query->orderBy('id', 'desc');
		$record = $query->first(['id']);
		if($record){
			return $record['id'];
		}
		return null;
	}
}
