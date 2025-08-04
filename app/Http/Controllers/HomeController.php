<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brands;
use App\Models\Brandimages;
use App\Models\Brandpdfs;
use App\Models\Countries;
use App\Models\admin\Projects;
use App\Models\admin\Products;
use App\Models\admin\Enquiry;
use App\Models\admin\ProjectImages;
use App\Models\admin\ProductImages;
use App\Models\admin\Certificates;
use App\Models\admin\Blogs;
use App\Models\Videos;
use App\Models\Contacts;
use App\Models\admin\Subscribes;
use App\Models\Enquires;
use App\Models\admin\OurMilestones;
use Illuminate\Support\Facades\Response;
use App\Models\admin\Cmspages;
use App\Models\Categories;
use App\Models\admin\Categories_lookups;
use App\Models\admin\Catalogues;
use App\Models\admin\download_catalogues;
use App\Models\admin\FAQ;
use App\Models\admin\Testimonials;
use App\Models\admin\Events;
use App\Models\admin\EventImages;
use App\Models\admin\BranchAddress;
use App\Models\admin\DealerAddress;
use App\Models\admin\Adbanners;
use DB;
use App;
use File;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\CommonController;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    //  $this->middleware('auth');
  }


  public function index()
  {

    if (session()->has('locale') && session()->get('locale') != 'en') {
      $branch = app()->getLocale() . '_branch';
      $branch_heading = app()->getLocale() . '_branch_heading';
      $branch_address = app()->getLocale() . '_branch_address';
      $title = app()->getLocale() . '_title';
      $city_state_name = app()->getLocale() . '_city_state_name';
      $products = app()->getLocale() . '_products';
      $occupation = app()->getLocale() . '_occupation';
      $name = app()->getLocale() . '_name';
      $designation_company = app()->getLocale() . '_designation_company';
      $description = app()->getLocale() . '_description';
      $blog_title = app()->getLocale() . '_blog_title';
      $blog_content = app()->getLocale() . '_blog_content';
      $tags = app()->getLocale() . '_tags';
      $page_title = app()->getLocale() . '_page_title';
      $meta_keywords = app()->getLocale() . '_meta_keywords';
      $meta_description = app()->getLocale() . '_meta_description';
    } else {
      $branch = 'branch';
      $branch_heading = 'branch_heading';
      $branch_address = 'branch_address';
      $title = 'title';
      $city_state_name = 'city_state_name';
      $products = 'products';
      $occupation = 'occupation';
      $name = 'name';
      $designation_company = 'designation_company';
      $description = 'description';
      $blog_title = 'blog_title';
      $blog_content = 'blog_content';
      $tags = 'tags';
      $page_title = 'page_title';
      $meta_keywords = 'meta_keywords';
      $meta_description = 'meta_description';
    }


    //exit;
    $pages = Cmspages::where('status', 1)->where('is_deleted', 0)->get();
    $Blogs = Blogs::select('id', 'category_id', 'post_author', 'blog_order', 'blog_url', 'banner_image', "$blog_title as blog_title", "$blog_content as blog_content", "$tags as tags", "$page_title as page_title", "$meta_keywords as meta_keywords", "$meta_description as meta_description", "is_published", "thumb_image", "publish_date", "is_banner", "is_popular", "is_deleted", 'created_at')
      ->where('status', 1)->where('is_deleted', 0)->orderby('id', 'desc')->take(3)->get();
    $Testimonials = Testimonials::select('id', "$occupation as occupation", 'thumnail', "$name as name", 'video_url', 'video_thumb', 'type', "$designation_company as designation_company", "$description as description", 'status')
      ->where('status', 1)->where('type', 1)->take(3)->get();
    $Products = Products::select('id', 'image', "$title as title", 'features', 'product_url')
      ->where('is_master_pro', 1)->where('status', 1)->take(5)->orderby('id', 'desc')->get();

    $Projects = Projects::select('id', 'category_id', 'image', "$title as title", 'project_summary', 'banner_image', 'url', "$city_state_name as city_state_name", "$products as products", "$tags as tags", 'description')
      ->where('is_home', 1)->where('status', 1)->take(6)->orderby('id', 'desc')->get();

    $latitude_longitude = BranchAddress::select('latitude AS lat', 'longitude AS lng')->where('status', 1)->get();
    $markerData = BranchAddress::select("$branch_heading as branch_heading", 'branch_number', 'branch_email', "$branch_address as branch_address", 'branch_image')->where('status', 1)->get();

    $Adbanners = Adbanners::where('status', 1)->inRandomOrder()->take(1)->get();

    if (session()->has('locale') && session()->get('locale') != 'en') {
      return view('frontend.home', compact('pages', 'Blogs', 'Testimonials', 'Products', 'Projects', 'latitude_longitude', 'markerData', 'Adbanners'));
    } else {
      return view('frontend.home', compact('pages', 'Blogs', 'Testimonials', 'Products', 'Projects', 'latitude_longitude', 'markerData', 'Adbanners'));
    }


  }


  public function projects()
  {
    $projects = Projects::where('status', 1)->orderBy('id', 'desc')->get();

    if (session()->has('locale') && session()->get('locale') != 'en') {
      return view('frontend.our_projects', compact('projects'));
    } else {
      return view('frontend.our_projects', compact('projects'));
    }
  }

  //Contact Form
  public function save_Contact(Request $request)
  {
    $request->validate([
      'name' => 'required|string',
      'contact' => 'required|digits:10|numeric',
      'email' => 'required|email',
      'subject' => 'required|string',
      'city' => 'required|string',
      'firmname' => 'string',
      'message' => 'required|regex:/^[a-zA-Z0-9 ]+$/'
    ]);

    $obj = new Contacts;
    $obj->name = $request->name;
    $obj->contact = $request->contact;
    $obj->email = $request->email;
    $obj->subject = $request->subject;
    $obj->city = $request->city;
    $obj->firm_name = $request->firmname;
    $obj->message = $request->message;
    $obj->save();

    //return redirect()->back()->with('success','Thanks For Contact us!!!');
    $data = [
      'name' => $request->name,
      'contact' => $request->contact,
      'email' => $request->email,
      'subject' => $request->subject,
      'city' => $request->city,
      'firm_name' => $request->firmname,
      'message' => $request->message,

    ];

    Mail::send('mails.contact_us', ['data' => $data], function ($message) use ($data) {
      $message->from('info@vivaacp.com', 'VIVA ACP');
      $message->subject($data['subject']);
      $message->to('mayank@vivaacp.com', 'Mayank Jain');
      $message->cc('mayankj81@gmail.com');
      $message->cc('branding@vivaacp.com', 'Prathamesh Nilakhe');
      $message->cc('branding2@vivaacp.com', 'Rupali R Suvarna');
      $message->cc('crm2@vivaacp.com', 'Priyanka Dakua');
      $message->cc('info@vivaacp.com', 'Viva Info');
      $message->cc('branding.digital@vivaacp.com', 'Amrita Gandhi');
      $message->cc('crm@vivaacp.com', 'Aliya Sayyed');
      $message->cc('operations@abcdesigns.in', 'Operation ABC');
      $message->bcc('zakir@abcdesigns.in');

    });

    return redirect('/thanks');
  }

  //Enquires Form

  public function save_Enquires(Request $request)
  {
    $request->validate([
      'ename' => 'required|string',
      'phone' => 'required|digits:10|numeric',
      'e_email' => 'required|email',
      'city_country' => 'required|string',
      'requirement' => 'numeric',
      'emessage' => 'required|regex:/^[a-zA-Z0-9 ]+$/'
    ]);

    $obj = new Enquires;
    $obj->name = $request->ename;
    $obj->contact = $request->phone;
    $obj->email = $request->e_email;
    $obj->city_country = $request->city_country;
    $obj->requirement = $request->requirement;
    $obj->message = $request->emessage;
    $obj->save();

    //return redirect()->back()->with('success','Will Connect You Soon!!!');

    $data = [
      'name' => $request->ename,
      'contact' => $request->phone,
      'email' => $request->e_email,
      'subject' => 'Popup Enquiry from vivaacp.com',
      'city_country' => $request->city_country,
      'requirement' => $request->requirement,
      'message' => $request->emessage,

    ];

    Mail::send('mails.popup_enquiry', ['data' => $data], function ($message) use ($data) {
      $message->from('info@vivaacp.com', 'VIVA ACP');
      $message->subject($data['subject']);
      $message->to('mayank@vivaacp.com', 'Mayank Jain');
      $message->cc('mayankj81@gmail.com');
      $message->cc('branding@vivaacp.com', 'Prathamesh Nilakhe');
      $message->cc('branding2@vivaacp.com', 'Rupali R Suvarna');
      $message->cc('crm2@vivaacp.com', 'Priyanka Dakua');
      $message->cc('info@vivaacp.com', 'Viva Info');
      $message->cc('branding.digital@vivaacp.com', 'Amrita Gandhi');
      $message->cc('crm@vivaacp.com', 'Aliya Sayyed');
      $message->cc('operations@abcdesigns.in', 'Operation ABC');
      $message->bcc('zakir@abcdesigns.in');

    });

    return redirect('/thanks');
  }

  // Design Serve
  public function DesignServeStore(Request $request)
  {
    ini_set('memory_limit', '3072M');
    ini_set('max_execution_time', 10080);
    ini_set('upload_max_filesize', '5M');

    $rnd = rand();
    $extension = $request->file_input->getClientOriginalExtension();
    $file = $request->file('file_input');
    if ($extension == "pdf" || $extension == "docx") {
      $title_img = 'design_serve' . '_' . $rnd . '.' . $extension;
      $path_img = '/img/support/design_serve' . '_' . $rnd . '.' . $extension;
      $path = public_path() . '/img/support/';
      $file->move($path, $title_img);
    } else {
      $title_img = 'design_serve' . '_' . $rnd . '.jpg';
      $path_img = '/img/support/design_serve' . '_' . $rnd . '.jpg';
      $path = public_path() . '/img/support/';
      $file->move($path, $title_img);
    }

    DB::table('design_serves')->insert(
      [
        'name' => $request->name,
        'address' => $request->address,
        'email' => $request->email,
        'state' => $request->state,
        'phone_number' => $request->phone_number,
        'city' => $request->city,
        'project_name' => $request->project_name,
        'project_city' => $request->project_city,
        'project_description' => $request->project_description,
        'project_sq_ft' => $request->project_sq_ft,
        'project_details' => $request->project_details,
        'uploads' => $path_img,
        'created_at' => now()
      ]
    );

    //return redirect()->back()->with('success','Will Connect You Soon!!!');
    return redirect('/thanks');
  }

  // FAQ Index
  public function index_faq()
  {
    if (session()->has('locale') && session()->get('locale') != 'en') {
      $question = app()->getLocale() . '_question';
      $answer = app()->getLocale() . '_answer';
    } else {
      $question = 'question';
      $answer = 'answer';
    }

    $faqData = FAQ::select('id', "$question as question", "$answer as answer")->where('status', 1)->get();

    if (session()->has('locale') && session()->get('locale') != 'en') {
      return view('frontend.knowledge_center.faq', compact('faqData'));
    } else {
      return view('frontend.knowledge_center.faq', compact('faqData'));
    }
  }


  // Support Index
  public function catalogue_index()
  {
    $Catalogues = Catalogues::where('status', 1)->get();
    if (session()->has('locale') && session()->get('locale') != 'en') {
      return view('frontend.support.catalogues', compact('Catalogues'));
    } else {
      return view('frontend.support.catalogues', compact('Catalogues'));
    }
  }

  public function downloadCatalogue(Request $request)
  {
    $PDF_Path = public_path() . '/img/catalogue/PDF/' . $request->pdf_file;
    if (File::exists($PDF_Path)) {
      $obj = new download_catalogues();
      $obj->name = $request->name;
      $obj->contact = $request->contact;
      $obj->email = $request->email;
      $obj->pdf_file = $request->pdf_file;
      $obj->is_download = 1;
      $obj->save();
      return Response::download($PDF_Path);
    } else {
      return redirect()->back();
    }
  }

  public function ViewPDF($file)
  {
    $PDF_Path = public_path() . '/img/catalogue/PDF/' . $file;
    if (File::exists($PDF_Path)) {
      return response()->file($PDF_Path);
    } else {
      return response()->file(public_path('admin/img/no_img_lg.jpg'));
    }
  }

  //About Certificate Download
  public function downloadCertificate($pdf_file)
  {
    $PDF_Path = public_path('img/about/test_certificate/' . $pdf_file);
    if (File::exists($PDF_Path)) {
      return response()->download($PDF_Path)->back();
    } else {
      return redirect()->back();
    }
  }

  //Project Index
  public function project_index()
  {
    if (session()->has('locale') && session()->get('locale') != 'en') {
      $title = app()->getLocale() . '_title';
      $city_state_name = app()->getLocale() . '_city_state_name';
      $products = app()->getLocale() . '_products';
      $tags = app()->getLocale() . '_tags';
      $description = app()->getLocale() . '_description';

    } else {
      $title = 'title';
      $city_state_name = 'city_state_name';
      $products = 'products';
      $tags = 'tags';
      $description = 'description';

    }

    $Projects = Projects::select('id', 'category_id', 'project_order', 'direction', 'image', "$title as title", 'project_summary', 'banner_image', 'url', "$city_state_name as city_state_name", "$products as products", "$tags as tags", "$description as description")->orderby('project_order', 'asc')->where('status', 1)->take(10)->get();
    $AllCount = Projects::count();
    $EastCount = Projects::where('direction', 'east')->where('status', 1)->count();
    $WestCount = Projects::where('direction', 'west')->where('status', 1)->count();
    $NorthCount = Projects::where('direction', 'north')->where('status', 1)->count();
    $SouthCount = Projects::where('direction', 'south')->where('status', 1)->count();
    if (session()->has('locale') && session()->get('locale') != 'en') {
      return view('frontend.project.index', compact('Projects', 'AllCount', 'EastCount', 'WestCount', 'NorthCount', 'SouthCount'));
    } else {
      return view('frontend.project.index', compact('Projects', 'AllCount', 'EastCount', 'WestCount', 'NorthCount', 'SouthCount'));
    }
  }

  public function project_view($url)
  {
    if (session()->has('locale') && session()->get('locale') != 'en') {
      $title = app()->getLocale() . '_title';
      $city_state_name = app()->getLocale() . '_city_state_name';
      $products = app()->getLocale() . '_products';
      $tags = app()->getLocale() . '_tags';
      $description = app()->getLocale() . '_description';

    } else {
      $title = 'title';
      $city_state_name = 'city_state_name';
      $products = 'products';
      $tags = 'tags';
      $description = 'description';

    }
    $Projectdetails = Projects::select(
      'projects.id',
      'projects.banner_image',
      "projects.$title as title",
      'projects.image',
      'projects.url',
      "projects.$city_state_name as city_state_name",
      'projects.video_title',
      'projects.video_type',
      'projects.video_url',
      "projects.$products as products",
      "projects.$tags as tags",
      "projects.$description as description",
      'projects.status'
    )
      ->where('projects.url', $url)->where('status', 1)->first();

    $ProjectImages = ProjectImages::select('id', 'urls')->where('project_id', $Projectdetails->id)->get();
    if (session()->has('locale') && session()->get('locale') != 'en') {
      return view('frontend.project.view', compact('Projectdetails', 'ProjectImages'));
    } else {
      return view('frontend.project.view', compact('Projectdetails', 'ProjectImages'));
    }
  }

  public function projectLoadMore(Request $request)
  {

    if (session()->has('locale') && session()->get('locale') != 'en') {
      $title = app()->getLocale() . '_title';
      $city_state_name = app()->getLocale() . '_city_state_name';
      $products = app()->getLocale() . '_products';
      $tags = app()->getLocale() . '_tags';
      $description = app()->getLocale() . '_description';

    } else {
      $title = 'title';
      $city_state_name = 'city_state_name';
      $products = 'products';
      $tags = 'tags';
      $description = 'description';

    }

    if ($request->filterby == "*") {
      $Projects = Projects::select('id', 'category_id', 'project_order', 'direction', 'image', "$title as title", 'project_summary', 'banner_image', 'url', "$city_state_name as city_state_name", "$products as products", "$tags as tags", "$description as description")->where('project_order', '>', $request->last_load)
        ->orderby('project_order', 'asc')->where('status', 1)->take(6)->get();
    } else {
      $Projects = Projects::select('id', 'category_id', 'project_order', 'direction', 'image', "$title as title", 'project_summary', 'banner_image', 'url', "$city_state_name as city_state_name", "$products as products", "$tags as tags", "$description as description")->where('project_order', '>', $request->last_load)
        ->where('direction', '=', $request->filterby)
        ->orderby('project_order', 'asc')->where('status', 1)->take(6)->get();
    }

    // return json_encode($Projects);
    return view('frontend.project.fetch_load', compact('Projects'));
  }

  public function projectFilterBy(Request $request)
  {
    if (session()->has('locale') && session()->get('locale') != 'en') {
      $title = app()->getLocale() . '_title';
      $city_state_name = app()->getLocale() . '_city_state_name';
      $products = app()->getLocale() . '_products';
      $tags = app()->getLocale() . '_tags';
      $description = app()->getLocale() . '_description';
    } else {
      $title = 'title';
      $city_state_name = 'city_state_name';
      $products = 'products';
      $tags = 'tags';
      $description = 'description';
    }

    $result = Projects::select('id', 'category_id', 'project_order', 'direction', 'image', "$title as title", 'project_summary', 'banner_image', 'url', "$city_state_name as city_state_name", "$products as products", "$tags as tags", "$description as description");
    if ($request->filterby != "*") {
      $result->where('direction', '=', $request->filterby);
    }
    $Projects = $result->orderby('project_order', 'asc')->where('status', 1)->get();

    return view('frontend.project.fetch_load', compact('Projects'));
  }


  //Product index ALL
  public function product_index_all()
  {
    if (session()->has('locale') && session()->get('locale') != 'en') {
      $name = app()->getLocale() . '_name';
      $description = app()->getLocale() . '_description';
      $title = app()->getLocale() . '_title';

    } else {
      $name = 'name';
      $description = 'description';
      $title = 'title';
    }

    $Categories = Categories::where('status', 1)->where('type', 1)->orderby('name', 'asc')->get();
    $categorydetail = null;
    $CategoryId = null;
    $Products = Products::select('id', 'category_id', 'product_url', 'image', "$title as title")->where('status', 1)->orderby('title', 'asc')->get();


    if (session()->has('locale') && session()->get('locale') != 'en') {
      return view('frontend.products.shadesseries', compact('Categories', 'Products', 'categorydetail', 'CategoryId'));
    } else {
      return view('frontend.products.shadesseries', compact('Categories', 'Products', 'categorydetail', 'CategoryId'));
    }
  }


  //Product index
  public function product_index($cid)
  {
    if (session()->has('locale') && session()->get('locale') != 'en') {
      $name = app()->getLocale() . '_name';
      $description = app()->getLocale() . '_description';
      $title = app()->getLocale() . '_title';

    } else {
      $name = 'name';
      $description = 'description';
      $title = 'title';
    }

    // $CategoryId = base64_decode($cid);
    $seourl = $cid;

    $categorydetail = Categories::select('id', "$name as name", "$description as description", 'seourl')->where('seourl', $seourl)
      ->where('type', 1)->where('status', 1)->first();
    $CategoryId = $categorydetail->id;

    $Categories = Categories::where('status', 1)->where('type', 1)->orderby('name', 'asc')->get();

    $Products = Products::select('id', 'category_id', 'product_url', 'image', "$title as title")->where('status', 1)
      ->where('category_id', $CategoryId)->orderby('title', 'asc')->get();

    if (count($Products) == 0) {
      $Categories_all = Categories_lookups::where('category_id', $CategoryId)->get();
      $all_ctg_main = array();

      foreach ($Categories_all as $ctg_luk) {
        $all_ctg_main[] = $ctg_luk->categry_lookup;
      }

      $Products = Products::select('id', 'category_id', 'product_url', 'image', "$title as title")->where('status', 1)
        ->WhereIn('category_id', $all_ctg_main)->orderby('title', 'asc')->get();

    }



    if (session()->has('locale') && session()->get('locale') != 'en') {
      return view('frontend.products.shadesseries', compact('Categories', 'Products', 'categorydetail', 'CategoryId'));
    } else {
      return view('frontend.products.shadesseries', compact('Categories', 'Products', 'categorydetail', 'CategoryId'));
    }
  }

  public function product_details($product_url)
  {
    if (session()->has('locale') && session()->get('locale') != 'en') {
      $title = app()->getLocale() . '_title';
      $features = app()->getLocale() . '_features';
      $properties = app()->getLocale() . '_properties';
      $application = app()->getLocale() . '_application';
      $tags = app()->getLocale() . '_tags';
      $project_tags = app()->getLocale() . '_project_tags';
      $description = app()->getLocale() . '_description';

    } else {
      $title = 'title';
      $features = 'features';
      $properties = 'properties';
      $application = 'application';
      $tags = 'tags';
      $project_tags = 'project_tags';
      $description = 'description';

    }

    $product_details = Products::select('id', 'category_id', 'product_url', 'image', 'panel_size', 'thickness', 'core', 'coil_thickness', 'sku', "$title as title", "$features as features", "$properties as properties", "$application as application", "$tags as tags", "$project_tags as project_tags", "$description as description")->where('product_url', $product_url)->first();
    $ProductImages = ProductImages::select('id', 'urls')->where('product_id', $product_details->id)->get();
    $RelatedProducts = Products::select('id', "$title as title", "product_url", "image", )->where('category_id', $product_details->category_id)->get();

    if (session()->has('locale') && session()->get('locale') != 'en') {
      return view('frontend.products.seriesinnerpage', compact('product_details', 'ProductImages', 'RelatedProducts'));
    } else {
      return view('frontend.products.seriesinnerpage', compact('product_details', 'ProductImages', 'RelatedProducts'));
    }

  }

  // Blog Index
  public function blog_index()
  {
    if (session()->has('locale') && session()->get('locale') != 'en') {
      $blog_title = app()->getLocale() . '_blog_title';
      $blog_content = app()->getLocale() . '_blog_content';
      $tags = app()->getLocale() . '_tags';
      $page_title = app()->getLocale() . '_page_title';
      $meta_keywords = app()->getLocale() . '_meta_keywords';
      $meta_description = app()->getLocale() . '_meta_description';
    } else {
      $blog_title = 'blog_title';
      $blog_content = 'blog_content';
      $tags = 'tags';
      $page_title = 'page_title';
      $meta_keywords = 'meta_keywords';
      $meta_description = 'meta_description';
    }

    if (isset($_GET['year'])) {
      $Blogs = Blogs::select('id', 'category_id', 'post_author', 'blog_order', 'blog_url', 'banner_image', "$blog_title as blog_title", "$tags as tags", "is_published", "thumb_image", "publish_date", "is_banner", "is_popular", "is_deleted", 'created_at', 'publish_date')->
        orderby('id', 'desc')
        ->where('publish_date', 'like', '%' . $_GET['year'] . '%')
        ->where('is_deleted', 0)->paginate(12)->withQueryString();
    } else if (isset($_GET['category'])) {
      $Blogs = Blogs::select('id', 'category_id', 'post_author', 'blog_order', 'blog_url', 'banner_image', "$blog_title as blog_title", "$tags as tags", "is_published", "thumb_image", "publish_date", "is_banner", "is_popular", "is_deleted", 'created_at', 'publish_date')->
        orderby('id', 'desc')
        ->where('category_id', $_GET['category'])
        ->where('is_deleted', 0)->paginate(12)->withQueryString();
    } else {
      $Blogs = Blogs::select('id', 'category_id', 'post_author', 'blog_order', 'blog_url', 'banner_image', "$blog_title as blog_title", "$tags as tags", "is_published", "thumb_image", "publish_date", "is_banner", "is_popular", "is_deleted", 'created_at', 'publish_date')->
        orderby('id', 'desc')
        ->where('is_deleted', 0)->paginate(12);
    }

    $BannerBlogs = Blogs::select('id', 'category_id', 'post_author', 'blog_order', 'blog_url', 'banner_image', "$blog_title as blog_title", "$tags as tags", "is_published", "thumb_image", "publish_date", "is_banner", "is_popular", "is_deleted", 'created_at', 'publish_date')->orderby('blog_order', 'asc')
      ->where('is_banner', 1)->where('is_deleted', 0)->get();

    $Popular_blogs = Blogs::select('id', 'blog_url', 'banner_image', "$blog_title as blog_title", 'created_at')
      ->where('is_popular', 1)->where('is_deleted', 0)->take(3)->orderby('id', 'desc')->get();

    if (session()->has('locale') && session()->get('locale') != 'en') {
      return view('frontend.blog.index', compact('Blogs', 'BannerBlogs', 'Popular_blogs'))->render();
    } else {
      return view('frontend.blog.index', compact('Blogs', 'BannerBlogs', 'Popular_blogs'))->render();
    }
  }

  public function blog_view($url)
  {

    if ($url == 'contact-us') {
      return view('frontend.contactus.contact_us');
    } else if ($url == 'thanks') {
      return view('frontend.thanks');
    } else if ($url == '404') {
      return view('frontend.404');
    } else if ($url == 'career') {
      return view('frontend.career.index');
    } else if ($url == 'privacy-policy') {
      return view('frontend.privacy_policy');
    } else if ($url == 'terms-and-conditions') {
      return view('frontend.terms_policy');
    } else {
      if (session()->has('locale') && session()->get('locale') != 'en') {
        $blog_title = app()->getLocale() . '_blog_title';
        $blog_content = app()->getLocale() . '_blog_content';
        $tags = app()->getLocale() . '_tags';
        $page_title = app()->getLocale() . '_page_title';
        $meta_keywords = app()->getLocale() . '_meta_keywords';
        $meta_description = app()->getLocale() . '_meta_description';
      } else {
        $blog_title = 'blog_title';
        $blog_content = 'blog_content';
        $tags = 'tags';
        $page_title = 'page_title';
        $meta_keywords = 'meta_keywords';
        $meta_description = 'meta_description';
      }

      $Blogdetails = Blogs::select('id', 'category_id', 'post_author', 'blog_order', 'blog_url', 'banner_image', "$blog_title as blog_title", "$blog_content as blog_content", "$tags as tags", "$page_title as page_title", "$meta_keywords as meta_keywords", "$meta_description as meta_description", "is_published", "thumb_image", "publish_date", "is_banner", "is_popular", "is_deleted", 'created_at')->where('blog_url', $url)->first();

      $Popular_blogs = Blogs::select('id', 'blog_url', 'banner_image', "$blog_title as blog_title", 'created_at')
        ->take(3)->orderby('id', 'desc')->get();
      if (session()->has('locale') && session()->get('locale') != 'en') {
        return view('frontend.blog.view', compact('Blogdetails', 'Popular_blogs'));
      } else {
        return view('frontend.blog.view', compact('Blogdetails', 'Popular_blogs'));
      }

    }
  }

  public function blogLoadMore(Request $request)
  {
    $Blogs = Blogs::where('id', '<', $request->last_load)->take(2)->get();
    if (session()->has('locale') && session()->get('locale') != 'en') {
      return view('frontend.blog.fetch_load', compact('Blogs'));
    } else {
      return view('frontend.blog.fetch_load', compact('Blogs'));
    }
    // return response()->json($Blogs);
  }

  // Test_certificate_view
  public function Test_certificate_view()
  {
    $Certificates = Certificates::where('status', 1)->get();

    $AllCount = Certificates::count();
    $automotiveResearchCount = Certificates::where('certificate_assigned_by', 'automotive_research')->count();
    $indianInstituteCount = Certificates::where('certificate_assigned_by', 'indian_institute')->count();
    $isoCount = Certificates::where('certificate_assigned_by', 'iso')->count();
    $thomasBellCount = Certificates::where('certificate_assigned_by', 'thomas_bell')->count();
    $technicalCataCount = Certificates::where('certificate_assigned_by', 'technical_data')->count();
    $IGBC_count = Certificates::where('certificate_assigned_by', 'IGBC')->count();

    if (session()->has('locale') && session()->get('locale') != 'en') {
      return view('frontend.about.test_certificate', compact('Certificates', 'AllCount', 'automotiveResearchCount', 'indianInstituteCount', 'isoCount', 'thomasBellCount', 'technicalCataCount', 'IGBC_count'));
    } else {
      return view('frontend.about.test_certificate', compact('Certificates', 'AllCount', 'automotiveResearchCount', 'indianInstituteCount', 'isoCount', 'thomasBellCount', 'technicalCataCount', 'IGBC_count'));
    }
  }
  //TestimonialsView 
  public function TestimonialsView()
  {
    if (session()->has('locale') && session()->get('locale') != 'en') {
      $occupation = app()->getLocale() . '_occupation';
      $name = app()->getLocale() . '_name';
      $designation_company = app()->getLocale() . '_designation_company';
      $description = app()->getLocale() . '_description';
    } else {
      $occupation = 'occupation';
      $name = 'name';
      $designation_company = 'designation_company';
      $description = 'description';
    }

    $Text_testimonial = Testimonials::select('id', "$occupation as occupation", 'thumnail', "$name as name", 'video_url', 'video_thumb', 'type', "$designation_company as designation_company", "$description as description", 'status')
      ->where('status', 1)->where('type', 1)->get();
    $Video_testimonial = Testimonials::select('id', "$occupation as occupation", 'thumnail', "$name as name", 'video_url', 'video_thumb', 'type', "$designation_company as designation_company", "$description as description", 'status')
      ->where('status', 1)->where('type', 2)->get();

    $Text_count = Testimonials::where('status', 1)->where('type', 1)->count();
    $Video_count = Testimonials::where('status', 1)->where('type', 2)->count();

    if (session()->has('locale') && session()->get('locale') != 'en') {
      return view('frontend.about.testimonials', compact('Text_testimonial', 'Video_testimonial', 'Text_count', 'Video_count'));
    } else {
      return view('frontend.about.testimonials', compact('Text_testimonial', 'Video_testimonial', 'Text_count', 'Video_count'));
    }
  }

  //video gallery view
  public function VideoGalleryView()
  {
    $Videos = Videos::where('status', 1)->get();
    $videocount = Videos::where('status', 1)->count();

    if (session()->has('locale') && session()->get('locale') != 'en') {
      return view('frontend.project.videogallery', compact('Videos', 'videocount'));
    } else {
      return view('frontend.project.videogallery', compact('Videos', 'videocount'));
    }
  }

  //Event Gallery View
  public function EventIndex()
  {
    $Events = Events::select('id', 'name')->where('status', 1)->get();
    $EventImages = EventImages::select('id', 'event_id', 'images')->where('status', 1)->take(10)->get();


    if (session()->has('locale') && session()->get('locale') != 'en') {
      return view('frontend.blog.eventgallery', compact('Events', 'EventImages'));
    } else {
      return view('frontend.blog.eventgallery', compact('Events', 'EventImages'));
    }
  }


  public function EventgalleryLoad(Request $request)
  {
    $filterby = str_replace(".category-", "", $request->filterby);

    $result = EventImages::select('id', 'event_id', 'images')->where('status', 1)
      ->where('id', '>', $request->last_load);
    if ($filterby !== "*") {
      $result->where('event_id', '=', $filterby);
    }
    $EventImages = $result->take(5)->get();
    return view('frontend.blog.eventgallery_load', compact('EventImages'));
  }

  public function EventgalleryFilterBy(Request $request)
  {
    $filterby = str_replace(".category-", "", $request->filterby);
    if (isset($filterby) && $filterby !== "*") {
      $EventImages = EventImages::select('id', 'event_id', 'images')->where('status', 1)
        ->where('event_id', '=', $filterby)->take(4)->get();
    }
    return view('frontend.blog.eventgallery_load', compact('EventImages'));
  }


  //Our Milestone View
  public function OurMilestoneIndex()
  {
    $OurMilestones = OurMilestones::select('id', 'image_url', 'timeline_year', 'timeline_title', 'timeline_text')->where('status', 1)->get();

    if (session()->has('locale') && session()->get('locale') != 'en') {
      return view('frontend.about.our_milestone', compact('OurMilestones'));
    } else {
      return view('frontend.about.our_milestone', compact('OurMilestones'));
    }
  }

  //Newsletter
  public function NewsletterSubscribe(Request $request)
  {
    $request->validate([
      'email' => 'required|email',
    ]);
    Subscribes::insert(['email' => $request->email, 'activity' => $request->agree_tc, 'created_at' => now()]);
    return true;
  }


  //Dealer_Address_Index
  public function Dealer_Address_Index()
  {
    /*   if (session()->has('locale') && session()->get('locale')!='en'){
         $branch = app()->getLocale().'_branch';
         $branch_heading = app()->getLocale().'_branch_heading';
         $branch_address = app()->getLocale().'_branch_address';
         $direction = app()->getLocale().'_direction';  
       }else {
           $branch = 'branch';
           $branch_heading = 'branch_heading';
           $branch_address = 'branch_address';
           $direction = 'direction';
       } */

    $states = 'states';
    $firm_name = 'firm_name';
    $address = 'address';
    $direction = 'direction';
    $dealer_distrbutr = 'dealer_distrbutr';
    $concern_person = 'concern_person';

    $NorthBranch1 = DealerAddress::select('id', "$direction as direction", "$states as states")->where('direction', 'North')->where('status', 1)->orderBy('states', 'ASC')->get();
    $NorthBranch = $NorthBranch1->unique('states');

    $SouthBranch1 = DealerAddress::select('id', "$direction as direction", "$states as states")->where('direction', 'South')->where('status', 1)->orderBy('states', 'ASC')->get();
    $SouthBranch = $SouthBranch1->unique('states');

    $WestBranch1 = DealerAddress::select('id', "$direction as direction", "$states as states")->where('direction', 'West')->where('status', 1)->orderBy('states', 'ASC')->get();
    $WestBranch = $WestBranch1->unique('states');

    $EastBranch1 = DealerAddress::select('id', "$direction as direction", "$states as states")->where('direction', 'East')->where('status', 1)->orderBy('states', 'ASC')->get();
    $EastBranch = $EastBranch1->unique('states');

    $IntBranch1 = DealerAddress::select('id', "$direction as direction", "$states as states")->where('direction', 'International')->where('status', 1)->orderBy('states', 'ASC')->get();
    $IntBranch = $IntBranch1->unique('states');

    $ResultArray = DealerAddress::select('id', "$direction as direction")->where('status', 1)->get();

    $latitude_longitude = DealerAddress::select('latitude AS lat', 'longitude AS lng')->where('status', 1)->get();

    $markerData = DealerAddress::select("$firm_name as firm_name", 'contact', 'email', "$address as address", "$dealer_distrbutr as dealer_distrbutr", "$concern_person as concern_person")->where('status', 1)->get();

    if (session()->has('locale') && session()->get('locale') != 'en') {
      return view('frontend.contactus.dealers_address', compact('NorthBranch', 'SouthBranch', 'WestBranch', 'EastBranch', 'IntBranch', 'ResultArray', 'latitude_longitude', 'markerData'));
    } else {
      return view('frontend.contactus.dealers_address', compact('NorthBranch', 'SouthBranch', 'WestBranch', 'EastBranch', 'IntBranch', 'ResultArray', 'latitude_longitude', 'markerData'));
    }
  }

  public static function get_state_dealers($state, $zone)
  {
    $states = 'states';
    $firm_name = 'firm_name';
    $address = 'address';
    $direction = 'direction';
    $dealer_distrbutr = 'dealer_distrbutr';
    $concern_person = 'concern_person';

    $currentstate = DealerAddress::select('id', "$direction as direction", "$states as states", "$firm_name as firm_name", "$dealer_distrbutr as dealer_distrbutr")->where('direction', $zone)->where($states, $state)->where('status', 1)->get();

    return $currentstate;

  }

  //Branch_Address_Index
  public function Branch_Address_Index()
  {
    if (session()->has('locale') && session()->get('locale') != 'en') {
      $branch = app()->getLocale() . '_branch';
      $branch_heading = app()->getLocale() . '_branch_heading';
      $branch_address = app()->getLocale() . '_branch_address';
      $direction = app()->getLocale() . '_direction';
    } else {
      $branch = 'branch';
      $branch_heading = 'branch_heading';
      $branch_address = 'branch_address';
      $direction = 'direction';
    }

    $NorthBranch = BranchAddress::select('id', "direction", "$branch as branch")->where('direction', 'north')->where('status', 1)->get();
    $SouthBranch = BranchAddress::select('id', "direction", "$branch as branch")->where('direction', 'south')->where('status', 1)->get();
    $WestBranch = BranchAddress::select('id', "direction", "$branch as branch")->where('direction', 'west')->where('status', 1)->get();
    $corporate = BranchAddress::select('id', "direction", "$branch as branch")->where('direction', 'corporate')->where('status', 1)->first();
    $factory = BranchAddress::select('id', "direction", "$branch as branch")->where('direction', 'factory')->where('status', 1)->first();
    $international = BranchAddress::select('id', "direction", "$branch as branch")->where('direction', 'international')->where('status', 1)->get();

    $ResultArray = BranchAddress::select('id', 'direction')->where('status', 1)->get();
    $latitude_longitude = BranchAddress::select('latitude AS lat', 'longitude AS lng')->where('status', 1)->get();
    $markerData = BranchAddress::select("$branch_heading as branch_heading", 'branch_number', 'branch_email', "$branch_address as branch_address", 'branch_image')->where('status', 1)->get();

    if (session()->has('locale') && session()->get('locale') != 'en') {
      return view('frontend.contactus.branchaddress', compact('NorthBranch', 'SouthBranch', 'WestBranch', 'corporate', 'factory', 'ResultArray', 'latitude_longitude', 'markerData', 'international'));
    } else {
      return view('frontend.contactus.branchaddress', compact('NorthBranch', 'SouthBranch', 'WestBranch', 'corporate', 'factory', 'ResultArray', 'latitude_longitude', 'markerData', 'international'));
    }
  }

  //ProductCommonSearch
  public function ProductCommonSearch()
  {
    $module = request()->segment(1);

    $category_id = (isset($_GET['category'])) ? $_GET['category'] : 1;
    if ($module == "product" && $category_id) {
      $results = Products::select('id', 'image', 'title', 'features', 'product_url')
        ->where('category_id', 'like', '%' . $category_id . '%')
        ->where('status', 1)->orderby('id', 'asc')->get();
      $Categories = Categories::where('type', 1)->get();
    }
    $categorydetail = Categories::select('id', 'name', 'description')->where('id', $category_id)->first();
    $Popular_blogs = Blogs::select('id', 'blog_url', 'banner_image', 'blog_title', 'created_at')
      ->where('is_popular', 1)->where('is_deleted', 0)->take(3)->orderby('id', 'desc')->get();
    if (session()->has('locale') && session()->get('locale') != 'en') {
      return view('frontend.commonsearch', compact('results', 'module', 'categorydetail', 'Categories', 'Popular_blogs', 'category_id'));
    } else {
      return view('frontend.commonsearch', compact('results', 'module', 'categorydetail', 'Categories', 'Popular_blogs', 'category_id'));
    }
  }

  //BlogCommonSearch
  public function BlogsCommonSearch()
  {
    $module = request()->segment(1);
    $tag = base64_decode($_GET['tags']);
    if ($module == "blogs" && isset($tag)) {
      $results = Blogs::select('id', 'blog_title', 'blog_url', 'thumb_image', 'blog_content', 'banner_image')
        ->where('tags', 'like', '%' . $tag . '%')
        ->where('status', 1)->orderby('id', 'asc')->get();
    }
    $Popular_blogs = Blogs::select('id', 'blog_url', 'banner_image', 'blog_title', 'created_at')
      ->where('is_popular', 1)->where('is_deleted', 0)->take(3)->orderby('id', 'desc')->get();
    if (session()->has('locale') && session()->get('locale') != 'en') {
      return view('frontend.commonsearch', compact('results', 'module', 'Popular_blogs', 'tag'));
    } else {
      return view('frontend.commonsearch', compact('results', 'module', 'Popular_blogs', 'tag'));
    }

  }

  // Searching Everything
  public function searched(Request $request)
  {
    $tagGroup = [];
    $srd = $request->s_data;
    $data = Projects::where('status', 1)->where('tags', 'like', '%' . $srd . '%')
      ->orwhere('title', 'like', '%' . $srd . '%')->where('status', 1)
      ->orwhere('city_state_name', 'like', '%' . $srd . '%')->where('status', 1)
      ->orwhere('products', 'like', '%' . $srd . '%')->where('status', 1)
      ->orwhere('direction', 'like', '%' . $srd . '%')->where('status', 1)
      ->orwhere('video_title', 'like', '%' . $srd . '%')->where('status', 1)
      ->orwhereRaw("find_in_set('" . $srd . "',tags)")->where('status', 1)
      ->get();

    $data2 = Products::where('status', 1)->where("is_deleted", 0)->where('tags', 'like', '%' . $srd . '%')
      ->orwhere('title', 'like', '%' . $srd . '%')->where('status', 1)->where("is_deleted", 0)
      ->orwhere('features', 'like', '%' . $srd . '%')->where('status', 1)->where("is_deleted", 0)
      ->orwhere('properties', 'like', '%' . $srd . '%')->where('status', 1)->where("is_deleted", 0)
      ->orwhere('application', 'like', '%' . $srd . '%')->where('status', 1)->where("is_deleted", 0)
      ->orwhere('thickness', 'like', '%' . $srd . '%')->where('status', 1)->where("is_deleted", 0)
      ->orwhere('core', 'like', '%' . $srd . '%')->where('status', 1)->where("is_deleted", 0)
      ->orwhere('coil_thickness', 'like', '%' . $srd . '%')->where('status', 1)->where("is_deleted", 0)
      ->orwhere('video_title', 'like', '%' . $srd . '%')->where('status', 1)->where("is_deleted", 0)
      ->orwhereRaw("find_in_set('" . $srd . "',tags)")->where('status', 1)->where("is_deleted", 0)
      ->get();

    $data3 = Blogs::where('status', 1)->where("is_deleted", 0)->where('tags', 'like', '%' . $srd . '%')
      ->orwhere('blog_title', 'like', '%' . $srd . '%')->where('status', 1)->where("is_deleted", 0)
      ->orwhere('page_title', 'like', '%' . $srd . '%')->where('status', 1)->where("is_deleted", 0)
      ->orwhere('meta_keywords', 'like', '%' . $srd . '%')->where('status', 1)->where("is_deleted", 0)
      ->orwhere('meta_description', 'like', '%' . $srd . '%')->where('status', 1)->where("is_deleted", 0)
      ->orwhere('blog_content', 'like', '%' . $srd . '%')->where('status', 1)->where("is_deleted", 0)
      ->orwhereRaw("find_in_set('" . $srd . "',tags)")->where('status', 1)->where("is_deleted", 0)
      ->get();

    // if(count($data) > 0){
    //     array_push($tagGroup,$this->getSuggestedTags(true));
    // }
    // if(count($data2) > 0){
    //     array_push($tagGroup,$this->getSuggestedTags(false));
    // }
    // dd($tagGroup);

    if (session()->has('locale') && session()->get('locale') != 'en') {
      return view('frontend.layout.searched_data', compact('data', 'data2', 'data3', 'tagGroup'));
    } else {
      return view('frontend.layout.searched_data', compact('data', 'data2', 'data3', 'tagGroup'));
    }
  }

  // ----------------------------Frontend Filter----------------------------------

  public function fetchApplications(Request $request)
  {
    if (session()->has('locale') && session()->get('locale') != 'en') {
      $name = app()->getLocale() . '_name';
      $description = app()->getLocale() . '_description';
      $title = app()->getLocale() . '_title';

    } else {
      $name = 'name';
      $description = 'description';
      $title = 'title';
    }
    $Category = Categories::select('id', "$name as name", "$description as description")->where('status', 1)->where('id', $request->categoryid)->first();

    if ($request->categoryid == 0) {
      $FilterData = Products::select('id', 'category_id', 'product_url', 'image', "$title as title")->where('application', 'like', '%' . $request->filterby . '%')->orderby('title', 'asc')->get();
    } else {
      $FilterData = Products::select('id', 'category_id', 'product_url', 'image', "$title as title")->where('application', 'like', '%' . $request->filterby . '%')
        ->where('category_id', $request->categoryid)->orderby('title', 'asc')->get();
    }
    if (session()->has('locale') && session()->get('locale') != 'en') {
      return view('frontend.products.Product_filter', compact('FilterData', 'Category'));
    } else {
      return view('frontend.products.Product_filter', compact('FilterData', 'Category'));
    }
  }

  public function fetchThickness(Request $request)
  {
    if (session()->has('locale') && session()->get('locale') != 'en') {
      $name = app()->getLocale() . '_name';
      $description = app()->getLocale() . '_description';
      $title = app()->getLocale() . '_title';

    } else {
      $name = 'name';
      $description = 'description';
      $title = 'title';
    }
    $Category = Categories::select('id', "$name as name", "$description as description")->where('status', 1)->where('id', $request->categoryid)->first();

    if ($request->categoryid == 0) {
      $FilterData = Products::select('id', 'category_id', 'product_url', 'image', "$title as title")->where('thickness', 'like', '%' . $request->filterby . '%')
        ->orderby('title', 'asc')->get();
    } else {
      $FilterData = Products::select('id', 'category_id', 'product_url', 'image', "$title as title")->where('thickness', 'like', '%' . $request->filterby . '%')
        ->where('category_id', 'like', '%' . $request->categoryid . '%')->orderby('title', 'asc')->get();
    }

    if (session()->has('locale') && session()->get('locale') != 'en') {
      return view('frontend.products.Product_filter', compact('FilterData', 'Category'));
    } else {
      return view('frontend.products.Product_filter', compact('FilterData', 'Category'));
    }
  }

  public function fetchByDefault(Request $request)
  {
    if (session()->has('locale') && session()->get('locale') != 'en') {
      $name = app()->getLocale() . '_name';
      $description = app()->getLocale() . '_description';
      $title = app()->getLocale() . '_title';

    } else {
      $name = 'name';
      $description = 'description';
      $title = 'title';
    }

    $Category = Categories::select('id', "$name as name", "$description as description")->where('status', 1)->where('id', $request->categoryid)->first();
    if ($request->filterby == 2) {
      $date = Carbon::today()->subDays(15);
      $FilterData = Products::where('created_at', '>=', $date)->where('category_id', 'like', '%' . $request->categoryid . '%')->orderby('title', 'asc')->get();
    } else {
      if ($request->categoryid == 0) {
        $FilterData = Products::select('id', 'category_id', 'product_url', 'image', "$title as title")->orderby('title', 'asc')->get();
      } else {
        $FilterData = Products::select('id', 'category_id', 'product_url', 'image', "$title as title")->where('category_id', 'like', '%' . $request->categoryid . '%')->orderby('title', 'asc')->get();
      }
    }
    if (session()->has('locale') && session()->get('locale') != 'en') {
      return view('frontend.products.Product_filter', compact('FilterData', 'Category'));
    } else {
      return view('frontend.products.Product_filter', compact('FilterData', 'Category'));
    }
  }

  public function fetchByCategory(Request $request)
  {
    if (session()->has('locale') && session()->get('locale') != 'en') {
      $name = app()->getLocale() . '_name';
      $description = app()->getLocale() . '_description';
      $title = app()->getLocale() . '_title';

    } else {
      $name = 'name';
      $description = 'description';
      $title = 'title';
    }

    $Category = Categories::select('id', "$name as name", "$description as description")->where('status', 1)->where('id', $request->filterby)->first();
    if ($request->filterby == 0) {
      $FilterData = Products::select('id', 'category_id', 'product_url', 'image', "$title as title")->where('status', 1)->orderby('title', 'asc')->get();
    } else {
      $FilterData = Products::select('id', 'category_id', 'product_url', 'image', "$title as title")->where('status', 1)->where('category_id', $request->filterby)->orderby('title', 'asc')->get();
    }

    if (session()->has('locale') && session()->get('locale') != 'en') {
      return view('frontend.products.Product_filter', compact('FilterData', 'Category'));
    } else {
      return view('frontend.products.Product_filter', compact('FilterData', 'Category'));
    }
  }
  // ------------------------------------End Frontend Filter--------------------------------

  // ------------------------------------Common Search--------------------------------
  public function searchFetchApplications(Request $request)
  {
    $result = Products::where('application', 'like', '%' . $request->filterby . '%')
      ->where('category_id', 'like', '%' . $request->categoryid . '%');
    if ($request->thickness !== 'Thickness') {
      $result->where('thickness', 'like', '%' . $request->thickness . '%');
    }
    $FilterData = $result->get();

    if (session()->has('locale') && session()->get('locale') != 'en') {
      return view('frontend.commonsearchfilter', compact('FilterData'));
    } else {
      return view('frontend.commonsearchfilter', compact('FilterData'));
    }
  }

  public function searchFetchThickness(Request $request)
  {
    $result = Products::where('thickness', 'like', '%' . $request->filterby . '%')
      ->where('category_id', 'like', '%' . $request->categoryid . '%');
    if ($request->application !== 'Application') {
      $result->where('application', 'like', '%' . $request->application . '%');
    }
    $FilterData = $result->get();

    if (session()->has('locale') && session()->get('locale') != 'en') {
      return view('frontend.commonsearchfilter', compact('FilterData'));
    } else {
      return view('frontend.commonsearchfilter', compact('FilterData'));
    }
  }

  public function searchFetchCategory(Request $request)
  {
    $result = Products::where('category_id', 'like', '%' . $request->filterby . '%');
    if ($request->thickness !== 'Thickness') {
      $result->where('thickness', 'like', '%' . $request->thickness . '%');
    }
    if ($request->application !== 'Application') {
      $result->where('application', 'like', '%' . $request->application . '%');
    }
    $FilterData = $result->get();

    if (session()->has('locale') && session()->get('locale') != 'en') {
      return view('frontend.commonsearchfilter', compact('FilterData'));
    } else {
      return view('frontend.commonsearchfilter', compact('FilterData'));
    }
  }

  public function searchFilterDefault(Request $request)
  {
    if ($request->filterby == 2) {
      $date = Carbon::today()->subDays(15);
      $FilterData = Products::where('category_id', 'like', '%' . $request->categoryid . '%')
        ->where('created_at', '>=', $date)->get();
    } else {
      $FilterData = Products::select('id', 'image', 'title', 'features', 'product_url')
        ->where('category_id', 'like', '%' . $request->categoryid . '%')
        ->where('status', 1)->orderby('id', 'asc')->get();
    }

    if (session()->has('locale') && session()->get('locale') != 'en') {
      return view('frontend.commonsearchfilter', compact('FilterData'));
    } else {
      return view('frontend.commonsearchfilter', compact('FilterData'));
    }
  }
  // ------------------------------------End Common Search--------------------------------


  // changes by shivam
  public function storeContact(Request $request)
  {
    $data = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'nullable|string|max:255',
        'email' => 'required|email',
        'contact' => 'required|string|max:12',
        'designation' => 'nullable|string|max:255',
        'company_name' => 'nullable|string|max:255',
        'country' => 'nullable|string|max:255',
        'industry' => 'nullable|string|max:255',
        'message' => 'nullable|string',
    ]);

    $first_name = $request->input('first_name');
    $last_name = $request->input('last_name', '');
    $designation = $request->input('designation', '');
    $company = $request->input('company_name', '');

    $enquiry = Enquiry::create([
      'first_name' => $first_name,
      'last_name' => $last_name,
      'email' => $request->email,
      'contact' => $request->contact,
      'designation' => $designation,
      'company_name' => $company,
      'country' => $request->country,
      'industry' => $request->industry,
      'message' => $request->message,
    ]);

    // $mailData = $enquiry->toArray();

    // ✅ Send email only to user (no admin notification)
    // Mail::to($enquiry->email)->send(new ThankYouMail($mailData));

    return redirect('/thanks');
	
  }




  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */

}






