<?php
namespace App\Http\Controllers;

use App\Models\CompanyProfiles;
use App\Models\SeoSettings;
use App\Models\HeroBanners;
use App\Models\Services;
use App\Models\Portfolios;
use App\Models\Teams;
use App\Models\Testimonials;
use App\Models\Blogs;
use App\Models\SocialMedias;
use App\Models\WebsiteSettings;
use App\Models\Galleries; // Tambahan: Import model Galleries
use Illuminate\Http\Request;

class LandingController extends Controller
{
    // Tambahan: Properti untuk mengatasi error "Undefined property...::$layout"
    // Sesuai dengan struktur Anda, ubah 'layouts.app' jika nama file master layout Anda berbeda (misal: 'layouts.master')
    protected $layout = 'layouts.app'; 

    // Public landing index (list of profiles)
    public function index(Request $request)
    {
        return $this->renderView('pages.custom.profiles');
    }

    // Public profile by numeric id
    public function profileById($id)
    {
        $record = CompanyProfiles::where('id', $id)->where('status', 'Aktif')->firstOrFail();
        $seo = SeoSettings::where('company_id', $record->id)->where('status','Aktif')->first();

        // related content
        $hero = HeroBanners::where('company_id', $record->id)->where('status','Aktif')->orderBy('id','asc')->get();
        $services = Services::where('company_id', $record->id)->where('status','Aktif')->orderBy('id','asc')->get();
        $portfolios = Portfolios::where('company_id', $record->id)->where('status','Aktif')->orderBy('id','desc')->get();
        $galleries = Galleries::where('company_id', $record->id)->where('status','Aktif')->orderBy('id','desc')->get(); // Tambahan: Ambil data gallery
        $teams = Teams::where('company_id', $record->id)->where('status','Aktif')->orderBy('id','asc')->get();
        $testimonials = Testimonials::where('company_id', $record->id)->where('status','Aktif')->orderBy('id','asc')->get();
        $blogs = Blogs::where('company_id', $record->id)->where('status','Aktif')->orderBy('published_at','desc')->get();
        $socials = SocialMedias::where('company_id', $record->id)->where('status','Aktif')->orderBy('id','asc')->get();
        $website = WebsiteSettings::where('company_id', $record->id)->where('status','Aktif')->first();

        $counts = [
            'services' => $services->count(),
            'portfolios' => $portfolios->count(),
            'teams' => $teams->count(),
            'testimonials' => $testimonials->count(),
        ];

        return $this->renderView('pages.custom.profile_detail', compact('record','seo','hero','services','portfolios','galleries','teams','testimonials','blogs','socials','website','counts')); // Tambahan: 'galleries'
    }

    // AMP version by id
    public function profileAmpById($id)
    {
        $record = CompanyProfiles::where('id', $id)->where('status', 'Aktif')->firstOrFail();
        $seo = SeoSettings::where('company_id', $record->id)->where('status','Aktif')->first();

        $hero = HeroBanners::where('company_id', $record->id)->where('status','Aktif')->orderBy('id','asc')->get();
        $services = Services::where('company_id', $record->id)->where('status','Aktif')->orderBy('id','asc')->get();
        $portfolios = Portfolios::where('company_id', $record->id)->where('status','Aktif')->orderBy('id','desc')->get();
        $galleries = Galleries::where('company_id', $record->id)->where('status','Aktif')->orderBy('id','desc')->get(); // Tambahan: Ambil data gallery
        $teams = Teams::where('company_id', $record->id)->where('status','Aktif')->orderBy('id','asc')->get();
        $testimonials = Testimonials::where('company_id', $record->id)->where('status','Aktif')->orderBy('id','asc')->get();
        $blogs = Blogs::where('company_id', $record->id)->where('status','Aktif')->orderBy('published_at','desc')->get();
        $socials = SocialMedias::where('company_id', $record->id)->where('status','Aktif')->orderBy('id','asc')->get();
        $website = WebsiteSettings::where('company_id', $record->id)->where('status','Aktif')->first();

        $counts = [
            'services' => $services->count(),
            'portfolios' => $portfolios->count(),
            'teams' => $teams->count(),
            'testimonials' => $testimonials->count(),
        ];

        return view('pages.custom.profile_detail_amp', compact('record','seo','hero','services','portfolios','galleries','teams','testimonials','blogs','socials','website','counts')); // Tambahan: 'galleries'
    }

    // Public profile by slug
    public function profileBySlug($slug)
    {
        $record = CompanyProfiles::where('slug', $slug)->where('status', 'Aktif')->firstOrFail();
        $seo = SeoSettings::where('company_id', $record->id)->where('status','Aktif')->first();

        // related content
        $hero = HeroBanners::where('company_id', $record->id)->where('status','Aktif')->orderBy('id','asc')->get();
        $services = Services::where('company_id', $record->id)->where('status','Aktif')->orderBy('id','asc')->get();
        $portfolios = Portfolios::where('company_id', $record->id)->where('status','Aktif')->orderBy('id','desc')->get();
        $galleries = Galleries::where('company_id', $record->id)->where('status','Aktif')->orderBy('id','desc')->get(); // Tambahan: Ambil data gallery
        $teams = Teams::where('company_id', $record->id)->where('status','Aktif')->orderBy('id','asc')->get();
        $testimonials = Testimonials::where('company_id', $record->id)->where('status','Aktif')->orderBy('id','asc')->get();
        $blogs = Blogs::where('company_id', $record->id)->where('status','Aktif')->orderBy('published_at','desc')->get();
        $socials = SocialMedias::where('company_id', $record->id)->where('status','Aktif')->orderBy('id','asc')->get();
        $website = WebsiteSettings::where('company_id', $record->id)->where('status','Aktif')->first();

        $counts = [
            'services' => $services->count(),
            'portfolios' => $portfolios->count(),
            'teams' => $teams->count(),
            'testimonials' => $testimonials->count(),
        ];

        return $this->renderView('pages.custom.profile_detail', compact('record','seo','hero','services','portfolios','galleries','teams','testimonials','blogs','socials','website','counts')); // Tambahan: 'galleries'
    }

    // AMP version by slug
    public function profileAmpBySlug($slug)
    {
        $record = CompanyProfiles::where('slug', $slug)->where('status', 'Aktif')->firstOrFail();
        $seo = SeoSettings::where('company_id', $record->id)->where('status','Aktif')->first();

        $hero = HeroBanners::where('company_id', $record->id)->where('status','Aktif')->orderBy('id','asc')->get();
        $services = Services::where('company_id', $record->id)->where('status','Aktif')->orderBy('id','asc')->get();
        $portfolios = Portfolios::where('company_id', $record->id)->where('status','Aktif')->orderBy('id','desc')->get();
        $galleries = Galleries::where('company_id', $record->id)->where('status','Aktif')->orderBy('id','desc')->get(); // Tambahan: Ambil data gallery
        $teams = Teams::where('company_id', $record->id)->where('status','Aktif')->orderBy('id','asc')->get();
        $testimonials = Testimonials::where('company_id', $record->id)->where('status','Aktif')->orderBy('id','asc')->get();
        $blogs = Blogs::where('company_id', $record->id)->where('status','Aktif')->orderBy('published_at','desc')->get();
        $socials = SocialMedias::where('company_id', $record->id)->where('status','Aktif')->orderBy('id','asc')->get();
        $website = WebsiteSettings::where('company_id', $record->id)->where('status','Aktif')->first();

        $counts = [
            'services' => $services->count(),
            'portfolios' => $portfolios->count(),
            'teams' => $teams->count(),
            'testimonials' => $testimonials->count(),
        ];

        return view('pages.custom.profile_detail_amp', compact('record','seo','hero','services','portfolios','galleries','teams','testimonials','blogs','socials','website','counts')); // Tambahan: 'galleries'
    }
}