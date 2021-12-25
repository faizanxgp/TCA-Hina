<?php

namespace App\Http\Controllers;

use App\AdminMessage;
use App\User;
use App\Event;
use App\Pin;

use App\Category;
use App\Country;
use App\CategoryEvent;
use App\CountryEvent;
use App\SocialEvent;
use App\ImageEvent;
use App\Admin;

use App\Etype;
use App\Complain;
use App\Partner;

use App\Package;
use App\CountryPackage;
use App\CategoryPackage;
use App\EtypePackage;
use App\UserSubscription;

use Auth;
use Illuminate\Http\Request;
use Validator;
use Session;
//use Illuminate\Http\Request;
use Redirect;
use Image;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = config('variables.complain_status');
        $pstatus = config('variables.partner_status');
        $complains = Complain::orderBy('id', 'DESC')->paginate(25);

        $partners = Partner::where('type', 'Partner')->orderBy('id', 'DESC')->paginate(25);
        $activities = Partner::where('type', 'Activity')->orderBy('id', 'DESC')->paginate(25);

        return view('admin.admin', ['complains' => $complains, 'status' => $status, 'partners' => $partners, 'activities' => $activities, 'pstatus' => $pstatus]);
    }

    public function getAdmins()
    {
        $users = Admin::orderBy('id', 'DESC')->paginate(25);

        return view('admin.admins', ['users' => $users]);
    }

    public function getAdmin($id = 0)
    {
        if ($id == 0)
            $user = new Admin();
        else
            $user = Admin::findOrFail($id);

        return view('admin.add-admin', ['user' => $user]);
    }

    public function postAdmin(Request $request)
    {

        $rules = array(
            'name' => 'required',
            'email' => 'required|email',
            //'password' => 'required|string|min:6|confirmed',


        );

        // do the validation ----------------------------------
        // validate against the inputs from our form
        $validator = Validator::make($request->all(), $rules);

        // check if the validator failed -----------------------
        if ($validator->fails()) {

            // get the error messages from the validator
            //$messages = $validator->messages();

            // redirect our user back to the form with the errors from the validator
            return Redirect::route('admin.get-admin')->withErrors($validator)->withInput();

        } else {

            $id = $request['id'];

            if ($id == 0) {
                $user = new Admin();
            } else {
                $user = Admin::findOrFail($id);
            }


            // duplicate email
            $email = $request["email"];
            if ($id == 0) {
                if (Admin::where('email', $email)->exists()) {
                    $validator->errors()->add('email', 'Email already exists!');
                    return Redirect::route('admin.get-user')->withErrors($validator)->withInput();
                }

            } else {
                if (Admin::where('email', $email)->where('id', '!=', $id)->exists()) {
                    $validator->errors()->add('email', 'Email already exists!');
                    return Redirect::route('admin.get-user')->withErrors($validator)->withInput();
                }
            }

            $user->name = $request["name"];
            $user->email = $request["email"];

            // password is not required for updates, so checking here instead of using rules
            if ($id == 0 and strlen(trim($request["password"])) < 6) {
                $validator->errors()->add('password', 'Password is required with minimum 6 characters');
                return Redirect::route('admin.get-admin')->withErrors($validator)->withInput();
            }

            if ($request["password"] == $request["password_confirmation"] and strlen(trim($request["password"])) > 6)
                $user->password = bcrypt(trim($request["password"]));

            $user->save();

            Session::flash('flash_message', 'Admin successfully updated!');

        }

        return redirect()->route('admin.admins');
    }

    public function getUsers()
    {
        $users = User::orderBy('id', 'DESC')->paginate(25);

        return view('admin.users', ['users' => $users]);
    }

    public function getUser($id = 0)
    {
        if ($id == 0)
            $user = new User();
        else
            $user = User::findOrFail($id);

        return view('admin.add-user', ['user' => $user]);
    }

    public function postUser(Request $request)
    {

        $rules = array(
            'name' => 'required',
            'email' => 'required|email',
            //'password' => 'required|string|min:6|confirmed',


        );

        // do the validation ----------------------------------
        // validate against the inputs from our form
        $validator = Validator::make($request->all(), $rules);

        // check if the validator failed -----------------------
        if ($validator->fails()) {

            // get the error messages from the validator
            //$messages = $validator->messages();

            // redirect our user back to the form with the errors from the validator
            return Redirect::route('admin.get-user')->withErrors($validator)->withInput();

        } else {

            $id = $request['id'];

            if ($id == 0) {
                $user = new User();
            } else {
                $user = User::findOrFail($id);
            }


            // duplicate email
            $email = $request["email"];
            if ($id == 0) {
                if (User::where('email', $email)->exists()) {
                    $validator->errors()->add('email', 'Email already exists!');
                    return Redirect::route('admin.get-user')->withErrors($validator)->withInput();
                }

            } else {
                if (User::where('email', $email)->where('id', '!=', $id)->exists()) {
                    $validator->errors()->add('email', 'Email already exists!');
                    return Redirect::route('admin.get-user')->withErrors($validator)->withInput();
                }
            }

            $user->name = $request["name"];
            $user->email = $request["email"];

            // password is not required for updates, so checking here instead of using rules
            if ($id == 0 and strlen(trim($request["password"])) < 6) {
                $validator->errors()->add('password', 'Password is required with minimum 6 characters');
                return Redirect::route('admin.get-user')->withErrors($validator)->withInput();
            }

            if ($request["password"] == $request["password_confirmation"] and strlen(trim($request["password"])) > 6)
                $user->password = bcrypt(trim($request["password"]));

            $user->save();

            Session::flash('flash_message', 'User successfully updated!');

        }

        return redirect()->route('admin.users');
    }


    public function getViewUser($id = 0)
    {
        if ($id == 0)
            $user = new User();
        else
            $user = User::findOrFail($id);

        return view('admin.view-user', ['user' => $user]);
    }

    public function getUserPackage($id)
    {
        $user = User::findOrFail($id);

        $packages_arr = Package::select('duration', 'package', 'id')->where('status', 1)->orderBy('package')->get()->toArray();
        $packages = [];
        foreach ($packages_arr as $arr) {
            $packages[$arr['id']] = $arr['package'] . ' - ' . $arr['duration'];
        }
        return view('admin.add-user-package', ['user' => $user, 'packages' => $packages]);
    }

    public function postUserPackage(Request $request)
    {

        $request['from_date'] = $this->toSqlDate($request['from_date']);
        $request['upto_date'] = $this->toSqlDate($request['upto_date']); // auto calculated

        $rules = array(
            'from_date' => 'required',
            'upto_date' => 'required',
        );

        // do the validation ----------------------------------
        // validate against the inputs from our form
        $validator = Validator::make($request->all(), $rules);

        // check if the validator failed -----------------------
        if ($validator->fails()) {

            // get the error messages from the validator
            //$messages = $validator->messages();

            // redirect our user back to the form with the errors from the validator
            //return Redirect::route('admin.get-user-package')->withErrors($validator)->withInput();
            return redirect()->back()->withErrors($validator)->withInput();

        } else {

            //$id = $request['id'];

            $package = Package::where('id', $request['package_id'])->first();

            $usersubscription = new UserSubscription();

            $next_date= date('Y-m-d', strtotime($request["from_date"] . ' + 90 days'));

            $usersubscription->user_id = $request["user_id"];
            $usersubscription->package_id = $request["package_id"];
            $usersubscription->from_date = $request["from_date"];
            $usersubscription->upto_date = $next_date; //request["upto_date"];

            $usersubscription->save();

            Session::flash('flash_message', 'User package successfully updated!');

        }

        return redirect()->route('admin.users');
    }


    public function getPackages()
    {
        $status = config('variables.status');


        $packages = Package::orderBy('id', 'DESC')->paginate(25);


        return view('admin.packages', ['packages' => $packages, 'status' => $status]);
    }

    public function getPackage($id = 0)
    {
        $levels = config('variables.level');
        /* fixed data */
        $categories_arr = Category::select('category', 'id')->where('status', 1)->orderBy('category')->get()->toArray();
        $countries_arr = Country::select('country', 'id')->where('status', 1)->orderBy('country')->get()->toArray();
        $etypes_arr = Etype::select('etype', 'id')->where('status', 1)->orderBy('etype')->get()->toArray();
        $categories = [];
        foreach ($categories_arr as $arr) {
            $categories[$arr['id']] = $arr['category'];
        }
        $countries = [];
        foreach ($countries_arr as $arr) {
            $countries[$arr['id']] = $arr['country'];
        }
        $etypes = [];
        foreach ($etypes_arr as $arr) {
            $etypes[$arr['id']] = $arr['etype'];
        }

        if ($id == 0)
            $package = new Package();
        else
            $package = Package::findOrFail($id);

        $countrypackage_arr = CountryPackage::select('country_id')->where('package_id', $id)->get()->toArray();
        $countrypackage = [];
        foreach ($countrypackage_arr as $arr) {
            $countrypackage[] = $arr['country_id'];
        }

        $categorypackage_arr = CategoryPackage::select('category_id')->where('package_id', $id)->get()->toArray();
        $categorypackage = [];
        foreach ($categorypackage_arr as $arr) {
            $categorypackage[] = $arr['category_id'];
        }

        $etypepackage_arr = EtypePackage::select('etype_id')->where('package_id', $id)->get()->toArray();
        $etypepackage = [];
        foreach ($etypepackage_arr as $arr) {
            $etypepackage[] = $arr['etype_id'];
        }

        return view('admin.add-package', ['package' => $package,
            'countrypackages' => $countrypackage, 'countries' => $countries,
            'categorypackages' => $categorypackage, 'categories' => $categories,
            'etypepackages' => $etypepackage, 'etypes' => $etypes, 'levels' => $levels
        ]);
    }

    public function postPackage(Request $request)
    {
        $rules = array(
            'package' => 'required',
            'duration' => 'required|numeric',
            'pins' => 'required|numeric',
            'downloads' => 'required|numeric',
            'event_visibility' => 'required|numeric',


        );

        // do the validation ----------------------------------
        // validate against the inputs from our form
        $validator = Validator::make($request->all(), $rules);

        // check if the validator failed -----------------------
        if ($validator->fails()) {

            // get the error messages from the validator
            //$messages = $validator->messages();

            // redirect our package back to the form with the errors from the validator
            return Redirect::route('admin.get-package')->withErrors($validator)->withInput();

        } else {

            $id = $request['id'];

            if ($id == 0) {
                $package = new Package();
            } else {
                $package = Package::findOrFail($id);
            }

            $package->package = $request["package"];
            $package->duration = $request["duration"];
            $package->pins = $request["pins"];
            $package->downloads = $request["downloads"];
            $package->event_visibility = $request["event_visibility"];
            $package->partner = (isset($request["partner"]) ? 1 : 0);
            $package->activity = (isset($request["activity"]) ? 1 : 0);
            $package->community = (isset($request["community"]) ? 1 : 0);
            $package->new_event = (isset($request["new_event"]) ? 1 : 0);
            $package->invite_team = (isset($request["invite_team"]) ? 1 : 0);
            $package->level = $request["level"];
            $package->status = $request["status"];

            $package->save();

            $countries = (isset($request["countries"]) ? $request["countries"] : array());
            if ($countries != null) {
                // delete existing records
                $countrypackage = CountryPackage::where('package_id', $id)->delete();
                // insert
                foreach ($countries as $c) {
                    $cp = new CountryPackage();
                    $cp->package_id = $id;
                    $cp->country_id = $c;
                    $cp->save();
                }
            }

            $categories = (isset($request["categories"]) ? $request["categories"] : array());
            if ($categories != null) {
                // delete existing records
                $categorypackage = CategoryPackage::where('package_id', $id)->delete();
                // insert
                foreach ($categories as $c) {
                    $cp = new CategoryPackage();
                    $cp->package_id = $id;
                    $cp->category_id = $c;
                    $cp->save();
                }
            }

            $etypes = (isset($request["etypes"]) ? $request["etypes"] : array());
            if ($etypes != null) {
                // delete existing records
                $etypepackage = EtypePackage::where('package_id', $id)->delete();
                // insert
                foreach ($etypes as $c) {
                    $cp = new EtypePackage();
                    $cp->package_id = $id;
                    $cp->etype_id = $c;
                    $cp->save();
                }
            }

            Session::flash('flash_message', 'Package successfully updated!');

        }

        return redirect()->route('admin.packages');
    }

    public function getCountries()
    {
        $status = config('variables.status');
        $countries = Country::orderBy('id', 'DESC')->paginate(25);

        return view('admin.countries', ['countries' => $countries, 'status' => $status]);
    }

    public function getCountry($id = 0)
    {
        if ($id == 0)
            $country = new Country();
        else
            $country = Country::findOrFail($id);

        return view('admin.add-country', ['country' => $country]);
    }

    public function postCountry(Request $request)
    {

        $rules = array(
            'country' => 'required',


        );

        // do the validation ----------------------------------
        // validate against the inputs from our form
        $validator = Validator::make($request->all(), $rules);

        // check if the validator failed -----------------------
        if ($validator->fails()) {

            // get the error messages from the validator
            //$messages = $validator->messages();

            // redirect our package back to the form with the errors from the validator
            return Redirect::route('admin.get-country')->withErrors($validator)->withInput();

        } else {

            $id = $request['id'];

            if ($id == 0) {
                $country = new Country();
            } else {
                $country = Country::findOrFail($id);
            }

            $country->country = $request["country"];
            $country->status = $request["status"];

            $country->save();

            Session::flash('flash_message', 'Country successfully updated!');

        }

        return redirect()->route('admin.countries');
    }

    public function getCategories()
    {
        $status = config('variables.status');
        $categories = Category::orderBy('id', 'DESC')->paginate(25);

        return view('admin.categories', ['categories' => $categories, 'status' => $status]);
    }

    public function getCategory($id = 0)
    {
        if ($id == 0)
            $category = new Category();
        else
            $category = Category::findOrFail($id);

        return view('admin.add-category', ['category' => $category]);
    }

    public function postCategory(Request $request)
    {

        $rules = array(
            'category' => 'required',


        );

        // do the validation ----------------------------------
        // validate against the inputs from our form
        $validator = Validator::make($request->all(), $rules);

        // check if the validator failed -----------------------
        if ($validator->fails()) {

            // get the error messages from the validator
            //$messages = $validator->messages();

            // redirect our category back to the form with the errors from the validator
            return Redirect::route('admin.get-category')->withErrors($validator)->withInput();

        } else {

            $id = $request['id'];

            if ($id == 0) {
                $category = new Category();
            } else {
                $category = Category::findOrFail($id);
            }

            $category->category = $request["category"];
            $category->status = $request["status"];

            $category->save();

            Session::flash('flash_message', 'Category successfully updated!');

        }

        return redirect()->route('admin.categories');
    }

    public function getEtypes()
    {
        $status = config('variables.status');
        $etypes = Etype::orderBy('id', 'DESC')->paginate(25);

        return view('admin.etypes', ['etypes' => $etypes, 'status' => $status]);
    }

    public function getEtype($id = 0)
    {
        if ($id == 0)
            $etype = new Etype();
        else
            $etype = Etype::findOrFail($id);

        return view('admin.add-etype', ['etype' => $etype]);
    }

    public function postEtype(Request $request)
    {

        $rules = array(
            'etype' => 'required',
            'color' => 'required',


        );

        // do the validation ----------------------------------
        // validate against the inputs from our form
        $validator = Validator::make($request->all(), $rules);

        // check if the validator failed -----------------------
        if ($validator->fails()) {

            // get the error messages from the validator
            //$messages = $validator->messages();

            // redirect our package back to the form with the errors from the validator
            return Redirect::route('admin.get-etype')->withErrors($validator)->withInput();

        } else {

            $id = $request['id'];

            if ($id == 0) {
                $etype = new Etype();
            } else {
                $etype = Etype::findOrFail($id);
            }

            $etype->etype = $request["etype"];
            $etype->color = $request["color"];
            $etype->status = $request["status"];

            $etype->save();

            Session::flash('flash_message', 'Type successfully updated!');

        }

        return redirect()->route('admin.etypes');
    }

    public function getEvents(Request $request)
    {

        //dump($request);

        $search = $request['search'];
        $from = $request['from'];
        $upto = $request['upto'];
        $country = $request['country'];
        $category = $request['category'];
        $etype = $request['type'];

        if ($search == null and $from == null and $upto == null and $country == null and $category == null and $etype == null) {
            $events = Event::orderBy('id', 'DESC')->paginate(25);
        } else {

            $query = '';
            if ($search != null and $search != '') {
                if ($query == '') {
//                    $query = Event::where('title', 'like', '%' . $search . '%')
//                        ->orWhere('description', 'like', '%' . $search . '%')
//                        ->orWhere('tags', 'like', '%' . $search . '%')
//                        ->orWhere('hashtags', 'like', '%' . $search . '%');

//                    ->where(function($query)
//                    {
//                        $query->where('age','>',30)
//                            ->orWhere('email','=','johndoe@xyz.com');
//                    })

                    $query = Event::where(function ($query) use ($search) {
                        $query->where('title', 'like', '%' . $search . '%')
                            ->orWhere('description', 'like', '%' . $search . '%')
                            ->orWhere('tags', 'like', '%' . $search . '%')
                            ->orWhere('hashtags', 'like', '%' . $search . '%');
                    });
                } else {
                    // TODO
                    $query = $query->where('title', 'like', '%' . $search . '%');
                }
            }
            if ($from != null) {
                // date is in generic format
                $from = $this->toSqlDate($from);
                if ($query == '')
                    $query = Event::where('from_date', '>=', $from);
                else
                    $query = $query->where('from_date', '>=', $from);
            }
            if ($upto != null) {
                // date is in generic format
                $upto = $this->toSqlDate($upto);
                if ($query == '')
                    $query = Event::where('upto_date', '<=', $upto);
                else
                    $query = $query->where('upto_date', '<=', $upto);
            }

            // country, category, etype
            if ($category != null) {
                if ($query == '') {
                    $query = Event::whereHas('categories', function ($q) use ($category) {
                        $q->where('category_id', $category);
                    });

                } else {
                    $query = $query->whereHas('categories', function ($q) use ($category) {
                        $q->where('category_id', $category);
                    });

                }
            }

            if ($country != null) {
                if ($query == '') {
                    $query = Event::whereHas('countries', function ($q) use ($country) {
                        $q->where('country_id', $country);
                    });
                } else {
                    $query = $query->whereHas('countries', function ($q) use ($country) {
                        $q->where('country_id', $country);
                    });
                }
            }

            $events = $query->orderBy('id', 'DESC')->get(); //paginate(25);

        }


        /* fixed data */
        $categories_arr = Category::select('category', 'id')->where('status', 1)->orderBy('category')->get()->toArray();
        $countries_arr = Country::select('country', 'id')->where('status', 1)->orderBy('country')->get()->toArray();
        $etypes_arr = Etype::select('etype', 'id')->where('status', 1)->orderBy('etype')->get()->toArray();
        $categories = [];
        foreach ($categories_arr as $arr) {
            $categories[$arr['id']] = $arr['category'];
        }
        $countries = [];
        foreach ($countries_arr as $arr) {
            $countries[$arr['id']] = $arr['country'];
        }
        $etypes = [];
        foreach ($etypes_arr as $arr) {
            $etypes[$arr['id']] = $arr['etype'];
        }

        $estatus = config('variables.event_status');

        return view('admin.events', ['events' => $events, 'categories' => $categories, 'countries' => $countries, 'etypes' => $etypes, 'estatus' => $estatus]);
    }

    public function getEvent($id = 0)
    {
        $trending = config('variables.trending');
        $social = config('variables.social');
        $estatus = config('variables.event_status');
        $levels = config('variables.level');
        $repeat_year = config('variables.repeat_year');
        $repeat_week = config('variables.repeat_week');
        $repeat_month = config('variables.repeat_month');

        if ($id == 0) {
            $event = new Event();
            $scategories_arr = [];
            $scountries_arr = [];
            $simages_arr = [];
            $ssocial_arr = [];
        } else {
            $event = Event::findOrFail($id);
            $scategories_arr = CategoryEvent::select('category_id')->where('event_id', $id)->get()->toArray();
            $scountries_arr = CountryEvent::select('country_id')->where('event_id', $id)->get()->toArray();
            $simages_arr = ImageEvent::select('image')->where('event_id', $id)->get()->toArray();
            $ssocial_arr = SocialEvent::select('social')->where('event_id', $id)->get()->toArray();
        }
        // make array for selected categories and countries
        $scategories = [];
        foreach ($scategories_arr as $r) {
            array_push($scategories, $r['category_id']);
        }
        $scountries = [];
        foreach ($scountries_arr as $r) {
            array_push($scountries, $r['country_id']);
        }
        $simages = [];
        foreach ($simages_arr as $r) {
            array_push($simages, $r['image']);
        }
        $ssocial = [];
        foreach ($ssocial_arr as $r) {
            array_push($ssocial, $r['social']);
        }

        /* fixed data */
        $categories_arr = Category::select('category', 'id')->where('status', 1)->orderBy('category')->get()->toArray();
        $countries_arr = Country::select('country', 'id')->where('status', 1)->orderBy('country')->get()->toArray();
        $etypes_arr = Etype::select('etype', 'id')->where('status', 1)->orderBy('etype')->get()->toArray();
        $categories = [];
        foreach ($categories_arr as $arr) {
            $categories[$arr['id']] = $arr['category'];
        }
        $countries = [];
        foreach ($countries_arr as $arr) {
            $countries[$arr['id']] = $arr['country'];
        }
        $etypes = [];
        foreach ($etypes_arr as $arr) {
            $etypes[$arr['id']] = $arr['etype'];
        }

        $event->from_date = $this->toGenericDate($event->from_date);
        $event->upto_date = $this->toGenericDate($event->upto_date);

        return view('admin.add-event', ['event' => $event, 'categories' => $categories, 'countries' => $countries, 'scategories' => $scategories, 'scountries' => $scountries, 'simages' => $simages, 'ssocial' => $ssocial, 'trending' => $trending,
            'social' => $social, 'etypes' => $etypes, 'estatus' => $estatus, 'levels' => $levels, 'repeat_year' => $repeat_year, 'repeat_week' => $repeat_week, 'repeat_month' => $repeat_month]);
    }

    public function getEventCopy($id)
    {
        $trending = config('variables.trending');
        $social = config('variables.social');
        $estatus = config('variables.event_status');
        $levels = config('variables.level');
        $repeat_year = config('variables.repeat_year');
        $repeat_week = config('variables.repeat_week');
        $repeat_month = config('variables.repeat_month');

        if ($id == 0) {
            return redirect()->back();
        } else {
            $event = Event::findOrFail($id);
            $scategories_arr = CategoryEvent::select('category_id')->where('event_id', $id)->get()->toArray();
            $scountries_arr = CountryEvent::select('country_id')->where('event_id', $id)->get()->toArray();
            $simages_arr = ImageEvent::select('image')->where('event_id', $id)->get()->toArray();
            $ssocial_arr = SocialEvent::select('social')->where('event_id', $id)->get()->toArray();
        }
        // make array for selected categories and countries
        $scategories = [];
        foreach ($scategories_arr as $r) {
            array_push($scategories, $r['category_id']);
        }
        $scountries = [];
        foreach ($scountries_arr as $r) {
            array_push($scountries, $r['country_id']);
        }
        $simages = [];
        foreach ($simages_arr as $r) {
            array_push($simages, $r['image']);
        }
        $ssocial = [];
        foreach ($ssocial_arr as $r) {
            array_push($ssocial, $r['social']);
        }

        /* fixed data */
        $categories_arr = Category::select('category', 'id')->where('status', 1)->orderBy('category')->get()->toArray();
        $countries_arr = Country::select('country', 'id')->where('status', 1)->orderBy('country')->get()->toArray();
        $etypes_arr = Etype::select('etype', 'id')->where('status', 1)->orderBy('etype')->get()->toArray();
        $categories = [];
        foreach ($categories_arr as $arr) {
            $categories[$arr['id']] = $arr['category'];
        }
        $countries = [];
        foreach ($countries_arr as $arr) {
            $countries[$arr['id']] = $arr['country'];
        }
        $etypes = [];
        foreach ($etypes_arr as $arr) {
            $etypes[$arr['id']] = $arr['etype'];
        }

        $event->from_date = $this->toGenericDate($event->from_date);
        $event->upto_date = $this->toGenericDate($event->upto_date);
        $event->id = 0; // to make a new copy
//        return view('admin.add-event', ['event' => $event, 'categories' => $categories, 'countries' => $countries, 'scategories' => $scategories, 'scountries' => $scountries, 'simages' => $simages, 'ssocial' => $ssocial, 'trending' => $trending,
//            'social' => $social, 'etypes' => $etypes, 'estatus' => $estatus]);

        return view('admin.add-event', ['event' => $event, 'categories' => $categories, 'countries' => $countries, 'scategories' => $scategories, 'scountries' => $scountries, 'simages' => $simages, 'ssocial' => $ssocial, 'trending' => $trending,
            'social' => $social, 'etypes' => $etypes, 'estatus' => $estatus, 'levels' => $levels, 'repeat_year' => $repeat_year, 'repeat_week' => $repeat_week, 'repeat_month' => $repeat_month]);
    }

    public function postEvent(Request $request)
    {


        $request['from_date'] = $this->toSqlDate($request['from_date']);
        $request['upto_date'] = $this->toSqlDate($request['upto_date']);


        $rules = array(
            'title' => 'required',
            'description' => 'required',
            'from_date' => 'required',
            'upto_date' => 'required',

        );

        // do the validation ----------------------------------
        // validate against the inputs from our form
        $validator = Validator::make($request->all(), $rules);

        // check if the validator failed -----------------------
        if ($validator->fails()) {

            // get the error messages from the validator
            //$messages = $validator->messages();

            // redirect our user back to the form with the errors from the validator
            //return Redirect::route('admin.get-event')->withErrors($validator)->withInput();
            return redirect()->back()->withErrors($validator)->withInput();

        } else {

            $id = $request['id'];

            if ($id == 0) {
                $event = new Event();
            } else {
                $event = Event::findOrFail($id);
            }

            $event->title = $request["title"];
            $event->description = $request["description"];
            $event->from_date = $request["from_date"];
            $event->upto_date = $request["upto_date"];
            $event->tbc = (isset($request["tbc"]) ? 1 : 0);

            $event->etype_id = $request["etype_id"];
            $event->video_url = $request["video_url"];
            $event->tags = $request["tags"];
            $event->hashtags = $request["hashtags"];
            $event->emoji = $request["emoji"];
            $event->trending = $request["trending"];
            $event->past_campaigns = $request["past_campaigns"];
            $event->tips = $request["tips"];
            $event->organizer = $request["organizer"];
            $event->organizer_url = $request["organizer_url"];
            $event->organizer_email = $request["organizer_email"];
//            $event->planning_activity = (isset($request['planning_activity']) ? 1 : 0);
//            $event->looking_partner = (isset($request['looking_partner']) ? 1 : 0);
            $event->level = $request["level"];
            $event->notes = $request["notes"];
            $event->status = $request["status"];


            $event->save();

            $event_id = $event->id;

            // categories

            $categories = (isset($request['categories']) ? $request['categories'] : array());
            CategoryEvent::where('event_id', $event_id)->delete();
            foreach ($categories as $category) {

                $categoryevent = CategoryEvent::create(['event_id' => $event_id, 'category_id' => $category]);
            }

            $countries = (isset($request['countries']) ? $request['countries'] : array());
            CountryEvent::where('event_id', $event_id)->delete();
            foreach ($countries as $country) {
                $countryevent = CountryEvent::create(['event_id' => $event_id, 'country_id' => $country]);
            }

            $socials = (isset($request['social']) ? $request['social'] : array());
            SocialEvent::where('event_id', $event_id)->delete();
            foreach ($socials as $social) {
                $socialevent = SocialEvent::create(['event_id' => $event_id, 'social' => $social]);
            }

            // getting all of the post images
            $files = $request['images'];
            $destinationPath = 'uploads/images';
            if ($files != null) {
                foreach ($files as $file) {
                    if ($file) {
                        // only jpg files of less than 2MB
                        $filename = $file->getClientOriginalName();

                        // 5mb
                        if ($file->getClientMimeType() == "image/jpeg" and $file->getClientSize() < 5242880) {

                            $fname = $filename;
                            // save image name
                            $eventimage = ImageEvent::create(['event_id' => $event_id, 'image' => $event_id . '-' . $fname]);
                            //$event->image = $event_id . '-' . $fname;
                            //$event->save();

                            //resize
                            $img = Image::make($file->getRealPath());
                            $img->resize(1000, 1000, function ($constraint) {
                                $constraint->aspectRatio();
                                $constraint->upsize();
                            })->save($destinationPath . '/' . $event_id . '-' . $fname);
                            // end of resize
                        }
                    } else {
                        // for duplicate
                        if ($id == 0 and isset($request['image_old'])) {
                            $event->image = $request['image_old'];
                            $event->save();
                        }
                    }
                }
            }

            Session::flash('flash_message', 'Event successfully updated!');

        }


        return redirect()->route('admin.events');
    }

    public function getProfile()
    {
        $user_id = Auth::guard('admin')->user()->id;

        $user = Admin::where('id', $user_id)->first();

        return view('admin.profile', ['user' => $user]);
    }

    public function postProfile(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed',

        );

        // do the validation ----------------------------------
        // validate against the inputs from our form
        $validator = Validator::make($request->all(), $rules);

        // check if the validator failed -----------------------
        if ($validator->fails()) {

            // get the error messages from the validator
            //$messages = $validator->messages();

            // redirect our user back to the form with the errors from the validator
            return Redirect::route('admin.profile')->withErrors($validator)->withInput();

        } else {

            $id = $request['id'];

            $admin = Admin::findOrFail($id);

            $admin->name = $request["name"];
            $admin->email = $request["email"];

            $admin->save();

            Session::flash('flash_message', 'Admin successfully updated!');

        }

        return redirect()->route('admin.profile');
    }

    public function toUkDate($date)
    {
        # 2001-12-31
        if ($date == null or strlen($date) != 10)
            $date = date("Y-m-d");
        $bits = explode('-', $date);
        $date = $bits[2] . '-' . $bits[1] . '-' . $bits[0];
        return $date;
    }

    public function toGenericDate($date)
    {
        # 2001-12-31
        if ($date == null or strlen($date) != 10)
            $date = date("Y-m-d");
        $bits = explode('-', $date);

        $m = (int)$bits[1];
        $months = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');

        $date = $bits[2] . '-' . $months[$m] . '-' . $bits[0];
        return $date;
    }

    public function toSqlDate($date)
    {
//        # 31/12/2001
//        if ($date == null or strlen($date) != 10)
//            $date = date("d/m/Y");
//        $bits = explode('/', $date);
//        $date = $bits[2] . '-' . $bits[1] . '-' . $bits[0];
        # 31-Dec-2001
        if ($date == null or strlen($date) != 11)
            $date = date("d-M-Y");
        $bits = explode('-', $date);
        $m = $bits[1];
        $months = array('Jan' => 1, 'Feb' => 2, 'Mar' => 3, 'Apr' => 4, 'May' => 5, 'Jun' => 6, 'Jul' => 7, 'Aug' => 8, 'Sep' => 9, 'Oct' => 10, 'Nov' => 11, 'Dec' => 12);

        $date = $bits[2] . '-' . $months[$m] . '-' . $bits[0];
        return $date;
    }

    public function toSqlDate2($date)
    {
//        # 31/12/2001
//        if ($date == null or strlen($date) != 10)
//            $date = date("d/m/Y");
//        $bits = explode('/', $date);
//        $date = $bits[2] . '-' . $bits[1] . '-' . $bits[0];
        # 31-Dec-2001
        if ($date == null or strlen($date) != 9)
            $date = date("d-M-Y");
        $bits = explode('-', $date);
        $m = $bits[1];
        $months = array('Jan' => 1, 'Feb' => 2, 'Mar' => 3, 'Apr' => 4, 'May' => 5, 'Jun' => 6, 'Jul' => 7, 'Aug' => 8, 'Sep' => 9, 'Oct' => 10, 'Nov' => 11, 'Dec' => 12);

        $date = $bits[2] . '-' . $months[$m] . '-' . $bits[0];
        return $date;
    }

    public function getMessages()
    {
        $messages = AdminMessage::orderBy('id', 'DESC')->paginate(25);

        return view('admin.messages', ['messages' => $messages]);
    }

    public function getMessage($user_id)
    {


        return view('admin.message', ['user_id' => $user_id]);
    }

    public function postMessage(Request $request)
    {
        $rules = array(
            'subject' => 'required',
            'message' => 'required',
            'user_id' => 'required',

        );

        // do the validation ----------------------------------
        // validate against the inputs from our form
        $validator = Validator::make($request->all(), $rules);

        // check if the validator failed -----------------------
        if ($validator->fails()) {

            // get the error messages from the validator
            //$messages = $validator->messages();

            // redirect our user back to the form with the errors from the validator
            Session::flash('flash_message', 'Message can not be sent to Admin');
            return Redirect::route('admin.users');

        } else {

            $id = $request['id'];

            $admin_message = new AdminMessage();

            $admin_message->subject = $request["subject"];
            $admin_message->message = $request["message"];
            $admin_message->user_id = $request["user_id"];

            $admin_message->save();

            Session::flash('flash_message', 'Message successfully sent to Admin');

        }

        return redirect()->route('admin.users');


    }

    /**
     * @param $id
     */
    public function getPartnerStatus($id)
    {

        $partner = Partner::findOrFail($id);
        if ($partner != null) {
            if ($partner->status == 0)
                $partner->status = 1;
            else
                $partner->status = 0;

            $partner->save();
            Session::flash('flash_message', 'Status updated');
        }
        return redirect()->back();

    }

    public function getComplainStatus($id)
    {

        $complain = Complain::findOrFail($id);
        if ($complain != null) {
            if ($complain->status == 0)
                $complain->status = 1;
            else
                $complain->status = 0;

            $complain->save();
            Session::flash('flash_message', 'Status updated');
        }
        return redirect()->back();

    }

    public function getCommunity()
    {
        $pins = Pin::where('community', "!=", null)->orderBy('updated_at', 'DESC')->paginate(25);

        return view('admin.community', ['pins' => $pins]);

    }

    public function getCommunityStatus($id)
    {

        $pin = Pin::findOrFail($id);
        if ($pin != null) {
            if ($pin->community_approve == 0)
                $pin->community_approve = 1;
            else
                $pin->community_approve = 0;

            $pin->save();
            Session::flash('flash_message', 'Status updated');
        }
        return redirect()->back();

    }

    public function getDetails($id)
    {
        // copied from AdminController
        $event = Event::findOrFail($id);
        return view('admin.event-details', ['event' => $event]);
    }

    public function getCSV()
    {
        return view('admin.csv', []);
    }

    public function postCSV(Request $request)
    {
        //dump($request);

        $file = $request->file('file');

        $contents = $this->csvToArray($file);

        $ctr = 0;
        foreach ($contents as $r) {
            echo $ctr++;

            if ($ctr > 4) {

                echo 'yes';
                $event = new Event();


                if ($r['repeat_year'] != '') {
                    $event->repeat_year = (int)$r['repeat_year'];
                }
                if ($r['repeat_week'] != '') {
                    $event->repeat_week = (int)$r['repeat_week'];
                }
                if ($r['repeat_month'] != '') {
                    $event->repeat_mon = (int)$r['repeat_month'];
                }
                if ($r['repeat_days'] != '') {
                    $days = explode(":", $r['repeat_days']);
                    foreach ($days as $day) {
                        if (strtoupper($day) == 'MON') $event->repeat_mon = 1;
                        if (strtoupper($day) == 'TUE') $event->repeat_tue = 1;
                        if (strtoupper($day) == 'WED') $event->repeat_wed = 1;
                        if (strtoupper($day) == 'THU') $event->repeat_thu = 1;
                        if (strtoupper($day) == 'FRI') $event->repeat_fri = 1;
                        if (strtoupper($day) == 'SAT') $event->repeat_sat = 1;
                        if (strtoupper($day) == 'SUN') $event->repeat_sun = 1;
                    }
                }
                if ($r['tbc'] != '') {
                    $event->tbc = (int)$r['tbc'];
                }

                if ($r['status'] != '') {
                    //'event_status' => [
                    //    '0' => 'Inactive', '1' => 'Active', '2' => 'Incomplete',

                    if (strtoupper($r['status']) == 'INACTIVE') $event->status = 0;
                    if (strtoupper($r['status']) == 'ACTIVE') $event->status = 1;
                    if (strtoupper($r['status']) == 'INCOMPLETE') $event->status = 2;
                }

                if ($r['level'] != '') {
                    $event->level = (int)$r['level'];
                }
                if ($r['event_name'] != '') {
                    $event->title = $r['event_name'];
                }

                if ($r['start_date'] != '') {
                    // date is in dd-mmm-yy format
                    $event->from_date = $this->toSqlDate2($r['start_date']);
                }
                if ($r['end_date'] != '') {
                    $event->upto_date = $this->toSqlDate2($r['end_date']);
                }
                if ($r['countries'] != '') {
                    $countries = explode(":", $r['countries']);
                    // related object
                }
                if ($r['organizer'] != '') {
                    $event->organizer = $r['organizer'];
                }
                if ($r['organizer_link'] != '') {
                    $event->organizer_url = $r['organizer_link'];
                }
                if ($r['organizer_email'] != '') {
                    $event->organizer_email = $r['organizer_email'];
                }

                if ($r['event_description'] != '') {
                    $event->description = $r['event_description'];
                }
                if ($r['tca_notes'] != '') {
                    $event->notes = $r['tca_notes'];
                }
                if ($r['video_url'] != '') {
                    $event->video_url = $r['video_url'];
                }
                if ($r['trending'] != '') {
                    $event->trending = (int)$r['trending'];
                }
                if ($r['hashtags'] != '') {
                    $event->hashtags = $r['hashtags'];
                }
                if ($r['tags'] != '') {
                    $event->tags = $r['tags'];
                }
                if ($r['social_networks'] != '') {
                    $social = explode(":", $r['social_networks']);
                    // related object
                }
                if ($r['event_type'] != '') {
                    $event_type = explode(":", $r['event_type']);
                    // related object
                }
                if ($r['sectors'] != '') {
                    $sectors = explode(":", $r['sectors']);
                    // related object
                }

                if ($r['emojis'] != '') {
                    $event->emoji = $r['emojis'];
                }
                if ($r['tips'] != '') {
                    $event->tips = $r['tips'];
                }
                if ($r['past_campaign'] != '') {
                    $event->past_campaigns = $r['past_campaign'];
                }
                if ($r['image'] != '') {
                    $image_path = explode(":", $r['image']);
                    // related object
                }

                $event->save();


            }


            //dump($r);

        }

//        //dump($file);
//
//        //Display File Name
//        echo 'File Name: ' . $file->getClientOriginalName();
//        echo '<br>';
//
//        //Display File Extension
//        echo 'File Extension: ' . $file->getClientOriginalExtension();
//        echo '<br>';
//
//        //Display File Real Path
//        echo 'File Real Path: ' . $file->getRealPath();
//        echo '<br>';
//
//        //Display File Size
//        echo 'File Size: ' . $file->getSize();
//        echo '<br>';
//
//        //Display File Mime Type
//        echo 'File Mime Type: ' . $file->getMimeType();
//
//        //Move Uploaded File
//        $destinationPath = 'uploads';
//        $file->move($destinationPath, $file->getClientOriginalName());

    }

    function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }


}