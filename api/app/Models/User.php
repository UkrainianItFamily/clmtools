<?php

namespace App\Models;

use App\Notifications\EmailVerificationNotification;
use App\Notifications\MailResetPasswordNotification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * Class User
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property string $password
 */

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'profile_image',
        'name',
        'last_name',
        'date_birth',
        'email',
        'phone',
        'password',
        'city',
        'university',
        'graduation_year',
        'lecturer'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'date_birth' => 'date:Y-m-d'
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function getAvatar(): ?string
    {
        return $this->profile_image;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function getDateBirth(): ?Carbon
    {
        return $this->date_birth;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function getUniversity(): ?string
    {
        return $this->university;
    }

    public function getGraduationYear(): ?int
    {
        return $this->graduation_year;
    }

    public function getVerifiedEmail(): ?Carbon
    {
        return $this->email_verified_at;
    }

    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new EmailVerificationNotification());
    }

    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new MailResetPasswordNotification($token));
    }

    public function lectures(): BelongsToMany {
        return $this->belongsToMany(Lecture::class);
    }

    public function getUserRoleLecturer(): ?bool
    {
        return $this->lecturer;
    }
}
