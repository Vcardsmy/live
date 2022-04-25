<?php

namespace App\Repositories;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

/**
 * Class UserRepository
 */
class SettingRepository extends BaseRepository
{
    public $fieldSearchable = [
        'app_name',
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
        return Setting::class;
    }

    /**
     * @param array $input
     * @param int $userId
     *
     * @return Builder|Builder[]|Collection|Model
     */
    public function update($input, $userId)
    {
        if (in_array($input, ['prefix_code'])) {
            $input['prefix_code'] = '+'.$input['prefix_code'];
        }

        $inputArr = Arr::except($input, ['_token']);

        foreach ($inputArr as $key => $value) {
            $setting = Setting::where('key', $key)->first();
            if (!$setting || !$value) {
                continue;
            }

            if (in_array($key, ['app_logo', 'favicon'])) {
                $this->fileUpload($setting, $value);
                continue;
            }
            if (in_array($key, ['home_page_banner'])) {
                $setting->clearMediaCollection(Setting::FRONTPATH);
                $media = $setting->addMedia($input['home_page_banner'])->toMediaCollection(Setting::FRONTPATH,
                    config('app.media_disc'));
                $setting->update(['value' => $media->getFullUrl()]);
                continue;
            }

            $setting->update(['value' => $value]);
        }

        return $setting;
    }

    /**
     * @param $setting
     * @param $file
     *
     */
    public function fileUpload($setting, $file)
    {
        $setting->clearMediaCollection(Setting::PATH);
        $media = $setting->addMedia($file)->toMediaCollection(Setting::PATH, config('app.media_disc'));
        $setting->update(['value' => $media->getFullUrl()]);
    }
}
