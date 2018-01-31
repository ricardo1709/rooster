<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class RoosterController extends Controller
{
    public function show(User $user)
    {
    	$user->group = $this->find_group($user);
    	if($user->group == false)
    	{
    		return view('nope')->with('user', $user);
    	}

    	setlocale(LC_ALL, 'nl_NL', 'Dutch_Netherlands', 'Dutch');
    	$wednesday = strtotime('wednesday'); //today, or first wednesday to come
    	$schedule = array();

    	//Keuzedeel
    	if(substr($user->group, 0, 3) == 'GEO')
    	{
    		$schedule[2] = array(
    			'title' => 'GEO',
    			'time' => '09:00 - 12:15',
    			'room' => '329'
    		);
    	}
    	else
    	{
    		$schedule[5] = array(
    			'title' => 'KDDV',
    			'time' => '10:45 - 12:15',
    			'room' => '415'
    		);
    	}

    	//Rekenen
    	if($user->group == 'AMO3' || $user->group == 'AMO4')
    	{
    		$schedule[3] = array(
    			'title' => 'Rekenen',
    			'time' => '09:30 - 10:30',
    			'room' => '317'
    		);
    	}
    	elseif($user->group == 'AMO5' || $user->group == 'AMO6')
    	{
    		$schedule[10] = array(
    			'title' => 'Rekenen',
    			'time' => '13:15 - 14:15',
    			'room' => '317'
    		);
    	}
    	elseif($user->group == 'GEO1' || $user->group == 'GEO2')
    	{
    		$schedule[12] = array(
    			'title' => 'Rekenen',
    			'time' => '14:15 - 15:30',
    			'room' => '317'
    		);
    	}

    	//Nederlands
    	if($this->dutch_this_week($user, $wednesday))
    	{
	    	if($user->group == 'GEO1' || $user->group == 'GEO2')
	    	{
	    		$schedule[10] = array(
	    			'title' => 'Nederlands',
	    			'time' => '13:15 - 14:15',
	    			'room' => '???'
	    		);
	    	}
	    	elseif($user->group == 'AMO3' || $user->group == 'AMO4')
	    	{
	    		$schedule[1] = array(
	    			'title' => 'Nederlands',
	    			'time' => '08:30 - 09:30',
	    			'room' => '???'
	    		);
	    	}
	    	elseif($user->group == 'AMO5' || $user->group == 'AMO6')
	    	{
	    		$schedule[3] = array(
	    			'title' => 'Nederlands',
	    			'time' => '09:30 - 10:30',
	    			'room' => '???'
	    		);
	    	}
	    }

	    //Sort schedule
	    ksort($schedule);

	    //Set date_string
    	if(date('Ymd', $wednesday) == date('Ymd'))
    	{
    		$date_string = 'vandaag';
    	}
    	elseif(date('Ymd', $wednesday) == date('Ymd', time()+86400))
    	{
    		$date_string = 'morgen';
    	}
    	else
    	{
    		$date_string = strftime('%A %e %B', $wednesday);
    	}

    	//Set first name
    	$user->name = explode(' ', $user->name)[0];

    	return view('schedule')
    		->with('user', $user)
    		->with('schedule', $schedule)
    		->with('date_string', $date_string);
    }

    public function my()
    {
    	return $this->show(Auth::user());
    }

    private function dutch_this_week(User $user, $wednesday)
    {
    	$dates = array(
			'even' => array(
				'2018-02-07',
				'2018-02-21',
				'2018-03-07',
				'2018-03-21'
			),

			'odd' => array(
				'2018-01-31',
				'2018-02-28',
				'2018-03-14',
				'2018-03-28'
			)
		);

		$groups = array(
			'GEO1' => $dates['odd'],
			'GEO2' => $dates['even'],
			'AMO3' => $dates['odd'],
			'AMO4' => $dates['even'],
			'AMO5' => $dates['odd'],
			'AMO6' => $dates['even'],
			'BEH1' => $dates['odd'],
			'BEH2' => $dates['even'],
			'BEH3' => $dates['odd']
		);

		$my_dates = $groups[$user->group];
		foreach ($my_dates as $date) {
			if($date == $wednesday)
			{
				return true;
			}
		}

		return false;
    }

    private function find_group(User $user)
    {
    	$students = array(
    		'br10' => 'AMO5',
			'D250400' => 'GEO1', 
			'D252784' => 'GEO1', 
			'D251061' => 'GEO1', 
			'D251831' => 'GEO1', 
			'D225981' => 'GEO1', 
			'D251901' => 'GEO1', 
			'D235341' => 'GEO1', 
			'D259109' => 'GEO1', 
			'D257367' => 'GEO1', 
			'D234707' => 'GEO1', 
			'D251137' => 'GEO1', 
			'D212523' => 'GEO1', 
			'D235230' => 'GEO1', 
			'D235034' => 'GEO1', 
			'D252874' => 'GEO1', 
			'D257532' => 'GEO1', 
			'D252033' => 'GEO1', 
			'D256768' => 'GEO1', 
			'D196767' => 'GEO2', 
			'D255655' => 'GEO2', 
			'D222290' => 'GEO2', 
			'D254699' => 'GEO2', 
			'D251781' => 'GEO2', 
			'D259128' => 'GEO2', 
			'D252442' => 'GEO2', 
			'D251348' => 'GEO2', 
			'D257583' => 'GEO2', 
			'D252761' => 'GEO2', 
			'D251841' => 'GEO2', 
			'D252445' => 'GEO2', 
			'D199830' => 'GEO2', 
			'D258123' => 'GEO2', 
			'D229937' => 'AMO3', 
			'D228866' => 'AMO3', 
			'D252113' => 'AMO3', 
			'D254919' => 'AMO3', 
			'D256043' => 'AMO3', 
			'GH90890' => 'AMO3', 
			'D219762' => 'AMO3', 
			'D255174' => 'AMO3', 
			'D253397' => 'AMO3', 
			'D256450' => 'AMO3', 
			'D255807' => 'AMO3', 
			'D251062' => 'AMO4', 
			'D251297' => 'AMO4', 
			'D241471' => 'AMO4', 
			'D255418' => 'AMO4', 
			'D251898' => 'AMO4', 
			'D226671' => 'AMO4', 
			'D225719' => 'AMO4', 
			'D250534' => 'AMO4', 
			'D252337' => 'AMO4', 
			'D251053' => 'AMO4', 
			'D228210' => 'AMO4', 
			'D255809' => 'AMO4', 
			'D256817' => 'AMO4', 
			'D257478' => 'AMO4', 
			'D251899' => 'AMO4', 
			'D214238' => 'AMO4', 
			'D231100' => 'AMO4', 
			'D214212' => 'AMO4', 
			'D253540' => 'AMO5', 
			'D250770' => 'AMO5', 
			'D228528' => 'AMO5', 
			'D256210' => 'AMO5', 
			'D254731' => 'AMO5', 
			'D252023' => 'AMO5', 
			'D251140' => 'AMO5', 
			'D212523' => 'AMO5', 
			'D251602' => 'AMO5', 
			'D259034' => 'AMO5', 
			'D253410' => 'AMO5', 
			'D257443' => 'AMO5', 
			'D252984' => 'AMO5', 
			'D232158' => 'AMO5', 
			'D228782' => 'AMO5', 
			'D234501' => 'AMO5', 
			'GV158160' => 'AMO5', 
			'D251576' => 'AMO6', 
			'D174838' => 'AMO6', 
			'D235222' => 'AMO6', 
			'D113000' => 'AMO6', 
			'D206888' => 'AMO6', 
			'D259513' => 'AMO6', 
			'D252024' => 'AMO6', 
			'D254426' => 'AMO6', 
			'D251669' => 'AMO6', 
			'D256041' => 'AMO6', 
			'D228531' => 'AMO6', 
			'D257812' => 'BEH1', 
			'D257883' => 'BEH1', 
			'D171389' => 'BEH1', 
			'D252878' => 'BEH1', 
			'D254146' => 'BEH1', 
			'D136234' => 'BEH1', 
			'D256326' => 'BEH1', 
			'D210645' => 'BEH1', 
			'D253647' => 'BEH1', 
			'D251063' => 'BEH1', 
			'D257534' => 'BEH1', 
			'D256805' => 'BEH1', 
			'D257302' => 'BEH1', 
			'D251675' => 'BEH2', 
			'D251818' => 'BEH2', 
			'D252343' => 'BEH2', 
			'D253694' => 'BEH2', 
			'D250733' => 'BEH2', 
			'D255094' => 'BEH2', 
			'D234265' => 'BEH2', 
			'D251061' => 'BEH2', 
			'D193867' => 'BEH2', 
			'D196566' => 'BEH2', 
			'D252154' => 'BEH2', 
			'D257253' => 'BEH2', 
			'D252026' => 'BEH2', 
			'D229798' => 'BEH2', 
			'D227677' => 'BEH2', 
			'D234866' => 'BEH3', 
			'D253550' => 'BEH3', 
			'D251810' => 'BEH3', 
			'D252641' => 'BEH3', 
			'D251130' => 'BEH3', 
			'D256567' => 'BEH3', 
			'D251621' => 'BEH3', 
			'D217674' => 'BEH3', 
			'D257658' => 'BEH3', 
			'D185204' => 'BEH3', 
			'D195760' => 'BEH3', 
			'D117816' => 'BEH3', 
			'D206748' => 'BEH3', 
			'D258582' => 'BEH3', 
			'D257484' => 'BEH3', 
			'D258205' => 'BEH3'
		);

    	if(array_key_exists($user->id, $students))
    	{
			return $students[$user->id];
		}

		return false;
    }
}
