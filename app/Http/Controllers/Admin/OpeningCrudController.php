<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AttendeeType;
use App\Models\Attendee;
use Backpack\CRUD\app\Http\Controllers\CrudController;

class OpeningCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Attendee');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/opening');
        $this->crud->setEntityNameStrings('opening', 'openings');
        $this->crud->operation('list', function () {

            $this->crud->addClause('where', function ($query) {
                $query->where('type', '=', AttendeeType::ATTENDEE)->where('is_paid', '=', true);
            });

            $this->crud->addClause('orWhere', function ($query) {
                $query->whereIn('type', [AttendeeType::GUEST, AttendeeType::VOLUNTEER, AttendeeType::SPONSOR, AttendeeType::STUDENT])->where('is_paid', '=', false);
            });
        });

        $this->crud->addButtonFromModelFunction('line', 'attend_at', 'setAttendAt', 'beginning');
        $this->crud->enableExportButtons();
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
                    $query->orWhere('mobile', 'like', '%'.$searchTerm);
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
                'name' => 'profession',
                'type' => 'text',
                'label' => 'Profession',
            ],
            [
                'name' => 'attend_at',
                'type' => 'datetime',
                'label' => 'Attend At'
            ],
        ]);
    }

    public function setAttendAt($id)
    {
        $attendee = Attendee::find($id);

        if (blank($attendee->attend_at)) {
            $attendee->attend_at = now();
            $attendee->save();
        }

        return back();
    }
}
