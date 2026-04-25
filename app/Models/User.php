<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Passport\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Spatie\Permission\Exceptions\PermissionDoesNotExist;
use Spatie\Permission\Traits\HasRoles;

use Illuminate\Database\Eloquent\Attributes\Guarded;

#[Guarded(['id', 'created_at', 'updated_at', 'deleted_at'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles, HasApiTokens, HasUuids {
        hasPermissionTo as protected spatieHasPermissionTo;
        
    }

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
     * Allow permission checks to match both camelCase and kebab-case resource names.
     */
    public function hasPermissionTo($permission, $guardName = null): bool
    {
        if (! is_string($permission)) {
            return $this->spatieHasPermissionTo($permission, $guardName);
        }

        foreach ($this->permissionNameVariants($permission) as $variant) {
            try {
                if ($this->spatieHasPermissionTo($variant, $guardName)) {
                    return true;
                }
            } catch (PermissionDoesNotExist) {
                continue;
            }
        }

        return false;
    }

    /**
     * Build the permission name variants we accept for this project.
     *
     * @return array<int, string>
     */
    private function permissionNameVariants(string $permission): array
    {
        $variants = [$permission];

        foreach ([
            'view-any-',
            'view-',
            'create-',
            'update-',
            'delete-',
            'restore-',
            'force-delete-',
        ] as $prefix) {
            if (! Str::startsWith($permission, $prefix)) {
                continue;
            }

            $name = Str::after($permission, $prefix);
            $variants[] = $prefix . Str::kebab($name);
            $variants[] = $prefix . Str::camel($name);
            break;
        }

        return array_values(array_unique($variants));
    }
}
