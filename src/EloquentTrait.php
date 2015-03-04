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

}