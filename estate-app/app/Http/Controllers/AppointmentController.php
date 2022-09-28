<?php

namespace App\Http\Controllers;

use App\Contracts\IAppointmentService;
use App\Contracts\IContactService;
use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentRequest;
use App\Libraries\GoogleAPI;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

    /**
     * @param AppointmentRequest $request
     * 
     * @return JsonResponse
     */
    public function create(AppointmentRequest $request): JsonResponse
    {
        try{
            $contact = $this->contactService->createOrUpdate($request->customer);

            $user = $this->appointmentService->create($this->generateData($request, $contact->id));
    
            return response()->json([
                'message' => 'Created',
                'user' => $user
            ]);

        } catch(Exception $exception) {
            Log::error($exception);

            return response()->json(['message' => 'An error occurred!'], 400);
        }
    }

    /**
     * @param AppointmentRequest $request
     * @param int $id
     * 
     * @return JsonResponse
     */
    public function update(AppointmentRequest $request, int $id): JsonResponse
    {
        try{
            $getUser = $this->appointmentService->byId($id);

            $contact = $this->contactService->update($getUser['contacts']['id'], $request->customer);

            $user = $this->appointmentService->update($id, $this->generateData($request, $getUser['contacts']['id']));
    
            return response()->json(['message' => 'Updated']);
        } catch(Exception $exception) {
            Log::error($exception);

            return response()->json(['message' => 'An error occurred!'], 400);
        }
    }

    /**
     * @param int $id
     * 
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        try{
            $user = $this->appointmentService->delete($id);
    
            return response()->json(['message' => 'Deleted']);
        } catch(Exception $exception) {
            Log::error($exception);

            return response()->json(['message' => 'An error occurred!'], 400);
        }
    }

    /**
     * @param Request $request
     * 
     * @return JsonResponse
     */
    public function list(Request $request): JsonResponse
    {
        $filter = $request->date ? ['date' => new Carbon($request->date)] : [];

        return response()->json($this->appointmentService->list($filter));
    }

    /**
     * @param $request
     * @param $contactId
     * 
     * @return array
     */
    private function generateData($request, $contactId): array
    {
        $response = GoogleAPI::distanceMatrixApi($request->address);

        $totalDuration = (($response['duration']['value']*2)/60)+env('APPOINTMENT_DURATION');

        return [
            'user_id' => Auth::id(),
            'contact_id' => $contactId,
            'address' => $request->address,
            'date' => Carbon::parse($request->date),
            'distance' => $response['distance']['value'],
            'estimate_departure' => Carbon::parse($request->estimateDeparture),
            'return_time' => Carbon::parse($request->estimateDeparture)->addMinute($totalDuration)
        ];
    }
}