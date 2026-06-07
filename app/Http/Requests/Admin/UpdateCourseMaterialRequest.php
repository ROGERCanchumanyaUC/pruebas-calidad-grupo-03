<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseMaterialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->isAdmin();
    }

    public function rules(): array
    {
        $type = $this->input('type');

        $rules = [
            'module_id' => ['sometimes', 'required', 'exists:course_modules,id'],
            'type' => ['sometimes', 'required', 'in:video,documento,presentacion,texto,recurso'],
            'title' => ['required', 'string', 'max:300'],
            'description' => ['nullable', 'string'],
            'order' => ['nullable', 'integer', 'min:0'],
            'is_downloadable' => ['nullable', 'boolean'],
        ];

        if ($type === 'video') {
            $rules['video_source'] = ['required', 'in:youtube,vimeo,upload'];
            $source = $this->input('video_source');

            if ($source === 'youtube' || $source === 'vimeo') {
                $rules['video_url'] = ['required', 'url', 'max:500'];
            } elseif ($source === 'upload' && $this->hasFile('file')) {
                $videoConfig = config('lms.uploads.video');
                $extensions = implode(',', $videoConfig['allowed_extensions']);
                $maxSize = $videoConfig['max_size_kb'];

                $rules['file'] = ['file', 'mimes:' . $extensions, 'max:' . $maxSize];
            }
            $rules['duration_minutes'] = ['nullable', 'integer', 'min:0'];
        } elseif ($type === 'documento' && $this->hasFile('file')) {
            $docConfig = config('lms.uploads.document');
            $extensions = implode(',', $docConfig['allowed_extensions']);
            $maxSize = $docConfig['max_size_kb'];

            $rules['file'] = ['file', 'mimes:' . $extensions, 'max:' . $maxSize];
        } elseif ($type === 'presentacion' && $this->hasFile('file')) {
            $presConfig = config('lms.uploads.presentation');
            $extensions = implode(',', $presConfig['allowed_extensions']);
            $maxSize = $presConfig['max_size_kb'];

            $rules['file'] = ['file', 'mimes:' . $extensions, 'max:' . $maxSize];
        } elseif ($type === 'texto') {
            $rules['content'] = ['required', 'string'];
        } elseif ($type === 'recurso' && $this->hasFile('file')) {
            $resConfig = config('lms.uploads.resource');
            $extensions = implode(',', $resConfig['allowed_extensions']);
            $maxSize = $resConfig['max_size_kb'];

            $rules['file'] = ['file', 'mimes:' . $extensions, 'max:' . $maxSize];
        }

        return $rules;
    }
}
