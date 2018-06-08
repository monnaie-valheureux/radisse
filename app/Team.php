<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * A team is a subgroup among the people working for the local currency.
 */
class Team extends Model
{
    /**
     * Get the members of the team.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function members()
    {
        return $this->hasMany(TeamMember::class);
    }

    /**
     * Get the partners that are managed by the team.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function partners()
    {
        return $this->hasMany(Partner::class);
    }
}
