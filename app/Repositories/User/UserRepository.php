<?php

namespace App\Repositories\User;

use App\Enum\UserAvatar;
use App\Enum\UserStatus;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

/**
 * The repository for User Model
 */
class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    const ITEM_PER_PAGE = 50;

    /**
     * {@inheritdoc}
     */
    protected $model;

    /**
     * {@inheritdoc}
     */
    public function __construct(User $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }

    /**
     * @inheritdoc
     */
    public function serverPaginationFilteringForAdmin($searchParams): LengthAwarePaginator
    {
        $limit = Arr::get($searchParams, 'limit', self::ITEM_PER_PAGE);
        $keyword = Arr::get($searchParams, 'search', '');
        $status = Arr::get($searchParams, 'status', null);

        $query = $this->model->query()->with('roles');

        if ($keyword) {
            if (is_array($keyword)) {
                $keyword = $keyword['value'];
            }

            $query->whereAny([
                'name',
                'email',
                'id',
            ], 'LIKE', '%' . $keyword . '%');
        }

        if (! is_null($status)) {
            $query->where('status', $status);
        }

        return $query->latest()->paginate($limit);
    }

    /**
     * @inheritdoc
     */
    public function create($data)
    {
        try {
            DB::beginTransaction();

            $data['name'] = $data['last_name'] . ' ' . $data['first_name'];

            if ($data['status'] == UserStatus::LOCKED->value) {
                $data['locked_at'] = now();
            }

            $user = $this->model->create($data);
            $user->userProfile()->create($data);

            if (isset($data['user_avatar']) && $data['user_avatar']) {
                $file = json_decode($data['user_avatar'], true);
                $user->addMediaFromBase64($file['data'])
                    ->usingFileName($file['name'])
                    ->toMediaCollection(UserAvatar::COLLECTION->value);
            }

            if (!$user->syncRoles(Arr::map($data['roles'], fn($role) => (int)$role))) {
                DB::rollBack();
            }

            DB::commit();

            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }

    /**
     * @inheritdoc
     */
    public function update($model, $data)
    {
        try {
            DB::beginTransaction();

            $data['name'] = $data['last_name'] . ' ' . $data['first_name'];

            if ($model->status != UserStatus::LOCKED->value && $data['status'] == UserStatus::LOCKED->value) {
                $data['locked_at'] = now();
            }

            $user = $model->update($data);
            $model->userProfile->update($data);

            $model->clearMediaCollection(UserAvatar::COLLECTION->value);
            if (isset($data['user_avatar']) && $data['user_avatar']) {
                $file = json_decode($data['user_avatar'], true);
                $model->addMediaFromBase64($file['data'])
                    ->usingFileName($file['name'])
                    ->toMediaCollection(UserAvatar::COLLECTION->value);
            }

            if (!empty($data['roles'])) {
                if (!$model->syncRoles(Arr::map($data['roles'], fn($role) => (int)$role))) {
                    DB::rollBack();
                }
            }

            DB::commit();

            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }

    /**
     * @inheritdoc
     */
    public function updatePassword(User $model, $data)
    {
        try {
            DB::beginTransaction();

            $user = $model->update($data);

            DB::commit();

            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }
}
