<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Testimonials extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'testimonials';
	

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
		'company_id','client_name','company_name','photo','rating','testimonial','status'
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
				testimonials.client_name LIKE ?  OR 
				testimonials.company_name LIKE ? 
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
			"testimonials.company_id AS company_id",
			"company_profiles.company_name AS companyprofiles_company_name",
			"testimonials.client_name AS client_name",
			"testimonials.company_name AS company_name",
			"testimonials.rating AS rating",
			"testimonials.id AS id" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"testimonials.company_id AS company_id",
			"company_profiles.company_name AS companyprofiles_company_name",
			"testimonials.client_name AS client_name",
			"testimonials.company_name AS company_name",
			"testimonials.rating AS rating",
			"testimonials.id AS id" 
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
			"client_name",
			"company_name",
			"photo",
			"rating",
			"testimonial",
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
			"client_name",
			"company_name",
			"photo",
			"rating",
			"testimonial",
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
			"client_name",
			"company_name",
			"photo",
			"rating",
			"testimonial",
			"status",
			"id" 
		];
	}
}
