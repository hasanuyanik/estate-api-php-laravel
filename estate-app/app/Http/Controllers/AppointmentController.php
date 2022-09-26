<?php

namespace App\Http\Controllers;

use App\Contracts\IAppointmentService;
use App\Contracts\IContactService;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AppointmentController extends Controller
{
    /**
     * @var IAppointmentService
     */
    private IAppointmentService $appointmentService;

    /**
     * @var IContactService
     */
    private IContactService $contactService;

    /**
     * Create a new AuthController instance.
     *
     * @param IAppointmentService $appointmentService
     * @param IContactService $contactService
     * 
     * @return void
     */
    public function __construct(IAppointmentService $appointmentService, IContactService $contactService)
    {
        $this->appointmentService = $appointmentService;
        $this->contactService = $contactService;
    }

    public function create(Request $request)
    {
        $contact = $this->contactService->create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'address' => $request->contactAddress,
            'phone' => $request->phone
        ]);

        $response = Http::get('https://maps.googleapis.com/maps/api/distancematrix/json', [
            'destinations' => $request->appointmentAddress, 
            'origins' => env('REALTOR_ZIP_CODE'),
            'units' => 'imperial',
            'key' => env('GOOGLE_DISTANCE_MATRIX_API_KEY')
        ])->collect()['rows'][0]['elements'][0];

        $returnTime = (($response['duration']['value']*2)/60)+env('APPOINTMENT_DURATION');
        
        $estimateDeparture = new Carbon($request->estimateDeparture);

        $user = $this->appointmentService->create([
            'user_id' => Auth::id(),
            'contact_id' => $contact->id,
            'address' => "'".$request->appointmentAddress."'",
            'date' => new Carbon($request->date),
            'distance' => $response['distance']['value'],
            'estimate_departure' => $estimateDeparture,
            'return_time' => $estimateDeparture->addMinute($returnTime)
        ]);

        dd($user);

        return response()->json([
            'message' => 'Created',
            'user' => $user
        ]);
    }

    public function update(Request $request)
    {

    }

    public function delete(int $id)
    {
        return $this->appointmentService->delete($id);
    }

    public function list()
    {
        return $this->appointmentService->list();
    }

    public function byDate(string $date)
    {
        return $this->appointmentService->byDate(new Carbon($date));
    }
}