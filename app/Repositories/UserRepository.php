<?php

namespace App\Repositories;

use App\Models\MultiTenant;
use App\Models\Plan;
use App\Models\Role;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class UserRepository
 */
class UserRepository extends BaseRepository
{
    public $fieldSearchable = [
        'first_name',
        'last_name',
        'email',
        'contact',
        'dob',
        'gender',
        'is_active',
        'password',
    ];

    /**
     * @inheritDoc
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * @inheritDoc
     */
    public function model()
    {
        return User::class;
    }

    /**
     * @param $input
     *
     * @return mixed
     */
    public function store($input)
    {
        try {
            DB::beginTransaction();

            $tenant = MultiTenant::create(['tenant_username' => $input['first_name']]);

            $input['tenant_id'] = $tenant->id;
            $input['password'] = Hash::make($input['password']);
            $user = User::create($input)->assignRole(Role::ROLE_ADMIN);

            if (isset($input['profile']) && !empty($input['profile'])) {
                $user->addMedia($input['profile'])->toMediaCollection(User::PROFILE, config('app.media_disc'));
            }

            $user->sendEmailVerificationNotification();
            
            $plan = Plan::whereIsDefault(true)->first();
            
            $subscription = new Subscription();
            $subscription->plan_id = $plan->id;
            $subscription->starts_at = Carbon::now();
            $subscription->ends_at = Carbon::now()->addDays($plan->trial_days);
            $subscription->plan_amount = $plan->price;
            $subscription->plan_frequency = $plan->frequency;
            $subscription->trial_ends_at = Carbon::now()->addDays($plan->trial_days);
            $subscription->no_of_vcards = $plan->no_of_vcards;
            $subscription->tenant_id = $input['tenant_id'];
            $subscription->status = Subscription::ACTIVE;
            $subscription->saveQuietly();

            DB::commit();

            return $user;
        } catch (Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param array $input
     * @param int $user
     *
     * @return Builder|Builder[]|Collection|Model|int
     */
    public function update($input, $user)
    {
        if(isset($input['contact'])){
            $input['contact'] = str_replace(' ','',$input['contact']);
        }
        $user->update($input);

        if (isset($input['profile']) && !empty($input['profile'])) {
            $user->clearMediaCollection(User::PROFILE);
            $user->addMedia($input['profile'])->toMediaCollection(User::PROFILE, config('app.media_disc'));
        }

        return $user;
    }

    /**
     * @param $userInput
     *
     * @return bool
     */
    public function updateProfile($userInput)
    {
        try {
            DB::beginTransaction();

            $user = Auth::user();
            
            $userInput['contact'] = str_replace(' ','',$userInput['contact']);
            
            $user->update($userInput);

            if (isset($userInput['profile']) && !empty($userInput['profile'])) {
                $user->clearMediaCollection(User::PROFILE);
                $user->addMedia($userInput['profile'])->toMediaCollection(User::PROFILE, config('app.media_disc'));
            }

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
