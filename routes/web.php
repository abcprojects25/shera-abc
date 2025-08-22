<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdbannerController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CatalogueController;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\MediaController;  
use App\Http\Controllers\Admin\NewMediaController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\FrontProductController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\AddCartController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Admin\DealerController;
use App\Models\Categories;
use App\Models\admin\Products;
use App\Models\admin\Categories_lookups;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\AdminNotificationController;
use App\Http\Controllers\GameLogController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



/* ===== PWA ===== */
Route::group(['as' => 'laravelpwa.'], function () {
    Route::get('/manifest.json', 'LaravelPWAController@manifestJson')
        ->name('manifest');
    Route::get('/offline/', 'LaravelPWAController@offline');
});


    Route::get('admin/notifications', [AdminNotificationController::class, 'index'])->name('admin.notifications.index');
    Route::post('admin/notifications/store', [AdminNotificationController::class, 'store'])->name('admin.notifications.store');
    Route::post('admin/notifications/{id}/update', [AdminNotificationController::class, 'update']);
    Route::delete('admin/notifications/{id}/delete', [AdminNotificationController::class, 'destroy']);


/* ===== Frontend Route ===== */

Route::get('/', [ProductController::class, 'indexFront'])->name('frontend.indexFront');

Route::get('/about-us', function () {
    return view('frontend.about-us');
});

Route::get('/blog', function () {
    return view('frontend.blog');
});

Route::get('/contact-us', function () {
    return view('frontend.contact-us');
});

Route::get('/be-our-dealer', function () {
    return view('frontend.be-our-dealer');
});

Route::get('/be-our-retailer', function () {
    return view('frontend.be-our-retailer');
});

Route::get('/careers', function () {
    return view('frontend.careers');
});

Route::get('/career-details', function () {
    return view('frontend.career-details');
});

Route::get('/apply-job', function () {
    return view('frontend.apply-job');
});

Route::get('testimonials', function(){
    return view('frontend.testimonials');
});
Route::get('certificates', function(){
    return view('frontend.certificates');
});

Route::post('/game/log', [GameLogController::class, 'store']);

Route::post('/submit-enquiry', [CmsController::class, 'storeEnquiry'])->name('enquiry.submit');
Route::post('/products/images/store', [ProductImageController::class, 'store'])->name('admin.products.images.store');
Route::get('/products', [ProductController::class, 'userProductPage'])->name('frontend.products');

Route::post('/admin/store-application', [ProductController::class, 'storeApplication'])->name('store.application');
Route::post('/admin/category-images/store', [ProductController::class, 'storeCategoryImages'])->name('admin.category_images.store');
Route::put('/admin/applications/update', [ProductController::class, 'update'])->name('update.application');

Route::post('/admin/store-ProductApplication', [ProductController::class, 'storeProductApplication'])->name('store.ProductApplication');
Route::post('/admin/product-images/store', [ProductController::class, 'storeProductImages'])->name('admin.product_images.store');

Route::get('/category/{slug}', [ProductController::class, 'showCategoryProducts'])->name('category.products');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

Route::get('/project', [ProjectController::class, 'userProjectPage'])->name('frontend.project');
Route::get('/project/{categorySeoUrl}', [ProjectController::class, 'userProjectPageByCategory'])->name('frontend.project.category');
Route::get('/project-details/{slug}', [ProjectController::class, 'userProjectDetails'])->name('frontend.project.details');
Route::post('/admin/project/images/store', [ProjectController::class, 'storeImages'])->name('admin.project.images.store');
// Route::get('/applications',  [ProductController::class, 'application'])->name('admin.project.viewApp');
Route::get('/applications/{id}', [ProductController::class, 'application'])
    ->name('frontend.application');

Route::get('/blogs', [BlogController::class, 'userBlogPage'])->name('frontend.blog');
Route::get('/blog/{category_seourl}', [BlogController::class, 'blogsByCategory'])->name('blogs.byCategory');

Route::post('/careers/store', [CmsController::class, 'storeCareer'])->name('careers.storeCareer');

Route::post('/dealers/store', [DealerController::class, 'store'])->name('dealers.store');

Route::post('/subscribe', [CmsController::class, 'store'])->name('subscribe.store');
Route::get('/admin/subscribers', [CmsController::class, 'Subscriber'])->name('admin.subscribers.index');
Route::delete('/admin/subscribers/{id}', [CmsController::class, 'subcriberDestroy'])
    ->name('admin.subscribers.destroy');

Route::get('/admin/guessing-game', function () {
    return view('admin.guessing_game.index');
})->name('admin.guessing_game.index');

Route::get('/admin/leaderboard', [CmsController::class, 'leaderboard'])->name('admin.leaderboard');

Route::get('/admin/dealers', [DealerController::class, 'index'])->name('admin.dealers.index');
Route::delete('/admin/dealers/{id}', [DealerController::class, 'delete'])->name('admin.dealers.delete');




/* ===== ADMIN Route ===== */

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/login', [AdminAuthController::class, 'getLogin'])->name('adminLogin');
    Route::post('/login', [AdminAuthController::class, 'postLogin'])->name('adminLoginPost');
    Route::post('/logout', [AdminAuthController::class, 'adminLogout'])->name('adminLogout');

    Route::group(['middleware' => 'adminauth'], function () {
        Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('adminDashboard');

        Route::group(['prefix' => 'media', 'as' => 'media'], function () {
            // Route::get('/', function () {
            //     return view('admin.media.index');
            // }); 
            Route::get('/', [MediaController::class, 'index_view'])->name('adminIndex');
            Route::post('/store', [MediaController::class, 'fileStore'])->name('media.upload.post');
            Route::post('/edit-images', [MediaController::class, 'editStore'])->name('media.edit.post');
            Route::post('/delete-media-photo', [MediaController::class, 'deleteMediaPhoto'])->name('media.delete.photo.post');

        });

        Route::group(['prefix'=>'seo', 'as' =>'seo'], function(){
        // seo start here
        Route::get('/',[SeoController::class, 'Index'])->name('seo.index');
        Route::get('/add',[SeoController::class, 'add'])->name('seo.add.page');
        Route::post('/store',[SeoController::class, 'Store'])->name('seo.add.store');
        Route::get('/status/{status}/{id}', [SeoController::class, 'changeStatus'])->name('seo.status');;
        Route::get('/edit/{id}',[SeoController::class, 'edit'])->name('seo.edit.page');
        Route::post('/editStore',[SeoController::class, 'editStore'])->name('seo.edit.store');
        Route::get('/delete/{id}',[SeoController::class, 'deleteSeo'])->name('seo.delete.store');
        // Route::get('/edit', function () {
        //     return view('admin.seo.edit');
        // });
        Route::get('/header-tags',[SeoController::class, 'headerIndex'])->name('seo.header.index');
        Route::get('/header-tagsadd',[SeoController::class, 'header_add'])->name('seo.header.add');
        Route::get('/header-tagstatus/{status}/{id}', [SeoController::class, 'headerSeoStatus'])->name('seo.header.status');
        Route::get('/header-tagsedit/{id}', [SeoController::class, 'headerSeoEdit'])->name('seo.header.edit');
        Route::post('/header-add',[SeoController::class, 'headerSeoStore'])->name('seo.store.page');
        Route::post('/header-update',[SeoController::class, 'headerSeoUpdate'])->name('seo.update.page');
        Route::get('/header-seo-delete/{id}',[SeoController::class, 'deleteHeaderSeo'])->name('seo.delete.store.tags');
       
        // Banner

        Route::get('/banner', [SeoController::class, 'Bannershow'])->name('banner.show');
 
        Route::post('/banner/store', [SeoController::class, 'storeBannerUrl'])->name('banner.store');

        Route::post('/banner/url/store', [SeoController::class, 'storebanner'])->name('banner.store');

        Route::delete('/banner/delete/{id}', [SeoController::class, 'deleteBanner'])->name('banner.delete');

        Route::post('/banner/update/{id}', [SeoController::class, 'updateBanner'])->name('banner.update');



        // SEO URL
        Route::get('/url/listing',[SeoController::class, 'UrlIndex'])->name('seo.url.index');
        Route::post('/url/store',[SeoController::class, 'UrlStore'])->name('seo.url.add.store');
        Route::get('/url/status/{status}/{id}', [SeoController::class, 'UrlchangeStatus'])->name('seo.url.status');;
        Route::get('/url/edit/{id}',[SeoController::class, 'Urledit'])->name('seo.url.edit.page');
        Route::post('/url/editStore',[SeoController::class, 'UrleditStore'])->name('seo.url.edit.store');
        Route::get('/url/delete/{id}',[SeoController::class, 'UrldeleteSeo'])->name('seo.url.delete.store');
        Route::get('url-listing', function () {
        });
        Route::get('add-url', function () {
            return view('admin.seo.add_url');
        });
        Route::get('edit-url', function () {
            return view('admin.seo.edit_url');
        });
    });

        /* Project Report */
        Route::group(['prefix' => 'project', 'as' => 'project'], function () {
            /* Project */
            Route::get('/all-project', [ProjectController::class, 'index_view']);
            Route::get('/home-project-listing', [ProjectController::class, 'home_index']);

            Route::get('/project-add', [ProjectController::class, 'add_view']);
            Route::get('/project-edit/{id}', [ProjectController::class, 'project_edit']);

            Route::post('/project-store', [ProjectController::class, 'projectStore']);
            Route::get('/project-status/{status}/{id}', [ProjectController::class, 'changeStatus']);
            Route::get('/project-home-status/{status}/{id}', [ProjectController::class, 'ChangeHomeStatus']);
            Route::post('/store', [ProjectController::class, 'fileStore'])->name('project.upload.post');
            Route::post('/edit-project', [ProjectController::class, 'editStore'])->name('project.edit.post');
            Route::get('/delete-project/{id}', [ProjectController::class, 'deleteProject'])->name('project.delete.post');
            Route::post('/delete-project-photo', [ProjectController::class, 'deleteProjectPhoto'])->name('project.delete.photo.post');
            Route::post('/edit-images', [ProjectController::class, 'editImgStore'])->name('project.edit.img.post');

            Route::get('/project-details', function () {
                return view('admin.projects.add_details');
            });

            Route::get('/project-categories', [ProjectController::class, 'project_categories'])->name('project.categories');
            Route::get('/project-categories-status/{status}/{id}', [ProjectController::class, 'statusCategories'])->name('project.categories-status');
            Route::get('/project-categories-delete/{id}', [ProjectController::class, 'deleteCategories'])->name('project.category-delete');
            Route::post('/category-add', [ProjectController::class, 'CategoriesAddEdit'])->name('categories.store');
            Route::post('/category-edit', [ProjectController::class, 'CategoriesAddEdit'])->name('categories.update');

            Route::get('/project-subcategories', [ProjectController::class, 'project_subcategories'])->name('project.subcategories');
            Route::post('/subcategory-add', [ProjectController::class, 'SubCategoriesAddEdit'])->name('subcategories.store');
            Route::post('/subcategory-edit', [ProjectController::class, 'SubCategoriesAddEdit'])->name('subcategories.update');

            Route::post('/banner-store', [ProjectController::class, 'bannerFileStore'])->name('project.banner.upload.post');
            Route::post('/project-sort', [ProjectController::class, 'sorting'])->name('projectsort');
            Route::post('/project-category-sort', [ProjectController::class, 'ProjectCategorySorting'])->name('projectcategorysorting');

        });

        Route::group(['prefix' => 'cms', 'as' => 'cms'], function () {
            /* CMS */
            Route::get('/all-pages', [CmsController::class, 'cms_listing']);
            Route::post('/all-pages', [CmsController::class, 'cms_listing'])->name('all_pages_fetch');
            Route::get('/cms-add', [CmsController::class, 'cms_add']);
            Route::get('/cms-edit/{id}', [CmsController::class, 'cms_edit']);
            // Route::get('/cms-view/{id}', 'CmsController@cms_view');

            Route::post('/cms-store', [CmsController::class, 'cms_store'])->name('cms_store');
            Route::post('/cms-update', [CmsController::class, 'cms_update'])->name('cms_update');
            Route::get('/cms-delete/{id}', [CmsController::class, 'cms_delete'])->name('cms_delete');

            Route::get('/status/{status}/{id}', [CmsController::class, 'cmsStatus'])->name('adminCmsStatus');
            Route::post('/cms-sort', [CmsController::class, 'sorting'])->name('cmstsort');

        });

        /* Product */
        Route::group(['prefix' => 'product', 'as' => 'product'], function () {
            Route::get('/all-product', [ProductController::class, 'Index']);
            // Route::get('/all-home-product', [ProductController::class, 'Home_Index']);

            Route::get('/product-add', [ProductController::class, 'AddProduct']);
            Route::get('/product-details', [ProductController::class, 'AddDetails']);
            Route::get('/product-view/{id}', [ProductController::class, 'AddView']);
            Route::get('/product-edit/{id}', [ProductController::class, 'EditProduct']);
            Route::post('/product-store', [ProductController::class, 'productStore']);
            Route::get('/product-status/{status}/{id}', [ProductController::class, 'changeStatus']);
            Route::get('/product-home-status/{status}/{id}', [ProductController::class, 'ChangeHomeStatus']);
            Route::post('/product-update', [ProductController::class, 'editStore']);
            Route::get('/delete-product/{id}', [ProductController::class, 'deleteProduct'])->name('product.delete');
            Route::post('/store', [ProductController::class, 'fileStore'])->name('product.upload.post');
            Route::post('/delete-product-photo', [ProductController::class, 'deleteProductPhoto'])->name('product.delete.photo.post');

            Route::get('/product-categories', [ProductController::class, 'product_categories'])->name('product.categories');
            Route::get('/product-categories-status/{status}/{id}', [ProductController::class, 'statusCategories'])->name('product.categories-status');
            Route::get('/product-categories-delete/{id}', [ProductController::class, 'deleteCategories'])->name('product.category-delete');
            Route::post('/category-add', [ProductController::class, 'CategoriesAddEdit'])->name('categories.store');
            Route::post('/category-edit', [ProductController::class, 'CategoriesAddEdit'])->name('categories.update');

            Route::post('/subcategory-add', [ProductController::class, 'SubCategoriesAddEdit'])->name('subcategories.store');
            Route::post('/subcategory-edit', [ProductController::class, 'SubCategoriesAddEdit'])->name('subcategories.update');

            Route::post('/product-sort', [ProductController::class, 'sorting'])->name('productsort');
            Route::post('/edit-images', [ProductController::class, 'editImgStore'])->name('product.edit.img.post');

            Route::post('/product-category-sort', [ProductController::class, 'ProCategorySorting'])->name('procategorysorting');


        });



        /* Blog */
        Route::group(['prefix' => 'blog', 'as' => 'blog'], function () {

            Route::get('/all-post', [BlogController::class, 'Index'])->name('blog.index');
            Route::get('/blog-add', [BlogController::class, 'add'])->name('blog.add');
            Route::post('/blog-store', [BlogController::class, 'blogStore'])->name('blog.store');
            Route::post('/blog-update', [BlogController::class, 'blogUpdate'])->name('blog.update');
            Route::get('/blog-details', [BlogController::class, 'blog_details'])->name('blog.details');
            Route::get('/blog-view', [BlogController::class, 'blog_view'])->name('blog.view');
            Route::get('/blog-edit/{id}', [BlogController::class, 'blog_edit'])->name('blog.edit');
            Route::get('/blog-delete/{id}', [BlogController::class, 'blog_delete'])->name('blog.delete');
            Route::get('/blog-categories', [BlogController::class, 'blog_categories'])->name('blog.categories');
            Route::get('/status/{status}/{id}', [BlogController::class, 'blogStatus'])->name('adminBlogStatus');
            Route::get('/bannerStatus/{status}/{id}', [BlogController::class, 'BlogBannerStatus'])->name('adminBlogBannerStatus');
            Route::get('/popularStatus/{status}/{id}', [BlogController::class, 'BlogPopularStatus'])->name('adminBlogPopularStatus');

            Route::post('/category-add', [BlogController::class, 'CategoriesAddEdit'])->name('categories.store');
            Route::post('/category-edit', [BlogController::class, 'CategoriesAddEdit'])->name('categories.update');
            Route::get('/blog-categories-status/{status}/{id}', [BlogController::class, 'statusCategories'])->name('blog.categories-status');
            Route::get('/blog-categories-delete/{id}', [BlogController::class, 'deleteCategories'])->name('blog.category-delete');

            Route::get('/blog-tags', [BlogController::class, 'TagsIndex'])->name('tags.index');
            Route::post('/tags-add', [BlogController::class, 'tagsAddEdit'])->name('tags.store');
            Route::post('/tags-edit', [BlogController::class, 'tagsAddEdit'])->name('tags.update');
            Route::get('/blog-tag-status/{status}/{id}', [BlogController::class, 'statusTags'])->name('blog.tags-status');
            Route::get('/blog-tag-delete/{id}', [BlogController::class, 'deleteTags'])->name('blog.tags-delete');
            Route::post('/banner-store', [BlogController::class, 'bannerFileStore'])->name('blog.banner.upload.post');

            Route::post('/subcategory-add', [BlogController::class, 'SubCategoriesAddEdit'])->name('subcategories.store');
            Route::post('/subcategory-edit', [BlogController::class, 'SubCategoriesAddEdit'])->name('subcategories.update');

            Route::post('/delete-blog-photo', [BlogController::class, 'deleteBannerPhoto'])->name('blog.delete.banner.post');

            Route::post('/blog-sort', [BlogController::class, 'sorting'])->name('blogsort');
            Route::post('/edit-images', [BlogController::class, 'editBannerImgStore'])->name('blog.edit.img.post');
            Route::post('/blog-category-sort', [BlogController::class, 'BlogCategorySorting'])->name('blogcategorysorting');

        });

        Route::group(['prefix' => 'support', 'as' => 'support'], function () {
            Route::get('/catalogues', [CatalogueController::class, 'Index'])->name('catalogues.index');
            Route::get('/catalogues-add', [CatalogueController::class, 'catalogue_add'])->name('catalogues.add');
            Route::post('/catalogues-store', [CatalogueController::class, 'catalogueStore'])->name('catalogue.store');
            Route::get('/status/{status}/{id}', [CatalogueController::class, 'catalogueStatus'])->name('adminCatalogueStatus');
            Route::get('/catalogues-edit/{id}', [CatalogueController::class, 'catalogue_edit'])->name('catalogues.edit');
            Route::post('/catalogues-update', [CatalogueController::class, 'catalogueUpdate'])->name('catalogue.update');
            Route::get('/catalogues-delete/{id}', [CatalogueController::class, 'catalogueDelete'])->name('catalogue.delete');

            Route::get('/download-catalogue/{file}', function ($file = '') {
                return response()->download(public_path('img/catalogue/PDF/' . $file));
            });
        });

        Route::group(['prefix' => 'about', 'as' => 'about'], function () {
            // test and certificate
            Route::get('/test-certificate', [CmsController::class, 'TestCertificate_index'])->name('testCertificate');
            Route::get('/certificate-add', [CmsController::class, 'certificate_add'])->name('certificates.add');
            Route::post('/certificate-store', [CmsController::class, 'certificateStore'])->name('certificate.store');
            Route::get('/status/{status}/{id}', [CmsController::class, 'certificateStatus'])->name('adminCertificateStatus');
            Route::get('/certificate-edit/{id}', [CmsController::class, 'certificate_edit'])->name('certificate.edit');
            Route::post('/certificate-update', [CmsController::class, 'certificateUpdate'])->name('certificate.update');
            Route::get('/certificate-delete/{id}', [CmsController::class, 'certificateDelete'])->name('certificate.delete');
            Route::get('/download-certificate-pdf/{file}', function ($file = '') {
                return response()->download(public_path('img/about/test_certificate/' . $file));
            });

            //Testimonials
            Route::get('/testimonials', [CmsController::class, 'Testimonials_Index'])->name('testimonials');
            Route::get('/testimonial-add', [CmsController::class, 'testimonial_add'])->name('testimonials.add');
            Route::post('/testimonial-store', [CmsController::class, 'testimonialStore'])->name('testimonial.store');
            Route::get('/testimonial-status/{status}/{id}', [CmsController::class, 'testimonialStatus'])->name('admintesTimonialStatus');
            Route::get('/testimonial-edit/{id}', [CmsController::class, 'testimonial_edit'])->name('testimonial.edit');
            Route::post('/testimonial-update', [CmsController::class, 'testimonialUpdate'])->name('testimonial.update');
            Route::get('/testimonial-delete/{id}', [CmsController::class, 'testimonialDelete'])->name('testimonial.delete');

            //Video Gallery
            Route::get('/video-gallery', [CmsController::class, 'Video_Gallery_Index'])->name('videogallery');
            Route::get('/video-gallery-add', [CmsController::class, 'Video_gallery_add'])->name('videogallery.add');
            Route::post('/video-gallery-store', [CmsController::class, 'videogalleryStore'])->name('videogallery.store');
            Route::get('/video-gallery-edit/{id}', [CmsController::class, 'Video_gallery_edit'])->name('videogallery.edit');
            Route::post('/video-gallery-update', [CmsController::class, 'videogalleryUpdate'])->name('videogallery.update');
            Route::get('/video-gallery-status/{status}/{id}', [CmsController::class, 'videogalleryStatus'])->name('videogalleryStatus');
            Route::get('/video-gallery-delete/{id}', [CmsController::class, 'videogalleryDelete'])->name('videogallery.delete');

            //Event Gallery
            Route::get('/event-gallery', [CmsController::class, 'Event_Gallery_Index'])->name('eventgallery');
            Route::post('/event-gallery-store', [CmsController::class, 'EventGalleryStore'])->name('eventgallery.store');
            Route::post('/event-gallery-update', [CmsController::class, 'EventGalleryUpdate'])->name('eventgallery.update');
            Route::get('/event-gallery-status/{status}/{id}', [CmsController::class, 'EventGalleryStatus'])->name('eventgalleryStatus');
            Route::get('/event-gallery-delete/{id}', [CmsController::class, 'EventGalleryDelete'])->name('eventgallery.delete');
            Route::post('/event-store', [CmsController::class, 'EventFileStore'])->name('eventgallery.upload.post');
            Route::post('/delete-about-photo', [CmsController::class, 'deleteEventPhoto'])->name('event.delete.photo.post');


            //Our Milestone
            Route::get('/our-milestone', [CmsController::class, 'Our_Milestone_Index'])->name('OurMilestone');
            Route::get('/our-milestone-add', [CmsController::class, 'Our_Milestone_add'])->name('OurMilestone.add');
            Route::post('/our-milestone-store', [CmsController::class, 'Our_Milestone_Store'])->name('OurMilestone.store');
            Route::get('/our-milestone-edit/{id}', [CmsController::class, 'Our_Milestone_edit'])->name('OurMilestone.edit');
            Route::post('/our-milestone-update', [CmsController::class, 'Our_Milestone_Update'])->name('OurMilestone.update');
            Route::get('/our-milestone-status/{status}/{id}', [CmsController::class, 'Our_Milestone_Status'])->name('OurMilestone.status');
            Route::get('/our-milestone-delete/{id}', [CmsController::class, 'Our_Milestone_Delete'])->name('OurMilestone.delete');


        });

        /* Career */
        Route::get('/career', [CmsController::class, 'Career'])->name('career.index');
        Route::get('/career-delete/{id}', [CmsController::class, 'CareerDelete'])->name('career.delete');

        /* Subscribe */
        Route::get('/newsletter-subscription', [CmsController::class, 'Subscribe'])->name('subscribe.index');
        Route::get('/subscription-delete/{id}', [CmsController::class, 'SubscribeDelete'])->name('subscribe.delete');

		  /* SHIVAM CHANGES START HERE */
		Route::get('/contact-us',[CmsController::class, 'ContactUs'])->name('contactus.index');
        // Route::get('/contact-us-delete/{id}',[CmsController::class, 'ContactUsDelete'])->name('contactus.delete');
        Route::get('/contact-us-delete/{id}', [CmsController::class, 'destroy'])->name('contact-us.delete');
		
		  /* SHIVAM CHANGES END HERE */
       // Product Enquiry
        Route::get('/product-enquiries',[CmsController::class, 'cartenquiry']);
		
        /* Inquiry */
        Route::get('/inquiry', [CmsController::class, 'inquiry'])->name('inquiry.index');
        Route::get('/inquiry-delete/{id}', [CmsController::class, 'InquiryDelete'])->name('inquiry.delete');

        /* Inquiry */
        Route::get('/design-serve', [CmsController::class, 'DesignServe'])->name('design.serve.index');
        Route::get('/design-serve-delete/{id}/{file}', [CmsController::class, 'DesignServeDelete'])->name('design.serve.delete');

        /* AdBanners */
        Route::get('/home-banner', 'AdbannerController@AdBanners')->name('adbanners.index');
        Route::get('/add-banner', 'AdbannerController@AddBanner')->name('addbanner.add');
        Route::get('/add-banner/{id}', 'AdbannerController@AddBanner')->name('addbanner.edit');
        Route::post('/add-banner-store', 'AdbannerController@AddBannerStore')->name('addbanner.store');
        Route::get('/add-banner/status/{status}/{id}', 'AdbannerController@AdBannerStatus')->name('addbanner.status');
        Route::get('/add-banner/arrow_status/{is_arrow}/{id}', 'AdbannerController@AdBannerArrowStatus')->name('addbanner.arrow.status');
        Route::get('/add-banner/delete/{id}', 'AdbannerController@AddBannerDelete')->name('addbanner.delete');


        /* Branch Location */
        Route::get('/branches-location', [CmsController::class, 'BranchesLocation'])->name('branches.location.index');
        Route::get('/branches-location-add', [CmsController::class, 'BranchesLocationAdd'])->name('branches.location.add');
        Route::post('/branches-location-store', [CmsController::class, 'BranchesLocationStore'])->name('branches.location.store');
        Route::get('/branches-location-status/{status}/{id}', [CmsController::class, 'BranchesLocationStatus'])->name('branches.location.status');
        Route::get('/branches-location-edit/{id}', [CmsController::class, 'BranchesLocationEdit'])->name('branches-location.edit');
        Route::post('/branches-location-update', [CmsController::class, 'BranchesLocationUpdate'])->name('branches.location.update');
        Route::get('/branches-location-delete/{id}', [CmsController::class, 'BranchesLocationDelete'])->name('branches-location.delete');

        /* Follow Us*/
        Route::get('/follow-us', [CmsController::class, 'FollowUs'])->name('follow.us');
        Route::post('/follow-us-add', [CmsController::class, 'FollowUsAdd'])->name('follow.us.add');
        Route::get('/follow-us-status/{status}/{id}', [CmsController::class, 'FollowUsStatus'])->name('follow.us.status');
        Route::post('/follow-us-update', [CmsController::class, 'FollowUsUpdate'])->name('follow.us.update');
        Route::get('/follow-us-delete/{id}', [CmsController::class, 'FollowUsDelete'])->name('follow.us.delete');


        /* FAQ */
        Route::get('/faq', [CmsController::class, 'faqList'])->name('faq.index');
        Route::post('/faq-store', [CmsController::class, 'faqStore'])->name('faq.store');
        Route::post('/faq-update', [CmsController::class, 'faqUpdate'])->name('faq.update');
        Route::get('/faq-delete/{id}', [CmsController::class, 'faqDelete'])->name('faq.delete');

        /* Change Password */
        Route::get('/change-password', [CmsController::class, 'changePasswordIndex'])->name('adminchangePassword');
        Route::post('/update-password', [CmsController::class, 'changePassword'])->name('adminchangePassword');

    });

    //  /* Seo Report */
    //  Route::group(['prefix'=>'seo', 'as' =>'seo'], function(){
    //     Route::get('/','@Index');
    // });
});


/* ===== End ADMIN Route ===== */




/* ===== Front-End Pages ===== */

















/* ===== End Front-End Pages ===== */





/* 404 Redirect */
Route::get('/404', function () {
    return view('frontend.404');
});
Route::fallback(function () {
    return view('frontend.404');
});



