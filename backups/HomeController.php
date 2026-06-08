<?php 

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\CompanyProfiles;
use App\Models\Services;
use App\Models\Portfolios;
use App\Models\Teams;
use App\Models\Testimonials;
use App\Models\Blogs;
use App\Models\ContactMessages;
/**
 * Home Page Controller
 * @category  Controller
 */
class HomeController extends Controller{
	/**
     * Index Action
     * @return \Illuminate\View\View
     */
	function index(){
		$user = auth()->user();

		// counts
		$counts = [
			'companies' => CompanyProfiles::count(),
			'services' => Services::count(),
			'portfolios' => Portfolios::count(),
			'teams' => Teams::count(),
			'testimonials' => Testimonials::count(),
			'blogs' => Blogs::count(),
			'messages_unread' => ContactMessages::where('is_read',0)->count(),
		];

		// recent lists
		$recent_messages = ContactMessages::orderBy('created_at','desc')->limit(6)->get();
		$recent_blogs = Blogs::orderBy('published_at','desc')->limit(6)->get();
		$recent_companies = CompanyProfiles::orderBy('created_at','desc')->limit(6)->get();

		// blogs per last 6 months for chart
		$months = collect();
		$values = collect();
		for($i = 5; $i >= 0; $i--){
			$dt = now()->subMonths($i);
			$label = $dt->format('M Y');
			$months->push($label);
			$count = Blogs::whereYear('published_at', $dt->format('Y'))->whereMonth('published_at', $dt->format('m'))->count();
			$values->push($count);
		}

		return view("pages.home.index", compact('counts','recent_messages','recent_blogs','recent_companies','months','values'));

	}
	
}
