<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseMaterial;
use App\Models\CourseModule;
use App\Models\AuditLog;
use App\Http\Requests\Admin\StoreCourseMaterialRequest;
use App\Http\Requests\Admin\UpdateCourseMaterialRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CourseMaterialController extends Controller
{
    /**
     * Store a newly created material in storage.
     */
    public function store(StoreCourseMaterialRequest $request)
    {
        $data = $request->validated();
        $module = CourseModule::findOrFail($data['module_id']);
        $courseId = $module->course_id;

        // Auto-increment order if not specified
        if (!isset($data['order']) || is_null($data['order'])) {
            $nextOrder = CourseMaterial::where('module_id', $data['module_id'])->max('order') + 1;
            $data['order'] = $nextOrder;
        }

        // Handle File Upload based on material type
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(40) . '.' . $extension;

            // Save in local (private) storage
            $path = $file->storeAs("materials/{$courseId}/{$module->id}", $filename, 'local');

            $data['file_path'] = $path;
            $data['file_type'] = $file->getMimeType();

            // For uploaded videos, set duration if available
            if ($data['type'] === 'video') {
                $data['video_source'] = 'upload';
            }
        }

        // Handle Rich Text formatting & sanitization
        if ($data['type'] === 'texto' && isset($data['content'])) {
            $data['content'] = $this->sanitizeHtml($data['content']);
        }

        // Handle checkbox boolean cast
        $data['is_downloadable'] = $request->has('is_downloadable');

        $material = CourseMaterial::create($data);

        // Audit Log
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'create_material',
            'entity_type' => CourseMaterial::class,
            'entity_id' => $material->id,
            'new_values' => $material->toArray(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return back()->with('success', 'Material creado exitosamente.');
    }

    /**
     * Update the specified material in storage.
     */
    public function update(UpdateCourseMaterialRequest $request, CourseMaterial $material)
    {
        $data = $request->validated();
        $oldValues = $material->toArray();

        $module = $material->module;
        $courseId = $module->course_id;

        // Handle File Upload replacement
        if ($request->hasFile('file')) {
            // Physically delete old file if it exists
            if ($material->file_path) {
                Storage::disk('local')->delete($material->file_path);
            }

            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(40) . '.' . $extension;

            // Save in local (private) storage
            $path = $file->storeAs("materials/{$courseId}/{$module->id}", $filename, 'local');

            $data['file_path'] = $path;
            $data['file_type'] = $file->getMimeType();
        }

        // Handle Video type transition (if changing from upload to YouTube/Vimeo, delete file)
        if (isset($data['type']) && $data['type'] === 'video' && isset($data['video_source'])) {
            if ($data['video_source'] !== 'upload' && $material->file_path) {
                Storage::disk('local')->delete($material->file_path);
                $data['file_path'] = null;
                $data['file_type'] = null;
            }
        }

        // Handle Rich Text formatting & sanitization
        if (($data['type'] ?? $material->type) === 'texto' && isset($data['content'])) {
            $data['content'] = $this->sanitizeHtml($data['content']);
        }

        // Handle checkbox boolean cast
        $data['is_downloadable'] = $request->has('is_downloadable');

        $material->update($data);

        // Audit Log
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'update_material',
            'entity_type' => CourseMaterial::class,
            'entity_id' => $material->id,
            'old_values' => $oldValues,
            'new_values' => $material->toArray(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return back()->with('success', 'Material actualizado exitosamente.');
    }

    /**
     * Remove the specified material from storage.
     */
    public function destroy(Request $request, CourseMaterial $material)
    {
        $oldValues = $material->toArray();

        // Physically delete file from private storage
        if ($material->file_path) {
            Storage::disk('local')->delete($material->file_path);
        }

        $material->delete();

        // Audit Log
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete_material',
            'entity_type' => CourseMaterial::class,
            'entity_id' => $material->id,
            'old_values' => $oldValues,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return back()->with('success', 'Material eliminado exitosamente.');
    }

    /**
     * Sanitize HTML to prevent XSS attacks in rich text components (Quill).
     */
    protected function sanitizeHtml(string $html): string
    {
        $allowedTags = '<p><h2><h3><h4><h5><h6><strong><em><u><s><ul><ol><li><a><pre><code><br><blockquote>';
        $clean = strip_tags($html, $allowedTags);

        // Prevent JS injection in href attributes
        $clean = preg_replace('/href="javascript:[^"]*"/i', 'href="#"', $clean);
        // Remove on-event attributes
        $clean = preg_replace('/(onload|onerror|onclick|onmouseover|onfocus|onblur|onchange)="[^"]*"/i', '', $clean);

        return $clean;
    }
}
