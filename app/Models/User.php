<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;
use App\Models\Status;
use App\Models\Location;
use App\Models\Shop;
use App\Models\Order;
use App\Models\Review;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $table = 'users';
    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'password',
        'nationality',
        'location_id',
        'role_id',
        'user_status_id', // ✅ Add this
    ];
    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    

    function password_reset_token()
    {
        return $this->hasOne(PasswordResetToken::class, 'email', 'email');
    }
    function status()
    {
        return $this->belongsTo(UserStatus::class, 'status_id', 'id');
    }
    function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
    function location()
    {
        return $this->hasOne(Location::class);
    }
    
    function cart()
    {
        return $this->hasOne(Cart::class);
    }

    function logs(){
        return $this->hasMany(Log::class);
    }
    function shops(){
        return $this->hasMany(Shop::class, 'manage_id', 'id');
    }
    function orders(){
        return $this->hasMany(Order::class, 'user_id', 'id');
    }
    function reviews(){
        return $this->hasMany(Review::class, 'user_id', 'id');
    }
    function sessions(){
        return $this->hasMany(Session::class, 'user_id', 'id');
    }
    
    public function getCompletedOrdersCountAttribute()
{
    return $this->orders()->where('status', 'completed')->count();
}


    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    // Chats where this user is user_one
    public function chatsInitiated()
    {
        return $this->hasMany(Chat::class, 'user_one_id');
    }

    // Chats where this user is user_two
    public function chatsReceived()
    {
        return $this->hasMany(Chat::class, 'user_two_id');
    }

    // Combined chats (optional helper)
    public function chats()
    {
        return $this->chatsInitiated->merge($this->chatsReceived);
    }

}
