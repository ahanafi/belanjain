<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{

    public $label, $fieldName, $type, $placeholder, $value;
    public $isRequired, $isReadOnly;

    /**
     * Create a new component instance.
     *
     * @param $label
     * @param $fieldName
     * @param string $type
     * @param string $placeholder
     * @param string $value
     * @param bool $isRequired
     * @param bool $isReadOnly
     */
    public function __construct(
        $label,
        $fieldName,
        $type = 'text',
        $placeholder = '',
        $value = '',
        $isRequired = false,
        $isReadOnly = false
    )
    {
        $this->label = $label;
        $this->fieldName = $fieldName;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->isRequired = $isRequired;
        $this->isReadOnly = $isReadOnly;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input');
    }
}
