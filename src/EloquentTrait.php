<?php namespace Condoriano\TranslatableModel;

trait EloquentTrait {

    private $modelTranslator;

    public function getI18nAttribute()
    {
        if (! $this->modelTranslator)
        {
            $this->modelTranslator = new ModelTranslator($this);
        }

        return $this->modelTranslator;
    }

    public function toArray()
    {
        $attributes = $this->attributesToArray();
        $attributes = array_merge($attributes, $this->relationsToArray());
        $locales = array_keys(\I18n::getSupportedLocales());

        if (isset($this->translatedHidden) && $this->translatedHidden === true)
        {
            foreach ($locales as $locale)
            {
                foreach ($this->translatedAttributes as $fieldName)
                {
                    unset($attributes[$fieldName . '_' . $locale]);
                }
            }
        }

        # add translatable fields
        foreach ($this->translatedAttributes as $fieldName)
        {
            $attributes[$fieldName] = $this->i18n->{$fieldName};
        }

        return $attributes;
    }

}