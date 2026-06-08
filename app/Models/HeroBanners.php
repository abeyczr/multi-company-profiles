<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class HeroBanners extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'hero_banners';
	

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
		'company_id','title','subtitle','button_text','button_link','background_image','status'
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
				hero_banners.title LIKE ?  OR 
				hero_banners.button_text LIKE ?  OR 
				hero_banners.button_link LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%"
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
			"hero_banners.id AS id",
			"hero_banners.company_id AS company_id",
			"company_profiles.company_name AS companyprofiles_company_name",
			"hero_banners.title AS title",
			"hero_banners.button_text AS button_text",
			"hero_banners.button_link AS button_link",
			"hero_banners.status AS status" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"hero_banners.id AS id",
			"hero_banners.company_id AS company_id",
			"company_profiles.company_name AS companyprofiles_company_name",
			"hero_banners.title AS title",
			"hero_banners.button_text AS button_text",
			"hero_banners.button_link AS button_link",
			"hero_banners.status AS status" 
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
			"title",
			"subtitle",
			"button_text",
			"button_link",
			"background_image",
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
			"title",
			"subtitle",
			"button_text",
			"button_link",
			"background_image",
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
			"title",
			"subtitle",
			"button_text",
			"button_link",
			"background_image",
			"status" 
		];
	}
}
