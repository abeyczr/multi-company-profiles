<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Blogs extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'blogs';
	

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
		'company_id','title','slug','thumbnail','content','published_at','status'
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
				blogs.title LIKE ?  OR 
				blogs.content LIKE ? 
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
			"blogs.company_id AS company_id",
			"company_profiles.company_name AS companyprofiles_company_name",
			"blogs.title AS title",
			"blogs.published_at AS published_at",
			"blogs.status AS status",
			"blogs.id AS id",
			"blogs.content AS content" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"blogs.company_id AS company_id",
			"company_profiles.company_name AS companyprofiles_company_name",
			"blogs.title AS title",
			"blogs.published_at AS published_at",
			"blogs.status AS status",
			"blogs.id AS id",
			"blogs.content AS content" 
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
			"slug",
			"thumbnail",
			"content",
			"published_at",
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
			"slug",
			"thumbnail",
			"content",
			"published_at",
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
			"slug",
			"thumbnail",
			"content",
			"published_at",
			"status" 
		];
	}
}
