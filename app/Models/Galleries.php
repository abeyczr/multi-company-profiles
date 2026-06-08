<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Galleries extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'galleries';
	

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
		'company_id','category_id','image','caption','status'
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
				galleries.id LIKE ?  OR 
				galleries.caption LIKE ? 
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
			"galleries.id AS id",
			"galleries.company_id AS company_id",
			"company_profiles.company_name AS companyprofiles_company_name",
			"galleries.category_id AS category_id",
			"gallery_categories.name AS gallerycategories_name",
			"galleries.image AS image",
			"galleries.caption AS caption",
			"galleries.status AS status",
			"galleries.created_at AS created_at",
			"galleries.updated_at AS updated_at" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"galleries.id AS id",
			"galleries.company_id AS company_id",
			"company_profiles.company_name AS companyprofiles_company_name",
			"galleries.category_id AS category_id",
			"gallery_categories.name AS gallerycategories_name",
			"galleries.image AS image",
			"galleries.caption AS caption",
			"galleries.status AS status",
			"galleries.created_at AS created_at",
			"galleries.updated_at AS updated_at" 
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
			"category_id",
			"image",
			"caption",
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
			"category_id",
			"image",
			"caption",
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
			"category_id",
			"image",
			"caption",
			"status" 
		];
	}
}
