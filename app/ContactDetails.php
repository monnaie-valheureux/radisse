<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;

class ContactDetails extends Model
{
    /**
     * The table associated with the model.
     *
     * We explicitly define this property here in order to make subclasses
     * automatically inherit it. This prevents Eloquent to try to guess
     * the proper table names for subclasses from their names. This
     * is needed because they all use the contact_details table.
     *
     * @var string
     */
    protected $table = 'contact_details';

    /**
     * The type of contact info stored by the object.
     * This has to be set by subclasses.
     *
     * @var string
     */
    protected $type;

    /**
     * Tell if the info is public or if it can only be used internally.
     *
     * @var bool
     */
    protected $isPublic = false;

    /**
     * An optional label associated with the contact info.
     *
     * @var string
     */
    protected $label;

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // When the contact info is retrieved from the database, we gather the
        // contents of the JSON column in order to populate properties that
        // are specific to the ContactDetails object we work with.
        static::retrieved(function (self $self) {
            $self->populateContactDetailProperties();
        });

        // When the contact info is saved to the database, we gather the
        // data that is related to the ContactDetails object in order
        // to store it as JSON in a dedicated database column.
        static::saving(function (self $self) {
            $self->prepareContactDetailPropertiesForSaving();
        });
    }

    /**
     * Get all of the owning contactable models.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function contactable()
    {
        return $this->morphTo('contactable');
    }

    /**
     * Get key-value pairs of data that are specific to this type of contact info.
     *
     * This method has to be implemented by subclasses.
     */
    protected function getOwnAttributes()
    {
        throw new Exception(
            'getOwnAttributes method must be overwritten by subclasses'
        );
    }

    /**
     * Allow to fluently set the public state a contact info.
     *
     * @return self
     */
    public function makePublic()
    {
        $this->isPublic = true;

        return $this;
    }

    /**
     * Allow to fluently set the private state a contact info.
     *
     * @return self
     */
    public function makePrivate()
    {
        $this->isPublic = false;

        return $this;
    }

    /**
     * Allow to fluently set the public state a contact info using a boolean.
     *
     * @param bool  $isPublic
     *
     * @return self
     */
    public function setVisibility($isPublic)
    {
        $this->isPublic = (bool) $isPublic;

        return $this;
    }

    /**
     * Allow to fluently add a label to a contact info.
     *
     * @param  string  $label
     *
     * @return self
     */
    public function withLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Allow to read specific properties as if they were public.
     *
     * @param  string  $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        switch ($name) {
            case 'type':
                return $this->type;
            case 'isPublic':
                return $this->isPublic;
            case 'isPrivate':
                return !$this->isPublic;
            case 'label':
                return $this->label;
        }

        return parent::__get($name);
    }

    /**
     * Allow to write specific properties as if they were public.
     *
     * @param string  $name
     * @param mixed   $value
     */
    public function __set($name, $value)
    {
        switch ($name) {
            case 'label':
                $this->label = ($label = trim($value)) ? $label : null;
                break;
            case 'isPublic':
                $this->isPublic = (bool) $value;
                break;
            case 'isPrivate':
                $this->isPublic = !((bool) $value);
                break;
            default:
                // Fall back on the magic method of the parent.
                parent::__set($name, $value);
                break;
        }
    }

    /**
     * Initialize specific properties based on a JSON database column.
     *
     * This fills properties related to the contact detail from data that is
     * stored in a dedicated JSON column.
     *
     * @return void
     */
    protected function populateContactDetailProperties()
    {
        $data = json_decode($this->attributes['data']);

        // Handle properties that are shared by all types of contact details.
        $this->isPublic = $data->isPublic;
        $this->label = $data->label;

        // Then, handle specific properties.
        if (method_exists($this, 'getOwnAttributeKeys')) {
            $properties = $this->getOwnAttributeKeys();
        } else {
            $properties = array_keys($this->getOwnAttributes());
        }

        foreach ($properties as $property) {
            $this->{$property} = $data->{$property};
        }
    }

    /**
     * Set or update Eloquent attributes using data from specific properties.
     *
     * This gathers data from properties that are specific to the contact
     * detail in order to store it in a dedicated JSON column.
     *
     * @return void
     */
    protected function prepareContactDetailPropertiesForSaving()
    {
        $commonData = [
            'isPublic' => $this->isPublic,
            'label' => $this->label,
        ];

        $specificData = $this->getOwnAttributes();

        // Overwrite the array of attributes of the Eloquent model.
        $this->attributes = array_merge($this->attributes, [
            'type' => $this->type,
            'data' => json_encode($commonData + $specificData),
        ]);
    }
}
