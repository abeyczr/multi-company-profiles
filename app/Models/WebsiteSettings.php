<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class WebsiteSettings extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'website_settings';
	

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
		'company_id','footer_text','maps','google_analytics','whatsapp_number','maintenance_mode','status'
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
				website_settings.footer_text LIKE ?  OR 
				website_settings.whatsapp_number LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%"
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
			"website_settings.company_id AS company_id",
			"company_profiles.company_name AS companyprofiles_company_name",
			"website_settings.footer_text AS footer_text",
			"website_settings.whatsapp_number AS whatsapp_number",
			"website_settings.status AS status",
			"website_settings.created_at AS created_at",
			"website_settings.updated_at AS updated_at",
			"website_settings.id AS id" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"website_settings.company_id AS company_id",
			"company_profiles.company_name AS companyprofiles_company_name",
			"website_settings.footer_text AS footer_text",
			"website_settings.whatsapp_number AS whatsapp_number",
			"website_settings.status AS status",
			"website_settings.created_at AS created_at",
			"website_settings.updated_at AS updated_at",
			"website_settings.id AS id" 
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
			"footer_text",
			"Maps AS maps",
			"google_analytics",
			"whatsapp_number",
			"maintenance_mode",
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
			"footer_text",
			"Maps AS maps",
			"google_analytics",
			"whatsapp_number",
			"maintenance_mode",
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
			"company_id",
			"footer_text",
			"Maps AS maps",
			"google_analytics",
			"whatsapp_number",
			"maintenance_mode",
			"status",
			"id" 
		];
	}
}
