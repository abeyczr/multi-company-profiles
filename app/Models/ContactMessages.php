<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class ContactMessages extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'contact_messages';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'id';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = [
		'company_id','name','email','phone','subject','message','is_read','status'
	];
	public $timestamps = false;
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				contact_messages.name LIKE ?  OR 
				contact_messages.email LIKE ?  OR 
				contact_messages.phone LIKE ?  OR 
				contact_messages.subject LIKE ?  OR 
				contact_messages.message LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%","%$text%"
		];
		//setting search conditions
		$query->whereRaw($search_condition, $search_params);
	}
	

	/**
     * return list page fields of the model.
     * 
     * @return array
     */
	public static function listFields(){
		return [ 
			"contact_messages.company_id AS company_id",
			"company_profiles.company_name AS companyprofiles_company_name",
			"contact_messages.name AS name",
			"contact_messages.email AS email",
			"contact_messages.phone AS phone",
			"contact_messages.subject AS subject",
			"contact_messages.message AS message",
			"contact_messages.id AS id" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"contact_messages.company_id AS company_id",
			"company_profiles.company_name AS companyprofiles_company_name",
			"contact_messages.name AS name",
			"contact_messages.email AS email",
			"contact_messages.phone AS phone",
			"contact_messages.subject AS subject",
			"contact_messages.message AS message",
			"contact_messages.id AS id" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"id",
			"company_id",
			"name",
			"email",
			"phone",
			"subject",
			"message",
			"is_read",
			"status",
			"created_at",
			"updated_at" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"id",
			"company_id",
			"name",
			"email",
			"phone",
			"subject",
			"message",
			"is_read",
			"status",
			"created_at",
			"updated_at" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"id",
			"company_id",
			"name",
			"email",
			"phone",
			"subject",
			"message",
			"is_read",
			"status" 
		];
	}
}
