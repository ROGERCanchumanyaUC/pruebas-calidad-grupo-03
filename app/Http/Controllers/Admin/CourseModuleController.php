<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseModule;
use App\Models\AuditLog;
use App\Http\Requests\Admin\StoreCourseModuleRequest;
use App\Http\Requests\Admin\UpdateCourseModuleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseModuleController extends Controller
{
    /**
     * Store a newly created module in storage.
     */
    public function store(StoreCourseModuleRequest $request)
    {
        $data = $request->validated();

        // If order is not specified, assign next order value for this course
        if (!isset($data['order']) || is_null($data['order'])) {
            $nextOrder = CourseModule::where('course_id', $data['course_id'])->max('order') + 1;
            $data['order'] = $nextOrder;
        }

        $module = CourseModule::create($data);

        // Audit Log
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'create_module',
            'entity_type' => CourseModule::class,
            'entity_id' => $module->id,
            'new_values' => $module->toArray(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return back()->with('success', 'Módulo creado exitosamente.');
    }

    /**
     * Update the specified module in storage.
     */
    public function update(UpdateCourseModuleRequest $request, CourseModule $module)
    {
        $data = $request->validated();
        $oldValues = $module->toArray();

        $module->update($data);

        // Audit Log
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'update_module',
            'entity_type' => CourseModule::class,
            'entity_id' => $module->id,
            'old_values' => $oldValues,
            'new_values' => $module->toArray(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return back()->with('success', 'Módulo actualizado exitosamente.');
    }

    /**
     * Remove the specified module from storage.
     */
    public function destroy(Request $request, CourseModule $module)
    {
        $oldValues = $module->toArray();

        // Physically delete material files within this module
        foreach ($module->materials as $material) {
            if ($material->file_path) {
                Storage::disk('local')->delete($material->file_path);
            }
        }

        $module->delete();

        // Audit Log
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete_module',
            'entity_type' => CourseModule::class,
            'entity_id' => $module->id,
            'old_values' => $oldValues,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return back()->with('success', 'Módulo eliminado exitosamente.');
    }

    /**
     * Reorder the modules.
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'ids' => ['required', 'array'],
            'ids.*' => ['required', 'exists:course_modules,id'],
        ]);

        $ids = $request->input('ids');
        $oldOrders = [];
        $newOrders = [];

        foreach ($ids as $index => $id) {
            $module = CourseModule::find($id);
            if ($module) {
                $oldOrders[$id] = $module->order;
                $newOrder = $index + 1;
                $module->update(['order' => $newOrder]);
                $newOrders[$id] = $newOrder;
            }
        }

        // Audit Log
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'reorder_modules',
            'entity_type' => CourseModule::class,
            'entity_id' => count($ids) > 0 ? $ids[0] : null,
            'old_values' => ['orders' => $oldOrders],
            'new_values' => ['orders' => $newOrders],
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Módulos reordenados exitosamente.',
        ]);
    }
}
