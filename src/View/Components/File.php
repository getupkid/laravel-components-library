<?php


namespace TomSix\Components\View\Components;


class File extends Input
{
    /**
     * Create a new component instance.
     *
     * @param string $name
     * @param string|null $label
     * @param array|string $inputAttributes
     * @param null $value
     * @param string $placeholder
     */
    public function __construct(string $name, ?string $label = null, $inputAttributes = [], $value = null, string $placeholder = '')
    {
        parent::__construct($name, $label, $inputAttributes, $value, $placeholder, 'file');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function render()
    {
        return view('library::form.file');
    }
}