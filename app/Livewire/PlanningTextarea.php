<?php

namespace App\Livewire;

use App\Models\PlanningItem;
use Livewire\Component;

class PlanningTextarea extends Component
{
    public PlanningItem $planningItem;

    protected $rules = [
        'planningItem.value' => 'string',
    ];

    public function mount(PlanningItem $planningItem)
    {
        $this->planningItem = $planningItem;
    }

    public function updated($name, $value) 
    {
        if($name === 'planningItem.value'){
            $this->planningItem->value = $value;
            $this->planningItem->save();
        }
    }
    
    public function render()
    {
        return view('livewire.planning-textarea');
    }
}
