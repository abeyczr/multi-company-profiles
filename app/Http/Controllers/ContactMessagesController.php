<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactMessagesAddRequest;
use App\Http\Requests\ContactMessagesEditRequest;
use App\Models\ContactMessages;
use Illuminate\Http\Request;
use Exception;
class ContactMessagesController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.contactmessages.list";
		$query = ContactMessages::query();
		$limit = $request->limit ?? 20;
		if($request->search){
			$search = trim($request->search);
			ContactMessages::search($query, $search); // search table records
		}
		$query->join("company_profiles", "contact_messages.company_id", "=", "company_profiles.id");
		$orderby = $request->orderby ?? "contact_messages.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, ContactMessages::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = ContactMessages::query();
		$record = $query->findOrFail($rec_id, ContactMessages::viewFields());
		return $this->renderView("pages.contactmessages.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.contactmessages.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(ContactMessagesAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save ContactMessages record
		$record = ContactMessages::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("contactmessages", "Data berhasil ditambahkan");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(ContactMessagesEditRequest $request, $rec_id = null){
		$query = ContactMessages::query();
		$record = $query->findOrFail($rec_id, ContactMessages::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("contactmessages", "Data berhasil diperbaharui");
		}
		return $this->renderView("pages.contactmessages.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = ContactMessages::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Data berhasil dihapus");
	}
	private function getNextRecordId($rec_id){
		$query = ContactMessages::query();
		$query->where('id', '>', $rec_id);
		$query->orderBy('id', 'asc');
		$record = $query->first(['id']);
		if($record){
			return $record['id'];
		}
		return null;
	}
	private function getPreviousRecordId($rec_id){
		$query = ContactMessages::query();
		$query->where('id', '<', $rec_id);
		$query->orderBy('id', 'desc');
		$record = $query->first(['id']);
		if($record){
			return $record['id'];
		}
		return null;
	}
}
