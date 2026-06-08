<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\HeroBannersAddRequest;
use App\Http\Requests\HeroBannersEditRequest;
use App\Models\HeroBanners;
use Illuminate\Http\Request;
use Exception;
class HeroBannersController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.herobanners.list";
		$query = HeroBanners::query();
		$limit = $request->limit ?? 20;
		if($request->search){
			$search = trim($request->search);
			HeroBanners::search($query, $search); // search table records
		}
		$query->join("company_profiles", "hero_banners.company_id", "=", "company_profiles.id");
		$orderby = $request->orderby ?? "hero_banners.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, HeroBanners::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = HeroBanners::query();
		$record = $query->findOrFail($rec_id, HeroBanners::viewFields());
		return $this->renderView("pages.herobanners.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.herobanners.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(HeroBannersAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("background_image", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['background_image'], "background_image");
			$modeldata['background_image'] = $fileInfo['filepath'];
		}
		
		//save HeroBanners record
		$record = HeroBanners::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("herobanners", "Data berhasil ditambahkan");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(HeroBannersEditRequest $request, $rec_id = null){
		$query = HeroBanners::query();
		$record = $query->findOrFail($rec_id, HeroBanners::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("background_image", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['background_image'], "background_image");
			$modeldata['background_image'] = $fileInfo['filepath'];
		}
			$record->update($modeldata);
			return $this->redirect("herobanners", "Data berhasil diperbaharui");
		}
		return $this->renderView("pages.herobanners.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = HeroBanners::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Data berhasil dihapus");
	}
	private function getNextRecordId($rec_id){
		$query = HeroBanners::query();
		$query->where('id', '>', $rec_id);
		$query->orderBy('id', 'asc');
		$record = $query->first(['id']);
		if($record){
			return $record['id'];
		}
		return null;
	}
	private function getPreviousRecordId($rec_id){
		$query = HeroBanners::query();
		$query->where('id', '<', $rec_id);
		$query->orderBy('id', 'desc');
		$record = $query->first(['id']);
		if($record){
			return $record['id'];
		}
		return null;
	}
}
