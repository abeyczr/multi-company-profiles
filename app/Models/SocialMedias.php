<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class SocialMedias extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'social_medias';
	

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
		'company_id','platform','icon','url','status'
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
				social_medias.platform LIKE ?  OR 
				social_medias.icon LIKE ?  OR 
				social_medias.url LIKE ? 
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
			"social_medias.company_id AS company_id",
			"company_profiles.company_name AS companyprofiles_company_name",
			"social_medias.platform AS platform",
			"social_medias.icon AS icon",
			"social_medias.url AS url",
			"social_medias.status AS status",
			"social_medias.id AS id" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"social_medias.company_id AS company_id",
			"company_profiles.company_name AS companyprofiles_company_name",
			"social_medias.platform AS platform",
			"social_medias.icon AS icon",
			"social_medias.url AS url",
			"social_medias.status AS status",
			"social_medias.id AS id" 
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
			"platform",
			"icon",
			"url",
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
			"platform",
			"icon",
			"url",
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
			"platform",
			"icon",
			"url",
			"status" 
		];
	}
}
