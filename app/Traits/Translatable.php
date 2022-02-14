<?php

/**
 * trait Translatable.
 *
 * @author  Ahmed Fekry
 * @link  https://github.com/ahmedfekry
 * @mail ahmedfikry78@gmail.com
 *
 */

namespace App\Traits;

use App\Models\HasTranslation;
use App\Models\HasBody;
use App\Models\Language;

trait Translatable {

    // array to save the languages short_codes and column values
    protected $translation_attributes = array();
    protected $fallback;

    public function __construct() {
        parent::__construct();

        // if the user didn't spacify a fallback in the parent model it gives is the first language as value
        if (empty($this->fallback_locale)) {
            $this->fallback = \Config::get('app.fallback_locale');
        } else {
            $this->fallback = $this->fallback_locale;
        }
    }

    public function setTranslation($column, $locale, $value) {

        // if the locale is the save as the fallback locale set the current table column's value to that locale
        // else save the key and value with the language short code to the translation array attributes
        if ($locale == $this->fallback) {
            parent::setAttribute($column, $value);
        } else {
            $this->translation_attributes[$locale][$column] = $value;
        }
        return $this;
    }

    public function save(array $options = []) {
        if ($this->exists) {
            if (count($this->getDirty()) > 0) {
                // If $this->exists and dirty, parent::save() has to return true. If not,
                // an error has occurred. Therefore we shouldn't save the translations.
                if (parent::save($options)) {
                    return $this->saveTranslations();
                }
                return false;
            } else {
                // If $this->exists and not dirty, parent::save() skips saving and returns
                // false. So we have to save the translations
                if ($saved = $this->saveTranslations()) {
                    $this->fireModelEvent('saved', false);
                    $this->fireModelEvent('updated', false);
                }
                return $saved;
            }
        } elseif (parent::save($options)) {
            // We save the translations only if the instance is saved in the database.
            return $this->saveTranslations();
        }
        return false;
    }

    public function saveTranslations() {
        foreach ($this->translation_attributes as $key => $value) {
            $language_id = Language::where('short_code', $key)->first()->id;
            foreach ($value as $key_ => $value_) {

                $trans = HasTranslation::where('table_name', $this->table)->where('record_id', $this->id)->where('column_name', $key_)->first();
                if (isset($trans) && $trans!=null) {
                    $has_body = HasBody::where('language_id', $language_id)->where('translatable_id', $trans->id)->first();
                    if(isset($has_body) && $has_body!=null){
                        $has_body->body = $value_;
                        $has_body->save();
                    }else{
                        $has_body = new HasBody();
                        $has_body->language_id = $language_id;
                        $has_body->translatable_id = $trans->id;
                        $has_body->body = $value_;
                        $has_body->save();
                    }
                } else {
                    $trans = new HasTranslation();
                    $trans->table_name = $this->table;
                    $trans->record_id = $this->id;
                    $trans->column_name = $key_;
                    $trans->save();

                    $has_body = new HasBody();
                    $has_body->language_id = $language_id;
                    $has_body->translatable_id = $trans->id;
                    $has_body->body = $value_;
                    $has_body->save();
                }
            }
        }
        return true;
    }

    public function getTranslation($column, $locale = '') {
        if (empty($locale) || $locale == $this->fallback) {
            $locale = $this->fallback;
            return $this->$column;
        } else {
            // dd($locale);
            $language_id = Language::where('short_code', $locale)->first()->id;
            $trans = HasTranslation::where('table_name', $this->table)->where('record_id', $this->id)->where('column_name', $column)->first();
            if (!$trans) {
                return ' ';
            }
            $has_body = HasBody::where('language_id', $language_id)->where('translatable_id', $trans->id)->first();
            if (!$has_body) {
                return ' ';
            }
            return $has_body->body;
        }
        return $this->fallback;
    }

    public function delete() {
        if ($this->exists) {
            $translatables = HasTranslation::where('table_name', $this->table)->where('record_id', $this->id)->get();
            foreach ($translatables as $translatable) {
                $translatable->delete();
            }
            parent::delete();
        }
        return true;
    }

}

?>
