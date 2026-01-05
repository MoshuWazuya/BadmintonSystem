<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Court;

class CourtManagement extends Component
{
    public $courts;
    public $court_name;
    public $court_type;
    public $location;
    public $status = 'active';
    public $editCourtId = null;

    public function mount()
    {
        $this->loadCourts();
    }

    public function loadCourts()
    {
        $this->courts = Court::all();
    }

    public function saveCourt()
    {
        $this->validate([
            'court_name' => 'required|string',
            'court_type' => 'required|string',
            'location' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        if ($this->editCourtId) {
            $court = Court::find($this->editCourtId);
            $court->update([
                'court_name' => $this->court_name,
                'court_type' => $this->court_type,
                'location' => $this->location,
                'status' => $this->status,
            ]);
        } else {
            Court::create([
                'court_name' => $this->court_name,
                'court_type' => $this->court_type,
                'location' => $this->location,
                'status' => $this->status,
            ]);
        }

        $this->resetInputs();
        $this->loadCourts();
    }

    public function editCourt($id)
    {
        $court = Court::find($id);
        $this->editCourtId = $id;
        $this->court_name = $court->court_name;
        $this->court_type = $court->court_type;
        $this->location = $court->location;
        $this->status = $court->status;
    }

    public function deleteCourt($id)
    {
        $court = Court::find($id);
        if ($court) {
            if ($court->bookings()->whereIn('status',['pending','approved'])->count() == 0) {
                $court->delete();
            } else {
                session()->flash('error','Cannot delete court with pending/approved bookings.');
            }
            $this->loadCourts();
        }
    }

    public function updateCourtStatus($id, $status)
    {
        $court = Court::find($id);
        if ($court) {
            $court->status = $status;
            $court->save();
            $this->loadCourts();
        }
    }

    public function resetInputs()
    {
        $this->reset(['court_name','court_type','location','status','editCourtId']);
    }

    public function render()
    {
        return view('livewire.admin.court-management');
    }
}
















