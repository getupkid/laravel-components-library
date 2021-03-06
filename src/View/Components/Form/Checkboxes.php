<?php


namespace TomSix\Components\View\Components\Form;


use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Checkboxes extends FormComponent
{
    /**
     * If the checkboxes must be inline
     *
     * @var bool $inline
     */
    public bool $inline;

    /**
     * A list of given options
     *
     * @var array $options
     */
    public array $options;

    /**
     * Checks if the options ar a associative array
     *
     * @var bool $optionsAreAssoc
     */
    public bool $optionsAreAssoc;

    /**
     * Set the type of the input
     *
     * @var string $type
     */
    public string $type;

    /**
     * Create a new component instance.
     *
     * @param string $name
     * @param string|null $label
     * @param array $options
     * @param bool $inline
     * @param array|string $inputAttributes
     * @param iterable|string|int $value
     * @param string $type
     */
    public function __construct(string $name, ?string $label = null, array $options = [], bool $inline = false, $inputAttributes = [], $value = null, string $type = 'checkbox')
    {
        parent::__construct($name, $label, $inputAttributes, $value);

        $this->inline = $inline;
        $this->options = $options;
        $this->optionsAreAssoc = Arr::isAssoc($this->options);
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('laravel-components-library::form.checkboxes');
    }

    /**
     * Determine if the value is checked
     *
     * @param $option
     * @return bool
     */
    public function isChecked($option): bool
    {
        if(is_string($this->value) || is_numeric($this->value))
        {
            return $option == $this->value;
        }

        if (is_array($this->value))
        {
            return in_array($option, $this->value);
        }

        return false;
    }

    /**
     *
     * @param string|int $key
     * @return string
     */
    public function getIdName($key): string
    {
        if(Str::endsWith($this->name, '[]'))
        {
            $result = $this->nameWithoutBrackets();

            if(is_int($key))
            {
                return $result . '[' . $key . ']';
            }

            return $result . '[\'' . $key . '\']';
        }

        return $this->name . $key;
    }
}
