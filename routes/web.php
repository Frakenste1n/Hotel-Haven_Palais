
<?php

use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\BookingManagementController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\GalleryManagementController;
use App\Http\Controllers\Backend\HousekeepingController;
use App\Http\Controllers\Backend\NotificationsSettingsController;
use App\Http\Controllers\Backend\PaymentManagementController;
use App\Http\Controllers\Backend\PromotionsPackagesController;
use App\Http\Controllers\Backend\ReportsAnalyticsController;
use App\Http\Controllers\Backend\ResortFacilitiesController;
use App\Http\Controllers\Backend\ReviewsMessagesController;
use App\Http\Controllers\Backend\RoomManagementController;
use App\Http\Controllers\Backend\StaffAccessController;
use App\Http\Controllers\Backend\WebsiteManagementController;
use App\Http\Controllers\Frontend\CustomerAuthController;
use App\Http\Controllers\Frontend\ReviewController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==========================================
// FRONTEND - CUSTOMER
// ==========================================

Route::get('/', function () {
    return view('frontend.beranda.index');
})->name('home');

// Customer Authentication
Route::get('/login', [CustomerAuthController::class, 'showLoginForm'])
    ->name('customer.login');

Route::post('/login', [CustomerAuthController::class, 'login'])
    ->name('customer.login.submit');

Route::get('/register', [CustomerAuthController::class, 'showRegisterForm'])
    ->name('customer.register');

Route::post('/register', [CustomerAuthController::class, 'register'])
    ->name('customer.register.submit');

Route::post('/logout', [CustomerAuthController::class, 'logout'])
    ->middleware('auth')
    ->name('customer.logout');

// Customer Pages
Route::get('/kamar', function () {
    return view('frontend.kamar.kamar');
});

Route::get('/fasilitas', function () {
    return view('frontend.fasilitas.fasilitas');
});

Route::get('/reservasi', function () {
    return view('frontend.reservasi.reservasi');
});

Route::get('/tentang', function () {
    return view('frontend.tentang.tentang');
});

Route::get('/ulasan', function () {
    return view('frontend.ulasan.ulasan');
});

// Additional Frontend Pages
Route::get('/login/register', function () {
    return view('frontend.login.register');
});

Route::get('/beranda/listkamar', function () {
    return view('frontend.beranda.listkamar');
});

// Customer Reviews
Route::post('/ulasan', [ReviewController::class, 'store'])
    ->name('reviews.store');


// ==========================================
// BACKEND - ADMIN
// ==========================================

Route::prefix('admin')->name('backend.')->group(function () {

    // Admin Authentication
    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthController::class, 'showLoginForm'])
            ->name('login');

        Route::post('login', [AuthController::class, 'login'])
            ->name('login.submit');
    });

    Route::middleware(['auth', 'staff'])->group(function () {

        Route::post('logout', [AuthController::class, 'logout'])
            ->name('logout');

        // Dashboard
        Route::middleware('permission:dashboard.view')->group(function () {
            Route::get('/', [DashboardController::class, 'index'])
                ->name('dashboard');

            Route::get('dashboard', [DashboardController::class, 'index']);
        });

        // Website Management
        Route::get('website-management', [WebsiteManagementController::class, 'index'])
            ->middleware('permission:website_cms.view,settings.view,banners.view,page_contents.view')
            ->name('website-management.index');

        Route::post('website-management/settings', [WebsiteManagementController::class, 'storeSettings'])
            ->middleware('permission:settings.update')
            ->name('website-management.store-settings');

        Route::post('website-management/banners', [WebsiteManagementController::class, 'storeBanner'])
            ->middleware('permission:banners.create')
            ->name('website-management.store-banner');

        Route::put('website-management/banners/{banner}', [WebsiteManagementController::class, 'updateBanner'])
            ->middleware('permission:banners.update')
            ->name('website-management.update-banner');

        Route::delete('website-management/banners/{banner}', [WebsiteManagementController::class, 'destroyBanner'])
            ->middleware('permission:banners.delete')
            ->name('website-management.destroy-banner');

        Route::post('website-management/page-contents', [WebsiteManagementController::class, 'storePageContent'])
            ->middleware('permission:page_contents.create')
            ->name('website-management.store-page-content');

        Route::put('website-management/page-contents/{pageContent}', [WebsiteManagementController::class, 'updatePageContent'])
            ->middleware('permission:page_contents.update')
            ->name('website-management.update-page-content');

        Route::delete('website-management/page-contents/{pageContent}', [WebsiteManagementController::class, 'destroyPageContent'])
            ->middleware('permission:page_contents.delete')
            ->name('website-management.destroy-page-content');


        // Room Management
        Route::get('room-management', [RoomManagementController::class, 'index'])
            ->middleware('permission:room_categories.view,room_types.view,rooms.view,room_facilities.view')
            ->name('room-management.index');

        Route::post('room-management/categories', [RoomManagementController::class, 'storeCategory'])
            ->middleware('permission:room_categories.create')
            ->name('room-management.store-category');

        Route::put('room-management/categories/{roomCategory}', [RoomManagementController::class, 'updateCategory'])
            ->middleware('permission:room_categories.update')
            ->name('room-management.update-category');

        Route::delete('room-management/categories/{roomCategory}', [RoomManagementController::class, 'destroyCategory'])
            ->middleware('permission:room_categories.delete')
            ->name('room-management.destroy-category');

        Route::post('room-management/types', [RoomManagementController::class, 'storeType'])
            ->middleware('permission:room_types.create')
            ->name('room-management.store-type');

        Route::put('room-management/types/{roomType}', [RoomManagementController::class, 'updateType'])
            ->middleware('permission:room_types.update')
            ->name('room-management.update-type');

        Route::delete('room-management/types/{roomType}', [RoomManagementController::class, 'destroyType'])
            ->middleware('permission:room_types.delete')
            ->name('room-management.destroy-type');

        Route::post('room-management/rooms', [RoomManagementController::class, 'storeRoom'])
            ->middleware('permission:rooms.create')
            ->name('room-management.store-room');

        Route::put('room-management/rooms/{room}', [RoomManagementController::class, 'updateRoom'])
            ->middleware('permission:rooms.update')
            ->name('room-management.update-room');

        Route::delete('room-management/rooms/{room}', [RoomManagementController::class, 'destroyRoom'])
            ->middleware('permission:rooms.delete')
            ->name('room-management.destroy-room');

        Route::post('room-management/facilities', [RoomManagementController::class, 'storeFacility'])
            ->middleware('permission:room_facilities.create')
            ->name('room-management.store-facility');

        Route::put('room-management/facilities/{facility}', [RoomManagementController::class, 'updateFacility'])
            ->middleware('permission:room_facilities.update')
            ->name('room-management.update-facility');

        Route::delete('room-management/facilities/{facility}', [RoomManagementController::class, 'destroyFacility'])
            ->middleware('permission:room_facilities.delete')
            ->name('room-management.destroy-facility');

        Route::post('room-management/images', [RoomManagementController::class, 'storeImage'])
            ->middleware('permission:room_types.create')
            ->name('room-management.store-image');

        Route::put('room-management/images/{roomImage}', [RoomManagementController::class, 'updateImage'])
            ->middleware('permission:room_types.update')
            ->name('room-management.update-image');

        Route::delete('room-management/images/{roomImage}', [RoomManagementController::class, 'destroyImage'])
            ->middleware('permission:room_types.delete')
            ->name('room-management.destroy-image');


        // Resort Facilities
        Route::get('resort-facilities', [ResortFacilitiesController::class, 'index'])
            ->middleware('permission:facility_categories.view,resort_facilities.view')
            ->name('resort-facilities.index');

        Route::post('resort-facilities/categories', [ResortFacilitiesController::class, 'storeCategory'])
            ->middleware('permission:facility_categories.create')
            ->name('resort-facilities.store-category');

        Route::put('resort-facilities/categories/{facilityCategory}', [ResortFacilitiesController::class, 'updateCategory'])
            ->middleware('permission:facility_categories.update')
            ->name('resort-facilities.update-category');

        Route::delete('resort-facilities/categories/{facilityCategory}', [ResortFacilitiesController::class, 'destroyCategory'])
            ->middleware('permission:facility_categories.delete')
            ->name('resort-facilities.destroy-category');

        Route::post('resort-facilities/facilities', [ResortFacilitiesController::class, 'storeFacility'])
            ->middleware('permission:resort_facilities.create')
            ->name('resort-facilities.store-facility');

        Route::put('resort-facilities/facilities/{resortFacility}', [ResortFacilitiesController::class, 'updateFacility'])
            ->middleware('permission:resort_facilities.update')
            ->name('resort-facilities.update-facility');

        Route::delete('resort-facilities/facilities/{resortFacility}', [ResortFacilitiesController::class, 'destroyFacility'])
            ->middleware('permission:resort_facilities.delete')
            ->name('resort-facilities.destroy-facility');

        Route::post('resort-facilities/images', [ResortFacilitiesController::class, 'storeImage'])
            ->middleware('permission:resort_facilities.create')
            ->name('resort-facilities.store-image');

        Route::put('resort-facilities/images/{facilityImage}', [ResortFacilitiesController::class, 'updateImage'])
            ->middleware('permission:resort_facilities.update')
            ->name('resort-facilities.update-image');

        Route::delete('resort-facilities/images/{facilityImage}', [ResortFacilitiesController::class, 'destroyImage'])
            ->middleware('permission:resort_facilities.delete')
            ->name('resort-facilities.destroy-image');


        // Promotions & Packages
        Route::get('promotions-packages', [PromotionsPackagesController::class, 'index'])
            ->middleware('permission:promotions.view,packages.view')
            ->name('promotions-packages.index');

        Route::post('promotions-packages/promotions', [PromotionsPackagesController::class, 'storePromotion'])
            ->middleware('permission:promotions.create')
            ->name('promotions-packages.store-promotion');

        Route::put('promotions-packages/promotions/{promotion}', [PromotionsPackagesController::class, 'updatePromotion'])
            ->middleware('permission:promotions.update')
            ->name('promotions-packages.update-promotion');

        Route::delete('promotions-packages/promotions/{promotion}', [PromotionsPackagesController::class, 'destroyPromotion'])
            ->middleware('permission:promotions.delete')
            ->name('promotions-packages.destroy-promotion');

        Route::post('promotions-packages/packages', [PromotionsPackagesController::class, 'storePackage'])
            ->middleware('permission:packages.create')
            ->name('promotions-packages.store-package');

        Route::put('promotions-packages/packages/{package}', [PromotionsPackagesController::class, 'updatePackage'])
            ->middleware('permission:packages.update')
            ->name('promotions-packages.update-package');

        Route::delete('promotions-packages/packages/{package}', [PromotionsPackagesController::class, 'destroyPackage'])
            ->middleware('permission:packages.delete')
            ->name('promotions-packages.destroy-package');


        // Gallery
        Route::get('gallery', [GalleryManagementController::class, 'index'])
            ->middleware('permission:gallery_categories.view,galleries.view')
            ->name('gallery.index');

        Route::post('gallery/categories', [GalleryManagementController::class, 'storeCategory'])
            ->middleware('permission:gallery_categories.create')
            ->name('gallery.store-category');

        Route::put('gallery/categories/{galleryCategory}', [GalleryManagementController::class, 'updateCategory'])
            ->middleware('permission:gallery_categories.update')
            ->name('gallery.update-category');

        Route::delete('gallery/categories/{galleryCategory}', [GalleryManagementController::class, 'destroyCategory'])
            ->middleware('permission:gallery_categories.delete')
            ->name('gallery.destroy-category');

        Route::post('gallery/galleries', [GalleryManagementController::class, 'storeGallery'])
            ->middleware('permission:galleries.create')
            ->name('gallery.store-gallery');

        Route::put('gallery/galleries/{gallery}', [GalleryManagementController::class, 'updateGallery'])
            ->middleware('permission:galleries.update')
            ->name('gallery.update-gallery');

        Route::delete('gallery/galleries/{gallery}', [GalleryManagementController::class, 'destroyGallery'])
            ->middleware('permission:galleries.delete')
            ->name('gallery.destroy-gallery');


        // Booking Management
        Route::get('booking-management', [BookingManagementController::class, 'index'])
            ->middleware('permission:reservations.view,customers.view,guests.view,front_desk.view')
            ->name('booking-management.index');

        Route::post('booking-management/reservations', [BookingManagementController::class, 'storeReservation'])
            ->middleware('permission:reservations.create')
            ->name('booking-management.store-reservation');

        Route::put('booking-management/reservations/{reservation}', [BookingManagementController::class, 'updateReservation'])
            ->middleware('permission:reservations.update')
            ->name('booking-management.update-reservation');

        Route::delete('booking-management/reservations/{reservation}', [BookingManagementController::class, 'destroyReservation'])
            ->middleware('permission:reservations.delete')
            ->name('booking-management.destroy-reservation');

        Route::post('booking-management/customers', [BookingManagementController::class, 'storeCustomer'])
            ->middleware('permission:customers.create')
            ->name('booking-management.store-customer');

        Route::put('booking-management/customers/{customer}', [BookingManagementController::class, 'updateCustomer'])
            ->middleware('permission:customers.update')
            ->name('booking-management.update-customer');

        Route::delete('booking-management/customers/{customer}', [BookingManagementController::class, 'destroyCustomer'])
            ->middleware('permission:customers.delete')
            ->name('booking-management.destroy-customer');

        Route::post('booking-management/check-in/{reservation}', [BookingManagementController::class, 'checkIn'])
            ->middleware('permission:front_desk.check_in')
            ->name('booking-management.check-in');

        Route::post('booking-management/check-out/{reservation}', [BookingManagementController::class, 'checkOut'])
            ->middleware('permission:front_desk.check_out')
            ->name('booking-management.check-out');

        Route::post('booking-management/guests', [BookingManagementController::class, 'storeGuest'])
            ->middleware('permission:guests.create')
            ->name('booking-management.store-guest');

        Route::put('booking-management/guests/{guest}', [BookingManagementController::class, 'updateGuest'])
            ->middleware('permission:guests.update')
            ->name('booking-management.update-guest');

        Route::delete('booking-management/guests/{guest}', [BookingManagementController::class, 'destroyGuest'])
            ->middleware('permission:guests.delete')
            ->name('booking-management.destroy-guest');


        // Payment Management
        Route::get('payment-management', [PaymentManagementController::class, 'index'])
            ->middleware('permission:payment_methods.view,payments.view')
            ->name('payment-management.index');

        Route::post('payment-management/payment-methods', [PaymentManagementController::class, 'storePaymentMethod'])
            ->middleware('permission:payment_methods.create')
            ->name('payment-management.store-payment-method');

        Route::put('payment-management/payment-methods/{paymentMethod}', [PaymentManagementController::class, 'updatePaymentMethod'])
            ->middleware('permission:payment_methods.update')
            ->name('payment-management.update-payment-method');

        Route::delete('payment-management/payment-methods/{paymentMethod}', [PaymentManagementController::class, 'destroyPaymentMethod'])
            ->middleware('permission:payment_methods.delete')
            ->name('payment-management.destroy-payment-method');

        Route::post('payment-management/payments', [PaymentManagementController::class, 'storePayment'])
            ->middleware('permission:payments.create')
            ->name('payment-management.store-payment');

        Route::put('payment-management/payments/{payment}', [PaymentManagementController::class, 'updatePayment'])
            ->middleware('permission:payments.update')
            ->name('payment-management.update-payment');

        Route::delete('payment-management/payments/{payment}', [PaymentManagementController::class, 'destroyPayment'])
            ->middleware('permission:payments.delete')
            ->name('payment-management.destroy-payment');

        Route::post('payment-management/payments/{payment}/verify', [PaymentManagementController::class, 'verifyPayment'])
            ->middleware('permission:payments.verify')
            ->name('payment-management.verify-payment');

        Route::post('payment-management/payments/{payment}/refund', [PaymentManagementController::class, 'refundPayment'])
            ->middleware('permission:payments.refund')
            ->name('payment-management.refund-payment');


        // Housekeeping
        Route::get('housekeeping', [HousekeepingController::class, 'index'])
            ->middleware('permission:housekeeping.view')
            ->name('housekeeping.index');

        Route::post('housekeeping/tasks', [HousekeepingController::class, 'storeTask'])
            ->middleware('permission:housekeeping.create')
            ->name('housekeeping.store-task');

        Route::put('housekeeping/tasks/{housekeepingTask}', [HousekeepingController::class, 'updateTask'])
            ->middleware('permission:housekeeping.update')
            ->name('housekeeping.update-task');

        Route::delete('housekeeping/tasks/{housekeepingTask}', [HousekeepingController::class, 'destroyTask'])
            ->middleware('permission:housekeeping.delete')
            ->name('housekeeping.destroy-task');


        // Reviews & Messages
        Route::get('reviews-messages', [ReviewsMessagesController::class, 'index'])
            ->middleware('permission:reviews.view,contact_messages.view')
            ->name('reviews-messages.index');

        Route::post('reviews-messages/reviews/{review}/moderate', [ReviewsMessagesController::class, 'moderateReview'])
            ->middleware('permission:reviews.moderate')
            ->name('reviews-messages.moderate-review');

        Route::delete('reviews-messages/reviews/{review}', [ReviewsMessagesController::class, 'destroyReview'])
            ->middleware('permission:reviews.delete')
            ->name('reviews-messages.destroy-review');

        Route::put('reviews-messages/messages/{contactMessage}', [ReviewsMessagesController::class, 'updateContactMessage'])
            ->middleware('permission:contact_messages.update')
            ->name('reviews-messages.update-message');

        Route::delete('reviews-messages/messages/{contactMessage}', [ReviewsMessagesController::class, 'destroyContactMessage'])
            ->middleware('permission:contact_messages.delete')
            ->name('reviews-messages.destroy-message');


        // Staff & Access
        Route::get('staff-access', [StaffAccessController::class, 'index'])
            ->middleware('permission:users.view,roles.view,permissions.view')
            ->name('staff-access.index');

        Route::post('staff-access/users', [StaffAccessController::class, 'storeUser'])
            ->middleware('permission:users.create')
            ->name('staff-access.store-user');

        Route::put('staff-access/users/{user}', [StaffAccessController::class, 'updateUser'])
            ->middleware('permission:users.update')
            ->name('staff-access.update-user');

        Route::delete('staff-access/users/{user}', [StaffAccessController::class, 'destroyUser'])
            ->middleware('permission:users.delete')
            ->name('staff-access.destroy-user');

        Route::post('staff-access/roles', [StaffAccessController::class, 'storeRole'])
            ->middleware('permission:roles.create')
            ->name('staff-access.store-role');

        Route::put('staff-access/roles/{role}', [StaffAccessController::class, 'updateRole'])
            ->middleware('permission:roles.update')
            ->name('staff-access.update-role');

        Route::delete('staff-access/roles/{role}', [StaffAccessController::class, 'destroyRole'])
            ->middleware('permission:roles.delete')
            ->name('staff-access.destroy-role');

        Route::post('staff-access/permissions', [StaffAccessController::class, 'storePermission'])
            ->middleware('permission:permissions.create')
            ->name('staff-access.store-permission');

        Route::put('staff-access/permissions/{permission}', [StaffAccessController::class, 'updatePermission'])
            ->middleware('permission:permissions.update')
            ->name('staff-access.update-permission');

        Route::delete('staff-access/permissions/{permission}', [StaffAccessController::class, 'destroyPermission'])
            ->middleware('permission:permissions.delete')
            ->name('staff-access.destroy-permission');


        // Reports & Analytics
        Route::get('reports-analytics', [ReportsAnalyticsController::class, 'index'])
            ->middleware('permission:reports.view,activity_logs.view')
            ->name('reports-analytics.index');


        // Notifications & Settings
        Route::get('notifications-settings', [NotificationsSettingsController::class, 'index'])
            ->name('notifications-settings.index');

        Route::post('notifications-settings/read-all', [NotificationsSettingsController::class, 'markAllAsRead'])
            ->name('notifications-settings.read-all');

        Route::post('notifications-settings/{id}/read', [NotificationsSettingsController::class, 'markAsRead'])
            ->name('notifications-settings.read');

        Route::put('notifications-settings/profile', [NotificationsSettingsController::class, 'updateProfile'])
            ->name('notifications-settings.profile');
    });
});
