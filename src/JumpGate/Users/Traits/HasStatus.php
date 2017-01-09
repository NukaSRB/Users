<?php

namespace JumpGate\Users\Traits;

use JumpGate\Users\Models\User\Status;

trait HasStatus
{
    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        if (is_int($status)) {
            $this->update(['status_id' => $status]);
        }

        $status = Status::where('name', $status)->first();

        if (! is_null($status)) {
            $this->update(['status_id' => $status->id]);
        }

        throw new \InvalidArgumentException('The status provided could not be found.  Please use a status ID or a status name.');
    }

    /**
     * The status the user is currently in.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
