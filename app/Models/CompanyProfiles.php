<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class CompanyProfiles extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'company_profiles';
	

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
		'company_name','tagline','description','vision','mission','address','phone','email','website','logo','favicon','status'
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
				company_name LIKE ?  OR 
				description LIKE ?  OR 
				phone LIKE ?  OR 
				email LIKE ?  OR 
				website LIKE ? 
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
			"company_name",
			"description",
			"phone",
			"email",
			"website",
			"id" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"company_name",
			"description",
			"phone",
			"email",
			"website",
			"id" 
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
			"company_name",
			"tagline",
			"description",
			"vision",
			"mission",
			"address",
			"phone",
			"email",
			"website",
			"logo",
			"favicon",
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
			"company_name",
			"tagline",
			"description",
			"vision",
			"mission",
			"address",
			"phone",
			"email",
			"website",
			"logo",
			"favicon",
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
			"company_name",
			"tagline",
			"description",
			"vision",
			"mission",
			"address",
			"phone",
			"email",
			"website",
			"logo",
			"favicon",
			"status",
			"id" 
		];
	}
}
