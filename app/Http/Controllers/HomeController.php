<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\AdminMessage;
use App\User;
use App\Event;
use App\Category;
use App\Country;
use App\Pin;
use App\CategoryEvent;
use App\CountryEvent;
use App\Etype;
use App\Complain;
use App\Partner;
use App\Team;
use App\TeamUser;
use App\EventTeam;
use App\UserData;

use Validator;
use Auth;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $today = date("Y-m-d");

        $events = Event::where('from_date', '>=', $today)->orderBy('id', 'DESC')->paginate(15);


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


        //return view('adminlte::home');
        return view('home', ['events' => $events, 'categories' => $categories, 'countries' => $countries, 'etypes' => $etypes]);
    }

    public function search(Request $request)
    {

        $today = date("d-M-Y");

        $search = $request['search'];
        $from = $request['from_date']; // date in Generic format
        $upto = $request['upto_date'];

        if ($from == "" or $from == null or $from < $today)
            $from = $today;


        if ($this->toSqlDate($upto) < $this->toSqlDate($from)) $upto = $from;

        $search = $request['search'];

        //$from = $this->toSqlDate($from);
        //$upto = $this->toSqlDate($upto);


//        $from = $request['from_date'];
//        $upto = $request['upto_date'];

        //$category = $request['category'];
        //$country = $request['country'];

        $category = (isset($request['categories']) ? $request['categories'] : null);
        $country = (isset($request['countries']) ? $request['countries'] : null);
        $etypes = (isset($request['etypes']) ? $request['etypes'] : null);

        if (($search == null or $search == '') and $from == null and $upto == null and $category == null and $country == null) {
            $events = Event::orderBy('id', 'DESC')->get();
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
                $from_sql = $this->toSqlDate($from);
                if ($query == '')
                    $query = Event::where('from_date', '>=', $from_sql);
                else
                    $query = $query->where('from_date', '>=', $from_sql);
            }
            if ($upto != null) {
                // date is in generic format
                $upto_sql = $this->toSqlDate($upto);
                if ($query == '')
                    $query = Event::where('upto_date', '<=', $upto_sql);
                else
                    $query = $query->where('upto_date', '<=', $upto_sql);
            }

//            $user = User::with('Profile')->where('status', 1)->whereHas('Profile', function($q){
//                $q->where('gender', 'Male');
//            })->get();


//            if ($category != null) {
//                if ($query == '') {
//                    $query = Event::whereHas('categories', function ($q) use ($category) {
//                        $q->where('category_id', $category);
//                    });
//                }
//                else {
//                    $query = $query->whereHas('categories', function ($q) use ($category) {
//                        $q->where('category_id', $category);
//                    });
//                }
//            }

            if ($category != null) {
                if ($query == '') {
                    $query = Event::whereHas('categories', function ($q) use ($category) {
                        $q->whereIn('category_id', $category);
                    });

                } else {
                    $query = $query->whereHas('categories', function ($q) use ($category) {
                        $q->whereIn('category_id', $category);
                    });

                }
            }

//            if ($country != null) {
//                if ($query == '') {
//                    $query = Event::whereHas('countries', function ($q) use ($country) {
//                        $q->where('country_id', $country);
//                    });
//                }
//                else {
//                    $query = $query->whereHas('countries', function ($q) use ($country) {
//                        $q->where('country_id', $country);
//                    });
//                }
//            }

            if ($country != null) {
                if ($query == '') {
                    $query = Event::whereHas('countries', function ($q) use ($country) {
                        $q->whereIn('country_id', $country);
                    });
                } else {
                    $query = $query->whereHas('countries', function ($q) use ($country) {
                        $q->whereIn('country_id', $country);
                    });
                }
            }

            $events = $query->orderBy('id', 'DESC')->paginate(15);
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

        //$from = $this->toGenericDate($from); // front-end has different format
        //$upto = $this->toGenericDate($upto);

        //return view('adminlte::home');
        return view('home', ['events' => $events, 'categories' => $categories, 'countries' => $countries, 'etypes' => $etypes, 'search' => $search, 'from' => $from, 'upto' => $upto]);

    }

    public function getDetails($id)
    {
        // copied in AdminController
        $event = Event::findOrFail($id);
        return view('event-details', ['event' => $event]);
    }

    public function getEventSelect($id)
    {
        $user_id = Auth::user()->id;

        $pin = Pin::where('event_id', $id)->where('user_id', $user_id)->first();

        if ($pin == null) {
            $newpin = new Pin();
            $newpin->event_id = $id;
            $newpin->comments = '';
            $newpin->user_id = $user_id;
            $newpin->save();

            // add entry to log
            $log = new UserData();
            $log->user_id = $user_id;
            $log->pin = 1;
            $log->save();


            Session::flash('flash_message', 'Pin added!');
        } else {
            Session::flash('flash_message', 'Pin already exists!');
        }
        return redirect()->back();
    }

    public function getEventBug($id)
    {
        $event_id = $id;
        return view('bug-popup', ['event_id' => $id]);
    }

    public function postEventBugUpdate(Request $request)
    {
        $user_id = Auth::user()->id;
        $event_id = $request['event_id'];
        $comments = $request['comments'];

        $bug = Complain::where('event_id', $event_id)->where('user_id', $user_id)->first();

        if ($bug == null) {
            $complain = new Complain();
            $complain->event_id = $event_id;
            $complain->user_id = $user_id;
            $complain->comments = $comments;
            $complain->status = 0;
            $complain->save();

            Session::flash('flash_message', 'Bug Report added!');
        } else {
            Session::flash('flash_message', 'You already reported it!');
        }
        return redirect()->back();
    }


    public function getEventEmail($id)
    {
        $user_id = Auth::user()->id;

        $pin = Event::where('id', $id)->first();

        if ($pin != null) {
            // send email

            $title = $pin->title;
            $to = Auth::user()->email;
            $subject = 'Date found';
            $body = "
$title <br />
This email was sent via thecontentarchitects.com";


            mail($to, $subject, $body);


            Session::flash('flash_message', 'Email Sent!');
        } else {
            Session::flash('flash_message', 'Email was not Sent!');
        }
        return redirect()->back();
    }


    public function getEventDownload($id)
    {
        $user_id = Auth::user()->id;

        $pin = Pin::where('event_id', $id)->where('user_id', $user_id)->first();

        if ($pin != null) {
            // download ICS

            $this->getICSOne($id);

            //Session::flash('flash_message', 'Pin added!');
        } else {
            //Session::flash('flash_message', 'Pin already exists!');
        }
        //return redirect()->back();
    }

    public function getEventPartner($id)
    {
        $iam = config('variables.partner_iam');
        $subjects = config('variables.partner_subject');
        $forservices = config('variables.partner_forservices');

        return view('partner-popup', ['event_id' => $id, 'subjects' => $subjects, 'iam' => $iam, 'forservices' => $forservices]);

    }

    public function postEventPartnerUpdate(Request $request)
    {

        $user_id = Auth::user()->id;

        $event_id = $request['event_id'];
        $subject = $request['subject'];
        $comments = $request['comments'];
        $started = $request['started'];
        $status = 0;
        $iam = $request['iam'];
        $forservices = $request['forservices'];


        $duplicate = Partner::where('user_id', $user_id)->where('event_id', $event_id)->where('type', 'Partner')->first();
        if ($duplicate == null) {
            $partner = new Partner();
            $partner->user_id = $user_id;
            $partner->event_id = $event_id;
            $partner->type = 'Partner';
            $partner->subject = $subject;
            $partner->comments = $comments;
            $partner->started = $started;
            $partner->status = 0;
            $partner->iam = $iam;
            $partner->forservices = $forservices;
            $partner->save();

            // todo MAIL

            Session::flash('flash_message', 'Partner request added!');
        } else {
            Session::flash('flash_message', 'You already requested!');
        }
        return redirect()->back();
    }

    public function getEventActivity($id)
    {
        //$subjects = config('variables.partner_subject');

        return view('activity-popup', ['event_id' => $id]);

    }

    public function postEventActivityUpdate(Request $request)
    {

        $user_id = Auth::user()->id;

        $event_id = $request['event_id'];
        $subject = "";
        $comments = $request['comments'];
        $started = "";
        $status = 0;

        $duplicate = Partner::where('user_id', $user_id)->where('event_id', $event_id)->where('type', 'Activity')->first();
        if ($duplicate == null) {
            $partner = new Partner();
            $partner->user_id = $user_id;
            $partner->event_id = $event_id;
            $partner->type = 'Activity';
            $partner->subject = $subject;
            $partner->comments = $comments;
            $partner->started = $started;
            $partner->status = 0;
            $partner->save();


            Session::flash('flash_message', 'Activity request added!');
        } else {
            Session::flash('flash_message', 'You already requested!');
        }


        return redirect()->back();
    }

    public function getEventRemove($id)
    {
        $user_id = Auth::user()->id;

        $pin = Pin::where('event_id', $id)->where('user_id', $user_id)->delete();

        Session::flash('flash_message', 'Pin removed!');
        return redirect()->back();
    }

    public function getPins()
    {

        $user_id = Auth::user()->id;
        // find pins
        $pins_arr = Pin::select('event_id')->where('user_id', $user_id)->get()->toArray();
        // make array
        $pins = [];
        foreach ($pins_arr as $r) {

            array_push($pins, $r['event_id']);
        }
        // select events
        $events = Event::whereIn('id', $pins)->orderBy('from_date', 'DESC')->get();

        /*
        $events = \DB::table('events')
            ->join('pins', function ($join) use ($user_id) {
                $join->on('events.id', '=', 'pins.event_id')
                    ->where('pins.user_id', $user_id);
            })
            ->get();
*/


        /* fixed data */
        $categories_arr = Category::select('category', 'id')->where('status', 1)->orderBy('category')->get()->toArray();
        $countries_arr = Country::select('country', 'id')->where('status', 1)->orderBy('country')->get()->toArray();
        $etypes_arr = Etype::select('etype', 'id')->where('status', 1)->orderBy('etype')->get()->toArray();


        // get all teams title to
//        $team_user = TeamUser::select('team_id')->where('user_id', $user_id)->get()->toArray();
//        $teams = [];
//        foreach ($team_user as $r) {
//
//            array_push($teams, $r['team_id']);
//        }
        $teams = $this->myTeams($user_id);
        $teams_arr = Team::select('title', 'id')->where('status', 1)->whereIn('id', $teams)->orderBy('title')->get()->toArray();


        // for blade engine
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

        $teams_data = [];
        foreach ($teams_arr as $arr) {
            $teams_data[$arr['id']] = $arr['title'];
        }


        //return view('adminlte::home');
        return view('my-pins', ['events' => $events, 'categories' => $categories, 'countries' => $countries, 'etypes' => $etypes, 'teams' => $teams_data]);
    }

    public function getSharedPins()
    {
        $user_id = Auth::user()->id;

        $myteams = $this->myTeams($user_id);
        $mypins = $this->myPins($myteams);

//        $myteams = [];
//
//        $teams = Team::select(['id'])->where('user_id', $user_id)->where('status', 1)->get()->toArray(); // my teams active
//
//        foreach($teams as $team) {
//            array_push($myteams, $team['id']);
//        }
//
//        $team_users = TeamUser::select(['team_id'])->where('user_id', $user_id)->where('status', 1)->get()->toArray(); // other memberships
//        foreach($team_users as $team) {
//            array_push($myteams, $team['team_id']);
//        }
//
//        $mypins = [];
//        $event_team = EventTeam::select(['event_id'])->whereIn('team_id', $myteams)->get();
//        foreach($event_team as $event) {
//            array_push($mypins, $event['event_id']);
//        }

        // same as getPins above

        // select events
        $events = Event::whereIn('id', $mypins)->orderBy('from_date', 'DESC')->get();

        /*
        $events = \DB::table('events')
            ->join('pins', function ($join) use ($user_id) {
                $join->on('events.id', '=', 'pins.event_id')
                    ->where('pins.user_id', $user_id);
            })
            ->get();
*/


        /* fixed data */
        $categories_arr = Category::select('category', 'id')->where('status', 1)->orderBy('category')->get()->toArray();
        $countries_arr = Country::select('country', 'id')->where('status', 1)->orderBy('country')->get()->toArray();
        $etypes_arr = Etype::select('etype', 'id')->where('status', 1)->orderBy('etype')->get()->toArray();

        // get all members
        $team_user = TeamUser::select('team_id')->where('user_id', $user_id)->get()->toArray();
        $teams = [];
        foreach ($team_user as $r) {

            array_push($teams, $r['team_id']);
        }

        $teams_arr = Team::select('title', 'id')->where('status', 1)->whereIn('id', $teams)->orderBy('title')->get()->toArray();


        // for blade engine
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

        $teams_data = [];
        foreach ($teams_arr as $arr) {
            $teams_data[$arr['id']] = $arr['title'];
        }

        $myteammembers = $this->myTeamMembers($user_id);

        //return view('adminlte::home');
        return view('my-shared-pins', ['events' => $events, 'categories' => $categories, 'countries' => $countries, 'etypes' => $etypes, 'teams' => $teams_data, 'members' => $myteammembers]);

    }

    public function postPinUpdate(Request $request)
    {
        $user_id = Auth::user()->id;

        $comments = $request["comments"];
        $community = $request["community"];
        $team_id = $request["team_id"];


        $rules = array(
            'comments' => 'required',
            'community' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);

        // check if the validator failed -----------------------
        if ($validator->fails()) {

            // get the error messages from the validator
            //$messages = $validator->messages();

            // redirect our user back to the form with the errors from the validator
            //return Redirect::route('my-profile')->withErrors($validator)->withInput();
            return redirect()->back()->withErrors($validator)->withInput();
        }

//        if ($comments == null and $community == null) {
//            return redirect()->back()->withErrors($validator)->withInput();
//        }
        else {
            $pin_id = $request['pin_id'];

            $pin = Pin::where('event_id', $pin_id)->where('user_id', $user_id)->first();
            if ($pin != null) {
                $pin->comments = $comments;
                $pin->community = $community;

                $pin->save();


                // update shared events
                if ($team_id != null and $team_id > 0) {
                    $team_event = EventTeam::where('team_id', $team_id)->where('event_id', $pin_id)->get();
                    if ($team_event == null or count($team_event) == 0) {

                        $team_event = new EventTeam();
                        $team_event->team_id = $team_id;
                        $team_event->event_id = $pin_id;
                        $team_event->user_id = $user_id;
                        $team_event->save();


                    }
                }

                Session::flash('flash_message', 'Pin updated!');

                return redirect()->back();
            }
        }
        return 1;
    }

    public function getProfile()
    {
        $user_id = Auth::user()->id;

        $user = User::where('id', $user_id)->first();

        return view('profile', ['user' => $user]);
    }

    public function postProfile(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'email' => 'required|email',


        );

        // do the validation ----------------------------------
        // validate against the inputs from our form
        $validator = Validator::make($request->all(), $rules);

        // check if the validator failed -----------------------
        if ($validator->fails()) {

            // get the error messages from the validator
            //$messages = $validator->messages();

            // redirect our user back to the form with the errors from the validator
            return Redirect::route('my-profile')->withErrors($validator)->withInput();

        } else {

            $id = $request['id'];

            $user = User::findOrFail($id);

            $user->name = $request["name"];
            $user->email = $request["email"];
            if ($request["password"] == $request["confirm_password"] and strlen(trim($request["password"])) > 6)
                $user->password = bcrypt(trim($request["password"]));

            $user->save();

            Session::flash('flash_message', 'User successfully updated!');

        }

        return redirect()->route('my-profile');
    }

    public function getInbox()
    {
        $user_id = Auth::user()->id;

        $messages = AdminMessage::where('user_id', $user_id)->paginate(25);

        return view('inbox', ['messages' => $messages]);
    }

    public function getTeams()
    {
        $user_id = Auth::user()->id;

        $teams = Team::where('user_id', $user_id)->paginate(25);

        return view('teams', ['teams' => $teams]);
    }

    public function getTeam($id)
    {
        $user_id = Auth::user()->id;
        if ($id == 0) {
            $team = new Team();
            $members = [];
        } else {
            $team = Team::where('id', $id)->where('user_id', $user_id)->first();
            $members = TeamUser::where('team_id', $id)->get();
        }


        return view('add-team', ['team' => $team, 'members' => $members]);

    }

    public function postTeam(Request $request)
    {

        $user_id = Auth::user()->id;
        $rules = array(
            'title' => 'required',
            'comments' => 'required',
            'status' => 'required',


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
                $team = new Team();
            } else {
                $team = Team::findOrFail($id);
            }

            $team->title = $request["title"];
            $team->comments = $request["comments"];
            $team->user_id = $user_id;
            $team->status = $request["status"];
            $team->save();

            $id = $team->id;


            $remove = (isset($request["remove"]) ? $request["remove"] : []);
            if (count($remove) > 0) {
                for ($i = 0; $i < count($remove); $i++) {
                    $membr = $remove[$i];
                    $teamuser = TeamUser::where('team_id', $id)->where('user_id', $membr)->delete();

                }
            }

            $members = explode("\r\n", $request["members"]);
            if (count($members) > 0) {
                for ($i = 0; $i < count($members); $i++) {
                    $member = $members[$i];
                    $user = User::where('email', $member)->first();
                    if ($user != null) {
                        // if user already exists
                        $teamuser = TeamUser::where('team_id', $id)->where('user_id', $user_id)->first();
                        if ($teamuser == null) {
                            $teamusr = new TeamUser();
                            $teamusr->user_id = $user->id;
                            $teamusr->team_id = $id;
                            $teamusr->status = 1;
                            $teamusr->save();
                        }
                    }
                }
            }

            Session::flash('flash_message', 'Team successfully updated!');

        }


        return redirect()->route('teams');
    }


    private function myTeams($user_id)
    {
        $myteams = [];

        $teams = Team::select(['id'])->where('user_id', $user_id)->where('status', 1)->get()->toArray(); // my teams active

        foreach ($teams as $team) {
            array_push($myteams, $team['id']);
        }

        $team_users = TeamUser::select(['team_id'])->where('user_id', $user_id)->where('status', 1)->get()->toArray(); // other memberships
        foreach ($team_users as $team) {
            array_push($myteams, $team['team_id']);
        }
        return $myteams;

    }

    private function myTeamMembers($user_id)
    {
        $mymembers = [$user_id];

        $myteams = $this->myTeams($user_id);

        $team_users = TeamUser::select(['user_id'])->whereIn('team_id', $myteams)->where('status', 1)->get()->toArray(); // other memberships
        foreach ($team_users as $team) {
            array_push($mymembers, $team['user_id']);
        }
        return $mymembers;
    }


    private function myPins($myteams)
    {

        $mypins = [];
        $event_team = EventTeam::select(['event_id'])->whereIn('team_id', $myteams)->get();
        foreach ($event_team as $event) {
            array_push($mypins, $event['event_id']);
        }

        return $mypins;
    }


    public function getICS()
    {
        $user_id = Auth::user()->id;
        // find pins
        $pins_arr = Pin::select('event_id')->where('user_id', $user_id)->get()->toArray();
        // make array
        $pins = [];
        foreach ($pins_arr as $r) {
            array_push($pins, $r['event_id']);
        }
        // select events
        $events = Event::select('title', 'from_date', 'upto_date')->whereIn('id', $pins)->orderBy('id', 'DESC')->get();

        /*
        $events = \DB::table('events')
            ->join('pins', function ($join) use ($user_id) {
                $join->on('events.id', '=', 'pins.event_id')
                    ->where('pins.user_id', $user_id);
            })
            ->get();
*/


        $contents = "BEGIN:VCALENDAR
METHOD:PUBLISH
VERSION:2.0
PRODID:-//Apple Inc.//iPhoto//EN
X-WR-CALNAME:US Holidays
X-WR-TIMEZONE:America/Los_Angeles
CALSCALE:GERGORIAN
PREFERRED_LANGUAGE:EN";
        $ctr = 0;
        foreach ($events as $event) {

            $title = $event->title;
            $fromdate = $this->toIcsDate($event->from_date);
            $uptodate = $this->toIcsDate($event->upto_date);

            $contents .= "
BEGIN:VEVENT
UID:$ctr
DTSTART;VALUE=DATE:$fromdate
DTEND;VALUE=DATE:$uptodate
SUMMARY:$title
END:VEVENT";

            $ctr++;

        }
        $contents .= "
END:VCALENDAR";


        header("Content-type: text/plain");
        header("Content-Disposition: attachment; filename=events.ics");

        echo $contents;

        // add entry to log
        $log = new UserData();
        $log->user_id = $user_id;
        $log->download = $ctr;
        $log->save();

        //echo $contents;
        //return view('adminlte::home');
        //return view('my-pins', ['events' => $events, 'categories' => $categories, 'c
    }

    public function getICSOne($id)
    {
        $user_id = Auth::user()->id;

        // select events
        $events = Event::select('title', 'from_date', 'upto_date')->where('id', $id)->get();

        /*
        $events = \DB::table('events')
            ->join('pins', function ($join) use ($user_id) {
                $join->on('events.id', '=', 'pins.event_id')
                    ->where('pins.user_id', $user_id);
            })
            ->get();
*/


        $contents = "BEGIN:VCALENDAR
METHOD:PUBLISH
VERSION:2.0
PRODID:-//Apple Inc.//iPhoto//EN
X-WR-CALNAME:US Holidays
X-WR-TIMEZONE:America/Los_Angeles
CALSCALE:GERGORIAN
PREFERRED_LANGUAGE:EN";
        $ctr = 0;
        foreach ($events as $event) {

            $title = $event->title;
            $fromdate = $this->toIcsDate($event->from_date);
            $uptodate = $this->toIcsDate($event->upto_date);

            $contents .= "
BEGIN:VEVENT
UID:$ctr
DTSTART;VALUE=DATE:$fromdate
DTEND;VALUE=DATE:$uptodate
SUMMARY:$title
END:VEVENT";

            $ctr++;

        }
        $contents .= "
END:VCALENDAR";


        header("Content-type: text/plain");
        header("Content-Disposition: attachment; filename=events.ics");

        echo $contents;

        // add entry to log
        $log = new UserData();
        $log->user_id = $user_id;
        $log->download = $ctr;
        $log->save();

        //echo $contents;
        //return view('adminlte::home');
        //return view('my-pins', ['events' => $events, 'categories' => $categories, 'c
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

        if ($date == null or strlen($date) != 11) {
            $date = date("d-M-Y");
        }
        $bits = explode('-', $date);
        $m = $bits[1];
        $months = array('Jan' => 1, 'Feb' => 2, 'Mar' => 3, 'Apr' => 4, 'May' => 5, 'Jun' => 6, 'Jul' => 7, 'Aug' => 8, 'Sep' => 9, 'Oct' => 10, 'Nov' => 11, 'Dec' => 12);

        $date = $bits[2] . '-' . substr('0' . $months[$m], -2) . '-' . $bits[0];
        return $date;
    }

    public function toIcsDate($date)
    {
        # 2001-12-31
        if ($date == null or strlen($date) != 10) {
            $date = date("Y-m-d");
            return null;
        }

        $bits = explode('-', $date);
        $date = $bits[0] . $bits[1] . $bits[2];
        return $date;
    }
}
