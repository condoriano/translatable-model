<?php namespace Condoriano\TranslatableModel;

use Illuminate\Database\Eloquent\MassAssignmentException;
use Lang;

class ModelTranslator {

    private $model;
    private $locale;

    function __construct($model)
    {
        $this->model = $model;
        $this->locale = Lang::getLocale();
    }

    public function fill(array $attributes, $locale = null)
    {
        if ($locale)
        {
            $this->locale = $locale;
        }

        $totallyGuarded = $this->model->totallyGuarded();

        foreach ($attributes as $attrName => $value)
        {
            $key = $attrName . '_' . $this->locale;

            if ($this->model->isFillable($key))
            {
                $this->model->setAttribute($key, $value);
            }
            elseif ($totallyGuarded)
            {
                throw new MassAssignmentException($key);
            }
        }

        return $this->model;
    }

    function __get($name)
    {
        $locale = Lang::getLocale();

        if (is_array($this->model->translatedAttributes) && in_array($name, $this->model->translatedAttributes))
        {
            return $this->model->{$name . '_' . $locale};
        }
    }

    function __set($name, $value)
    {
        $locale = Lang::getLocale();

        if (is_array($this->model->translatedAttributes) && in_array($name, $this->model->translatedAttributes))
        {
            return $this->model->{$name . '_' . $locale} = $value;
        }
    }


}