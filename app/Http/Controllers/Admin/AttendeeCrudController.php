<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AttendeeRequest;
use App\Jobs\SendEmailJob;
use App\Jobs\SendSmsJob;
use App\Mail\SuccessfullyCreateAttendee;
use App\Mail\ThanksForJoining;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Illuminate\Support\Facades\Route;

/**
 * Class AttendeeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class AttendeeCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Attendee');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/attendee');
        $this->crud->setEntityNameStrings('attendee', 'attendees');

        $this->crud->enableExportButtons();
        $this->crud->addButtonFromModelFunction('line', 'open_payment_page', 'openPaymentPage', 'beginning');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumns([
            [
                'name' => 'id',
                'type' => 'text',
                'label' => '# ID'
            ],
            [
                'name' => 'type',
                'type' => 'radio',
                'label' => 'Type',
                'options' => trans('attendee_type')
            ],
            [
                'name' => 'name',
                'type' => 'text',
                'label' => 'Name',
                'searchLogic' => function ($query, $column, $searchTerm) {
                    $query->orWhere('name', 'like', '%'.$searchTerm.'%');
                }
            ],
            [
                'name' => 'email',
                'type' => 'email',
                'label' => 'Email',
                'searchLogic' => function ($query, $column, $searchTerm) {
                    $query->orWhere('email', 'like', '%'.$searchTerm.'%');
                }
            ],
            [
                'name' => 'mobile',
                'type' => 'phone',
                'label' => 'Mobile',
                'searchLogic' => function ($query, $column, $searchTerm) {
                    $query->orWhere('mobile', 'like', '%'.$searchTerm.'%');
                }
            ],
            [
                'name' => 'tshirt',
                'type' => 'text',
                'label' => 'T-Shirt',
            ],
            [
                'name' => 'is_paid',
                'type' => 'radio',
                'label' => 'Is Paid?',
                'options' => [
                    0 => 'No',
                    1 => 'Yes'
                ]
            ],
            [
                'name' => 'working',
                'type' => 'text',
                'label' => 'Working',
            ],
            [
                'name' => 'instruction',
                'type' => 'text',
                'label' => 'Instruction',
            ],
            [
                'name' => 'profession',
                'type' => 'text',
                'label' => 'Profession',
                'searchLogic' => function ($query, $column, $searchTerm) {
                    $query->orWhere('profession', 'like', '%'.$searchTerm.'%');
                }
            ],
            [
                'name' => 'social_profile_url',
                'type' => 'text',
                'label' => 'Social Profile Url'
            ],
            [
                'name' => 'uuid',
                'type' => 'text',
                'label' => 'UUID'
            ],
            [
                'name' => 'attend_at',
                'type' => 'datetime',
                'label' => 'Attend At'
            ],
        ]);

        $this->setupFilter();
    }

    protected function setupFilter()
    {
        // simple filter
        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'is_paid',
            'label'=> 'Is Paid?'
        ],
        false,
        function() {
             $this->crud->addClause('where', 'is_paid', '=', 1);
        });

        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'attendee',
            'label'=> 'Attendee'
        ],
        false,
        function() {
            $this->crud->addClause('where', 'is_paid', '=', 1);
            $this->crud->addClause('where', 'attend_at', '!=', null);
        });

        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'is_unpaid',
            'label'=> 'Un-Paid?'
        ],
        false,
        function() {
            $this->crud->addClause('where', 'is_paid', '<>', 1);
        });

        $this->crud->addFilter([
            'type' => 'select2',
            'name' => 'type',
            'label'=> 'Type'
        ],
        trans('attendee_type'),
        function($value) {
            $this->crud->addClause('where', 'type', '=', $value);
        });
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(AttendeeRequest::class);

        $this->crud->addFields([
            [
                'name' => 'type',
                'type' => 'select2_from_array',
                'label' => 'Type',
                'options' => trans('attendee_type')
            ],
            [
                'name' => 'name',
                'type' => 'text',
                'label' => 'Name'
            ],
            [
                'name' => 'email',
                'type' => 'email',
                'label' => 'Email'
            ],
            [
                'name' => 'mobile',
                'type' => 'text',
                'label' => 'Mobile'
            ],
            [
                'name' => 'profession',
                'type' => 'text',
                'label' => 'Profession'
            ],
            [
                'name' => 'social_profile_url',
                'type' => 'text',
                'label' => 'Social Profile Url'
            ],
            [   // select2_from_array
                'name' => 'misc[tshirt]',
                'label' => "T-Shirt",
                'type' => 'select2_from_array',
                'options' => trans('t_shirt'),
                'allows_null' => false,
                // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
            ],
            [
                'name' => 'is_paid',
                'type' => 'checkbox',
                'label' => 'Is Paid?'
            ]
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
        $this->crud->addFields([
            [
                'name' => 'attend_at',
                'type' => 'datetime_picker',
                'label' => 'Attend At',
                'date_picker_options' => [
                    'todayBtn' => 'linked',
                    'format' => 'dd-mm-yyyy',
                    'language' => 'en',
                    'timePicker' => true
                ],
            ]
        ]);
    }

    protected function setupShowOperation()
    {
        $this->setupListOperation();
    }

    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment    Name of the current entity (singular). Used as first URL segment.
     * @param string $routeName  Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected function setupBulkTicketRoutes($segment, $routeName, $controller)
    {
        Route::post($segment.'/bulk-ticket', [
            'as'        => $routeName.'.bulkTicket',
            'uses'      => $controller.'@bulkTicket',
            'operation' => 'bulkTicket',
        ]);

        Route::post($segment.'/bulk-email-for-pay', [
            'as'        => $routeName.'.bulkSendEmailForPay',
            'uses'      => $controller.'@bulkSendEmailForPay',
            'operation' => 'bulkSendEmailForPay',
        ]);

        Route::post($segment.'/bulk-sms-for-pay', [
           'as' => $routeName.'.bulkSendSmsForPay',
           'uses' => $controller.'@bulkSendSmsForPay',
           'operation' => 'bulkSendSmsForPay',
        ]);
    }

    /**
     * Add the default settings, buttons, etc that this operation needs.
     */
    protected function setupBulkDeleteDefaults()
    {
        $this->crud->allowAccess('bulkTicket');
        $this->crud->allowAccess('bulkSendEmailForPay');
        $this->crud->allowAccess('bulkSendSmsForPay');


        $this->crud->operation('bulkTicket', function () {
            $this->crud->loadDefaultOperationSettingsFromConfig();
        });

        $this->crud->operation('bulkSendEmailForPay', function () {
            $this->crud->loadDefaultOperationSettingsFromConfig();
        });

        $this->crud->operation('bulkSendSmsForPay', function () {
            $this->crud->loadDefaultOperationSettingsFromConfig();
        });

        $this->crud->operation('list', function () {
            $this->crud->enableBulkActions();
            $this->crud->addButton('bottom', 'bulk_ticket', 'view', 'crud::buttons.bulk_ticket');
            $this->crud->addButton('bottom', 'bulk_send_email_for_pay', 'view', 'crud::buttons.bulk_send_email_for_pay');
            $this->crud->addButton('bottom', 'bulk_send_sms_for_pay', 'view', 'crud::buttons.bulk_send_sms_for_pay');
        });
    }

    /**
     * Bulk Send tickets.
     *
     * @return string
     */
    public function bulkTicket()
    {
        $this->crud->applyConfigurationFromSettings('bulkTicket');
        $this->crud->hasAccessOrFail('bulkTicket');

        $entries = $this->request->input('entries');
        $sendTickets = [];

        foreach ($entries as $key => $id) {
            if ($entry = $this->crud->model->find($id)) {
                $sendTickets[] = dispatch(new SendEmailJob($entry, new ThanksForJoining($entry)));
            }
        }

        return $sendTickets;
    }

    /**
     * Send Email for pay
     *
     * @return string
     */
    public function bulkSendEmailForPay()
    {
        $this->crud->applyConfigurationFromSettings('bulkSendEmailForPay');
        $this->crud->hasAccessOrFail('bulkSendEmailForPay');

        $entries = $this->request->input('entries');
        $sendEmailForPay = [];


        foreach ($entries as $key => $id) {
            if ($entry = $this->crud->model->find($id)) {
                $sendEmailForPay[] = dispatch(new SendEmailJob($entry, new SuccessfullyCreateAttendee($entry)));
            }
        }

        return $sendEmailForPay;
    }

    /**
     * Send Sms for pay
     *
     * @return string
     */
    public function bulkSendSmsForPay()
    {
        $this->crud->applyConfigurationFromSettings('bulkSendSmsForPay');
        $this->crud->hasAccessOrFail('bulkSendSmsForPay');

        $entries = $this->request->input('entries');
        $sendSmsForPay = [];


        foreach ($entries as $key => $id) {
            if ($entry = $this->crud->model->find($id)) {
                $sendSmsForPay[] = dispatch(new SendSmsJob($entry, env('CONFIRM_MESSAGE')));
            }
        }

        return $sendSmsForPay;
    }

    public function store()
    {
        $this->crud->hasAccessOrFail('create');

        // execute the FormRequest authorization and validation, if one is required
        $request = $this->crud->validateRequest();


        // insert item in the db
        $item = $this->crud->create($request->all());
        $this->data['entry'] = $this->crud->entry = $item;

        // show a success message
        \Alert::success(trans('backpack::crud.insert_success'))->flash();

        // save the redirect choice for next time
        $this->crud->setSaveAction();

        return $this->crud->performSaveAction($item->getKey());
    }

}
