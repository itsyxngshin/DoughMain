<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = ['participant_one_id', 'participant_one_type', 'participant_two_id', 'participant_two_type'];

    public function participantOne() {
        return $this->morphTo('participant_one');
    }

    public function participantTwo() {
        return $this->morphTo('participant_two');
    }

    public function messages() {
        return $this->hasMany(Message::class);
    }

    public function getOtherParticipant($authModel) {
        if (
            $this->participant_one_type === get_class($authModel) &&
            $this->participant_one_id === $authModel->id
        ) {
            return $this->participantTwo;
        }
        return $this->participantOne;
    }
}
