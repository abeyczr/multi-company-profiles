<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Portfolios extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'portfolios';
	

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
		'company_id','category_id','title','description','image','project_year','client_name','status'
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
				portfolios.title LIKE ?  OR 
				portfolios.client_name LIKE ? 
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
			"portfolios.id AS id",
			"portfolios.company_id AS company_id",
			"company_profiles.company_name AS companyprofiles_company_name",
			"portfolios.category_id AS category_id",
			"portfolio_categories.name AS portfoliocategories_name",
			"portfolios.title AS title",
			"portfolios.project_year AS project_year",
			"portfolios.client_name AS client_name",
			"portfolios.status AS status" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"portfolios.id AS id",
			"portfolios.company_id AS company_id",
			"company_profiles.company_name AS companyprofiles_company_name",
			"portfolios.category_id AS category_id",
			"portfolio_categories.name AS portfoliocategories_name",
			"portfolios.title AS title",
			"portfolios.project_year AS project_year",
			"portfolios.client_name AS client_name",
			"portfolios.status AS status" 
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
			"title",
			"description",
			"image",
			"project_year",
			"client_name",
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
			"title",
			"description",
			"image",
			"project_year",
			"client_name",
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
			"title",
			"description",
			"image",
			"project_year",
			"client_name",
			"status" 
		];
	}
}
