<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Eventlist';
$route['404'] = 'welcome/error';
$route['translate_uri_dashes'] = FALSE;
//$route['admin/country/home'] = 'countrymasters/city_home';
$route['google_login'] = 'home/gmaillogin';
$route['facebook_login'] = 'home/facebook_login';
$route['profile'] = 'home/profile_update';
$route['change_password'] = 'home/change_password';
$route['verify'] = 'home/verify';
$route['signin'] = 'home/signin';
$route['signup'] = 'home/signup';
// $route['reset/(:any)'] = 'home/resetpassword/$1';
$route['reset'] = 'home/resetpassword/';
$route['leaderboard'] = 'home/leaderboard';
$route['wishlist'] = 'home/wishlist';
$route['booking_history'] = 'home/booking_history';
$route['profile_picture'] = 'home/change_profile_picture';
$route['mobilenumber'] = 'home/mobilenumberchange';
$route['mobile'] = 'home/mobile';
$route['changemail'] = 'home/changeemail';
$route['dashboard'] = 'home/organiser';
$route['createevent'] = 'home/createevent';
$route['viewevents'] = 'home/viewevents';
$route['bookedevents'] = 'home/bookedevents';
$route['reviewevents'] = 'home/reviewevents';
//$route['viewreviews'] = 'home/viewreviews';
$route['home'] = 'home/home';
$route['about-us'] = 'home/about';
$route['faq'] = 'home/faq';
$route['privacy'] = 'home/privacy';
$route['payment'] = 'home/payment';
$route['terms'] = 'home/terms';
$route['user_points'] = 'home/checkpoints';
// $route['events/(:any)'] = 'eventslist/index';
// $route['emailverfiy'] = 'home/emailverfiy';
$route['deactive'] = 'home/deactive';
$route['logout'] = 'home/logout';
$route['reactivate'] = 'home/reactivate';
$route['webflow'] = 'eventlist/webflow';
$route['appflow'] = 'eventlist/appflow';
$route['(:any)/eventdetails/(:any)/(:any)'] = 'eventlist/eventdetails/$2/$3';
$route['eventdetails/(:any)/(:any)'] = 'eventlist/eventdetails/$1/$2';
